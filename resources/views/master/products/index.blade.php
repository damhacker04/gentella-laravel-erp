@extends('layouts.app')
@section('title', 'Data Produk')
@section('page-title', 'Data Produk')
@section('breadcrumb')
    <li class="breadcrumb-item active">Master Data</li>
    <li class="breadcrumb-item active">Produk</li>
@endsection
@section('page-actions')
    @can('master.products.create')
    <a href="{{ route('master.products.create') }}" class="btn btn-accent"><i class="fas fa-plus me-1"></i> Tambah Produk</a>
    @endcan
@endsection
@section('content')
<x-card title="Daftar Produk">
    <x-data-table id="products-table">
        <x-slot name="head">
            <th style="width:50px">No</th><th>SKU</th><th>Nama Produk</th><th>Satuan</th><th class="text-end">Harga</th><th>Status</th><th style="width:120px">Aksi</th>
        </x-slot>
        <x-slot name="body">
            @foreach($products as $i => $product)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td><strong>{{ $product->sku }}</strong></td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->unit }}</td>
                <td class="text-end">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                <td><x-status-badge :status="$product->is_active ? 'ACTIVE' : 'INACTIVE'" /></td>
                <td>
                    <x-btn-action
                        :show-route="route('master.products.show', $product)"
                        :edit-route="route('master.products.edit', $product)"
                        :delete-route="route('master.products.destroy', $product)"
                    />
                </td>
            </tr>
            @endforeach
        </x-slot>
    </x-data-table>
</x-card>
@endsection
