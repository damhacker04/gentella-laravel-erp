@extends('layouts.app')

@section('title', 'Sales Order')
@section('page-title', 'Sales Order')

@section('breadcrumb')
    <li class="breadcrumb-item active">Penjualan</li>
    <li class="breadcrumb-item active">Sales Order</li>
@endsection

@section('page-actions')
    @can('sales.orders.create')
    <a href="{{ route('sales.orders.create') }}" class="btn btn-accent">
        <i class="fas fa-plus me-1"></i> Buat Sales Order
    </a>
    @endcan
@endsection

@section('content')
<x-card title="Daftar Sales Order">
    <x-data-table id="sales-orders-table">
        <x-slot name="head">
            <th style="width:50px">No</th>
            <th>No. SO</th>
            <th>Tanggal</th>
            <th>Pelanggan</th>
            <th class="text-end">Total</th>
            <th>Status</th>
            <th style="width:120px">Aksi</th>
        </x-slot>
        <x-slot name="body">
            @foreach($salesOrders as $i => $so)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td><a href="{{ route('sales.orders.show', $so) }}"><strong>{{ $so->code }}</strong></a></td>
                <td>{{ $so->order_date?->format('d M Y') }}</td>
                <td>{{ $so->customer->name ?? '-' }}</td>
                <td class="text-end">Rp {{ number_format($so->total, 0, ',', '.') }}</td>
                <td><x-status-badge :status="$so->status" /></td>
                <td>
                    <x-btn-action
                        :show-route="route('sales.orders.show', $so)"
                        :edit-route="$so->status === 'DRAFT' ? route('sales.orders.edit', $so) : null"
                        :delete-route="$so->status === 'DRAFT' ? route('sales.orders.destroy', $so) : null"
                        show-permission="sales.orders.view"
                        edit-permission="sales.orders.create"
                        delete-permission="sales.orders.create"
                    />
                </td>
            </tr>
            @endforeach
        </x-slot>
    </x-data-table>
</x-card>
@endsection
