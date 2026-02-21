@extends('layouts.app')
@section('title', 'Buat Goods Receipt')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="mb-1"><i class="fas fa-truck-loading me-2"></i>Buat Goods Receipt</h4>
        <nav aria-label="breadcrumb"><ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('purchasing.goods-receipts.index') }}">Goods Receipt</a></li>
            <li class="breadcrumb-item active">Buat Baru</li>
        </ol></nav>
    </div>
</div>

<x-card>
    <form action="{{ route('purchasing.goods-receipts.store') }}" method="POST">
        @csrf
        <input type="hidden" name="purchase_order_id" value="{{ $purchaseOrder->id }}">

        <div class="row">
            <div class="col-md-3">
                <div class="mb-3"><label class="form-label">Ref. PO</label>
                    <input type="text" class="form-control" value="{{ $purchaseOrder->code }}" readonly></div>
            </div>
            <div class="col-md-3">
                <div class="mb-3"><label class="form-label">Supplier</label>
                    <input type="text" class="form-control" value="{{ $purchaseOrder->supplier->name }}" readonly></div>
            </div>
            <div class="col-md-3">
                <x-select name="warehouse_id" label="Gudang" :options="$warehouses"
                          option-value="id" option-label="name" required placeholder="Pilih Gudang..." />
            </div>
            <div class="col-md-3">
                <x-date name="received_at" label="Tanggal Terima" :value="date('Y-m-d')" required />
            </div>
        </div>
        <div class="row"><div class="col-md-12"><x-textarea name="notes" label="Catatan" rows="2" /></div></div>

        <hr>
        <h6><i class="fas fa-list me-1"></i> Detail Penerimaan</h6>
        <div class="table-responsive">
            <table class="table items-table">
                <thead><tr><th>#</th><th>Produk</th><th>Qty Order</th><th>Qty Diterima</th></tr></thead>
                <tbody>
                    @foreach($purchaseOrder->items as $idx => $item)
                    <tr>
                        <td>{{ $idx + 1 }}</td>
                        <td>
                            {{ $item->product->sku }} — {{ $item->product->name }}
                            <input type="hidden" name="items[{{ $idx }}][product_id]" value="{{ $item->product_id }}">
                        </td>
                        <td><input type="number" name="items[{{ $idx }}][qty_ordered]" class="form-control" value="{{ $item->qty }}" readonly></td>
                        <td><input type="number" name="items[{{ $idx }}][qty_received]" class="form-control" value="{{ $item->qty }}" min="0" max="{{ $item->qty }}" required></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="text-end mt-3">
            <a href="{{ route('purchasing.orders.show', $purchaseOrder) }}" class="btn btn-secondary me-1">Batal</a>
            <button type="submit" class="btn btn-accent"><i class="fas fa-save me-1"></i>Simpan</button>
        </div>
    </form>
</x-card>
@endsection
