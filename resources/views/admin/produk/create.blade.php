@extends('layouts.admin')
@section('title', 'Tambah Produk')
@section('page-title', 'Tambah Produk')

@section('content')
<div class="page-header">
    <h4 class="mb-0"><i class="ri-add-circle-line me-2"></i>Tambah Produk Baru</h4>
</div>

<div class="card">
    <div class="card-body">
        @include('admin.produk._form', ['action' => route('admin.produk.store'), 'method' => 'POST'])
    </div>
</div>
@endsection
