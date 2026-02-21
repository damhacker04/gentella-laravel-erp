{{-- Shared Form for Customer Create & Edit --}}
@php
    $isEdit = isset($customer) && $customer->exists;
@endphp

<div class="row">
    <div class="col-md-6">
        <x-input name="code" label="Kode Pelanggan" :value="$customer->code ?? ''"
                 placeholder="CUST-001" required hint="Kode unik untuk pelanggan" />
    </div>
    <div class="col-md-6">
        <x-input name="name" label="Nama Pelanggan" :value="$customer->name ?? ''"
                 placeholder="PT ABC Sejahtera" required />
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <x-input name="email" label="Email" type="email" :value="$customer->email ?? ''"
                 placeholder="info@perusahaan.com" />
    </div>
    <div class="col-md-6">
        <x-input name="phone" label="Telepon" :value="$customer->phone ?? ''"
                 placeholder="08123456789" />
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <x-textarea name="address" label="Alamat" :value="$customer->address ?? ''"
                    placeholder="Jl. Contoh No. 123, Kota, Provinsi" rows="3" />
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">Status</label>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1"
                       {{ old('is_active', $customer->is_active ?? 1) ? 'checked' : '' }}>
                <label class="form-check-label" for="is_active">Aktif</label>
            </div>
        </div>
    </div>
</div>
