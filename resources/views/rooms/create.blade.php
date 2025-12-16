<x-layout.admin>
    <div class="space-y-6">
        <!-- Page Title -->
        <div>
            <h1 class="text-3xl font-bold text-gray-900">{{ __('messages.add_new_room') }}</h1>
            <p class="text-gray-600 mt-1">{{ __('messages.all_rooms_description') }}</p>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-xl shadow-sm p-6">
            <form action="{{ route('rooms.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="code" class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.room_code') }} *</label>
                        <input type="text" name="code" id="code" value="{{ old('code') }}" required class="form-input w-full @error('code') border-red-500 @enderror">
                        @error('code')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.type') }}</label>
                        <select name="type" id="type" class="form-input w-full">
                            <option value="">{{ __('messages.select_type') }}</option>
                            <option value="Standard" {{ old('type') == 'Standard' ? 'selected' : '' }}>{{ __('messages.standard') }}</option>
                            <option value="Deluxe" {{ old('type') == 'Deluxe' ? 'selected' : '' }}>{{ __('messages.deluxe') }}</option>
                            <option value="Suite" {{ old('type') == 'Suite' ? 'selected' : '' }}>{{ __('messages.suite') }}</option>
                        </select>
                    </div>
                    <div>
                        <label for="capacity" class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.capacity') }} *</label>
                        <input type="number" name="capacity" id="capacity" value="{{ old('capacity', 1) }}" min="1" required class="form-input w-full">
                    </div>
                    <div>
                        <label for="rate_per_day" class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.rate_per_day') }} (Rp) *</label>
                        <input type="number" name="rate_per_day" id="rate_per_day" value="{{ old('rate_per_day') }}" min="10000" step="1000" required class="form-input w-full">
                    </div>
                    <div class="md:col-span-2">
                        <label for="image" class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.room_image') }} ({{ __('messages.optional') }})</label>
                        <input type="file" name="image" id="image" class="form-input w-full @error('image') border-red-500 @enderror">
                        @error('image')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <div class="md:col-span-2">
                        <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.notes') }} ({{ __('messages.optional') }})</label>
                        <textarea name="notes" id="notes" rows="3" class="form-input w-full">{{ old('notes') }}</textarea>
                    </div>
                </div>

                <div class="mt-8 flex items-center justify-end gap-4">
                    <a href="{{ route('rooms.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-400 transition">{{ __('messages.cancel') }}</a>
                    <button type="submit" class="btn-gradient inline-flex items-center px-4 py-2 rounded-md font-semibold text-xs uppercase tracking-widest transition">{{ __('messages.create_room') }}</button>
                </div>
            </form>
        </div>
    </div>
</x-layout.admin>
