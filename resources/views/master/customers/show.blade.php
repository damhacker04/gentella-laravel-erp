@extends('layouts.app')

@section('title', 'Detail Pelanggan')
@section('page-title', 'Detail Pelanggan')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#">Master Data</a></li>
    <li class="breadcrumb-item"><a href="{{ route('master.customers.index') }}">Pelanggan</a></li>
    <li class="breadcrumb-item active">{{ $customer->code }}</li>
@endsection

@section('page-actions')
    <div class="d-flex gap-2">
        @can('master.customers.update')
        <a href="{{ route('master.customers.edit', $customer) }}" class="btn btn-warning">
            <i class="fas fa-edit me-1"></i> Edit
        </a>
        @endcan
        <a href="{{ route('master.customers.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
    </div>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-8">
        <x-card title="Informasi Pelanggan">
            <table class="table table-borderless mb-0">
                <tr>
                    <td class="text-muted" style="width:180px">Kode</td>
                    <td><strong>{{ $customer->code }}</strong></td>
                </tr>
                <tr>
                    <td class="text-muted">Nama</td>
                    <td>{{ $customer->name }}</td>
                </tr>
                <tr>
                    <td class="text-muted">Email</td>
                    <td>{{ $customer->email ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="text-muted">Telepon</td>
                    <td>{{ $customer->phone ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="text-muted">Alamat</td>
                    <td>{{ $customer->address ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="text-muted">Status</td>
                    <td><x-status-badge :status="$customer->is_active ? 'ACTIVE' : 'INACTIVE'" /></td>
                </tr>
                <tr>
                    <td class="text-muted">Dibuat</td>
                    <td>{{ $customer->created_at?->format('d M Y, H:i') }}</td>
                </tr>
            </table>
        </x-card>
    </div>

    <div class="col-lg-4">
        <x-card title="Ringkasan Transaksi">
            <div class="text-center py-3">
                <div class="mb-3">
                    <div class="text-muted" style="font-size:12px">Total Sales Order</div>
                    <div style="font-size:24px; font-weight:700; color: var(--primary)">{{ $customer->salesOrders->count() ?? 0 }}</div>
                </div>
                <hr>
                <div>
                    <div class="text-muted" style="font-size:12px">Total Pembelian</div>
                    <div style="font-size:24px; font-weight:700; color: var(--accent)">
                        Rp {{ number_format($customer->salesOrders->sum('total') ?? 0, 0, ',', '.') }}
                    </div>
                </div>
            </div>
        </x-card>
    </div>
</div>
@endsection
