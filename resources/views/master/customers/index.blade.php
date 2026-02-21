@extends('layouts.app')

@section('title', 'Data Pelanggan')
@section('page-title', 'Data Pelanggan')

@section('breadcrumb')
    <li class="breadcrumb-item active">Master Data</li>
    <li class="breadcrumb-item active">Pelanggan</li>
@endsection

@section('page-actions')
    @can('master.customers.create')
    <a href="{{ route('master.customers.create') }}" class="btn btn-accent">
        <i class="fas fa-plus me-1"></i> Tambah Pelanggan
    </a>
    @endcan
@endsection

@section('content')
<x-card title="Daftar Pelanggan">
    <x-data-table id="customers-table">
        <x-slot name="head">
            <th style="width:50px">No</th>
            <th>Kode</th>
            <th>Nama</th>
            <th>Telepon</th>
            <th>Email</th>
            <th>Status</th>
            <th style="width:120px">Aksi</th>
        </x-slot>
        <x-slot name="body">
            @foreach($customers as $i => $customer)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td><strong>{{ $customer->code }}</strong></td>
                <td>{{ $customer->name }}</td>
                <td>{{ $customer->phone ?? '-' }}</td>
                <td>{{ $customer->email ?? '-' }}</td>
                <td><x-status-badge :status="$customer->is_active ? 'ACTIVE' : 'INACTIVE'" /></td>
                <td>
                    <x-btn-action
                        :show-route="route('master.customers.show', $customer)"
                        :edit-route="route('master.customers.edit', $customer)"
                        :delete-route="route('master.customers.destroy', $customer)"
                        show-permission="master.customers.view"
                        edit-permission="master.customers.update"
                        delete-permission="master.customers.delete"
                    />
                </td>
            </tr>
            @endforeach
        </x-slot>
    </x-data-table>
</x-card>
@endsection
