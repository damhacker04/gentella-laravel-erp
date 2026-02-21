
<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'showRoute' => null,
    'editRoute' => null,
    'deleteRoute' => null,
    'showPermission' => null,
    'editPermission' => null,
    'deletePermission' => null,
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
    'showRoute' => null,
    'editRoute' => null,
    'deleteRoute' => null,
    'showPermission' => null,
    'editPermission' => null,
    'deletePermission' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div class="btn-action-group">
    <?php if($showRoute): ?>
        <?php if(!$showPermission || auth()->user()->can($showPermission)): ?>
        <a href="<?php echo e($showRoute); ?>" class="btn btn-sm btn-info" title="Detail">
            <i class="fas fa-eye"></i>
        </a>
        <?php endif; ?>
    <?php endif; ?>

    <?php if($editRoute): ?>
        <?php if(!$editPermission || auth()->user()->can($editPermission)): ?>
        <a href="<?php echo e($editRoute); ?>" class="btn btn-sm btn-warning" title="Ubah">
            <i class="fas fa-edit"></i>
        </a>
        <?php endif; ?>
    <?php endif; ?>

    <?php if($deleteRoute): ?>
        <?php if(!$deletePermission || auth()->user()->can($deletePermission)): ?>
        <form action="<?php echo e($deleteRoute); ?>" method="POST" class="d-inline">
            <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>
            <button type="button" class="btn btn-sm btn-danger btn-delete" title="Hapus">
                <i class="fas fa-trash"></i>
            </button>
        </form>
        <?php endif; ?>
    <?php endif; ?>
</div>
<?php /**PATH C:\UNBRAW\SMT 6\Magang Mitra\Pertemuan\Back-End\Assignment\gentella_laravel\resources\views/components/btn-action.blade.php ENDPATH**/ ?>