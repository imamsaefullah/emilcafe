@extends('layouts.layout')

@section('content')
    <div class="pc-content">
        <div class="card shadow-sm">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-bold">🛒 Monitoring Transaksi / Pesanan</h5>
            </div>
            <div class="card-body table-responsive">
                <table id="transactions-table" class="table table-bordered table-striped table-hover align-middle">
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="min-date" class="form-label">Dari Tanggal:</label>
                            <input type="date" id="min-date" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label for="max-date" class="form-label">Sampai Tanggal:</label>
                            <input type="date" id="max-date" class="form-control">
                        </div>
                    </div>
                    <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Waktu</th>
                        <th>No. Transaksi</th>
                        <th>No. Meja</th>
                        <th>Customer</th>
                        <th>Barang</th>
                        <th class="text-end">Total</th>
                        <th class="text-end">Payments</th>
                        <th class="text-end">Status</th>
                        <th>Status Dapur</th>
                        <th class="text-end">Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($transactions as $trx)
                        <tr @if($trx->status != 'selesai') class="table-warning" @endif>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $trx->created_at->format('d/m/Y H:i') }}</td>
                            <td><strong>{{ $trx->number ?? '-' }}</strong></td>
                            <td class="text-center"><strong>{{ $trx->table_number ?? '-' }}</strong></td>
                            <td class="">{{ $trx->customer_name ?? '-' }}</td>
                            <td>
                                <ul class="mb-0 ps-3">
                                    @foreach ($trx->items as $item)
                                        <li>{{ $item->good->nama }} × {{ $item->qty }}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td class="text-end">Rp {{ number_format($trx->total, 0, ',', '.') }}</td>
                            <td class="text-center">
                                @php
                                    $status = $trx->payment_method;
                                    $colors = [
                                        'cash' => 'bg-yellow-100 text-yellow-800',
                                        'qris' => 'bg-blue-100 text-blue-800',
                                    ];
                                @endphp

                                <span class="px-2 py-1 text-sm font-semibold rounded-full {{ $colors[$status] ?? 'bg-gray-100 text-gray-800' }}">
                                    {{ ucfirst($status) }}
                                </span>
                            </td>
                            <td class="text-center">
                                @php
                                    $status = $trx->status;
                                    $colors = [
                                        'pending' => 'bg-yellow-100 text-yellow-800',
                                        'paid' => 'bg-blue-100 text-blue-800',
                                        'siap disajikan' => 'bg-green-100 text-green-800',
                                        'selesai' => 'bg-green-100 text-grey-800',
                                    ];
                                @endphp

                                <span class="px-2 py-1 text-sm font-semibold rounded-full {{ $colors[$status] ?? 'bg-gray-100 text-gray-800' }}">
                                    {{ ucfirst($status) }}
                                </span>
                            </td>
                            <td class="text-center">
                                @php
                                    $status = $trx->statusdapur;
                                    $colors = [
                                        'pending' => 'bg-yellow-100 text-yellow-800',
                                        'rejected' => 'bg-red-100 text-red-800',
                                        'diproses' => 'bg-blue-100 text-blue-800',
                                        'siap disajikan' => 'bg-green-100 text-green-800',
                                        'done' => 'bg-green-100 text-gray-800',
                                    ];
                                @endphp

                                <span class="px-2 py-1 text-sm font-semibold rounded-full {{ $colors[$status] ?? 'bg-gray-100 text-gray-800' }}">
                                    {{ ucfirst($status) }}
                                </span>
                            </td>

                            <td class="text-center">
                                @if ($trx->statusdapur === 'rejected' )
                                    <form action="{{ route('casir.update', $trx->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-sm btn-danger" disabled>
                                            Reject By Dapur
                                        </button>
                                    </form>
                                @elseif ($trx->status !== 'selesai')
                                    <form action="{{ route('casir.update', $trx->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-sm btn-warning">
                                            Tandai Selesai
                                        </button>
                                    </form>
                                @else
                                    <div class="d-flex flex-column align-items-center gap-1">
                                        <span class="badge bg-success">Selesai</span>
                                        <a href="{{ route('nota.cetak', $trx->id) }}" target="_blank" class="btn btn-sm btn-outline-primary w-100">
                                            Cetak Nota
                                        </a>
                                        <a href="{{ route('nota.download', $trx->id) }}" class="btn btn-sm btn-outline-secondary w-100">
                                            Download PDF
                                        </a>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">
                                <em>Belum ada transaksi.</em>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
            const min = $('#min-date').val();
            const max = $('#max-date').val();
            const tanggal = data[1]; // Kolom ke-1 = "Waktu", pastikan index ini sesuai

            if (!tanggal) return false;

            const [tgl, jam] = tanggal.split(' ');
            const [day, month, year] = tgl.split('/');
            const formatTanggal = new Date(`${year}-${month}-${day}`);

            const minDate = min ? new Date(min) : null;
            const maxDate = max ? new Date(max) : null;

            if ((minDate === null || formatTanggal >= minDate) &&
                (maxDate === null || formatTanggal <= maxDate)) {
                return true;
            }

            return false;
        });

        $(document).ready(function () {
            const table = $('#transactions-table').DataTable({
                pageLength: 10,
                stateSave: true,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Cari transaksi...",
                    lengthMenu: "Tampilkan _MENU_ entri",
                    info: "Menampilkan _START_ - _END_ dari _TOTAL_ entri",
                    paginate: {
                        first: "Awal",
                        last: "Akhir",
                        next: "›",
                        previous: "‹"
                    },
                    zeroRecords: "Tidak ada data ditemukan",
                    infoEmpty: "Menampilkan 0 dari 0 entri"
                }
            });

            $('#min-date, #max-date').on('change', function () {
                table.draw();
            });

            @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                confirmButtonColor: '#16a34a'
            });
            @endif
        });
    </script>
@endpush
