@extends('layouts.app')

@section('title', 'Edit Sales Order')
@section('page-title', 'Edit Sales Order')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#">Penjualan</a></li>
    <li class="breadcrumb-item"><a href="{{ route('sales.orders.index') }}">Sales Order</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
<form action="{{ route('sales.orders.update', $salesOrder) }}" method="POST">
    @csrf
    @method('PUT')

    <x-card title="Edit Sales Order: {{ $salesOrder->code }}">
        @include('sales.orders._form')
    </x-card>

    <div class="d-flex justify-content-end gap-2">
        <a href="{{ route('sales.orders.show', $salesOrder) }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i> Batal
        </a>
        <button type="submit" class="btn btn-accent">
            <i class="fas fa-save me-1"></i> Perbarui
        </button>
    </div>
</form>
@endsection
