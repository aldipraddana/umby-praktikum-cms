<form action="{{ $action }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if(isset($method) && $method === 'PUT')
        @method('PUT')
    @endif

    {{-- Kategori --}}
    <div class="mb-3">
        <label for="kategori_id" class="form-label">Kategori <span class="text-danger">*</span></label>
        <select class="form-select @error('kategori_id') is-invalid @enderror" id="kategori_id" name="kategori_id" required>
            <option value="">-- Pilih Kategori --</option>
            @foreach($kategoris as $kategori)
                <option value="{{ $kategori->id }}" {{ old('kategori_id', $produk->kategori_id ?? '') == $kategori->id ? 'selected' : '' }}>
                    {{ $kategori->nama }}
                </option>
            @endforeach
        </select>
        @error('kategori_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- Nama --}}
    <div class="mb-3">
        <label for="nama" class="form-label">Nama Produk <span class="text-danger">*</span></label>
        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama"
               value="{{ old('nama', $produk->nama ?? '') }}" required placeholder="Contoh: Beras Premium 5 kg">
        @error('nama')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- Deskripsi --}}
    <div class="mb-3">
        <label for="deskripsi" class="form-label">Deskripsi</label>
        <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi"
                  rows="4" placeholder="Deskripsi produk...">{{ old('deskripsi', $produk->deskripsi ?? '') }}</textarea>
        @error('deskripsi')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- Harga & Satuan row --}}
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="harga" class="form-label">Harga (Rp) <span class="text-danger">*</span></label>
            <div class="input-group">
                <span class="input-group-text">Rp</span>
                <input type="number" class="form-control @error('harga') is-invalid @enderror" id="harga"
                       name="harga" value="{{ old('harga', $produk->harga ?? '') }}" min="0" required
                       placeholder="0">
            </div>
            @error('harga')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-6 mb-3">
            <label for="satuan" class="form-label">Satuan <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('satuan') is-invalid @enderror" id="satuan"
                   name="satuan" value="{{ old('satuan', $produk->satuan ?? '') }}" required
                   placeholder="Contoh: kg, pcs, pack">
            @error('satuan')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    {{-- Stok --}}
    <div class="mb-3">
        <label for="stok" class="form-label">Stok <span class="text-danger">*</span></label>
        <input type="number" class="form-control @error('stok') is-invalid @enderror" id="stok"
               name="stok" value="{{ old('stok', $produk->stok ?? 0) }}" min="0" required
               placeholder="0">
        @error('stok')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- Gambar --}}
    <div class="mb-3">
        <label for="gambar" class="form-label">Gambar Produk</label>
        <input type="file" class="form-control @error('gambar') is-invalid @enderror" id="gambar"
               name="gambar" accept="image/*">
        @error('gambar')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        <small class="text-muted">Format: jpg, jpeg, png, webp. Maks 2MB.</small>

        {{-- Preview gambar lama saat edit --}}
        @if(isset($produk) && $produk->gambar && file_exists(public_path('uploads/produk/' . $produk->gambar)))
            <div class="mt-2">
                <small class="text-muted d-block mb-1">Gambar saat ini:</small>
                <img src="{{ asset('uploads/produk/' . $produk->gambar) }}" alt="{{ $produk->nama }}"
                     style="height: 100px; object-fit: cover; border-radius: 8px; border: 1px solid #dee2e6;">
            </div>
        @endif
    </div>

    {{-- is_active --}}
    <div class="mb-4">
        <div class="form-check">
            <input type="checkbox" class="form-check-input @error('is_active') is-invalid @enderror"
                   id="is_active" name="is_active" value="1"
                   {{ old('is_active', $produk->is_active ?? true) ? 'checked' : '' }}>
            <label class="form-check-label" for="is_active">
                Produk aktif / ditampilkan di website
            </label>
            @error('is_active')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    {{-- Actions --}}
    <div class="d-flex gap-2">
        <button type="submit" class="btn btn-primary-red">
            <i class="ri-save-line me-1"></i> {{ isset($produk) ? 'Update' : 'Simpan' }}
        </button>
        <a href="{{ route('admin.produk.index') }}" class="btn btn-outline-secondary">
            <i class="ri-arrow-left-line me-1"></i> Kembali
        </a>
    </div>
</form>
