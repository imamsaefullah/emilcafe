<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController
{
    //
    public function index(){
        // Contoh data penjualan per bulan
        $monthlySales = DB::table('transactions')
            ->selectRaw('MONTH(created_at) as month, SUM(total) as total')
            ->groupByRaw('MONTH(created_at)')
            ->orderByRaw('MONTH(created_at)')
            ->get();

        $labels = $monthlySales->pluck('month')->map(function ($m) {
            return \Carbon\Carbon::create()->month($m)->format('F');
        });

        $data = $monthlySales->pluck('total');
        $penjualanLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'];
        $penjualanData = [1000000, 1500000, 1200000, 1800000, 1700000, 2100000];

        $kasLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'];
        $kasMasuk = [2000000, 2500000, 2300000, 2200000, 2600000, 2800000];
        $kasKeluar = [1500000, 1800000, 1600000, 1700000, 1900000, 2000000];

        return view('dashboard.report.index', compact(
            'penjualanLabels', 'penjualanData',
            'kasLabels', 'kasMasuk', 'kasKeluar'
        ));

        return view('dashboard.report.index', [
            'labels' => $labels,
            'data' => $data,
        ]);
    }
}
