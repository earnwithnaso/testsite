<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Admin</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-soft-grey text-primary">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <aside class="w-80 fixed inset-y-0 left-0 z-50 p-6">
            <div class="h-full bg-primary text-white rounded-5xl shadow-floating flex flex-col justify-between p-8">
                <!-- Logo -->
                <div>
                    <a href="{{ route('admin.dashboard') }}" class="block text-2xl font-black tracking-tighter text-white mb-12">
                        NAZO ADMIN
                    </a>

                    <!-- Nav Links -->
                    <nav class="space-y-4">
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-4 px-6 py-4 rounded-4xl bg-white/10 hover:bg-white text-white hover:text-primary font-bold transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-white text-primary' : '' }}">
                            <span>📊</span> Dashboard
                        </a>
                        <a href="{{ route('admin.users.index') }}" class="flex items-center gap-4 px-6 py-4 rounded-4xl hover:bg-white hover:text-primary font-bold transition-all text-white/70">
                            <span>👥</span> Users
                        </a>
                        <a href="{{ route('admin.courses.index') }}" class="flex items-center gap-4 px-6 py-4 rounded-4xl hover:bg-white hover:text-primary font-bold transition-all text-white/70">
                            <span>🎓</span> Courses
                        </a>
                        <a href="{{ route('admin.categories.index') }}" class="flex items-center gap-4 px-6 py-4 rounded-4xl hover:bg-white hover:text-primary font-bold transition-all text-white/70">
                            <span>🏷️</span> Categories
                        </a>
                        <a href="{{ route('admin.pages.index') }}" class="flex items-center gap-4 px-6 py-4 rounded-4xl hover:bg-white hover:text-primary font-bold transition-all text-white/70">
                            <span>📄</span> CMS Pages
                        </a>
                        <div class="h-px bg-white/10 my-4"></div>
                        <a href="#" class="flex items-center gap-4 px-6 py-4 rounded-4xl hover:bg-white hover:text-primary font-bold transition-all text-white/70">
                            <span>💳</span> Payments
                        </a>

                        
                        <details class="group">
                            <summary class="flex items-center gap-4 px-6 py-4 rounded-4xl hover:bg-white hover:text-primary font-bold transition-all text-white/70 cursor-pointer list-none {{ request()->routeIs('admin.settings.*') ? 'bg-white text-primary' : '' }}">
                                <span>⚙️</span> Settings
                            </summary>
                            <div class="px-6 py-2 space-y-2">
                                <a href="{{ route('admin.settings.index') }}" class="block text-sm font-bold text-white/50 hover:text-white px-4 py-2">General</a>
                                <a href="{{ route('admin.settings.seo') }}" class="block text-sm font-bold text-white/50 hover:text-white px-4 py-2">SEO</a>
                                <a href="{{ route('admin.settings.about') }}" class="block text-sm font-bold text-white/50 hover:text-white px-4 py-2">About Page</a>
                                <a href="{{ route('admin.settings.env') }}" class="block text-sm font-bold text-white/50 hover:text-white px-4 py-2">Environment</a>
                            </div>
                        </details>
                    </nav>
                </div>

                <!-- User Profile / Logout -->
                <div class="border-t border-white/10 pt-6">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-10 h-10 rounded-full bg-white/20"></div>
                        <div>
                            <p class="font-bold text-sm">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-white/50">Administrator</p>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full py-3 rounded-full border border-white/20 text-sm font-bold hover:bg-white hover:text-primary transition-colors">
                            Log Out
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 ml-80 p-8">
            <!-- Top Header -->
            <header class="flex justify-between items-center mb-12">
                <div>
                    <h1 class="text-3xl font-black text-primary">@yield('header', 'Overview')</h1>
                    <p class="text-secondary text-sm font-medium mt-1">{{ now()->format('l, F jS, Y') }}</p>
                </div>
                
                <div class="flex items-center gap-6">
                    <div class="bg-white p-3 rounded-full shadow-soft cursor-pointer hover:shadow-medium transition-shadow relative">
                        🔔 <span class="absolute top-0 right-0 w-3 h-3 bg-red-500 rounded-full border-2 border-white"></span>
                    </div>
                    <a href="{{ route('home') }}" target="_blank" class="px-6 py-3 bg-white text-primary font-bold rounded-full shadow-soft hover:shadow-medium border border-soft-grey transition-all text-sm">
                        View Website ↗
                    </a>
                </div>
            </header>

            <!-- Page Content -->
            <div class="space-y-8">
                {{ $slot }}
            </div>
        </main>
    </div>
</body>
</html>
