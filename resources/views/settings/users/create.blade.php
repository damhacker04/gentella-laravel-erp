@extends('layouts.app')
@section('title', 'Tambah Pengguna')
@section('page-title', 'Tambah Pengguna')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#">Pengaturan</a></li>
    <li class="breadcrumb-item"><a href="{{ route('settings.users.index') }}">Pengguna</a></li>
    <li class="breadcrumb-item active">Tambah</li>
@endsection
@section('content')
<x-card title="Form Pengguna Baru">
    <form action="{{ route('settings.users.store') }}" method="POST">
        @csrf
        @include('settings.users._form')
        <hr>
        <div class="d-flex justify-content-end gap-2">
            <a href="{{ route('settings.users.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left me-1"></i> Batal</a>
            <button type="submit" class="btn btn-accent"><i class="fas fa-save me-1"></i> Simpan</button>
        </div>
    </form>
</x-card>
@endsection
