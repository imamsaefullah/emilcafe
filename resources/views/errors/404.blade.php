<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Halaman Tidak Ditemukan</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
<div class="card text-center px-6">
    <svg class="w-24 h-24 text-red-500 mx-auto mb-6" fill="none" stroke="currentColor" stroke-width="1.5"
         viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round"
              d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
    </svg>

    <h1 class="text-3xl font-bold text-gray-800 mb-2">404 - Halaman Tidak Ditemukan</h1>
    <p class="text-gray-600 mb-6">
        Sepertinya halaman yang Anda cari tidak tersedia,<br>terhapus, atau telah dipindahkan.
    </p>
    <p class="text-gray-600 mb-6">
        jangan pernah melakukan hal hal aneh di situs kami,<br> atau anda akan kami block IP adressnya
    </p>

    <a href="{{ route('login') }}"
       class="inline-block px-6 py-3 bg-blue-600 text-white rounded-lg shadow-md hover:bg-blue-700 transition">
        Kembali ke login
    </a>
</div>
</body>
</html>
