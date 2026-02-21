{{-- Status Badge Component --}}
@props([
    'status',
])

@php
    $map = [
        'DRAFT'     => 'badge-draft',
        'CONFIRMED' => 'badge-confirmed',
        'POSTED'    => 'badge-posted',
        'PAID'      => 'badge-paid',
        'DELIVERED' => 'badge-delivered',
        'RECEIVED'  => 'badge-received',
        'CANCELED'  => 'badge-canceled',
        'VOID'      => 'badge-void',
        'CLOSED'    => 'badge-closed',
        'ACTIVE'    => 'badge-active',
        'INACTIVE'  => 'badge-inactive',
    ];

    $labelMap = [
        'DRAFT'     => 'Draft',
        'CONFIRMED' => 'Dikonfirmasi',
        'POSTED'    => 'Diposting',
        'PAID'      => 'Lunas',
        'DELIVERED' => 'Terkirim',
        'RECEIVED'  => 'Diterima',
        'CANCELED'  => 'Dibatalkan',
        'VOID'      => 'Void',
        'CLOSED'    => 'Selesai',
        'ACTIVE'    => 'Aktif',
        'INACTIVE'  => 'Nonaktif',
    ];

    $class = $map[strtoupper($status)] ?? 'badge-draft';
    $label = $labelMap[strtoupper($status)] ?? $status;
@endphp

<span class="badge {{ $class }}">{{ $label }}</span>
