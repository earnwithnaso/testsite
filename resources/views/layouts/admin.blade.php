<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Admin</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.hugeicons.com/font/hgi-stroke-rounded.css" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Modern Sidebar Transition */
        aside { transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1), transform 0.3s ease; }
        main { transition: margin-left 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
        
        /* Expand/Collapse Classes */
        .sidebar-expanded aside { width: 320px; }
        .sidebar-expanded main { margin-left: 320px; }
        
        .sidebar-collapsed aside { width: 110px; }
        .sidebar-collapsed main { margin-left: 110px; }

        /* Hide labels in collapsed state */
        .sidebar-collapsed .nav-label, 
        .sidebar-collapsed .logo-text,
        .sidebar-collapsed .user-info,
        .sidebar-collapsed summary::after { 
            display: none; 
        }
        
        .sidebar-collapsed .nav-item {
            justify-content: center;
            padding-left: 0;
            padding-right: 0;
        }

        .sidebar-collapsed .nav-icon {
            font-size: 1.5rem;
            margin: 0;
        }

        .sidebar-collapsed details div {
            display: none;
        }

        @media (max-width: 1024px) {
            aside { 
                width: 300px !important; 
                transform: translateX(-100%);
            }
            main { margin-left: 0 !important; }
            .mobile-sidebar-open aside { transform: translateX(0); }
            .mobile-sidebar-open body { overflow: hidden; }
        }
    </style>
</head>
<body class="font-sans antialiased bg-soft-grey text-primary sidebar-expanded" id="body-container">
    <div class="min-h-screen flex relative">
        <!-- Mobile Toggle / Desktop Collapse -->
        <button onclick="toggleSidebar()" class="fixed top-8 left-4 z-[110] bg-primary text-white p-3 rounded-full shadow-floating focus:outline-none hover:scale-110 transition-transform">
            <i class="hgi-stroke hgi-menu-02 text-2xl"></i>
        </button>

        <!-- Sidebar -->
        <aside class="fixed inset-y-0 left-0 z-[100] p-4 lg:p-6 h-full">
            <div class="h-full bg-primary text-white rounded-5xl shadow-floating flex flex-col justify-between p-6 lg:p-8 overflow-y-auto overflow-x-hidden">
                <!-- Logo -->
                <div>
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 text-2xl font-black tracking-tighter text-white mb-12 overflow-hidden whitespace-nowrap">
                        <i class="hgi-stroke hgi-rocket-01 text-3xl"></i>
                        <span class="logo-text">NAZO ADMIN</span>
                    </a>

                    <!-- Nav Links -->
                    <nav class="space-y-3">
                        <a href="{{ route('admin.dashboard') }}" class="nav-item flex items-center gap-4 px-6 py-4 rounded-4xl hover:bg-white hover:text-primary font-bold transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-white text-primary' : 'text-white/70' }}">
                            <i class="hgi-stroke hgi-dashboard-square-01 nav-icon text-2xl"></i> 
                            <span class="nav-label">Dashboard</span>
                        </a>
                        
                        @if(Auth::user()->isAdmin())
                        <a href="{{ route('admin.users.index') }}" class="nav-item flex items-center gap-4 px-6 py-4 rounded-4xl hover:bg-white hover:text-primary font-bold transition-all {{ request()->routeIs('admin.users.*') ? 'bg-white text-primary' : 'text-white/70' }}">
                            <i class="hgi-stroke hgi-user-group nav-icon text-2xl"></i> 
                            <span class="nav-label">Users</span>
                        </a>
                        @endif

                        <a href="{{ route('admin.courses.index') }}" class="nav-item flex items-center gap-4 px-6 py-4 rounded-4xl hover:bg-white hover:text-primary font-bold transition-all {{ request()->routeIs('admin.courses.*') ? 'bg-white text-primary' : 'text-white/70' }}">
                            <i class="hgi-stroke hgi-mortarboard-01 nav-icon text-2xl"></i> 
                            <span class="nav-label">Courses</span>
                        </a>

                        <a href="{{ route('admin.categories.index') }}" class="nav-item flex items-center gap-4 px-6 py-4 rounded-4xl hover:bg-white hover:text-primary font-bold transition-all {{ request()->routeIs('admin.categories.*') ? 'bg-white text-primary' : 'text-white/70' }}">
                            <i class="hgi-stroke hgi-tags-01 nav-icon text-2xl"></i> 
                            <span class="nav-label">Categories</span>
                        </a>

                        <a href="{{ route('admin.pages.index') }}" class="nav-item flex items-center gap-4 px-6 py-4 rounded-4xl hover:bg-white hover:text-primary font-bold transition-all {{ request()->routeIs('admin.pages.*') ? 'bg-white text-primary' : 'text-white/70' }}">
                            <i class="hgi-stroke hgi-file-01 nav-icon text-2xl"></i> 
                            <span class="nav-label">CMS Pages</span>
                        </a>

                        <div class="h-px bg-white/10 my-4"></div>

                        <a href="{{ route('admin.orders.index') }}" class="nav-item flex items-center gap-4 px-6 py-4 rounded-4xl hover:bg-white hover:text-primary font-bold transition-all {{ request()->routeIs('admin.orders.*') ? 'bg-white text-primary' : 'text-white/70' }}">
                            <i class="hgi-stroke hgi-credit-card-01 nav-icon text-2xl"></i> 
                            <span class="nav-label">Enrollments</span>
                        </a>

                        @if(Auth::user()->isAdmin())
                        <details class="group" {{ request()->routeIs('admin.settings.*') ? 'open' : '' }}>
                            <summary class="nav-item flex items-center gap-4 px-6 py-4 rounded-4xl hover:bg-white hover:text-primary font-bold transition-all text-white/70 cursor-pointer list-none {{ request()->routeIs('admin.settings.*') ? 'bg-white text-primary' : '' }}">
                                <i class="hgi-stroke hgi-settings-01 nav-icon text-2xl"></i> 
                                <span class="nav-label">Settings</span>
                            </summary>
                            <div class="px-6 py-2 space-y-1">
                                <a href="{{ route('admin.settings.index') }}" class="block text-sm font-bold {{ request()->routeIs('admin.settings.index') ? 'text-white' : 'text-white/50' }} hover:text-white px-4 py-2">General</a>
                                <a href="{{ route('admin.settings.seo') }}" class="block text-sm font-bold {{ request()->routeIs('admin.settings.seo') ? 'text-white' : 'text-white/50' }} hover:text-white px-4 py-2">SEO</a>
                                <a href="{{ route('admin.settings.about') }}" class="block text-sm font-bold {{ request()->routeIs('admin.settings.about') ? 'text-white' : 'text-white/50' }} hover:text-white px-4 py-2">About</a>
                            </div>
                        </details>
                        @endif
                    </nav>
                </div>

                <!-- User Profile / Logout -->
                <div class="border-t border-white/10 pt-6 mt-6">
                    <div class="flex items-center gap-4 mb-6 px-2 overflow-hidden">
                        <div class="w-10 h-10 rounded-full bg-white/20 flex-shrink-0"></div>
                        <div class="user-info whitespace-nowrap">
                            <p class="font-bold text-sm">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-white/50">Admin</p>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="nav-item w-full py-4 rounded-full border border-white/20 text-sm font-bold hover:bg-white hover:text-primary transition-all flex items-center justify-center gap-2">
                             <i class="hgi-stroke hgi-logout-01 nav-icon lg:hidden inline text-lg"></i>
                             <span class="nav-label">Log Out</span>
                             <i class="hgi-stroke hgi-logout-01 nav-icon hidden lg:inline sidebar-collapsed-only text-lg"></i>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-4 lg:p-10 transition-all duration-300">
            <!-- Top Header -->
            <header class="flex flex-col lg:flex-row justify-between lg:items-center mb-8 lg:mb-16 gap-6 lg:gap-0 mt-24 lg:mt-0">
                <div>
                    <h1 class="text-4xl font-black text-primary tracking-tight">@yield('header', 'Overview')</h1>
                    <p class="text-secondary text-base font-medium mt-1">{{ now()->format('l, F jS, Y') }}</p>
                </div>
                
                <div class="flex items-center gap-4 lg:gap-8">
                    <div class="bg-white p-4 rounded-full shadow-soft cursor-pointer hover:shadow-medium transition-all relative">
                        <i class="hgi-stroke hgi-notification-01 text-xl"></i>
                        <span class="absolute top-1 right-1 w-3 h-3 bg-red-500 rounded-full border-2 border-white"></span>
                    </div>
                    <a href="{{ route('home') }}" target="_blank" class="px-8 py-4 bg-white text-primary font-bold rounded-full shadow-soft hover:shadow-medium border border-soft-grey transition-all text-sm flex items-center gap-2">
                        View Website <span>↗</span>
                    </a>
                </div>
            </header>

            <!-- Page Content -->
            <div class="pb-12">
                {{ $slot }}
            </div>
        </main>
    </div>

    <script>
        function toggleSidebar() {
            const body = document.getElementById('body-container');
            const isMobile = window.innerWidth <= 1024;

            if (isMobile) {
                if (body.classList.contains('mobile-sidebar-open')) {
                    body.classList.remove('mobile-sidebar-open');
                } else {
                    body.classList.add('mobile-sidebar-open');
                }
            } else {
                if (body.classList.contains('sidebar-expanded')) {
                    body.classList.remove('sidebar-expanded');
                    body.classList.add('sidebar-collapsed');
                } else {
                    body.classList.remove('sidebar-collapsed');
                    body.classList.add('sidebar-expanded');
                }
            }
        }

        // Handle window resize
        window.addEventListener('resize', () => {
             const body = document.getElementById('body-container');
             if (window.innerWidth > 1024) {
                 body.classList.remove('mobile-sidebar-open');
             }
        });
    </script>
</body>
</html>
