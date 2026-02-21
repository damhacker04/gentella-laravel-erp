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
{{-- Filter Panel --}}
<x-card>
    <form method="GET" action="{{ route('sales.orders.index') }}" class="row g-3 align-items-end">
        <div class="col-md-3">
            <label for="status" class="form-label mb-1"><small>Filter Status</small></label>
            <select name="status" id="status" class="form-select form-select-sm">
                <option value="">— Semua Status —</option>
                <option value="DRAFT" {{ request('status') === 'DRAFT' ? 'selected' : '' }}>Draft</option>
                <option value="CONFIRMED" {{ request('status') === 'CONFIRMED' ? 'selected' : '' }}>Confirmed</option>
                <option value="PAID" {{ request('status') === 'PAID' ? 'selected' : '' }}>Paid</option>
                <option value="CANCELLED" {{ request('status') === 'CANCELLED' ? 'selected' : '' }}>Cancelled</option>
            </select>
        </div>
        <div class="col-md-3">
            <label for="date_from" class="form-label mb-1"><small>Dari Tanggal</small></label>
            <input type="date" name="date_from" id="date_from" class="form-control form-control-sm"
                   value="{{ request('date_from') }}">
        </div>
        <div class="col-md-3">
            <label for="date_to" class="form-label mb-1"><small>Sampai Tanggal</small></label>
            <input type="date" name="date_to" id="date_to" class="form-control form-control-sm"
                   value="{{ request('date_to') }}">
        </div>
        <div class="col-md-3">
            <button type="submit" class="btn btn-sm btn-accent me-1"><i class="fas fa-filter me-1"></i>Filter</button>
            <a href="{{ route('sales.orders.index') }}" class="btn btn-sm btn-secondary"><i class="fas fa-sync me-1"></i>Reset</a>
        </div>
    </form>
</x-card>

{{-- Data Table --}}
<x-card title="Daftar Sales Order">
    <x-data-table id="sales-orders-table">
        <x-slot name="head">
            <th style="width:50px">No</th>
            <th>No. SO</th>
            <th>Tanggal</th>
            <th>Pelanggan</th>
            <th class="text-end">Total</th>
            <th>Status</th>
            <th style="width:160px">Aksi</th>
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
                    <div class="d-flex gap-1">
                        <x-btn-action
                            :show-route="route('sales.orders.show', $so)"
                            :edit-route="$so->status === 'DRAFT' ? route('sales.orders.edit', $so) : null"
                            :delete-route="$so->status === 'DRAFT' ? route('sales.orders.destroy', $so) : null"
                            show-permission="sales.orders.view"
                            edit-permission="sales.orders.create"
                            delete-permission="sales.orders.create"
                        />
                        @if($so->status === 'CONFIRMED')
                            <form action="{{ route('sales.orders.mark-as-paid', $so) }}" method="POST" class="d-inline">
                                @csrf @method('PATCH')
                                <button class="btn btn-sm btn-success" title="Mark as Paid"
                                        onclick="return confirm('Tandai SO ini sebagai Paid?')">
                                    <i class="fas fa-check-double"></i>
                                </button>
                            </form>
                        @endif
                    </div>
                </td>
            </tr>
            @endforeach
        </x-slot>
    </x-data-table>
</x-card>
@endsection
