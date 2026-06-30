@extends('layouts.admin')
@section('title', 'Kelola Kategori')
@section('page-title', 'Kelola Kategori')

@section('content')
<div class="page-header d-flex justify-content-between align-items-center">
    <h4 class="mb-0">Data Kategori</h4>
    <a href="{{ route('admin.kategori.create') }}" class="btn btn-primary-red">
        <i class="ri-add-line"></i> Tambah Kategori
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th width="50">No</th>
                        <th>Nama Kategori</th>
                        <th>Slug</th>
                        <th>Deskripsi</th>
                        <th width="150">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kategoris as $key => $kategori)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $kategori->nama }}</td>
                        <td><code>{{ $kategori->slug }}</code></td>
                        <td>{{ Str::limit($kategori->deskripsi, 50) }}</td>
                        <td>
                            <a href="{{ route('admin.kategori.edit', $kategori->id) }}" class="btn btn-sm btn-outline-primary">
                                <i class="ri-edit-line"></i>
                            </a>
                            <form action="{{ route('admin.kategori.destroy', $kategori->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus kategori ini?')">
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
                        <td colspan="5" class="text-center py-4">Belum ada data kategori</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
