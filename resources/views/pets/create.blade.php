<x-layout.admin>
    <div class="space-y-6">
        <!-- Page Title -->
        <div>
            <h1 class="text-3xl font-bold text-gray-900">{{ __('messages.add_new_pet') }}</h1>
            <p class="text-gray-600 mt-1">{{ __('messages.all_pets_description') }}</p>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-xl shadow-sm p-6">
            <form action="{{ route('pets.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="owner_id" class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.owner') }} *</label>
                        <select name="owner_id" id="owner_id" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 @error('owner_id') border-red-500 @enderror">
                            <option value="">{{ __('messages.select_owner') }}</option>
                            @foreach($owners as $owner)
                                <option value="{{ $owner->id }}" {{ old('owner_id') == $owner->id ? 'selected' : '' }}>
                                    {{ $owner->name }} - {{ $owner->email }}
                                </option>
                            @endforeach
                        </select>
                        @error('owner_id')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.pet_name') }} *</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 @error('name') border-red-500 @enderror">
                        @error('name')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="species" class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.species') }}</label>
                        <input type="text" name="species" id="species" value="{{ old('species') }}" placeholder="e.g., Dog, Cat, Bird" class="w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 @error('species') border-red-500 @enderror">
                        @error('species')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="breed" class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.breed') }}</label>
                        <input type="text" name="breed" id="breed" value="{{ old('breed') }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 @error('breed') border-red-500 @enderror">
                        @error('breed')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="age" class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.age_years') }}</label>
                        <input type="number" name="age" id="age" value="{{ old('age') }}" min="0" class="w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 @error('age') border-red-500 @enderror">
                        @error('age')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="image" class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.pet_image') }}</label>
                        <input type="file" name="image" id="image" class="w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 @error('image') border-red-500 @enderror">
                        @error('image')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <div class="md:col-span-2">
                        <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.notes') }}</label>
                        <textarea name="notes" id="notes" rows="3" class="w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 @error('notes') border-red-500 @enderror">{{ old('notes') }}</textarea>
                        @error('notes')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>
                </div>

                <div class="mt-8 flex items-center justify-end gap-4">
                    <a href="{{ route('pets.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-400 transition">{{ __('messages.cancel') }}</a>
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-[#FFB6C9] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-pink-500 transition">{{ __('messages.create_pet') }}</button>
                </div>
            </form>
        </div>
    </div>
</x-layout.admin>
