@extends('layouts.admin')
@section('title', 'Edit Promo')
@section('page-title', 'Edit Promo')

@section('content')
<div class="page-header">
    <h4 class="mb-0"><i class="ri-edit-line me-2"></i>Edit Promo</h4>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.promo.update', $promo->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul Promo <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" value="{{ old('judul', $promo->judul) }}" required>
                        @error('judul')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="4">{{ old('deskripsi', $promo->deskripsi) }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="diskon_persen" class="form-label">Diskon (%) <span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('diskon_persen') is-invalid @enderror" id="diskon_persen" name="diskon_persen" value="{{ old('diskon_persen', $promo->diskon_persen) }}" min="0" max="100" required>
                                @error('diskon_persen')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="is_active" class="form-label">Status</label>
                                <div class="form-check form-switch mt-2">
                                    <input class="form-check-input" type="checkbox" role="switch" id="is_active" name="is_active" value="1" {{ old('is_active', $promo->is_active) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_active">Aktif</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="tanggal_mulai" class="form-label">Tanggal Mulai <span class="text-danger">*</span></label>
                                <input type="datetime-local" class="form-control @error('tanggal_mulai') is-invalid @enderror" id="tanggal_mulai" name="tanggal_mulai" value="{{ old('tanggal_mulai', $promo->tanggal_mulai ? \Carbon\Carbon::parse($promo->tanggal_mulai)->format('Y-m-d\TH:i') : '') }}" required>
                                @error('tanggal_mulai')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="tanggal_berakhir" class="form-label">Tanggal Berakhir <span class="text-danger">*</span></label>
                                <input type="datetime-local" class="form-control @error('tanggal_berakhir') is-invalid @enderror" id="tanggal_berakhir" name="tanggal_berakhir" value="{{ old('tanggal_berakhir', $promo->tanggal_berakhir ? \Carbon\Carbon::parse($promo->tanggal_berakhir)->format('Y-m-d\TH:i') : '') }}" required>
                                @error('tanggal_berakhir')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="gambar" class="form-label">Gambar Promo</label>
                        <div class="border rounded p-3 text-center bg-light">
                            @if($promo->gambar && file_exists(public_path('uploads/promo/' . $promo->gambar)))
                                <img id="preview-gambar" src="{{ asset('uploads/promo/' . $promo->gambar) }}" alt="{{ $promo->judul }}" class="img-fluid rounded mb-2" style="max-height: 200px;">
                            @else
                                <img id="preview-gambar" src="#" alt="Preview" class="img-fluid rounded mb-2" style="display: none; max-height: 200px;">
                            @endif
                            <i id="preview-icon" class="ri-image-add-line" style="font-size: 3rem; color: #adb5bd; {{ $promo->gambar ? 'display:none;' : '' }}"></i>
                            <p class="text-muted small mb-2">Format: JPG, PNG, WEBP. Maks 2MB.</p>
                            <input type="file" class="form-control @error('gambar') is-invalid @enderror" id="gambar" name="gambar" accept="image/*" onchange="previewImage(this)">
                            @error('gambar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            @if($promo->gambar)
                                <small class="text-muted d-block mt-2">Biarkan kosong jika tidak ingin更换 gambar.</small>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex gap-2 mt-3">
                <button type="submit" class="btn btn-primary-red">
                    <i class="ri-save-line me-1"></i> Update
                </button>
                <a href="{{ route('admin.promo.index') }}" class="btn btn-outline-secondary">
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
