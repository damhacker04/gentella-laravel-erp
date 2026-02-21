@extends('layouts.app')
@section('title', 'Purchase Order')
@section('page-title', 'Purchase Order')
@section('breadcrumb')
    <li class="breadcrumb-item active">Pembelian</li>
    <li class="breadcrumb-item active">Purchase Order</li>
@endsection
@section('page-actions')
    @can('purchasing.orders.create')
    <a href="{{ route('purchasing.orders.create') }}" class="btn btn-accent"><i class="fas fa-plus me-1"></i> Buat PO</a>
    @endcan
@endsection
@section('content')
<x-card title="Daftar Purchase Order">
    <x-data-table id="purchase-orders-table">
        <x-slot name="head">
            <th>No</th><th>No. PO</th><th>Tanggal</th><th>Supplier</th><th class="text-end">Total</th><th>Status</th><th>Aksi</th>
        </x-slot>
        <x-slot name="body">
            @foreach($purchaseOrders ?? [] as $i => $po)
            <tr>
                <td>{{ $i+1 }}</td>
                <td><strong>{{ $po->code }}</strong></td>
                <td>{{ $po->order_date?->format('d M Y') }}</td>
                <td>{{ $po->supplier->name ?? '-' }}</td>
                <td class="text-end">Rp {{ number_format($po->total, 0, ',', '.') }}</td>
                <td><x-status-badge :status="$po->status" /></td>
                <td><x-btn-action :show-route="route('purchasing.orders.show', $po)" /></td>
            </tr>
            @endforeach
        </x-slot>
    </x-data-table>
</x-card>
@endsection
