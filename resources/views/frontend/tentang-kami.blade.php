@extends('layouts.frontend')

@section('title', 'Tentang Kami - Supermarket Bintang')

@section('content')
    {{-- Hero Banner --}}
    <section class="hero-section text-center" style="padding: 60px 0; min-height: 300px;">
        <div class="container">
            <h1 class="fw-bold mb-3">Tentang Kami</h1>
            <p class="lead opacity-75">Kenali lebih dekat Supermarket Bintang</p>
        </div>
    </section>

    {{-- Visi & Misi Section --}}
    <section class="py-5">
        <div class="container py-5">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <h2 class="fw-bold mb-4">Tentang Supermarket Bintang</h2>
                    <p class="text-muted mb-3">
                        Supermarket Bintang adalah supermarket terkemuka di Yogyakarta yang telah melayani kebutuhan masyarakat sejak tahun 2010. Kami berkomitmen untuk menyediakan produk berkualitas dengan harga terjangkau.
                    </p>
                    <p class="text-muted mb-3">
                        Dengan lebih dari 10.000 produk dari berbagai kategori, kami hadir untuk memenuhi semua kebutuhan rumah tangga Anda. Mulai dari bahan makanan, minuman, kebutuhan bayi, hingga produk rumah tangga.
                    </p>
                    <p class="text-muted">
                        Tim kami yang profesional dan ramah siap membantu Anda menemukan produk yang tepat. Kepuasan pelanggan adalah prioritas utama kami.
                    </p>
                </div>
                <div class="col-lg-6">
                    <img
                        src="https://via.placeholder.com/600x400?text=Supermarket+Bintang"
                        alt="Tentang Kami"
                        class="img-fluid rounded-3 shadow"
                    >
                </div>
            </div>
        </div>
    </section>

    {{-- Nilai-Nilai Kami Section --}}
    <section class="py-5" style="background-color: var(--bg-light);">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Nilai-Nilai Kami</h2>
                <p class="text-muted">Prinsip yang kami pegang dalam melayani Anda</p>
            </div>
            <div class="row g-4 justify-content-center">
                <div class="col-lg-3 col-md-6">
                    <div class="card text-center h-100 py-4 product-card">
                        <div class="card-body">
                            <div class="mb-3">
                                <i class="ri-shield-check-line" style="font-size: 3rem; color: var(--primary-red);"></i>
                            </div>
                            <h5 class="card-title fw-bold mb-2">Kejujuran</h5>
                            <p class="card-text text-muted mb-0">
                                Kami selalu mengutamakan kejujuran dalam setiap transaksi dan pelayanan kepada pelanggan.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card text-center h-100 py-4 product-card">
                        <div class="card-body">
                            <div class="mb-3">
                                <i class="ri-award-line" style="font-size: 3rem; color: var(--primary-red);"></i>
                            </div>
                            <h5 class="card-title fw-bold mb-2">Kualitas</h5>
                            <p class="card-text text-muted mb-0">
                                Produk yang kami jual telah melalui proses seleksi ketat untuk menjamin kualitas terbaik.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card text-center h-100 py-4 product-card">
                        <div class="card-body">
                            <div class="mb-3">
                                <i class="ri-money-dollar-circle-line" style="font-size: 3rem; color: var(--primary-red);"></i>
                            </div>
                            <h5 class="card-title fw-bold mb-2">Harga Terjangkau</h5>
                            <p class="card-text text-muted mb-0">
                                Kami menawarkan harga yang kompetitif dan terjangkau untuk semua kalangan masyarakat.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card text-center h-100 py-4 product-card">
                        <div class="card-body">
                            <div class="mb-3">
                                <i class="ri-heart-line" style="font-size: 3rem; color: var(--primary-red);"></i>
                            </div>
                            <h5 class="card-title fw-bold mb-2">Pelayanan Ramah</h5>
                            <p class="card-text text-muted mb-0">
                                Tim kami selalu siap membantu dengan senyum dan pelayanan yang ramah untuk kenyamanan Anda.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="py-5 text-white" style="background-color: var(--primary-blue);">
        <div class="container py-4 text-center">
            <h2 class="fw-bold mb-3">
                <i class="ri-shopping-bag-3-line me-2"></i>Siap Berbelanja?
            </h2>
            <p class="lead mb-4 opacity-75">
                Kunjungi Supermarket Bintang dan temukan berbagai produk berkualitas untuk kebutuhan Anda.
            </p>
            <a href="{{ route('produk') }}" class="btn btn-light btn-lg fw-semibold px-4">
                <i class="ri-arrow-right-line me-2"></i>Lihat Produk
            </a>
        </div>
    </section>
@endsection
