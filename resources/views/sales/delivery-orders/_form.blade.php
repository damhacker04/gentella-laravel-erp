{{-- Delivery Order Form --}}
@php
    $isEdit = isset($deliveryOrder) && $deliveryOrder->exists;
    $so = $isEdit ? $deliveryOrder->salesOrder : $salesOrder;
    $items = old('items', $isEdit
        ? $deliveryOrder->items->toArray()
        : $so->items->map(fn($i) => ['product_id' => $i->product_id, 'qty_ordered' => $i->qty, 'qty_delivered' => $i->qty])->toArray()
    );
@endphp

<input type="hidden" name="sales_order_id" value="{{ $so->id }}">

<div class="row">
    <div class="col-md-3">
        <div class="mb-3">
            <label class="form-label">Ref. Sales Order</label>
            <input type="text" class="form-control" value="{{ $so->code }}" readonly>
        </div>
    </div>
    <div class="col-md-3">
        <div class="mb-3">
            <label class="form-label">Pelanggan</label>
            <input type="text" class="form-control" value="{{ $so->customer->name }}" readonly>
        </div>
    </div>
    <div class="col-md-3">
        <x-select name="warehouse_id" label="Gudang" :options="$warehouses"
                  option-value="id" option-label="name"
                  :selected="$deliveryOrder->warehouse_id ?? ''" required placeholder="Pilih Gudang..." />
    </div>
    <div class="col-md-3">
        <x-date name="delivered_at" label="Tanggal Kirim"
                :value="$deliveryOrder->delivered_at ?? date('Y-m-d')" required />
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <x-textarea name="notes" label="Catatan" :value="$deliveryOrder->notes ?? ''" rows="2" />
    </div>
</div>

<hr>
<h6><i class="fas fa-list me-1"></i> Detail Pengiriman</h6>
<div class="table-responsive">
    <table class="table items-table">
        <thead><tr><th>#</th><th>Produk</th><th>Qty Order</th><th>Qty Kirim</th></tr></thead>
        <tbody>
            @foreach($items as $idx => $item)
            @php $prod = \App\Models\Product::find($item['product_id']); @endphp
            <tr>
                <td>{{ $idx + 1 }}</td>
                <td>
                    {{ $prod->sku ?? '' }} — {{ $prod->name ?? '' }}
                    <input type="hidden" name="items[{{ $idx }}][product_id]" value="{{ $item['product_id'] }}">
                </td>
                <td>
                    <input type="number" name="items[{{ $idx }}][qty_ordered]" class="form-control"
                           value="{{ $item['qty_ordered'] }}" readonly>
                </td>
                <td>
                    <input type="number" name="items[{{ $idx }}][qty_delivered]" class="form-control"
                           value="{{ $item['qty_delivered'] }}" min="0" max="{{ $item['qty_ordered'] }}" required>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
