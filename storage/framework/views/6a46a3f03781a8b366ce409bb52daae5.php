
<nav id="sidebar" class="sidebar">
    
    <a href="<?php echo e(route('dashboard')); ?>" class="sidebar-brand">
        <div class="brand-icon">G</div>
        <span class="brand-text">Gentella ERP</span>
    </a>

    
    <ul class="sidebar-menu">
        
        <li class="menu-item <?php echo e(request()->routeIs('dashboard') ? 'active' : ''); ?>">
            <a href="<?php echo e(route('dashboard')); ?>">
                <span class="menu-icon"><i class="fas fa-home"></i></span>
                <span class="menu-text">Dashboard</span>
            </a>
        </li>

        
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['master.customers.view', 'master.suppliers.view', 'master.products.view', 'master.warehouses.view', 'master.payment_terms.view'])): ?>
        <li class="menu-header">Master Data</li>

        <li class="menu-item has-submenu <?php echo e(request()->is('master/*') ? 'open active' : ''); ?>">
            <a href="#">
                <span class="menu-icon"><i class="fas fa-database"></i></span>
                <span class="menu-text">Master Data</span>
                <span class="menu-arrow"><i class="fas fa-chevron-right"></i></span>
            </a>
            <ul class="submenu">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('master.customers.view')): ?>
                <li class="<?php echo e(request()->routeIs('master.customers.*') ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('master.customers.index')); ?>">Pelanggan</a>
                </li>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('master.suppliers.view')): ?>
                <li class="<?php echo e(request()->routeIs('master.suppliers.*') ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('master.suppliers.index')); ?>">Supplier</a>
                </li>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('master.products.view')): ?>
                <li class="<?php echo e(request()->routeIs('master.products.*') ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('master.products.index')); ?>">Produk</a>
                </li>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('master.warehouses.view')): ?>
                <li class="<?php echo e(request()->routeIs('master.warehouses.*') ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('master.warehouses.index')); ?>">Gudang</a>
                </li>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('master.payment_terms.view')): ?>
                <li class="<?php echo e(request()->routeIs('master.payment-terms.*') ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('master.payment-terms.index')); ?>">Termin Pembayaran</a>
                </li>
                <?php endif; ?>
            </ul>
        </li>
        <?php endif; ?>

        
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['sales.orders.view', 'sales.delivery_orders.view', 'sales.invoices.view'])): ?>
        <li class="menu-header">Penjualan</li>

        <li class="menu-item has-submenu <?php echo e(request()->is('sales/*') ? 'open active' : ''); ?>">
            <a href="#">
                <span class="menu-icon"><i class="fas fa-chart-line"></i></span>
                <span class="menu-text">Penjualan</span>
                <span class="menu-arrow"><i class="fas fa-chevron-right"></i></span>
            </a>
            <ul class="submenu">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('sales.orders.view')): ?>
                <li class="<?php echo e(request()->routeIs('sales.orders.*') ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('sales.orders.index')); ?>">Sales Order</a>
                </li>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('sales.delivery_orders.view')): ?>
                <li class="<?php echo e(request()->routeIs('sales.delivery-orders.*') ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('sales.delivery-orders.index')); ?>">Surat Jalan</a>
                </li>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('sales.invoices.view')): ?>
                <li class="<?php echo e(request()->routeIs('sales.invoices.*') ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('sales.invoices.index')); ?>">Faktur Penjualan</a>
                </li>
                <?php endif; ?>
            </ul>
        </li>
        <?php endif; ?>

        
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['purchasing.orders.view', 'purchasing.goods_receipts.view', 'purchasing.invoices.view'])): ?>
        <li class="menu-header">Pembelian</li>

        <li class="menu-item has-submenu <?php echo e(request()->is('purchasing/*') ? 'open active' : ''); ?>">
            <a href="#">
                <span class="menu-icon"><i class="fas fa-shopping-cart"></i></span>
                <span class="menu-text">Pembelian</span>
                <span class="menu-arrow"><i class="fas fa-chevron-right"></i></span>
            </a>
            <ul class="submenu">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('purchasing.orders.view')): ?>
                <li class="<?php echo e(request()->routeIs('purchasing.orders.*') ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('purchasing.orders.index')); ?>">Purchase Order</a>
                </li>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('purchasing.goods_receipts.view')): ?>
                <li class="<?php echo e(request()->routeIs('purchasing.goods-receipts.*') ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('purchasing.goods-receipts.index')); ?>">Penerimaan Barang</a>
                </li>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('purchasing.invoices.view')): ?>
                <li class="<?php echo e(request()->routeIs('purchasing.invoices.*') ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('purchasing.invoices.index')); ?>">Faktur Pembelian</a>
                </li>
                <?php endif; ?>
            </ul>
        </li>
        <?php endif; ?>

        
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['finance.sales_payments.view', 'finance.purchase_payments.view'])): ?>
        <li class="menu-header">Keuangan</li>

        <li class="menu-item has-submenu <?php echo e(request()->is('finance/*') ? 'open active' : ''); ?>">
            <a href="#">
                <span class="menu-icon"><i class="fas fa-wallet"></i></span>
                <span class="menu-text">Keuangan</span>
                <span class="menu-arrow"><i class="fas fa-chevron-right"></i></span>
            </a>
            <ul class="submenu">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('finance.sales_payments.view')): ?>
                <li class="<?php echo e(request()->routeIs('finance.sales-payments.*') ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('finance.sales-payments.index')); ?>">Pembayaran Penjualan</a>
                </li>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('finance.purchase_payments.view')): ?>
                <li class="<?php echo e(request()->routeIs('finance.purchase-payments.*') ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('finance.purchase-payments.index')); ?>">Pembayaran Pembelian</a>
                </li>
                <?php endif; ?>
                <li class="<?php echo e(request()->routeIs('finance.xendit-payments.*') ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('finance.xendit-payments.index')); ?>"><i class="fas fa-credit-card me-1"></i>Pembayaran Xendit</a>
                </li>
            </ul>
        </li>
        <?php endif; ?>

        
        <?php if (\Illuminate\Support\Facades\Blade::check('role', 'Admin')): ?>
        <li class="menu-header">Pengaturan</li>

        <li class="menu-item has-submenu <?php echo e(request()->is('settings/*') ? 'open active' : ''); ?>">
            <a href="#">
                <span class="menu-icon"><i class="fas fa-cog"></i></span>
                <span class="menu-text">Pengaturan</span>
                <span class="menu-arrow"><i class="fas fa-chevron-right"></i></span>
            </a>
            <ul class="submenu">
                <li class="<?php echo e(request()->routeIs('settings.users.*') ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('settings.users.index')); ?>">Pengguna</a>
                </li>
                <li class="<?php echo e(request()->routeIs('settings.roles.*') ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('settings.roles.index')); ?>">Peran & Hak Akses</a>
                </li>
            </ul>
        </li>
        <?php endif; ?>
    </ul>
</nav>
<?php /**PATH C:\UNBRAW\SMT 6\Magang Mitra\Pertemuan\Back-End\Assignment\gentella_laravel\resources\views/layouts/_sidebar.blade.php ENDPATH**/ ?>