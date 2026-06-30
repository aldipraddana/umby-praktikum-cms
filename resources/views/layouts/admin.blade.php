<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin - Supermarket Bintang')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <nav class="sidebar sidebar-expand-lg sticky-top" style="width: 250px;">
            <div class="text-center py-4">
                <h4 class="text-white mb-0">
                    <i class="ri-store-2-fill text-primary-red"></i> Bintang
                </h4>
                <small class="text-white-50">Admin Panel</small>
            </div>
            <div class="nav flex-column w-100 mt-3">
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="ri-dashboard-line"></i> Dashboard
                </a>
                <a href="{{ route('admin.produk.index') }}" class="nav-link {{ request()->routeIs('admin.produk.*') ? 'active' : '' }}">
                    <i class="ri-shopping-bag-3-line"></i> Kelola Produk
                </a>
                <a href="{{ route('admin.kategori.index') }}" class="nav-link {{ request()->routeIs('admin.kategori.*') ? 'active' : '' }}">
                    <i class="ri-folder-line"></i> Kelola Kategori
                </a>
                <a href="{{ route('admin.promo.index') }}" class="nav-link {{ request()->routeIs('admin.promo.*') ? 'active' : '' }}">
                    <i class="ri-price-tag-3-line"></i> Kelola Promo
                </a>
                <a href="{{ route('admin.artikel.index') }}" class="nav-link {{ request()->routeIs('admin.artikel.*') ? 'active' : '' }}">
                    <i class="ri-article-line"></i> Kelola Artikel
                </a>
                <a href="{{ route('admin.banner.index') }}" class="nav-link {{ request()->routeIs('admin.banner.*') ? 'active' : '' }}">
                    <i class="ri-image-line"></i> Kelola Banner
                </a>
                <a href="{{ route('admin.kontak.index') }}" class="nav-link {{ request()->routeIs('admin.kontak.*') ? 'active' : '' }}">
                    <i class="ri-contacts-line"></i> Kelola Kontak
                </a>
                <a href="{{ route('admin.user.index') }}" class="nav-link {{ request()->routeIs('admin.user.*') ? 'active' : '' }}">
                    <i class="ri-user-settings-line"></i> Kelola User Admin
                </a>
                <hr class="border-secondary mx-3 my-2">
                <a href="{{ route('home') }}" class="nav-link" target="_blank">
                    <i class="ri-external-link-line"></i> Lihat Website
                </a>
                <a href="{{ route('logout') }}" class="nav-link text-warning" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="ri-logout-box-line"></i> Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </nav>

        <!-- Main Content -->
        <div class="flex-grow-1" style="background-color: var(--bg-light); min-height: 100vh;">
            <!-- Top Navbar -->
            <nav class="navbar navbar-expand-lg navbar-white bg-white border-bottom px-4">
                <div class="container-fluid">
                    <button class="btn btn-outline-secondary d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarNav">
                        <i class="ri-menu-line"></i>
                    </button>
                    <span class="navbar-brand mb-0 h5 d-none d-lg-block">@yield('page-title', 'Dashboard')</span>
                    <div class="d-flex align-items-center">
                        <span class="me-2 text-muted">{{ Auth::user()->name }}</span>
                        <div class="rounded-circle bg-primary-red text-white d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Content -->
            <div class="content-wrapper">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                @yield('content')
            </div>

            <!-- Footer -->
            <footer class="footer text-center py-3 mt-4">
                <div class="container">
                    <small>&copy; {{ date('Y') }} Supermarket Bintang. All rights reserved.</small>
                </div>
            </footer>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
