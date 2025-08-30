<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Hak Akses Ditolak</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
<div class="bg-white p-10 rounded-2xl shadow-xl max-w-lg text-center">
    <svg class="mx-auto mb-4 w-16 h-16 text-red-500" fill="none" stroke="currentColor" stroke-width="1.5"
         viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round"
              d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
    </svg>
    @php
    $nomor = '6287779145214';
    $pesan = 'Halo, saya ingin memesan produk dengan kode INV-001 senilai Rp150.000';
    $link = 'https://wa.me/' . $nomor . '?text=' . urlencode($pesan);
    @endphp
    <h2 class="text-2xl font-semibold text-gray-800 mb-2">Akses Ditolak</h2>
    <p class="text-gray-600 mb-4">
        Anda belum memiliki hak akses.<br>
        Segera hubungi <span class="font-semibold text-red-500">Supervisor Admin</span> untuk memberikan hak akses halaman.
    </p>

    <a href="https://wa.me/6281808305152" target="_blank"
       class="inline-flex items-center gap-2 text-green-600 hover:text-green-700 font-medium text-sm transition mb-6">
        <svg class="w-5 h-5 fill-current" viewBox="0 0 32 32" aria-hidden="true">
            <path
                d="M16.004 2.996c-7.28 0-13.192 5.912-13.192 13.192 0 2.326.608 4.595 1.76 6.6L2 30l7.39-2.518a13.11 13.11 0 006.612 1.716c7.28 0 13.192-5.912 13.192-13.192S23.284 2.996 16.004 2.996zm0 23.966a11.644 11.644 0 01-5.88-1.568l-.42-.248-4.382 1.494 1.484-4.264-.273-.44a11.58 11.58 0 01-1.662-6.012c0-6.408 5.214-11.622 11.622-11.622 6.408 0 11.622 5.214 11.622 11.622s-5.214 11.622-11.622 11.622zm6.43-8.68c-.352-.176-2.074-1.02-2.396-1.136-.322-.116-.56-.176-.798.176-.24.352-.92 1.136-1.13 1.372-.208.24-.416.272-.768.096-.352-.176-1.484-.548-2.826-1.748-1.044-.93-1.746-2.076-1.952-2.428-.2-.352-.022-.544.152-.72.156-.156.352-.408.528-.612.176-.208.236-.352.352-.584.116-.24.06-.44-.028-.612-.088-.176-.798-1.924-1.092-2.64-.288-.692-.58-.6-.798-.612-.204-.012-.44-.012-.672-.012-.24 0-.624.088-.948.44s-1.246 1.22-1.246 2.98c0 1.76 1.274 3.46 1.45 3.696.176.24 2.508 3.832 6.08 5.376.852.368 1.516.588 2.034.752.852.272 1.628.236 2.238.144.684-.1 2.074-.848 2.368-1.672.292-.824.292-1.532.204-1.68-.084-.148-.312-.24-.66-.408z" />
        </svg>
        <a href="{{ $link }}" target="_blank" class="btn btn-success">
            Kirim WhatsApp
        </a>
        Hubungi Supervisor Anda: +62 818-0830-5152
    </a>

    <div class="flex justify-center mt-4">
        <form method="POST" action="{{ route('logout') }}" id="logoutForm">
            @csrf
            <button type="button" id="logoutBtn"
                    class="flex items-center px-4 py-2 text-sm text-white bg-red-600 hover:bg-red-700 rounded-md">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1m0-10V5"></path>
                </svg>
                Logout
            </button>
        </form>
    </div>
</div>

<script>
    document.getElementById('logoutBtn').addEventListener('click', function (e) {
        Swal.fire({
            title: 'Apakah Anda yakin ingin logout?',
            text: 'Jangan ulangi lagi. Jika kamu melakukan pelanggaran 3x, akunmu bisa diblokir!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, logout',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logoutForm').submit();
            }
        });
    });
</script>
</body>
</html>
