<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-primary antialiased bg-white selection:bg-black selection:text-white">
    
    <!-- Floating Header -->
    <header class="fixed top-6 left-0 right-0 z-50 flex justify-center px-4">
        <nav class="bg-white/90 backdrop-blur-md border border-white/20 shadow-floating rounded-full px-8 py-3 flex items-center justify-between gap-12 w-full max-w-5xl transition-all duration-300">
            <!-- Brand -->
            <a href="{{ route('home') }}" class="flex items-center gap-2">
                <img src="{{ asset('images/logo.png') }}" alt="Earn With Nazo" class="h-10 w-auto">
            </a>

            <!-- Navigation Links -->
            <div class="hidden md:flex items-center gap-8">
                <a href="{{ route('home') }}" class="text-sm font-bold text-secondary hover:text-brand transition-colors">Home</a>
                <a href="{{ route('courses.index') }}" class="text-sm font-bold text-secondary hover:text-brand transition-colors">Courses</a>
                <a href="{{ route('pages.show', 'about-us') }}" class="text-sm font-bold text-secondary hover:text-brand transition-colors">About Us</a>
                <a href="{{ route('contact') }}" class="text-sm font-bold text-secondary hover:text-brand transition-colors">Contact</a>
            </div>

            <!-- Auth Buttons -->
            <div class="flex items-center gap-4">
                @auth
                    <a href="{{ route('dashboard') }}" class="text-sm font-bold text-primary hover:text-brand">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-bold text-primary hover:text-brand">Log in</a>
                    <a href="{{ route('register') }}" class="px-6 py-2.5 bg-brand text-white text-sm font-bold rounded-full hover:bg-green-600 transition-all shadow-medium hover:shadow-floating">
                        Get Started
                    </a>
                @endauth
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="min-h-screen pt-32 pb-20">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="bg-primary text-white py-16 rounded-t-6xl mt-20">
        <div class="max-w-7xl mx-auto px-8 grid grid-cols-1 md:grid-cols-4 gap-12">
            <div>
                <h3 class="text-2xl font-black tracking-tighter mb-4">EARN WITH NAZO</h3>
                <p class="text-white/60 text-sm">Empowering your future through premium education.</p>
            </div>
            <div>
                <h4 class="font-bold mb-4">Platform</h4>
                <ul class="space-y-2 text-sm text-white/60">
                    <li><a href="#" class="hover:text-white">Courses</a></li>
                    <li><a href="#" class="hover:text-white">Pricing</a></li>
                    <li><a href="#" class="hover:text-white">Mentors</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold mb-4">Company</h4>
                <ul class="space-y-2 text-sm text-white/60">
                    <li><a href="#" class="hover:text-white">About Us</a></li>
                    <li><a href="#" class="hover:text-white">Contact</a></li>
                    <li><a href="#" class="hover:text-white">Terms</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold mb-4">Newsletter</h4>
                <form class="flex gap-2">
                    <input type="email" placeholder="Email address" class="bg-white/10 border-none rounded-full px-4 py-2 text-sm w-full focus:ring-1 focus:ring-white">
                    <button class="bg-white text-primary px-4 py-2 rounded-full font-bold text-sm">Go</button>
                </form>
            </div>
        </div>
        <div class="max-w-7xl mx-auto px-8 mt-16 pt-8 border-t border-white/10 text-center text-sm text-white/40">
            &copy; {{ date('Y') }} Earn With Nazo. All rights reserved.
        </div>
    </footer>
</body>
</html>
