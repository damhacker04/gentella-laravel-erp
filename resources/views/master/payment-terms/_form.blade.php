@php $isEdit = isset($paymentTerm) && $paymentTerm->exists; @endphp
<div class="row">
    <div class="col-md-4"><x-input name="code" label="Kode" :value="$paymentTerm->code ?? ''" placeholder="NET30" required /></div>
    <div class="col-md-4"><x-input name="name" label="Nama" :value="$paymentTerm->name ?? ''" placeholder="Net 30 Hari" required /></div>
    <div class="col-md-4"><x-input name="days" label="Jumlah Hari" type="number" :value="$paymentTerm->days ?? 30" required hint="Jatuh tempo dalam hari" /></div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">Status</label>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $paymentTerm->is_active ?? 1) ? 'checked' : '' }}>
                <label class="form-check-label" for="is_active">Aktif</label>
            </div>
        </div>
    </div>
</div>
