<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Pembayaran | Emil Store</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-100 min-h-screen p-4">

<div class="max-w-3xl mx-auto mt-8 bg-white shadow-md rounded-xl p-6">
    <h1 class="text-2xl font-bold text-green-600 mb-4">💳 Proses Pembayaran</h1>

    <!-- Informasi Pelanggan -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
        <div>
            <label class="block text-sm text-gray-600 mb-1">Nama Pelanggan</label>
            <input type="text" id="payment_customer_name" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100" readonly>
        </div>
        <div>
            <label class="block text-sm text-gray-600 mb-1">Nomor Meja</label>
            <input type="text" id="payment_table_number" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100" readonly>
        </div>
    </div>

    <!-- Ringkasan Pesanan -->
    <div class="mb-6">
        <h2 class="text-lg font-semibold text-gray-700 mb-2">🧾 Ringkasan Pesanan</h2>
        <ul id="payment_order_list" class="divide-y divide-gray-200 mb-2"></ul>
        <div class="text-right font-bold text-lg text-gray-800 mt-4">
            Total: <span id="payment_total">Rp 0</span>
        </div>
    </div>

    <!-- Metode Pembayaran -->
    <div class="mb-6">
        <label for="payment_method" class="block text-sm text-gray-600 mb-1">Metode Pembayaran</label>
        <select id="payment_method" class="w-full px-3 py-2 border border-gray-300 rounded-md">
            <option value="">-- Pilih --</option>
            <option value="cash">Tunai</option>
            <option value="qris">QRIS</option>
            <option value="debit">Debit</option>
        </select>
    </div>

    <!-- Tombol Bayar -->
    <button id="pay-now"
            class="w-full py-3 bg-green-600 text-white font-semibold rounded-md hover:bg-green-700 transition">
        💰 Bayar Sekarang
    </button>
</div>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="Mid-client-0aMYZNsYUFfD_gnh"></script>
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function () {
        // Ambil data dari localStorage
        const customer = localStorage.getItem('customer_name') || '-';
        const table = localStorage.getItem('table_number') || '-';
        const cart = JSON.parse(localStorage.getItem('cart') || '[]');

        // Tampilkan ke HTML
        $('#display-name').text(customer);
        $('#display-table').text(table);

        // Set value ke input tersembunyi/form jika ada
        $('#payment_customer_name').val(customer);
        $('#payment_table_number').val(table);

        // Tampilkan list barang
        const $list = $('#payment_order_list');
        let total = 0;

        if (cart.length === 0) {
            $list.append('<li class="text-center text-gray-400 py-4">Keranjang kosong.</li>');
        } else {
            cart.forEach(item => {
                total += item.price * item.qty;
                $list.append(`
                    <li class="flex justify-between items-center py-2 text-sm">
                        <div>${item.name} × ${item.qty}</div>
                        <div class="font-medium text-right">Rp ${(item.price * item.qty).toLocaleString()}</div>
                    </li>
                `);
            });
        }

        $('#payment_total').text('Rp ' + total.toLocaleString());

        // Tombol Bayar
        $('#pay-now').on('click', function () {
            const method = $('#payment_method').val();
            const customer = localStorage.getItem('customer_name') || '-';
            const table = localStorage.getItem('table_number') || '-';
            const cart = JSON.parse(localStorage.getItem('cart') || '[]');
            const order_number = localStorage.getItem('order_number');

            if (!method) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Pilih Metode Pembayaran!',
                    text: 'Silakan pilih metode pembayaran terlebih dahulu.',
                    confirmButtonColor: '#16a34a'
                });
                return;
            }

            if (cart.length === 0) {
                Swal.fire({
                    icon: 'info',
                    title: 'Keranjang Kosong!',
                    text: 'Tidak ada item dalam keranjang.',
                    confirmButtonColor: '#16a34a'
                });
                return;
            }

            const total = cart.reduce((sum, item) => sum + item.price * item.qty, 0);

            const checkoutData = {
                order_number: order_number,
                customer_name: customer,
                table_number: table,
                items: cart,
                payment_method: method,
                total: total
            };

            console.log('Checkout Data:', checkoutData);

            if (method === 'cash') {
                const paymentUrl = "{{ route('payments.store') }}";

                $.ajax({
                    url: paymentUrl,
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    contentType: 'application/json',
                    data: JSON.stringify(checkoutData),
                    success: function (response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Checkout Berhasil!',
                            text: 'Transaksi berhasil disimpan.',
                            confirmButtonColor: '#16a34a'
                        }).then(() => {
                            localStorage.clear();
                            window.location.href = '{{ route('order') }}';
                        });
                    },
                    error: function (xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal Checkout!',
                            text: 'Silakan periksa koneksi atau coba lagi.',
                            confirmButtonColor: '#dc2626'
                        });
                        console.error('Error:', error);
                        console.log('Response:', xhr.responseText);
                    }
                });
            }

            else if (method === 'qris') {
                const snapUrl = "{{ route('payments.getSnapToken') }}";

                $.ajax({
                    url: snapUrl,
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: checkoutData,
                    success: function (response) {
                        snap.pay(response.token, {
                            onSuccess: function (result) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Pembayaran Berhasil!',
                                    text: 'Transaksi QRIS berhasil dilakukan.',
                                    confirmButtonColor: '#16a34a'
                                }).then(() => {
                                    localStorage.clear();
                                    window.location.href = '{{ route('order') }}';
                                });
                            },
                            onPending: function (result) {
                                Swal.fire({
                                    icon: 'info',
                                    title: 'Menunggu Pembayaran',
                                    text: 'Silakan selesaikan pembayaran QRIS Anda.',
                                    confirmButtonColor: '#16a34a'
                                });
                            },
                            onError: function (result) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal Melakukan Pembayaran!',
                                    text: 'Terjadi kesalahan saat memproses QRIS.',
                                    confirmButtonColor: '#dc2626'
                                });
                                console.log(result);
                            },
                            onClose: function () {
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Transaksi Dibatalkan!',
                                    text: 'Anda menutup jendela pembayaran QRIS.',
                                    confirmButtonColor: '#facc15'
                                });
                            }
                        });
                    },
                    error: function (xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal Ambil Snap Token!',
                            text: 'Periksa koneksi atau coba lagi.',
                            confirmButtonColor: '#dc2626'
                        });
                        console.error('Gagal mengambil Snap token:', xhr.responseText);
                    }
                });
            }

            else {
                Swal.fire({
                    icon: 'error',
                    title: 'Metode Tidak Dikenal!',
                    text: 'Metode pembayaran tidak sesuai.',
                    confirmButtonColor: '#dc2626'
                });
            }
        });

    });
</script>
</body>
</html>
