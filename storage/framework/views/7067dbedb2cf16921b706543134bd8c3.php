

<?php $__env->startSection('title', 'Detail Sales Order'); ?>
<?php $__env->startSection('page-title', 'Detail Sales Order'); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="#">Penjualan</a></li>
    <li class="breadcrumb-item"><a href="<?php echo e(route('sales.orders.index')); ?>">Sales Order</a></li>
    <li class="breadcrumb-item active"><?php echo e($salesOrder->code); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    
    <div class="col-lg-8">
        <?php if (isset($component)) { $__componentOriginal53747ceb358d30c0105769f8471417f6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal53747ceb358d30c0105769f8471417f6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card','data' => ['title' => ''.e($salesOrder->code).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => ''.e($salesOrder->code).'']); ?>
             <?php $__env->slot('headerActions', null, []); ?> 
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
             <?php $__env->endSlot(); ?>

            <div class="row mb-4">
                <div class="col-md-6">
                    <table class="table table-borderless table-sm mb-0">
                        <tr>
                            <td class="text-muted" style="width:150px">No. SO</td>
                            <td><strong><?php echo e($salesOrder->code); ?></strong></td>
                        </tr>
                        <tr>
                            <td class="text-muted">Pelanggan</td>
                            <td>
                                <a href="<?php echo e(route('master.customers.show', $salesOrder->customer)); ?>">
                                    <?php echo e($salesOrder->customer->name); ?>

                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted">Tanggal</td>
                            <td><?php echo e($salesOrder->order_date?->format('d M Y')); ?></td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table table-borderless table-sm mb-0">
                        <tr>
                            <td class="text-muted" style="width:150px">Catatan</td>
                            <td><?php echo e($salesOrder->notes ?? '-'); ?></td>
                        </tr>
                        <tr>
                            <td class="text-muted">Dibuat</td>
                            <td><?php echo e($salesOrder->created_at?->format('d M Y, H:i')); ?></td>
                        </tr>
                    </table>
                </div>
            </div>

            
            <h6 class="mb-3"><i class="fas fa-list me-1"></i> Detail Barang</h6>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th style="width:40px">#</th>
                            <th>Produk</th>
                            <th class="text-center" style="width:80px">Qty</th>
                            <th class="text-end" style="width:150px">Harga Satuan</th>
                            <th class="text-end" style="width:150px">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $salesOrder->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idx => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($idx + 1); ?></td>
                            <td>
                                <strong><?php echo e($item->product->sku ?? '-'); ?></strong><br>
                                <small class="text-muted"><?php echo e($item->product->name ?? '-'); ?></small>
                            </td>
                            <td class="text-center"><?php echo e($item->qty); ?></td>
                            <td class="text-end">Rp <?php echo e(number_format($item->price, 0, ',', '.')); ?></td>
                            <td class="text-end">Rp <?php echo e(number_format($item->subtotal, 0, ',', '.')); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>

            <div class="total-section">
                <span class="total-label">Grand Total:</span>
                <span class="total-value">Rp <?php echo e(number_format($salesOrder->total, 0, ',', '.')); ?></span>
            </div>
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
    </div>

    
    <div class="col-lg-4">
        
        <?php if (isset($component)) { $__componentOriginal53747ceb358d30c0105769f8471417f6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal53747ceb358d30c0105769f8471417f6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card','data' => ['title' => 'Aksi']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Aksi']); ?>
            <div class="d-grid gap-2">
                <?php if($salesOrder->status === 'DRAFT'): ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('sales.orders.create')): ?>
                    <a href="<?php echo e(route('sales.orders.edit', $salesOrder)); ?>" class="btn btn-warning">
                        <i class="fas fa-edit me-1"></i> Edit
                    </a>
                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('sales.orders.approve')): ?>
                    <form action="<?php echo e(route('sales.orders.confirm', $salesOrder)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <button type="button" class="btn btn-primary w-100 btn-status-change"
                                data-action="mengkonfirmasi order ini">
                            <i class="fas fa-check me-1"></i> Konfirmasi Order
                        </button>
                    </form>
                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('sales.orders.cancel')): ?>
                    <form action="<?php echo e(route('sales.orders.cancel', $salesOrder)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <button type="button" class="btn btn-danger w-100 btn-status-change"
                                data-action="membatalkan order ini">
                            <i class="fas fa-times me-1"></i> Batalkan
                        </button>
                    </form>
                    <?php endif; ?>
                <?php endif; ?>

                <?php if($salesOrder->status === 'CONFIRMED'): ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('sales.orders.create')): ?>
                    <form action="<?php echo e(route('sales.orders.mark-as-paid', $salesOrder)); ?>" method="POST">
                        <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                        <button type="button" class="btn btn-success w-100 btn-status-change"
                                data-action="menandai order ini sebagai Paid">
                            <i class="fas fa-check-double me-1"></i> Mark as Paid
                        </button>
                    </form>
                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('sales.delivery_orders.create')): ?>
                    <a href="<?php echo e(route('sales.delivery-orders.create', ['sales_order_id' => $salesOrder->id])); ?>"
                       class="btn btn-info">
                        <i class="fas fa-truck me-1"></i> Buat Surat Jalan
                    </a>
                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('sales.invoices.create')): ?>
                    <a href="<?php echo e(route('sales.invoices.create', ['sales_order_id' => $salesOrder->id])); ?>"
                       class="btn btn-primary">
                        <i class="fas fa-file-invoice me-1"></i> Buat Faktur
                    </a>
                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('sales.orders.cancel')): ?>
                    <form action="<?php echo e(route('sales.orders.cancel', $salesOrder)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <button type="button" class="btn btn-danger w-100 btn-status-change"
                                data-action="membatalkan order ini">
                            <i class="fas fa-times me-1"></i> Batalkan
                        </button>
                    </form>
                    <?php endif; ?>
                <?php endif; ?>

                <a href="<?php echo e(route('sales.orders.index')); ?>" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </a>
            </div>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card','data' => ['title' => 'Dokumen Terkait']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Dokumen Terkait']); ?>
            <ul class="related-docs">
                <?php $__empty_1 = true; $__currentLoopData = $salesOrder->deliveryOrders ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $do): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <li>
                    <i class="fas fa-truck text-info"></i>
                    <a href="<?php echo e(route('sales.delivery-orders.show', $do)); ?>"><?php echo e($do->code); ?></a>
                    <?php if (isset($component)) { $__componentOriginal8c81617a70e11bcf247c4db924ab1b62 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8c81617a70e11bcf247c4db924ab1b62 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.status-badge','data' => ['status' => $do->status]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('status-badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['status' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($do->status)]); ?>
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
                </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <li class="text-muted"><i class="fas fa-inbox me-2"></i> Belum ada Surat Jalan</li>
                <?php endif; ?>

                <?php $__empty_1 = true; $__currentLoopData = $salesOrder->invoices ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <li>
                    <i class="fas fa-file-invoice text-warning"></i>
                    <a href="<?php echo e(route('sales.invoices.show', $inv)); ?>"><?php echo e($inv->code); ?></a>
                    <?php if (isset($component)) { $__componentOriginal8c81617a70e11bcf247c4db924ab1b62 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8c81617a70e11bcf247c4db924ab1b62 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.status-badge','data' => ['status' => $inv->status]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('status-badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['status' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($inv->status)]); ?>
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
                </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <li class="text-muted"><i class="fas fa-inbox me-2"></i> Belum ada Faktur</li>
                <?php endif; ?>
            </ul>
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
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\UNBRAW\SMT 6\Magang Mitra\Pertemuan\Back-End\Assignment\gentella_laravel\resources\views/sales/orders/show.blade.php ENDPATH**/ ?>