<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Customer Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Card -->
            <div class="bg-gradient-to-r from-pink-400 to-purple-400 overflow-hidden shadow-xl sm:rounded-lg mb-6">
                <div class="p-8 text-white">
                    <h3 class="text-2xl font-bold mb-2">Welcome back, {{ Auth::user()->name }}!</h3>
                    <p class="text-lg">Manage your pet's bookings and profile</p>
                </div>
            </div>

            <!-- Info Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <!-- My Bookings -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm text-gray-600">My Bookings</p>
                                <p class="text-2xl font-semibold text-gray-800">0</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- My Pets -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm text-gray-600">My Pets</p>
                                <p class="text-2xl font-semibold text-gray-800">0</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Available Rooms -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-green-100 text-green-600">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm text-gray-600">Available Rooms</p>
                                <p class="text-2xl font-semibold text-gray-800">{{ \App\Models\Room::where('status', 'available')->count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h4 class="text-lg font-semibold mb-4">Getting Started</h4>
                    <div class="space-y-4">
                        <div class="flex items-start p-4 bg-blue-50 rounded-lg">
                            <div class="flex-shrink-0">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h5 class="text-sm font-medium text-gray-900">Welcome to Pet Hotel!</h5>
                                <p class="mt-1 text-sm text-gray-600">
                                    You can view available rooms, make bookings, and manage your pet's information from this dashboard.
                                </p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <a href="{{ route('bookings.create') }}" class="flex items-center p-4 bg-gradient-to-r from-yellow-400 to-pink-400 text-white rounded-lg hover:shadow-lg transition">
                                <svg class="w-8 h-8 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                <div>
                                    <h5 class="font-semibold">Make a Booking</h5>
                                    <p class="text-sm opacity-90">Book a room for your pet</p>
                                </div>
                            </a>

                            <a href="{{ route('rooms.index') }}" class="flex items-center p-4 bg-gradient-to-r from-purple-400 to-pink-400 text-white rounded-lg hover:shadow-lg transition">
                                <svg class="w-8 h-8 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                                <div>
                                    <h5 class="font-semibold">Browse Rooms</h5>
                                    <p class="text-sm opacity-90">View available rooms</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
