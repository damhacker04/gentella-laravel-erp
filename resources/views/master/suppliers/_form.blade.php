@php $isEdit = isset($supplier) && $supplier->exists; @endphp
<div class="row">
    <div class="col-md-6"><x-input name="code" label="Kode Supplier" :value="$supplier->code ?? ''" placeholder="SUP-001" required hint="Kode unik" /></div>
    <div class="col-md-6"><x-input name="name" label="Nama Supplier" :value="$supplier->name ?? ''" placeholder="CV Maju Bersama" required /></div>
</div>
<div class="row">
    <div class="col-md-6"><x-input name="email" label="Email" type="email" :value="$supplier->email ?? ''" placeholder="info@supplier.com" /></div>
    <div class="col-md-6"><x-input name="phone" label="Telepon" :value="$supplier->phone ?? ''" placeholder="08123456789" /></div>
</div>
<div class="row">
    <div class="col-md-12"><x-textarea name="address" label="Alamat" :value="$supplier->address ?? ''" placeholder="Alamat lengkap supplier" rows="3" /></div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">Status</label>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $supplier->is_active ?? 1) ? 'checked' : '' }}>
                <label class="form-check-label" for="is_active">Aktif</label>
            </div>
        </div>
    </div>
</div>
