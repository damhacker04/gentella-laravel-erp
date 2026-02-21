@extends('layouts.app')
@section('title', 'Buat Purchase Order')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="mb-1"><i class="fas fa-plus-circle me-2"></i>Buat Purchase Order</h4>
        <nav aria-label="breadcrumb"><ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('purchasing.orders.index') }}">Purchase Order</a></li>
            <li class="breadcrumb-item active">Buat Baru</li>
        </ol></nav>
    </div>
</div>

<x-card>
    <form action="{{ route('purchasing.orders.store') }}" method="POST">
        @csrf
        @include('purchasing.orders._form')
        <div class="text-end mt-3">
            <a href="{{ route('purchasing.orders.index') }}" class="btn btn-secondary me-1">Batal</a>
            <button type="submit" class="btn btn-accent"><i class="fas fa-save me-1"></i>Simpan</button>
        </div>
    </form>
</x-card>
@endsection
