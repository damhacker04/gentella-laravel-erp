@extends('layouts.app')
@section('title', 'Edit Goods Receipt')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="mb-1"><i class="fas fa-edit me-2"></i>Edit {{ $goodsReceipt->code }}</h4>
        <nav aria-label="breadcrumb"><ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('purchasing.goods-receipts.index') }}">Goods Receipt</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ol></nav>
    </div>
</div>

<x-card>
    <form action="{{ route('purchasing.goods-receipts.update', $goodsReceipt) }}" method="POST">
        @csrf @method('PUT')
        <input type="hidden" name="purchase_order_id" value="{{ $goodsReceipt->purchase_order_id }}">

        <div class="row">
            <div class="col-md-3">
                <div class="mb-3"><label class="form-label">Ref. PO</label>
                    <input type="text" class="form-control" value="{{ $goodsReceipt->purchaseOrder->code }}" readonly></div>
            </div>
            <div class="col-md-3">
                <x-select name="warehouse_id" label="Gudang" :options="$warehouses"
                          option-value="id" option-label="name" :selected="$goodsReceipt->warehouse_id" required />
            </div>
            <div class="col-md-3">
                <x-date name="received_at" label="Tanggal Terima" :value="$goodsReceipt->received_at?->format('Y-m-d')" required />
            </div>
        </div>
        <div class="row"><div class="col-md-12"><x-textarea name="notes" label="Catatan" :value="$goodsReceipt->notes ?? ''" rows="2" /></div></div>

        <hr>
        <h6><i class="fas fa-list me-1"></i> Detail Penerimaan</h6>
        <div class="table-responsive">
            <table class="table items-table">
                <thead><tr><th>#</th><th>Produk</th><th>Qty Order</th><th>Qty Diterima</th></tr></thead>
                <tbody>
                    @foreach($goodsReceipt->items as $idx => $item)
                    <tr>
                        <td>{{ $idx + 1 }}</td>
                        <td>
                            {{ $item->product->sku }} — {{ $item->product->name }}
                            <input type="hidden" name="items[{{ $idx }}][product_id]" value="{{ $item->product_id }}">
                        </td>
                        <td><input type="number" name="items[{{ $idx }}][qty_ordered]" class="form-control" value="{{ $item->qty_ordered }}" readonly></td>
                        <td><input type="number" name="items[{{ $idx }}][qty_received]" class="form-control" value="{{ $item->qty_received }}" min="0" required></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="text-end mt-3">
            <a href="{{ route('purchasing.goods-receipts.show', $goodsReceipt) }}" class="btn btn-secondary me-1">Batal</a>
            <button type="submit" class="btn btn-accent"><i class="fas fa-save me-1"></i>Perbarui</button>
        </div>
    </form>
</x-card>
@endsection
