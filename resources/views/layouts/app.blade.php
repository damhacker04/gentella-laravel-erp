<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Dashboard') — {{ config('app.name', 'Gentella ERP') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body>
    {{-- Sidebar --}}
    @include('layouts._sidebar')

    {{-- Sidebar Overlay (mobile) --}}
    <div id="sidebar-overlay" class="sidebar-overlay"></div>

    {{-- Top Navbar --}}
    @include('layouts._navbar')

    {{-- Main Content --}}
    <div class="main-content">
        <div class="content-wrapper">
            {{-- Flash Messages --}}
            @include('layouts._flash')

            {{-- Page Header & Breadcrumb --}}
            @hasSection('page-title')
            <div class="page-header">
                <div>
                    <h1 class="page-title">@yield('page-title')</h1>
                    @hasSection('breadcrumb')
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fas fa-home"></i> Beranda</a></li>
                            @yield('breadcrumb')
                        </ol>
                    </nav>
                    @endif
                </div>
                <div>
                    @yield('page-actions')
                </div>
            </div>
            @endif

            {{-- Content --}}
            @yield('content')
        </div>

        {{-- Footer --}}
        @include('layouts._footer')
    </div>

    @stack('scripts')
</body>
</html>
