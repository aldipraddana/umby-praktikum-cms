@extends('layouts.frontend')

@section('title', $produk->nama . ' - Supermarket Bintang')

@section('content')
<div class="container py-4">

    {{-- Breadcrumb --}}
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('produk') }}">Produk</a></li>
            @if($produk->kategori)
                <li class="breadcrumb-item"><a href="{{ route('produk', ['kategori' => $produk->kategori->id]) }}">{{ $produk->kategori->nama }}</a></li>
            @endif
            <li class="breadcrumb-item active" aria-current="page">{{ $produk->nama }}</li>
        </ol>
    </nav>

    {{-- Product Detail Section --}}
    <div class="row g-4 mb-5">
        {{-- Image Left --}}
        <div class="col-lg-5">
            <div class="card border-0 shadow-sm position-relative">
                <div class="position-relative">
                    <img
                        src="{{ $produk->gambar && file_exists(public_path('uploads/produk/' . $produk->gambar))
                            ? asset('uploads/produk/' . $produk->gambar)
                            : 'https://via.placeholder.com/600x400/0067ae/fff?text=Produk' }}"
                        class="card-img-top"
                        alt="{{ $produk->nama }}"
                        style="height: 400px; object-fit: cover; border-radius: 10px;"
                    >
                    @if($produk->kategori)
                        <span class="badge position-absolute top-0 start-0 m-3"
                              style="background-color: var(--primary-red);">
                            <i class="ri-folder-line me-1"></i>{{ $produk->kategori->nama }}
                        </span>
                    @endif
                </div>
            </div>
        </div>

        {{-- Info Right --}}
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex flex-column justify-content-center">
                    {{-- Nama Produk --}}
                    <h2 class="fw-bold mb-3">{{ $produk->nama }}</h2>

                    {{-- Badge Kategori --}}
                    @if($produk->kategori)
                        <span class="badge mb-3 w-auto d-inline-block"
                              style="background-color: var(--primary-red); width: fit-content;">
                            <i class="ri-folder-line me-1"></i>{{ $produk->kategori->nama }}
                        </span>
                    @endif

                    {{-- Deskripsi --}}
                    <p class="text-muted mb-4" style="line-height: 1.8;">
                        {{ $produk->deskripsi ?? 'Deskripsi produk tidak tersedia.' }}
                    </p>

                    {{-- Harga --}}
                    <h3 class="fw-bold mb-3" style="color: var(--primary-red);">
                        Rp {{ number_format($produk->harga, 0, ',', '.') }}
                    </h3>

                    {{-- Stok --}}
                    <p class="mb-4">
                        <i class="ri-stock-line me-1"></i>
                        <strong>Stok:</strong>
                        @if($produk->stok <= 0)
                            <span class="text-danger fw-semibold">Habis</span>
                        @elseif($produk->stok <= 10)
                            <span class="text-warning fw-semibold">Tersisa {{ $produk->stok }}</span>
                        @else
                            <span class="text-success fw-semibold">{{ $produk->stok }} unit</span>
                        @endif
                    </p>

                    {{-- Spesifikasi Tabel --}}
                    <div class="table-responsive mb-4">
                        <table class="table table-bordered mb-0" style="max-width: 400px;">
                            <tbody>
                                <tr>
                                    <th class="text-nowrap" style="width: 140px; background-color: var(--bg-light);">Kategori</th>
                                    <td>{{ $produk->kategori->nama ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th class="text-nowrap" style="background-color: var(--bg-light);">Satuan</th>
                                    <td>{{ $produk->satuan ?? '-' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    {{-- CTA Button --}}
                    <a href="{{ route('kontak') }}" class="btn btn-primary-red btn-lg fw-semibold w-100 w-md-auto">
                        <i class="ri-phone-line me-2"></i>Hubungi Kami untuk Pesanan
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Related Products Section --}}
    @if(isset($produksLainnya) && $produksLainnya->count() > 0)
        <div class="mt-5">
            <div class="mb-4">
                <h4 class="fw-bold mb-1">
                    <i class="ri-apps-line me-1" style="color: var(--primary-red);"></i> Produk Terkait
                </h4>
                <p class="text-muted mb-0">Produk lain yang mungkin Anda sukai</p>
            </div>
            <div class="row g-3">
                @foreach($produksLainnya as $produk)
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card h-100 product-card border-0 shadow-sm">
                            <div class="position-relative">
                                <img
                                    src="{{ $produk->gambar && file_exists(public_path('uploads/produk/' . $produk->gambar))
                                        ? asset('uploads/produk/' . $produk->gambar)
                                        : 'https://via.placeholder.com/300x200/0067ae/fff?text=Produk' }}"
                                    class="card-img-top"
                                    alt="{{ $produk->nama }}"
                                    style="height: 160px; object-fit: cover;"
                                >
                                @if($produk->kategori)
                                    <span class="badge position-absolute top-0 start-0 m-1"
                                          style="background-color: var(--primary-red); font-size: 0.65rem;">
                                        {{ $produk->kategori->nama }}
                                    </span>
                                @endif
                            </div>
                            <div class="card-body p-2">
                                <h6 class="card-title fw-bold mb-1" style="font-size: 0.9rem;">{{ $produk->nama }}</h6>
                                <div class="fw-bold mb-1" style="color: var(--primary-red); font-size: 0.85rem;">
                                    Rp {{ number_format($produk->harga, 0, ',', '.') }}
                                </div>
                                <a href="{{ route('produk.detail', $produk->id) }}"
                                   class="btn btn-sm w-100 mt-1"
                                   style="border: 1px solid var(--primary-red); color: var(--primary-red); font-size: 0.75rem;">
                                    <i class="ri-eye-line me-1"></i>Detail
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

</div>
@endsection
