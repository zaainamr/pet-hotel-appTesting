<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Seeder;

class RoomsSeeder extends Seeder
{
    public function run()
    {
        // Create a variety of rooms with different statuses
        \App\Models\Room::factory(15)->create(['status' => 'available']);
        \App\Models\Room::factory(3)->create(['status' => 'occupied']);
        \App\Models\Room::factory(2)->create(['status' => 'maintenance']);
    }
}
