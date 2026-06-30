@extends('layouts.admin')
@section('title', 'Kelola Kontak')
@section('page-title', 'Kelola Kontak')

@section('content')
<div class="page-header">
    <h4 class="mb-0"><i class="ri-contacts-line me-2"></i>Pengaturan Kontak</h4>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.kontak.update', $kontak->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" rows="4">{{ old('alamat', $kontak->alamat) }}</textarea>
                        @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="peta" class="form-label">Peta (Iframe Embed)</label>
                        <textarea class="form-control @error('peta') is-invalid @enderror" id="peta" name="peta" rows="4" placeholder="<iframe src='...'></iframe>">{{ old('peta', $kontak->peta) }}</textarea>
                        @error('peta')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Masukkan kode iframe Google Maps atau peta lainnya.</small>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="telepon" class="form-label">Telepon</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="ri-phone-line"></i></span>
                            <input type="text" class="form-control @error('telepon') is-invalid @enderror" id="telepon" name="telepon" value="{{ old('telepon', $kontak->telepon) }}" placeholder="021-xxxxxxx">
                            @error('telepon')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="ri-mail-line"></i></span>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $kontak->email) }}" placeholder="info@bintang.com">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            @if($kontak->peta)
                <div class="mb-3">
                    <label class="form-label">Preview Peta</label>
                    <div class="border rounded p-2 bg-light">
                        {!! $kontak->peta !!}
                    </div>
                </div>
            @endif

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary-red">
                    <i class="ri-save-line me-1"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
