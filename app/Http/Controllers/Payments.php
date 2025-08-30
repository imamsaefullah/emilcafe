<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Support\Facades\DB;
use Midtrans\Snap;
use Midtrans\Config;


class Payments
{
    //
    public function index()
    {
        return view('homepage.checkout.payment');
    }

    // masukan data ke database
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


    public function getSnapToken(Request $request)
    {
        // Validasi minimal
        $request->validate([
            'order_number'  => 'nullable|string',
            'customer_name' => 'required|string',
            'table_number'  => 'required|string',
            'email'         => 'nullable|email',
            'phone'         => 'nullable|string',
            'payment_method'=> 'required|string|in:qris,gopay,bank_transfer,cstore',
            'total'         => 'required|numeric|min:1000',
            'items'         => 'required|array|min:1',
            'items.*.id'    => 'required|integer',
            'items.*.name'  => 'required|string',
            'items.*.price' => 'required|numeric|min:0',
            'items.*.qty'   => 'required|integer|min:1',
        ]);

        // Konfigurasi Midtrans
        Config::$serverKey    = config('services.midtrans.serverKey');
        Config::$clientKey    = config('services.midtrans.clientKey');
        Config::$isProduction = config('services.midtrans.isProduction', false);
        Config::$isSanitized  = true;
        Config::$is3ds        = true;

        // Siapkan item_details
        $items = collect($request->items)->map(function ($item) {
            return [
                'id'       => $item['id'],
                'price'    => $item['price'],
                'quantity' => $item['qty'],
                'name'     => $item['name'],
            ];
        })->toArray();

        // Parameter Snap dinamis
        $params = [
            'transaction_details' => [
                'order_id'     => $request->order_number,
                'gross_amount' => $request->total
            ],
            'customer_details' => [
                'first_name' => $request->customer_name,
                'email'      => $request->email ?? 'default@emilcafe.test',
                'phone'      => $request->phone ?? '08123456789',
                'billing_address' => [
                    'first_name' => $request->customer_name,
                    'address'    => 'Meja ' . $request->table_number,
                    'city'       => 'Jakarta',
                    'postal_code'=> '12345',
                    'phone'      => $request->phone ?? '08123456789',
                    'country_code' => 'IDN'
                ]
            ],
            'enabled_payments' => [$request->payment_method],
            'item_details'     => $items,
        ];

        try {
            $snapToken = Snap::getSnapToken($params);
            return response()->json(['token' => $snapToken]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal mengambil Snap token',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }


}
