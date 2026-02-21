@extends('layouts.app')
@section('title', $invoice->code)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="mb-1"><i class="fas fa-file-invoice me-2"></i>{{ $invoice->code }}</h4>
        <nav aria-label="breadcrumb"><ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('sales.invoices.index') }}">Faktur Penjualan</a></li>
            <li class="breadcrumb-item active">{{ $invoice->code }}</li>
        </ol></nav>
    </div>
    <div>
        @if($invoice->status === 'DRAFT')
            <a href="{{ route('sales.invoices.edit', $invoice) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit me-1"></i>Edit</a>
            <form action="{{ route('sales.invoices.post', $invoice) }}" method="POST" class="d-inline">
                @csrf @method('PATCH')
                <button class="btn btn-success btn-sm" onclick="return confirm('Posting faktur ini?')"><i class="fas fa-check me-1"></i>Posting</button>
            </form>
        @elseif($invoice->status === 'POSTED')
            <a href="{{ route('finance.sales-payments.create', ['sales_invoice_id' => $invoice->id]) }}" class="btn btn-info btn-sm">
                <i class="fas fa-money-bill me-1"></i>Catat Pembayaran
            </a>
            <form action="{{ route('sales.invoices.void', $invoice) }}" method="POST" class="d-inline">
                @csrf @method('PATCH')
                <button class="btn btn-danger btn-sm" onclick="return confirm('Void faktur ini?')"><i class="fas fa-ban me-1"></i>Void</button>
            </form>
        @endif
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <x-card>
            <div class="row mb-3">
                <div class="col-md-3"><strong>Kode Faktur</strong><br>{{ $invoice->code }}</div>
                <div class="col-md-3"><strong>Ref. SO</strong><br><a href="{{ route('sales.orders.show', $invoice->salesOrder) }}">{{ $invoice->salesOrder->code }}</a></div>
                <div class="col-md-3"><strong>Pelanggan</strong><br>{{ $invoice->salesOrder->customer->name }}</div>
                <div class="col-md-3"><strong>Status</strong><br><x-status-badge :status="$invoice->status" /></div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3"><strong>Tgl Faktur</strong><br>{{ $invoice->invoice_date->format('d M Y') }}</div>
                <div class="col-md-3"><strong>Jatuh Tempo</strong><br>{{ $invoice->due_date->format('d M Y') }}</div>
                <div class="col-md-3"><strong>Dibuat Oleh</strong><br>{{ $invoice->createdBy->name ?? '-' }}</div>
                <div class="col-md-3"><strong>Catatan</strong><br>{{ $invoice->notes ?? '-' }}</div>
            </div>

            <hr>
            <h6><i class="fas fa-list me-1"></i> Detail Barang</h6>
            <div class="table-responsive">
                <table class="table items-table">
                    <thead><tr><th>#</th><th>Produk</th><th>Qty</th><th>Harga</th><th class="text-end">Subtotal</th></tr></thead>
                    <tbody>
                        @foreach($invoice->items as $idx => $item)
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
                <span class="total-value">Rp {{ number_format($invoice->total, 0, ',', '.') }}</span>
            </div>
        </x-card>
    </div>

    <div class="col-md-4">
        <x-card title="Pembayaran">
            @php $totalPaid = $invoice->payments->where('status','CONFIRMED')->sum('amount'); @endphp
            <div class="mb-3">
                <strong>Total Faktur:</strong> Rp {{ number_format($invoice->total, 0, ',', '.') }}<br>
                <strong>Sudah Dibayar:</strong> Rp {{ number_format($totalPaid, 0, ',', '.') }}<br>
                <strong>Sisa:</strong> Rp {{ number_format($invoice->total - $totalPaid, 0, ',', '.') }}
            </div>
            @forelse($invoice->payments as $pay)
                <div class="border-bottom pb-2 mb-2">
                    <strong>{{ $pay->code }}</strong><br>
                    <small>{{ $pay->paid_at->format('d M Y') }} • {{ $pay->method }} • Rp {{ number_format($pay->amount, 0, ',', '.') }}</small>
                </div>
            @empty
                <p class="text-muted small">Belum ada pembayaran</p>
            @endforelse
        </x-card>
    </div>
</div>
@endsection
