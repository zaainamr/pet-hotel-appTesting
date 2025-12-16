@extends('layouts.app')

@section('content')
    <h2 class="text-xl font-semibold mb-4">Booking #{{ $booking->id }}</h2>

    <div class="mb-2">Pet: {{ $booking->pet->name ?? '-' }}</div>
    <div class="mb-2">Owner: {{ $booking->owner->name ?? '-' }}</div>
    <div class="mb-2">Room: {{ $booking->room->code ?? '-' }}</div>
    <div class="mb-2">Start: {{ \Carbon\Carbon::parse($booking->start_date)->translatedFormat('l, d F Y') }}</div>
    <div class="mb-2">End: {{ \Carbon\Carbon::parse($booking->end_date)->translatedFormat('l, d F Y') }}</div>
    <div class="mb-2">Status: {{ $booking->status }}</div>

    @if($booking->invoice)
        <h3 class="mt-4">Invoice</h3>
        <div>Amount: {{ number_format($booking->invoice->amount,0,',','.') }}</div>
        <div>Paid: {{ $booking->invoice->paid ? 'Yes' : 'No' }}</div>
        <a href="{{ route('invoices.show', $booking->invoice) }}">Open Invoice</a>
    @endif
@endsection
