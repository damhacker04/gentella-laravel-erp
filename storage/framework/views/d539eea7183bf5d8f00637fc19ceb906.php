
<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'name',
    'label' => '',
    'value' => null,
    'required' => false,
    'placeholder' => 'Pilih tanggal...',
    'disabled' => false,
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
    'name',
    'label' => '',
    'value' => null,
    'required' => false,
    'placeholder' => 'Pilih tanggal...',
    'disabled' => false,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $val = old($name, $value ?? '');
?>

<div class="mb-3">
    <?php if($label): ?>
    <label for="<?php echo e($name); ?>" class="form-label">
        <?php echo e($label); ?>

        <?php if($required): ?> <span class="required">*</span> <?php endif; ?>
    </label>
    <?php endif; ?>

    <div class="input-group">
        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
        <input
            type="text"
            class="form-control datepicker <?php $__errorArgs = [$name];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
            id="<?php echo e($name); ?>"
            name="<?php echo e($name); ?>"
            value="<?php echo e($val); ?>"
            placeholder="<?php echo e($placeholder); ?>"
            <?php echo e($required ? 'required' : ''); ?>

            <?php echo e($disabled ? 'disabled' : ''); ?>

            autocomplete="off"
            <?php echo e($attributes); ?>

        >
        <?php $__errorArgs = [$name];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <div class="invalid-feedback"><?php echo e($message); ?></div>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
</div>
<?php /**PATH C:\UNBRAW\SMT 6\Magang Mitra\Pertemuan\Back-End\Assignment\gentella_laravel\resources\views/components/date.blade.php ENDPATH**/ ?>