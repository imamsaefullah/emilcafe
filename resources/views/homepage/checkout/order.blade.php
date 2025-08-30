<!DOCTYPE html>
<html lang="id">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout | Transaksi {{ $kodetransaksi }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        #cart-toast {
            transition: opacity 0.9s ease-in-out;
        }
        @keyframes fade-in-out {
            0% { opacity: 0; transform: translateY(20px) scale(0.95); }
            10% { opacity: 1; transform: translateY(0) scale(1); }
            90% { opacity: 1; transform: translateY(0) scale(1); }
            100% { opacity: 0; transform: translateY(20px) scale(0.95); }
        }

        .animate-fade-in-out {
            animation: fade-in-out 2.5s ease-in-out forwards;
        }
        @keyframes scale-in {
            0% { transform: scale(0.95); opacity: 0; }
            100% { transform: scale(1); opacity: 1; }
        }
        .animate-scale-in {
            animation: scale-in 0.2s ease-out forwards;
        }
    </style>
</head>
<body class="bg-gray-50">

<!-- Navbar (Fixed) -->
<nav class="fixed top-0 left-0 w-full z-50 bg-white/80 backdrop-blur border-b border-gray-200 shadow">
    <div class="container mx-auto px-6 py-4 flex items-center justify-between">
        <h1 class="text-xl font-bold text-green-600">🍽️ Emil Store</h1>
        <div class="relative">
            <button id="open-cart" class="w-10 h-10 bg-gray-200 hover:bg-gray-300 rounded-md flex items-center justify-center text-xl">
                🛒
            </button>
            <span id="cart-count" class="absolute -top-1 -right-1 bg-red-500 text-white text-xs w-5 h-5 rounded-full flex items-center justify-center">0</span>
        </div>
    </div>
</nav>

<!-- Produk Grid -->
<div class="container mx-auto px-4 py-6 mt-24">
    <div class="bg-white shadow rounded-xl p-4 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- Nomor Transaksi -->
            <div class="flex items-center gap-2">
                <span class="text-sm font-medium text-gray-500">Kode Transaksi:</span>
                <h2 class="text-xl font-bold text-green-600 tracking-wide">{{ $kodetransaksi }}</h2>

                <!-- Input hidden untuk dikirim -->
                <input type="hidden" name="order_number" id="order_number" value="{{ $kodetransaksi }}">
            </div>

            <!-- Nama Pelanggan -->
            <div class="flex items-center gap-2">
                <span class="text-sm font-medium text-gray-500">Nama:</span>
                <input type="text" id="customer_name" name="customer_name"
                       class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring focus:ring-green-300"
                       placeholder="Nama pelanggan" required>
            </div>

            <!-- Nomor Meja -->
            <div class="flex items-center gap-2">
                <span class="text-sm font-medium text-gray-500">No. Meja:</span>
                <input type="text" id="table_number" name="table_number"
                       class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring focus:ring-green-300 cursor-pointer"
                       placeholder="Pilih meja..." readonly>
            </div>
        </div>
    </div>


    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
        @foreach ($item as $product)
            <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transform hover:scale-105 transition duration-300 ease-in-out">
                <img src="{{ $product->gambar ? asset('storage/' . $product->gambar) : 'https://via.placeholder.com/300x160?text=No+Image' }}"
                     alt="{{ $product->nama }}"
                     class="w-full h-44 object-cover rounded-t-xl">
                <div class="p-4">
                    <h2 class="text-base font-semibold text-gray-800 mb-1">{{ $product->nama }}</h2>
                    <p class="text-green-600 font-bold text-sm mb-2">Rp {{ number_format($product->harga_jual, 0, ',', '.') }}</p>
                    <button class="add-to-cart w-full bg-green-600 hover:bg-green-700 text-white text-sm font-medium py-2 rounded-lg"
                            data-id="{{ $product->id }}"
                            data-name="{{ $product->nama }}"
                            data-price="{{ $product->harga_jual }}">
                        + Tambah ke Keranjang
                    </button>
                </div>
            </div>
        @endforeach
    </div>
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


