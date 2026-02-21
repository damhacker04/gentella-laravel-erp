
<?php
    $isEdit = isset($salesOrder) && $salesOrder->exists;
    $items = old('items', $isEdit ? $salesOrder->items->toArray() : [['product_id' => '', 'qty' => 1, 'price' => 0, 'subtotal' => 0]]);
?>

<div class="row">
    <div class="col-md-4">
        <?php if (isset($component)) { $__componentOriginaled2cde6083938c436304f332ba96bb7c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaled2cde6083938c436304f332ba96bb7c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select','data' => ['name' => 'customer_id','label' => 'Pelanggan','options' => $customers,'optionValue' => 'id','optionLabel' => 'name','selected' => $salesOrder->customer_id ?? '','required' => true,'searchable' => true,'placeholder' => 'Pilih Pelanggan...']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'customer_id','label' => 'Pelanggan','options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($customers),'option-value' => 'id','option-label' => 'name','selected' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($salesOrder->customer_id ?? ''),'required' => true,'searchable' => true,'placeholder' => 'Pilih Pelanggan...']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaled2cde6083938c436304f332ba96bb7c)): ?>
<?php $attributes = $__attributesOriginaled2cde6083938c436304f332ba96bb7c; ?>
<?php unset($__attributesOriginaled2cde6083938c436304f332ba96bb7c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaled2cde6083938c436304f332ba96bb7c)): ?>
<?php $component = $__componentOriginaled2cde6083938c436304f332ba96bb7c; ?>
<?php unset($__componentOriginaled2cde6083938c436304f332ba96bb7c); ?>
<?php endif; ?>
    </div>
    <div class="col-md-3">
        <?php if (isset($component)) { $__componentOriginal0da8235d2d96274f8680ccda5445231c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0da8235d2d96274f8680ccda5445231c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.date','data' => ['name' => 'order_date','label' => 'Tanggal Order','value' => $salesOrder->order_date ?? date('Y-m-d'),'required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('date'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'order_date','label' => 'Tanggal Order','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($salesOrder->order_date ?? date('Y-m-d')),'required' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal0da8235d2d96274f8680ccda5445231c)): ?>
<?php $attributes = $__attributesOriginal0da8235d2d96274f8680ccda5445231c; ?>
<?php unset($__attributesOriginal0da8235d2d96274f8680ccda5445231c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0da8235d2d96274f8680ccda5445231c)): ?>
<?php $component = $__componentOriginal0da8235d2d96274f8680ccda5445231c; ?>
<?php unset($__componentOriginal0da8235d2d96274f8680ccda5445231c); ?>
<?php endif; ?>
    </div>
    <div class="col-md-3">
        <?php if($isEdit): ?>
        <div class="mb-3">
            <label class="form-label">Status</label><br>
            <?php if (isset($component)) { $__componentOriginal8c81617a70e11bcf247c4db924ab1b62 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8c81617a70e11bcf247c4db924ab1b62 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.status-badge','data' => ['status' => $salesOrder->status]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('status-badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['status' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($salesOrder->status)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8c81617a70e11bcf247c4db924ab1b62)): ?>
<?php $attributes = $__attributesOriginal8c81617a70e11bcf247c4db924ab1b62; ?>
<?php unset($__attributesOriginal8c81617a70e11bcf247c4db924ab1b62); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8c81617a70e11bcf247c4db924ab1b62)): ?>
<?php $component = $__componentOriginal8c81617a70e11bcf247c4db924ab1b62; ?>
<?php unset($__componentOriginal8c81617a70e11bcf247c4db924ab1b62); ?>
<?php endif; ?>
        </div>
        <?php endif; ?>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <?php if (isset($component)) { $__componentOriginal4727f9fd7c3055c2cf9c658d89b16886 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4727f9fd7c3055c2cf9c658d89b16886 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.textarea','data' => ['name' => 'notes','label' => 'Catatan','value' => $salesOrder->notes ?? '','placeholder' => 'Catatan tambahan (opsional)','rows' => '2']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('textarea'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'notes','label' => 'Catatan','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($salesOrder->notes ?? ''),'placeholder' => 'Catatan tambahan (opsional)','rows' => '2']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4727f9fd7c3055c2cf9c658d89b16886)): ?>
<?php $attributes = $__attributesOriginal4727f9fd7c3055c2cf9c658d89b16886; ?>
<?php unset($__attributesOriginal4727f9fd7c3055c2cf9c658d89b16886); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4727f9fd7c3055c2cf9c658d89b16886)): ?>
<?php $component = $__componentOriginal4727f9fd7c3055c2cf9c658d89b16886; ?>
<?php unset($__componentOriginal4727f9fd7c3055c2cf9c658d89b16886); ?>
<?php endif; ?>
    </div>
</div>

<hr>


