@extends('layouts.frontend')
@section('title', 'Kontak - Supermarket Bintang')

@section('content')
<!-- Hero Section -->
<section class="bg-primary-red text-white py-5 text-center">
    <div class="container">
        <h1 class="fw-bold mb-2">
            <i class="ri-contacts-line me-2"></i> Hubungi Kami
        </h1>
        <p class="mb-0 opacity-75">Kami siap membantu Anda. Jangan ragu untuk menghubungi kami.</p>
    </div>
</section>

<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="bg-light py-2">
    <div class="container">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Home</a></li>
            <li class="breadcrumb-item active text-primary-red" aria-current="page">Kontak</li>
        </ol>
    </div>
</nav>

<div class="container py-5">
    <!-- Two Column Layout -->
    <div class="row g-4">
        <!-- Left Column: Info Card -->
        <div class="col-md-5">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body p-4">
                    <h4 class="fw-bold mb-4">
                        <i class="ri-information-line me-2 text-primary-red"></i> Informasi Kontak
                    </h4>

                    <!-- Contact Cards -->
                    <div class="row g-3 mb-4">
                        <!-- Address Card -->
                        <div class="col-12">
                            <div class="d-flex align-items-center gap-3 p-3 rounded-3" style="background: linear-gradient(135deg, #cf1526 0%, #a0101e 100%); color: #fff;">
                                <div class="rounded-circle bg-white bg-opacity-25 d-flex align-items-center justify-content-center flex-shrink-0"
                                     style="width: 50px; height: 50px;">
                                    <i class="ri-map-pin-2-line fs-4"></i>
                                </div>
                                <div>
                                    <small class="opacity-75 text-uppercase small">Alamat</small>
                                    <p class="mb-0 fw-semibold">{{ $kontak->alamat ?? 'Jl. Bintang No. 123, Yogyakarta' }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Phone Card -->
                        <div class="col-12">
                            <div class="d-flex align-items-center gap-3 p-3 rounded-3" style="background: linear-gradient(135deg, #0067ae 0%, #004a7a 100%); color: #fff;">
                                <div class="rounded-circle bg-white bg-opacity-25 d-flex align-items-center justify-content-center flex-shrink-0"
                                     style="width: 50px; height: 50px;">
                                    <i class="ri-phone-line fs-4"></i>
                                </div>
                                <div>
                                    <small class="opacity-75 text-uppercase small">Telepon</small>
                                    <p class="mb-0 fw-semibold">{{ $kontak->telepon ?? '(0274) 123-4567' }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Email Card -->
                        <div class="col-12">
                            <div class="d-flex align-items-center gap-3 p-3 rounded-3" style="background: linear-gradient(135deg, #343a40 0%, #212529 100%); color: #fff;">
                                <div class="rounded-circle bg-white bg-opacity-25 d-flex align-items-center justify-content-center flex-shrink-0"
                                     style="width: 50px; height: 50px;">
                                    <i class="ri-mail-line fs-4"></i>
                                </div>
                                <div>
                                    <small class="opacity-75 text-uppercase small">Email</small>
                                    <p class="mb-0 fw-semibold">{{ $kontak->email ?? 'info@supermarketbintang.com' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Google Maps Embed -->
                    @if($kontak && $kontak->peta)
                        <div class="mt-4">
                            <h6 class="fw-bold mb-3">
                                <i class="ri-map-2-line me-1 text-primary-red"></i> Lokasi di Peta
                            </h6>
                            <div class="rounded overflow-hidden border">
                                {!! $kontak->peta !!}
                            </div>
                        </div>
                    @else
                        <div class="mt-4">
                            <h6 class="fw-bold mb-3">
                                <i class="ri-map-2-line me-1 text-primary-red"></i> Lokasi di Peta
                            </h6>
                            <div class="rounded border bg-light d-flex align-items-center justify-content-center text-muted"
                                 style="height: 200px;">
                                <div class="text-center">
                                    <i class="ri-map-2-line fs-1 d-block mb-2 opacity-50"></i>
                                    <small>Peta belum tersedia</small>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Right Column: Contact Form -->
        <div class="col-md-7">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <h4 class="fw-bold mb-4">
                        <i class="ri-send-plane-line me-2 text-primary-red"></i> Kirim Pesan
                    </h4>

                    <form action="#" method="GET">
                        <!-- Nama -->
                        <div class="mb-3">
                            <label for="nama" class="form-label fw-semibold">
                                <i class="ri-user-line me-1 text-primary-red"></i> Nama
                            </label>
                            <input type="text"
                                   class="form-control"
                                   id="nama"
                                   name="nama"
                                   placeholder="Masukkan nama lengkap Anda"
                                   required>
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">
                                <i class="ri-mail-line me-1 text-primary-red"></i> Email
                            </label>
                            <input type="email"
                                   class="form-control"
                                   id="email"
                                   name="email"
                                   placeholder="Masukkan email Anda"
                                   required>
                        </div>

                        <!-- Subjek -->
                        <div class="mb-3">
                            <label for="subjek" class="form-label fw-semibold">
                                <i class="ri-file-text-line me-1 text-primary-red"></i> Subjek
                            </label>
                            <input type="text"
                                   class="form-control"
                                   id="subjek"
                                   name="subject"
                                   placeholder="Masukkan subjek pesan"
                                   required>
                        </div>

                        <!-- Pesan -->
                        <div class="mb-4">
                            <label for="pesan" class="form-label fw-semibold">
                                <i class="ri-message-3-line me-1 text-primary-red"></i> Pesan
                            </label>
                            <textarea class="form-control"
                                      id="pesan"
                                      name="body"
                                      rows="5"
                                      placeholder="Tulis pesan Anda di sini..."
                                      required></textarea>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary-red w-100 py-2">
                            <i class="ri-send-plane-fill me-2"></i> Kirim Pesan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
