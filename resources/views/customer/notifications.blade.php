<x-app-layout>

        <!-- Page Title -->
        <div>
            <h1 class="text-3xl font-bold text-gray-900">{{ __('navigation.notifications') }}</h1>
            <p class="text-gray-600 mt-1">{{ __('navigation.notifications_description') }}</p>
        </div>

        <!-- Notifications Card -->
        <div class="bg-white rounded-xl shadow-sm mt-6">
            <div class="p-6 border-b flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-800">{{ __('navigation.all_notifications') }}</h3>
                @if($notifications->where('read_at', null)->count() > 0)
                    <form action="{{ route('customer.notifications.markAllRead') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-sm text-pink-600 hover:text-pink-800 font-semibold">{{ __('navigation.mark_all_read') }}</button>
                    </form>
                @endif
            </div>

            <div class="divide-y">
                @forelse($notifications as $notification)
                    <div class="p-6 {{ $notification->read_at ? 'bg-white' : 'bg-pink-50' }}">
                        <div class="flex items-start justify-between">
                            <div class="flex items-start gap-4">
                                <div class="w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0 text-white {{ 
                                    match($notification->type) {
                                        'booking_confirmed' => 'bg-green-500',
                                        'booking_cancelled' => 'bg-red-500',
                                        'payment_received' => 'bg-blue-500',
                                        default => 'bg-gray-500',
                                    }
                                }}">
                                    @if($notification->type == 'booking_confirmed')
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    @elseif($notification->type == 'booking_cancelled')
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    @elseif($notification->type == 'payment_received')
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                    @else
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    @endif
                                </div>
                                <div class="flex-1">
                                    <h4 class="font-semibold text-gray-900">{{ __($notification->title) }}</h4>
                                    <p class="text-sm text-gray-600 mb-2">{{ __($notification->message, ['invoice_id' => json_decode($notification->data)->invoice_id ?? 'N/A']) }}</p>
                                    <p class="text-xs text-gray-400">{{ $notification->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                            @if(!$notification->read_at)
                                <form action="{{ route('customer.notifications.markRead', $notification) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="text-xs text-pink-600 hover:text-pink-800 ml-4 font-semibold">{{ __('navigation.mark_as_read') }}</button>
                                </form>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="text-center py-16">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                        </svg>
                        <p class="mt-4 text-gray-500">{{ __('navigation.no_notifications') }}</p>
                    </div>
                @endforelse
            </div>

            @if($notifications->hasPages())
                <div class="p-6 bg-gray-50 rounded-b-xl border-t">
                    {{ $notifications->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
