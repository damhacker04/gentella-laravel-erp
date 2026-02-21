@extends('layouts.app')
@section('title', 'Termin Pembayaran')
@section('page-title', 'Termin Pembayaran')
@section('breadcrumb')
    <li class="breadcrumb-item active">Master Data</li>
    <li class="breadcrumb-item active">Termin Pembayaran</li>
@endsection
@section('page-actions')
    @can('master.payment_terms.create')
    <a href="{{ route('master.payment-terms.create') }}" class="btn btn-accent"><i class="fas fa-plus me-1"></i> Tambah Termin</a>
    @endcan
@endsection
@section('content')
<x-card title="Daftar Termin Pembayaran">
    <x-data-table id="payment-terms-table">
        <x-slot name="head">
            <th style="width:50px">No</th><th>Kode</th><th>Nama</th><th>Jumlah Hari</th><th>Status</th><th style="width:120px">Aksi</th>
        </x-slot>
        <x-slot name="body">
            @foreach($paymentTerms as $i => $pt)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td><strong>{{ $pt->code }}</strong></td>
                <td>{{ $pt->name }}</td>
                <td>{{ $pt->days }} hari</td>
                <td><x-status-badge :status="$pt->is_active ? 'ACTIVE' : 'INACTIVE'" /></td>
                <td>
                    <x-btn-action
                        :edit-route="route('master.payment-terms.edit', $pt)"
                        :delete-route="route('master.payment-terms.destroy', $pt)"
                    />
                </td>
            </tr>
            @endforeach
        </x-slot>
    </x-data-table>
</x-card>
@endsection
