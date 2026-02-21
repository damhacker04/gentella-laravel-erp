@extends('layouts.app')
@section('title', $purchasePayment->code)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="mb-1"><i class="fas fa-money-bill me-2"></i>{{ $purchasePayment->code }}</h4>
        <nav aria-label="breadcrumb"><ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('finance.purchase-payments.index') }}">Pembayaran Pembelian</a></li>
            <li class="breadcrumb-item active">{{ $purchasePayment->code }}</li>
        </ol></nav>
    </div>
</div>

<x-card>
    <div class="row mb-3">
        <div class="col-md-3"><strong>Kode</strong><br>{{ $purchasePayment->code }}</div>
        <div class="col-md-3"><strong>Ref. Faktur</strong><br><a href="{{ route('purchasing.invoices.show', $purchasePayment->purchaseInvoice) }}">{{ $purchasePayment->purchaseInvoice->code }}</a></div>
        <div class="col-md-3"><strong>Supplier</strong><br>{{ $purchasePayment->purchaseInvoice->purchaseOrder->supplier->name }}</div>
        <div class="col-md-3"><strong>Status</strong><br><x-status-badge :status="$purchasePayment->status" /></div>
    </div>
    <div class="row mb-3">
        <div class="col-md-3"><strong>Tanggal Bayar</strong><br>{{ $purchasePayment->paid_at->format('d M Y') }}</div>
        <div class="col-md-3"><strong>Jumlah</strong><br>Rp {{ number_format($purchasePayment->amount, 0, ',', '.') }}</div>
        <div class="col-md-3"><strong>Metode</strong><br>{{ $purchasePayment->method }}</div>
        <div class="col-md-3"><strong>Dibuat Oleh</strong><br>{{ $purchasePayment->createdBy->name ?? '-' }}</div>
    </div>
    @if($purchasePayment->notes)
    <div class="row"><div class="col-md-12"><strong>Catatan</strong><br>{{ $purchasePayment->notes }}</div></div>
    @endif
</x-card>
@endsection
