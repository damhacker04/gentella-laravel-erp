@extends('layouts.app')

@section('title', 'Edit Pelanggan')
@section('page-title', 'Edit Pelanggan')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#">Master Data</a></li>
    <li class="breadcrumb-item"><a href="{{ route('master.customers.index') }}">Pelanggan</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
<x-card title="Edit Pelanggan: {{ $customer->name }}">
    <form action="{{ route('master.customers.update', $customer) }}" method="POST">
        @csrf
        @method('PUT')
        @include('master.customers._form')

        <hr>
        <div class="d-flex justify-content-end gap-2">
            <a href="{{ route('master.customers.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Batal
            </a>
            <button type="submit" class="btn btn-accent">
                <i class="fas fa-save me-1"></i> Perbarui
            </button>
        </div>
    </form>
</x-card>
@endsection
