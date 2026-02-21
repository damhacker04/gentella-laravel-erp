<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login — {{ config('app.name', 'Gentella ERP') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="login-page">
        <div class="login-card">
            <div class="login-logo">
                <div class="logo-icon">G</div>
                <h2>Gentella ERP</h2>
                <p>Sistem Informasi Penjualan & Pembelian</p>
            </div>

            {{-- Flash Error --}}
            @if(session('status'))
                <div class="alert alert-success mb-3">{{ session('status') }}</div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                               id="email" name="email" value="{{ old('email') }}"
                               placeholder="nama@email.com" required autofocus>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Kata Sandi</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                               id="password" name="password" placeholder="••••••••" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                        <label class="form-check-label" for="remember" style="font-size:13px;">Ingat Saya</label>
                    </div>
                    @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" style="font-size:13px; color: var(--accent);">
                        Lupa Kata Sandi?
                    </a>
                    @endif
                </div>

                <button type="submit" class="btn btn-accent w-100 py-2">
                    <i class="fas fa-sign-in-alt me-2"></i>Masuk
                </button>
            </form>

            @if (Route::has('register'))
            <div class="text-center mt-3" style="font-size:14px;">
                Belum punya akun?
                <a href="{{ route('register') }}" style="color: var(--accent); font-weight: 600; text-decoration: none;">Daftar Sekarang</a>
            </div>
            @endif

            <div class="text-center mt-4" style="font-size:12px; color: var(--text-muted);">
                &copy; {{ date('Y') }} Gentella ERP — Dibangun dengan Laravel
            </div>
        </div>
    </div>
</body>
</html>
