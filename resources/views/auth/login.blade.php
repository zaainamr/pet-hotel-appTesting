<x-auth-layout>
    <div class="min-h-screen lg:grid lg:grid-cols-2">
        <!-- Back to Home Button -->
        <div class="fixed top-6 left-6 z-10">
            <a href="{{ url('/') }}"
               class="inline-flex items-center justify-center bg-white text-gray-800 w-10 h-10 rounded-full shadow-lg hover:shadow-xl transition-shadow">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
        </div>

        <!-- Left Panel - Image -->
        <div class="hidden lg:block relative">
            <img src="{{ asset('image/bg-login.svg') }}" alt="Login background" class="absolute inset-0 w-full h-full object-cover object-left rounded-r-4xl">
        </div>

        <!-- Right Panel - Login Form -->
        <div class="w-full flex items-center justify-center p-8">
            <div class="w-full max-w-md">
                <!-- Logo -->
                <div class="flex justify-center mb-6">
                    <x-application-logo class="w-20 h-20" />
                </div>

                <!-- Title -->
                <h2 class="text-3xl font-bold text-center text-gray-800 mb-2">
                    {{ __('messages.app_name') }}
                </h2>
                
                <!-- Subtitle -->
                <p class="text-center text-gray-500 text-base mb-8">
                    {{ __('messages.login_title') }}
                </p>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <!-- Form -->
                <form method="POST" action="{{ $isAdmin ? route('admin.login') : route('customer.login') }}" autocomplete="off">
                    @csrf

                    <!-- Email Address -->
                    <div class="mb-5">
                        <label for="email" class="form-label mb-2">
                            {{ __('messages.form_email') }}
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <input id="email" 
                                   type="email" 
                                   name="email" 
                                   required 
                                   autofocus 
                                   autocomplete="nope"
                                   placeholder="{{ __('messages.form_email_placeholder') }}"
                                   class="form-input-icon">
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="mb-5">
                        <label for="password" class="form-label mb-2">
                            {{ __('messages.form_password') }}
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                            </div>
                            <input id="password" 
                                   type="password" 
                                   name="password" 
                                   required 
                                   autocomplete="new-password"
                                   placeholder="{{ __('messages.form_password_placeholder') }}"
                                   class="form-input-icon">
                            <div class="absolute inset-y-0 right-0 pr-4 flex items-center">
                                <button type="button" id="togglePassword" class="text-gray-400 hover:text-gray-600">
                                    <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    <svg id="eyeOffIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7 1.274-4.057 5.064-7 9.542-7 .847 0 1.67.127 2.454.364M18.408 15.851A9.942 9.942 0 0112 13.5a9.942 9.942 0 01-6.408-2.351M12 9.5a2.5 2.5 0 00-2.5 2.5M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="flex items-center justify-between mb-6">
                        <label class="flex items-center">
                            <input type="checkbox" 
                                   name="remember" 
                                   class="form-checkbox">
                            <span class="ml-2 text-sm text-gray-600">{{ __('messages.form_remember_me') }}</span>
                        </label>
                        
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" 
                               class="text-link">
                                {{ __('messages.form_forgot_password') }}
                            </a>
                        @endif
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" 
                            class="btn-gradient w-full">
                        {{ __('messages.form_sign_in') }}
                    </button>

                    <!-- Register Link -->
                    @if(!$isAdmin)
                    <div class="mt-6 text-center">
                        <span class="text-sm text-gray-600">{{ __('messages.form_no_account') }}</span>
                        <a href="{{ route('customer.register') }}" 
                           class="text-link ml-1">
                            {{ __('messages.form_sign_up') }}
                        </a>
                    </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
@push('scripts')
<script>
    document.getElementById('togglePassword').addEventListener('click', function () {
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');
        const eyeOffIcon = document.getElementById('eyeOffIcon');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeIcon.classList.add('hidden');
            eyeOffIcon.classList.remove('hidden');
        } else {
            passwordInput.type = 'password';
            eyeIcon.classList.remove('hidden');
            eyeOffIcon.classList.add('hidden');
        }
    });
</script>
@endpush
</x-auth-layout>
