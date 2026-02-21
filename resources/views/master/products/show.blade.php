@extends('layouts.app')
@section('title', 'Detail Produk')
@section('page-title', 'Detail Produk')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#">Master Data</a></li>
    <li class="breadcrumb-item"><a href="{{ route('master.products.index') }}">Produk</a></li>
    <li class="breadcrumb-item active">{{ $product->sku }}</li>
@endsection
@section('page-actions')
    <div class="d-flex gap-2">
        @can('master.products.update')
        <a href="{{ route('master.products.edit', $product) }}" class="btn btn-warning"><i class="fas fa-edit me-1"></i> Edit</a>
        @endcan
        <a href="{{ route('master.products.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left me-1"></i> Kembali</a>
    </div>
@endsection
@section('content')
<x-card title="Informasi Produk">
    <table class="table table-borderless mb-0">
        <tr><td class="text-muted" style="width:180px">SKU</td><td><strong>{{ $product->sku }}</strong></td></tr>
        <tr><td class="text-muted">Nama</td><td>{{ $product->name }}</td></tr>
        <tr><td class="text-muted">Satuan</td><td>{{ $product->unit }}</td></tr>
        <tr><td class="text-muted">Harga</td><td>Rp {{ number_format($product->price, 0, ',', '.') }}</td></tr>
        <tr><td class="text-muted">Stok Minimum</td><td>{{ $product->stock_min ?? 0 }}</td></tr>
        <tr><td class="text-muted">Deskripsi</td><td>{{ $product->description ?? '-' }}</td></tr>
        <tr><td class="text-muted">Status</td><td><x-status-badge :status="$product->is_active ? 'ACTIVE' : 'INACTIVE'" /></td></tr>
    </table>
</x-card>
@endsection
