<?php

namespace Database\Factories;

use App\Models\Owner;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pet>
 */
class PetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $species = fake()->randomElement(['Dog', 'Cat', 'Bird', 'Rabbit', 'Hamster']);
        $breeds = [
            'Dog' => ['Beagle', 'Labrador', 'Poodle', 'Golden Retriever'],
            'Cat' => ['Siamese', 'Persian', 'Bengal', 'Sphynx'],
            'Bird' => ['Parrot', 'Canary', 'Finch'],
            'Rabbit' => ['Holland Lop', 'Netherland Dwarf'],
            'Hamster' => ['Syrian', 'Dwarf'],
        ];

        return [
            'owner_id' => Owner::factory(),
            'name' => fake()->firstName(),
            'species' => $species,
            'breed' => fake()->randomElement($breeds[$species]),
            'age' => fake()->numberBetween(1, 15),
            'notes' => fake()->sentence(),
        ];
    }
}
