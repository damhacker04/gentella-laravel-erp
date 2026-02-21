
<nav class="top-navbar">
    <div class="d-flex align-items-center">
        <button type="button" id="sidebar-toggle" class="navbar-toggle">
            <i class="fas fa-bars"></i>
        </button>
    </div>

    <div class="navbar-right">
        
        <button type="button" class="navbar-toggle" title="Notifikasi">
            <i class="fas fa-bell"></i>
        </button>

        
        <div id="user-dropdown-btn" class="navbar-user">
            <div class="user-avatar">
                <?php echo e(strtoupper(substr(Auth::user()->name ?? 'U', 0, 1))); ?>

            </div>
            <div class="d-none d-md-block">
                <div class="user-name"><?php echo e(Auth::user()->name ?? 'User'); ?></div>
                <div class="user-role"><?php echo e(Auth::user()->roles->first()->name ?? 'User'); ?></div>
            </div>
            <i class="fas fa-chevron-down" style="font-size:10px; color: var(--text-muted);"></i>

            
            <div id="user-dropdown" class="user-dropdown">
                <a href="<?php echo e(route('profile.edit')); ?>">
                    <i class="fas fa-user"></i> Profil Saya
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="text-danger">
                    <i class="fas fa-sign-out-alt"></i> Keluar
                </a>
                <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                    <?php echo csrf_field(); ?>
                </form>
            </div>
        </div>
    </div>
</nav>
<?php /**PATH C:\UNBRAW\SMT 6\Magang Mitra\Pertemuan\Back-End\Assignment\gentella_laravel\resources\views/layouts/_navbar.blade.php ENDPATH**/ ?>