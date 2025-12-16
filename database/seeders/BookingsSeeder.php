<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Invoice;
use App\Models\Pet;
use App\Models\Room;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class BookingsSeeder extends Seeder
{
    public function run()
    {
        $pets = \App\Models\Pet::all();
        $rooms = \App\Models\Room::where('status', 'available')->get();

        if ($pets->isEmpty() || $rooms->isEmpty()) {
            return;
        }

        // 1. Create Past, Completed Bookings
        for ($i = 0; $i < 5; $i++) {
            $booking = \App\Models\Booking::factory()->completed()->create([
                'pet_id' => $pets->random()->id,
                'room_id' => $rooms->random()->id,
            ]);
            \App\Models\Invoice::factory()->create(['booking_id' => $booking->id, 'amount' => $booking->total_price, 'paid' => true]);
        }

        // 2. Create Current, Active Bookings
        $availableRooms = $rooms->take(5);
        foreach ($availableRooms as $room) {
            $booking = \App\Models\Booking::factory()->confirmed()->create([
                'pet_id' => $pets->random()->id,
                'room_id' => $room->id,
                'start_date' => now()->subDays(rand(1, 3)),
                'end_date' => now()->addDays(rand(2, 5)),
            ]);
            $room->update(['status' => 'occupied']);
            \App\Models\Invoice::factory()->create(['booking_id' => $booking->id, 'amount' => $booking->total_price, 'paid' => fake()->boolean()]);
        }

        // 3. Create Future, Pending/Confirmed Bookings
        $remainingRooms = $rooms->skip(5);
        for ($i = 0; $i < 5; $i++) {
            $booking = \App\Models\Booking::factory()->pending()->create([
                'pet_id' => $pets->random()->id,
                'room_id' => $remainingRooms->random()->id,
            ]);
            \App\Models\Invoice::factory()->create(['booking_id' => $booking->id, 'amount' => $booking->total_price, 'paid' => false]);
        }

        // 4. Create some Cancelled Bookings (don't need invoices)
        \App\Models\Booking::factory(3)->cancelled()->create([
            'pet_id' => $pets->random()->id,
            'room_id' => null, // No room for cancelled bookings
        ]);
    }
}
