@extends('layouts.app')

@section('title', 'Pembayaran Xendit')
@section('page-title', 'Pembayaran Xendit')

@section('breadcrumb')
    <li class="breadcrumb-item active">Keuangan</li>
    <li class="breadcrumb-item active">Pembayaran Xendit</li>
@endsection

@section('content')
{{-- Filter --}}
<x-card>
    <form method="GET" action="{{ route('finance.xendit-payments.index') }}" class="row g-3 align-items-end">
        <div class="col-md-3">
            <label class="form-label mb-1"><small>Filter Status</small></label>
            <select name="status" class="form-select form-select-sm">
                <option value="">— Semua Status —</option>
                <option value="PENDING" {{ request('status') === 'PENDING' ? 'selected' : '' }}>⏳ Pending</option>
                <option value="PAID" {{ request('status') === 'PAID' ? 'selected' : '' }}>✅ Paid</option>
                <option value="EXPIRED" {{ request('status') === 'EXPIRED' ? 'selected' : '' }}>❌ Expired</option>
            </select>
        </div>
        <div class="col-md-3">
            <button type="submit" class="btn btn-sm btn-accent"><i class="fas fa-filter me-1"></i>Filter</button>
            <a href="{{ route('finance.xendit-payments.index') }}" class="btn btn-sm btn-secondary"><i class="fas fa-sync me-1"></i>Reset</a>
        </div>
    </form>
</x-card>

{{-- Table --}}
<x-card title="Daftar Pembayaran Xendit">
    <x-data-table id="xendit-payments-table">
        <x-slot name="head">
            <th style="width:50px">No</th>
            <th>External ID</th>
            <th>Ref. Faktur</th>
            <th class="text-end">Jumlah</th>
            <th>Status</th>
            <th>Metode</th>
            <th>Tanggal</th>
            <th style="width:120px">Aksi</th>
        </x-slot>
        <x-slot name="body">
            @foreach($payments as $i => $p)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td><code>{{ $p->external_id }}</code></td>
                <td>
                    @if($p->salesInvoice)
                        <a href="{{ route('sales.invoices.show', $p->salesInvoice) }}">{{ $p->salesInvoice->code }}</a>
                    @else
                        -
                    @endif
                </td>
                <td class="text-end">Rp {{ number_format($p->amount, 0, ',', '.') }}</td>
                <td>
                    @if($p->status === 'PAID')
                        <span class="badge badge-paid">Paid</span>
                    @elseif($p->status === 'PENDING')
                        <span class="badge badge-draft">Pending</span>
                    @elseif($p->status === 'EXPIRED')
                        <span class="badge badge-canceled">Expired</span>
                    @else
                        <span class="badge badge-void">{{ $p->status }}</span>
                    @endif
                </td>
                <td>{{ $p->payment_channel ?? $p->payment_method ?? '-' }}</td>
                <td>{{ $p->created_at->format('d M Y H:i') }}</td>
                <td>
                    <a href="{{ route('finance.xendit-payments.show', $p) }}" class="btn btn-sm btn-outline-primary" title="Detail">
                        <i class="fas fa-eye"></i>
                    </a>
                </td>
            </tr>
            @endforeach
        </x-slot>
    </x-data-table>
</x-card>
@endsection
