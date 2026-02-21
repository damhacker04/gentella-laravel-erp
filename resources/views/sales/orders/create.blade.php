@extends('layouts.app')

@section('title', 'Buat Sales Order')
@section('page-title', 'Buat Sales Order')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#">Penjualan</a></li>
    <li class="breadcrumb-item"><a href="{{ route('sales.orders.index') }}">Sales Order</a></li>
    <li class="breadcrumb-item active">Buat Baru</li>
@endsection

@section('content')
<form action="{{ route('sales.orders.store') }}" method="POST">
    @csrf

    <x-card title="Header Sales Order">
        @include('sales.orders._form')
    </x-card>

    <div class="d-flex justify-content-end gap-2">
        <a href="{{ route('sales.orders.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i> Batal
        </a>
        <button type="submit" class="btn btn-accent">
            <i class="fas fa-save me-1"></i> Simpan Draft
        </button>
    </div>
</form>
@endsection
