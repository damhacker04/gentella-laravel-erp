
<?php $__env->startSection('title', $invoice->code); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="mb-1"><i class="fas fa-file-invoice me-2"></i><?php echo e($invoice->code); ?></h4>
        <nav aria-label="breadcrumb"><ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="<?php echo e(route('sales.invoices.index')); ?>">Faktur Penjualan</a></li>
            <li class="breadcrumb-item active"><?php echo e($invoice->code); ?></li>
        </ol></nav>
    </div>
    <div>
        <?php if($invoice->status === 'DRAFT'): ?>
            <a href="<?php echo e(route('sales.invoices.edit', $invoice)); ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit me-1"></i>Edit</a>
            <form action="<?php echo e(route('sales.invoices.post', $invoice)); ?>" method="POST" class="d-inline">
                <?php echo csrf_field(); ?>
                <button class="btn btn-success btn-sm" onclick="return confirm('Posting faktur ini?')"><i class="fas fa-check me-1"></i>Posting</button>
            </form>
        <?php elseif($invoice->status === 'POSTED'): ?>
            <a href="<?php echo e(route('finance.sales-payments.create', ['sales_invoice_id' => $invoice->id])); ?>" class="btn btn-info btn-sm">
                <i class="fas fa-money-bill me-1"></i>Catat Pembayaran
            </a>
            <form action="<?php echo e(route('finance.xendit-payments.create', $invoice)); ?>" method="POST" class="d-inline">
                <?php echo csrf_field(); ?>
                <button class="btn btn-accent btn-sm" onclick="return confirm('Buat invoice pembayaran Xendit?')">
                    <i class="fas fa-credit-card me-1"></i>Bayar via Xendit
                </button>
            </form>
            <form action="<?php echo e(route('sales.invoices.void', $invoice)); ?>" method="POST" class="d-inline">
                <?php echo csrf_field(); ?>
                <button class="btn btn-danger btn-sm" onclick="return confirm('Void faktur ini?')"><i class="fas fa-ban me-1"></i>Void</button>
            </form>
        <?php endif; ?>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
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
            <div class="row mb-3">
                <div class="col-md-3"><strong>Kode Faktur</strong><br><?php echo e($invoice->code); ?></div>
                <div class="col-md-3"><strong>Ref. SO</strong><br><a href="<?php echo e(route('sales.orders.show', $invoice->salesOrder)); ?>"><?php echo e($invoice->salesOrder->code); ?></a></div>
                <div class="col-md-3"><strong>Pelanggan</strong><br><?php echo e($invoice->salesOrder->customer->name); ?></div>
                <div class="col-md-3"><strong>Status</strong><br><?php if (isset($component)) { $__componentOriginal8c81617a70e11bcf247c4db924ab1b62 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8c81617a70e11bcf247c4db924ab1b62 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.status-badge','data' => ['status' => $invoice->status]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('status-badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['status' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($invoice->status)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8c81617a70e11bcf247c4db924ab1b62)): ?>
<?php $attributes = $__attributesOriginal8c81617a70e11bcf247c4db924ab1b62; ?>
<?php unset($__attributesOriginal8c81617a70e11bcf247c4db924ab1b62); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8c81617a70e11bcf247c4db924ab1b62)): ?>
<?php $component = $__componentOriginal8c81617a70e11bcf247c4db924ab1b62; ?>
<?php unset($__componentOriginal8c81617a70e11bcf247c4db924ab1b62); ?>
<?php endif; ?></div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3"><strong>Tgl Faktur</strong><br><?php echo e($invoice->invoice_date->format('d M Y')); ?></div>
                <div class="col-md-3"><strong>Jatuh Tempo</strong><br><?php echo e($invoice->due_date->format('d M Y')); ?></div>
                <div class="col-md-3"><strong>Dibuat Oleh</strong><br><?php echo e($invoice->createdBy->name ?? '-'); ?></div>
                <div class="col-md-3"><strong>Catatan</strong><br><?php echo e($invoice->notes ?? '-'); ?></div>
            </div>

            <hr>
            <h6><i class="fas fa-list me-1"></i> Detail Barang</h6>
            <div class="table-responsive">
                <table class="table items-table">
                    <thead><tr><th>#</th><th>Produk</th><th>Qty</th><th>Harga</th><th class="text-end">Subtotal</th></tr></thead>
                    <tbody>
                        <?php $__currentLoopData = $invoice->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idx => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($idx + 1); ?></td>
                            <td><?php echo e($item->product->sku); ?> — <?php echo e($item->product->name); ?></td>
                            <td><?php echo e($item->qty); ?></td>
                            <td>Rp <?php echo e(number_format($item->price, 0, ',', '.')); ?></td>
                            <td class="text-end">Rp <?php echo e(number_format($item->subtotal, 0, ',', '.')); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            <div class="total-section">
                <span class="total-label">Grand Total:</span>
                <span class="total-value">Rp <?php echo e(number_format($invoice->total, 0, ',', '.')); ?></span>
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

    <div class="col-md-4">
        <?php if (isset($component)) { $__componentOriginal53747ceb358d30c0105769f8471417f6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal53747ceb358d30c0105769f8471417f6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card','data' => ['title' => 'Pembayaran']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Pembayaran']); ?>
            <?php $totalPaid = $invoice->payments->where('status','CONFIRMED')->sum('amount'); ?>
            <div class="mb-3">
                <strong>Total Faktur:</strong> Rp <?php echo e(number_format($invoice->total, 0, ',', '.')); ?><br>
                <strong>Sudah Dibayar:</strong> Rp <?php echo e(number_format($totalPaid, 0, ',', '.')); ?><br>
                <strong>Sisa:</strong> Rp <?php echo e(number_format($invoice->total - $totalPaid, 0, ',', '.')); ?>

            </div>
            <?php $__empty_1 = true; $__currentLoopData = $invoice->payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pay): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="border-bottom pb-2 mb-2">
                    <strong><?php echo e($pay->code); ?></strong><br>
                    <small><?php echo e($pay->paid_at->format('d M Y')); ?> • <?php echo e($pay->method); ?> • Rp <?php echo e(number_format($pay->amount, 0, ',', '.')); ?></small>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p class="text-muted small">Belum ada pembayaran</p>
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
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\UNBRAW\SMT 6\Magang Mitra\Pertemuan\Back-End\Assignment\gentella_laravel\resources\views/sales/invoices/show.blade.php ENDPATH**/ ?>