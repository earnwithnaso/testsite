<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-white text-primary">
        <div class="min-h-screen pb-20">
            <!-- Floating Navigation -->
            <nav class="fixed top-6 left-0 right-0 z-50 flex justify-center px-4">
                 <div class="bg-white/80 backdrop-blur-md border border-white/20 shadow-floating rounded-full px-8 py-4 flex items-center justify-between gap-12 w-full max-w-6xl transition-all">
                    <!-- Brand -->
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2 text-xl font-black tracking-tighter">
                         <img src="{{ asset('images/logo.jpeg') }}" alt="Logo" class="h-8 w-auto">
                        <span class="hidden sm:inline">NAZO DASHBOARD</span>
                    </a>

                    <!-- Nav Links -->
                    <div class="hidden md:flex items-center gap-2">
                        <a href="{{ route('dashboard') }}" class="px-5 py-2 rounded-full text-sm font-bold transition-all {{ request()->routeIs('dashboard') ? 'bg-brand text-white shadow-soft' : 'text-secondary hover:text-brand hover:bg-soft-grey/50' }}">
                            Dashboard
                        </a>
                        <a href="{{ route('courses.index') }}" class="px-5 py-2 rounded-full text-sm font-bold transition-all {{ request()->routeIs('courses.*') ? 'bg-brand text-white shadow-soft' : 'text-secondary hover:text-brand hover:bg-soft-grey/50' }}">
                            My Courses
                        </a>
                        <!-- Wallet -->
                        <a href="#" class="px-5 py-2 rounded-full text-sm font-bold text-secondary hover:text-primary hover:bg-soft-grey/50 transition-all">
                            Wallet (₦0.00)
                        </a>
                    </div>

                    <!-- User Menu -->
                    <div class="flex items-center gap-4">
                        <div class="relative group">
                            <button class="flex items-center gap-3 focus:outline-none">
                                <span class="text-sm font-bold text-right hidden sm:block">
                                    {{ Auth::user()->name }}
                                </span>
                                <div class="w-10 h-10 rounded-full bg-soft-grey border-2 border-white shadow-soft overflow-hidden">
                                     <!-- Avatar Placeholder -->
                                    <svg class="w-full h-full text-secondary" fill="currentColor" viewBox="0 0 24 24"><path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                                </div>
                            </button>
                            
                            <!-- Dropdown -->
                            <div class="absolute right-0 mt-4 w-48 bg-white rounded-4xl shadow-floating py-2 invisible opacity-0 group-hover:visible group-hover:opacity-100 transition-all transform origin-top-right">
                                <a href="{{ route('profile.edit') }}" class="block px-6 py-3 text-sm font-bold text-secondary hover:text-primary hover:bg-soft-grey/30">Profile</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-6 py-3 text-sm font-bold text-secondary hover:text-primary hover:bg-soft-grey/30">
                                        Log Out
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Heading -->
            @isset($header)
                <header class="pt-32 pb-10 px-4 max-w-6xl mx-auto">
                    {{ $header }}
                </header>
            @else
                <div class="pt-32"></div>
            @endisset

            <!-- Page Content -->
            <main class="px-4 max-w-6xl mx-auto">
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
