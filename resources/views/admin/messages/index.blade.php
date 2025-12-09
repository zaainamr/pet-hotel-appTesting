<x-layout.admin>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('messages.customer_messages') }}
        </h2>
    </x-slot>

    <div class="mb-6">
        <h3 class="text-2xl font-bold text-gray-900">{{ __('messages.customer_messages') }}</h3>
        <p class="text-gray-600 mt-2">{{ __('messages.customer_messages_description') }}</p>
    </div>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('messages.conversations') }}</h3>

            <div class="border-t border-gray-200">
                @if($customers->isEmpty())
                    <p class="p-4 text-gray-500">{{ __('messages.no_conversations_found') }}</p>
                @else
                    <ul role="list" class="divide-y divide-gray-200">
                        @foreach ($customers as $customer)
                            <li>
                                <a href="{{ route('messages.show', $customer) }}" class="block hover:bg-gray-50">
                                    <div class="flex items-center px-4 py-4 sm:px-6">
                                        <div class="min-w-0 flex-1 flex items-center">
                                            <div class="flex-shrink-0">
                                                @if($customer->image && basename($customer->image) != 'default-profile.png')
                                                    <img class="h-12 w-12 rounded-full object-cover" src="{{ asset('storage/' . $customer->image) }}" alt="Profile of {{ $customer->name }}">
                                                @else
                                                    <img class="h-12 w-12 rounded-full" src="https://ui-avatars.com/api/?name={{ urlencode($customer->name) }}&color=7F9CF5&background=EBF4FF" alt="Avatar for {{ $customer->name }}">
                                                @endif
                                            </div>
                                            <div class="min-w-0 flex-1 px-4 md:grid md:grid-cols-2 md:gap-4">
                                                <div>
                                                    <p class="text-sm font-medium text-indigo-600 truncate">{{ $customer->name }}</p>
                                                    <p class="mt-2 flex items-center text-sm text-gray-500">
                                                        <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                                        </svg>
                                                        <span class="truncate">{{ $customer->email }}</span>
                                                    </p>
                                                </div>
                                                <div class="hidden md:block">
                                                    <div>
                                                        @php
                                                            $lastMessage = $customer->sentMessages->merge($customer->receivedMessages)->sortByDesc('created_at')->first();
                                                        @endphp
                                                        @if($lastMessage)
                                                        <p class="text-sm text-gray-900">
                                                            {{ __('messages.last_message_on') }} <time datetime="{{ $lastMessage->created_at->toIso8601String() }}">{{ $lastMessage->created_at->format('M d, Y') }}</time>
                                                        </p>
                                                        <p class="mt-2 flex items-center text-sm text-gray-500">
                                                            {{ Str::limit($lastMessage->message, 40) }}
                                                        </p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
</x-layout.admin>
