<x-app-layout>
    <div class="space-y-6">
        <!-- Page Title -->
        <div>
            <h1 class="text-3xl font-bold text-gray-900">{{ __('messages.my_invoices') }}</h1>
            <p class="text-gray-600 mt-1">{{ __('messages.invoice_history') }}</p>
        </div>

        <!-- Invoices List -->
        <div class="bg-white rounded-xl shadow-sm">
            <div class="divide-y">
                @forelse($invoices as $invoice)
                    <div class="p-6 hover:bg-gray-50">
                        <div class="flex justify-between items-start">
                            <div class="flex-1">
                                <div class="flex items-center gap-3 mb-2">
                                    <h4 class="text-lg font-semibold text-gray-900">{{ __('messages.invoice_no') }}{{ $invoice->id }}</h4>
                                    <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $invoice->paid ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                        {{ $invoice->paid ? __('messages.paid') : __('messages.unpaid') }}
                                    </span>
                                </div>
                                
                                @if($invoice->booking)
                                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 text-sm text-gray-600 mb-3">
                                    <div>
                                        <p class="font-medium text-gray-700">{{ __('messages.pet') }}</p>
                                        <p>{{ $invoice->booking->pet->name ?? 'N/A' }}</p>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-700">{{ __('messages.room') }}</p>
                                        <p>{{ $invoice->booking->room->code ?? 'N/A' }}</p>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-700">{{ __('messages.dates') }}</p>
                                        <p>{{ $invoice->booking->start_date }} to {{ $invoice->booking->end_date }}</p>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-700">{{ __('messages.amount') }}</p>
                                        <p class="text-pink-600 font-semibold text-lg">Rp {{ number_format($invoice->amount, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                                @endif

                                <p class="text-xs text-gray-400">{{ __('messages.created') }}: {{ $invoice->created_at->format('d M Y, H:i') }}</p>
                                @if($invoice->paid && $invoice->updated_at)
                                    <p class="text-xs text-gray-400">{{ __('messages.paid') }}: {{ $invoice->updated_at->format('d M Y, H:i') }}</p>
                                @endif
                            </div>
                            <div class="ml-4">
                                <a href="{{ route('customer.invoices.show', $invoice) }}" class="inline-flex items-center px-3 py-2 bg-pink-100 text-pink-700 rounded-md text-sm font-medium hover:bg-pink-200 transition">
                                    {{ __('messages.view_details') }}
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-16">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <p class="mt-4 text-gray-500">{{ __('messages.no_invoices_yet') }}</p>
                    </div>
                @endforelse
            </div>

            @if($invoices->hasPages())
                <div class="p-6 bg-gray-50 rounded-b-xl border-t">
                    {{ $invoices->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
