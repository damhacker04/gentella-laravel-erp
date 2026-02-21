@extends('layouts.app')
@section('title', 'Buat Faktur Penjualan')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="mb-1"><i class="fas fa-file-invoice me-2"></i>Buat Faktur Penjualan</h4>
        <nav aria-label="breadcrumb"><ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('sales.invoices.index') }}">Faktur Penjualan</a></li>
            <li class="breadcrumb-item active">Buat Baru</li>
        </ol></nav>
    </div>
</div>

<x-card>
    <form action="{{ route('sales.invoices.store') }}" method="POST">
        @csrf
        <input type="hidden" name="sales_order_id" value="{{ $salesOrder->id }}">

        <div class="row">
            <div class="col-md-3">
                <div class="mb-3"><label class="form-label">Ref. Sales Order</label>
                    <input type="text" class="form-control" value="{{ $salesOrder->code }}" readonly></div>
            </div>
            <div class="col-md-3">
                <div class="mb-3"><label class="form-label">Pelanggan</label>
                    <input type="text" class="form-control" value="{{ $salesOrder->customer->name }}" readonly></div>
            </div>
            <div class="col-md-3">
                <x-date name="invoice_date" label="Tanggal Faktur" :value="date('Y-m-d')" required />
            </div>
            <div class="col-md-3">
                <x-date name="due_date" label="Jatuh Tempo" :value="date('Y-m-d', strtotime('+30 days'))" required />
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <x-textarea name="notes" label="Catatan" rows="2" />
            </div>
        </div>

        <hr>
        <h6><i class="fas fa-list me-1"></i> Detail Barang (dari SO)</h6>
        <div class="table-responsive">
            <table class="table items-table">
                <thead><tr><th>#</th><th>Produk</th><th>Qty</th><th>Harga</th><th class="text-end">Subtotal</th></tr></thead>
                <tbody>
                    @foreach($salesOrder->items as $idx => $item)
                    <tr>
                        <td>{{ $idx + 1 }}</td>
                        <td>{{ $item->product->sku }} — {{ $item->product->name }}</td>
                        <td>{{ $item->qty }}</td>
                        <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                        <td class="text-end">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="total-section">
            <span class="total-label">Total:</span>
            <span class="total-value">Rp {{ number_format($salesOrder->total, 0, ',', '.') }}</span>
        </div>

        <div class="text-end mt-3">
            <a href="{{ route('sales.orders.show', $salesOrder) }}" class="btn btn-secondary me-1">Batal</a>
            <button type="submit" class="btn btn-accent"><i class="fas fa-save me-1"></i>Buat Faktur</button>
        </div>
    </form>
</x-card>
@endsection
