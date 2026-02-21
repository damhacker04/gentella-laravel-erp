@extends('layouts.app')
@section('title', 'Data Supplier')
@section('page-title', 'Data Supplier')
@section('breadcrumb')
    <li class="breadcrumb-item active">Master Data</li>
    <li class="breadcrumb-item active">Supplier</li>
@endsection
@section('page-actions')
    @can('master.suppliers.create')
    <a href="{{ route('master.suppliers.create') }}" class="btn btn-accent"><i class="fas fa-plus me-1"></i> Tambah Supplier</a>
    @endcan
@endsection
@section('content')
<x-card title="Daftar Supplier">
    <x-data-table id="suppliers-table">
        <x-slot name="head">
            <th style="width:50px">No</th><th>Kode</th><th>Nama</th><th>Telepon</th><th>Email</th><th>Status</th><th style="width:120px">Aksi</th>
        </x-slot>
        <x-slot name="body">
            @foreach($suppliers as $i => $supplier)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td><strong>{{ $supplier->code }}</strong></td>
                <td>{{ $supplier->name }}</td>
                <td>{{ $supplier->phone ?? '-' }}</td>
                <td>{{ $supplier->email ?? '-' }}</td>
                <td><x-status-badge :status="$supplier->is_active ? 'ACTIVE' : 'INACTIVE'" /></td>
                <td>
                    <x-btn-action
                        :show-route="route('master.suppliers.show', $supplier)"
                        :edit-route="route('master.suppliers.edit', $supplier)"
                        :delete-route="route('master.suppliers.destroy', $supplier)"
                        show-permission="master.suppliers.view"
                        edit-permission="master.suppliers.update"
                        delete-permission="master.suppliers.delete"
                    />
                </td>
            </tr>
            @endforeach
        </x-slot>
    </x-data-table>
</x-card>
@endsection
