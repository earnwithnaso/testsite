<x-guest-layout>
    <div class="text-center mb-8">
        <h2 class="text-2xl font-bold text-primary">Create Account</h2>
        <p class="text-secondary mt-2 text-sm">Join us and start learning today</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Full Name')" class="ml-4" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2 ml-4" />
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email Address')" class="ml-4" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 ml-4" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" class="ml-4" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 ml-4" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="ml-4" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 ml-4" />
        </div>

        <div class="pt-2">
            <x-primary-button class="w-full">
                {{ __('Create Account') }}
            </x-primary-button>
        </div>

        <div class="text-center mt-6">
            <p class="text-sm text-secondary">
                Already have an account? 
                <a href="{{ route('login') }}" class="text-primary font-bold hover:underline">
                    Log in
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>
