<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="text-center mb-8">
        @if(isset($isAdmin) && $isAdmin)
            <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-primary to-primary/80 rounded-3xl mb-6 shadow-2xl shadow-primary/20 border-4 border-white">
                 <i class="hgi-stroke hgi-shield-01 text-white text-4xl"></i>
            </div>
            <h2 class="text-3xl font-black text-primary tracking-tighter">Admin Portal</h2>
            <p class="text-secondary/60 mt-2 text-sm font-medium">Authorized Personnel Only</p>
        @else
            <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-brand to-brand/80 rounded-3xl mb-6 shadow-2xl shadow-brand/10 border-4 border-white">
                 <i class="hgi-stroke hgi-mortarboard-01 text-white text-4xl"></i>
            </div>
            <h2 class="text-3xl font-black text-primary tracking-tighter capitalize">Student Portal</h2>
            <p class="text-secondary/60 mt-2 text-sm font-medium">Welcome back to your learning space</p>
        @endif
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email Address')" class="ml-4" />
            <div class="relative mt-1 group">
                <div class="absolute inset-y-0 left-0 pl-6 flex items-center pointer-events-none">
                    <i class="hgi-stroke hgi-mail-02 text-secondary/40 group-focus-within:text-primary transition-colors text-xl"></i>
                </div>
                <input id="email" class="border-soft-grey/60 focus:border-primary focus:ring-4 focus:ring-primary/5 rounded-2xl shadow-sm py-4 w-full pl-14 pr-5 transition-all text-sm font-medium placeholder:text-secondary/30" type="email" name="email" value="{{ old('email') }}" placeholder="Enter your email" required autofocus autocomplete="username" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2 ml-4" />
        </div>

        <!-- Password -->
        <div x-data="{ show: false }">
            <x-input-label for="password" :value="__('Password')" class="ml-4" />
            <div class="relative mt-1 group">
                <div class="absolute inset-y-0 left-0 pl-6 flex items-center pointer-events-none">
                    <i class="hgi-stroke hgi-lock-password text-secondary/40 group-focus-within:text-primary transition-colors text-xl"></i>
                </div>
                <input id="password" class="border-soft-grey/60 focus:border-primary focus:ring-4 focus:ring-primary/5 rounded-2xl shadow-sm py-4 w-full pl-14 pr-14 transition-all text-sm font-medium placeholder:text-secondary/30" 
                              :type="show ? 'text' : 'password'" 
                              name="password" 
                              placeholder="••••••••"
                              required autocomplete="current-password" />
                <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-6 flex items-center text-secondary/40 hover:text-primary transition-colors focus:outline-none">
                    <i class="hgi-stroke text-xl transition-transform active:scale-90" :class="show ? 'hgi-view-off-01' : 'hgi-view'"></i>
                </button>
            </div>
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
            <x-primary-button class="w-full justify-center gap-2 py-4">
                <span>{{ __('Log in') }}</span>
                <i class="hgi-stroke hgi-login-03 text-lg"></i>
            </x-primary-button>
        </div>

        <div class="text-center mt-6">
            @if(isset($isAdmin) && $isAdmin)
                <p class="text-sm text-secondary">
                    Not an admin? 
                    <a href="{{ route('login') }}" class="text-primary font-bold hover:underline">
                        Student Login
                    </a>
                </p>
            @else
                <p class="text-sm text-secondary">
                    Don't have an account? 
                    <a href="{{ route('register') }}" class="text-primary font-bold hover:underline">
                        Sign up
                    </a>
                </p>
            @endif
        </div>
    </form>
</x-guest-layout>
