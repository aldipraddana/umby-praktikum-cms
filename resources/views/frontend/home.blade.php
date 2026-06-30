@extends('layouts.frontend')

@section('title', 'Home - Supermarket Bintang')

@section('content')
    @if(isset($banners) && $banners->count() > 0)
    <div id="bannerCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            @foreach($banners as $index => $banner)
                <button type="button" data-bs-target="#bannerCarousel" data-bs-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}" aria-current="{{ $index == 0 ? 'true' : 'false' }}" aria-label="Slide {{ $index + 1 }}"></button>
            @endforeach
        </div>
        <div class="carousel-inner">
            @foreach($banners as $index => $banner)
                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}" data-bs-interval="5000">
                    <img src="{{ $banner->gambar && file_exists(public_path('uploads/banner/' . $banner->gambar)) ? asset('uploads/banner/' . $banner->gambar) : 'https://via.placeholder.com/1920x1080/cf1526/fff?text=Banner' }}" class="d-block w-100" alt="{{ $banner->judul }}" style="height: 100vh; object-fit: cover;">
                    <div class="carousel-caption d-none d-md-block" style="background: rgba(0,0,0,0.4); padding: 20px; border-radius: 10px;">
                        <h5 class="fw-bold">{{ $banner->judul }}</h5>
                        <p>{{ $banner->deskripsi }}</p>
                    </div>
                </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#bannerCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#bannerCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    @else
    <div class="hero-section text-center py-5">
        <div class="container py-5">
            <h1 class="fw-bold mb-3">Selamat Datang di Supermarket Bintang</h1>
            <p class="lead mb-4 opacity-75">Solusi Lengkap untuk Kebutuhan Sehari-hari Anda</p>
        </div>
    </div>
    @endif

    {{-- Kategori Section --}}
    @if(isset($kategoris) && $kategoris->count() > 0)
        <section class="py-5" style="background-color: var(--bg-light);">
            <div class="container py-4">
                <div class="text-center mb-5">
                    <h2 class="fw-bold">Kategori Produk</h2>
                    <p class="text-muted">Temukan produk sesuai kebutuhan Anda</p>
                </div>
                <div class="row g-4 justify-content-center">
                    @foreach($kategoris as $kategori)
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <a href="{{ route('produk', ['kategori' => $kategori->id]) }}" class="text-decoration-none">
                                <div class="card text-center h-100 py-4 product-card">
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <i class="ri-folder-line" style="font-size: 3rem; color: var(--primary-red);"></i>
                                        </div>
                                        <h5 class="card-title fw-bold mb-1">{{ $kategori->nama }}</h5>
                                        <p class="card-text text-muted mb-0">
                                            {{ $kategori->produks_count ?? $kategori->produks->count() }} Produk
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Produk Unggulan Section --}}
    @if(isset($produks) && $produks->count() > 0)
        <section class="py-5">
            <div class="container py-4">
                <div class="text-center mb-5">
                    <h2 class="fw-bold">Produk Unggulan</h2>
                    <p class="text-muted">Pilihan produk terbaik untuk Anda</p>
                </div>
                <div class="row g-4">
                    @foreach($produks as $produk)
                        <div class="col-lg-3 col-md-6">
                            <div class="card h-100 product-card">
                                <img
                                    src="{{ $produk->gambar ? asset('uploads/produk/' . $produk->gambar) : 'https://via.placeholder.com/300x200?text=Produk' }}"
                                    class="card-img-top"
                                    alt="{{ $produk->nama }}"
                                    style="height: 200px; object-fit: cover;"
                                >
                                @if($produk->kategori)
                                    <span class="badge position-absolute top-0 start-0 m-2" style="background-color: var(--primary-red);">
                                        {{ $produk->kategori->nama }}
                                    </span>
                                @endif
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title fw-bold">{{ $produk->nama }}</h5>
                                    <p class="card-text text-muted small">
                                        {{ \Illuminate\Support\Str::limit($produk->deskripsi ?? '', 50) }}
                                    </p>
                                    <div class="mt-auto">
                                        <div class="fw-bold text-primary-red mb-2" style="font-size: 1.1rem;">
                                            Rp {{ number_format($produk->harga, 0, ',', '.') }}
                                        </div>
                                        <a href="{{ route('produk.detail', $produk->slug) }}" class="btn btn-primary-red w-100">
                                            Detail Produk
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="text-center mt-5">
                    <a href="{{ route('produk') }}" class="btn btn-outline-danger px-4">
                        Lihat Semua Produk <i class="ri-arrow-right-line ms-1"></i>
                    </a>
                </div>
            </div>
        </section>
    @endif

    {{-- Promo Section --}}
    @if(isset($promos) && $promos->count() > 0)
        <section class="py-5" style="background-color: var(--bg-light);">
            <div class="container py-4">
                <div class="text-center mb-5">
                    <h2 class="fw-bold">Promo Spesial</h2>
                    <p class="text-muted">Jangan lewatkan promo menarik dari kami</p>
                </div>
                <div class="row g-4">
                    @foreach($promos as $promo)
                        <div class="col-lg-3 col-md-6">
                            <div class="card h-100 promo-card position-relative">
                                <img
                                    src="{{ $promo->gambar ? asset('uploads/promo/' . $promo->gambar) : 'https://via.placeholder.com/400x200?text=Promo' }}"
                                    class="card-img-top"
                                    alt="{{ $promo->judul }}"
                                    style="height: 200px; object-fit: cover;"
                                >
                                @if($promo->diskon)
                                    <span class="promo-badge">
                                        {{ $promo->diskon }}% OFF
                                    </span>
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title fw-bold">{{ $promo->judul }}</h5>
                                    <p class="card-text text-muted small">
                                        {{ \Illuminate\Support\Str::limit($promo->deskripsi ?? '', 80) }}
                                    </p>
                                    @if($promo->tanggal_mulai && $promo->tanggal_selesai)
                                        <p class="text-muted small mb-3">
                                            <i class="ri-calendar-line me-1"></i>
                                            {{ \Carbon\Carbon::parse($promo->tanggal_mulai)->format('d M') }} -
                                            {{ \Carbon\Carbon::parse($promo->tanggal_selesai)->format('d M Y') }}
                                        </p>
                                    @endif
                                    <a href="{{ route('promo.detail', $promo->slug) }}" class="btn btn-primary-red w-100">
                                        Lihat Detail
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="text-center mt-5">
                    <a href="{{ route('promo') }}" class="btn btn-outline-danger px-4">
                        Lihat Semua Promo <i class="ri-arrow-right-line ms-1"></i>
                    </a>
                </div>
            </div>
        </section>
    @endif

    {{-- Artikel Section --}}
    @if(isset($artikels) && $artikels->count() > 0)
        <section class="py-5">
            <div class="container py-4">
                <div class="text-center mb-5">
                    <h2 class="fw-bold">Artikel & Berita Terbaru</h2>
                    <p class="text-muted">Baca berita dan tips menarik dari kami</p>
                </div>
                <div class="row g-4 justify-content-center">
                    @foreach($artikels as $artikel)
                        <div class="col-lg-4 col-md-6">
                            <div class="card h-100">
                                <img
                                    src="{{ $artikel->gambar ? asset('uploads/artikel/' . $artikel->gambar) : 'https://via.placeholder.com/400x180?text=Artikel' }}"
                                    class="card-img-top"
                                    alt="{{ $artikel->judul }}"
                                    style="height: 180px; object-fit: cover;"
                                >
                                <div class="card-body d-flex flex-column">
                                    <span class="text-muted small mb-2">
                                        <i class="ri-calendar-line me-1"></i>
                                        {{ \Carbon\Carbon::parse($artikel->tanggal ?? $artikel->created_at)->format('d M Y') }}
                                    </span>
                                    <h5 class="card-title fw-bold">{{ $artikel->judul }}</h5>
                                    <p class="card-text text-muted small flex-grow-1">
                                        {{ \Illuminate\Support\Str::limit(strip_tags($artikel->konten ?? ''), 100) }}
                                    </p>
                                    <a href="{{ route('artikel.detail', $artikel->slug) }}" class="btn btn-primary-blue mt-3 w-100">
                                        Baca Selengkapnya
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="text-center mt-5">
                    <a href="{{ route('artikel') }}" class="btn btn-outline-primary px-4" style="border-color: var(--primary-blue); color: var(--primary-blue);">
                        Lihat Semua Artikel <i class="ri-arrow-right-line ms-1"></i>
                    </a>
                </div>
            </div>
        </section>
    @endif

    {{-- CTA Section --}}
    <section class="py-5 text-white" style="background-color: var(--primary-blue);">
        <div class="container py-4 text-center">
            <h2 class="fw-bold mb-3">
                <i class="ri-store-2-line me-2"></i>Kunjungi Toko Kami
            </h2>
            <p class="lead mb-4 opacity-75">
                Jl. Bintang No. 123, Yogyakarta<br>
                Senin - Minggu: 08.00 - 22.00
            </p>
            <a href="{{ route('kontak') }}" class="btn btn-light btn-lg fw-semibold px-4">
                <i class="ri-phone-line me-2"></i>Hubungi Kami
            </a>
        </div>
    </section>
@endsection
