@extends('layouts.layout')

@section('content')
    <div class="pc-content">
        <x-breadcrumb>

        </x-breadcrumb>
        <!-- [ Main Content ] start -->
        <div class="row">
            <!-- [ sample-page ] start -->
            <div class="col-md-6 col-xl-2">
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
            <div class="col-md-6 col-xl-2">
                <div class="card">
                    <div class="card-body">
                        <h6 class="mb-2 f-w-400 text-muted">Total Hari Ini</h6>
                        <h4 class="mb-3">{{ "Rp. " . number_format($totalSekarang) }}
                            <span class="badge bg-light-success border border-success"><i
                                    class="ti ti-trending-up"></i> 70.5%</span></h4>
                        <p class="mb-0 text-muted text-sm">
                            You made an extra
                            <span class="text-success">
                                Rp {{ number_format($totalKemarin, 0, ',', '.') }}
                            </span> this year
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-2">
                <div class="card">
                    <div class="card-body">
                        <h6 class="mb-2 f-w-400 text-muted">Total Order</h6>
                        <h4 class="mb-3">{{ $totalOrder }}
                            <span class="badge bg-light-warning border border-warning"><i
                                    class="ti ti-trending-down"></i>27.4%</span></h4>
                        <p class="mb-0 text-muted text-sm">You made an extra <span class="text-warning">1,943</span>
                            this year</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-2">
                <div class="card">
                    <div class="card-body">
                        <h6 class="mb-2 f-w-400 text-muted">Total Pesanan Pending</h6>
                        <h4 class="mb-3">{{ number_format($pending) }}
                            <span class="badge bg-light-danger border border-danger"><i
                                    class="ti ti-trending-down"></i> 27.4%</span></h4>
                        <p class="mb-0 text-muted text-sm">You made an extra <span class="text-danger">$20,395</span>
                            this year
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-2">
                <div class="card">
                    <div class="card-body">
                        <h6 class="mb-2 f-w-400 text-muted">Total Pesanan rejected</h6>
                        <h4 class="mb-3">{{ number_format($rejected) }}
                            <span class="badge bg-light-danger border border-danger"><i
                                    class="ti ti-trending-down"></i> 27.4%</span></h4>
                        <p class="mb-0 text-muted text-sm">You made an extra <span class="text-danger">$20,395</span>
                            this year
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-2">
                <div class="card">
                    <div class="card-body">
                        <h6 class="mb-2 f-w-400 text-muted">Total Pesanan rejected</h6>
                        <h4 class="mb-3">{{ number_format($rejected) }}
                            <span class="badge bg-light-danger border border-danger"><i
                                    class="ti ti-trending-down"></i> 27.4%</span></h4>
                        <p class="mb-0 text-muted text-sm">You made an extra <span class="text-danger">$20,395</span>
                            this year
                        </p>
                    </div>
                </div>
            </div>
            {{--            grapic              --}}
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
                        <h3 class="mb-3">$7,650</h3>
                        <div id="income-overview-chart"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-xl-8">
                <h5 class="mb-3">Recent Orders</h5>
                <div class="card tbl-card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-borderless mb-0">
                                <thead>
                                <tr>
                                    <th>TRACKING NO.</th>
                                    <th>PRODUCT NAME</th>
                                    <th>TOTAL ORDER</th>
                                    <th>STATUS</th>
                                    <th class="text-end">TOTAL AMOUNT</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><a href="#" class="text-muted">84564564</a></td>
                                    <td>Camera Lens</td>
                                    <td>40</td>
                                    <td><span class="d-flex align-items-center gap-2"><i
                                                class="fas fa-circle text-danger f-10 m-r-5"></i>Rejected</span>
                                    </td>
                                    <td class="text-end">$40,570</td>
                                </tr>
                                <tr>
                                    <td><a href="#" class="text-muted">84564564</a></td>
                                    <td>Laptop</td>
                                    <td>300</td>
                                    <td><span class="d-flex align-items-center gap-2"><i
                                                class="fas fa-circle text-warning f-10 m-r-5"></i>Pending</span>
                                    </td>
                                    <td class="text-end">$180,139</td>
                                </tr>
                                <tr>
                                    <td><a href="#" class="text-muted">84564564</a></td>
                                    <td>Mobile</td>
                                    <td>355</td>
                                    <td><span class="d-flex align-items-center gap-2"><i
                                                class="fas fa-circle text-success f-10 m-r-5"></i>Approved</span></td>
                                    <td class="text-end">$180,139</td>
                                </tr>
                                <tr>
                                    <td><a href="#" class="text-muted">84564564</a></td>
                                    <td>Camera Lens</td>
                                    <td>40</td>
                                    <td><span class="d-flex align-items-center gap-2"><i
                                                class="fas fa-circle text-danger f-10 m-r-5"></i>Rejected</span>
                                    </td>
                                    <td class="text-end">$40,570</td>
                                </tr>
                                <tr>
                                    <td><a href="#" class="text-muted">84564564</a></td>
                                    <td>Laptop</td>
                                    <td>300</td>
                                    <td><span class="d-flex align-items-center gap-2"><i
                                                class="fas fa-circle text-warning f-10 m-r-5"></i>Pending</span>
                                    </td>
                                    <td class="text-end">$180,139</td>
                                </tr>
                                <tr>
                                    <td><a href="#" class="text-muted">84564564</a></td>
                                    <td>Mobile</td>
                                    <td>355</td>
                                    <td><span class="d-flex align-items-center gap-2"><i
                                                class="fas fa-circle text-success f-10 m-r-5"></i>Approved</span></td>
                                    <td class="text-end">$180,139</td>
                                </tr>
                                <tr>
                                    <td><a href="#" class="text-muted">84564564</a></td>
                                    <td>Camera Lens</td>
                                    <td>40</td>
                                    <td><span class="d-flex align-items-center gap-2"><i
                                                class="fas fa-circle text-danger f-10 m-r-5"></i>Rejected</span>
                                    </td>
                                    <td class="text-end">$40,570</td>
                                </tr>
                                <tr>
                                    <td><a href="#" class="text-muted">84564564</a></td>
                                    <td>Laptop</td>
                                    <td>300</td>
                                    <td><span class="d-flex align-items-center gap-2"><i
                                                class="fas fa-circle text-warning f-10 m-r-5"></i>Pending</span>
                                    </td>
                                    <td class="text-end">$180,139</td>
                                </tr>
                                <tr>
                                    <td><a href="#" class="text-muted">84564564</a></td>
                                    <td>Mobile</td>
                                    <td>355</td>
                                    <td><span class="d-flex align-items-center gap-2"><i
                                                class="fas fa-circle text-success f-10 m-r-5"></i>Approved</span></td>
                                    <td class="text-end">$180,139</td>
                                </tr>
                                <tr>
                                    <td><a href="#" class="text-muted">84564564</a></td>
                                    <td>Mobile</td>
                                    <td>355</td>
                                    <td><span class="d-flex align-items-center gap-2"><i
                                                class="fas fa-circle text-success f-10 m-r-5"></i>Approved</span></td>
                                    <td class="text-end">$180,139</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-xl-4">
                <h5 class="mb-3">Analytics Report</h5>
                <div class="card">
                    <div class="list-group list-group-flush">
                        <a href="#"
                           class="list-group-item list-group-item-action d-flex align-items-center justify-content-between">Company
                            Finance Growth<span class="h5 mb-0">+45.14%</span></a>
                        <a href="#"
                           class="list-group-item list-group-item-action d-flex align-items-center justify-content-between">Company
                            Expenses Ratio<span class="h5 mb-0">0.58%</span></a>
                        <a href="#"
                           class="list-group-item list-group-item-action d-flex align-items-center justify-content-between">Business
                            Risk Cases<span class="h5 mb-0">Low</span></a>
                    </div>
                    <div class="card-body px-2">
                        <div id="analytics-report-chart"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-xl-8">
                <h5 class="mb-3">Sales Report</h5>
                <div class="card">
                    <div class="card-body">
                        <h6 class="mb-2 f-w-400 text-muted">This Week Statistics</h6>
                        <h3 class="mb-0">$7,650</h3>
                        <div id="sales-report-chart"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-xl-4">
                <h5 class="mb-3">Transaction History</h5>
                <div class="card">
                    <div class="list-group list-group-flush">
                        <a href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <div class="avtar avtar-s rounded-circle text-success bg-light-success">
                                        <i class="ti ti-gift f-18"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-1">Order #002434</h6>
                                    <p class="mb-0 text-muted">Today, 2:00 AM</P>
                                </div>
                                <div class="flex-shrink-0 text-end">
                                    <h6 class="mb-1">+ $1,430</h6>
                                    <p class="mb-0 text-muted">78%</P>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <div class="avtar avtar-s rounded-circle text-primary bg-light-primary">
                                        <i class="ti ti-message-circle f-18"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-1">Order #984947</h6>
                                    <p class="mb-0 text-muted">5 August, 1:45 PM</P>
                                </div>
                                <div class="flex-shrink-0 text-end">
                                    <h6 class="mb-1">- $302</h6>
                                    <p class="mb-0 text-muted">8%</P>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <div class="avtar avtar-s rounded-circle text-danger bg-light-danger">
                                        <i class="ti ti-settings f-18"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-1">Order #988784</h6>
                                    <p class="mb-0 text-muted">7 hours ago</P>
                                </div>
                                <div class="flex-shrink-0 text-end">
                                    <h6 class="mb-1">- $682</h6>
                                    <p class="mb-0 text-muted">16%</P>
                                </div>
                            </div>
                        </a>
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
            const weekVisitors  = @json($weekVisitors);
            const weekSessions  = @json($weekSessions);
            const weekLabels    = @json($weekLabels);

            const monthVisitors = @json($monthVisitors);
            const monthSessions = @json($monthSessions);
            const monthLabels   = @json($monthLabels);

            // opsi awal -> pakai data minggu
            let options = {
                chart: { height: 450, type: 'area', toolbar: { show: false } },
                dataLabels: { enabled: false },
                colors: ['#1890ff', '#13c2c2'],
                series: [
                    { name: "Page Views", data: weekVisitors },
                    { name: "Sessions", data: weekSessions }
                ],
                stroke: { curve: 'smooth', width: 2 },
                xaxis: { categories: weekLabels }
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
                                { name: "Page Views", data: monthVisitors },
                                { name: "Sessions", data: monthSessions }
                            ],
                            xaxis: { categories: monthLabels }
                        });
                    } else if (event.target.id === "chart-tab-profile-tab") {
                        // kalau klik Week
                        chart.updateOptions({
                            series: [
                                { name: "Page Views", data: weekVisitors },
                                { name: "Sessions", data: weekSessions }
                            ],
                            xaxis: { categories: weekLabels }
                        });
                    }
                });
            });
        });
    </script>
@endpush
