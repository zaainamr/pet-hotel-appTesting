<x-layout.admin>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('messages.bookings_management') }}</h2></x-slot>
    <div class="mb-6">
        <h3 class="text-2xl font-bold text-gray-900">{{ __('messages.bookings_management') }}</h3>
        <p class="text-gray-600 mt-2">{{ __('messages.all_bookings_description') }}</p>
    </div>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-semibold text-gray-800">{{ __('messages.all_bookings') }}</h3>
                <a href="{{ route('bookings.create') }}" class="btn-gradient inline-flex items-center px-4 py-2 rounded-md font-semibold text-xs uppercase tracking-widest transition">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    {{ __('messages.new_booking') }}
                </a>
            </div>
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded"><span>{{ session('success') }}</span></div>
            @endif
            <div class="overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative">
                <table class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
                    <thead>
                        <tr class="text-left">
                            <th class="bg-gray-50 sticky top-0 border-b border-gray-200 px-6 py-3 text-gray-600 font-bold tracking-wider uppercase text-xs">{{ __('messages.id') }}</th>
                            <th class="bg-gray-50 sticky top-0 border-b border-gray-200 px-6 py-3 text-gray-600 font-bold tracking-wider uppercase text-xs">{{ __('messages.pet') }}</th>
                            <th class="bg-gray-50 sticky top-0 border-b border-gray-200 px-6 py-3 text-gray-600 font-bold tracking-wider uppercase text-xs">{{ __('messages.owner') }}</th>
                            <th class="bg-gray-50 sticky top-0 border-b border-gray-200 px-6 py-3 text-gray-600 font-bold tracking-wider uppercase text-xs">{{ __('messages.room') }}</th>
                            <th class="bg-gray-50 sticky top-0 border-b border-gray-200 px-6 py-3 text-gray-600 font-bold tracking-wider uppercase text-xs">{{ __('messages.check_in') }}</th>
                            <th class="bg-gray-50 sticky top-0 border-b border-gray-200 px-6 py-3 text-gray-600 font-bold tracking-wider uppercase text-xs">{{ __('messages.check_out') }}</th>
                            <th class="bg-gray-50 sticky top-0 border-b border-gray-200 px-6 py-3 text-gray-600 font-bold tracking-wider uppercase text-xs">{{ __('messages.status') }}</th>
                            <th class="bg-gray-50 sticky top-0 border-b border-gray-200 px-6 py-3 text-gray-600 font-bold tracking-wider uppercase text-xs">{{ __('messages.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bookings as $booking)
                            <tr class="hover:bg-gray-50">
                                <td class="border-dashed border-t border-gray-200 px-6 py-3"><span class="text-gray-700">#{{ $booking->id }}</span></td>
                                <td class="border-dashed border-t border-gray-200 px-6 py-3"><span class="text-gray-700">{{ $booking->pet->name }}</span></td>
                                <td class="border-dashed border-t border-gray-200 px-6 py-3"><span class="text-gray-700">{{ $booking->pet->owner->name }}</span></td>
                                <td class="border-dashed border-t border-gray-200 px-6 py-3"><span class="text-gray-700">{{ $booking->room->code }}</span></td>
                                <td class="border-dashed border-t border-gray-200 px-6 py-3"><span class="text-gray-700">{{ \Carbon\Carbon::parse($booking->start_date)->translatedFormat('l, d F Y') }}</span></td>
                                <td class="border-dashed border-t border-gray-200 px-6 py-3"><span class="text-gray-700">{{ \Carbon\Carbon::parse($booking->end_date)->translatedFormat('l, d F Y') }}</span></td>
                                <td class="border-dashed border-t border-gray-200 px-6 py-3">
                                    <form action="{{ route('bookings.updateStatus', $booking) }}" method="POST" class="update-status-form">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary text-xs" onchange="this.form.submit()">
                                            <option value="reserved" {{ $booking->status == 'reserved' ? 'selected' : '' }}>{{ __('messages.reserved') }}</option>
                                            <option value="confirmed" {{ $booking->status == 'confirmed' ? 'selected' : '' }}>{{ __('messages.confirmed') }}</option>
                                            <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>{{ __('messages.pending') }}</option>
                                            <option value="cancelled" {{ $booking->status == 'cancelled' ? 'selected' : '' }}>{{ __('messages.cancelled') }}</option>
                                        </select>
                                    </form>
                                </td>
                                <td class="border-dashed border-t border-gray-200 px-6 py-3">
                                    <a href="{{ route('bookings.edit', $booking) }}" class="text-primary hover:text-green-700">{{ __('messages.edit') }}</a>
                                    <form action="{{ route('bookings.destroy', $booking) }}" method="POST" class="inline-block" onsubmit="return confirm('{{ __('messages.delete_booking_confirmation') }}');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">{{ __('messages.delete') }}</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="8" class="text-center py-10 px-4 text-sm text-gray-400">{{ __('messages.no_bookings_found') }}</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4">{{ $bookings->links() }}</div>
        </div>
    </div>
</x-layout.admin>
