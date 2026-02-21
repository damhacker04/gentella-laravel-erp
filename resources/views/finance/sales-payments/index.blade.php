@extends('layouts.app')
@section('title', 'Pembayaran Penjualan')
@section('page-title', 'Pembayaran Penjualan')
@section('breadcrumb')
    <li class="breadcrumb-item active">Keuangan</li>
    <li class="breadcrumb-item active">Pembayaran Penjualan</li>
@endsection
@section('content')
<x-card title="Daftar Pembayaran Penjualan">
    <x-data-table id="sales-payments-table">
        <x-slot name="head">
            <th>No</th><th>No. Pembayaran</th><th>No. Faktur</th><th>Tanggal</th><th class="text-end">Jumlah</th><th>Metode</th><th>Status</th><th>Aksi</th>
        </x-slot>
        <x-slot name="body">
            @foreach($payments ?? [] as $i => $pay)
            <tr>
                <td>{{ $i+1 }}</td>
                <td><strong>{{ $pay->code }}</strong></td>
                <td>{{ $pay->salesInvoice->code ?? '-' }}</td>
                <td>{{ $pay->paid_at?->format('d M Y') }}</td>
                <td class="text-end">Rp {{ number_format($pay->amount, 0, ',', '.') }}</td>
                <td>{{ $pay->method }}</td>
                <td><x-status-badge :status="$pay->status" /></td>
                <td><x-btn-action :show-route="route('finance.sales-payments.show', $pay)" /></td>
            </tr>
            @endforeach
        </x-slot>
    </x-data-table>
</x-card>
@endsection
