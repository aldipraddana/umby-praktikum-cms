@extends('layouts.admin')
@section('title', 'Tambah Artikel')
@section('page-title', 'Tambah Artikel')

@section('content')
<div class="page-header">
    <h4 class="mb-0"><i class="ri-add-circle-line me-2"></i>Tambah Artikel Baru</h4>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.artikel.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul Artikel <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" value="{{ old('judul') }}" required>
                        @error('judul')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="konten" class="form-label">Konten <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('konten') is-invalid @enderror" id="konten" name="konten" rows="12">{{ old('konten') }}</textarea>
                        @error('konten')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="gambar" class="form-label">Gambar Artikel</label>
                        <div class="border rounded p-3 text-center bg-light">
                            <img id="preview-gambar" src="#" alt="Preview" class="img-fluid rounded mb-2" style="display: none; max-height: 200px;">
                            <i id="preview-icon" class="ri-image-add-line" style="font-size: 3rem; color: #adb5bd;"></i>
                            <p class="text-muted small mb-2">Format: JPG, PNG, WEBP. Maks 2MB.</p>
                            <input type="file" class="form-control @error('gambar') is-invalid @enderror" id="gambar" name="gambar" accept="image/*" onchange="previewImage(this)">
                            @error('gambar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="penulis" class="form-label">Penulis</label>
                        <input type="text" class="form-control @error('penulis') is-invalid @enderror" id="penulis" name="penulis" value="{{ old('penulis', Auth::user()->name) }}">
                        @error('penulis')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="is_active" class="form-label">Status</label>
                        <div class="form-check form-switch mt-2">
                            <input class="form-check-input" type="checkbox" role="switch" id="is_active" name="is_active" value="1" {{ old('is_active', '1') ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">Publikasi</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex gap-2 mt-3">
                <button type="submit" class="btn btn-primary-red">
                    <i class="ri-save-line me-1"></i> Simpan
                </button>
                <a href="{{ route('admin.artikel.index') }}" class="btn btn-outline-secondary">
                    <i class="ri-arrow-left-line me-1"></i> Kembali
                </a>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    function previewImage(input) {
        const preview = document.getElementById('preview-gambar');
        const icon = document.getElementById('preview-icon');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
                icon.style.display = 'none';
            };
            reader.readAsDataURL(input.files[0]);
        } else {
            preview.src = '#';
            preview.style.display = 'none';
            icon.style.display = 'block';
        }
    }
</script>
@endpush
@endsection
