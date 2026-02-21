@extends('layouts.app')
@section('title', 'Penerimaan Barang')
@section('page-title', 'Penerimaan Barang (Goods Receipt)')
@section('breadcrumb')
    <li class="breadcrumb-item active">Pembelian</li>
    <li class="breadcrumb-item active">Penerimaan Barang</li>
@endsection
@section('page-actions')
    @can('purchasing.goods_receipts.create')
    <a href="{{ route('purchasing.goods-receipts.create') }}" class="btn btn-accent"><i class="fas fa-plus me-1"></i> Buat Penerimaan</a>
    @endcan
@endsection
@section('content')
<x-card title="Daftar Penerimaan Barang">
    <x-data-table id="goods-receipts-table">
        <x-slot name="head">
            <th>No</th><th>No. GRN</th><th>No. PO</th><th>Gudang</th><th>Tanggal Terima</th><th>Status</th><th>Aksi</th>
        </x-slot>
        <x-slot name="body">
            @foreach($goodsReceipts ?? [] as $i => $gr)
            <tr>
                <td>{{ $i+1 }}</td>
                <td><strong>{{ $gr->code }}</strong></td>
                <td>{{ $gr->purchaseOrder->code ?? '-' }}</td>
                <td>{{ $gr->warehouse->name ?? '-' }}</td>
                <td>{{ $gr->received_at?->format('d M Y') ?? '-' }}</td>
                <td><x-status-badge :status="$gr->status" /></td>
                <td><x-btn-action :show-route="route('purchasing.goods-receipts.show', $gr)" /></td>
            </tr>
            @endforeach
        </x-slot>
    </x-data-table>
</x-card>
@endsection
