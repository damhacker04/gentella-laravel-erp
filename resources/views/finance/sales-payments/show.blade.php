@extends('layouts.app')
@section('title', $salesPayment->code)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="mb-1"><i class="fas fa-money-bill me-2"></i>{{ $salesPayment->code }}</h4>
        <nav aria-label="breadcrumb"><ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('finance.sales-payments.index') }}">Pembayaran Penjualan</a></li>
            <li class="breadcrumb-item active">{{ $salesPayment->code }}</li>
        </ol></nav>
    </div>
</div>

<x-card>
    <div class="row mb-3">
        <div class="col-md-3"><strong>Kode</strong><br>{{ $salesPayment->code }}</div>
        <div class="col-md-3"><strong>Ref. Faktur</strong><br><a href="{{ route('sales.invoices.show', $salesPayment->salesInvoice) }}">{{ $salesPayment->salesInvoice->code }}</a></div>
        <div class="col-md-3"><strong>Pelanggan</strong><br>{{ $salesPayment->salesInvoice->salesOrder->customer->name }}</div>
        <div class="col-md-3"><strong>Status</strong><br><x-status-badge :status="$salesPayment->status" /></div>
    </div>
    <div class="row mb-3">
        <div class="col-md-3"><strong>Tanggal Bayar</strong><br>{{ $salesPayment->paid_at->format('d M Y') }}</div>
        <div class="col-md-3"><strong>Jumlah</strong><br>Rp {{ number_format($salesPayment->amount, 0, ',', '.') }}</div>
        <div class="col-md-3"><strong>Metode</strong><br>{{ $salesPayment->method }}</div>
        <div class="col-md-3"><strong>Dibuat Oleh</strong><br>{{ $salesPayment->createdBy->name ?? '-' }}</div>
    </div>
    @if($salesPayment->notes)
    <div class="row"><div class="col-md-12"><strong>Catatan</strong><br>{{ $salesPayment->notes }}</div></div>
    @endif
</x-card>
@endsection
