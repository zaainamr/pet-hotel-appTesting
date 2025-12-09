<x-app-layout>
    <div class="space-y-6">
        <!-- Invoice Card -->
        <div class="bg-white rounded-xl shadow-sm mt-6">
            <div class="p-8">
                <!-- Invoice Header -->
                <div class="flex justify-between items-start mb-8">
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900">{{ __('messages.invoice_no') }}{{ $invoice->id }}</h3>
                        <p class="text-sm text-gray-600 mt-1">{{ __('messages.date') }}: {{ $invoice->created_at->format('d F Y') }}</p>
                    </div>
                    <div class="text-right">
                        <span class="px-4 py-2 rounded-full text-sm font-semibold {{ $invoice->paid ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                            {{ $invoice->paid ? __('messages.paid') : __('messages.unpaid') }}
                        </span>
                    </div>
                </div>

                <div class="border-t border-b border-gray-200 py-6 mb-6">
                    <h4 class="font-semibold text-gray-900 mb-4">{{ __('messages.booking_details') }}</h4>
                    @if($invoice->booking)
                    <div class="grid grid-cols-2 gap-4 text-sm">
                        <div>
                            <p class="text-gray-600">{{ __('messages.pet_name') }}</p>
                            <p class="font-medium text-gray-900">{{ $invoice->booking->pet->name ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600">{{ __('messages.species') }}</p>
                            <p class="font-medium text-gray-900">{{ $invoice->booking->pet->species ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600">{{ __('messages.room') }}</p>
                            <p class="font-medium text-gray-900">{{ $invoice->booking->room->code ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600">{{ __('messages.room_type') }}</p>
                            <p class="font-medium text-gray-900">{{ $invoice->booking->room->type ?? 'Standard' }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600">{{ __('messages.check_in_date') }}</p>
                            <p class="font-medium text-gray-900">{{ $invoice->booking->start_date }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600">{{ __('messages.check_out_date') }}</p>
                            <p class="font-medium text-gray-900">{{ $invoice->booking->end_date }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600">{{ __('messages.duration') }}</p>
                            <p class="font-medium text-gray-900">
                                {{ \Carbon\Carbon::parse($invoice->booking->start_date)->diffInDays(\Carbon\Carbon::parse($invoice->booking->end_date)) + 1 }} {{ __('messages.days') }}
                            </p>
                        </div>
                        <div>
                            <p class="text-gray-600">{{ __('messages.rate_per_day') }}</p>
                            <p class="font-medium text-gray-900">Rp {{ number_format($invoice->booking->room->rate_per_day ?? 0, 0, ',', '.') }}</p>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Amount -->
                <div class="bg-gradient-to-r from-pink-50 to-yellow-50 rounded-lg p-6 mb-6">
                    <div class="flex justify-between items-center">
                        <span class="text-lg font-semibold text-gray-900">{{ __('messages.total_amount') }}</span>
                        <span class="text-3xl font-bold text-pink-600">Rp {{ number_format($invoice->amount, 0, ',', '.') }}</span>
                    </div>
                </div>

                @if($invoice->paid)
                <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span class="text-green-800 font-medium">{{ __('messages.payment_received_on') }} {{ $invoice->updated_at->format('d F Y, H:i') }}</span>
                    </div>
                </div>
                @else
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-6">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-yellow-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span class="text-yellow-800 font-medium">{{ __('messages.payment_pending') }}</span>
                    </div>
                </div>
                @endif
            </div>
            <div class="p-6 bg-gray-50 rounded-b-xl border-t flex justify-end">
                <a href="{{ route('customer.invoices.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-400 transition">
                    {{ __('messages.back_to_invoices') }}
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
