{{-- Sidebar Navigation --}}
<nav id="sidebar" class="sidebar">
    {{-- Brand --}}
    <a href="{{ route('dashboard') }}" class="sidebar-brand">
        <div class="brand-icon">G</div>
        <span class="brand-text">Gentella ERP</span>
    </a>

    {{-- Menu --}}
    <ul class="sidebar-menu">
        {{-- Dashboard --}}
        <li class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <a href="{{ route('dashboard') }}">
                <span class="menu-icon"><i class="fas fa-home"></i></span>
                <span class="menu-text">Dashboard</span>
            </a>
        </li>

        {{-- MASTER DATA --}}
        @canany(['master.customers.view', 'master.suppliers.view', 'master.products.view', 'master.warehouses.view', 'master.payment_terms.view'])
        <li class="menu-header">Master Data</li>

        <li class="menu-item has-submenu {{ request()->is('master/*') ? 'open active' : '' }}">
            <a href="#">
                <span class="menu-icon"><i class="fas fa-database"></i></span>
                <span class="menu-text">Master Data</span>
                <span class="menu-arrow"><i class="fas fa-chevron-right"></i></span>
            </a>
            <ul class="submenu">
                @can('master.customers.view')
                <li class="{{ request()->routeIs('master.customers.*') ? 'active' : '' }}">
                    <a href="{{ route('master.customers.index') }}">Pelanggan</a>
                </li>
                @endcan
                @can('master.suppliers.view')
                <li class="{{ request()->routeIs('master.suppliers.*') ? 'active' : '' }}">
                    <a href="{{ route('master.suppliers.index') }}">Supplier</a>
                </li>
                @endcan
                @can('master.products.view')
                <li class="{{ request()->routeIs('master.products.*') ? 'active' : '' }}">
                    <a href="{{ route('master.products.index') }}">Produk</a>
                </li>
                @endcan
                @can('master.warehouses.view')
                <li class="{{ request()->routeIs('master.warehouses.*') ? 'active' : '' }}">
                    <a href="{{ route('master.warehouses.index') }}">Gudang</a>
                </li>
                @endcan
                @can('master.payment_terms.view')
                <li class="{{ request()->routeIs('master.payment-terms.*') ? 'active' : '' }}">
                    <a href="{{ route('master.payment-terms.index') }}">Termin Pembayaran</a>
                </li>
                @endcan
            </ul>
        </li>
        @endcanany

        {{-- SALES --}}
        @canany(['sales.orders.view', 'sales.delivery_orders.view', 'sales.invoices.view'])
        <li class="menu-header">Penjualan</li>

        <li class="menu-item has-submenu {{ request()->is('sales/*') ? 'open active' : '' }}">
            <a href="#">
                <span class="menu-icon"><i class="fas fa-chart-line"></i></span>
                <span class="menu-text">Penjualan</span>
                <span class="menu-arrow"><i class="fas fa-chevron-right"></i></span>
            </a>
            <ul class="submenu">
                @can('sales.orders.view')
                <li class="{{ request()->routeIs('sales.orders.*') ? 'active' : '' }}">
                    <a href="{{ route('sales.orders.index') }}">Sales Order</a>
                </li>
                @endcan
                @can('sales.delivery_orders.view')
                <li class="{{ request()->routeIs('sales.delivery-orders.*') ? 'active' : '' }}">
                    <a href="{{ route('sales.delivery-orders.index') }}">Surat Jalan</a>
                </li>
                @endcan
                @can('sales.invoices.view')
                <li class="{{ request()->routeIs('sales.invoices.*') ? 'active' : '' }}">
                    <a href="{{ route('sales.invoices.index') }}">Faktur Penjualan</a>
                </li>
                @endcan
            </ul>
        </li>
        @endcanany

        {{-- PURCHASING --}}
        @canany(['purchasing.orders.view', 'purchasing.goods_receipts.view', 'purchasing.invoices.view'])
        <li class="menu-header">Pembelian</li>

        <li class="menu-item has-submenu {{ request()->is('purchasing/*') ? 'open active' : '' }}">
            <a href="#">
                <span class="menu-icon"><i class="fas fa-shopping-cart"></i></span>
                <span class="menu-text">Pembelian</span>
                <span class="menu-arrow"><i class="fas fa-chevron-right"></i></span>
            </a>
            <ul class="submenu">
                @can('purchasing.orders.view')
                <li class="{{ request()->routeIs('purchasing.orders.*') ? 'active' : '' }}">
                    <a href="{{ route('purchasing.orders.index') }}">Purchase Order</a>
                </li>
                @endcan
                @can('purchasing.goods_receipts.view')
                <li class="{{ request()->routeIs('purchasing.goods-receipts.*') ? 'active' : '' }}">
                    <a href="{{ route('purchasing.goods-receipts.index') }}">Penerimaan Barang</a>
                </li>
                @endcan
                @can('purchasing.invoices.view')
                <li class="{{ request()->routeIs('purchasing.invoices.*') ? 'active' : '' }}">
                    <a href="{{ route('purchasing.invoices.index') }}">Faktur Pembelian</a>
                </li>
                @endcan
            </ul>
        </li>
        @endcanany

        {{-- FINANCE --}}
        @canany(['finance.sales_payments.view', 'finance.purchase_payments.view'])
        <li class="menu-header">Keuangan</li>

        <li class="menu-item has-submenu {{ request()->is('finance/*') ? 'open active' : '' }}">
            <a href="#">
                <span class="menu-icon"><i class="fas fa-wallet"></i></span>
                <span class="menu-text">Keuangan</span>
                <span class="menu-arrow"><i class="fas fa-chevron-right"></i></span>
            </a>
            <ul class="submenu">
                @can('finance.sales_payments.view')
                <li class="{{ request()->routeIs('finance.sales-payments.*') ? 'active' : '' }}">
                    <a href="{{ route('finance.sales-payments.index') }}">Pembayaran Penjualan</a>
                </li>
                @endcan
                @can('finance.purchase_payments.view')
                <li class="{{ request()->routeIs('finance.purchase-payments.*') ? 'active' : '' }}">
                    <a href="{{ route('finance.purchase-payments.index') }}">Pembayaran Pembelian</a>
                </li>
                @endcan
            </ul>
        </li>
        @endcanany

        {{-- SETTINGS --}}
        @role('Admin')
        <li class="menu-header">Pengaturan</li>

        <li class="menu-item has-submenu {{ request()->is('settings/*') ? 'open active' : '' }}">
            <a href="#">
                <span class="menu-icon"><i class="fas fa-cog"></i></span>
                <span class="menu-text">Pengaturan</span>
                <span class="menu-arrow"><i class="fas fa-chevron-right"></i></span>
            </a>
            <ul class="submenu">
                <li class="{{ request()->routeIs('settings.users.*') ? 'active' : '' }}">
                    <a href="{{ route('settings.users.index') }}">Pengguna</a>
                </li>
                <li class="{{ request()->routeIs('settings.roles.*') ? 'active' : '' }}">
                    <a href="{{ route('settings.roles.index') }}">Peran & Hak Akses</a>
                </li>
            </ul>
        </li>
        @endrole
    </ul>
</nav>
