{{-- Shared Form for Purchase Order Create & Edit with Dynamic Line Items --}}
@php
    $isEdit = isset($order) && $order->exists;
    $items = old('items', $isEdit ? $order->items->toArray() : [['product_id' => '', 'qty' => 1, 'price' => 0, 'subtotal' => 0]]);
@endphp

<div class="row">
    <div class="col-md-4">
        <x-select name="supplier_id" label="Supplier" :options="$suppliers"
                  option-value="id" option-label="name"
                  :selected="$order->supplier_id ?? ''"
                  required searchable placeholder="Pilih Supplier..." />
    </div>
    <div class="col-md-3">
        <x-date name="order_date" label="Tanggal Order"
                :value="$order->order_date ?? date('Y-m-d')" required />
    </div>
    <div class="col-md-3">
        @if($isEdit)
        <div class="mb-3">
            <label class="form-label">Status</label><br>
            <x-status-badge :status="$order->status" />
        </div>
        @endif
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <x-textarea name="notes" label="Catatan" :value="$order->notes ?? ''"
                    placeholder="Catatan tambahan (opsional)" rows="2" />
    </div>
</div>

<hr>

{{-- Dynamic Line Items --}}
<div class="d-flex justify-content-between align-items-center mb-3">
    <h6 class="mb-0"><i class="fas fa-list me-1"></i> Detail Barang</h6>
    <button type="button" class="btn btn-sm btn-accent" onclick="DynamicItems.addRow()">
        <i class="fas fa-plus me-1"></i> Tambah Baris
    </button>
</div>

<div class="table-responsive">
    <table id="items-table" class="table items-table">
        <thead>
            <tr>
                <th style="width:40px">#</th>
                <th style="min-width:250px">Produk</th>
                <th style="width:100px">Qty</th>
                <th style="width:160px">Harga Satuan</th>
                <th style="width:160px" class="text-end">Subtotal</th>
                <th style="width:50px"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $idx => $item)
            <tr class="item-row">
                <td>{{ $idx + 1 }}</td>
                <td>
                    <select name="items[{{ $idx }}][product_id]" class="form-select select2" required>
                        <option value="">Pilih Produk...</option>
                        @foreach($products as $product)
                        <option value="{{ $product->id }}"
                            data-price="{{ $product->price }}"
                            {{ ($item['product_id'] ?? '') == $product->id ? 'selected' : '' }}>
                            {{ $product->sku }} — {{ $product->name }}
                        </option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <input type="number" name="items[{{ $idx }}][qty]" class="form-control item-qty"
                           value="{{ $item['qty'] ?? 1 }}" min="1" required
                           onchange="DynamicItems.recalculate()" onkeyup="DynamicItems.recalculate()">
                </td>
                <td>
                    <input type="number" name="items[{{ $idx }}][price]" class="form-control item-price"
                           value="{{ $item['price'] ?? 0 }}" min="0" required
                           onchange="DynamicItems.recalculate()" onkeyup="DynamicItems.recalculate()">
                </td>
                <td class="text-end">
                    <span class="item-subtotal">{{ number_format(($item['qty'] ?? 1) * ($item['price'] ?? 0), 0, ',', '.') }}</span>
                    <input type="hidden" name="items[{{ $idx }}][subtotal]" class="item-subtotal-input"
                           value="{{ ($item['qty'] ?? 1) * ($item['price'] ?? 0) }}">
                </td>
                <td>
                    <button type="button" class="btn-remove-item" onclick="DynamicItems.removeRow(this)">
                        <i class="fas fa-times"></i>
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="total-section">
    <span class="total-label">Grand Total:</span>
    <span class="total-value">Rp <span id="grand-total">{{ number_format(collect($items)->sum(fn($i) => ($i['qty'] ?? 0) * ($i['price'] ?? 0)), 0, ',', '.') }}</span></span>
    <input type="hidden" name="total" id="grand-total-input"
           value="{{ collect($items)->sum(fn($i) => ($i['qty'] ?? 0) * ($i['price'] ?? 0)) }}">
</div>

{{-- Template for new rows --}}
<template id="item-row-template">
    <tr class="item-row">
        <td>-</td>
        <td>
            <select name="items[__INDEX__][product_id]" class="form-select select2" required>
                <option value="">Pilih Produk...</option>
                @foreach($products as $product)
                <option value="{{ $product->id }}" data-price="{{ $product->price }}">
                    {{ $product->sku }} — {{ $product->name }}
                </option>
                @endforeach
            </select>
        </td>
        <td>
            <input type="number" name="items[__INDEX__][qty]" class="form-control item-qty"
                   value="1" min="1" required onchange="DynamicItems.recalculate()" onkeyup="DynamicItems.recalculate()">
        </td>
        <td>
            <input type="number" name="items[__INDEX__][price]" class="form-control item-price"
                   value="0" min="0" required onchange="DynamicItems.recalculate()" onkeyup="DynamicItems.recalculate()">
        </td>
        <td class="text-end">
            <span class="item-subtotal">0</span>
            <input type="hidden" name="items[__INDEX__][subtotal]" class="item-subtotal-input" value="0">
        </td>
        <td>
            <button type="button" class="btn-remove-item" onclick="DynamicItems.removeRow(this)">
                <i class="fas fa-times"></i>
            </button>
        </td>
    </tr>
</template>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        DynamicItems.init('items-table', 'item-row-template');

        $(document).on('change', '.item-row select[name*="product_id"]', function() {
            const price = $(this).find(':selected').data('price') || 0;
            const row = $(this).closest('.item-row');
            row.find('.item-price').val(price);
            DynamicItems.recalculate();
        });
    });
</script>
@endpush
