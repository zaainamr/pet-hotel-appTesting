<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Pet Hotel seeders
        $this->call([
            \Database\Seeders\AdminSeeder::class,
            \Database\Seeders\CustomerSeeder::class,
            \Database\Seeders\OwnersSeeder::class,
            \Database\Seeders\PetsSeeder::class,
            \Database\Seeders\RoomsSeeder::class,
            \Database\Seeders\ServicesSeeder::class,
            \Database\Seeders\BookingsSeeder::class,
        ]);
    }
}
