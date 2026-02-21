@extends('layouts.app')
@section('title', 'Edit Pengguna')
@section('page-title', 'Edit Pengguna')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#">Pengaturan</a></li>
    <li class="breadcrumb-item"><a href="{{ route('settings.users.index') }}">Pengguna</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection
@section('content')
<x-card title="Edit Pengguna: {{ $user->name }}">
    <form action="{{ route('settings.users.update', $user) }}" method="POST">
        @csrf @method('PUT')
        @include('settings.users._form')
        <hr>
        <div class="d-flex justify-content-end gap-2">
            <a href="{{ route('settings.users.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left me-1"></i> Batal</a>
            <button type="submit" class="btn btn-accent"><i class="fas fa-save me-1"></i> Perbarui</button>
        </div>
    </form>
</x-card>
@endsection
