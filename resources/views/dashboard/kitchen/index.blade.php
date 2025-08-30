@extends('layouts.layout')
@section('content')
    <div class="container py-4">
        <h1 class="h4 fw-bold mb-3 border-bottom pb-2">
            🍽️ Monitoring Pesanan Dapur <small class="text-muted">(Pending)</small>
        </h1>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                ✅ {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Filter Tanggal --}}
        <div class="card border-light bg-light-subtle shadow-sm mb-4">
            <div class="card-body">
                <form class="row g-3 align-items-end">
                    <div class="col-lg-4">
                        <label for="start_date" class="form-label fw-semibold date-trigger-start">📅 Dari Tanggal</label>
                        <input type="date" id="start_date" class="form-control shadow-sm border-primary">
                    </div>
                    <div class="col-lg-4">
                        <label for="end_date" class="form-label fw-semibold date-trigger-end">📅 Sampai Tanggal</label>
                        <input type="date" id="end_date" class="form-control shadow-sm border-primary">
                    </div>
                    <div class="col-lg-2 d-grid">
                        <button type="button" id="filterBtn" class="btn btn-primary d-flex align-items-center justify-content-center gap-2 shadow-sm py-2">
                            <i class="bi bi-funnel fs-5"></i> <span class="fw-semibold">Filter</span>
                        </button>
                    </div>
                    <div class="col-lg-2 d-grid">
                        <button type="button" id="resetBtn" class="btn btn-outline-secondary d-flex align-items-center justify-content-center gap-2 shadow-sm py-2">
                            <i class="bi bi-arrow-repeat fs-5"></i> <span class="fw-semibold">Reset</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Table --}}
        <div class="card border-0 shadow-sm">
            <div class="card-body table-responsive">
                <table id="kitchen-table" class="table table-hover align-middle w-100">
                    <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Pelanggan</th>
                        <th>Meja</th>
                        <th>Tanggal</th>
                        <th>Menu</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                    </thead>
                    <tbody class="fs-6">
                    @forelse ($orders as $order)
                        <tr>
                            <td class="text-muted">#{{ $order->id }}</td>
                            <td>{{ $order->customer_name }}</td>
                            <td><span class="badge bg-info-subtle text-dark">Meja {{ $order->table_number }}</span></td>
                            <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y') }}</td>
                            <td>
                                <ul class="mb-0 ps-3">
                                    @foreach ($order->items as $item)
                                        <li>{{ $item->good->nama ?? '-' }} × {{ $item->qty }}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>
                            <span class="badge
                                @if ($order->statusdapur === 'done') bg-success-subtle text-success
                                @elseif ($order->statusdapur === 'process') bg-warning-subtle text-dark
                                @elseif ($order->statusdapur === 'rejected') bg-danger-subtle text-danger
                                @else bg-secondary-subtle text-dark
                                @endif">
                                {{ ucfirst($order->statusdapur) }}
                            </span>
                            </td>
                            <td>
                                <form action="{{ url('kitchen/' . $order->id . '/update-status') }}" method="POST" class="d-flex flex-wrap gap-2 justify-content-center">
                                    @csrf
                                    <select name="statusdapur"
                                            @if ($order->statusdapur === 'done') disabled @endif
                                            class="form-select form-select-sm w-auto">
                                        <option value="process" {{ $order->statusdapur === 'process' ? 'selected' : '' }}>Process</option>
                                        <option value="done" {{ $order->statusdapur === 'done' ? 'selected' : '' }}>Done</option>
                                        <option value="rejected" {{ $order->statusdapur === 'rejected' ? 'selected' : '' }}>Rejected</option>
                                    </select>

                                    @php
                                        $isDoneOrRejected = in_array($order->statusdapur, ['done', 'rejected']);
                                    @endphp

                                    @if ($isSuperadmin)
                                        <!-- Superadmin bisa melihat Deleted dan Simpan kapan saja -->
                                        <button type="submit" class="btn btn-sm btn-primary" @if($order->statusdapur === 'done') disabled @endif>
                                            ✅ Simpan
                                        </button>
                                        <a href="#"
                                           onclick="handleDelete({{ $order->id }})"
                                           class="btn btn-sm btn-danger rounded @if($order->statusdapur === 'rejected') disabled pointer-events-none opacity-50 @endif">
                                            🗑️ Deleted
                                        </a>
                                    @elseif ($isAdmin && !$isDoneOrRejected)
                                        <!-- Admin hanya bisa lihat tombol Simpan jika status bukan done/rejected -->
                                        <button type="submit" class="btn btn-sm btn-primary">
                                            ✅ Simpan
                                        </button>
                                    @endif


                                @if ($order->statusdapur === 'done')
                                        <a href="{{ route('kitchen.downloadPdf', $order->id) }}"
                                           class="btn btn-sm btn-outline-danger">
                                            📄 PDF
                                        </a>
                                    @endif
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">Belum ada pesanan masuk 🍜</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Hidden form -->
    <form id="delete-order-{{ $order->id }}" action="{{ url('kitchen/' . $order->id . '/destroy') }}" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>

    {{--    modul pop up   --}}
    <div id="kitchen-alert"
         class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white px-8 py-6 rounded-xl shadow-2xl max-w-md w-full mx-4 text-center space-y-4">
            <div class="text-3xl">🔔</div>
            <div>
                <h2 class="text-xl font-bold text-gray-800">Pesanan Baru!</h2>
                <p class="text-sm text-gray-600 mt-1">Silakan proses pesanan di dapur.</p>
                <div id="kitchen-order-detail" class="text-sm text-left mt-4 text-gray-700 space-y-1">
                    <!-- Detail pesanan akan diisi via JS -->
                </div>
            </div>
            <button onclick="closeKitchenAlert()" class="mt-2 bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-md shadow font-medium">
                OK
            </button>
        </div>
    </div>


