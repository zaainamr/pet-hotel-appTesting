<x-app-layout>
    <div class="space-y-6">
        <!-- Page Title -->
        <div>
            <h1 class="text-3xl font-bold text-gray-900">{{ __('messages.my_profile') }}</h1>
            <p class="text-gray-600 mt-1">{{ __('messages.my_profile_desc') }}</p>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg"><span>{{ session('success') }}</span></div>
        @endif

        <!-- Profile Info Card -->
        <div class="bg-white rounded-xl shadow-sm mt-6">
            <form action="{{ route('customer.updateProfile') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="p-8">
                    <h3 class="text-xl font-bold text-gray-900 mb-8">{{ __('messages.profile_information') }}</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <!-- Profile Image -->
                        <div class="md:col-span-1 flex flex-col items-center">
                            <label for="image" class="block text-sm font-medium text-gray-700 mb-2 self-start">{{ __('messages.profile_image') }}</label>
                            <img src="{{ str_starts_with(Auth::user()->image, 'images/profile') ? asset('storage/' . Auth::user()->image) : asset('image/' . basename(Auth::user()->image)) }}" alt="Profile Image" class="h-40 w-40 object-cover rounded-full aspect-square shadow-md mb-4">
                            <label for="image" class="cursor-pointer inline-flex items-center px-4 py-2 bg-pink-100 text-pink-700 rounded-md text-sm font-medium hover:bg-pink-200 transition">
                                {{ __('messages.change_photo') }}
                            </label>
                            <input type="file" name="image" id="image" class="hidden">
                        </div>
                        <!-- Form Fields -->
                        <div class="md:col-span-2 grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div class="sm:col-span-2">
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.name') }} *</label>
                                <input type="text" name="name" id="name" value="{{ old('name', $owner->name) }}" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                            </div>
                            <div class="sm:col-span-2">
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.email') }}</label>
                                <input type="email" value="{{ $owner->email }}" disabled class="w-full rounded-md border-gray-300 bg-gray-100 shadow-sm">
                                <p class="mt-1 text-xs text-gray-500">{{ __('messages.email_cannot_be_changed') }}</p>
                            </div>
                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.phone') }} *</label>
                                <input type="text" name="phone" id="phone" value="{{ old('phone', $owner->phone) }}" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                            </div>
                            <div class="sm:col-span-2">
                                <label for="address" class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.address') }} *</label>
                                <textarea name="address" id="address" rows="3" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">{{ old('address', $owner->address) }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-6 bg-gray-50 rounded-b-xl border-t flex justify-end">
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-[#FFB6C9] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-pink-500 transition">{{ __('messages.update_profile') }}</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
