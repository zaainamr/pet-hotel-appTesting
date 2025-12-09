<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Pet Hotel') }} - Admin</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gradient-to-br from-pink-50 to-yellow-50 flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-lg flex-shrink-0">
            <!-- Logo -->
            <div class="h-[73px] px-6 flex items-center gap-3 border-b border-gray-200">
                <img src="{{ asset('image/logo-pethotel.svg') }}" alt="Pet Hotel Logo" class="h-10">
                <span class="text-xl font-semibold text-gray-800">Pet Hotel</span>
            </div>

            <!-- Navigation Menu -->
            <nav class="p-4 space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg transition {{ request()->routeIs('admin.dashboard') ? 'bg-gradient-to-r from-pink-400 to-yellow-300 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                    </svg>
                    <span class="font-medium">{{ __('navigation.dashboard') }}</span>
                </a>

                <a href="{{ route('owners.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg transition {{ request()->routeIs('owners.*') ? 'bg-gradient-to-r from-pink-400 to-yellow-300 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    <span class="font-medium">{{ __('navigation.owners') }}</span>
                </a>

                <a href="{{ route('pets.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg transition {{ request()->routeIs('pets.*') ? 'bg-gradient-to-r from-pink-400 to-yellow-300 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2.5 5.5c.83 0 1.5.67 1.5 1.5s-.67 1.5-1.5 1.5S7 9.83 7 9s.67-1.5 1.5-1.5zm5 0c.83 0 1.5.67 1.5 1.5s-.67 1.5-1.5 1.5-1.5-.67-1.5-1.5.67-1.5 1.5-1.5zm-2.5 6c-2.21 0-4 1.79-4 4h8c0-2.21-1.79-4-4-4z"/>
                    </svg>
                    <span class="font-medium">{{ __('navigation.pets') }}</span>
                </a>

                <a href="{{ route('rooms.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg transition {{ request()->routeIs('rooms.*') ? 'bg-gradient-to-r from-pink-400 to-yellow-300 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    <span class="font-medium">{{ __('navigation.rooms') }}</span>
                </a>

                <a href="{{ route('bookings.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg transition {{ request()->routeIs('bookings.*') ? 'bg-gradient-to-r from-pink-400 to-yellow-300 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <span class="font-medium">{{ __('navigation.bookings') }}</span>
                </a>

                <a href="{{ route('invoices.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg transition {{ request()->routeIs('invoices.*') ? 'bg-gradient-to-r from-pink-400 to-yellow-300 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <span class="font-medium">{{ __('navigation.invoices') }}</span>
                </a>

                <a href="{{ route('reports.bookings') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg transition {{ request()->routeIs('reports.*') ? 'bg-gradient-to-r from-pink-400 to-yellow-300 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                    <span class="font-medium">{{ __('navigation.reports') }}</span>
                </a>

                <a href="{{ route('messages.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg transition {{ request()->routeIs('messages.*') ? 'bg-gradient-to-r from-pink-400 to-yellow-300 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                    <span class="font-medium">{{ __('navigation.messages') }}</span>
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Top Header -->
            <header class="bg-white shadow-sm">
                <div class="px-6 py-4 flex items-center justify-between">
                    <button class="lg:hidden text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>

                    <div class="flex-1"></div>

                    <div class="flex items-center gap-4">
                        <!-- Language Switcher -->
                        <div class="flex items-center space-x-2">
                            <a href="{{ route('lang.switch', 'id') }}" class="text-sm font-bold {{ app()->getLocale() == 'id' ? 'text-blue-500' : 'text-gray-500' }}">ID</a>
                            <span class="text-gray-300">|</span>
                            <a href="{{ route('lang.switch', 'en') }}" class="text-sm font-bold {{ app()->getLocale() == 'en' ? 'text-blue-500' : 'text-gray-500' }}">EN</a>
                        </div>

                        <!-- Notification -->
                        <div x-data="{ open: false, count: 0, notifications: [] }" x-init="
                            // Load initial notifications
                            fetch('/api/notifications/unread-count')
                                .then(r => r.json())
                                .then(data => count = data.count);
                            
                            // Poll every 30 seconds
                            setInterval(() => {
                                fetch('/api/notifications/unread-count')
                                    .then(r => r.json())
                                    .then(data => count = data.count);
                            }, 30000);
                            
                            // Load notifications when dropdown opens
                            $watch('open', value => {
                                if (value) {
                                    fetch('/api/notifications')
                                        .then(r => r.json())
                                        .then(data => notifications = data);
                                }
                            });
                        " class="relative">
                            <button @click="open = !open" class="relative text-gray-600 hover:text-gray-800">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                                </svg>
                                <span x-show="count > 0" x-text="count" class="absolute -top-1 -right-1 w-5 h-5 bg-pink-500 text-white text-xs rounded-full flex items-center justify-center font-semibold"></span>
                            </button>

                            <!-- Notification Dropdown -->
                            <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-xl py-2 z-50 max-h-96 overflow-y-auto">
                                <div class="px-4 py-2 border-b">
                                    <h3 class="font-semibold text-gray-900">{{ __('navigation.notifications') }}</h3>
                                </div>
                                
                                <template x-if="notifications.length === 0">
                                    <div class="px-4 py-8 text-center text-gray-500">
                                        <p>{{ __('navigation.no_notifications') }}</p>
                                    </div>
                                </template>

                                <template x-for="notif in notifications" :key="notif.id">
                                    <div @click="
                                        if (!notif.read_at) {
                                            fetch(`/api/notifications/${notif.id}/read`, { method: 'POST', headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' } })
                                                .then(() => {
                                                    notif.read_at = new Date();
                                                    count = Math.max(0, count - 1);
                                                });
                                        }
                                    " class="px-4 py-3 hover:bg-gray-50 cursor-pointer border-b" :class="!notif.read_at ? 'bg-pink-50' : ''">
                                        <div class="flex items-start gap-3">
                                            <div class="w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0" :class="{
                                                'bg-pink-100 text-pink-600': notif.type === 'booking_created',
                                                'bg-green-100 text-green-600': notif.type === 'payment_received',
                                                'bg-blue-100 text-blue-600': notif.type === 'message_received'
                                            }">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                                                </svg>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <p class="text-sm font-semibold text-gray-900" x-text="notif.title"></p>
                                                <p class="text-sm text-gray-600 truncate" x-text="notif.message"></p>
                                                <p class="text-xs text-gray-400 mt-1" x-text="new Date(notif.created_at).toLocaleString()"></p>
                                            </div>
                                            <template x-if="!notif.read_at">
                                                <div class="w-2 h-2 bg-pink-500 rounded-full flex-shrink-0"></div>
                                            </template>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>

                        <!-- Profile -->
                        <div x-data="{ open: false }" class="relative">
                            <button @click="open = !open" class="flex items-center gap-2">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-pink-400 to-yellow-300 flex items-center justify-center text-white font-semibold">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                                <div class="text-left hidden md:block">
                                    <p class="text-sm font-semibold text-gray-800">{{ Auth::user()->name }}</p>
                                    <p class="text-xs text-gray-500">{{ __('navigation.administrator') }}</p>
                                </div>
                            </button>

                            <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 z-50">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        {{ __('navigation.logout') }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto">
                <div class="p-6">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>
</body>
</html>
