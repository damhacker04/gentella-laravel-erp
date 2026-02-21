@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="row">
    {{-- Sales Orders Today --}}
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="stat-card bg-sales">
            <div class="stat-icon"><i class="fas fa-file-invoice"></i></div>
            <div class="stat-value">{{ $salesOrderCount ?? 0 }}</div>
            <div class="stat-label">Sales Order Bulan Ini</div>
        </div>
    </div>

    {{-- Purchase Orders --}}
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="stat-card bg-purchase">
            <div class="stat-icon"><i class="fas fa-shopping-cart"></i></div>
            <div class="stat-value">{{ $purchaseOrderCount ?? 0 }}</div>
            <div class="stat-label">Purchase Order Bulan Ini</div>
        </div>
    </div>

    {{-- Total Revenue --}}
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="stat-card bg-revenue">
            <div class="stat-icon"><i class="fas fa-money-bill-wave"></i></div>
            <div class="stat-value">Rp {{ number_format($totalRevenue ?? 0, 0, ',', '.') }}</div>
            <div class="stat-label">Pendapatan Bulan Ini</div>
        </div>
    </div>

    {{-- Unpaid Invoices --}}
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="stat-card bg-invoice">
            <div class="stat-icon"><i class="fas fa-exclamation-triangle"></i></div>
            <div class="stat-value">{{ $unpaidInvoices ?? 0 }}</div>
            <div class="stat-label">Faktur Belum Lunas</div>
        </div>
    </div>
</div>

<div class="row">
    {{-- Recent Sales Orders --}}
    <div class="col-lg-6 mb-4">
        <x-card title="Sales Order Terbaru">
            <div class="table-responsive">
                <table class="table table-sm mb-0">
                    <thead>
                        <tr>
                            <th>No. SO</th>
                            <th>Pelanggan</th>
                            <th>Total</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentSalesOrders ?? [] as $so)
                        <tr>
                            <td><a href="{{ route('sales.orders.show', $so) }}">{{ $so->code }}</a></td>
                            <td>{{ $so->customer->name ?? '-' }}</td>
                            <td>Rp {{ number_format($so->total, 0, ',', '.') }}</td>
                            <td><x-status-badge :status="$so->status" /></td>
                        </tr>
                        @empty
                        <tr><td colspan="4" class="text-center text-muted">Belum ada data</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </x-card>
    </div>

    {{-- Recent Purchase Orders --}}
    <div class="col-lg-6 mb-4">
        <x-card title="Purchase Order Terbaru">
            <div class="table-responsive">
                <table class="table table-sm mb-0">
                    <thead>
                        <tr>
                            <th>No. PO</th>
                            <th>Supplier</th>
                            <th>Total</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentPurchaseOrders ?? [] as $po)
                        <tr>
                            <td><a href="{{ route('purchasing.orders.show', $po) }}">{{ $po->code }}</a></td>
                            <td>{{ $po->supplier->name ?? '-' }}</td>
                            <td>Rp {{ number_format($po->total, 0, ',', '.') }}</td>
                            <td><x-status-badge :status="$po->status" /></td>
                        </tr>
                        @empty
                        <tr><td colspan="4" class="text-center text-muted">Belum ada data</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </x-card>
    </div>
</div>
@endsection
