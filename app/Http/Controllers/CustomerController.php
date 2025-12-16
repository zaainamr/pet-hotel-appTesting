<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Pet;
use App\Models\Booking;
use App\Models\Owner;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CustomerController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $owner = Owner::where('email', $user->email)->first();
        
        if (!$owner) {
            // Create owner if doesn't exist
            $owner = Owner::create([
                'name' => $user->name,
                'email' => $user->email,
                'phone' => '',
                'address' => '',
            ]);
        }

        $myPets = Pet::where('owner_id', $owner->id)->count();
        $myBookings = Booking::where('owner_id', $owner->id)->count();
        $recentBookings = Booking::with(['pet', 'room'])
            ->where('owner_id', $owner->id)
            ->latest()
            ->take(5)
            ->get();

        return view('customer.dashboard', compact('myPets', 'myBookings', 'recentBookings'));
    }

    public function rooms(Request $request)
    {
        $query = Room::query();

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // Sorting: 'available' first, then by status order, then by code
        $rooms = $query->get()->sortBy(function($room) {
            switch ($room->status) {
                case 'available': return 1;
                case 'occupied': return 2;
                case 'penuh': return 3;
                case 'maintenance': return 4;
                default: return 5;
            }
        });

        return view('customer.rooms', compact('rooms'));
    }

    public function book(Room $room)
    {
        $user = Auth::user();
        $owner = Owner::where('email', $user->email)->first();
        $pets = Pet::where('owner_id', $owner->id)->get();
        
        return view('customer.book', compact('room', 'pets'));
    }

    public function storeBooking(Request $request)
    {
        $data = $request->validate([
            'pet_id' => 'required|exists:pets,id',
            'room_id' => 'required|exists:rooms,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $pet = Pet::findOrFail($data['pet_id']);
        $room = Room::findOrFail($data['room_id']);

        // Calculate price
        $days = \Carbon\Carbon::parse($data['start_date'])->diffInDays(\Carbon\Carbon::parse($data['end_date'])) + 1;
        $total = $room->rate_per_day * $days;

        $booking = Booking::create([
            'pet_id' => $pet->id,
            'owner_id' => $pet->owner_id,
            'room_id' => $room->id,
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
            'status' => 'pending',
            'total_price' => $total,
        ]);


        // Create invoice
        Invoice::create([
            'booking_id' => $booking->id,
            'amount' => $total,
            'paid' => false,
        ]);

        // Notify all admins about new booking
        $admins = \App\Models\User::where('role', 'admin')->get();
        foreach ($admins as $admin) {
            \App\Models\Notification::create([
                'user_id' => $admin->id,
                'type' => 'booking_created',
                'title' => 'New Booking',
                'message' => $pet->owner->name . ' created a booking for ' . $pet->name,
                'data' => json_encode([
                    'booking_id' => $booking->id,
                    'customer_name' => $pet->owner->name,
                    'pet_name' => $pet->name,
                ]),
            ]);
        }

        return redirect()->route('customer.bookings')->with('success', __('messages.booking_created'));
    }

    public function profile()
    {
        $user = Auth::user();
        $owner = Owner::where('email', $user->email)->first();
        $pets = Pet::where('owner_id', $owner->id)->get();
        
        return view('customer.profile', compact('owner', 'pets'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $owner = Owner::where('email', $user->email)->first();

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($user->image && basename($user->image) != 'default-profile.png') {
                Storage::disk('public')->delete($user->image);
            }
            $path = $request->file('image')->store('images/profile', 'public');
            $user->image = $path;
        }

        $ownerData = [
            'name' => $data['name'],
            'phone' => $data['phone'],
            'address' => $data['address'],
        ];

        $owner->update($ownerData);
        $user->name = $data['name'];
        $user->save();

        return redirect()->route('customer.profile')->with('success', __('messages.profile_updated'));
    }

    public function myBookings()
    {
        $user = Auth::user();
        $owner = Owner::where('email', $user->email)->first();
        
        $bookings = Booking::with(['pet', 'room', 'invoice'])
            ->where('owner_id', $owner->id)
            ->latest()
            ->paginate(10);

        return view('customer.bookings', compact('bookings'));
    }

    // Pet Management Methods
    public function myPets()
    {
        $user = Auth::user();
        $owner = Owner::where('email', $user->email)->first();
        
        $pets = Pet::where('owner_id', $owner->id)->get();
        
        return view('customer.pets', compact('pets'));
    }

    public function createPet()
    {
        return view('customer.create-pet');
    }

    public function storePet(Request $request)
    {
        $user = Auth::user();
        $owner = Owner::where('email', $user->email)->first();

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'species' => 'required|string|max:255',
            'breed' => 'nullable|string|max:255',
            'age' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images/pets', 'public');
            $data['image'] = $path;
        }

        $data['owner_id'] = $owner->id;
        Pet::create($data);

        return redirect()->route('customer.pets.index')->with('success', __('messages.pet_added'));
    }

    public function editPet(Pet $pet)
    {
        $user = Auth::user();
        $owner = Owner::where('email', $user->email)->first();

        // Ensure customer can only edit their own pets
        if ($pet->owner_id !== $owner->id) {
            abort(403, 'Unauthorized action.');
        }

        return view('customer.edit-pet', compact('pet'));
    }

    public function updatePet(Request $request, Pet $pet)
    {
        $user = Auth::user();
        $owner = Owner::where('email', $user->email)->first();

        // Ensure customer can only update their own pets
        if ($pet->owner_id !== $owner->id) {
            abort(403, 'Unauthorized action.');
        }

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'species' => 'required|string|max:255',
            'breed' => 'nullable|string|max:255',
            'age' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($pet->image && $pet->image != 'images/default-pet.png') {
                Storage::disk('public')->delete($pet->image);
            }
            $path = $request->file('image')->store('images/pets', 'public');
            $data['image'] = $path;
        }

        $pet->update($data);

        return redirect()->route('customer.pets.index')->with('success', __('messages.pet_updated'));
    }

    public function deletePet(Pet $pet)
    {
        $user = Auth::user();
        $owner = Owner::where('email', $user->email)->first();

        // Ensure customer can only delete their own pets
        if ($pet->owner_id !== $owner->id) {
            abort(403, 'Unauthorized action.');
        }

        // Check if pet has active bookings
        $activeBookings = Booking::where('pet_id', $pet->id)
            ->whereIn('status', ['pending', 'confirmed'])
            ->count();

        if ($activeBookings > 0) {
            return redirect()->route('customer.pets.index')->with('error', __('messages.pet_delete_has_booking'));
        }

        $pet->delete();

        return redirect()->route('customer.pets.index')->with('success', __('messages.pet_deleted'));
    }

    // Notification Methods
    public function notifications()
    {
        $user = Auth::user();
        $notifications = \App\Models\Notification::where('user_id', $user->id)
            ->latest()
            ->paginate(15);

        return view('customer.notifications', compact('notifications'));
    }

    public function markNotificationRead(\App\Models\Notification $notification)
    {
        if ($notification->user_id !== Auth::id()) {
            abort(403);
        }

        $notification->update(['read_at' => now()]);

        return redirect()->back();
    }

    public function markAllNotificationsRead()
    {
        \App\Models\Notification::where('user_id', Auth::id())
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        return redirect()->back()->with('success', __('messages.notifications_read'));
    }

    // Invoice Methods
    public function invoices()
    {
        $user = Auth::user();
        $owner = Owner::where('email', $user->email)->first();
        
        $invoices = Invoice::whereHas('booking', function($query) use ($owner) {
            $query->where('owner_id', $owner->id);
        })->with(['booking.pet', 'booking.room'])
            ->latest()
            ->paginate(10);

        return view('customer.invoices', compact('invoices'));
    }

    public function showInvoice(Invoice $invoice)
    {
        $user = Auth::user();
        $owner = Owner::where('email', $user->email)->first();

        // Ensure customer can only view their own invoices
        if ($invoice->booking->owner_id !== $owner->id) {
            abort(403, 'Unauthorized action.');
        }

        $invoice->load(['booking.pet', 'booking.room']);

        return view('customer.invoice-detail', compact('invoice'));
    }
}
