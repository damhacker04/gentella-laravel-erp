@extends('layouts.app')
@section('title', $goodsReceipt->code)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="mb-1"><i class="fas fa-truck-loading me-2"></i>{{ $goodsReceipt->code }}</h4>
        <nav aria-label="breadcrumb"><ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('purchasing.goods-receipts.index') }}">Goods Receipt</a></li>
            <li class="breadcrumb-item active">{{ $goodsReceipt->code }}</li>
        </ol></nav>
    </div>
    <div>
        @if($goodsReceipt->status === 'DRAFT')
            <a href="{{ route('purchasing.goods-receipts.edit', $goodsReceipt) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit me-1"></i>Edit</a>
        @endif
    </div>
</div>

<x-card>
    <div class="row mb-3">
        <div class="col-md-3"><strong>Kode GRN</strong><br>{{ $goodsReceipt->code }}</div>
        <div class="col-md-3"><strong>Ref. PO</strong><br><a href="{{ route('purchasing.orders.show', $goodsReceipt->purchaseOrder) }}">{{ $goodsReceipt->purchaseOrder->code }}</a></div>
        <div class="col-md-3"><strong>Supplier</strong><br>{{ $goodsReceipt->purchaseOrder->supplier->name }}</div>
        <div class="col-md-3"><strong>Status</strong><br><x-status-badge :status="$goodsReceipt->status" /></div>
    </div>
    <div class="row mb-3">
        <div class="col-md-3"><strong>Gudang</strong><br>{{ $goodsReceipt->warehouse->name }}</div>
        <div class="col-md-3"><strong>Tgl Terima</strong><br>{{ $goodsReceipt->received_at?->format('d M Y') ?? '-' }}</div>
        <div class="col-md-3"><strong>Dibuat Oleh</strong><br>{{ $goodsReceipt->createdBy->name ?? '-' }}</div>
        <div class="col-md-3"><strong>Catatan</strong><br>{{ $goodsReceipt->notes ?? '-' }}</div>
    </div>

    <hr>
    <h6><i class="fas fa-list me-1"></i> Detail Penerimaan</h6>
    <div class="table-responsive">
        <table class="table items-table">
            <thead><tr><th>#</th><th>Produk</th><th>Qty Order</th><th>Qty Diterima</th></tr></thead>
            <tbody>
                @foreach($goodsReceipt->items as $idx => $item)
                <tr>
                    <td>{{ $idx + 1 }}</td>
                    <td>{{ $item->product->sku }} — {{ $item->product->name }}</td>
                    <td>{{ $item->qty_ordered }}</td>
                    <td>{{ $item->qty_received }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-card>
@endsection
