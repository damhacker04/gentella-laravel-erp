@extends('layouts.app')
@section('title', 'Manajemen Pengguna')
@section('page-title', 'Manajemen Pengguna')
@section('breadcrumb')
    <li class="breadcrumb-item active">Pengaturan</li>
    <li class="breadcrumb-item active">Pengguna</li>
@endsection
@section('page-actions')
    <a href="{{ route('settings.users.create') }}" class="btn btn-accent"><i class="fas fa-plus me-1"></i> Tambah Pengguna</a>
@endsection
@section('content')
<x-card title="Daftar Pengguna">
    <x-data-table id="users-table">
        <x-slot name="head">
            <th style="width:50px">No</th><th>Nama</th><th>Email</th><th>Role</th><th>Dibuat</th><th style="width:120px">Aksi</th>
        </x-slot>
        <x-slot name="body">
            @foreach($users as $i => $user)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td><strong>{{ $user->name }}</strong></td>
                <td>{{ $user->email }}</td>
                <td>
                    @foreach($user->roles as $role)
                    <span class="badge bg-primary">{{ $role->name }}</span>
                    @endforeach
                </td>
                <td>{{ $user->created_at?->format('d M Y') }}</td>
                <td>
                    <x-btn-action
                        :edit-route="route('settings.users.edit', $user)"
                        :delete-route="$user->id !== auth()->id() ? route('settings.users.destroy', $user) : null"
                    />
                </td>
            </tr>
            @endforeach
        </x-slot>
    </x-data-table>
</x-card>
@endsection
