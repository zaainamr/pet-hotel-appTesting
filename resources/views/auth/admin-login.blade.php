<x-auth-layout>
    <div class="min-h-screen flex items-center justify-center gradient-bg px-4">
        <!-- Back to Home Button -->
        <div class="absolute top-6 left-6 z-10">
            <a href="{{ url('/') }}"
               class="inline-flex items-center justify-center bg-white text-gray-800 w-10 h-10 rounded-full shadow-lg hover:shadow-xl transition-shadow">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
        </div>

        <div class="w-full max-w-md bg-white/70 backdrop-blur-xl rounded-2xl shadow-2xl p-8 space-y-6">
            <div class="text-center space-y-3">
                <x-application-logo class="w-20 h-20 mx-auto" />
                <h2 class="text-3xl font-bold text-gray-900">{{ __('messages.admin_login_welcome') }}</h2>
                <p class="text-gray-600">{{ __('messages.admin_login_subtitle') }}</p>
            </div>

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form class="space-y-6" method="POST" action="{{ route('admin.login') }}" autocomplete="off">
                @csrf

                <div class="relative">
                    <label for="email" class="sr-only">{{ __('messages.form_email') }}</label>
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <input id="email" name="email" type="email" required autocomplete="nope" placeholder="{{ __('messages.form_email_placeholder') }}" class="form-input-icon w-full py-3 rounded-xl">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="relative">
                    <label for="password" class="sr-only">{{ __('messages.form_password') }}</label>
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </div>
                    <input id="password" name="password" type="password" required autocomplete="new-password" placeholder="{{ __('messages.form_password_placeholder') }}" class="form-input-icon w-full py-3 rounded-xl pr-12">
                    <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 px-4 flex items-center text-gray-400 hover:text-gray-600">
                        <svg id="eyeIcon" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        <svg id="eyeOffIcon" class="h-5 w-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7 1.274-4.057 5.064-7 9.542-7 .847 0 1.67.111 2.458.315M15 12a3 3 0 11-6 0 3 3 0 016 0zm6 3l-2.647-2.646M3 3l18 18"/></svg>
                    </button>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember-me" name="remember" type="checkbox" class="form-checkbox">
                        <label for="remember-me" class="ml-2 block text-sm text-gray-700">{{ __('messages.form_remember_me') }}</label>
                    </div>

                    @if (Route::has('password.request'))
                        <div class="text-sm">
                            <a href="{{ route('password.request') }}" class="text-link">{{ __('messages.form_forgot_password') }}</a>
                        </div>
                    @endif
                </div>

                <div>
                    <button type="submit" class="btn-gradient w-full flex justify-center py-3 px-4 rounded-xl shadow-lg text-sm font-medium transition-all duration-300 transform hover:scale-105">
                        {{ __('messages.form_sign_in') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');
        const eyeOffIcon = document.getElementById('eyeOffIcon');

        if (togglePassword && passwordInput) {
            togglePassword.addEventListener('click', function () {
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
    });
</script>
@endpush
</x-auth-layout>
