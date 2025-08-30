<?php

namespace App\Helpers;

use App\Models\Transaction;
use Illuminate\Support\Carbon;

class TransactionHelper
{
    public static function generateKodeTransaksi(): string
    {
        $prefix = 'ORDER-';

        // Ambil transaksi terakhir
        $last = Transaction::orderBy('id', 'desc')->first();
        //
        $tanggal = Carbon::now()->format('Ymd-');

        // Jika belum ada transaksi
        $next = $last ? $last->id + 1 : 1;

        // Format dengan 4 digit nol di depan (misal: 0001)
        return $prefix. $tanggal . str_pad($next, 4, '0', STR_PAD_LEFT);
    }
}
