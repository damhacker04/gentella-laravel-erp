@extends('layouts.app')
@section('title', 'Edit Supplier')
@section('page-title', 'Edit Supplier')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#">Master Data</a></li>
    <li class="breadcrumb-item"><a href="{{ route('master.suppliers.index') }}">Supplier</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection
@section('content')
<x-card title="Edit Supplier: {{ $supplier->name }}">
    <form action="{{ route('master.suppliers.update', $supplier) }}" method="POST">
        @csrf @method('PUT')
        @include('master.suppliers._form')
        <hr>
        <div class="d-flex justify-content-end gap-2">
            <a href="{{ route('master.suppliers.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left me-1"></i> Batal</a>
            <button type="submit" class="btn btn-accent"><i class="fas fa-save me-1"></i> Perbarui</button>
        </div>
    </form>
</x-card>
@endsection
