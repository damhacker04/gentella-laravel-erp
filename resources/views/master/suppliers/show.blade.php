@extends('layouts.app')
@section('title', 'Detail Supplier')
@section('page-title', 'Detail Supplier')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#">Master Data</a></li>
    <li class="breadcrumb-item"><a href="{{ route('master.suppliers.index') }}">Supplier</a></li>
    <li class="breadcrumb-item active">{{ $supplier->code }}</li>
@endsection
@section('page-actions')
    <div class="d-flex gap-2">
        @can('master.suppliers.update')
        <a href="{{ route('master.suppliers.edit', $supplier) }}" class="btn btn-warning"><i class="fas fa-edit me-1"></i> Edit</a>
        @endcan
        <a href="{{ route('master.suppliers.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left me-1"></i> Kembali</a>
    </div>
@endsection
@section('content')
<x-card title="Informasi Supplier">
    <table class="table table-borderless mb-0">
        <tr><td class="text-muted" style="width:180px">Kode</td><td><strong>{{ $supplier->code }}</strong></td></tr>
        <tr><td class="text-muted">Nama</td><td>{{ $supplier->name }}</td></tr>
        <tr><td class="text-muted">Email</td><td>{{ $supplier->email ?? '-' }}</td></tr>
        <tr><td class="text-muted">Telepon</td><td>{{ $supplier->phone ?? '-' }}</td></tr>
        <tr><td class="text-muted">Alamat</td><td>{{ $supplier->address ?? '-' }}</td></tr>
        <tr><td class="text-muted">Status</td><td><x-status-badge :status="$supplier->is_active ? 'ACTIVE' : 'INACTIVE'" /></td></tr>
    </table>
</x-card>
@endsection
