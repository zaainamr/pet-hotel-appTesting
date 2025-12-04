<x-auth-layout>
    <div class="min-h-screen flex gradient-bg">
        <!-- Left Panel - Pet Image & Welcome -->
        <div class="hidden lg:flex lg:w-1/2 items-center justify-center p-12">
            <div class="text-center max-w-sm">
                <!-- Pet Image -->
                <div class="mb-8 flex justify-center">
                    <img src="https://images.unsplash.com/photo-1568572933382-74d440642117?w=400&h=400&fit=crop" 
                         alt="Border Collie" 
                         class="w-80 h-80 rounded-3xl object-cover shadow-2xl">
                </div>
                
                <!-- Welcome Text -->
                <h1 class="text-4xl font-bold text-gray-800 mb-3">
                    Welcome Back!
                </h1>
                
                <!-- Subtitle -->
                <p class="text-gray-600 text-lg">
                    Your pet's home away from home
                </p>
            </div>
        </div>

        <!-- Right Panel - Login Form -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 bg-white">
            <div class="w-full max-w-md">
                <!-- Gradient Icon -->
                <div class="flex justify-center mb-6">
                    <div class="w-16 h-16 rounded-2xl flex items-center justify-center shadow-lg"
                         style="background: linear-gradient(135deg, #FFB6C9 0%, #FFE489 100%);">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>

                <!-- Title -->
                <h2 class="text-3xl font-bold text-center text-gray-800 mb-2">
                    Pet Hotel
                </h2>
                
                <!-- Subtitle -->
                <p class="text-center text-gray-500 text-base mb-8">
                    Sign in to your account
                </p>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <!-- Form -->
                <form method="POST" action="{{ $isAdmin ? route('admin.login') : route('customer.login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="mb-5">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                            Email Address
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
                                   value="{{ old('email') }}" 
                                   required 
                                   autofocus 
                                   autocomplete="username"
                                   placeholder="your@email.com"
                                   class="input-field w-full pl-12 pr-4 py-3.5 text-sm border border-gray-300 rounded-xl focus:outline-none bg-gray-50">
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="mb-5">
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                            Password
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
                                   autocomplete="current-password"
                                   placeholder="••••••••"
                                   class="input-field w-full pl-12 pr-4 py-3.5 text-sm border border-gray-300 rounded-xl focus:outline-none bg-gray-50">
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="flex items-center justify-between mb-6">
                        <label class="flex items-center">
                            <input type="checkbox" 
                                   name="remember" 
                                   class="rounded border-gray-300 text-pink-400 shadow-sm focus:ring-pink-300 w-4 h-4">
                            <span class="ml-2 text-sm text-gray-600">Remember me</span>
                        </label>
                        
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" 
                               class="text-sm font-medium hover:underline"
                               style="color: #FFB6C9;">
                                Forgot password?
                            </a>
                        @endif
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" 
                            class="gradient-button w-full py-3.5 rounded-xl text-white font-semibold text-base shadow-lg">
                        Sign In
                    </button>

                    <!-- Register Link -->
                    @if(!$isAdmin)
                    <div class="mt-6 text-center">
                        <span class="text-sm text-gray-600">Don't have an account?</span>
                        <a href="{{ route('customer.register') }}" 
                           class="text-sm font-medium ml-1 hover:underline"
                           style="color: #FFB6C9;">
                            Sign up
                        </a>
                    </div>
                    @endif
                </form>
            </div>
        </div>

        <!-- Toggle Button -->
        <div class="fixed bottom-6 right-6 flex flex-col gap-2">
            @if(!$isAdmin)
            <a href="{{ route('admin.login') }}" 
               class="toggle-button text-gray-800 px-4 py-2 rounded-full shadow-lg hover:shadow-xl transition-shadow font-semibold text-sm"
               style="background-color: #FFE489;">
                Admin View
            </a>
            @else
            <a href="{{ route('customer.login') }}" 
               class="toggle-button text-white px-4 py-2 rounded-full shadow-lg hover:shadow-xl transition-shadow font-semibold text-sm"
               style="background-color: #FFB6C9;">
                Customer View
            </a>
            @endif
        </div>
    </div>
</x-auth-layout>
