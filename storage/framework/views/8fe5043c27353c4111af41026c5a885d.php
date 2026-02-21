
<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'name',
    'label' => '',
    'options' => [],
    'optionValue' => 'id',
    'optionLabel' => 'name',
    'selected' => null,
    'required' => false,
    'placeholder' => 'Pilih...',
    'searchable' => false,
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
    'options' => [],
    'optionValue' => 'id',
    'optionLabel' => 'name',
    'selected' => null,
    'required' => false,
    'placeholder' => 'Pilih...',
    'searchable' => false,
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
    $selectedVal = old($name, $selected ?? '');
?>

<div class="mb-3">
    <?php if($label): ?>
    <label for="<?php echo e($name); ?>" class="form-label">
        <?php echo e($label); ?>

        <?php if($required): ?> <span class="required">*</span> <?php endif; ?>
    </label>
    <?php endif; ?>

    <select
        class="<?php echo e($searchable ? 'select2' : 'form-select'); ?> <?php $__errorArgs = [$name];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
        id="<?php echo e($name); ?>"
        name="<?php echo e($name); ?>"
        data-placeholder="<?php echo e($placeholder); ?>"
        <?php echo e($required ? 'required' : ''); ?>

        <?php echo e($disabled ? 'disabled' : ''); ?>

        <?php echo e($attributes); ?>

    >
        <option value=""><?php echo e($placeholder); ?></option>
        <?php $__currentLoopData = $options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $val = is_array($option) ? ($option[$optionValue] ?? '') : ($option->$optionValue ?? $option);
                $lbl = is_array($option) ? ($option[$optionLabel] ?? '') : ($option->$optionLabel ?? $option);
            ?>
            <option value="<?php echo e($val); ?>" <?php echo e((string)$selectedVal === (string)$val ? 'selected' : ''); ?>>
                <?php echo e($lbl); ?>

            </option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>

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
<?php /**PATH C:\UNBRAW\SMT 6\Magang Mitra\Pertemuan\Back-End\Assignment\gentella_laravel\resources\views/components/select.blade.php ENDPATH**/ ?>