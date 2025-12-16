<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServicesSeeder extends Seeder
{
    public function run()
    {
        $services = [
            ['name' => 'Basic Grooming', 'description' => 'Includes bath, brush, and nail trim.', 'price' => 150000],
            ['name' => 'Full Grooming', 'description' => 'Includes Basic Grooming plus haircut and styling.', 'price' => 250000],
            ['name' => 'Medicated Bath', 'description' => 'Special bath for pets with skin conditions.', 'price' => 180000],
            ['name' => 'Teeth Brushing', 'description' => 'Dental hygiene service.', 'price' => 75000],
            ['name' => 'Day Care', 'description' => 'Full day of supervised play and activities.', 'price' => 100000],
            ['name' => 'Nature Walk', 'description' => 'A 30-minute walk in a nearby park.', 'price' => 50000],
            ['name' => 'Special Diet Meal', 'description' => 'Custom meal preparation based on dietary needs.', 'price' => 40000],
        ];

        foreach ($services as $service) {
            \App\Models\Service::create($service);
        }
    }
}
