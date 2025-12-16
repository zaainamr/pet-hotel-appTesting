<?php

namespace Database\Seeders;

use App\Models\Pet;
use App\Models\Owner;
use Illuminate\Database\Seeder;

class PetsSeeder extends Seeder
{
    public function run()
    {
        $owners = \App\Models\Owner::all();

        if ($owners->isEmpty()) {
            return; // No owners to assign pets to
        }

        // Create 25 pets and assign them to random existing owners
        \App\Models\Pet::factory(25)->make()->each(function ($pet) use ($owners) {
            $pet->owner_id = $owners->random()->id;
            $pet->save();
        });
    }
}