@endsection
@push('scripts')

    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <script>
        function handleDelete(orderId) {
            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: "Data tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.getElementById('delete-order-' + orderId);
                    if (form) {
                        form.submit();
                    } else {
                        console.error('Form tidak ditemukan!');
                    }
                }
            });
        }
        $(function () {
            flatpickr("#start_date", {
                dateFormat: "Y-m-d"
            });
            flatpickr("#end_date", {
                dateFormat: "Y-m-d"
            });

            $('.date-trigger-start').on('click', function () {
                $('#start_date').focus();
            });

            $('.date-trigger-end').on('click', function () {
                $('#end_date').focus();
            });

            $('#start_date, #end_date').on('click', function () {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'info',
                    title: 'Pilih tanggal di kalender',
                    showConfirmButton: false,
                    timer: 1500
                });
            });

            // Filter kustom DataTables berdasarkan tanggal
            $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
                const min = $('#start_date').val();
                const max = $('#end_date').val();
                const tanggal = data[3]; // kolom ke-4 (index 3)

                if (!tanggal) return false;

                const [day, month, year] = tanggal.split('/');
                const dateObj = new Date(`${year}-${month}-${day}`);

                const minDate = min ? new Date(min) : null;
                const maxDate = max ? new Date(max) : null;

                if ((minDate === null || dateObj >= minDate) &&
                    (maxDate === null || dateObj <= maxDate)) {
                    return true;
                }

                return false;
            });

            const table = $('#kitchen-table').DataTable({
                pageLength: 10,
                stateSave: true,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Cari pesanan...",
                    lengthMenu: "Tampilkan _MENU_ entri",
                    info: "Menampilkan _START_ - _END_ dari _TOTAL_ entri",
                    paginate: {
                        first: "Awal", last: "Akhir", next: "›", previous: "‹"
                    },
                    zeroRecords: "Tidak ada data ditemukan",
                    infoEmpty: "Menampilkan 0 dari 0 entri"
                }
            });

            $('#filterBtn').on('click', function () {
                table.draw();
                Swal.fire({
                    toast: true,
                    position: 'top',
                    icon: 'success',
                    title: 'Sudah di filter',
                    showConfirmButton: false,
                    timer: 1500
                });
            });

            $('#resetBtn').on('click', function () {
                $('#start_date').val('');
                $('#end_date').val('');
                table.search('').draw();
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'warning',
                    title: 'Tabel Sudah Di Restart',
                    showConfirmButton: false,
                    timer: 1500
                });
            });

            // Inisialisasi Pusher
            Pusher.logToConsole = false;

            const pusher = new Pusher('e8fac26d939db9283f05', {
                cluster: 'ap1',
                forceTLS: true
            });

            const channel = pusher.subscribe('kitchen-channel');

            channel.bind('new-order', function (data) {
                console.log('📢 Pesanan Baru Masuk:', data);
                const order = data.order;

                const audio = new Audio('/sounds/ding.mp3');
                audio.play();

                Swal.fire({
                    icon: 'info',
                    title: '🔔 Pesanan Baru!',
                    html: `
                    <div class="text-left leading-relaxed">
                        <p><strong>Nomor:</strong> ${order.number}</p>
                        <p><strong>Nama:</strong> ${order.customer_name}</p>
                        <p><strong>Meja:</strong> ${order.table_number}</p>
                        <p><strong>Metode:</strong> ${order.payment_method}</p>
                        <p><strong>Total:</strong> Rp ${parseInt(order.total).toLocaleString('id-ID')}</p>
                    </div>
                `,
                    confirmButtonText: 'OK',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    customClass: {
                        popup: 'rounded-lg shadow-lg'
                    }
                }).then(() => {
                    location.reload();
                });

                table.ajax.reload(); // jika pakai AJAX source
            });
        });
    </script>
@endpush
