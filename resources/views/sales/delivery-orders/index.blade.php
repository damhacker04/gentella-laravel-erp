@extends('layouts.app')
@section('title', 'Surat Jalan')
@section('page-title', 'Surat Jalan (Delivery Order)')
@section('breadcrumb')
    <li class="breadcrumb-item active">Penjualan</li>
    <li class="breadcrumb-item active">Surat Jalan</li>
@endsection
@section('page-actions')
    @can('sales.delivery_orders.create')
    <a href="{{ route('sales.delivery-orders.create') }}" class="btn btn-accent"><i class="fas fa-plus me-1"></i> Buat Surat Jalan</a>
    @endcan
@endsection
@section('content')
<x-card title="Daftar Surat Jalan">
    <x-data-table id="delivery-orders-table">
        <x-slot name="head">
            <th>No</th><th>No. DO</th><th>No. SO</th><th>Gudang</th><th>Tanggal Kirim</th><th>Status</th><th>Aksi</th>
        </x-slot>
        <x-slot name="body">
            @foreach($deliveryOrders ?? [] as $i => $do)
            <tr>
                <td>{{ $i+1 }}</td>
                <td><strong>{{ $do->code }}</strong></td>
                <td>{{ $do->salesOrder->code ?? '-' }}</td>
                <td>{{ $do->warehouse->name ?? '-' }}</td>
                <td>{{ $do->delivered_at?->format('d M Y') ?? '-' }}</td>
                <td><x-status-badge :status="$do->status" /></td>
                <td><x-btn-action :show-route="route('sales.delivery-orders.show', $do)" /></td>
            </tr>
            @endforeach
        </x-slot>
    </x-data-table>
</x-card>
@endsection
