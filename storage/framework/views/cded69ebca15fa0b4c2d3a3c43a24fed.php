
<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'status',
]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter(([
    'status',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $map = [
        'DRAFT'     => 'badge-draft',
        'CONFIRMED' => 'badge-confirmed',
        'POSTED'    => 'badge-posted',
        'PAID'      => 'badge-paid',
        'DELIVERED' => 'badge-delivered',
        'RECEIVED'  => 'badge-received',
        'CANCELED'  => 'badge-canceled',
        'CANCELLED' => 'badge-canceled',
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
        'CANCELLED' => 'Dibatalkan',
        'VOID'      => 'Void',
        'CLOSED'    => 'Selesai',
        'ACTIVE'    => 'Aktif',
        'INACTIVE'  => 'Nonaktif',
    ];

    $class = $map[strtoupper($status)] ?? 'badge-draft';
    $label = $labelMap[strtoupper($status)] ?? $status;
?>

<span class="badge <?php echo e($class); ?>"><?php echo e($label); ?></span>
<?php /**PATH C:\UNBRAW\SMT 6\Magang Mitra\Pertemuan\Back-End\Assignment\gentella_laravel\resources\views/components/status-badge.blade.php ENDPATH**/ ?>