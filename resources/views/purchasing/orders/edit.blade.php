@extends('layouts.app')
@section('title', 'Edit Purchase Order')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="mb-1"><i class="fas fa-edit me-2"></i>Edit {{ $order->code }}</h4>
        <nav aria-label="breadcrumb"><ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('purchasing.orders.index') }}">Purchase Order</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ol></nav>
    </div>
</div>

<x-card>
    <form action="{{ route('purchasing.orders.update', $order) }}" method="POST">
        @csrf @method('PUT')
        @include('purchasing.orders._form')
        <div class="text-end mt-3">
            <a href="{{ route('purchasing.orders.show', $order) }}" class="btn btn-secondary me-1">Batal</a>
            <button type="submit" class="btn btn-accent"><i class="fas fa-save me-1"></i>Perbarui</button>
        </div>
    </form>
</x-card>
@endsection
