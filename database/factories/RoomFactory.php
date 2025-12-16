<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $type = fake()->randomElement(['Standard', 'Deluxe', 'Suite', 'Family', 'VIP']);
        $rates = [
            'Standard' => 150000,
            'Deluxe' => 200000,
            'Suite' => 250000,
            'Family' => 300000,
            'VIP' => 400000,
        ];

        return [
            'code' => 'R' . fake()->unique()->numberBetween(100, 999),
            'type' => $type,
            'capacity' => fake()->numberBetween(1, 4),
            'rate_per_day' => $rates[$type],
            'status' => 'available',
        ];
    }

    public function occupied(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'occupied',
            ];
        });
    }
}
