@extends('layouts.app')
@section('title', 'Faktur Penjualan')
@section('page-title', 'Faktur Penjualan (Sales Invoice)')
@section('breadcrumb')
    <li class="breadcrumb-item active">Penjualan</li>
    <li class="breadcrumb-item active">Faktur</li>
@endsection
@section('page-actions')
    @can('sales.invoices.create')
    <a href="{{ route('sales.invoices.create') }}" class="btn btn-accent"><i class="fas fa-plus me-1"></i> Buat Faktur</a>
    @endcan
@endsection
@section('content')
<x-card title="Daftar Faktur Penjualan">
    <x-data-table id="sales-invoices-table">
        <x-slot name="head">
            <th>No</th><th>No. Faktur</th><th>No. SO</th><th>Tanggal</th><th>Jatuh Tempo</th><th class="text-end">Total</th><th>Status</th><th>Aksi</th>
        </x-slot>
        <x-slot name="body">
            @foreach($invoices ?? [] as $i => $inv)
            <tr>
                <td>{{ $i+1 }}</td>
                <td><strong>{{ $inv->code }}</strong></td>
                <td>{{ $inv->salesOrder->code ?? '-' }}</td>
                <td>{{ $inv->invoice_date?->format('d M Y') }}</td>
                <td>{{ $inv->due_date?->format('d M Y') }}</td>
                <td class="text-end">Rp {{ number_format($inv->total, 0, ',', '.') }}</td>
                <td><x-status-badge :status="$inv->status" /></td>
                <td><x-btn-action :show-route="route('sales.invoices.show', $inv)" /></td>
            </tr>
            @endforeach
        </x-slot>
    </x-data-table>
</x-card>
@endsection
