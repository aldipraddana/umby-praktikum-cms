@extends('layouts.frontend')
@section('title', $artikel->judul . ' - Supermarket Bintang')

@section('content')
<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="bg-light py-2">
    <div class="container">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('artikel') }}" class="text-decoration-none">Artikel</a></li>
            <li class="breadcrumb-item active text-primary-blue" aria-current="page">{{ Str::limit($artikel->judul, 40) }}</li>
        </ol>
    </div>
</nav>

<!-- Article Header Image -->
<div class="position-relative" style="height: 350px; overflow: hidden;">
    @if($artikel->gambar && file_exists(public_path('uploads/artikel/' . $artikel->gambar)))
        <img src="{{ asset('uploads/artikel/' . $artikel->gambar) }}"
             alt="{{ $artikel->judul }}"
             class="w-100 h-100"
             style="object-fit: cover;">
    @else
        <img src="https://via.placeholder.com/1200x350/0067ae/fff?text={{ urlencode($artikel->judul) }}"
             alt="{{ $artikel->judul }}"
             class="w-100 h-100"
             style="object-fit: cover;">
    @endif
    <div class="position-absolute top-0 start-0 w-100 h-100"
         style="background: linear-gradient(to bottom, rgba(0,0,0,0.1) 0%, rgba(0,0,0,0.5) 100%);">
    </div>
</div>

<!-- Article Content Section -->
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <article class="article-content">
                <!-- Category Badge -->
                <div class="mb-3">
                    <span class="badge bg-primary-blue py-2 px-3">
                        <i class="ri-article-line me-1"></i> Artikel
                    </span>
                </div>

                <!-- Article Title -->
                <h1 class="fw-bold mb-3">{{ $artikel->judul }}</h1>

                <!-- Article Meta -->
                <div class="d-flex flex-wrap align-items-center gap-4 text-muted mb-4">
                    <span>
                        <i class="ri-calendar-line me-1 text-primary-blue"></i>
                        {{ $artikel->created_at->format('d M Y') }}
                    </span>
                    <span>
                        <i class="ri-user-line me-1 text-primary-blue"></i>
                        {{ $artikel->penulis ?? 'Admin' }}
                    </span>
                    <span>
                        <i class="ri-chat-3-line me-1 text-primary-blue"></i>
                        {{ $artikel->komentar_count ?? 0 }} Komentar
                    </span>
                </div>

                <hr class="my-4">

                <!-- Article Body -->
                <div class="konten mb-5">
                    {!! nl2br(e($artikel->konten)) !!}
                </div>

                <hr class="my-4">

                <!-- Share Section -->
                <div class="share-section mb-5">
                    <div class="d-flex align-items-center gap-3">
                        <span class="fw-semibold text-secondary">
                            <i class="ri-share-line me-1"></i> Bagikan:
                        </span>
                        <a href="#" class="btn btn-sm btn-primary-red rounded-circle" title="Facebook">
                            <i class="ri-facebook-fill"></i>
                        </a>
                        <a href="#" class="btn btn-sm btn-primary-red rounded-circle" title="Twitter">
                            <i class="ri-twitter-x-line"></i>
                        </a>
                        <a href="#" class="btn btn-sm btn-primary-red rounded-circle" title="WhatsApp">
                            <i class="ri-whatsapp-line"></i>
                        </a>
                        <a href="#" class="btn btn-sm btn-primary-red rounded-circle" title="Telegram">
                            <i class="ri-telegram-line"></i>
                        </a>
                    </div>
                </div>

                <!-- Related Articles Section -->
                @if($artikelsLainnya->count() > 0)
                <div class="related-articles mt-5 pt-4 border-top">
                    <h4 class="fw-bold mb-4">
                        <i class="ri-book-read-line me-2 text-primary-blue"></i> Artikel Lainnya
                    </h4>
                    <div class="row g-4">
                        @foreach($artikelsLainnya as $item)
                        <div class="col-md-4">
                            <div class="card h-100 shadow-sm border-0 related-card">
                                @if($item->gambar && file_exists(public_path('uploads/artikel/' . $item->gambar)))
                                    <img src="{{ asset('uploads/artikel/' . $item->gambar) }}"
                                         alt="{{ $item->judul }}"
                                         class="card-img-top"
                                         style="height: 150px; object-fit: cover;">
                                @else
                                    <img src="https://via.placeholder.com/400x150/0067ae/fff?text=Artikel"
                                         alt="{{ $item->judul }}"
                                         class="card-img-top"
                                         style="height: 150px; object-fit: cover;">
                                @endif
                                <div class="card-body">
                                    <small class="text-muted d-block mb-1">
                                        <i class="ri-calendar-line me-1"></i>
                                        {{ $item->created_at->format('d M Y') }}
                                    </small>
                                    <h6 class="card-title fw-bold mb-0" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                        {{ $item->judul }}
                                    </h6>
                                </div>
                                <div class="card-footer bg-transparent border-0 pt-0">
                                    <a href="{{ route('artikel.detail', $item->slug) }}" class="btn btn-sm btn-outline-primary-blue w-100">
                                        Baca Selengkapnya
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </article>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .article-content .konten {
        font-size: 1.05rem;
        line-height: 1.8;
        color: #444;
    }
    .article-content .konten p {
        margin-bottom: 1rem;
    }
    .related-card {
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .related-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 20px rgba(0,0,0,0.08) !important;
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
</style>
@endpush
