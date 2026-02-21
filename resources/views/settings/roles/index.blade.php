@extends('layouts.app')
@section('title', 'Manajemen Role')
@section('page-title', 'Manajemen Role')
@section('breadcrumb')
    <li class="breadcrumb-item active">Pengaturan</li>
    <li class="breadcrumb-item active">Role</li>
@endsection
@section('page-actions')
    <a href="{{ route('settings.roles.create') }}" class="btn btn-accent"><i class="fas fa-plus me-1"></i> Tambah Role</a>
@endsection
@section('content')
<x-card title="Daftar Role">
    <x-data-table id="roles-table">
        <x-slot name="head">
            <th style="width:50px">No</th><th>Nama Role</th><th>Jumlah Permission</th><th>Jumlah User</th><th style="width:120px">Aksi</th>
        </x-slot>
        <x-slot name="body">
            @foreach($roles as $i => $role)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td><strong>{{ $role->name }}</strong></td>
                <td>{{ $role->permissions_count ?? $role->permissions->count() }}</td>
                <td>{{ $role->users_count ?? $role->users->count() }}</td>
                <td>
                    <x-btn-action
                        :edit-route="route('settings.roles.edit', $role)"
                        :delete-route="$role->name !== 'Admin' ? route('settings.roles.destroy', $role) : null"
                    />
                </td>
            </tr>
            @endforeach
        </x-slot>
    </x-data-table>
</x-card>
@endsection
