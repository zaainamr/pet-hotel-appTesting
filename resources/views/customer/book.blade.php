<x-app-layout>

        <!-- Page Title -->
        <div>
            <h1 class="text-3xl font-bold text-gray-900">{{ __('messages.book_room') }} {{ $room->code }}</h1>
            <p class="text-gray-600 mt-1">{{ __('messages.find_perfect_room') }}</p>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-xl shadow-sm mt-6">
            <form action="{{ route('customer.storeBooking') }}" method="POST">
                @csrf
                <input type="hidden" name="room_id" value="{{ $room->id }}">
                <div class="p-6">
                    <!-- Room Info -->
                    <div class="mb-6 p-4 bg-gradient-to-r from-pink-50 to-yellow-50 rounded-lg border border-pink-100">
                        <h3 class="text-xl font-bold text-gray-900 mb-2">{{ __('messages.room') }} {{ $room->code }}</h3>
                        <p class="text-gray-700">{{ $room->type ? __('messages.' . strtolower($room->type)) : __('messages.standard') }} - {{ __('messages.capacity_pets', ['count' => $room->capacity]) }}</p>
                        <p class="text-2xl font-bold text-pink-600 mt-2">Rp {{ number_format($room->rate_per_day, 0, ',', '.') }}{{ __('messages.per_day') }}</p>
                    </div>

                    @if(session('success'))
                        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg"><span>{{ session('success') }}</span></div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <label for="pet_id" class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.select_pet') }} *</label>
                            <select name="pet_id" id="pet_id" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 @error('pet_id') border-red-500 @enderror">
                                <option value="">{{ __('messages.choose_a_pet') }}</option>
                                @foreach($pets as $pet)
                                    <option value="{{ $pet->id }}" {{ old('pet_id') == $pet->id ? 'selected' : '' }}>
                                        {{ $pet->name }} ({{ $pet->species ?? 'Pet' }})
                                    </option>
                                @endforeach
                            </select>
                            @error('pet_id')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                            @if($pets->count() == 0)
                                <p class="mt-2 text-sm text-yellow-600">{{ __('messages.no_pets_to_book') }}</p>
                            @endif
                        </div>
                        <div>
                            <label for="start_date" class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.check_in_date') }} *</label>
                            <input type="date" name="start_date" id="start_date" value="{{ old('start_date') }}" required min="{{ date('Y-m-d') }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 @error('start_date') border-red-500 @enderror">
                            @error('start_date')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="end_date" class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.check_out_date') }} *</label>
                            <input type="date" name="end_date" id="end_date" value="{{ old('end_date') }}" required min="{{ date('Y-m-d') }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 @error('end_date') border-red-500 @enderror">
                            @error('end_date')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </div>
                <div class="p-6 bg-gray-50 rounded-b-xl border-t flex justify-end gap-4">
                    <a href="{{ route('customer.rooms') }}" class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-400 transition">{{ __('messages.back') }}</a>
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-[#FFB6C9] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-pink-500 transition">{{ __('messages.confirm_booking') }}</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
