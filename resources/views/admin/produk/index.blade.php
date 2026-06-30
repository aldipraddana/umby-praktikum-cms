@extends('layouts.admin')
@section('title', 'Kelola Produk')
@section('page-title', 'Kelola Produk')

@section('content')
<div class="page-header d-flex justify-content-between align-items-center">
    <h4 class="mb-0">Data Produk</h4>
    <a href="{{ route('admin.produk.create') }}" class="btn btn-primary-red">
        <i class="ri-add-line"></i> Tambah Produk
    </a>
</div>

<div class="card">
    <div class="card-body">
        {{-- Search & Filter Form --}}
        <form method="GET" action="{{ route('admin.produk.index') }}" class="row g-3 mb-4">
            <div class="col-md-4">
                <div class="input-group">
                    <span class="input-group-text bg-white">
                        <i class="ri-search-line text-muted"></i>
                    </span>
                    <input type="text" name="search" class="form-control" placeholder="Cari nama produk..." value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-md-3">
                <select name="kategori_id" class="form-select">
                    <option value="">-- Semua Kategori --</option>
                    @foreach($kategoris as $kategori)
                        <option value="{{ $kategori->id }}" {{ request('kategori_id') == $kategori->id ? 'selected' : '' }}>
                            {{ $kategori->nama }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary-blue w-100">
                    <i class="ri-filter-line me-1"></i> Filter
                </button>
            </div>
            <div class="col-md-2">
                <a href="{{ route('admin.produk.index') }}" class="btn btn-outline-secondary w-100">
                    <i class="ri-reset-right-line me-1"></i> Reset
                </a>
            </div>
        </form>

        {{-- Table --}}
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th width="60">No</th>
                        <th width="80">Gambar</th>
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th width="100">Status</th>
                        <th width="120">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($produks as $key => $produk)
                    <tr>
                        <td>{{ $produks->firstItem() + $key }}</td>
                        <td>
                            @if($produk->gambar && file_exists(public_path('uploads/produk/' . $produk->gambar)))
                                <img src="{{ asset('uploads/produk/' . $produk->gambar) }}" alt="{{ $produk->nama }}"
                                     style="width: 60px; height: 60px; object-fit: cover; border-radius: 8px;">
                            @else
                                <div class="bg-light d-flex align-items-center justify-content-center"
                                     style="width: 60px; height: 60px; border-radius: 8px;">
                                    <i class="ri-image-line text-muted" style="font-size: 1.5rem;"></i>
                                </div>
                            @endif
                        </td>
                        <td>{{ $produk->nama }}</td>
                        <td>{{ $produk->kategori->nama ?? '-' }}</td>
                        <td>Rp {{ number_format($produk->harga, 0, ',', '.') }}</td>
                        <td>
                            @if($produk->stok <= 0)
                                <span class="badge bg-danger">Habis</span>
                            @elseif($produk->stok <= 10)
                                <span class="badge bg-warning text-dark">{{ $produk->stok }}</span>
                            @else
                                <span class="badge bg-success">{{ $produk->stok }}</span>
                            @endif
                        </td>
                        <td>
                            @if($produk->is_active)
                                <span class="badge bg-primary-red">Aktif</span>
                            @else
                                <span class="badge bg-secondary">Nonaktif</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.produk.edit', $produk->id) }}" class="btn btn-sm btn-outline-primary">
                                <i class="ri-edit-line"></i>
                            </a>
                            <form action="{{ route('admin.produk.destroy', $produk->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus produk ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    <i class="ri-delete-bin-line"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-4">
                            <i class="ri-inbox-line" style="font-size: 2rem; display: block; color: #aaa; margin-bottom: 8px;"></i>
                            Belum ada data produk
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($produks->hasPages())
        <div class="d-flex justify-content-center mt-3">
            <nav>
                <ul class="pagination mb-0">
                    @if ($produks->onFirstPage())
                        <li class="page-item disabled"><span class="page-link"><i class="ri-arrow-left-s-line"></i></span></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $produks->previousPageUrl() }}"><i class="ri-arrow-left-s-line"></i></a></li>
                    @endif

                    @foreach ($produks->getUrlRange(1, $produks->lastPage()) as $page => $url)
                        @if ($page == $produks->currentPage())
                            <li class="page-item active"><span class="page-link bg-primary-red border-primary-red">{{ $page }}</span></li>
                        @else
                            <li class="page-item"><a class="page-link text-primary-red border-primary-red" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach

                    @if ($produks->hasMorePages())
                        <li class="page-item"><a class="page-link" href="{{ $produks->nextPageUrl() }}"><i class="ri-arrow-right-s-line"></i></a></li>
                    @else
                        <li class="page-item disabled"><span class="page-link"><i class="ri-arrow-right-s-line"></i></span></li>
                    @endif
                </ul>
            </nav>
        </div>
        @endif
    </div>
</div>
@endsection
