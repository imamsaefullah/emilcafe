@extends('layouts.layout')

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-6 space-y-10">
        <!-- Penjualan -->
        <div class="bg-white shadow-lg rounded-xl p-6">
            <h2 class="text-2xl font-bold text-gray-700 mb-4">📊 Grafik Penjualan Bulanan</h2>
            <div id="salesChart" class="w-full h-96"></div>
        </div>

        <!-- Kas -->
        <div class="bg-white shadow-lg rounded-xl p-6">
            <h2 class="text-2xl font-bold text-gray-700 mb-4">💰 Grafik Arus Kas Bulanan</h2>
            <div id="kasChart" class="w-full h-96"></div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- ApexCharts -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script>
        // Grafik Penjualan Bulanan (Bar)
        const salesOptions = {
            chart: {
                type: 'bar',
                height: 380,
                toolbar: { show: false },
                fontFamily: 'inherit'
            },
            series: [{
                name: 'Total Penjualan',
                data: @json($penjualanData)
            }],
            xaxis: {
                categories: @json($penjualanLabels),
                labels: { style: { colors: '#374151' } } // text-gray-700
            },
            plotOptions: {
                bar: {
                    borderRadius: 5,
                    columnWidth: '40%',
                }
            },
            colors: ['#22c55e'], // tailwind green-500
            dataLabels: { enabled: false },
            tooltip: {
                y: {
                    formatter: val => "Rp " + val.toLocaleString("id-ID")
                }
            }
        };
        new ApexCharts(document.querySelector("#salesChart"), salesOptions).render();

        // Grafik Arus Kas Bulanan (Line)
        const kasOptions = {
            chart: {
                type: 'line',
                height: 380,
                toolbar: { show: false },
                fontFamily: 'inherit'
            },
            series: [
                {
                    name: 'Kas Masuk',
                    data: @json($kasMasuk)
                },
                {
                    name: 'Kas Keluar',
                    data: @json($kasKeluar)
                }
            ],
            xaxis: {
                categories: @json($kasLabels),
                labels: { style: { colors: '#374151' } }
            },
            colors: ['#3b82f6', '#ef4444'], // blue-500, red-500
            stroke: { curve: 'smooth', width: 3 },
            markers: { size: 4 },
            tooltip: {
                y: {
                    formatter: val => "Rp " + val.toLocaleString("id-ID")
                }
            },
            legend: {
                position: 'top',
                horizontalAlign: 'right',
                labels: { colors: '#374151' }
            }
        };
        new ApexCharts(document.querySelector("#kasChart"), kasOptions).render();
    </script>
@endpush
