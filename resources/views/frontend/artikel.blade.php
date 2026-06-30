@extends('layouts.frontend')
@section('title', 'Artikel - Supermarket Bintang')

@section('content')
<!-- Hero Section -->
<section class="bg-primary-blue text-white py-5">
    <div class="container">
        <div class="text-center">
            <h1 class="fw-bold mb-2">Artikel & Berita</h1>
            <p class="mb-0 opacity-75">Temukan informasi terbaru dari Supermarket Bintang</p>
        </div>
    </div>
</section>

<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="bg-light py-2">
    <div class="container">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Home</a></li>
            <li class="breadcrumb-item active text-primary-blue" aria-current="page">Artikel</li>
        </ol>
    </div>
</nav>

<div class="container py-5">
    <!-- Search Bar -->
    <div class="row justify-content-center mb-5">
        <div class="col-lg-8">
            <form action="{{ route('artikel') }}" method="GET" class="d-flex gap-2">
                <input type="text"
                       name="search"
                       class="form-control form-control-lg"
                       placeholder="Cari artikel..."
                       value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary-red px-4">
                    <i class="ri-search-line me-1"></i> Cari
                </button>
            </form>
        </div>
    </div>

    <!-- Article Grid -->
    <div class="row g-4">
    @forelse($artikels as $artikel)
        <div class="col-md-4">
            <div class="card h-100 shadow-sm border-0 article-card">
                @if($artikel->gambar && file_exists(public_path('uploads/artikel/' . $artikel->gambar)))
                    <img src="{{ asset('uploads/artikel/' . $artikel->gambar) }}"
                         alt="{{ $artikel->judul }}"
                         class="card-img-top"
                         style="height: 200px; object-fit: cover;">
                @else
                    <img src="https://via.placeholder.com/400x200/0067ae/fff?text=Artikel"
                         alt="{{ $artikel->judul }}"
                         class="card-img-top"
                         style="height: 200px; object-fit: cover;">
                @endif
                <div class="card-body">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <span class="badge bg-primary-blue">Artikel</span>
                        <small class="text-muted">
                            <i class="ri-calendar-line me-1"></i>
                            {{ $artikel->created_at->format('d M Y') }}
                        </small>
                    </div>
                    <h5 class="card-title fw-bold" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                        {{ $artikel->judul }}
                    </h5>
                    <p class="card-text text-muted small">
                        {{ Str::limit(strip_tags($artikel->konten), 100) }}
                    </p>
                    <div class="d-flex align-items-center justify-content-between mt-3">
                        <span class="small text-muted">
                            <i class="ri-user-line me-1"></i> {{ $artikel->penulis ?? 'Admin' }}
                        </span>
                        <a href="{{ route('artikel.detail', $artikel->slug) }}" class="btn btn-sm btn-outline-primary-blue">
                            Baca Selengkapnya <i class="ri-arrow-right-line ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12 text-center py-5">
            <i class="ri-article-line display-1 text-muted mb-3 d-block"></i>
            <p class="text-muted fs-5">Artikel tidak ditemukan</p>
            @if(request('search'))
                <a href="{{ route('artikel') }}" class="btn btn-outline-primary-blue mt-2">
                    <i class="ri-arrow-go-back-line me-1"></i> Kembali ke Semua Artikel
                </a>
            @endif
        </div>
    @endforelse
    </div>

    <!-- Pagination -->
    @if($artikels->hasPages())
    <div class="d-flex justify-content-center mt-4">
        <nav aria-label="Article pagination">
            <ul class="pagination mb-0">
                {{-- Previous Page Link --}}
                @if ($artikels->onFirstPage())
                    <li class="page-item disabled">
                        <span class="page-link"><i class="ri-arrow-left-s-line"></i></span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $artikels->previousPageUrl() }}" rel="prev">
                            <i class="ri-arrow-left-s-line"></i>
                        </a>
                    </li>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($artikels->getUrlRange(1, $artikels->lastPage()) as $page => $url)
                    @if ($page == $artikels->currentPage())
                        <li class="page-item active">
                            <span class="page-link bg-primary-blue border-primary-blue">{{ $page }}</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link text-primary-blue border-primary-blue" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($artikels->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $artikels->nextPageUrl() }}" rel="next">
                            <i class="ri-arrow-right-s-line"></i>
                        </a>
                    </li>
                @else
                    <li class="page-item disabled">
                        <span class="page-link"><i class="ri-arrow-right-s-line"></i></span>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
    @endif
</div>
@endsection

@push('styles')
<style>
    .article-card {
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .article-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.1) !important;
    }
    .btn-outline-primary-blue {
        color: var(--primary-blue);
        border-color: var(--primary-blue);
    }
    .btn-outline-primary-blue:hover {
        background-color: var(--primary-blue);
        border-color: var(--primary-blue);
        color: white;
    }
    .btn-outline-primary-blue:focus {
        box-shadow: 0 0 0 0.25rem rgba(0, 103, 174, 0.25);
    }
</style>
@endpush
