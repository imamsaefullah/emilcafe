<nav class="pc-sidebar">
    <div class="navbar-wrapper">
        <div class="m-header">
            <a href="{{ route('dashboard') }}" class="b-brand text-primary">
                <!-- ========   Change your logo from here   ============ -->
{{--                <img src="{{ asset('assets/images/logo-dark.svg')}}" class="img-fluid logo-lg" alt="logo">--}}
{{--                <h6 class="text-2xl font-extrabold text-white bg-rose-500 px-4 py-1 rounded shadow-md shadow-rose-300">Emil Cafe</h6>--}}
                <h6 class="text-3xl font-semibold text-gray-800 tracking-wide">
                    Emil <span class="text-green-800">Cafe</span>
                </h6>

            </a>
        </div>
        <div class="navbar-content">
            <ul class="pc-navbar">
                <li class="pc-item">
                    <a href="{{ route('dashboard') }}" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-dashboard"></i></span>
                        <span class="pc-mtext">Dashboard</span>
                    </a>
                </li>
                <li class="pc-item">
                    <a href="{{ route('casir.index') }}" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-dashboard"></i></span>
                        <span class="pc-mtext">Casir</span>
                    </a>
                </li>
                <li class="pc-item pc-caption">
                    <label>Menu</label>
                    <i class="ti ti-dashboard"></i>
                </li>
                <li class="pc-item">
                    <a href="{{ route('goods.index') }}" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-dashboard"></i></span>
                        <span class="pc-mtext">Goods</span>
                    </a>
                </li>
                <li class="pc-item">
                    <a href="{{ route('transactions.index') }}" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-dashboard"></i></span>
                        <span class="pc-mtext">transactions</span>
                    </a>
                </li>
                <li class="pc-item pc-caption">
                    <label>Setting Pofile</label>
                    <i class="ti ti-dashboard"></i>
                </li>
                <li class="pc-item">
                    <a href="{{ route('profile') }}" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-user"></i></span>
                        <span class="pc-mtext">Profile</span>
                    </a>
                </li>
                <li class="pc-item">
                    <a href="{{ route('superadmin') }}" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-user"></i></span>
                        <span class="pc-mtext">All User</span>
                    </a>
                </li>
                <li class="pc-item pc-caption">
                    <label>Menu Tools PO</label>
                    <i class="ti ti-dashboard"></i>
                </li>
                <li class="pc-item">
                    <a href="{{ route('kitchen.home') }}" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-user"></i></span>
                        <span class="pc-mtext">Kitchen</span>
                    </a>
                </li>
                <li class="pc-item pc-caption">
                    <label>Report</label>
                    <i class="ti ti-dashboard"></i>
                </li>
                <li class="pc-item">
                    <a href="{{ route('report') }}" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-user"></i></span>
                        <span class="pc-mtext">Report</span>
                    </a>
                </li>

                <!-- ========   start Manufakur  ============ -->
{{--                <li class="pc-item">--}}
{{--                    <a href="{{ route('dashboard') }}" class="pc-link">--}}
{{--                        <span class="pc-micon"><i class="ti ti-dashboard"></i></span>--}}
{{--                        <span class="pc-mtext">Dashboard</span>--}}
{{--                    </a>--}}
{{--                </li>--}}

{{--                <li class="pc-item pc-caption">--}}
{{--                    <label>Menu Tools PO</label>--}}
{{--                    <i class="ti ti-dashboard"></i>--}}
{{--                </li>--}}
{{--                <li class="pc-item">--}}
{{--                    <a href="{{ route('purchase.index') }}" class="pc-link">--}}
{{--                        <span class="pc-micon"><i class="ti ti-shopping-cart"></i></span>--}}
{{--                        <span class="pc-mtext">Purchase</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="pc-item">--}}
{{--                    <a href="{{ route('receiving.index') }}" class="pc-link">--}}
{{--                        <span class="pc-micon"><i class="ti ti-receipt"></i></span>--}}
{{--                        <span class="pc-mtext">Reciving Goods</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="pc-item pc-caption">--}}
{{--                    <label>Menu Tools</label>--}}
{{--                    <i class="ti ti-dashboard"></i>--}}
{{--                </li>--}}
{{--                <li class="pc-item">--}}
{{--                    <a href="{{ route('sales_order.index') }}" class="pc-link">--}}
{{--                        <span class="pc-micon"><i class="ti ti-license"></i></span>--}}
{{--                        <span class="pc-mtext">Sales Order</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="pc-item">--}}
{{--                    <a href="{{ route('invoice.index') }}" class="pc-link">--}}
{{--                        <span class="pc-micon"><i class="ti ti-file-invoice"></i></span>--}}
{{--                        <span class="pc-mtext">Invoice</span>--}}
{{--                    </a>--}}
{{--                </li>--}}


{{--                <li class="pc-item pc-caption">--}}
{{--                    <label>Pages</label>--}}
{{--                    <i class="ti ti-news"></i>--}}
{{--                </li>--}}
{{--                <li class="pc-item">--}}
{{--                    <a href="{{ route('cash.index') }}" class="pc-link">--}}
{{--                        <span class="pc-micon"><i class="ti ti-cash"></i></span>--}}
{{--                        <span class="pc-mtext">Cash</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="pc-item">--}}
{{--                    <a href="{{ route('stockhistory.index') }}" class="pc-link">--}}
{{--                        <span class="pc-micon"><i class="ti ti-box"></i></span>--}}
{{--                        <span class="pc-mtext">Stock Goods</span>--}}
{{--                    </a>--}}
{{--                </li>--}}

{{--                <li class="pc-item pc-caption">--}}
{{--                    <label>Other</label>--}}
{{--                    <i class="ti ti-brand-chrome"></i>--}}
{{--                </li>--}}
{{--                <li class="pc-item pc-hasmenu">--}}
{{--                    <a href="#" class="pc-link"><span class="pc-micon"><i class="ti ti-menu"></i></span><span--}}
{{--                            class="pc-mtext">Setting</span><span class="pc-arrow"><i--}}
{{--                                data-feather="chevron-right"></i></span></a>--}}
{{--                    <ul class="pc-submenu">--}}
{{--                        <li class="pc-item"><a class="pc-link" href="{{ route('goods.index') }}">Data Barang</a></li>--}}
{{--                        <li class="pc-item"><a class="pc-link" href="{{ route('supplier.index') }}">Data Supplier</a></li>--}}
{{--                        <li class="pc-item"><a class="pc-link" href="#">Data Account</a></li>--}}
{{--                        <li class="pc-item"><a class="pc-link" href="#">Data Karyawan</a></li>--}}
{{--                    </ul>--}}
{{--                </li>--}}
{{--                <li class="pc-item">--}}
{{--                    <a href="#" class="pc-link">--}}
{{--                        <span class="pc-micon"><i class="ti ti-brand-chrome"></i></span>--}}
{{--                        <span class="pc-mtext">Sample page</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
                {{--                end manufaktur     --}}
            </ul>
        </div>
    </div>
</nav>
