@extends('layouts.layout')

@section('content')
    <div class="pc-content">
        <x-breadcrumb>

        </x-breadcrumb>
        <!-- [ Main Content ] start -->
        <div class="row">
            <!-- [ sample-page ] start -->
            <div class="col-md-12 col-xl-4">
                <div class="card">
                    <div class="card-body">
                        <h6 class="mb-2 f-w-400 text-muted">Total Transaksi</h6>
                        <h4 class="mb-3">{{ 'Rp. ' . number_format($totalSemua) }} <span
                                class="badge bg-light-primary border border-primary"><i
                                    class="ti ti-trending-up"></i>{{ number_format($persentase)."%" }}</span></h4>
                        <p class="mb-0 text-muted text-sm">
                            Kenaikan Dari Tahun Lalu
                            <span class="text-primary">{{ number_format($kenaikan) }}</span> this year
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-xl-4">
                <div class="card">
                    <div class="card-body">
                        <h6 class="mb-2 f-w-400 text-muted">Total Hari Ini</h6>
                        <h4 class="mb-3">{{ "Rp. " . number_format($totalSekarang) }}
                        <p class="mb-0 text-muted text-sm">
                            You made an extra
                            <span class="text-success">
                                Rp {{ number_format($totalKemarin, 0, ',', '.') }}
                            </span> today
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-xl-4">
                <div class="card">
                    <div class="card-body">
                        <h6 class="mb-2 f-w-400 text-muted">Total Order</h6>
                        <h4 class="mb-3">{{ $totalOrder }}
                        <p class="mb-0 text-muted text-sm">You made an extra <span class="text-warning">{{ $allorder }}</span>
                            today</p>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-xl-4">
                <div class="card">
                    <div class="card-body">
                        <h6 class="mb-2 f-w-400 text-muted">Total Pesanan Pending</h6>
                        <h4 class="mb-3">{{ number_format($pending) }}
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-xl-4">
                <div class="card">
                    <div class="card-body">
                        <h6 class="mb-2 f-w-400 text-muted">Total Pesanan rejected</h6>
                        <h4 class="mb-3">{{ number_format($rejected) }}
                            <span class="badge bg-light-danger border border-danger"></span></h4>
                    </div>
                </div>
            </div>
            {{--            grapic         --}}
            <div class="col-md-12 col-xl-8">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h5 class="mb-0">Unique Visitor</h5>
                    <ul class="nav nav-pills justify-content-end mb-0" id="chart-tab-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="chart-tab-home-tab" data-bs-toggle="pill"
                                    type="button" role="tab">
                                Month
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="chart-tab-profile-tab" data-bs-toggle="pill"
                                    type="button" role="tab">
                                Week
                            </button>
                        </li>
                    </ul>
                </div>
                <div class="card">
                    <div class="card-body">
                        <!-- cukup satu chart saja -->
                        <div id="visitor-chart"></div>
                    </div>
                </div>
            </div>
            {{--      income overview      --}}
            <div class="col-md-12 col-xl-4">
                <h5 class="mb-3">Income Overview</h5>
                <div class="card">
                    <div class="card-body">
                        <h6 class="mb-2 f-w-400 text-muted">This Week Statistics</h6>
                        <h3 class="mb-3">Rp. {{ number_format($weekIncome) }}</h3>

                        <canvas id="income-overview-chart" height="150"></canvas>
                    </div>
                </div>
            </div>
            {{--            recent         --}}
            <div class="col-md-12 col-xl-8">
                <h5 class="mb-3">Recent Orders</h5>
                <div class="card tbl-card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-borderless mb-0">
                                <thead>
                                <tr>
                                    <th>NO. TRANSAKSI</th>
                                    <th>CUSTOMER</th>
                                    <th>MEJA</th>
                                    <th>STATUS</th>
                                    <th class="text-end">TOTAL</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse ($transactions as $transaction)
                                    <tr>
                                        <td><a href="#" class="text-muted">{{ $transaction->number }}</a></td>
                                        <td>{{ $transaction->customer_name }}</td>
                                        <td>{{ $transaction->table_number ?? '-' }}</td>
                                        <td>
                                    <span class="d-flex align-items-center gap-2">
                                        @if($transaction->status === 'rejected')
                                            <i class="fas fa-circle text-danger f-10 m-r-5"></i> Rejected
                                        @elseif($transaction->status === 'pending')
                                            <i class="fas fa-circle text-warning f-10 m-r-5"></i> Pending
                                        @elseif($transaction->status === 'approved')
                                            <i class="fas fa-circle text-success f-10 m-r-5"></i> Approved
                                        @else
                                            <i class="fas fa-circle text-secondary f-10 m-r-5"></i> {{ ucfirst($transaction->status) }}
                                        @endif
                                    </span>
                                        </td>
                                        <td class="text-end">Rp {{ number_format($transaction->total, 0, ',', '.') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted">Belum ada transaksi</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            {{--        analitycal report    --}}
            <div class="col-md-12 col-xl-4">
                <h5 class="mb-3">Analytics Report</h5>
                <div class="card">
                    <div class="list-group list-group-flush">
                        <a href="#"
                           class="list-group-item list-group-item-action d-flex align-items-center justify-content-between">
                            Company Finance Growth
                            <span class="h5 mb-0">
                    {{ number_format($persentase, 2) }}%
                </span>
                        </a>

                        <a href="#"
                           class="list-group-item list-group-item-action d-flex align-items-center justify-content-between">
                            Company Expenses Ratio
                            <span class="h5 mb-0">
                    {{ $totalOrder > 0 ? number_format(($pending / $totalOrder) * 100, 2) : 0 }}%
                </span>
                        </a>

                        <a href="#"
                           class="list-group-item list-group-item-action d-flex align-items-center justify-content-between">
                            Business Risk Cases
                            <span class="h5 mb-0">
                    {{ $rejected > 0 ? $rejected : 'Low' }}
                </span>
                        </a>
                    </div>
                    <div class="card-body px-2">
                        <div id="analytics-report-chart"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // data dari controller
            const weekVisitors = @json($weekVisitors);
            const weekSessions = @json($weekSessions);
            const weekLabels = @json($weekLabels);

            const monthVisitors = @json($monthVisitors);
            const monthSessions = @json($monthSessions);
            const monthLabels = @json($monthLabels);

            // opsi awal -> pakai data minggu
            let options = {
                chart: {height: 450, type: 'area', toolbar: {show: false}},
                dataLabels: {enabled: false},
                colors: ['#1890ff', '#13c2c2'],
                series: [
                    {name: "Page Views", data: weekVisitors},
                    {name: "Sessions", data: weekSessions}
                ],
                stroke: {curve: 'smooth', width: 2},
                xaxis: {categories: weekLabels}
            };

            let chart = new ApexCharts(document.querySelector("#visitor-chart"), options);
            chart.render();

            // event bootstrap tab
            const tabElList = document.querySelectorAll('button[data-bs-toggle="pill"]');
            tabElList.forEach(function (tabEl) {
                tabEl.addEventListener('shown.bs.tab', function (event) {
                    if (event.target.id === "chart-tab-home-tab") {
                        // kalau klik Month
                        chart.updateOptions({
                            series: [
                                {name: "Page Views", data: monthVisitors},
                                {name: "Sessions", data: monthSessions}
                            ],
                            xaxis: {categories: monthLabels}
                        });
                    } else if (event.target.id === "chart-tab-profile-tab") {
                        // kalau klik Week
                        chart.updateOptions({
                            series: [
                                {name: "Page Views", data: weekVisitors},
                                {name: "Sessions", data: weekSessions}
                            ],
                            xaxis: {categories: weekLabels}
                        });
                    }
                });
            });
        });
    </script>
@endpush
