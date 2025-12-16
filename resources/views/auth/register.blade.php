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

        <!-- Left Panel - Register Form -->
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
                    {{ $isAdmin ? __('messages.register_admin_title') : __('messages.register_customer_title') }}
                </p>

                <!-- Form -->
                <form method="POST" action="{{ $isAdmin ? route('admin.register') : route('customer.register') }}" autocomplete="off">
                    @csrf

                    <!-- Name -->
                    <div class="mb-5">
                        <label for="name" class="form-label mb-2">
                            {{ __('messages.form_full_name') }}
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <input id="name" 
                                   type="text" 
                                   name="name" 
                                   required 
                                   autofocus 
                                   autocomplete="nope"
                                   placeholder="{{ __('messages.form_full_name_placeholder') }}"
                                   class="form-input-icon">
                        </div>
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

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
                                   class="form-input-icon pr-12">
                            <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 px-4 flex items-center text-gray-400 hover:text-gray-600">
                                <svg id="eyeIcon" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                <svg id="eyeOffIcon" class="h-5 w-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7 1.274-4.057 5.064-7 9.542-7 .847 0 1.67.111 2.458.315M15 12a3 3 0 11-6 0 3 3 0 016 0zm6 3l-2.647-2.646M3 3l18 18"/></svg>
                            </button>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-6">
                        <label for="password_confirmation" class="form-label mb-2">
                            {{ __('messages.form_confirm_password') }}
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                </svg>
                            </div>
                            <input id="password_confirmation" 
                                   type="password" 
                                   name="password_confirmation" 
                                   required 
                                   autocomplete="new-password"
                                   placeholder="{{ __('messages.form_password_placeholder') }}"
                                   class="form-input-icon pr-12">
                            <button type="button" id="togglePasswordConfirmation" class="absolute inset-y-0 right-0 px-4 flex items-center text-gray-400 hover:text-gray-600">
                                <svg id="eyeIconConfirmation" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                <svg id="eyeOffIconConfirmation" class="h-5 w-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7 1.274-4.057 5.064-7 9.542-7 .847 0 1.67.111 2.458.315M15 12a3 3 0 11-6 0 3 3 0 016 0zm6 3l-2.647-2.646M3 3l18 18"/></svg>
                            </button>
                        </div>
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" 
                            class="btn-gradient w-full">
                        {{ __('messages.form_create_account') }}
                    </button>

                    <!-- Login Link -->
                    <div class="mt-6 text-center">
                        <span class="text-sm text-gray-600">{{ __('messages.form_have_account') }}</span>
                        <a href="{{ $isAdmin ? route('admin.login') : route('customer.login') }}" 
                           class="text-link ml-1">
                            {{ __('messages.form_sign_in') }}
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Right Panel - Image -->
        <div class="hidden lg:block relative">
            <img src="{{ asset('image/bg-regist.svg') }}" alt="Register background" class="absolute inset-0 w-full h-full object-cover object-right rounded-l-4xl">
        </div>
    </div>
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        function setupPasswordToggle(toggleBtnId, passwordInputId, eyeIconId, eyeOffIconId) {
            const toggleBtn = document.getElementById(toggleBtnId);
            const passwordInput = document.getElementById(passwordInputId);
            const eyeIcon = document.getElementById(eyeIconId);
            const eyeOffIcon = document.getElementById(eyeOffIconId);

            if (toggleBtn && passwordInput) {
                toggleBtn.addEventListener('click', function () {
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
            }
        }

        setupPasswordToggle('togglePassword', 'password', 'eyeIcon', 'eyeOffIcon');
        setupPasswordToggle('togglePasswordConfirmation', 'password_confirmation', 'eyeIconConfirmation', 'eyeOffIconConfirmation');
    });
</script>
@endpush
</x-auth-layout>
