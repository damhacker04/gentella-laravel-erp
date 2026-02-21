@extends('layouts.app')
@section('title', 'Faktur Pembelian')
@section('page-title', 'Faktur Pembelian (Purchase Invoice)')
@section('breadcrumb')
    <li class="breadcrumb-item active">Pembelian</li>
    <li class="breadcrumb-item active">Faktur</li>
@endsection
@section('content')
<x-card title="Daftar Faktur Pembelian">
    <x-data-table id="purchase-invoices-table">
        <x-slot name="head">
            <th>No</th><th>No. Faktur</th><th>No. PO</th><th>Tanggal</th><th>Jatuh Tempo</th><th class="text-end">Total</th><th>Status</th><th>Aksi</th>
        </x-slot>
        <x-slot name="body">
            @foreach($invoices ?? [] as $i => $inv)
            <tr>
                <td>{{ $i+1 }}</td>
                <td><strong>{{ $inv->code }}</strong></td>
                <td>{{ $inv->purchaseOrder->code ?? '-' }}</td>
                <td>{{ $inv->invoice_date?->format('d M Y') }}</td>
                <td>{{ $inv->due_date?->format('d M Y') }}</td>
                <td class="text-end">Rp {{ number_format($inv->total, 0, ',', '.') }}</td>
                <td><x-status-badge :status="$inv->status" /></td>
                <td><x-btn-action :show-route="route('purchasing.invoices.show', $inv)" /></td>
            </tr>
            @endforeach
        </x-slot>
    </x-data-table>
</x-card>
@endsection
