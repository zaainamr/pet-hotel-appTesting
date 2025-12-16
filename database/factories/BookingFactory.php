<?php

namespace Database\Factories;

use App\Models\Owner;
use App\Models\Pet;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startDate = Carbon::instance(fake()->dateTimeBetween('-1 month', '+1 month'));
        $endDate = (clone $startDate)->addDays(fake()->numberBetween(2, 7));
        $room = Room::inRandomOrder()->first() ?? Room::factory()->create();
        $pet = Pet::inRandomOrder()->first() ?? Pet::factory()->create();

        $duration = $startDate->diffInDays($endDate);
        $totalPrice = $duration * $room->rate_per_day;

        return [
            'pet_id' => $pet->id,
            'owner_id' => $pet->owner_id,
            'room_id' => $room->id,
            'start_date' => $startDate->toDateString(),
            'end_date' => $endDate->toDateString(),
            'status' => fake()->randomElement(['pending', 'confirmed', 'completed', 'cancelled']),
            'total_price' => $totalPrice,
        ];
    }

    public function completed(): Factory
    {
        return $this->state(function (array $attributes) {
            $startDate = Carbon::instance(fake()->dateTimeBetween('-1 month', '-1 week'));
            $endDate = (clone $startDate)->addDays(fake()->numberBetween(2, 7));
            return [
                'start_date' => $startDate->toDateString(),
                'end_date' => $endDate->toDateString(),
                'status' => 'completed',
            ];
        });
    }

    public function pending(): Factory
    {
        return $this->state(function (array $attributes) {
            $startDate = Carbon::instance(fake()->dateTimeBetween('+1 week', '+1 month'));
            $endDate = (clone $startDate)->addDays(fake()->numberBetween(2, 7));
            return [
                'start_date' => $startDate->toDateString(),
                'end_date' => $endDate->toDateString(),
                'status' => 'pending',
            ];
        });
    }

    public function confirmed(): Factory
    {
        return $this->state(function (array $attributes) {
            $startDate = Carbon::instance(fake()->dateTimeBetween('now', '+1 week'));
            $endDate = (clone $startDate)->addDays(fake()->numberBetween(2, 7));
            return [
                'start_date' => $startDate->toDateString(),
                'end_date' => $endDate->toDateString(),
                'status' => 'confirmed',
            ];
        });
    }

    public function cancelled(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'cancelled',
            ];
        });
    }
}
