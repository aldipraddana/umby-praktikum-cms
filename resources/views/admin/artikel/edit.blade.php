@extends('layouts.admin')
@section('title', 'Edit Artikel')
@section('page-title', 'Edit Artikel')

@section('content')
<div class="page-header">
    <h4 class="mb-0"><i class="ri-edit-line me-2"></i>Edit Artikel</h4>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.artikel.update', $artikel->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul Artikel <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" value="{{ old('judul', $artikel->judul) }}" required>
                        @error('judul')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="konten" class="form-label">Konten <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('konten') is-invalid @enderror" id="konten" name="konten" rows="12">{{ old('konten', $artikel->konten) }}</textarea>
                        @error('konten')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="gambar" class="form-label">Gambar Artikel</label>
                        <div class="border rounded p-3 text-center bg-light">
                            @if($artikel->gambar && file_exists(public_path('uploads/artikel/' . $artikel->gambar)))
                                <img id="preview-gambar" src="{{ asset('uploads/artikel/' . $artikel->gambar) }}" alt="{{ $artikel->judul }}" class="img-fluid rounded mb-2" style="max-height: 200px;">
                            @else
                                <img id="preview-gambar" src="#" alt="Preview" class="img-fluid rounded mb-2" style="display: none; max-height: 200px;">
                            @endif
                            <i id="preview-icon" class="ri-image-add-line" style="font-size: 3rem; color: #adb5bd; {{ $artikel->gambar ? 'display:none;' : '' }}"></i>
                            <p class="text-muted small mb-2">Format: JPG, PNG, WEBP. Maks 2MB.</p>
                            <input type="file" class="form-control @error('gambar') is-invalid @enderror" id="gambar" name="gambar" accept="image/*" onchange="previewImage(this)">
                            @error('gambar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            @if($artikel->gambar)
                                <small class="text-muted d-block mt-2">Biarkan kosong jika tidak ingin更换 gambar.</small>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="penulis" class="form-label">Penulis</label>
                        <input type="text" class="form-control @error('penulis') is-invalid @enderror" id="penulis" name="penulis" value="{{ old('penulis', $artikel->penulis) }}">
                        @error('penulis')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="is_active" class="form-label">Status</label>
                        <div class="form-check form-switch mt-2">
                            <input class="form-check-input" type="checkbox" role="switch" id="is_active" name="is_active" value="1" {{ old('is_active', $artikel->is_active) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">Publikasi</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex gap-2 mt-3">
                <button type="submit" class="btn btn-primary-red">
                    <i class="ri-save-line me-1"></i> Update
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
