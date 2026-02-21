<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo $__env->yieldContent('title', 'Dashboard'); ?> — <?php echo e(config('app.name', 'Gentella ERP')); ?></title>

    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body>
    
    <?php echo $__env->make('layouts._sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    
    <div id="sidebar-overlay" class="sidebar-overlay"></div>

    
    <?php echo $__env->make('layouts._navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    
    <div class="main-content">
        <div class="content-wrapper">
            
            <?php echo $__env->make('layouts._flash', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

            
            <?php if (! empty(trim($__env->yieldContent('page-title')))): ?>
            <div class="page-header">
                <div>
                    <h1 class="page-title"><?php echo $__env->yieldContent('page-title'); ?></h1>
                    <?php if (! empty(trim($__env->yieldContent('breadcrumb')))): ?>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><i class="fas fa-home"></i> Beranda</a></li>
                            <?php echo $__env->yieldContent('breadcrumb'); ?>
                        </ol>
                    </nav>
                    <?php endif; ?>
                </div>
                <div>
                    <?php echo $__env->yieldContent('page-actions'); ?>
                </div>
            </div>
            <?php endif; ?>

            
            <?php echo $__env->yieldContent('content'); ?>
        </div>

        
        <?php echo $__env->make('layouts._footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </div>

    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\UNBRAW\SMT 6\Magang Mitra\Pertemuan\Back-End\Assignment\gentella_laravel\resources\views/layouts/app.blade.php ENDPATH**/ ?>