<!-- Cart Popup -->
<div id="cart-popup"
     class="fixed left-1/2 top-24 transform -translate-x-1/2
            bg-white shadow-2xl rounded-2xl w-full max-w-md max-h-[34rem]
            overflow-y-auto p-6 z-50 border border-gray-200 hidden">

    <div class="flex justify-between items-center mb-4">
        <h3 class="text-xl font-semibold text-gray-800">🛒 Keranjang Belanja</h3>
        <button id="clear-cart" class="text-sm text-red-600 hover:underline">🗑️ Kosongkan</button>
    </div>

    <ul id="cart-preview" class="divide-y divide-gray-200 text-sm mb-4 space-y-2"></ul>

    <div class="text-right text-lg font-semibold text-gray-700 mb-2">
        Total: <span id="cart-total">Rp 0</span>
    </div>

    <button id="checkout-button"
            class="mt-2 w-full bg-green-600 hover:bg-green-700 text-white py-2.5
                 text-sm rounded-xl shadow-md transition duration-200">
        Checkout Sekarang
    </button>
</div>

<!-- Overlay Gelap -->
<div id="cart-overlay" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-40 hidden"></div>

<!-- Toast Notification -->
<div id="cart-toast" class="fixed top-6 left-1/2 transform -translate-x-1/2 z-[9999] hidden">
    <div class="flex items-center gap-3 px-5 py-3 bg-green-600 text-white rounded-xl shadow-xl border border-green-500 animate-fade-in-out">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24"
             stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M5 13l4 4L19 7" />
        </svg>
        <span id="cart-toast-message" class="text-sm font-medium">Berhasil ditambahkan ke keranjang!</span>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>

{{--    modul meja --}}
$(document).ready(function () {
    // Buka modal saat input diklik
    $('#table_number').on('click', function () {
        $('#tableModal').removeClass('hidden').addClass('flex');
    });

    // Pilih meja dari modal
    $('.table-option').on('click', function () {
        const meja = $(this).data('value');
        $('#table_number').val(meja); // Set value ke input
        localStorage.setItem('table_number', meja);
        $('#tableModal').addClass('hidden').removeClass('flex');
    });

    // Tutup modal
    $('#closeTableModal').on('click', function () {
        $('#tableModal').addClass('hidden').removeClass('flex');
    });

    // Klik di luar modal => tutup
    $(document).on('click', function (e) {
        const modal = $('#tableModal .bg-white');
        if (!modal.is(e.target) && modal.has(e.target).length === 0 && !$('#table_number').is(e.target)) {
            $('#tableModal').addClass('hidden').removeClass('flex');
        }
    });
});




{{--    keranjang  --}}
    let cart = JSON.parse(localStorage.getItem('cart')) || [];

    function saveCart() {
        localStorage.setItem('cart', JSON.stringify(cart));
        updateCartCount();
        renderCartPopup();
    }


    function updateCartCount() {
        let totalItems = cart.reduce((sum, item) => sum + item.qty, 0);
        $('#cart-count').text(totalItems);
    }

    function renderCartPopup() {
        const $preview = $('#cart-preview');
        $preview.empty();
        let total = 0;

        if (cart.length === 0) {
            $preview.append('<li class="py-3 text-center text-gray-400">Keranjang kosong</li>');
        } else {
            cart.forEach(item => {
                total += item.price * item.qty;
                $preview.append(`
                  <li class="py-4 flex justify-between items-start gap-3">
                    <div class="flex-1">
                      <div class="font-medium text-gray-700">${item.name}</div>
                      <div class="flex items-center gap-2 mt-1">
                        <button class="qty-decrease text-sm text-gray-600 px-2 py-1 border rounded" data-id="${item.id}">−</button>
                        <span class="text-sm font-semibold">${item.qty}</span>
                        <button class="qty-increase text-sm text-gray-600 px-2 py-1 border rounded" data-id="${item.id}">+</button>
                      </div>
                    </div>
                    <div class="text-right">
                      <div class="text-gray-700 font-semibold">Rp ${item.price.toLocaleString()}</div>
                      <button class="remove-item text-xs text-red-500 mt-1 hover:underline" data-id="${item.id}">🗑️ Hapus</button>
                    </div>
                  </li>
                `);
            });
        }

        $('#cart-total').text('Rp ' + total.toLocaleString());
    }

function showToast(message = 'Produk berhasil ditambahkan ke keranjang!') {
    Swal.fire({
        toast: true,
        position: 'top-end',
        icon: 'success',
        title: message,
        showConfirmButton: false,
        timer: 2500,
        timerProgressBar: true,
        background: '#f0fdf4', // bg-green-50
        color: '#166534', // text-green-700
        iconColor: '#16a34a', // icon hijau
    });
}

