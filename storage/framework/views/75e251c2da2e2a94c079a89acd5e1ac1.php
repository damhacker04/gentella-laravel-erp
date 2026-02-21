

<?php $__env->startSection('title', 'Sales Order'); ?>
<?php $__env->startSection('page-title', 'Sales Order'); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item active">Penjualan</li>
    <li class="breadcrumb-item active">Sales Order</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-actions'); ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('sales.orders.create')): ?>
    <a href="<?php echo e(route('sales.orders.create')); ?>" class="btn btn-accent">
        <i class="fas fa-plus me-1"></i> Buat Sales Order
    </a>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php if (isset($component)) { $__componentOriginal53747ceb358d30c0105769f8471417f6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal53747ceb358d30c0105769f8471417f6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <form method="GET" action="<?php echo e(route('sales.orders.index')); ?>" class="row g-3 align-items-end">
        <div class="col-md-3">
            <label for="status" class="form-label mb-1"><small>Filter Status</small></label>
            <select name="status" id="status" class="form-select form-select-sm">
                <option value="">— Semua Status —</option>
                <option value="DRAFT" <?php echo e(request('status') === 'DRAFT' ? 'selected' : ''); ?>>Draft</option>
                <option value="CONFIRMED" <?php echo e(request('status') === 'CONFIRMED' ? 'selected' : ''); ?>>Confirmed</option>
                <option value="PAID" <?php echo e(request('status') === 'PAID' ? 'selected' : ''); ?>>Paid</option>
                <option value="CANCELLED" <?php echo e(request('status') === 'CANCELLED' ? 'selected' : ''); ?>>Cancelled</option>
            </select>
        </div>
        <div class="col-md-3">
            <label for="date_from" class="form-label mb-1"><small>Dari Tanggal</small></label>
            <input type="date" name="date_from" id="date_from" class="form-control form-control-sm"
                   value="<?php echo e(request('date_from')); ?>">
        </div>
        <div class="col-md-3">
            <label for="date_to" class="form-label mb-1"><small>Sampai Tanggal</small></label>
            <input type="date" name="date_to" id="date_to" class="form-control form-control-sm"
                   value="<?php echo e(request('date_to')); ?>">
        </div>
        <div class="col-md-3">
            <button type="submit" class="btn btn-sm btn-accent me-1"><i class="fas fa-filter me-1"></i>Filter</button>
            <a href="<?php echo e(route('sales.orders.index')); ?>" class="btn btn-sm btn-secondary"><i class="fas fa-sync me-1"></i>Reset</a>
        </div>
    </form>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal53747ceb358d30c0105769f8471417f6)): ?>
<?php $attributes = $__attributesOriginal53747ceb358d30c0105769f8471417f6; ?>
<?php unset($__attributesOriginal53747ceb358d30c0105769f8471417f6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal53747ceb358d30c0105769f8471417f6)): ?>
<?php $component = $__componentOriginal53747ceb358d30c0105769f8471417f6; ?>
<?php unset($__componentOriginal53747ceb358d30c0105769f8471417f6); ?>
<?php endif; ?>


<?php if (isset($component)) { $__componentOriginal53747ceb358d30c0105769f8471417f6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal53747ceb358d30c0105769f8471417f6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card','data' => ['title' => 'Daftar Sales Order']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Daftar Sales Order']); ?>
    <?php if (isset($component)) { $__componentOriginalc8463834ba515134d5c98b88e1a9dc03 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc8463834ba515134d5c98b88e1a9dc03 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.data-table','data' => ['id' => 'sales-orders-table']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('data-table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'sales-orders-table']); ?>
         <?php $__env->slot('head', null, []); ?> 
            <th style="width:50px">No</th>
            <th>No. SO</th>
            <th>Tanggal</th>
            <th>Pelanggan</th>
            <th class="text-end">Total</th>
            <th>Status</th>
            <th style="width:160px">Aksi</th>
         <?php $__env->endSlot(); ?>
         <?php $__env->slot('body', null, []); ?> 
            <?php $__currentLoopData = $salesOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $so): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($i + 1); ?></td>
                <td><a href="<?php echo e(route('sales.orders.show', $so)); ?>"><strong><?php echo e($so->code); ?></strong></a></td>
                <td><?php echo e($so->order_date?->format('d M Y')); ?></td>
                <td><?php echo e($so->customer->name ?? '-'); ?></td>
                <td class="text-end">Rp <?php echo e(number_format($so->total, 0, ',', '.')); ?></td>
                <td><?php if (isset($component)) { $__componentOriginal8c81617a70e11bcf247c4db924ab1b62 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8c81617a70e11bcf247c4db924ab1b62 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.status-badge','data' => ['status' => $so->status]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('status-badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['status' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($so->status)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8c81617a70e11bcf247c4db924ab1b62)): ?>
