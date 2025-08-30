@extends('layouts.layout')
@push('style')
    <style>
        @keyframes scale-in {
            0% { transform: scale(0.9); opacity: 0; }
            100% { transform: scale(1); opacity: 1; }
        }
        .animate-scale-in {
            animation: scale-in 0.2s ease-out forwards;
        }
    </style>

@endpush

@section('content')
    <div class="min-h-screen w-full mx-auto py-6 px-4">
        <form id="kasir-form">
            @csrf

            {{-- Wrapper Card --}}
            <div class="bg-white shadow-lg rounded-xl border border-gray-200 p-6">

                <div class="grid md:grid-cols-2 gap-6">
                    {{-- === Daftar Barang === --}}
                    <div>
                        <div class="mb-4">
                            <h2 class="text-lg font-semibold text-emerald-700 mb-4">🧾 Daftar Barang</h2>
                            <input type="text" id="search-barang" placeholder="🔍 Cari nama barang..."
                                   class="w-full px-4 py-2 border rounded focus:ring-2 focus:ring-emerald-400">
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 max-h-[720px] overflow-scroll pr-2">
                            @foreach ($goods as $good)
                                <div class="border rounded-lg hover:ring-2 ring-emerald-400 cursor-pointer transition select-item"
                                     data-id="{{ $good->id }}"
                                     data-name="{{ $good->nama }}"
                                     data-price="{{ $good->harga_jual }}">
                                    @if ($good->gambar)
                                        <img src="{{ asset('storage/' . $good->gambar) }}"
                                             class="w-full h-32 object-cover rounded-t">
                                    @endif
                                    <div class="p-3">
                                        <h6 class="text-sm font-semibold">{{ $good->nama }}</h6>
                                        <p class="text-emerald-600 text-sm">Rp {{ number_format($good->harga_jual) }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- === Keranjang Belanja === --}}
                    <div>
                        <h2 class="text-lg font-semibold text-emerald-700 mb-4">🛒 Keranjang Belanja</h2>

                        <div class="grid grid-cols-2 gap-3 mb-4">
                            <div>
                                <label class="text-sm font-medium text-gray-600">No Transaksi</label>
                                <input type="text" name="order_number" value="{{ $orderNumber }}"
                                       class="w-full border bg-gray-100 rounded px-3 py-2" readonly>
                            </div>
                            <div>
                                <label class="text-sm font-medium text-gray-600">Nama Pelanggan</label>
                                <input type="text" name="customer_name" class="w-full border rounded px-3 py-2" required>
                            </div>
                            <div>
                                <label class="text-sm font-medium text-gray-600">Nomor Meja</label>
                                <input type="text" id="table_number" name="table_number"
                                       class="w-full border rounded px-3 py-2 bg-gray-100 cursor-pointer"
                                       placeholder="Klik untuk pilih meja" readonly required>
                            </div>
                            <div>
                                <label class="text-sm font-medium text-gray-600">Metode Pembayaran</label>
                                <select name="payment_method" class="w-full border rounded px-3 py-2" required>
                                    <option value="">-- Pilih --</option>
                                    <option value="cash">Tunai</option>
                                    <option value="qris">QRIS</option>
                                    <option value="debit">Debit</option>
                                </select>
                            </div>
                        </div>

                        {{-- Tabel Keranjang --}}
                        <div class="overflow-x-auto mb-3 border border-gray-200 rounded">
                            <table class="w-full text-sm">
                                <thead class="bg-gray-100 text-left">
                                <tr>
                                    <th class="p-2 border">Barang</th>
                                    <th class="p-2 border w-16">Qty</th>
                                    <th class="p-2 border">Harga</th>
                                    <th class="p-2 border">Total</th>
                                    <th class="p-2 border w-10"></th>
                                </tr>
                                </thead>
                                <tbody id="cart-table"></tbody>
                                <tfoot>
                                <tr class="bg-lime-100 font-semibold">
                                    <td colspan="3" class="p-2 border text-right">Total</td>
                                    <td colspan="2" class="p-2 border" id="total">Rp 0</td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="grid grid-cols-2 gap-3 mt-4">
                            <div>
                                <label class="text-sm font-medium text-gray-600">Dibayar</label>
                                <input type="number" id="paid" class="w-full border rounded px-3 py-2">
                            </div>
                            <div>
                                <label class="text-sm font-medium text-gray-600">Kembalian</label>
                                <input type="text" id="kembalian" class="w-full border bg-gray-100 rounded px-3 py-2" readonly>
                            </div>
                        </div>

                        <input type="hidden" name="items" id="items-json">
                        <input type="hidden" name="total" id="total-value">

                        <div class="text-right mt-4">
                            <button type="submit"
                                    class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-500 text-white rounded hover:bg-emerald-600 transition">
                                <i class="ti ti-check"></i> Simpan Transaksi
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>
    <!-- Modal Pilih Meja -->
    <div id="tableModal" class="fixed inset-0 z-50 bg-black/40 hidden items-center justify-center">
        <div class="bg-white rounded-2xl shadow-2xl w-[90%] max-w-md p-6 relative animate-scale-in">
            <!-- Header -->
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-semibold text-gray-800 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                    </svg>
                    Pilih Nomor Meja
                </h2>
                <button id="closeTableModal" class="text-gray-500 hover:text-red-600 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <!-- List Meja -->
            <div class="grid grid-cols-3 sm:grid-cols-4 gap-4">
                @for ($i = 1; $i <= 12; $i++)
                    <button type="button"
                            class="table-option bg-gray-100 hover:bg-green-100 text-gray-800 font-medium py-3 rounded-xl shadow-sm hover:shadow-md transition flex flex-col items-center gap-1"
                            data-value="{{ $i }}">
                        <span class="text-xl">🍽️</span>
                        <span class="text-sm font-semibold">Meja {{ $i }}</span>
                    </button>
                @endfor
            </div>
        </div>
    </div>
    <!-- Modal Konfirmasi -->
    <div id="confirmModal" class="fixed inset-0 z-50 bg-black/50 hidden items-center justify-center">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md p-6 animate-scale-in">
            <!-- Header -->
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-bold text-emerald-600 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 12h6m-3-3v6m9-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Konfirmasi Transaksi
                </h2>
                <button id="cancelSubmit" class="text-gray-500 hover:text-red-600 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <!-- Konten -->
            <div class="text-sm text-gray-800 space-y-2">
                <div class="flex justify-between">
                    <span class="font-medium text-gray-600">No. Transaksi:</span>
                    <span id="preview-order-number" class="font-semibold"></span>
                </div>
                <div class="flex justify-between">
                    <span class="font-medium text-gray-600">Nama Pelanggan:</span>
                    <span id="preview-customer" class="font-semibold"></span>
                </div>
                <div class="flex justify-between">
                    <span class="font-medium text-gray-600">Meja:</span>
                    <span id="preview-table" class="font-semibold"></span>
                </div>
                <div class="flex justify-between">
                    <span class="font-medium text-gray-600">Metode Pembayaran:</span>
                    <span id="preview-payment" class="font-semibold uppercase"></span>
                </div>
                <div class="flex justify-between text-lg font-bold text-emerald-600 border-t pt-2 mt-2">
                    <span>Total:</span>
                    <span id="preview-total"></span>
                </div>
                <hr class="my-3">
                <div>
                    <p class="font-medium text-gray-600 mb-1">Detail Pesanan:</p>
                    <ul id="preview-items" class="space-y-1 pl-4 list-disc text-gray-700 text-sm"></ul>
                </div>
            </div>

            <!-- Tombol -->
            <div class="flex justify-end gap-3 mt-6">
                <button id="cancelSubmit"
                        class="px-4 py-2 rounded-lg border border-gray-300 hover:bg-gray-100 transition">
                    Batal
                </button>
                <button id="confirmSubmit"
                        class="px-4 py-2 rounded-lg bg-emerald-600 text-white hover:bg-emerald-700 transition font-semibold">
                    Konfirmasi & Kirim
                </button>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
    <script>
        // Klik input = buka modal meja
        $('#table_number').on('click', function () {
            $('#tableModal').removeClass('hidden').addClass('flex');
        });

        // Klik tombol close (X) = tutup modal
        $('#closeTableModal').on('click', function () {
            $('#tableModal').addClass('hidden').removeClass('flex');
        });

        // Klik salah satu meja
        $('.table-option').on('click', function () {
            const meja = $(this).data('value');
            $('#table_number').val(meja);
            $('#tableModal').addClass('hidden').removeClass('flex');
        });

        // Klik di luar modal = tutup (opsional UX)
        $(document).on('click', function (e) {
            if ($(e.target).is('#tableModal')) {
                $('#tableModal').addClass('hidden').removeClass('flex');
            }
        });

        // hitung kembalian
        function hitungKembalian() {
            const total = cart.reduce((sum, item) => sum + (item.qty * item.price), 0);
            const paid = parseInt($('#paid').val()) || 0;
            const change = paid - total;

            $('#kembalian').val('Rp ' + change.toLocaleString('id-ID'));
        }



        let cart = [];

        // Tambah item ke keranjang
        $(document).on('click', '.select-item', function () {
            const id = $(this).data('id');
            const name = $(this).data('name');
            const price = $(this).data('price');

            const existing = cart.find(item => item.id === id);
            if (existing) {
                existing.qty++;
            } else {
                cart.push({ id, name, price, qty: 1 });
            }
            hitungKembalian();
            renderCart();
        });

        // Render isi keranjang
        function renderCart() {
            let tbody = '';
            let total = 0;

            cart.forEach((item, index) => {
                const itemTotal = item.qty * item.price;
                total += itemTotal;

                tbody += `
                <tr>
                    <td class="p-2 border">${item.name}</td>
                    <td class="p-2 border">
                        <input type="number" min="1" class="qty w-16 border rounded px-2 py-1" data-index="${index}" value="${item.qty}">
                    </td>
                    <td class="p-2 border">Rp ${Number(item.price).toLocaleString('id-ID')}</td>
                    <td class="p-2 border">Rp ${Number(itemTotal).toLocaleString('id-ID')}</td>
                    <td class="p-2 border text-center">
                        <button type="button" class="remove text-red-600" data-index="${index}">&times;</button>
                    </td>
                </tr>
            `;
            });

            $('#cart-table').html(tbody);
            $('#total').text('Rp ' + total.toLocaleString('id-ID'));
            $('#total-value').val(total);
            $('#items-json').val(JSON.stringify(cart));
        }

        // Hapus item
        $(document).on('click', '.remove', function () {
            const index = $(this).data('index');
            cart.splice(index, 1);
            renderCart();
        });
        //hitung
        $('#paid').on('input', function () {
            hitungKembalian();
            renderCart();
        });

        // Ubah qty
        $(document).on('input', '.qty', function () {
            const index = $(this).data('index');
            cart[index].qty = parseInt($(this).val()) || 1;
            renderCart();
        });

        let formData = {}; // global cache

        $('#kasir-form').on('submit', function (e) {
            e.preventDefault();

            // Ambil data form
            const orderNumber = $('input[name="order_number"]').val();
            const customerName = $('input[name="customer_name"]').val();
            const tableNumber = $('input[name="table_number"]').val();
            const paymentMethod = $('select[name="payment_method"]').val();
            const total = parseInt($('#total-value').val());
            const items = cart;

            // Simpan sementara
            formData = {
                order_number: orderNumber,
                customer_name: customerName,
                table_number: tableNumber,
                payment_method: paymentMethod,
                total: total,
                items: items
            };

            // Isi preview
            $('#preview-order-number').text(orderNumber);
            $('#preview-customer').text(customerName);
            $('#preview-table').text(tableNumber);
            $('#preview-payment').text(paymentMethod.toUpperCase());
            $('#preview-total').text(`Rp ${total.toLocaleString('id-ID')}`);

            $('#preview-items').empty();
            items.forEach(item => {
                $('#preview-items').append(`<li>${item.name} x${item.qty} @ Rp ${item.price.toLocaleString('id-ID')}</li>`);
            });

            // Tampilkan modal
            $('#confirmModal').removeClass('hidden').addClass('flex');
        });

        // Tombol batal
        $('#cancelSubmit').on('click', function () {
            $('#confirmModal').addClass('hidden').removeClass('flex');
        });

        // Tombol konfirmasi & kirim
        $('#confirmSubmit').on('click', function () {
            $.ajax({
                url: "{{ route('casir.store') }}",
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                contentType: 'application/json',
                data: JSON.stringify(formData),
                success: function (res) {
                    Swal.fire('Berhasil', res.message, 'success').then(() => {
                        location.reload();
                    });
                },
                error: function (xhr) {
                    const error = xhr.responseJSON?.message || 'Terjadi kesalahan saat menyimpan data';
                    Swal.fire('Gagal', error, 'error');
                },
                complete: function () {
                    $('#confirmModal').addClass('hidden').removeClass('flex');
                }
            });
        });


        // Pencarian barang
        $('#search-barang').on('input', function () {
            const keyword = $(this).val().toLowerCase();
            $('.select-item').each(function () {
                const nama = $(this).data('name').toLowerCase();
                $(this).toggle(nama.includes(keyword));
            });
        });

    </script>
@endpush
