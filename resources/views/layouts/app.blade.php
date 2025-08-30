<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    @yield('styles')
    <!-- Tambahkan di bagian <head> -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

{{--    style  --}}
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }

        body {
            background-color: #f9fafb;
            color: #333;
        }

        .card {
            border: none;
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.2s ease-in-out;
        }

        .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.05);
        }

        .card-img-top {
            border-bottom: 1px solid #eee;
        }

        .btn-primary {
            background-color: #0d6efd;
            border: none;
            transition: background-color 0.2s ease-in-out;
        }

        .btn-primary:hover {
            background-color: #0b5ed7;
        }

        .floating-cart {
            z-index: 1000;
            background: #ffc107;
            color: #000;
            width: 56px;
            height: 56px;
            font-size: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
            position: fixed;
            bottom: 30px;
            right: 30px;
            cursor: pointer;
        }

        .floating-cart .badge {
            font-size: 12px;
            position: absolute;
            top: 0;
            right: 0;
            transform: translate(50%, -50%);
        }

        #cart-popup {
            border-radius: 16px;
            animation: fadeIn 0.2s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>

</head>
<body>
<main class="py-4">
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">🍽️ Emil Store</a>

            <div class="ms-auto d-flex align-items-center">
                <!-- Icon Cart -->
                <div class="position-relative me-2">
                    <a href="javascript:void(0)" id="open-cart" class="btn btn-outline-secondary rounded-circle">
                        🛒
                    </a>
                    <span id="cart-count" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    0
                </span>
                </div>
            </div>
        </div>
    </nav>
    <div class="container">
        @yield('content')
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@yield('scripts')
</body>
</html>
