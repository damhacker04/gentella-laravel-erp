@extends('layouts.app')
@section('title', 'Edit Faktur')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="mb-1"><i class="fas fa-edit me-2"></i>Edit {{ $invoice->code }}</h4>
        <nav aria-label="breadcrumb"><ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('sales.invoices.index') }}">Faktur</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ol></nav>
    </div>
</div>

<x-card>
    <form action="{{ route('sales.invoices.update', $invoice) }}" method="POST">
        @csrf @method('PUT')
        <div class="row">
            <div class="col-md-3">
                <x-date name="invoice_date" label="Tanggal Faktur" :value="$invoice->invoice_date->format('Y-m-d')" required />
            </div>
            <div class="col-md-3">
                <x-date name="due_date" label="Jatuh Tempo" :value="$invoice->due_date->format('Y-m-d')" required />
            </div>
            <div class="col-md-6">
                <x-textarea name="notes" label="Catatan" :value="$invoice->notes ?? ''" rows="2" />
            </div>
        </div>
        <div class="text-end mt-3">
            <a href="{{ route('sales.invoices.show', $invoice) }}" class="btn btn-secondary me-1">Batal</a>
            <button type="submit" class="btn btn-accent"><i class="fas fa-save me-1"></i>Perbarui</button>
        </div>
    </form>
</x-card>
@endsection
