@extends('layouts.app')
@section('title', 'Catat Pembayaran Pembelian')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="mb-1"><i class="fas fa-money-bill me-2"></i>Catat Pembayaran Pembelian</h4>
        <nav aria-label="breadcrumb"><ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('finance.purchase-payments.index') }}">Pembayaran Pembelian</a></li>
            <li class="breadcrumb-item active">Buat Baru</li>
        </ol></nav>
    </div>
</div>

<x-card>
    <form action="{{ route('finance.purchase-payments.store') }}" method="POST">
        @csrf
        <input type="hidden" name="purchase_invoice_id" value="{{ $invoice->id }}">

        <div class="row mb-3">
            <div class="col-md-3">
                <div class="mb-3"><label class="form-label">Ref. Faktur</label>
                    <input type="text" class="form-control" value="{{ $invoice->code }}" readonly></div>
            </div>
            <div class="col-md-3">
                <div class="mb-3"><label class="form-label">Supplier</label>
                    <input type="text" class="form-control" value="{{ $invoice->purchaseOrder->supplier->name }}" readonly></div>
            </div>
            <div class="col-md-3">
                <div class="mb-3"><label class="form-label">Total Faktur</label>
                    <input type="text" class="form-control" value="Rp {{ number_format($invoice->total, 0, ',', '.') }}" readonly></div>
            </div>
            <div class="col-md-3">
                @php $remaining = $invoice->total - $invoice->payments()->where('status','CONFIRMED')->sum('amount'); @endphp
                <div class="mb-3"><label class="form-label">Sisa Tagihan</label>
                    <input type="text" class="form-control text-danger fw-bold" value="Rp {{ number_format($remaining, 0, ',', '.') }}" readonly></div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <x-date name="paid_at" label="Tanggal Bayar" :value="date('Y-m-d')" required />
            </div>
            <div class="col-md-3">
                <x-money name="amount" label="Jumlah Bayar" :value="$remaining" required />
            </div>
            <div class="col-md-3">
                <div class="mb-3">
                    <label for="method" class="form-label">Metode</label>
                    <select name="method" id="method" class="form-select" required>
                        <option value="TRANSFER">Transfer Bank</option>
                        <option value="CASH">Tunai</option>
                        <option value="GIRO">Giro</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <x-textarea name="notes" label="Catatan" rows="1" />
            </div>
        </div>

        <div class="text-end mt-3">
            <a href="{{ route('purchasing.invoices.show', $invoice) }}" class="btn btn-secondary me-1">Batal</a>
            <button type="submit" class="btn btn-accent"><i class="fas fa-save me-1"></i>Simpan Pembayaran</button>
        </div>
    </form>
</x-card>
@endsection