$(document).ready(function () {
        // Simpan nama customer saat mengetik
        $('#customer_name').on('input', function () {
            const name = $(this).val();
            localStorage.setItem('customer_name', name);
        });

        const order_number = $('#order_number').val();
        if (order_number) {
            localStorage.setItem('order_number', order_number);
        }

        // Saat halaman dimuat, isi input jika sudah pernah disimpan
    });

    $(document).ready(function () {
        updateCartCount();
        renderCartPopup();


        const mejaTersimpan = localStorage.getItem('table_number');
        if (mejaTersimpan) {
            $('#table_number').val(mejaTersimpan);
        }

        const savedName = localStorage.getItem('customer_name');
        if (savedName) {
            $('#customer_name').val(savedName);
        }

        const order_number = localStorage.getItem('order_number');
        if (order_number) {
            $('#order_number').val(order_number);
        }

        // Delegasi event karena item dinamis
        $('#cart-preview').on('click', '.qty-increase', function () {
            const id = $(this).data('id');
            const index = cart.findIndex(item => item.id == id);
            if (index !== -1) {
                cart[index].qty += 1;
                saveCart();
            }
        });

        $('#cart-preview').on('click', '.qty-decrease', function () {
            const id = $(this).data('id');
            const index = cart.findIndex(item => item.id == id);
            if (index !== -1 && cart[index].qty > 1) {
                cart[index].qty -= 1;
                saveCart();
            }
        });

        $('#cart-preview').on('click', '.remove-item', function () {
            const id = $(this).data('id');
            cart = cart.filter(item => item.id != id);
            saveCart();
        });



        // Tambah ke keranjang
        $('.add-to-cart').on('click', function () {
            const id = $(this).data('id');
            const name = $(this).data('name');
            const price = parseFloat($(this).data('price'));

            const index = cart.findIndex(item => item.id == id);
            if (index !== -1) {
                cart[index].qty += 1;
            } else {
                cart.push({ id, name, price, qty: 1 });
            }

            saveCart();
            showToast();
        });

        // Buka/tutup cart
        $('#open-cart').on('click', function () {
            $('#cart-popup').toggleClass('hidden');
            $('#cart-overlay').toggleClass('hidden');
        });

        // Mencegah klik tombol dalam popup menutup popup
        $('#cart-popup').on('click', function (e) {
            e.stopPropagation();
        });

        // Tutup cart saat klik di luar
        $(document).on('click', function (e) {
            const $cart = $('#cart-popup');
            const $overlay = $('#cart-overlay');
            const $openBtn = $('#open-cart');

            if (
                !$cart.is(e.target) && $cart.has(e.target).length === 0 &&
                !$openBtn.is(e.target) && $openBtn.has(e.target).length === 0 &&
                !$overlay.hasClass('hidden')
            ) {
                $cart.addClass('hidden');
                $overlay.addClass('hidden');
            }
        });

        // Clear cart dengan SweetAlert2
        $('#clear-cart').on('click', function () {
            Swal.fire({
                title: 'Kosongkan Keranjang?',
                text: "Seluruh item akan dihapus. Lanjutkan?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc2626', // merah (Tailwind red-600)
                cancelButtonColor: '#6b7280', // abu (Tailwind gray-500)
                confirmButtonText: 'Ya, kosongkan',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    localStorage.removeItem('cart');
                    localStorage.removeItem('table_number');
                    localStorage.removeItem('customer_name');
                    localStorage.removeItem('order_number');
                    cart = [];
                    updateCartCount();
                    renderCartPopup();
                    $('#table_number').val('');
                    $('#customer_name').val('');

                    Swal.fire({
                        icon: 'success',
                        title: 'Keranjang dikosongkan!',
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true
                    });
                }
            });
        });

        // Checkout dengan validasi input terkini
        $('#checkout-button').on('click', function () {
            const customerName = $('#customer_name').val().trim();
            const tableNumber = $('#table_number').val().trim();

            if (customerName === '' || tableNumber === '') {
                Swal.fire({
                    icon: 'warning',
                    title: 'Lengkapi Data!',
                    text: 'Nama pelanggan dan nomor meja harus diisi sebelum checkout.',
                    confirmButtonColor: '#16a34a' // Tailwind green-600
                });
                return;
            }

            if (!cart || cart.length === 0) {
                Swal.fire({
                    icon: 'info',
                    title: 'Keranjang Kosong!',
                    text: 'Silakan tambahkan item ke keranjang sebelum checkout.',
                    confirmButtonColor: '#16a34a'
                });
                return;
            }

            // Simpan jika lolos validasi
            localStorage.setItem('customer_name', customerName);
            localStorage.setItem('table_number', tableNumber);

            window.location.href = "{{ route('payments.index') }}";
        });
    });
</script>

</body>
</html>
