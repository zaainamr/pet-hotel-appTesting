<x-app-layout>
    <div class="space-y-6">
            <!-- Hero Welcome Card with Illustration -->
            <div class="relative overflow-hidden bg-gradient-to-br from-pink-500 via-purple-500 to-indigo-600 rounded-3xl shadow-2xl mb-8 transform hover:scale-[1.02] transition-all duration-300">
                <div class="absolute inset-0 bg-black opacity-10"></div>
                <div class="absolute top-0 right-0 -mt-4 -mr-4 w-64 h-64 bg-white opacity-10 rounded-full blur-3xl"></div>
                <div class="absolute bottom-0 left-0 -mb-4 -ml-4 w-64 h-64 bg-yellow-300 opacity-10 rounded-full blur-3xl"></div>
                
                <div class="relative p-8 md:p-12">
                    <div class="flex flex-col md:flex-row items-center justify-between">
                        <div class="text-white mb-6 md:mb-0">
                            <h1 class="text-4xl md:text-5xl font-extrabold mb-3 animate-fade-in">
                                {{ __('messages.customer_dashboard_welcome', ['name' => Auth::user()->name]) }}
                            </h1>
                            <p class="text-xl text-white/90 mb-6">{{ __('messages.customer_dashboard_subtitle') }}</p>
                            <a href="{{ route('customer.rooms') }}" class="inline-flex items-center px-8 py-4 bg-white text-purple-600 rounded-full font-bold text-lg shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-200">
                                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                {{ __('messages.book_a_room_now') }}
                            </a>
                        </div>
                        <div class="hidden md:block">
                            <svg class="w-64 h-64 text-white/20" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-1-13h2v6h-2zm0 8h2v2h-2z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Cards with Gradient Backgrounds -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- My Pets Card -->
                <div class="group relative overflow-hidden bg-gradient-to-br from-pink-400 to-pink-600 rounded-2xl shadow-lg hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300">
                    <div class="absolute inset-0 bg-white opacity-0 group-hover:opacity-10 transition-opacity"></div>
                    <div class="relative p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="p-3 bg-white/20 rounded-xl backdrop-blur-sm">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <a href="{{ route('customer.pets.index') }}" class="text-white/80 hover:text-white">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                        <p class="text-white/90 text-sm font-medium mb-1">{{ __('messages.my_pets') }}</p>
                        <p class="text-white text-4xl font-bold">{{ $myPets }}</p>
                    </div>
                </div>

                <!-- My Bookings Card -->
                <div class="group relative overflow-hidden bg-gradient-to-br from-purple-400 to-purple-600 rounded-2xl shadow-lg hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300">
                    <div class="absolute inset-0 bg-white opacity-0 group-hover:opacity-10 transition-opacity"></div>
                    <div class="relative p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="p-3 bg-white/20 rounded-xl backdrop-blur-sm">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <a href="{{ route('customer.bookings') }}" class="text-white/80 hover:text-white">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                        <p class="text-white/90 text-sm font-medium mb-1">{{ __('messages.my_bookings') }}</p>
                        <p class="text-white text-4xl font-bold">{{ $myBookings }}</p>
                    </div>
                </div>

                <!-- Messages Card -->
                <div class="group relative overflow-hidden bg-gradient-to-br from-indigo-400 to-indigo-600 rounded-2xl shadow-lg hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300">
                    <div class="absolute inset-0 bg-white opacity-0 group-hover:opacity-10 transition-opacity"></div>
                    <div class="relative p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="p-3 bg-white/20 rounded-xl backdrop-blur-sm">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                </svg>
                            </div>
                            <a href="{{ route('customer.messages.index') }}" class="text-white/80 hover:text-white">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                        <p class="text-white/90 text-sm font-medium mb-1">{{ __('messages.messages') }}</p>
                        <p class="text-white text-4xl font-bold">
                            {{ \App\Models\Message::where('receiver_id', Auth::id())->whereNull('read_at')->count() }}
                        </p>
                    </div>
                </div>

                <!-- Invoices Card -->
                <div class="group relative overflow-hidden bg-gradient-to-br from-yellow-400 to-orange-500 rounded-2xl shadow-lg hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300">
                    <div class="absolute inset-0 bg-white opacity-0 group-hover:opacity-10 transition-opacity"></div>
                    <div class="relative p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="p-3 bg-white/20 rounded-xl backdrop-blur-sm">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <a href="{{ route('customer.invoices.index') }}" class="text-white/80 hover:text-white">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                        <p class="text-white/90 text-sm font-medium mb-1">{{ __('messages.invoices') }}</p>
                        <p class="text-white text-4xl font-bold">
                            @php
                                $owner = \App\Models\Owner::where('email', Auth::user()->email)->first();
                                $invoiceCount = $owner ? \App\Models\Invoice::whereHas('booking', function($q) use ($owner) {
                                    $q->where('owner_id', $owner->id);
                                })->count() : 0;
                            @endphp
                            {{ $invoiceCount }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Quick Actions Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                <!-- Book a Room -->
                <a href="{{ route('customer.rooms') }}" class="group relative overflow-hidden bg-white rounded-2xl shadow-lg hover:shadow-2xl transform hover:-translate-y-1 transition-all duration-300">
                    <div class="absolute inset-0 bg-gradient-to-br from-pink-500 to-purple-600 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    <div class="relative p-8">
                        <div class="flex items-center mb-4">
                            <div class="p-4 bg-gradient-to-br from-pink-100 to-purple-100 rounded-2xl group-hover:bg-white/20 transition-colors">
                                <svg class="w-10 h-10 text-pink-600 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 group-hover:text-white mb-2 transition-colors">{{ __('messages.book_a_room') }}</h3>
                        <p class="text-gray-600 group-hover:text-white/90 transition-colors">{{ __('messages.find_perfect_room') }}</p>
                    </div>
                </a>

                <!-- Manage Pets -->
                <a href="{{ route('customer.pets.index') }}" class="group relative overflow-hidden bg-white rounded-2xl shadow-lg hover:shadow-2xl transform hover:-translate-y-1 transition-all duration-300">
                    <div class="absolute inset-0 bg-gradient-to-br from-indigo-500 to-blue-600 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    <div class="relative p-8">
                        <div class="flex items-center mb-4">
                            <div class="p-4 bg-gradient-to-br from-indigo-100 to-blue-100 rounded-2xl group-hover:bg-white/20 transition-colors">
                                <svg class="w-10 h-10 text-indigo-600 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 group-hover:text-white mb-2 transition-colors">{{ __('messages.manage_pets') }}</h3>
                        <p class="text-gray-600 group-hover:text-white/90 transition-colors">{{ __('messages.manage_pets_desc') }}</p>
                    </div>
                </a>

                <!-- My Profile -->
                <a href="{{ route('customer.profile') }}" class="group relative overflow-hidden bg-white rounded-2xl shadow-lg hover:shadow-2xl transform hover:-translate-y-1 transition-all duration-300">
                    <div class="absolute inset-0 bg-gradient-to-br from-yellow-400 to-orange-500 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    <div class="relative p-8">
                        <div class="flex items-center mb-4">
                            <div class="p-4 bg-gradient-to-br from-yellow-100 to-orange-100 rounded-2xl group-hover:bg-white/20 transition-colors">
                                <svg class="w-10 h-10 text-yellow-600 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 group-hover:text-white mb-2 transition-colors">{{ __('messages.my_profile') }}</h3>
                        <p class="text-gray-600 group-hover:text-white/90 transition-colors">{{ __('messages.my_profile_desc') }}</p>
                    </div>
                </a>
            </div>

            <!-- Recent Bookings -->
            @if($recentBookings->count() > 0)
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-pink-500 to-purple-600 p-6">
                    <h3 class="text-2xl font-bold text-white flex items-center">
                        <svg class="w-7 h-7 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        {{ __('messages.recent_bookings') }}
                    </h3>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        @foreach($recentBookings as $booking)
                        <div class="group flex items-center justify-between p-5 bg-gradient-to-r from-gray-50 to-gray-100 rounded-xl hover:from-pink-50 hover:to-purple-50 transition-all duration-300 border border-gray-200 hover:border-pink-300">
                            <div class="flex items-center space-x-4">
                                <div class="p-3 bg-white rounded-xl shadow-sm group-hover:shadow-md transition-shadow">
                                    <svg class="w-8 h-8 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-bold text-lg text-gray-900">{{ $booking->pet->name }}</p>
                                    <p class="text-sm text-gray-600 flex items-center mt-1">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        {{ \Carbon\Carbon::parse($booking->start_date)->format('M d') }} - {{ \Carbon\Carbon::parse($booking->end_date)->format('M d, Y') }}
                                    </p>
                                </div>
                            </div>
                            <span class="px-4 py-2 rounded-full text-sm font-bold shadow-sm {{ $booking->status == 'confirmed' ? 'bg-green-100 text-green-700' : ($booking->status == 'pending' ? 'bg-yellow-100 text-yellow-700' : 'bg-gray-100 text-gray-700') }}">
                                {{ __('messages.' . $booking->status) }}
                            </span>
                        </div>
                        @endforeach
                    </div>
                    <div class="mt-6 text-center">
                        <a href="{{ route('customer.bookings') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-pink-500 to-purple-600 text-white font-semibold rounded-full hover:from-pink-600 hover:to-purple-700 transform hover:scale-105 transition-all duration-200 shadow-lg">
                            {{ __('messages.view_all_bookings') }}
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            @else
            <!-- Empty State -->
            <div class="bg-white rounded-2xl shadow-lg p-12 text-center">
                <div class="max-w-md mx-auto">
                    <div class="mb-6">
                        <svg class="w-24 h-24 mx-auto text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">{{ __('messages.no_bookings_yet_customer') }}</h3>
                    <p class="text-gray-600 mb-6">{{ __('messages.no_bookings_yet_desc') }}</p>
                    <a href="{{ route('customer.rooms') }}" class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-pink-500 to-purple-600 text-white font-bold rounded-full hover:from-pink-600 hover:to-purple-700 transform hover:scale-105 transition-all duration-200 shadow-lg">
                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        {{ __('messages.book_first_room') }}
                    </a>
                </div>
            </div>
            @endif
    </div>
</x-app-layout>
