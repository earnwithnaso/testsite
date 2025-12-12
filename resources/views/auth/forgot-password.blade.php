<x-guest-layout>
    <div class="text-center mb-8">
        <h2 class="text-2xl font-bold text-primary">Reset Password</h2>
        <p class="text-secondary mt-2 text-sm">
            Enter your email to receive a password reset link.
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email Address')" class="ml-4" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2 ml-4" />
        </div>

        <div class="pt-2">
            <x-primary-button class="w-full">
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>

        <div class="text-center mt-6">
            <a href="{{ route('login') }}" class="text-sm text-secondary hover:text-primary font-medium hover:underline">
                &larr; Back to Login
            </a>
        </div>
    </form>
</x-guest-layout>
