@extends('layouts.app')

@section('title', 'Detail Sales Order')
@section('page-title', 'Detail Sales Order')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#">Penjualan</a></li>
    <li class="breadcrumb-item"><a href="{{ route('sales.orders.index') }}">Sales Order</a></li>
    <li class="breadcrumb-item active">{{ $salesOrder->code }}</li>
@endsection

@section('content')
<div class="row">
    {{-- Main Info --}}
    <div class="col-lg-8">
        <x-card title="{{ $salesOrder->code }}">
            <x-slot name="headerActions">
                <x-status-badge :status="$salesOrder->status" />
            </x-slot>

            <div class="row mb-4">
                <div class="col-md-6">
                    <table class="table table-borderless table-sm mb-0">
                        <tr>
                            <td class="text-muted" style="width:150px">No. SO</td>
                            <td><strong>{{ $salesOrder->code }}</strong></td>
                        </tr>
                        <tr>
                            <td class="text-muted">Pelanggan</td>
                            <td>
                                <a href="{{ route('master.customers.show', $salesOrder->customer) }}">
                                    {{ $salesOrder->customer->name }}
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted">Tanggal</td>
                            <td>{{ $salesOrder->order_date?->format('d M Y') }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table table-borderless table-sm mb-0">
                        <tr>
                            <td class="text-muted" style="width:150px">Catatan</td>
                            <td>{{ $salesOrder->notes ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Dibuat</td>
                            <td>{{ $salesOrder->created_at?->format('d M Y, H:i') }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            {{-- Items Table --}}
            <h6 class="mb-3"><i class="fas fa-list me-1"></i> Detail Barang</h6>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th style="width:40px">#</th>
                            <th>Produk</th>
                            <th class="text-center" style="width:80px">Qty</th>
                            <th class="text-end" style="width:150px">Harga Satuan</th>
                            <th class="text-end" style="width:150px">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($salesOrder->items as $idx => $item)
                        <tr>
                            <td>{{ $idx + 1 }}</td>
                            <td>
                                <strong>{{ $item->product->sku ?? '-' }}</strong><br>
                                <small class="text-muted">{{ $item->product->name ?? '-' }}</small>
                            </td>
                            <td class="text-center">{{ $item->qty }}</td>
                            <td class="text-end">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                            <td class="text-end">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="total-section">
                <span class="total-label">Grand Total:</span>
                <span class="total-value">Rp {{ number_format($salesOrder->total, 0, ',', '.') }}</span>
            </div>
        </x-card>
    </div>

    {{-- Sidebar Actions & Related Docs --}}
    <div class="col-lg-4">
        {{-- Actions --}}
        <x-card title="Aksi">
            <div class="d-grid gap-2">
                @if($salesOrder->status === 'DRAFT')
                    @can('sales.orders.create')
                    <a href="{{ route('sales.orders.edit', $salesOrder) }}" class="btn btn-warning">
                        <i class="fas fa-edit me-1"></i> Edit
                    </a>
                    @endcan

                    @can('sales.orders.approve')
                    <form action="{{ route('sales.orders.confirm', $salesOrder) }}" method="POST">
                        @csrf
                        <button type="button" class="btn btn-primary w-100 btn-status-change"
                                data-action="mengkonfirmasi order ini">
                            <i class="fas fa-check me-1"></i> Konfirmasi Order
                        </button>
                    </form>
                    @endcan

                    @can('sales.orders.cancel')
                    <form action="{{ route('sales.orders.cancel', $salesOrder) }}" method="POST">
                        @csrf
                        <button type="button" class="btn btn-danger w-100 btn-status-change"
                                data-action="membatalkan order ini">
                            <i class="fas fa-times me-1"></i> Batalkan
                        </button>
                    </form>
                    @endcan
                @endif

                @if($salesOrder->status === 'CONFIRMED')
                    @can('sales.orders.create')
                    <form action="{{ route('sales.orders.mark-as-paid', $salesOrder) }}" method="POST">
                        @csrf @method('PATCH')
                        <button type="button" class="btn btn-success w-100 btn-status-change"
                                data-action="menandai order ini sebagai Paid">
                            <i class="fas fa-check-double me-1"></i> Mark as Paid
                        </button>
                    </form>
                    @endcan

                    @can('sales.delivery_orders.create')
                    <a href="{{ route('sales.delivery-orders.create', ['sales_order_id' => $salesOrder->id]) }}"
                       class="btn btn-info">
                        <i class="fas fa-truck me-1"></i> Buat Surat Jalan
                    </a>
                    @endcan

                    @can('sales.invoices.create')
                    <a href="{{ route('sales.invoices.create', ['sales_order_id' => $salesOrder->id]) }}"
                       class="btn btn-primary">
                        <i class="fas fa-file-invoice me-1"></i> Buat Faktur
                    </a>
                    @endcan

                    @can('sales.orders.cancel')
                    <form action="{{ route('sales.orders.cancel', $salesOrder) }}" method="POST">
                        @csrf
                        <button type="button" class="btn btn-danger w-100 btn-status-change"
                                data-action="membatalkan order ini">
                            <i class="fas fa-times me-1"></i> Batalkan
                        </button>
                    </form>
                    @endcan
                @endif

                <a href="{{ route('sales.orders.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </a>
            </div>
        </x-card>

        {{-- Related Documents --}}
        <x-card title="Dokumen Terkait">
            <ul class="related-docs">
                @forelse($salesOrder->deliveryOrders ?? [] as $do)
                <li>
                    <i class="fas fa-truck text-info"></i>
                    <a href="{{ route('sales.delivery-orders.show', $do) }}">{{ $do->code }}</a>
                    <x-status-badge :status="$do->status" />
                </li>
                @empty
                <li class="text-muted"><i class="fas fa-inbox me-2"></i> Belum ada Surat Jalan</li>
                @endforelse

                @forelse($salesOrder->invoices ?? [] as $inv)
                <li>
                    <i class="fas fa-file-invoice text-warning"></i>
                    <a href="{{ route('sales.invoices.show', $inv) }}">{{ $inv->code }}</a>
                    <x-status-badge :status="$inv->status" />
                </li>
                @empty
                <li class="text-muted"><i class="fas fa-inbox me-2"></i> Belum ada Faktur</li>
                @endforelse
            </ul>
        </x-card>
    </div>
</div>
@endsection
