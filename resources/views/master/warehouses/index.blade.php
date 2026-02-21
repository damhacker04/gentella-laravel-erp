@extends('layouts.app')
@section('title', 'Data Gudang')
@section('page-title', 'Data Gudang')
@section('breadcrumb')
    <li class="breadcrumb-item active">Master Data</li>
    <li class="breadcrumb-item active">Gudang</li>
@endsection
@section('page-actions')
    @can('master.warehouses.create')
    <a href="{{ route('master.warehouses.create') }}" class="btn btn-accent"><i class="fas fa-plus me-1"></i> Tambah Gudang</a>
    @endcan
@endsection
@section('content')
<x-card title="Daftar Gudang">
    <x-data-table id="warehouses-table">
        <x-slot name="head">
            <th style="width:50px">No</th><th>Kode</th><th>Nama Gudang</th><th>Lokasi</th><th>Status</th><th style="width:120px">Aksi</th>
        </x-slot>
        <x-slot name="body">
            @foreach($warehouses as $i => $wh)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td><strong>{{ $wh->code }}</strong></td>
                <td>{{ $wh->name }}</td>
                <td>{{ $wh->location ?? '-' }}</td>
                <td><x-status-badge :status="$wh->is_active ? 'ACTIVE' : 'INACTIVE'" /></td>
                <td>
                    <x-btn-action
                        :show-route="route('master.warehouses.show', $wh)"
                        :edit-route="route('master.warehouses.edit', $wh)"
                        :delete-route="route('master.warehouses.destroy', $wh)"
                    />
                </td>
            </tr>
            @endforeach
        </x-slot>
    </x-data-table>
</x-card>
@endsection
