<?php

namespace App\Http\Controllers;
use App\Events\NewOrderEvent;
use App\Helpers\TransactionHelper;
use App\Models\Casir;
use App\Models\TransactionItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Transaction;


class CasirController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $goods = \App\Models\Good::all();
        $orderNumber = TransactionHelper::generateKodeTransaksi();
        return view('dashboard.casir.index', compact('goods', 'orderNumber'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data
        $validated = $request->validate([
            'order_number' => 'required|string|max:255',
            'customer_name'   => 'required|string|max:255',
            'table_number'    => 'required|string|max:50',
            'payment_method'  => 'required|string|in:cash,qris,debit',
            'total'           => 'required|numeric|min:1',
            'items'           => 'required|array|min:1',
            'items.*.id'      => 'required|integer|exists:goods,id',
            'items.*.name'    => 'required|string',
            'items.*.price'   => 'required|numeric|min:0',
            'items.*.qty'     => 'required|integer|min:1',
        ]);

        try {
            DB::beginTransaction();

            // Simpan transaksi utama
            $transaction = Transaction::create([
                'number'         => $validated['order_number'],
                'customer_name'  => $validated['customer_name'],
                'table_number'   => $validated['table_number'],
                'payment_method' => $validated['payment_method'],
                'total'          => $validated['total'],
                'status'         => 'paid',
            ]);

            // Simpan item transaksi
            foreach ($validated['items'] as $item) {
                TransactionItem::create([
                    'transaction_id' => $transaction->id,
                    'good_id'        => $item['id'],
                    'name'           => $item['name'],
                    'price'          => $item['price'],
                    'qty'            => $item['qty'],
                    'total'          => $item['price'] * $item['qty'],
                ]);
            }
            // ✅ Kirim notifikasi ke dapur (Pusher / Reverb)
            event(new \App\Events\NewOrderEvent($transaction));

            DB::commit();


            return response()->json(['message' => 'Checkout berhasil!', 'data' => $transaction], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Terjadi kesalahan saat menyimpan data.', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Casir $casir)
    {
        //
        // Pastikan relasi sudah ada: items → good
        $casir->load('items.good');

        return view('dashboard.casir.show', [
            'sale' => $casir
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Casir $casir)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $transaction = Transaction::findOrFail($id);
        $transaction->status = 'selesai';
        $transaction->save();

        return redirect()->back()->with('success', 'Status transaksi telah diperbarui menjadi selesai.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Casir $casir)
    {
        //
    }
}
