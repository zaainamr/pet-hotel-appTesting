<x-layout.admin>
    <div class="space-y-6">
        <!-- Page Title -->
        <div>
            <h1 class="text-3xl font-bold text-gray-900">{{ __('messages.admin_dashboard_title') }}</h1>
            <p class="text-gray-600 mt-1">{{ __('messages.admin_dashboard_welcome') }}</p>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Total Owners -->
            <div class="bg-white rounded-xl shadow-sm p-6">
                <div class="flex items-start justify-between">
                    <div>
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-primary to-green-500 flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <p class="text-sm text-gray-600 mb-1">{{ __('messages.total_owners') }}</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $totalOwners }}</p>
                    </div>
                    <span class="text-sm font-semibold text-green-600">+12%</span>
                </div>
            </div>

            <!-- Total Pets -->
            <div class="bg-white rounded-xl shadow-sm p-6">
                <div class="flex items-start justify-between">
                    <div>
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-secondary to-yellow-500 flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <p class="text-sm text-gray-600 mb-1">{{ __('messages.total_pets') }}</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $totalPets }}</p>
                    </div>
                    <span class="text-sm font-semibold text-green-600">+18%</span>
                </div>
            </div>

            <!-- Available Rooms -->
            <div class="bg-white rounded-xl shadow-sm p-6">
                <div class="flex items-start justify-between">
                    <div>
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-teal-400 to-cyan-500 flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                        </div>
                        <p class="text-sm text-gray-600 mb-1">{{ __('messages.available_rooms') }}</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $availableRooms }}</p>
                    </div>
                    <span class="text-sm font-semibold text-red-600">-5%</span>
                </div>
            </div>

            <!-- Monthly Revenue -->
            <div class="bg-white rounded-xl shadow-sm p-6">
                <div class="flex items-start justify-between">
                    <div>
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-green-400 to-teal-500 flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <p class="text-sm text-gray-600 mb-1">{{ __('messages.monthly_revenue') }}</p>
                        <p class="text-3xl font-bold text-gray-900">Rp{{ format_large_number($monthlyRevenue) }}</p>
                    </div>
                    <span class="text-sm font-semibold text-green-600">+24%</span>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- New Booking -->
            <a href="{{ route('bookings.create') }}" class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-primary to-green-500 flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-1">{{ __('messages.new_booking') }}</h3>
                <p class="text-sm text-gray-600">{{ __('messages.create_reservation') }}</p>
            </a>

            <!-- Add Owner -->
            <a href="{{ route('owners.create') }}" class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-secondary to-yellow-500 flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-1">{{ __('messages.add_owner') }}</h3>
                <p class="text-sm text-gray-600">{{ __('messages.register_customer') }}</p>
            </a>

            <!-- View Reports -->
            <a href="{{ route('reports.bookings') }}" class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-teal-400 to-cyan-500 flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-1">{{ __('messages.view_reports') }}</h3>
                <p class="text-sm text-gray-600">{{ __('messages.analyze_metrics') }}</p>
            </a>
        </div>

        <!-- Latest Bookings -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <div class="p-6 border-b">
                <h2 class="text-xl font-bold text-gray-900">{{ __('messages.latest_bookings') }}</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gradient-to-r from-primary to-green-600">
                            <th class="px-6 py-4 text-left text-sm font-semibold text-white">{{ __('messages.booking_id') }}</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-white">{{ __('messages.owner') }}</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-white">{{ __('messages.pet') }}</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-white">{{ __('messages.room') }}</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-white">{{ __('messages.check_in') }}</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-white">{{ __('messages.check_out') }}</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-white">{{ __('messages.status') }}</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-white">{{ __('messages.amount') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($latestBookings as $booking)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm text-gray-900">#{{ $booking->id }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $booking->pet->owner->name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $booking->pet->name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $booking->room ? $booking->room->code : '-' }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ \Carbon\Carbon::parse($booking->start_date)->translatedFormat('l, d F Y') }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ \Carbon\Carbon::parse($booking->end_date)->translatedFormat('l, d F Y') }}</td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $booking->status == 'confirmed' ? 'bg-green-100 text-green-800' : ($booking->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800') }}">
                                    {{ ucfirst($booking->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm font-semibold text-gray-900">Rp{{ format_large_number($booking->total_price) }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="px-6 py-8 text-center text-gray-500">{{ __('messages.no_bookings_yet') }}</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layout.admin>
