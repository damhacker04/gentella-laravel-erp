@extends('layouts.app')
@section('title', 'Tambah Gudang')
@section('page-title', 'Tambah Gudang')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#">Master Data</a></li>
    <li class="breadcrumb-item"><a href="{{ route('master.warehouses.index') }}">Gudang</a></li>
    <li class="breadcrumb-item active">Tambah</li>
@endsection
@section('content')
<x-card title="Form Gudang Baru">
    <form action="{{ route('master.warehouses.store') }}" method="POST">
        @csrf
        @include('master.warehouses._form')
        <hr>
        <div class="d-flex justify-content-end gap-2">
            <a href="{{ route('master.warehouses.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left me-1"></i> Batal</a>
            <button type="submit" class="btn btn-accent"><i class="fas fa-save me-1"></i> Simpan</button>
        </div>
    </form>
</x-card>
@endsection
