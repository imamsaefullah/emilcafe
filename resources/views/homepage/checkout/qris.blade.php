<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran QRIS | Emil Cafe</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://app.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center px-4">

<div class="max-w-lg w-full bg-white rounded-xl shadow-lg p-8 text-center">
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">QRIS Payment</h1>
        <p class="text-gray-500">Silakan scan QR code untuk menyelesaikan pembayaran</p>
    </div>

    <div id="qris-loading" class="mb-6 text-gray-500">
        <p>Memuat QR Code...</p>
    </div>

    <div id="qris-container"></div>

    <button onclick="location.href='{{ route('order') }}'" class="mt-6 px-6 py-2 bg-gray-600 text-white rounded hover:bg-gray-700 transition">
        Kembali ke Order
    </button>
</div>

<script>
    fetch("{{ route('payments.getSnapToken') }}", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            customer_name: localStorage.getItem('customer_name'),
            table_number: localStorage.getItem('table_number'),
            items: JSON.parse(localStorage.getItem('cart') || '[]'),
            total: JSON.parse(localStorage.getItem('cart') || '[]').reduce((sum, item) => sum + item.price * item.qty, 0),
            payment_method: 'qris'
        })
    })
        .then(res => res.json())
        .then(res => {
            if (res.token) {
                document.getElementById('qris-loading').remove();
                snap.pay(res.token, {
                    onSuccess: function(result) {
                        alert('Pembayaran berhasil!');
                        localStorage.clear();
                        window.location.href = '{{ route('order') }}';
                    },
                    onPending: function(result) {
                        alert('Menunggu pembayaran...');
                        localStorage.clear();
                        window.location.href = '{{ route('order') }}';
                    },
                    onError: function(result) {
                        alert('Pembayaran gagal.');
                        console.error(result);
                    },
                    onClose: function() {
                        alert('Anda menutup pembayaran.');
                    }
                });
            } else {
                alert('Gagal mendapatkan token Midtrans.');
                console.error(res);
            }
        })
        .catch(err => {
            alert('Terjadi kesalahan saat mengambil token.');
            console.error(err);
        });
</script>

</body>
</html>
