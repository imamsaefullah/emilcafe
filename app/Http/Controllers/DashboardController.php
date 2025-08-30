<?php

namespace App\Http\Controllers;

use App\Helpers\TransactionHelper;
use App\Models\Good;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Customer;
use Illuminate\Support\Facades\Http;


class DashboardController
{
    //
    public function index()
    {
        $totalSemua = Transaction::where('status','selesai')->sum('total');

        $today = Carbon::today();
        $totalSekarang = Transaction::whereDate('created_at', $today)
            ->where('status', 'selesai')
            ->sum('total');

        $kemarin = Carbon::yesterday();
        $totalKemarin = Transaction::whereDate('created_at', $kemarin)
            ->where('status', 'selesai')
            ->sum('total');

        $pending = Transaction::whereDate('created_at', $today)
            ->where('status', 'pending')
            ->count();

        $rejected = Transaction::where('statusdapur', 'rejected')->count();

        // Persentase harian
        if ($totalKemarin > 0) {
            $persentase = (($totalSekarang - $totalKemarin) / $totalKemarin) * 100;
        } elseif ($totalSekarang > 0) {
            $persentase = 100;
        } else {
            $persentase = 0;
        }

        $totalOrder = Transaction::where('status','selesai')->count();

        // Tahunan
        $totalTahunIni = Transaction::whereYear('created_at', now()->year)
            ->where('status','selesai')
            ->sum('total');
        $totalTahunLalu = Transaction::whereYear('created_at', now()->subYear()->year)
            ->where('status','selesai')
            ->sum('total');
        $kenaikan = $totalTahunIni - $totalTahunLalu;

        // --- Chart Mingguan ---
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek   = Carbon::now()->endOfWeek();

        $weekData = Transaction::selectRaw('DAYNAME(created_at) as day, SUM(total) as total, COUNT(*) as orders')
            ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->where('status', 'selesai')
            ->groupBy('day')
            ->get();

        $days = ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'];

        $weekLabels   = [];
        $weekVisitors = [];
        $weekSessions = [];

        foreach ($days as $day) {
            $weekLabels[] = substr($day,0,3);
            $data = $weekData->firstWhere('day', $day);
            $weekVisitors[] = $data ? $data->total : 0;
            $weekSessions[] = $data ? $data->orders : 0;
        }

        // --- Chart Bulanan ---
        $monthData = Transaction::selectRaw('MONTH(created_at) as month, SUM(total) as total, COUNT(*) as orders')
            ->whereYear('created_at', now()->year)
            ->where('status','selesai')
            ->groupBy('month')
            ->get();

        $monthLabels   = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
        $monthVisitors = [];
        $monthSessions = [];

        for ($m = 1; $m <= 12; $m++) {
            $data = $monthData->firstWhere('month', $m);
            $monthVisitors[] = $data ? $data->total : 0;
            $monthSessions[] = $data ? $data->orders : 0;
        }

        return view('dashboard.index', compact(
            'totalSekarang',
            'totalSemua',
            'totalKemarin',
            'persentase',
            'totalOrder',
            'pending',
            'rejected',
            'totalTahunLalu',
            'totalTahunIni',
            'kenaikan',
            'weekLabels',
            'weekSessions',
            'weekVisitors',
            'monthVisitors',
            'monthSessions',
            'monthLabels',
        ));
    }


    public function order()
    {
        $item = Good::all();
        $kodetransaksi = TransactionHelper::generateKodeTransaksi();
        return view('homepage.checkout.order',compact('item', 'kodetransaksi'));
    }
    public function checkout(Request $request)
    {
        $request->validate([
            'items' => 'required|json',
            'paid' => 'required|numeric|min:0',
            'number' => 'string|max:255',
            'customer' => 'required|string|max:255',
            'table_number'=> 'string|max:255',
        ]);

        $items = json_decode($request->items, true);

        if (empty($items)) {
            return back()->with('error', 'Keranjang kosong!');
        }

        DB::beginTransaction();
        try {
            $total = collect($items)->sum(fn($item) => $item['harga'] * $item['qty']);

            $change = $request->paid - $total;

            $transaction = Transaction::create([
                'number' => $request->number,
                'transacted_at' => now(),
                'customer' => $request->customer,
                'table_number' => $request->table_number,
                'total' => $total,
                'paid' => $request->paid,
                'change' => $change,
                'status' => 'pending',
            ]);

            foreach ($items as $item) {
                TransactionItem::create([
                    'transaction_id' => $transaction->id,
                    'good_id' => $item['id'],
                    'price' => $item['harga'],
                    'qty' => $item['qty'],
                    'total' => $item['harga'] * $item['qty'],
                ]);
            }

            DB::commit();

            return redirect()->route('order')->with('success', 'Transaksi berhasil disimpan!');

        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with('error', 'Gagal menyimpan transaksi.');
        }
    }


//    cetak nota
    public function cetakNota($id)
    {
        // Ambil data transaksi, misal:
        $transaction = Transaction::with('items.good')->findOrFail($id);
        $path = public_path('img/qr.png');
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $qr = 'data:image/' . $type . ';base64,' . base64_encode($data);

        $pdf = app('dompdf.wrapper');
        $pdf->loadView('dashboard.transaction.nota', compact('transaction' , 'qr'))
            ->setPaper([0, 0, 226.77, 600], 'portrait');

        return $pdf->stream('nota-transaksi-' . $transaction->id . '.pdf');
    }
    public function notaDownload($id)
    {
        $transaction = Transaction::findOrFail($id);
        $path = public_path('img/qr.png');
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $qr = 'data:image/' . $type . ';base64,' . base64_encode($data);

        $pdf = Pdf::loadView('dashboard.transaction.nota', compact('transaction', 'qr'))
            ->setPaper([0, 0, 226.77, 600], 'portrait');

        return $pdf->download("Invoice-{$transaction->number}.pdf");
    }
}















