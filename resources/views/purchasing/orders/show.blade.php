@extends('layouts.app')
@section('title', $order->code)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="mb-1"><i class="fas fa-file-alt me-2"></i>{{ $order->code }}</h4>
        <nav aria-label="breadcrumb"><ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('purchasing.orders.index') }}">Purchase Order</a></li>
            <li class="breadcrumb-item active">{{ $order->code }}</li>
        </ol></nav>
    </div>
    <div>
        @if($order->status === 'DRAFT')
            <a href="{{ route('purchasing.orders.edit', $order) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit me-1"></i>Edit</a>
            <form action="{{ route('purchasing.orders.confirm', $order) }}" method="POST" class="d-inline">
                @csrf @method('PATCH')
                <button class="btn btn-success btn-sm" onclick="return confirm('Konfirmasi PO ini?')"><i class="fas fa-check me-1"></i>Konfirmasi</button>
            </form>
            <form action="{{ route('purchasing.orders.cancel', $order) }}" method="POST" class="d-inline">
                @csrf @method('PATCH')
                <button class="btn btn-danger btn-sm" onclick="return confirm('Batalkan PO ini?')"><i class="fas fa-times me-1"></i>Batal</button>
            </form>
        @elseif($order->status === 'CONFIRMED')
            <a href="{{ route('purchasing.goods-receipts.create', ['purchase_order_id' => $order->id]) }}" class="btn btn-info btn-sm">
                <i class="fas fa-truck-loading me-1"></i>Buat Goods Receipt
            </a>
            <a href="{{ route('purchasing.invoices.create', ['purchase_order_id' => $order->id]) }}" class="btn btn-primary btn-sm">
                <i class="fas fa-file-invoice-dollar me-1"></i>Buat Faktur
            </a>
            <form action="{{ route('purchasing.orders.cancel', $order) }}" method="POST" class="d-inline">
                @csrf @method('PATCH')
                <button class="btn btn-danger btn-sm" onclick="return confirm('Batalkan PO ini?')"><i class="fas fa-times me-1"></i>Batal</button>
            </form>
        @endif
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <x-card>
            <div class="row mb-3">
                <div class="col-md-4"><strong>Kode PO</strong><br>{{ $order->code }}</div>
                <div class="col-md-4"><strong>Supplier</strong><br>{{ $order->supplier->name }}</div>
                <div class="col-md-4"><strong>Tanggal</strong><br>{{ $order->order_date->format('d M Y') }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4"><strong>Status</strong><br><x-status-badge :status="$order->status" /></div>
                <div class="col-md-4"><strong>Dibuat Oleh</strong><br>{{ $order->createdBy->name ?? '-' }}</div>
                <div class="col-md-4"><strong>Catatan</strong><br>{{ $order->notes ?? '-' }}</div>
            </div>

            <hr>
            <h6><i class="fas fa-list me-1"></i> Detail Barang</h6>
            <div class="table-responsive">
                <table class="table items-table">
                    <thead><tr><th>#</th><th>Produk</th><th>Qty</th><th>Harga</th><th class="text-end">Subtotal</th></tr></thead>
                    <tbody>
                        @foreach($order->items as $idx => $item)
                        <tr>
                            <td>{{ $idx + 1 }}</td>
                            <td>{{ $item->product->sku }} — {{ $item->product->name }}</td>
                            <td>{{ $item->qty }}</td>
                            <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                            <td class="text-end">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="total-section">
                <span class="total-label">Grand Total:</span>
                <span class="total-value">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
            </div>
        </x-card>
    </div>

    <div class="col-md-4">
        <x-card title="Dokumen Terkait">
            <h6 class="mb-2"><i class="fas fa-truck-loading me-1"></i> Goods Receipt</h6>
            @forelse($order->goodsReceipts as $grn)
                <a href="{{ route('purchasing.goods-receipts.show', $grn) }}" class="d-block mb-1">
                    {{ $grn->code }} <x-status-badge :status="$grn->status" />
                </a>
            @empty
                <p class="text-muted small">Belum ada GRN</p>
            @endforelse

            <hr>
            <h6 class="mb-2"><i class="fas fa-file-invoice me-1"></i> Faktur Pembelian</h6>
            @forelse($order->invoices as $inv)
                <a href="{{ route('purchasing.invoices.show', $inv) }}" class="d-block mb-1">
                    {{ $inv->code }} <x-status-badge :status="$inv->status" />
                </a>
            @empty
                <p class="text-muted small">Belum ada faktur</p>
            @endforelse
        </x-card>
    </div>
</div>
@endsection
