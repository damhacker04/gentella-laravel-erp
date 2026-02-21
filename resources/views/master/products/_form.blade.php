@php $isEdit = isset($product) && $product->exists; @endphp
<div class="row">
    <div class="col-md-4"><x-input name="sku" label="SKU" :value="$product->sku ?? ''" placeholder="PRD-001" required hint="Kode unik produk" /></div>
    <div class="col-md-8"><x-input name="name" label="Nama Produk" :value="$product->name ?? ''" placeholder="Widget Premium A" required /></div>
</div>
<div class="row">
    <div class="col-md-4"><x-input name="unit" label="Satuan" :value="$product->unit ?? ''" placeholder="PCS / BOX / KG" required /></div>
    <div class="col-md-4"><x-money name="price" label="Harga Jual" :value="$product->price ?? ''" required /></div>
    <div class="col-md-4"><x-input name="stock_min" label="Stok Minimum" type="number" :value="$product->stock_min ?? 0" hint="Alert jika stok di bawah ini" /></div>
</div>
<div class="row">
    <div class="col-md-12"><x-textarea name="description" label="Deskripsi" :value="$product->description ?? ''" placeholder="Deskripsi produk (opsional)" rows="2" /></div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">Status</label>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $product->is_active ?? 1) ? 'checked' : '' }}>
                <label class="form-check-label" for="is_active">Aktif</label>
            </div>
        </div>
    </div>
</div>
