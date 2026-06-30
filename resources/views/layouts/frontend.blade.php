<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Supermarket Bintang')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- RemixIcon -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand text-primary-red fw-bold" href="{{ route('home') }}">
                SUPERMARKET BINTANG
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('tentang-kami') }}">Tentang Kami</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('produk') }}">Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('promo') }}">Promo</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('artikel') }}">Artikel</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('kontak') }}">Kontak</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="text-white" style="background-color: var(--dark);">
        <div class="container py-5">
            <div class="row g-4">
                <!-- Column 1: Logo & Description -->
                <div class="col-lg-4 col-md-6">
                    <h5 class="fw-bold mb-3">
                        <i class="ri-store-2-fill text-primary-red"></i> SUPERMARKET BINTANG
                    </h5>
                    <p class="text-white-50 mb-0">
                        Supermarket Bintang adalah pilihan utama untuk kebutuhan sehari-hari Anda. Kami menyediakan berbagai produk berkualitas dengan harga terjangkau.
                    </p>
                </div>

                <!-- Column 2: Quick Links -->
                <div class="col-lg-4 col-md-6">
                    <h5 class="fw-bold mb-3">Quick Links</h5>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2"><a href="{{ route('home') }}" class="text-white-50 text-decoration-none">Home</a></li>
                        <li class="mb-2"><a href="{{ route('tentang-kami') }}" class="text-white-50 text-decoration-none">Tentang Kami</a></li>
                        <li class="mb-2"><a href="{{ route('produk') }}" class="text-white-50 text-decoration-none">Produk</a></li>
                        <li class="mb-2"><a href="{{ route('promo') }}" class="text-white-50 text-decoration-none">Promo</a></li>
                        <li class="mb-2"><a href="{{ route('artikel') }}" class="text-white-50 text-decoration-none">Artikel</a></li>
                        <li class="mb-2"><a href="{{ route('kontak') }}" class="text-white-50 text-decoration-none">Kontak</a></li>
                    </ul>
                </div>

                <!-- Column 3: Contact Info -->
                <div class="col-lg-4 col-md-12">
                    <h5 class="fw-bold mb-3">Contact Info</h5>
                    <ul class="list-unstyled text-white-50 mb-0">
                        <li class="mb-2">
                            <i class="ri-map-pin-line me-2 text-primary-red"></i>
                            Jl. Bintang No. 123, Yogyakarta
                        </li>
                        <li class="mb-2">
                            <i class="ri-phone-line me-2 text-primary-red"></i>
                            (0274) 123-4567
                        </li>
                        <li class="mb-2">
                            <i class="ri-mail-line me-2 text-primary-red"></i>
                            info@supermarketbintang.com
                        </li>
                        <li class="mb-2">
                            <i class="ri-time-line me-2 text-primary-red"></i>
                            Senin - Minggu: 08.00 - 22.00
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Bottom Bar -->
        <div class="border-top border-secondary py-3">
            <div class="container">
                <p class="text-center text-white-50 mb-0">
                    &copy; {{ date('Y') }} Supermarket Bintang. All rights reserved.
                </p>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
