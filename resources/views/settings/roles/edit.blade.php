@extends('layouts.app')
@section('title', 'Edit Role')
@section('page-title', 'Edit Role')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#">Pengaturan</a></li>
    <li class="breadcrumb-item"><a href="{{ route('settings.roles.index') }}">Role</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection
@section('content')
<x-card title="Edit Role: {{ $role->name }}">
    <form action="{{ route('settings.roles.update', $role) }}" method="POST">
        @csrf @method('PUT')
        <div class="row mb-4">
            <div class="col-md-6">
                <x-input name="name" label="Nama Role" :value="$role->name" required />
            </div>
        </div>

        <h6 class="mb-3"><i class="fas fa-shield-alt me-1"></i> Permissions</h6>
        @php $rolePermissions = $role->permissions->pluck('name')->toArray(); @endphp
        <div class="row">
            @foreach($permissionGroups ?? [] as $group => $permissions)
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-header py-2">
                        <div class="form-check">
                            <input class="form-check-input group-check" type="checkbox" id="group-{{ $group }}"
                                   onchange="toggleGroup('{{ $group }}', this.checked)">
                            <label class="form-check-label fw-600" for="group-{{ $group }}">{{ $group }}</label>
                        </div>
                    </div>
                    <div class="card-body py-2">
                        @foreach($permissions as $permission)
                        <div class="form-check">
                            <input class="form-check-input perm-{{ $group }}" type="checkbox"
                                   name="permissions[]" value="{{ $permission->name }}"
                                   id="perm-{{ $permission->id }}"
                                   {{ in_array($permission->name, old('permissions', $rolePermissions)) ? 'checked' : '' }}>
                            <label class="form-check-label" for="perm-{{ $permission->id }}" style="font-size:13px;">
                                {{ $permission->name }}
                            </label>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <hr>
        <div class="d-flex justify-content-end gap-2">
            <a href="{{ route('settings.roles.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left me-1"></i> Batal</a>
            <button type="submit" class="btn btn-accent"><i class="fas fa-save me-1"></i> Perbarui</button>
        </div>
    </form>
</x-card>

@push('scripts')
<script>
function toggleGroup(group, checked) {
    document.querySelectorAll('.perm-' + group).forEach(cb => cb.checked = checked);
}
</script>
@endpush
@endsection
