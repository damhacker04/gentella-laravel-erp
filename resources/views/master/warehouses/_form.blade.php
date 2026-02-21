@php $isEdit = isset($warehouse) && $warehouse->exists; @endphp
<div class="row">
    <div class="col-md-4"><x-input name="code" label="Kode Gudang" :value="$warehouse->code ?? ''" placeholder="WH-001" required /></div>
    <div class="col-md-8"><x-input name="name" label="Nama Gudang" :value="$warehouse->name ?? ''" placeholder="Gudang Utama" required /></div>
</div>
<div class="row">
    <div class="col-md-12"><x-textarea name="location" label="Lokasi / Alamat" :value="$warehouse->location ?? ''" placeholder="Alamat gudang" rows="2" /></div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">Status</label>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $warehouse->is_active ?? 1) ? 'checked' : '' }}>
                <label class="form-check-label" for="is_active">Aktif</label>
            </div>
        </div>
    </div>
</div>
