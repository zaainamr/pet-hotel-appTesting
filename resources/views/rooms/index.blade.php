<x-layout.admin>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('messages.rooms_management') }}</h2>
    </x-slot>

    <div class="mb-6">
        <h3 class="text-2xl font-bold text-gray-900">{{ __('messages.rooms_management') }}</h3>
        <p class="text-gray-600 mt-2">{{ __('messages.all_rooms_description') }}</p>
    </div>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-semibold text-gray-800">{{ __('messages.all_rooms') }}</h3>
                <a href="{{ route('rooms.create') }}" class="btn-gradient inline-flex items-center px-4 py-2 rounded-md font-semibold text-xs text-white uppercase tracking-widest transition">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    {{ __('messages.add_new_room') }}
                </a>
            </div>

            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded"><span>{{ session('success') }}</span></div>
            @endif

            @if(session('error'))
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded"><span>{{ session('error') }}</span></div>
            @endif

            <form action="{{ route('rooms.index') }}" method="GET" class="mb-6 bg-gray-50 p-4 rounded-lg">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700">{{ __('messages.type') }}</label>
                        <select name="type" id="type" class="mt-1 block w-full form-input rounded-md shadow-sm">
                            <option value="">{{ __('messages.all_types') }}</option>
                            <option value="Standard" {{ request('type') == 'Standard' ? 'selected' : '' }}>{{ __('messages.standard') }}</option>
                            <option value="Deluxe" {{ request('type') == 'Deluxe' ? 'selected' : '' }}>{{ __('messages.deluxe') }}</option>
                            <option value="Suite" {{ request('type') == 'Suite' ? 'selected' : '' }}>{{ __('messages.suite') }}</option>
                        </select>
                    </div>
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700">{{ __('messages.status') }}</label>
                        <select name="status" id="status" class="mt-1 block w-full form-input rounded-md shadow-sm">
                            <option value="">{{ __('messages.all_statuses') }}</option>
                            <option value="available" {{ request('status') == 'available' ? 'selected' : '' }}>{{ __('messages.available') }}</option>
                            <option value="occupied" {{ request('status') == 'occupied' ? 'selected' : '' }}>{{ __('messages.occupied') }}</option>
                            <option value="penuh" {{ request('status') == 'penuh' ? 'selected' : '' }}>{{ __('messages.penuh') }}</option>
                            <option value="maintenance" {{ request('status') == 'maintenance' ? 'selected' : '' }}>{{ __('messages.maintenance') }}</option>
                        </select>
                    </div>
                    <div>
                        <button type="submit" class="btn-gradient w-full justify-center">{{ __('messages.filter') }}</button>
                    </div>
                </div>
            </form>

            <div class="overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative">
                <table class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
                    <thead>
                        <tr class="text-left">
                            <th class="bg-gray-50 sticky top-0 border-b border-gray-200 px-6 py-3 text-gray-600 font-bold tracking-wider uppercase text-xs">{{ __('messages.image') }}</th>
                            <th class="bg-gray-50 sticky top-0 border-b border-gray-200 px-6 py-3 text-gray-600 font-bold tracking-wider uppercase text-xs">{{ __('messages.room_number') }}</th>
                            <th class="bg-gray-50 sticky top-0 border-b border-gray-200 px-6 py-3 text-gray-600 font-bold tracking-wider uppercase text-xs">{{ __('messages.type') }}</th>
                            <th class="bg-gray-50 sticky top-0 border-b border-gray-200 px-6 py-3 text-gray-600 font-bold tracking-wider uppercase text-xs">{{ __('messages.price_per_night') }}</th>
                            <th class="bg-gray-50 sticky top-0 border-b border-gray-200 px-6 py-3 text-gray-600 font-bold tracking-wider uppercase text-xs">{{ __('messages.capacity') }}</th>
                            <th class="bg-gray-50 sticky top-0 border-b border-gray-200 px-6 py-3 text-gray-600 font-bold tracking-wider uppercase text-xs">{{ __('messages.status') }}</th>
                            <th class="bg-gray-50 sticky top-0 border-b border-gray-200 px-6 py-3 text-gray-600 font-bold tracking-wider uppercase text-xs">{{ __('messages.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($rooms as $room)
                            <tr class="hover:bg-gray-50">
                                <td class="border-dashed border-t border-gray-200 px-6 py-3"><img src="{{ str_starts_with($room->image, 'images/rooms') ? asset('storage/' . $room->image) : asset('image/' . basename($room->image)) }}" alt="{{ $room->code }}" class="h-10 w-10 object-cover rounded-md"></td>
                                <td class="border-dashed border-t border-gray-200 px-6 py-3"><span class="text-gray-700">{{ $room->code }}</span></td>
                                <td class="border-dashed border-t border-gray-200 px-6 py-3"><span class="text-gray-700">{{ $room->type ?? '-' }}</span></td>
                                <td class="border-dashed border-t border-gray-200 px-6 py-3"><span class="text-gray-700">Rp {{ number_format($room->rate_per_day, 0, ',', '.') }}</span></td>
                                <td class="border-dashed border-t border-gray-200 px-6 py-3"><span class="text-gray-700">{{ $room->capacity }}</span></td>
                                <td class="border-dashed border-t border-gray-200 px-6 py-3">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $room->status == 'available' ? 'bg-green-100 text-green-800' : ($room->status == 'occupied' || $room->status == 'penuh' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                        {{ ucfirst(__("messages.$room->status")) }}
                                    </span>
                                </td>
                                <td class="border-dashed border-t border-gray-200 px-6 py-3">
                                    <a href="{{ route('rooms.edit', $room) }}" class="text-primary hover:text-green-700">{{ __('messages.edit') }}</a>
                                    <form action="{{ route('rooms.destroy', $room) }}" method="POST" class="inline-block" onsubmit="return confirm('{{ __('messages.delete_room_confirmation') }}');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">{{ __('messages.delete') }}</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="7" class="text-center py-10 px-4 text-sm text-gray-400">{{ __('messages.no_rooms_found') }}</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4">{{ $rooms->links() }}</div>
        </div>
    </div>
</x-layout.admin>
