@extends('layouts.app')

@section('title', 'Detail Pembayaran Xendit')
@section('page-title', 'Detail Pembayaran Xendit')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('finance.xendit-payments.index') }}">Pembayaran Xendit</a></li>
    <li class="breadcrumb-item active">{{ $xenditPayment->external_id }}</li>
@endsection

@section('content')
<div class="row">
    {{-- Main Info --}}
    <div class="col-lg-8">
        <x-card title="Informasi Pembayaran">
            <x-slot name="headerActions">
                @if($xenditPayment->status === 'PAID')
                    <span class="badge badge-paid fs-6">✅ PAID</span>
                @elseif($xenditPayment->status === 'PENDING')
                    <span class="badge badge-draft fs-6">⏳ PENDING</span>
                @elseif($xenditPayment->status === 'EXPIRED')
                    <span class="badge badge-canceled fs-6">❌ EXPIRED</span>
                @else
                    <span class="badge badge-void fs-6">{{ $xenditPayment->status }}</span>
                @endif
            </x-slot>

            <div class="row mb-4">
                <div class="col-md-6">
                    <table class="table table-borderless table-sm mb-0">
                        <tr>
                            <td class="text-muted" style="width:160px">External ID</td>
                            <td><code>{{ $xenditPayment->external_id }}</code></td>
                        </tr>
                        <tr>
                            <td class="text-muted">Xendit Invoice ID</td>
                            <td><code>{{ $xenditPayment->xendit_invoice_id }}</code></td>
                        </tr>
                        <tr>
                            <td class="text-muted">Ref. Faktur</td>
                            <td>
                                <a href="{{ route('sales.invoices.show', $xenditPayment->salesInvoice) }}">
                                    {{ $xenditPayment->salesInvoice->code }}
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted">Pelanggan</td>
                            <td>{{ $xenditPayment->salesInvoice->salesOrder->customer->name ?? '-' }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table table-borderless table-sm mb-0">
                        <tr>
                            <td class="text-muted" style="width:160px">Jumlah</td>
                            <td><strong class="text-primary fs-5">Rp {{ number_format($xenditPayment->amount, 0, ',', '.') }}</strong></td>
                        </tr>
                        <tr>
                            <td class="text-muted">Metode Bayar</td>
                            <td>{{ $xenditPayment->payment_method ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Channel</td>
                            <td>{{ $xenditPayment->payment_channel ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Dibayar Pada</td>
                            <td>{{ $xenditPayment->paid_at?->format('d M Y, H:i') ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Dibuat Oleh</td>
                            <td>{{ $xenditPayment->createdBy->name ?? '-' }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            {{-- Payment Link --}}
            @if($xenditPayment->invoice_url && $xenditPayment->status === 'PENDING')
            <div class="alert alert-info mb-3">
                <i class="fas fa-link me-2"></i>
                <strong>Link Pembayaran:</strong>
                <a href="{{ $xenditPayment->invoice_url }}" target="_blank" class="ms-2">
                    {{ $xenditPayment->invoice_url }}
                    <i class="fas fa-external-link-alt ms-1"></i>
                </a>
            </div>
            @endif

            {{-- Xendit Response JSON (Collapsible) --}}
            <details class="mt-3">
                <summary style="cursor: pointer; user-select: none;" class="mb-2">
                    <i class="fas fa-code me-1"></i><strong>Response Data (JSON)</strong>
                    <small class="text-muted ms-1">— klik untuk lihat</small>
                </summary>
                <div class="bg-dark text-light p-3 rounded" style="max-height: 300px; overflow-y: auto;">
                    <pre class="mb-0" style="font-size: 12px; white-space: pre-wrap;">{{ json_encode($xenditPayment->xendit_response, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) }}</pre>
                </div>
            </details>
        </x-card>
    </div>

    {{-- Sidebar --}}
    <div class="col-lg-4">
        <x-card title="Aksi">
            <div class="d-grid gap-2">
                @if($xenditPayment->invoice_url && $xenditPayment->status === 'PENDING')
                    <a href="{{ $xenditPayment->invoice_url }}" target="_blank" class="btn btn-accent">
                        <i class="fas fa-credit-card me-1"></i> Bayar Sekarang
                    </a>
                    <form action="{{ route('finance.xendit-payments.refresh', $xenditPayment) }}" method="POST">
                        @csrf
                        <button class="btn btn-info w-100">
                            <i class="fas fa-sync me-1"></i> Refresh Status
                        </button>
                    </form>
                @endif

                <a href="{{ route('finance.xendit-payments.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </a>
            </div>
        </x-card>
    </div>
</div>
@endsection
