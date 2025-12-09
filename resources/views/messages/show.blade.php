<x-layout.admin>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('messages.customer_messages') }}
        </h2>
    </x-slot>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="flex flex-col h-[75vh]">
            <!-- Chat Header -->
            <div class="p-4 border-b flex items-center">
                <a href="{{ route('messages.index') }}" class="inline-flex items-center justify-center w-10 h-10 bg-gray-200 rounded-full hover:bg-gray-300 transition mr-4">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                </a>
                <div class="flex items-center gap-3">
                    <img class="h-10 w-10 rounded-full object-cover" src="{{ $customer->image ? asset('storage/' . $customer->image) : asset('image/default-profile.png') }}" alt="{{ $customer->name }}">
                    <div>
                        <h3 class="font-semibold text-lg text-gray-800 leading-tight">
                            {{ $customer->name }}
                        </h3>
                    </div>
                </div>
            </div>

            <!-- Chat History -->
            <div class="flex-grow overflow-y-auto p-6 space-y-4 bg-gray-50" id="messageContainer">
                @forelse ($messages as $message)
                    <div class="flex {{ $message->sender_id === Auth::id() ? 'justify-end' : 'justify-start' }}">
                        <div class="max-w-lg">
                            <div class="px-4 py-2 rounded-lg shadow {{ $message->sender_id === Auth::id() ? 'bg-pink-500 text-white' : 'bg-white border' }}">
                                <p class="text-sm font-semibold">{{ $message->sender->name }}</p>
                                <p class="text-sm mt-1">{{ $message->message }}</p>
                                <span class="text-xs opacity-75 block text-right mt-2">{{ $message->created_at->format('H:i') }}</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center text-gray-500 pt-16">
                        <p>{{ __('messages.no_messages_yet') }}</p>
                        <p class="text-sm">{{ __('messages.start_conversation') }}</p>
                    </div>
                @endforelse
            </div>

            <!-- Reply Form -->
            <div class="p-6 border-t bg-white">
                <form action="{{ route('messages.store', $customer) }}" method="POST">
                    @csrf
                    <div class="flex items-center gap-4">
                        <textarea name="message" 
                                  rows="2" 
                                  @class([
                                      'form-input w-full',
                                      'border-red-500' => $errors->has('message'),
                                  ]) 
                                  placeholder="{{ __('messages.type_message_placeholder') }}"></textarea>
                        <button type="submit" class="btn-gradient inline-flex items-center justify-center w-24 h-12 rounded-md font-semibold text-xs uppercase tracking-widest transition">
                            {{ __('messages.send') }}
                        </button>
                    </div>
                    @error('message')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </form>
            </div>
        </div>
    </div>

    <script>
        const container = document.getElementById('messageContainer');
        if (container) {
            container.scrollTop = container.scrollHeight;
        }
    </script>
</x-layout.admin>
