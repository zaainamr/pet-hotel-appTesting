<x-app-layout>
    <div class="space-y-6">
        <!-- Page Title -->
        <div>
            <h1 class="text-3xl font-bold text-gray-900">{{ __('messages.messages') }}</h1>
            <p class="text-gray-600 mt-1">{{ __('messages.chat_with_admin') }}</p>
        </div>

        <!-- Chat Card -->
        <div class="bg-white rounded-xl shadow-sm mt-6">
            <div class="flex flex-col h-[75vh]">
                <!-- Chat Header -->
                <div class="p-4 border-b flex items-center">
                    @php $admin = $admins->first(); @endphp
                    <div class="flex items-center gap-3">
                        <img class="h-10 w-10" src="{{ asset('image/logo-pethotel.svg') }}" alt="Pet Hotel Logo">
                        <div>
                            <h3 class="font-semibold text-lg text-gray-800 leading-tight">Pet Hotel Admin</h3>
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
                    <form action="{{ route('customer.messages.store') }}" method="POST">
                        @csrf
                        <div class="flex items-center gap-4">
                            <textarea name="message" 
                                      rows="2" 
                                      class="w-full rounded-md shadow-sm focus:border-pink-500 focus:ring-pink-500 @error('message') border-red-500 @else border-gray-300 @enderror" 
                                      placeholder="{{ __('messages.type_message_placeholder') }}"></textarea>
                            <button type="submit" class="inline-flex items-center justify-center w-12 h-12 bg-[#FFB6C9] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-pink-500 focus:bg-pink-500 active:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                            </button>
                        </div>
                        @error('message')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const container = document.getElementById('messageContainer');
        if (container) {
            container.scrollTop = container.scrollHeight;
        }
    </script>
</x-app-layout>
