

<?php $__env->startSection('title', 'Detail Pembayaran Xendit'); ?>
<?php $__env->startSection('page-title', 'Detail Pembayaran Xendit'); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('finance.xendit-payments.index')); ?>">Pembayaran Xendit</a></li>
    <li class="breadcrumb-item active"><?php echo e($xenditPayment->external_id); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    
    <div class="col-lg-8">
        <?php if (isset($component)) { $__componentOriginal53747ceb358d30c0105769f8471417f6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal53747ceb358d30c0105769f8471417f6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card','data' => ['title' => 'Informasi Pembayaran']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Informasi Pembayaran']); ?>
             <?php $__env->slot('headerActions', null, []); ?> 
                <?php if($xenditPayment->status === 'PAID'): ?>
                    <span class="badge badge-paid fs-6">✅ PAID</span>
                <?php elseif($xenditPayment->status === 'PENDING'): ?>
                    <span class="badge badge-draft fs-6">⏳ PENDING</span>
                <?php elseif($xenditPayment->status === 'EXPIRED'): ?>
                    <span class="badge badge-canceled fs-6">❌ EXPIRED</span>
                <?php else: ?>
                    <span class="badge badge-void fs-6"><?php echo e($xenditPayment->status); ?></span>
                <?php endif; ?>
             <?php $__env->endSlot(); ?>

            <div class="row mb-4">
                <div class="col-md-6">
                    <table class="table table-borderless table-sm mb-0">
                        <tr>
                            <td class="text-muted" style="width:160px">External ID</td>
                            <td><code><?php echo e($xenditPayment->external_id); ?></code></td>
                        </tr>
                        <tr>
                            <td class="text-muted">Xendit Invoice ID</td>
                            <td><code><?php echo e($xenditPayment->xendit_invoice_id); ?></code></td>
                        </tr>
                        <tr>
                            <td class="text-muted">Ref. Faktur</td>
                            <td>
                                <a href="<?php echo e(route('sales.invoices.show', $xenditPayment->salesInvoice)); ?>">
                                    <?php echo e($xenditPayment->salesInvoice->code); ?>

                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted">Pelanggan</td>
                            <td><?php echo e($xenditPayment->salesInvoice->salesOrder->customer->name ?? '-'); ?></td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table table-borderless table-sm mb-0">
                        <tr>
                            <td class="text-muted" style="width:160px">Jumlah</td>
                            <td><strong class="text-primary fs-5">Rp <?php echo e(number_format($xenditPayment->amount, 0, ',', '.')); ?></strong></td>
                        </tr>
                        <tr>
                            <td class="text-muted">Metode Bayar</td>
                            <td><?php echo e($xenditPayment->payment_method ?? '-'); ?></td>
                        </tr>
                        <tr>
                            <td class="text-muted">Channel</td>
                            <td><?php echo e($xenditPayment->payment_channel ?? '-'); ?></td>
                        </tr>
                        <tr>
                            <td class="text-muted">Dibayar Pada</td>
                            <td><?php echo e($xenditPayment->paid_at?->format('d M Y, H:i') ?? '-'); ?></td>
                        </tr>
                        <tr>
                            <td class="text-muted">Dibuat Oleh</td>
                            <td><?php echo e($xenditPayment->createdBy->name ?? '-'); ?></td>
                        </tr>
                    </table>
                </div>
            </div>

            
            <?php if($xenditPayment->invoice_url && $xenditPayment->status === 'PENDING'): ?>
            <div class="alert alert-info mb-3">
                <i class="fas fa-link me-2"></i>
                <strong>Link Pembayaran:</strong>
                <a href="<?php echo e($xenditPayment->invoice_url); ?>" target="_blank" class="ms-2">
                    <?php echo e($xenditPayment->invoice_url); ?>

                    <i class="fas fa-external-link-alt ms-1"></i>
                </a>
            </div>
            <?php endif; ?>

            
            <details class="mt-3">
                <summary style="cursor: pointer; user-select: none;" class="mb-2">
                    <i class="fas fa-code me-1"></i><strong>Response Data (JSON)</strong>
                    <small class="text-muted ms-1">— klik untuk lihat</small>
                </summary>
                <div class="bg-dark text-light p-3 rounded" style="max-height: 300px; overflow-y: auto;">
                    <pre class="mb-0" style="font-size: 12px; white-space: pre-wrap;"><?php echo e(json_encode($xenditPayment->xendit_response, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)); ?></pre>
                </div>
            </details>
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
                <?php if($xenditPayment->invoice_url && $xenditPayment->status === 'PENDING'): ?>
                    <a href="<?php echo e($xenditPayment->invoice_url); ?>" target="_blank" class="btn btn-accent">
                        <i class="fas fa-credit-card me-1"></i> Bayar Sekarang
                    </a>
                    <form action="<?php echo e(route('finance.xendit-payments.refresh', $xenditPayment)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <button class="btn btn-info w-100">
                            <i class="fas fa-sync me-1"></i> Refresh Status
                        </button>
                    </form>
                <?php endif; ?>

                <a href="<?php echo e(route('finance.xendit-payments.index')); ?>" class="btn btn-secondary">
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
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\UNBRAW\SMT 6\Magang Mitra\Pertemuan\Back-End\Assignment\gentella_laravel\resources\views/finance/xendit-payments/show.blade.php ENDPATH**/ ?>