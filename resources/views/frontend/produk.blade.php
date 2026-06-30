@extends('layouts.frontend')

@section('title', 'Daftar Produk - Supermarket Bintang')

@section('content')
<div class="container py-4">

    {{-- Breadcrumb --}}
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Produk</li>
        </ol>
    </nav>

    {{-- Page Header --}}
    <div class="mb-4">
        <h2 class="fw-bold mb-1">Daftar Produk</h2>
        <p class="text-muted mb-0">Temukan berbagai produk berkualitas untuk kebutuhan Anda</p>
    </div>

    <div class="row g-4">

        {{-- Sidebar Filter --}}
        <div class="col-lg-3">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <h5 class="fw-bold mb-3">
                        <i class="ri-filter-line me-1"></i> Filter Kategori
                    </h5>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2">
                            <a href="{{ route('produk') }}"
                               class="text-decoration-none d-flex justify-content-between align-items-center {{ !request('kategori') ? 'text-primary-red fw-semibold' : 'text-muted' }}">
                                <span><i class="ri-layout-grid-line me-1"></i> Semua Produk</span>
                                <span class="badge bg-secondary rounded-pill">{{ $totalProduk }}</span>
                            </a>
                        </li>
                        @forelse($kategoris as $kategori)
                            <li class="mb-2">
                                <a href="{{ route('produk', ['kategori' => $kategori->id]) }}"
                                   class="text-decoration-none d-flex justify-content-between align-items-center {{ request('kategori') == $kategori->id ? 'text-primary-red fw-semibold' : 'text-muted' }}">
                                    <span>
                                        <i class="ri-folder-line me-1"></i>
                                        {{ $kategori->nama }}
                                    </span>
                                    <span class="badge bg-secondary rounded-pill">{{ $kategori->produks_count ?? $kategori->produks->count() }}</span>
                                </a>
                            </li>
                        @empty
                            <li class="text-muted">Tidak ada kategori</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>

        {{-- Main Content --}}
        <div class="col-lg-9">

            {{-- Search & Sort Bar --}}
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <form method="GET" action="{{ route('produk') }}" class="row g-3 align-items-end">
                        <input type="hidden" name="kategori" value="{{ request('kategori') }}">
                        <div class="col-md-8">
                            <label for="search" class="form-label small fw-semibold">Cari Produk</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0">
                                    <i class="ri-search-line text-muted"></i>
                                </span>
                                <input type="text" name="search" id="search" class="form-control border-start-0"
                                       placeholder="Ketik nama produk..." value="{{ request('search') }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="sort" class="form-label small fw-semibold">Urutkan</label>
                            <select name="sort" id="sort" class="form-select">
                                <option value="">Terbaru</option>
                                <option value="harga_asc" {{ request('sort') == 'harga_asc' ? 'selected' : '' }}>Harga Terendah</option>
                                <option value="harga_desc" {{ request('sort') == 'harga_desc' ? 'selected' : '' }}>Harga Tertinggi</option>
                                <option value="nama_asc" {{ request('sort') == 'nama_asc' ? 'selected' : '' }}>Nama A-Z</option>
                                <option value="nama_desc" {{ request('sort') == 'nama_desc' ? 'selected' : '' }}>Nama Z-A</option>
                            </select>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Product Grid --}}
            @if($produks->count() > 0)
                <div class="row g-4">
                    @foreach($produks as $produk)
                        <div class="col-lg-4 col-md-6">
                            <div class="card h-100 product-card border-0 shadow-sm">
                                <div class="position-relative">
                                    <img
                                        src="{{ $produk->gambar && file_exists(public_path('uploads/produk/' . $produk->gambar))
                                            ? asset('uploads/produk/' . $produk->gambar)
                                            : 'https://via.placeholder.com/300x200/0067ae/fff?text=Produk' }}"
                                        class="card-img-top"
                                        alt="{{ $produk->nama }}"
                                        style="height: 200px; object-fit: cover;"
                                    >
                                    @if($produk->kategori)
                                        <span class="badge position-absolute top-0 start-0 m-2"
                                              style="background-color: var(--primary-red);">
                                            {{ $produk->kategori->nama }}
                                        </span>
                                    @endif
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title fw-bold mb-2">{{ $produk->nama }}</h5>
                                    <p class="card-text text-muted small mb-3 flex-grow-1">
                                        {{ \Illuminate\Support\Str::limit($produk->deskripsi ?? '', 80) }}
                                    </p>
                                    <div class="mt-auto">
                                        <div class="fw-bold mb-2" style="color: var(--primary-red); font-size: 1.1rem;">
                                            Rp {{ number_format($produk->harga, 0, ',', '.') }}
                                        </div>
                                        <a href="{{ route('produk.detail', $produk->slug) }}"
                                           class="btn btn-sm w-100"
                                           style="border: 1.5px solid var(--primary-red); color: var(--primary-red);">
                                            <i class="ri-eye-line me-1"></i> Detail
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Pagination --}}
                @if($produks->hasPages())
                    <div class="d-flex justify-content-center mt-5">
                        <nav>
                            <ul class="pagination mb-0">
                                @if ($produks->onFirstPage())
                                    <li class="page-item disabled"><span class="page-link"><i class="ri-arrow-left-s-line"></i></span></li>
                                @else
                                    <li class="page-item"><a class="page-link" href="{{ $produks->previousPageUrl() }}"><i class="ri-arrow-left-s-line"></i></a></li>
                                @endif

                                @foreach ($produks->getUrlRange(1, $produks->lastPage()) as $page => $url)
                                    @if ($page == $produks->currentPage())
                                        <li class="page-item active"><span class="page-link bg-primary-red border-primary-red">{{ $page }}</span></li>
                                    @else
                                        <li class="page-item"><a class="page-link text-primary-red border-primary-red" href="{{ $url }}">{{ $page }}</a></li>
                                    @endif
                                @endforeach

                                @if ($produks->hasMorePages())
                                    <li class="page-item"><a class="page-link" href="{{ $produks->nextPageUrl() }}"><i class="ri-arrow-right-s-line"></i></a></li>
                                @else
                                    <li class="page-item disabled"><span class="page-link"><i class="ri-arrow-right-s-line"></i></span></li>
                                @endif
                            </ul>
                        </nav>
                    </div>
                @endif
            @else
                {{-- Empty State --}}
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center py-5">
                        <i class="ri-inbox-line" style="font-size: 4rem; color: #ccc; display: block; margin-bottom: 1rem;"></i>
                        <h5 class="text-muted">Produk tidak ditemukan</h5>
                        <p class="text-muted small mb-3">Coba ubah kata kunci pencarian atau filter kategori Anda.</p>
                        <a href="{{ route('produk') }}" class="btn btn-outline-secondary btn-sm">
                            <i class="ri-reset-right-line me-1"></i> Reset Filter
                        </a>
                    </div>
                </div>
            @endif

        </div>
    </div>
</div>
@endsection
