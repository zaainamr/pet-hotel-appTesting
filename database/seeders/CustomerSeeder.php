<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Owner;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        // Create a specific customer for easy testing
        $specificUser = User::factory()->create([
            'name' => 'John Doe',
            'email' => 'customer@pethotel.com',
            'role' => 'customer',
        ]);
        Owner::factory()->create([
            'name' => $specificUser->name,
            'email' => $specificUser->email,
        ]);

        // Create 10 random customers and their corresponding owner profiles
        User::factory(10)->create(['role' => 'customer'])->each(function ($user) {
            Owner::factory()->create([
                'name' => $user->name,
                'email' => $user->email,
            ]);
        });
    }
}
