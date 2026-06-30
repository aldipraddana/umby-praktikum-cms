@extends('layouts.admin')
@section('title', 'Edit Produk')
@section('page-title', 'Edit Produk')

@section('content')
<div class="page-header">
    <h4 class="mb-0"><i class="ri-edit-line me-2"></i>Edit Produk</h4>
</div>

<div class="card">
    <div class="card-body">
        @include('admin.produk._form', [
            'action' => route('admin.produk.update', $produk->id),
            'method' => 'PUT'
        ])
    </div>
</div>
@endsection
