@extends('layouts.admin')
@section('title', 'Kelola Banner')
@section('page-title', 'Kelola Banner')

@section('content')
<div class="page-header d-flex justify-content-between align-items-center">
    <h4 class="mb-0">Data Banner</h4>
    <a href="{{ route('admin.banner.create') }}" class="btn btn-primary-red">
        <i class="ri-add-line"></i> Tambah Banner
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th width="60">No</th>
                        <th width="180">Gambar</th>
                        <th>Judul</th>
                        <th>Link</th>
                        <th width="80">Urutan</th>
                        <th width="90">Status</th>
                        <th width="120">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($banners as $key => $banner)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>
                            @if($banner->gambar)
                                <img src="{{ asset('uploads/banner/' . $banner->gambar) }}" alt="{{ $banner->judul }}" class="img-thumbnail" style="width: 150px; height: 80px; object-fit: cover;">
                            @else
                                <span class="text-muted">Tidak ada gambar</span>
                            @endif
                        </td>
                        <td>{{ $banner->judul }}</td>
                        <td>
                            @if($banner->link)
                                <a href="{{ $banner->link }}" target="_blank" class="text-primary-blue text-truncate d-block" style="max-width: 150px;">
                                    <i class="ri-external-link-line me-1"></i>{{ $banner->link }}
                                </a>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>{{ $banner->urutan }}</td>
                        <td>
                            @if($banner->is_active)
                                <span class="badge bg-success">Aktif</span>
                            @else
                                <span class="badge bg-secondary">Nonaktif</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.banner.edit', $banner->id) }}" class="btn btn-sm btn-outline-primary">
                                <i class="ri-edit-line"></i>
                            </a>
                            <form action="{{ route('admin.banner.destroy', $banner->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus banner ini?')">
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
                        <td colspan="7" class="text-center py-4">Belum ada data banner</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
