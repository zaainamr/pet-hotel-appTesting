<x-layout.admin>
    <div class="space-y-6">
        <!-- Page Title -->
        <div>
            <h1 class="text-3xl font-bold text-gray-900">{{ __('messages.edit_room') }}</h1>
            <p class="text-gray-600 mt-1">{{ __('messages.all_rooms_description') }}</p>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-xl shadow-sm p-6">
            <form action="{{ route('rooms.update', $room) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="code" class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.room_code') }} *</label>
                        <input type="text" name="code" id="code" value="{{ old('code', $room->code) }}" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 @error('code') border-red-500 @enderror">
                        @error('code')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.type') }}</label>
                        <select name="type" id="type" class="w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                            <option value="Standard" {{ old('type', $room->type) == 'Standard' ? 'selected' : '' }}>{{ __('messages.standard') }}</option>
                            <option value="Deluxe" {{ old('type', $room->type) == 'Deluxe' ? 'selected' : '' }}>{{ __('messages.deluxe') }}</option>
                            <option value="Suite" {{ old('type', $room->type) == 'Suite' ? 'selected' : '' }}>{{ __('messages.suite') }}</option>
                        </select>
                    </div>
                    <div>
                        <label for="capacity" class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.capacity') }} *</label>
                        <input type="number" name="capacity" id="capacity" value="{{ old('capacity', $room->capacity) }}" min="1" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                    </div>
                    <div>
                        <label for="rate_per_day" class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.rate_per_day') }} (Rp) *</label>
                        <input type="number" name="rate_per_day" id="rate_per_day" value="{{ old('rate_per_day', $room->rate_per_day) }}" min="0" step="0.01" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                    </div>
                    <div class="md:col-span-2">
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.status') }} *</label>
                        <select name="status" id="status" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                            <option value="available" {{ old('status', $room->status) == 'available' ? 'selected' : '' }}>{{ __('messages.available') }}</option>
                            <option value="occupied" {{ old('status', $room->status) == 'occupied' ? 'selected' : '' }}>{{ __('messages.occupied') }}</option>
                            <option value="maintenance" {{ old('status', $room->status) == 'maintenance' ? 'selected' : '' }}>{{ __('messages.maintenance') }}</option>
                        </select>
                    </div>
                    <div class="md:col-span-2">
                        <label for="image" class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.room_image') }}</label>
                        <input type="file" name="image" id="image" class="w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 @error('image') border-red-500 @enderror">
                        @error('image')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                        @if($room->image)
                            <img src="{{ asset('storage/' . $room->image) }}" alt="{{ $room->code }}" class="mt-4 h-32 w-auto rounded-md">
                        @endif
                    </div>
                    <div class="md:col-span-2">
                        <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.notes') }}</label>
                        <textarea name="notes" id="notes" rows="3" class="w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">{{ old('notes', $room->notes) }}</textarea>
                    </div>
                </div>

                <div class="mt-8 flex items-center justify-end gap-4">
                    <a href="{{ route('rooms.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-400 transition">{{ __('messages.cancel') }}</a>
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-[#FFB6C9] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-pink-500 transition">{{ __('messages.update_room') }}</button>
                </div>
            </form>
        </div>
    </div>
</x-layout.admin>
