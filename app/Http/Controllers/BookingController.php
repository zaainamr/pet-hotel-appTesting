<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Pet;
use App\Models\Owner;
use App\Models\Room;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['pet.owner','room'])->latest()->paginate(20);
        return view('bookings.index', compact('bookings'));
    }

    public function create()
    {
        $pets = Pet::with('owner')->get();
        $rooms = Room::where('status','available')->get();
        return view('bookings.create', compact('pets','rooms'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'pet_id' => 'required|exists:pets,id',
            'room_id' => 'nullable|exists:rooms,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $pet = Pet::findOrFail($data['pet_id']);
        $owner = $pet->owner;

        $booking = Booking::create([
            'pet_id' => $pet->id,
            'owner_id' => $owner->id,
            'room_id' => $data['room_id'] ?? null,
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
            'status' => 'reserved',
            'total_price' => 0,
        ]);

        // Calculate basic price: room rate * nights
        $days = \Carbon\Carbon::parse($data['start_date'])->diffInDays(\Carbon\Carbon::parse($data['end_date'])) + 1;
        $total = 0;
        if ($booking->room) {
            $total += $booking->room->rate_per_day * $days;
            $booking->room->updateStatusBasedOnBookings();
        }

        $booking->update(['total_price' => $total]);

        // create invoice
        Invoice::create([
            'booking_id' => $booking->id,
            'amount' => $total,
            'paid' => false,
        ]);

        return redirect()->route('bookings.index')->with('success', __('messages.booking_created'));
    }

    public function show(Booking $booking)
    {
        $booking->load(['pet.owner','room','invoice']);
        return view('bookings.show', compact('booking'));
    }

    public function edit(Booking $booking)
    {
        $pets = Pet::with('owner')->get();
        $rooms = Room::all();
        return view('bookings.edit', compact('booking', 'pets', 'rooms'));
    }

    public function update(Request $request, Booking $booking)
    {
        $data = $request->validate([
            'pet_id' => 'required|exists:pets,id',
            'room_id' => 'nullable|exists:rooms,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|in:reserved,confirmed,pending,cancelled',
        ]);

        $pet = Pet::findOrFail($data['pet_id']);
        
        $booking->update([
            'pet_id' => $pet->id,
            'owner_id' => $pet->owner->id,
            'room_id' => $data['room_id'] ?? null,
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
            'status' => $data['status'],
        ]);

        // Recalculate price
        $days = \Carbon\Carbon::parse($data['start_date'])->diffInDays(\Carbon\Carbon::parse($data['end_date'])) + 1;
        $total = 0;
        if ($booking->room) {
            $total += $booking->room->rate_per_day * $days;
        }
        $booking->update(['total_price' => $total]);

        // Update invoice if exists
        if ($booking->invoice) {
            $booking->invoice->update(['amount' => $total]);
        }

        if ($booking->room) {
            $booking->room->updateStatusBasedOnBookings();
        }

        // Notify customer about booking status change
        $customerUser = \App\Models\User::where('email', $booking->pet->owner->email)->first();
        if ($customerUser) {
            if ($data['status'] == 'confirmed') {
                \App\Models\Notification::create([
                    'user_id' => $customerUser->id,
                    'type' => 'booking_confirmed',
                    'title' => 'Booking Confirmed',
                    'message' => 'Your booking for ' . $booking->pet->name . ' has been confirmed!',
                    'data' => json_encode([
                        'booking_id' => $booking->id,
                        'pet_name' => $booking->pet->name,
                        'room' => $booking->room ? $booking->room->code : 'N/A',
                    ]),
                ]);
            } elseif ($data['status'] == 'cancelled') {
                \App\Models\Notification::create([
                    'user_id' => $customerUser->id,
                    'type' => 'booking_cancelled',
                    'title' => 'Booking Cancelled',
                    'message' => 'Your booking for ' . $booking->pet->name . ' has been cancelled.',
                    'data' => json_encode([
                        'booking_id' => $booking->id,
                        'pet_name' => $booking->pet->name,
                    ]),
                ]);
            }
        }

        return redirect()->route('bookings.index')->with('success', __('messages.booking_updated'));

    }

    public function updateStatus(Request $request, Booking $booking)
    {
        $request->validate(['status' => 'required|in:reserved,confirmed,pending,cancelled']);

        $booking->update(['status' => $request->status]);

        if ($booking->room) {
            $booking->room->updateStatusBasedOnBookings();
        }

        // Optional: Add notifications or other logic here as needed

        return back()->with('success', __('messages.booking_status_updated'));
    }

    public function destroy(Booking $booking)
    {
        $room = $booking->room; // Get the room before deleting the booking

        $booking->delete();

        if ($room) {
            $room->updateStatusBasedOnBookings();
        }
        
        return redirect()->route('bookings.index')->with('success', __('messages.booking_deleted'));
    }
}
