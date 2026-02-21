@php $isEdit = isset($user) && $user->exists; @endphp
<div class="row">
    <div class="col-md-6"><x-input name="name" label="Nama Lengkap" :value="$user->name ?? ''" required /></div>
    <div class="col-md-6"><x-input name="email" label="Email" type="email" :value="$user->email ?? ''" required /></div>
</div>
<div class="row">
    <div class="col-md-6"><x-input name="password" label="Kata Sandi" type="password" :required="!$isEdit" hint="{{ $isEdit ? 'Kosongkan jika tidak ingin mengubah' : '' }}" /></div>
    <div class="col-md-6"><x-input name="password_confirmation" label="Konfirmasi Kata Sandi" type="password" :required="!$isEdit" /></div>
</div>
<div class="row">
    <div class="col-md-6">
        <x-select name="role" label="Role" :options="$roles" option-value="name" option-label="name"
                  :selected="$isEdit ? ($user->roles->first()->name ?? '') : ''" required placeholder="Pilih Role..." />
    </div>
</div>
