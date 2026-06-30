@extends('layouts.frontend')

@section('title', 'Promo - Supermarket Bintang')

@section('content')

{{-- Hero Banner --}}
<div class="py-5 text-center text-white" style="background-color: var(--primary-red);">
    <div class="container py-3">
        <h1 class="fw-bold mb-2">
            <i class="ri-price-tag-3-line me-2"></i>Promo Spesial
        </h1>
        <p class="lead opacity-75 mb-0">Jangan lewatkan berbagai promo menarik dari Supermarket Bintang</p>
    </div>
</div>

<div class="container py-4">

    {{-- Filter Tabs --}}
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body p-2">
            <ul class="nav nav-pills mb-0">
                <li class="nav-item">
                    <a class="nav-link {{ !request()->get('status') || request()->get('status') === 'semua' ? 'active' : '' }}"
                       href="{{ route('promo', ['status' => 'semua']) }}">
                        <i class="ri-list-check me-1"></i> Semua
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->get('status') === 'aktif' ? 'active' : '' }}"
                       href="{{ route('promo', ['status' => 'aktif']) }}">
                        <i class="ri-checkbox-circle-line me-1"></i> Promo Aktif
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->get('status') === 'berakhir' ? 'active' : '' }}"
                       href="{{ route('promo', ['status' => 'berakhir']) }}">
                        <i class="ri-time-line me-1"></i> Promo Berakhir
                    </a>
                </li>
            </ul>
        </div>
    </div>

    {{-- Promo Grid --}}
    @if($promos->count() > 0)
        <div class="row g-4">
            @foreach($promos as $promo)
                @php
                    $now = \Carbon\Carbon::now();
                    $mulai = $promo->tanggal_mulai ? \Carbon\Carbon::parse($promo->tanggal_mulai) : null;
                    $berakhir = $promo->tanggal_berakhir ? \Carbon\Carbon::parse($promo->tanggal_berakhir) : null;

                    if (!$promo->is_active) {
                        $statusLabel = 'Nonaktif';
                        $statusClass = 'bg-secondary';
                    } elseif ($berakhir && $now->greaterThan($berakhir)) {
                        $statusLabel = 'Berakhir';
                        $statusClass = 'bg-secondary';
                    } elseif ($mulai && $now->lessThan($mulai)) {
                        $statusLabel = 'Menunggu';
                        $statusClass = 'bg-info';
                    } else {
                        $statusLabel = 'Aktif';
                        $statusClass = 'bg-success';
                    }
                @endphp
                <div class="col-lg-4 col-md-6">
                    <div class="promo-card card mb-4 border-0 shadow-sm h-100">
                        {{-- Image --}}
                        <div class="position-relative">
                            <img
                                src="{{ $promo->gambar && file_exists(public_path('uploads/promo/' . $promo->gambar))
                                    ? asset('uploads/promo/' . $promo->gambar)
                                    : 'https://via.placeholder.com/400x220/cf1526/fff?text=Promo' }}"
                                class="card-img-top"
                                alt="{{ $promo->judul }}"
                                style="height: 220px; object-fit: cover;"
                            >
                            {{-- Diskon Badge --}}
                            @if($promo->diskon_persen)
                                <span class="promo-badge">
                                    {{ $promo->diskon_persen }}% OFF
                                </span>
                            @endif
                        </div>

                        {{-- Card Body --}}
                        <div class="card-body">
                            <h5 class="card-title fw-bold mb-2">{{ $promo->judul }}</h5>
                            <p class="card-text text-muted small mb-3">
                                {{ \Illuminate\Support\Str::limit($promo->deskripsi ?? '', 100) }}
                            </p>

                            {{-- Dates --}}
                            @if($promo->tanggal_mulai || $promo->tanggal_berakhir)
                                <div class="mb-3">
                                    <small class="text-muted d-block mb-1">
                                        <i class="ri-calendar-line me-1"></i>
                                        <strong>Periode:</strong>
                                    </small>
                                    <small class="text-muted">
                                        {{ $promo->tanggal_mulai ? \Carbon\Carbon::parse($promo->tanggal_mulai)->format('d M Y') : '-' }}
                                        <span class="mx-1">-</span>
                                        {{ $promo->tanggal_berakhir ? \Carbon\Carbon::parse($promo->tanggal_berakhir)->format('d M Y') : '-' }}
                                    </small>
                                </div>
                            @endif

                            {{-- Status Badge --}}
                            <span class="badge {{ $statusClass }}">
                                <i class="ri-circle-fill me-1" style="font-size: 0.5rem;"></i>
                                {{ $statusLabel }}
                            </span>
                        </div>

                        {{-- Card Footer --}}
                        <div class="card-footer bg-transparent border-0 pb-3">
                            <a href="{{ route('promo.detail', $promo->id) }}" class="btn btn-primary-red w-100">
                                <i class="ri-eye-line me-1"></i>Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        @if($promos->hasPages())
            <div class="d-flex justify-content-center mt-4">
                {{ $promos->withQueryString()->links() }}
            </div>
        @endif
    @else
        {{-- Empty State --}}
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center py-5">
                <i class="ri-price-tag-3-line" style="font-size: 4rem; color: #ccc; display: block; margin-bottom: 1rem;"></i>
                <h5 class="text-muted">Tidak ada promo</h5>
                <p class="text-muted small mb-3">Saat ini tidak ada promo yang tersedia. Cek kembali nanti!</p>
                <a href="{{ route('home') }}" class="btn btn-outline-secondary btn-sm">
                    <i class="ri-home-line me-1"></i>Kembali ke Home
                </a>
            </div>
        </div>
    @endif

</div>
@endsection
