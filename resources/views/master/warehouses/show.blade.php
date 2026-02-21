@extends('layouts.app')
@section('title', 'Detail Gudang')
@section('page-title', 'Detail Gudang')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#">Master Data</a></li>
    <li class="breadcrumb-item"><a href="{{ route('master.warehouses.index') }}">Gudang</a></li>
    <li class="breadcrumb-item active">{{ $warehouse->code }}</li>
@endsection
@section('page-actions')
    <div class="d-flex gap-2">
        <a href="{{ route('master.warehouses.edit', $warehouse) }}" class="btn btn-warning"><i class="fas fa-edit me-1"></i> Edit</a>
        <a href="{{ route('master.warehouses.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left me-1"></i> Kembali</a>
    </div>
@endsection
@section('content')
<x-card title="Informasi Gudang">
    <table class="table table-borderless mb-0">
        <tr><td class="text-muted" style="width:180px">Kode</td><td><strong>{{ $warehouse->code }}</strong></td></tr>
        <tr><td class="text-muted">Nama</td><td>{{ $warehouse->name }}</td></tr>
        <tr><td class="text-muted">Lokasi</td><td>{{ $warehouse->location ?? '-' }}</td></tr>
        <tr><td class="text-muted">Status</td><td><x-status-badge :status="$warehouse->is_active ? 'ACTIVE' : 'INACTIVE'" /></td></tr>
    </table>
</x-card>
@endsection
