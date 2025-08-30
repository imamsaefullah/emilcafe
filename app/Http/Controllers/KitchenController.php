<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class KitchenController
{
    public function index()
    {
        $orders = Transaction::all();
        $isSuperadmin = Auth::user()->role === "superadmin";
        $isAdmin = Auth::user()->role === "admin";

        return view('dashboard.kitchen.index', compact('orders', 'isSuperadmin', 'isAdmin'));
    }

    public function show($id)
    {
        $order = Transaction::findOrFail($id);
        return view('dashboard.kitchen.show', compact('order'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'statusdapur' => 'required|in:done,process,rejected'
        ]);

        $order = Transaction::findOrFail($id);
        $order->statusdapur = $request->statusdapur;
        $order->save();

        return redirect()->route('kitchen.home')->with('success', 'Status updated!');
    }

    //download pdf
    public function downloadPdf($id)
    {
        $order = Transaction::with('items.good')->findOrFail($id);

        $pdf = Pdf::loadView('pdf.kitchen-order', compact('order'))
            ->setPaper([0, 0, 250, 600], 'portrait'); // ukuran dalam poin (1 inch = 72 poin)

        return $pdf->download('pesanan_dapur_' . $order->id . '.pdf');
    }
    public function destroy($id)
    {
        $order = Transaction::find($id);

        // Cek apakah data ada
        if (!$order) {
            return redirect()->back()->with('error', 'Pesanan tidak ditemukan.');
        }

        // Optional: hanya bisa dihapus jika belum selesai
        if ($order->statusdapur === 'done') {
            return redirect()->back()->with('error', 'Pesanan sudah selesai dan tidak bisa dihapus.');
        }

        // Hapus relasi item jika ada (misal: order->items)
        // $order->items()->delete(); // uncomment jika kamu punya relasi ke item

        // Hapus pesanan
        $order->delete();

        return redirect()->back()->with('success', 'Pesanan berhasil dihapus.');
    }

}
