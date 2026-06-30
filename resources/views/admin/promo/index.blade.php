@extends('layouts.admin')
@section('title', 'Kelola Promo')
@section('page-title', 'Kelola Promo')

@section('content')
<div class="page-header d-flex justify-content-between align-items-center">
    <h4 class="mb-0">Data Promo</h4>
    <a href="{{ route('admin.promo.create') }}" class="btn btn-primary-red">
        <i class="ri-add-line"></i> Tambah Promo
    </a>
</div>

<div class="card">
    <div class="card-body">
        {{-- Filter Tabs --}}
        <ul class="nav nav-tabs mb-3" id="promoFilterTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link {{ !request()->get('status') || request()->get('status') === 'semua' ? 'active' : '' }}"
                        id="tab-semua"
                        data-bs-toggle="tab"
                        data-bs-target="#filter-semua"
                        type="button"
                        onclick="window.location='{{ route('admin.promo.index') }}'">
                    <i class="ri-list-check me-1"></i> Semua
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link {{ request()->get('status') === 'aktif' ? 'active' : '' }}"
                        id="tab-aktif"
                        data-bs-toggle="tab"
                        data-bs-target="#filter-aktif"
                        type="button"
                        onclick="window.location='{{ route('admin.promo.index', ['status' => 'aktif']) }}'">
                    <i class="ri-checkbox-circle-line me-1"></i> Aktif
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link {{ request()->get('status') === 'berakhir' ? 'active' : '' }}"
                        id="tab-berakhir"
                        data-bs-toggle="tab"
                        data-bs-target="#filter-berakhir"
                        type="button"
                        onclick="window.location='{{ route('admin.promo.index', ['status' => 'berakhir']) }}'">
                    <i class="ri-time-line me-1"></i> Berakhir
                </button>
            </li>
        </ul>

        <div class="tab-content" id="promoFilterTabsContent">
            <div class="tab-pane fade show active" id="filter-semua" role="tabpanel">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th width="50">No</th>
                                <th width="120">Gambar</th>
                                <th>Judul</th>
                                <th width="100">Diskon (%)</th>
                                <th width="200">Periode</th>
                                <th width="100">Status</th>
                                <th width="120">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($promos as $key => $promo)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>
                                    @if($promo->gambar && file_exists(public_path('uploads/promo/' . $promo->gambar)))
                                        <img src="{{ asset('uploads/promo/' . $promo->gambar) }}"
                                             alt="{{ $promo->judul }}"
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
                                    <strong>{{ $promo->judul }}</strong>
                                    @if($promo->deskripsi)
                                        <br><small class="text-muted">{{ Str::limit($promo->deskripsi, 60) }}</small>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge bg-primary-blue">{{ $promo->diskon_persen }}%</span>
                                </td>
                                <td>
                                    <small>
                                        {{ $promo->tanggal_mulai ? \Carbon\Carbon::parse($promo->tanggal_mulai)->format('d M Y') : '-' }}
                                        <br>
                                        <span class="text-muted">s/d</span>
                                        <br>
                                        {{ $promo->tanggal_berakhir ? \Carbon\Carbon::parse($promo->tanggal_berakhir)->format('d M Y') : '-' }}
                                    </small>
                                </td>
                                <td>
                                    @php
                                        $now = \Carbon\Carbon::now();
                                        $mulai = $promo->tanggal_mulai ? \Carbon\Carbon::parse($promo->tanggal_mulai) : null;
                                        $berakhir = $promo->tanggal_berakhir ? \Carbon\Carbon::parse($promo->tanggal_berakhir) : null;

                                        if (!$promo->is_active) {
                                            $statusBadge = '<span class="badge bg-secondary">Nonaktif</span>';
                                        } elseif ($berakhir && $now->greaterThan($berakhir)) {
                                            $statusBadge = '<span class="badge bg-secondary">Berakhir</span>';
                                        } elseif ($mulai && $now->lessThan($mulai)) {
                                            $statusBadge = '<span class="badge bg-info">Menunggu</span>';
                                        } else {
                                            $statusBadge = '<span class="badge bg-success">Aktif</span>';
                                        }
                                    @endphp
                                    {!! $statusBadge !!}
                                </td>
                                <td>
                                    <a href="{{ route('admin.promo.edit', $promo->id) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="ri-edit-line"></i>
                                    </a>
                                    <form action="{{ route('admin.promo.destroy', $promo->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus promo ini?')">
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
                                <td colspan="7" class="text-center py-4">Belum ada data promo</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
