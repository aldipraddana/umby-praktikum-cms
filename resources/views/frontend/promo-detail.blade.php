@extends('layouts.frontend')

@section('title', $promo->judul . ' - Supermarket Bintang')

@section('content')
<div class="container py-4">

    {{-- Breadcrumb --}}
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('promo') }}">Promo</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $promo->judul }}</li>
        </ol>
    </nav>

    {{-- Full Banner Image --}}
    <div class="mb-4">
        <img
            src="{{ $promo->gambar && file_exists(public_path('uploads/promo/' . $promo->gambar))
                ? asset('uploads/promo/' . $promo->gambar)
                : 'https://via.placeholder.com/1200x400/cf1526/fff?text=Promo+' . ($promo->diskon_persen ? $promo->diskon_persen . '%20OFF' : '') }}"
            class="card-img-top w-100"
            alt="{{ $promo->judul }}"
            style="height: 400px; object-fit: cover; border-radius: 10px;"
        >
    </div>

    {{-- Promo Info Card --}}
    <div class="row g-4 mb-4">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    {{-- Diskon Badge --}}
                    @if($promo->diskon_persen)
                        <span class="badge mb-3 d-inline-block px-3 py-2"
                              style="background-color: var(--primary-red); font-size: 1.2rem;">
                            <i class="ri-discount-percent-line me-1"></i>
                            {{ $promo->diskon_persen }}% OFF
                        </span>
                    @endif

                    {{-- Judul Promo --}}
                    <h2 class="fw-bold mb-3">{{ $promo->judul }}</h2>

                    {{-- Deskripsi --}}
                    <p class="text-muted mb-0" style="line-height: 1.8; font-size: 1.05rem;">
                        {{ $promo->deskripsi ?? 'Deskripsi promo tidak tersedia.' }}
                    </p>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <h5 class="fw-bold mb-3">
                        <i class="ri-information-line me-1" style="color: var(--primary-red);"></i>
                        Detail Promo
                    </h5>

                    {{-- Info Table --}}
                    <table class="table table-borderless mb-0">
                        <tbody>
                            <tr>
                                <th class="text-nowrap ps-0" style="width: 120px;">
                                    <i class="ri-percent-line me-1 text-muted"></i>Diskon
                                </th>
                                <td class="fw-bold" style="color: var(--primary-red);">
                                    {{ $promo->diskon_persen ? $promo->diskon_persen . '%' : '-' }}
                                </td>
                            </tr>
                            <tr>
                                <th class="ps-0">
                                    <i class="ri-calendar-line me-1 text-muted"></i>Periode
                                </th>
                                <td>
                                    @if($promo->tanggal_mulai || $promo->tanggal_berakhir)
                                        <small>
                                            {{ $promo->tanggal_mulai ? \Carbon\Carbon::parse($promo->tanggal_mulai)->format('d M Y') : '-' }}
                                            <br>s/d
                                            <br>
                                            {{ $promo->tanggal_berakhir ? \Carbon\Carbon::parse($promo->tanggal_berakhir)->format('d M Y') : '-' }}
                                        </small>
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th class="ps-0">
                                    <i class="ri-checkbox-circle-line me-1 text-muted"></i>Status
                                </th>
                                <td>
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
                                    <span class="badge {{ $statusClass }}">
                                        <i class="ri-circle-fill me-1" style="font-size: 0.5rem;"></i>
                                        {{ $statusLabel }}
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- CTA Section --}}
    <div class="text-center py-4 rounded-3" style="background-color: var(--primary-red);">
        <div class="container">
            <h4 class="fw-bold text-white mb-2">
                <i class="ri-store-2-line me-2"></i>Siap Menikmati Promo Ini?
            </h4>
            <p class="text-white mb-3 opacity-75">Kunjungi Supermarket Bintang sekarang dan jangan sampai kehabisan!</p>
            <a href="{{ route('kontak') }}" class="btn btn-light btn-lg fw-semibold px-4">
                <i class="ri-arrow-right-line me-2"></i>Kunjungi Supermarket
            </a>
        </div>
    </div>

</div>
@endsection
