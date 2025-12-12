<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="text-center mb-8">
        <h2 class="text-2xl font-bold text-primary">Welcome Back</h2>
        <p class="text-secondary mt-2 text-sm">Sign in to continue your learning journey</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email Address')" class="ml-4" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 ml-4" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" class="ml-4" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 ml-4" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-soft-grey text-primary shadow-sm focus:ring-primary w-5 h-5 rounded-md" name="remember">
                <span class="ms-2 text-sm text-secondary">{{ __('Remember me') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm text-secondary hover:text-primary underline decoration-soft-grey hover:decoration-primary transition-all font-medium" href="{{ route('password.request') }}">
                    {{ __('Forgot password?') }}
                </a>
            @endif
        </div>

        <div class="pt-2">
            <x-primary-button class="w-full">
                {{ __('Log in') }}
            </x-primary-button>
        </div>

        <div class="text-center mt-6">
            <p class="text-sm text-secondary">
                Don't have an account? 
                <a href="{{ route('register') }}" class="text-primary font-bold hover:underline">
                    Sign up
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>
