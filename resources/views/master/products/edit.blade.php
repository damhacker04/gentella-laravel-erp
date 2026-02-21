@extends('layouts.app')
@section('title', 'Edit Produk')
@section('page-title', 'Edit Produk')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#">Master Data</a></li>
    <li class="breadcrumb-item"><a href="{{ route('master.products.index') }}">Produk</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection
@section('content')
<x-card title="Edit Produk: {{ $product->name }}">
    <form action="{{ route('master.products.update', $product) }}" method="POST">
        @csrf @method('PUT')
        @include('master.products._form')
        <hr>
        <div class="d-flex justify-content-end gap-2">
            <a href="{{ route('master.products.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left me-1"></i> Batal</a>
            <button type="submit" class="btn btn-accent"><i class="fas fa-save me-1"></i> Perbarui</button>
        </div>
    </form>
</x-card>
@endsection
