@extends('layouts.app')
@section('title', 'Edit Termin')
@section('page-title', 'Edit Termin Pembayaran')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#">Master Data</a></li>
    <li class="breadcrumb-item"><a href="{{ route('master.payment-terms.index') }}">Termin Pembayaran</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection
@section('content')
<x-card title="Edit Termin: {{ $paymentTerm->name }}">
    <form action="{{ route('master.payment-terms.update', $paymentTerm) }}" method="POST">
        @csrf @method('PUT')
        @include('master.payment-terms._form')
        <hr>
        <div class="d-flex justify-content-end gap-2">
            <a href="{{ route('master.payment-terms.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left me-1"></i> Batal</a>
            <button type="submit" class="btn btn-accent"><i class="fas fa-save me-1"></i> Perbarui</button>
        </div>
    </form>
</x-card>
@endsection