<div class="d-flex justify-content-between align-items-center mb-3">
    <h6 class="mb-0"><i class="fas fa-list me-1"></i> Detail Barang</h6>
    <button type="button" class="btn btn-sm btn-accent" onclick="DynamicItems.addRow()">
        <i class="fas fa-plus me-1"></i> Tambah Baris
    </button>
</div>

<div class="table-responsive">
    <table id="items-table" class="table items-table">
        <thead>
            <tr>
                <th style="width:40px">#</th>
                <th style="min-width:250px">Produk</th>
                <th style="width:100px">Qty</th>
                <th style="width:160px">Harga Satuan</th>
                <th style="width:160px" class="text-end">Subtotal</th>
                <th style="width:50px"></th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idx => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr class="item-row">
                <td><?php echo e($idx + 1); ?></td>
                <td>
                    <select name="items[<?php echo e($idx); ?>][product_id]" class="form-select select2" required>
                        <option value="">Pilih Produk...</option>
                        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($product->id); ?>"
                            data-price="<?php echo e($product->price); ?>"
                            <?php echo e(($item['product_id'] ?? '') == $product->id ? 'selected' : ''); ?>>
                            <?php echo e($product->sku); ?> — <?php echo e($product->name); ?>

                        </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </td>
                <td>
                    <input type="number" name="items[<?php echo e($idx); ?>][qty]" class="form-control item-qty"
                           value="<?php echo e($item['qty'] ?? 1); ?>" min="1" required
                           onchange="DynamicItems.recalculate()" onkeyup="DynamicItems.recalculate()">
                </td>
                <td>
                    <input type="number" name="items[<?php echo e($idx); ?>][price]" class="form-control item-price"
                           value="<?php echo e($item['price'] ?? 0); ?>" min="0" required
                           onchange="DynamicItems.recalculate()" onkeyup="DynamicItems.recalculate()">
                </td>
                <td class="text-end">
                    <span class="item-subtotal"><?php echo e(number_format(($item['qty'] ?? 1) * ($item['price'] ?? 0), 0, ',', '.')); ?></span>
                    <input type="hidden" name="items[<?php echo e($idx); ?>][subtotal]" class="item-subtotal-input"
                           value="<?php echo e(($item['qty'] ?? 1) * ($item['price'] ?? 0)); ?>">
                </td>
                <td>
                    <button type="button" class="btn-remove-item" onclick="DynamicItems.removeRow(this)">
                        <i class="fas fa-times"></i>
                    </button>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>

<div class="total-section">
    <span class="total-label">Grand Total:</span>
    <span class="total-value">Rp <span id="grand-total"><?php echo e(number_format(collect($items)->sum(fn($i) => ($i['qty'] ?? 0) * ($i['price'] ?? 0)), 0, ',', '.')); ?></span></span>
    <input type="hidden" name="total" id="grand-total-input"
           value="<?php echo e(collect($items)->sum(fn($i) => ($i['qty'] ?? 0) * ($i['price'] ?? 0))); ?>">
</div>


<template id="item-row-template">
    <tr class="item-row">
        <td>-</td>
        <td>
            <select name="items[__INDEX__][product_id]" class="form-select select2" required>
                <option value="">Pilih Produk...</option>
                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($product->id); ?>" data-price="<?php echo e($product->price); ?>">
                    <?php echo e($product->sku); ?> — <?php echo e($product->name); ?>

                </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </td>
        <td>
            <input type="number" name="items[__INDEX__][qty]" class="form-control item-qty"
                   value="1" min="1" required onchange="DynamicItems.recalculate()" onkeyup="DynamicItems.recalculate()">
        </td>
        <td>
            <input type="number" name="items[__INDEX__][price]" class="form-control item-price"
                   value="0" min="0" required onchange="DynamicItems.recalculate()" onkeyup="DynamicItems.recalculate()">
        </td>
        <td class="text-end">
            <span class="item-subtotal">0</span>
            <input type="hidden" name="items[__INDEX__][subtotal]" class="item-subtotal-input" value="0">
        </td>
        <td>
            <button type="button" class="btn-remove-item" onclick="DynamicItems.removeRow(this)">
                <i class="fas fa-times"></i>
            </button>
        </td>
    </tr>
</template>

<?php $__env->startPush('scripts'); ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        DynamicItems.init('items-table', 'item-row-template');

        // Auto-fill price when product is selected
        $(document).on('change', '.item-row select[name*="product_id"]', function() {
            const price = $(this).find(':selected').data('price') || 0;
            const row = $(this).closest('.item-row');
            row.find('.item-price').val(price);
            DynamicItems.recalculate();
        });
    });
</script>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\UNBRAW\SMT 6\Magang Mitra\Pertemuan\Back-End\Assignment\gentella_laravel\resources\views/sales/orders/_form.blade.php ENDPATH**/ ?>