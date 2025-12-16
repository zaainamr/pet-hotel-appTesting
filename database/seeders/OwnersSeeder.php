<?php

namespace Database\Seeders;

use App\Models\Owner;
use Illuminate\Database\Seeder;

class OwnersSeeder extends Seeder
{
    public function run()
    {
        // This seeder will create owners who are not necessarily registered users (e.g., walk-ins)
        Owner::factory(5)->create();
    }
}
