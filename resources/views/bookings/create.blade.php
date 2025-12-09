<x-layout.admin>
    <div class="space-y-6">
        <!-- Page Title -->
        <div>
            <h1 class="text-3xl font-bold text-gray-900">{{ __('messages.create_new_booking') }}</h1>
            <p class="text-gray-600 mt-1">{{ __('messages.create_reservation') }}</p>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-xl shadow-sm p-6">
            <form action="{{ route('bookings.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Pet -->
                    <div>
                        <label for="pet_id" class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.pet') }} *</label>
                        <select name="pet_id" id="pet_id" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 @error('pet_id') border-red-500 @enderror">
                            <option value="">{{ __('messages.select_pet') }}</option>
                            @foreach($pets as $pet)
                                <option value="{{ $pet->id }}" {{ old('pet_id') == $pet->id ? 'selected' : '' }}>
                                    {{ $pet->name }} ({{ __('messages.owner') }}: {{ $pet->owner->name }})
                                </option>
                            @endforeach
                        </select>
                        @error('pet_id')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>

                    <!-- Room -->
                    <div>
                        <label for="room_id" class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.room') }}</label>
                        <select name="room_id" id="room_id" class="w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                            <option value="">{{ __('messages.no_room_walk_in') }}</option>
                            @foreach($rooms as $room)
                                <option value="{{ $room->id }}" {{ old('room_id') == $room->id ? 'selected' : '' }}>
                                    {{ $room->code }} - {{ $room->type ?? 'Standard' }} (Rp {{ number_format($room->rate_per_day, 0, ',', '.') }}/day)
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Start Date -->
                    <div>
                        <label for="start_date" class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.start_date') }} *</label>
                        <input type="date" name="start_date" id="start_date" value="{{ old('start_date') }}" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 @error('start_date') border-red-500 @enderror">
                        @error('start_date')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>

                    <!-- End Date -->
                    <div>
                        <label for="end_date" class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.end_date') }} *</label>
                        <input type="date" name="end_date" id="end_date" value="{{ old('end_date') }}" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 @error('end_date') border-red-500 @enderror">
                        @error('end_date')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>
                </div>

                <div class="mt-8 flex items-center justify-end gap-4">
                    <a href="{{ route('bookings.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-400 transition">{{ __('messages.cancel') }}</a>
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-[#FFB6C9] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-pink-500 transition">{{ __('messages.create_booking') }}</button>
                </div>
            </form>
        </div>
    </div>
</x-layout.admin>
