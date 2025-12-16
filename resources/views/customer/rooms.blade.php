<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('messages.available_rooms') }}</h2></x-slot>
    <div class="space-y-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">{{ __('messages.book_room_for_pet') }}</h1>
                <p class="text-gray-600 mt-1">{{ __('messages.choose_from_available') }}</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @forelse($rooms as $room)
                <div class="relative bg-white rounded-lg shadow-lg overflow-hidden transition @if($room->status !== 'available') bg-gray-200 @else hover:shadow-xl @endif">
                    <div class="relative">
                        <img src="{{ str_starts_with($room->image, 'images/rooms') ? asset('storage/' . $room->image) : asset('image/' . basename($room->image)) }}" alt="{{ $room->code }}" class="w-full object-cover aspect-[4/3] @if($room->status !== 'available') opacity-50 @endif">
                        @if($room->status !== 'available')
                            <div class="absolute top-2 right-2 bg-gray-800 bg-opacity-70 text-white text-xs font-bold px-3 py-1 rounded-full uppercase">
                                {{ __('messages.' . $room->status) }}
                            </div>
                        @endif
                    </div>
                    <div class="p-6">
                        <h4 class="text-xl font-bold text-gray-900 mb-2">{{ __('messages.room') }} {{ $room->code }}</h4>
                        <p class="text-gray-600 mb-4">{{ $room->type ? __('messages.' . strtolower($room->type)) : __('messages.standard') }}</p>
                        
                        <div class="space-y-2 mb-4">
                            <div class="flex items-center text-sm text-gray-600">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                {{ __('messages.capacity_pets', ['count' => $room->capacity]) }}
                            </div>
                            <div class="flex items-center text-sm text-gray-600">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                Rp {{ number_format($room->rate_per_day, 0, ',', '.') }}{{ __('messages.per_day') }}
                            </div>
                        </div>

                        @if($room->status === 'available')
                            <a href="{{ route('customer.book', $room) }}" class="btn-gradient block w-full text-center">
                                {{ __('messages.book_now') }}
                            </a>
                        @else
                            <div class="bg-gray-300 text-gray-500 font-bold py-2 px-4 rounded-lg text-center cursor-not-allowed">
                                {{ __('messages.' . $room->status) }}
                            </div>
                        @endif
                    </div>
                </div>
                @empty
                <div class="col-span-3 text-center py-12">
                    <p class="text-gray-500">{{ __('messages.no_rooms_available') }}</p>
                </div>
                @endforelse
            </div>
    </div>
</x-app-layout>
