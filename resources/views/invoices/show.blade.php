<x-layout.admin>
    <div class="space-y-6">
        <!-- Page Title -->
        <div>
            <h1 class="text-3xl font-bold text-gray-900">{{ __('messages.invoice_detail') }} #{{ $invoice->id }}</h1>
            <p class="text-gray-600 mt-1">{{ __('messages.all_invoices_description') }}</p>
        </div>

        <!-- Invoice Card -->
        <div class="bg-white rounded-xl shadow-sm">
            <div class="p-8">
                <!-- Invoice Header -->
                <div class="flex justify-between items-start mb-8">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900">{{ strtoupper(__('messages.invoice')) }}</h2>
                        <p class="text-gray-600 mt-2">{{ __('messages.invoice_no') }}{{ $invoice->id }}</p>
                        <p class="text-gray-600">{{ __('messages.date') }}: {{ $invoice->created_at->translatedFormat('l, d F Y') }}</p>
                    </div>
                    <div class="text-right">
                        <h3 class="text-xl font-bold text-primary">Pet Hotel</h3>
                        <p class="text-gray-600">{{ __('messages.pet_care_services') }}</p>
                    </div>
                </div>

                <!-- Customer Info -->
                <div class="mb-8 p-4 bg-gray-50 rounded-lg">
                    <h4 class="font-semibold text-gray-700 mb-2">{{ __('messages.bill_to') }}</h4>
                    <p class="font-medium">{{ $invoice->booking->pet->owner->name }}</p>
                    <p class="text-gray-600">{{ $invoice->booking->pet->owner->email }}</p>
                    <p class="text-gray-600">{{ $invoice->booking->pet->owner->phone }}</p>
                </div>

                <!-- Booking Details -->
                <div class="mb-8">
                    <h4 class="font-semibold text-gray-700 mb-4">{{ __('messages.booking_details') }}</h4>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">{{ __('messages.description') }}</th>
                                    <th class="px-4 py-2 text-right text-sm font-medium text-gray-700">{{ __('messages.amount') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-b">
                                    <td class="px-4 py-3">
                                        <p class="font-medium">{{ __('messages.pet_boarding') }} - {{ $invoice->booking->pet->name }}</p>
                                        <p class="text-sm text-gray-600">{{ \Carbon\Carbon::parse($invoice->booking->start_date)->translatedFormat('l, d F Y') }} to {{ \Carbon\Carbon::parse($invoice->booking->end_date)->translatedFormat('l, d F Y') }}</p>
                                        @if($invoice->booking->room)
                                            <p class="text-sm text-gray-600">{{ __('messages.room') }}: {{ $invoice->booking->room->code }} ({{ $invoice->booking->room->type ?? __('messages.standard') }})</p>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-right font-semibold">Rp {{ number_format($invoice->amount, 0, ',', '.') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Total -->
                <div class="border-t-2 border-gray-200 pt-4 flex justify-end">
                    <div class="w-full max-w-sm">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-lg font-semibold">{{ __('messages.total_amount') }}:</span>
                            <span class="text-2xl font-bold text-primary">Rp {{ number_format($invoice->amount, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600">{{ __('messages.payment_status') }}:</span>
                            <span class="px-3 py-1 rounded-full text-sm font-semibold {{ $invoice->paid ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ $invoice->paid ? strtoupper(__('messages.paid')) : strtoupper(__('messages.unpaid')) }}
                            </span>
                        </div>
                        @if($invoice->paid && $invoice->paid_at)
                            <div class="flex justify-between items-center mt-2">
                                <span class="text-sm text-gray-600">{{ __('messages.paid_on') }}</span>
                                <span class="text-sm">{{ $invoice->paid_at->translatedFormat('l, d F Y, H:i') }}</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="p-6 bg-gray-50 rounded-b-xl border-t flex justify-between items-center">
                <a href="{{ route('invoices.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-400 transition">
                    {{ __('messages.back_to_invoices') }}
                </a>
                @if(!$invoice->paid)
                    <form action="{{ route('invoices.update', $invoice) }}" method="POST">
                        @csrf @method('PUT')
                        <input type="hidden" name="paid" value="1">
                        <button type="submit" class="btn-gradient inline-flex items-center px-4 py-2 rounded-md font-semibold text-xs uppercase tracking-widest transition">
                            {{ __('messages.mark_as_paid') }}
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</x-layout.admin>
