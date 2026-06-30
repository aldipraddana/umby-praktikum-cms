@extends('layouts.admin')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="row g-4">
    <div class="col-md-6 col-xl-3">
        <div class="card h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-2">Total Kategori</h6>
                        <h3 class="mb-0">{{ $totalKategori }}</h3>
                    </div>
                    <div class="rounded-circle bg-primary-red bg-opacity-10 p-3">
                        <i class="ri-folder-line ri-2x text-primary-red"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-2">Total Produk</h6>
                        <h3 class="mb-0">{{ $totalProduk }}</h3>
                    </div>
                    <div class="rounded-circle bg-primary-blue bg-opacity-10 p-3">
                        <i class="ri-shopping-bag-3-line ri-2x text-primary-blue"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-2">Promo Aktif</h6>
                        <h3 class="mb-0">{{ $totalPromoAktif }}</h3>
                    </div>
                    <div class="rounded-circle bg-success bg-opacity-10 p-3">
                        <i class="ri-price-tag-3-line ri-2x text-success"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-2">Total Artikel</h6>
                        <h3 class="mb-0">{{ $totalArtikel }}</h3>
                    </div>
                    <div class="rounded-circle bg-warning bg-opacity-10 p-3">
                        <i class="ri-article-line ri-2x text-warning"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mt-2">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0"><i class="ri-information-line me-2"></i>Selamat Datang di Panel Admin</h5>
            </div>
            <div class="card-body">
                <p class="mb-0">Kelola konten website Supermarket Bintang melalui menu-menu di sidebar. Anda dapat mengelola produk, kategori, promo, artikel, banner, informasi kontak, dan user admin.</p>
            </div>
        </div>
    </div>
</div>
@endsection
