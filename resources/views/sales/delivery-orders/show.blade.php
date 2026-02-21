@extends('layouts.app')
@section('title', $deliveryOrder->code)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="mb-1"><i class="fas fa-truck me-2"></i>{{ $deliveryOrder->code }}</h4>
        <nav aria-label="breadcrumb"><ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('sales.delivery-orders.index') }}">Delivery Order</a></li>
            <li class="breadcrumb-item active">{{ $deliveryOrder->code }}</li>
        </ol></nav>
    </div>
    <div>
        @if($deliveryOrder->status === 'DRAFT')
            <a href="{{ route('sales.delivery-orders.edit', $deliveryOrder) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit me-1"></i>Edit</a>
        @endif
    </div>
</div>

<x-card>
    <div class="row mb-3">
        <div class="col-md-3"><strong>Kode DO</strong><br>{{ $deliveryOrder->code }}</div>
        <div class="col-md-3"><strong>Ref. Sales Order</strong><br><a href="{{ route('sales.orders.show', $deliveryOrder->salesOrder) }}">{{ $deliveryOrder->salesOrder->code }}</a></div>
        <div class="col-md-3"><strong>Pelanggan</strong><br>{{ $deliveryOrder->salesOrder->customer->name }}</div>
        <div class="col-md-3"><strong>Status</strong><br><x-status-badge :status="$deliveryOrder->status" /></div>
    </div>
    <div class="row mb-3">
        <div class="col-md-3"><strong>Gudang</strong><br>{{ $deliveryOrder->warehouse->name }}</div>
        <div class="col-md-3"><strong>Tanggal Kirim</strong><br>{{ $deliveryOrder->delivered_at?->format('d M Y') ?? '-' }}</div>
        <div class="col-md-3"><strong>Dibuat Oleh</strong><br>{{ $deliveryOrder->createdBy->name ?? '-' }}</div>
        <div class="col-md-3"><strong>Catatan</strong><br>{{ $deliveryOrder->notes ?? '-' }}</div>
    </div>

    <hr>
    <h6><i class="fas fa-list me-1"></i> Detail Pengiriman</h6>
    <div class="table-responsive">
        <table class="table items-table">
            <thead><tr><th>#</th><th>Produk</th><th>Qty Order</th><th>Qty Kirim</th></tr></thead>
            <tbody>
                @foreach($deliveryOrder->items as $idx => $item)
                <tr>
                    <td>{{ $idx + 1 }}</td>
                    <td>{{ $item->product->sku }} — {{ $item->product->name }}</td>
                    <td>{{ $item->qty_ordered }}</td>
                    <td>{{ $item->qty_delivered }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-card>
@endsection
