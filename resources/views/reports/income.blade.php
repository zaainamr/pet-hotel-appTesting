<x-layout.admin>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Income Report') }}</h2></x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-6">Revenue Statistics</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                        <div class="bg-gradient-to-br from-pink-50 to-pink-100 p-6 rounded-lg">
                            <p class="text-sm text-pink-600 font-medium">Total Revenue</p>
                            <p class="text-3xl font-bold text-pink-900 mt-2">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
                        </div>
                        <div class="bg-gradient-to-br from-green-50 to-green-100 p-6 rounded-lg">
                            <p class="text-sm text-green-600 font-medium">Paid Invoices</p>
                            <p class="text-3xl font-bold text-green-900 mt-2">Rp {{ number_format($paidAmount, 0, ',', '.') }}</p>
                        </div>
                        <div class="bg-gradient-to-br from-yellow-50 to-yellow-100 p-6 rounded-lg">
                            <p class="text-sm text-yellow-600 font-medium">Unpaid Invoices</p>
                            <p class="text-3xl font-bold text-yellow-900 mt-2">Rp {{ number_format($unpaidAmount, 0, ',', '.') }}</p>
                        </div>
                        <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-6 rounded-lg">
                            <p class="text-sm text-blue-600 font-medium">Total Invoices</p>
                            <p class="text-3xl font-bold text-blue-900 mt-2">{{ $totalInvoices }}</p>
                        </div>
                    </div>

                    <div class="mt-8">
                        <h4 class="text-md font-semibold text-gray-700 mb-4">Recent Invoices</h4>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Invoice #</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Customer</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Amount</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($recentInvoices as $invoice)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">INV-{{ str_pad($invoice->id, 5, '0', STR_PAD_LEFT) }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $invoice->booking->pet->owner->name }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Rp {{ number_format($invoice->amount, 0, ',', '.') }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $invoice->paid ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                                    {{ $invoice->paid ? 'Paid' : 'Unpaid' }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $invoice->created_at->translatedFormat('l, d F Y') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout.admin>
