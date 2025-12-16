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
        $this->call([
            AdminSeeder::class,
            CustomerSeeder::class, // Creates Users with role 'customer' and corresponding Owners
            OwnersSeeder::class,   // Creates additional Owners without user accounts
            PetsSeeder::class,     // Assigns Pets to the Owners created above
            RoomsSeeder::class,
            ServicesSeeder::class,
            BookingsSeeder::class, // Creates Bookings and corresponding Invoices
        ]);
    }
}
