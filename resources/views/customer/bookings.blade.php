<x-app-layout>
    <div class="space-y-6">
        <!-- Page Title -->
        <div>
            <h1 class="text-3xl font-bold text-gray-900">{{ __('messages.my_bookings') }}</h1>
            <p class="text-gray-600 mt-1">{{ __('messages.booking_history') }}</p>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg"><span>{{ session('success') }}</span></div>
        @endif

        <!-- Bookings List -->
        <div class="bg-white rounded-xl shadow-sm">
            <div class="divide-y">
                @forelse($bookings as $booking)
                    <div class="p-6 hover:bg-gray-50">
                        <div class="flex justify-between items-start">
                            <div class="flex-1">
                                <div class="flex items-center gap-3 mb-2">
                                    <h4 class="text-lg font-semibold text-gray-900">{{ $booking->pet->name }}</h4>
                                    <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $booking->status == 'confirmed' ? 'bg-green-100 text-green-800' : ($booking->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : ($booking->status == 'cancelled' ? 'bg-red-100 text-red-800' : 'bg-gray-100 text-gray-800')) }}">
                                        {{ __('messages.' . $booking->status) }}
                                    </span>
                                </div>
                                
                                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 text-sm text-gray-600">
                                    <div>
                                        <p class="font-medium text-gray-700">{{ __('messages.room') }}</p>
                                        <p>{{ $booking->room ? $booking->room->code : __('messages.not_assigned') }}</p>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-700">{{ __('messages.dates') }}</p>
                                        <p>{{ \Carbon\Carbon::parse($booking->start_date)->translatedFormat('l, d F Y') }} to {{ \Carbon\Carbon::parse($booking->end_date)->translatedFormat('l, d F Y') }}</p>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-700">{{ __('messages.total_price') }}</p>
                                        <p class="text-primary font-semibold">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</p>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-700">{{ __('messages.payment') }}</p>
                                        @if($booking->invoice)
                                            <p class="{{ $booking->invoice->paid ? 'text-green-600' : 'text-yellow-600' }} font-semibold">
                                                {{ $booking->invoice->paid ? __('messages.paid') : __('messages.unpaid') }}
                                            </p>
                                        @else
                                            <p class="text-gray-500">{{ __('messages.no_invoice') }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-16">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                        <p class="mt-4 text-gray-500">{{ __('messages.no_bookings_yet') }}</p>
                        <a href="{{ route('customer.rooms') }}" class="btn-gradient mt-4 inline-block">{{ __('messages.book_a_room') }}</a>
                    </div>
                @endforelse
            </div>

            @if($bookings->hasPages())
                <div class="p-6 bg-gray-50 rounded-b-xl border-t">
                    {{ $bookings->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
