

<?php $__env->startSection('title', 'Pembayaran Xendit'); ?>
<?php $__env->startSection('page-title', 'Pembayaran Xendit'); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item active">Keuangan</li>
    <li class="breadcrumb-item active">Pembayaran Xendit</li>
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
    <form method="GET" action="<?php echo e(route('finance.xendit-payments.index')); ?>" class="row g-3 align-items-end">
        <div class="col-md-3">
            <label class="form-label mb-1"><small>Filter Status</small></label>
            <select name="status" class="form-select form-select-sm">
                <option value="">— Semua Status —</option>
                <option value="PENDING" <?php echo e(request('status') === 'PENDING' ? 'selected' : ''); ?>>⏳ Pending</option>
                <option value="PAID" <?php echo e(request('status') === 'PAID' ? 'selected' : ''); ?>>✅ Paid</option>
                <option value="EXPIRED" <?php echo e(request('status') === 'EXPIRED' ? 'selected' : ''); ?>>❌ Expired</option>
            </select>
        </div>
        <div class="col-md-3">
            <button type="submit" class="btn btn-sm btn-accent"><i class="fas fa-filter me-1"></i>Filter</button>
            <a href="<?php echo e(route('finance.xendit-payments.index')); ?>" class="btn btn-sm btn-secondary"><i class="fas fa-sync me-1"></i>Reset</a>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card','data' => ['title' => 'Daftar Pembayaran Xendit']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Daftar Pembayaran Xendit']); ?>
    <?php if (isset($component)) { $__componentOriginalc8463834ba515134d5c98b88e1a9dc03 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc8463834ba515134d5c98b88e1a9dc03 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.data-table','data' => ['id' => 'xendit-payments-table']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('data-table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'xendit-payments-table']); ?>
         <?php $__env->slot('head', null, []); ?> 
            <th style="width:50px">No</th>
            <th>External ID</th>
            <th>Ref. Faktur</th>
            <th class="text-end">Jumlah</th>
            <th>Status</th>
            <th>Metode</th>
            <th>Tanggal</th>
            <th style="width:120px">Aksi</th>
         <?php $__env->endSlot(); ?>
         <?php $__env->slot('body', null, []); ?> 
            <?php $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($i + 1); ?></td>
                <td><code><?php echo e($p->external_id); ?></code></td>
                <td>
                    <?php if($p->salesInvoice): ?>
                        <a href="<?php echo e(route('sales.invoices.show', $p->salesInvoice)); ?>"><?php echo e($p->salesInvoice->code); ?></a>
                    <?php else: ?>
                        -
                    <?php endif; ?>
                </td>
                <td class="text-end">Rp <?php echo e(number_format($p->amount, 0, ',', '.')); ?></td>
                <td>
                    <?php if($p->status === 'PAID'): ?>
                        <span class="badge badge-paid">Paid</span>
                    <?php elseif($p->status === 'PENDING'): ?>
                        <span class="badge badge-draft">Pending</span>
                    <?php elseif($p->status === 'EXPIRED'): ?>
                        <span class="badge badge-canceled">Expired</span>
                    <?php else: ?>
                        <span class="badge badge-void"><?php echo e($p->status); ?></span>
                    <?php endif; ?>
                </td>
                <td><?php echo e($p->payment_channel ?? $p->payment_method ?? '-'); ?></td>
                <td><?php echo e($p->created_at->format('d M Y H:i')); ?></td>
                <td>
                    <a href="<?php echo e(route('finance.xendit-payments.show', $p)); ?>" class="btn btn-sm btn-outline-primary" title="Detail">
                        <i class="fas fa-eye"></i>
                    </a>
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

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\UNBRAW\SMT 6\Magang Mitra\Pertemuan\Back-End\Assignment\gentella_laravel\resources\views/finance/xendit-payments/index.blade.php ENDPATH**/ ?>