<?php $attributes = $__attributesOriginal8c81617a70e11bcf247c4db924ab1b62; ?>
<?php unset($__attributesOriginal8c81617a70e11bcf247c4db924ab1b62); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8c81617a70e11bcf247c4db924ab1b62)): ?>
<?php $component = $__componentOriginal8c81617a70e11bcf247c4db924ab1b62; ?>
<?php unset($__componentOriginal8c81617a70e11bcf247c4db924ab1b62); ?>
<?php endif; ?></td>
                <td>
                    <div class="d-flex gap-1">
                        <?php if (isset($component)) { $__componentOriginalda20620c6f4507c35f52e68a01431dff = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalda20620c6f4507c35f52e68a01431dff = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.btn-action','data' => ['showRoute' => route('sales.orders.show', $so),'editRoute' => $so->status === 'DRAFT' ? route('sales.orders.edit', $so) : null,'deleteRoute' => $so->status === 'DRAFT' ? route('sales.orders.destroy', $so) : null,'showPermission' => 'sales.orders.view','editPermission' => 'sales.orders.create','deletePermission' => 'sales.orders.create']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('btn-action'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['show-route' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('sales.orders.show', $so)),'edit-route' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($so->status === 'DRAFT' ? route('sales.orders.edit', $so) : null),'delete-route' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($so->status === 'DRAFT' ? route('sales.orders.destroy', $so) : null),'show-permission' => 'sales.orders.view','edit-permission' => 'sales.orders.create','delete-permission' => 'sales.orders.create']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalda20620c6f4507c35f52e68a01431dff)): ?>
<?php $attributes = $__attributesOriginalda20620c6f4507c35f52e68a01431dff; ?>
<?php unset($__attributesOriginalda20620c6f4507c35f52e68a01431dff); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalda20620c6f4507c35f52e68a01431dff)): ?>
<?php $component = $__componentOriginalda20620c6f4507c35f52e68a01431dff; ?>
<?php unset($__componentOriginalda20620c6f4507c35f52e68a01431dff); ?>
<?php endif; ?>
                        <?php if($so->status === 'CONFIRMED'): ?>
                            <form action="<?php echo e(route('sales.orders.mark-as-paid', $so)); ?>" method="POST" class="d-inline">
                                <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                                <button class="btn btn-sm btn-success" title="Mark as Paid"
                                        onclick="return confirm('Tandai SO ini sebagai Paid?')">
                                    <i class="fas fa-check-double"></i>
                                </button>
                            </form>
                        <?php endif; ?>
                    </div>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
         <?php $__env->endSlot(); ?>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc8463834ba515134d5c98b88e1a9dc03)): ?>
<?php $attributes = $__attributesOriginalc8463834ba515134d5c98b88e1a9dc03; ?>
<?php unset($__attributesOriginalc8463834ba515134d5c98b88e1a9dc03); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc8463834ba515134d5c98b88e1a9dc03)): ?>
<?php $component = $__componentOriginalc8463834ba515134d5c98b88e1a9dc03; ?>
<?php unset($__componentOriginalc8463834ba515134d5c98b88e1a9dc03); ?>
<?php endif; ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal53747ceb358d30c0105769f8471417f6)): ?>
<?php $attributes = $__attributesOriginal53747ceb358d30c0105769f8471417f6; ?>
<?php unset($__attributesOriginal53747ceb358d30c0105769f8471417f6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal53747ceb358d30c0105769f8471417f6)): ?>
<?php $component = $__componentOriginal53747ceb358d30c0105769f8471417f6; ?>
<?php unset($__componentOriginal53747ceb358d30c0105769f8471417f6); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\UNBRAW\SMT 6\Magang Mitra\Pertemuan\Back-End\Assignment\gentella_laravel\resources\views/sales/orders/index.blade.php ENDPATH**/ ?>