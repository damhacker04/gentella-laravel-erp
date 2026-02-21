@extends('layouts.app')
@section('title', 'Tambah Produk')
@section('page-title', 'Tambah Produk')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#">Master Data</a></li>
    <li class="breadcrumb-item"><a href="{{ route('master.products.index') }}">Produk</a></li>
    <li class="breadcrumb-item active">Tambah</li>
@endsection
@section('content')
<x-card title="Form Produk Baru">
    <form action="{{ route('master.products.store') }}" method="POST">
        @csrf
        @include('master.products._form')
        <hr>
        <div class="d-flex justify-content-end gap-2">
            <a href="{{ route('master.products.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left me-1"></i> Batal</a>
            <button type="submit" class="btn btn-accent"><i class="fas fa-save me-1"></i> Simpan</button>
        </div>
    </form>
</x-card>
@endsection
