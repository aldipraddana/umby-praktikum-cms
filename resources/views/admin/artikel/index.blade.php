@extends('layouts.admin')
@section('title', 'Kelola Artikel')
@section('page-title', 'Kelola Artikel')

@section('content')
<div class="page-header d-flex justify-content-between align-items-center">
    <h4 class="mb-0">Data Artikel</h4>
    <a href="{{ route('admin.artikel.create') }}" class="btn btn-primary-red">
        <i class="ri-add-line"></i> Tambah Artikel
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th width="50">No</th>
                        <th width="120">Gambar</th>
                        <th>Judul</th>
                        <th>Penulis</th>
                        <th width="100">Status</th>
                        <th width="120">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($artikels as $key => $artikel)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>
                            @if($artikel->gambar && file_exists(public_path('uploads/artikel/' . $artikel->gambar)))
                                <img src="{{ asset('uploads/artikel/' . $artikel->gambar) }}"
                                     alt="{{ $artikel->judul }}"
                                     class="rounded"
                                     style="width: 100px; height: 60px; object-fit: cover;">
                            @else
                                <div class="bg-light rounded d-flex align-items-center justify-content-center"
                                     style="width: 100px; height: 60px;">
                                    <i class="ri-image-line text-muted"></i>
                                </div>
                            @endif
                        </td>
                        <td>
                            <strong>{{ $artikel->judul }}</strong>
                            @if($artikel->konten)
                                <br><small class="text-muted">{{ Str::limit(strip_tags($artikel->konten), 80) }}</small>
                            @endif
                        </td>
                        <td>
                            <i class="ri-user-line me-1 text-muted"></i>{{ $artikel->penulis ?? '-' }}
                        </td>
                        <td>
                            @if($artikel->is_active)
                                <span class="badge bg-success">Aktif</span>
                            @else
                                <span class="badge bg-secondary">Nonaktif</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.artikel.edit', $artikel->id) }}" class="btn btn-sm btn-outline-primary">
                                <i class="ri-edit-line"></i>
                            </a>
                            <form action="{{ route('admin.artikel.destroy', $artikel->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus artikel ini?')">
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
                        <td colspan="6" class="text-center py-4">Belum ada data artikel</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
