{{-- Top Navbar --}}
<nav class="top-navbar">
    <div class="d-flex align-items-center">
        <button type="button" id="sidebar-toggle" class="navbar-toggle">
            <i class="fas fa-bars"></i>
        </button>
    </div>

    <div class="navbar-right">
        {{-- Notifications placeholder --}}
        <button type="button" class="navbar-toggle" title="Notifikasi">
            <i class="fas fa-bell"></i>
        </button>

        {{-- User Menu --}}
        <div id="user-dropdown-btn" class="navbar-user">
            <div class="user-avatar">
                {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
            </div>
            <div class="d-none d-md-block">
                <div class="user-name">{{ Auth::user()->name ?? 'User' }}</div>
                <div class="user-role">{{ Auth::user()->roles->first()->name ?? 'User' }}</div>
            </div>
            <i class="fas fa-chevron-down" style="font-size:10px; color: var(--text-muted);"></i>

            {{-- Dropdown --}}
            <div id="user-dropdown" class="user-dropdown">
                <a href="{{ route('profile.edit') }}">
                    <i class="fas fa-user"></i> Profil Saya
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="text-danger">
                    <i class="fas fa-sign-out-alt"></i> Keluar
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</nav>
