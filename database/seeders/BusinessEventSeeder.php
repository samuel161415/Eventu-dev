<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Business;
use App\Models\EventCategory;

class BusinessEventSeeder extends Seeder
{
    public function run()
    {
        Business::factory(10)->create()->each(function ($business) {
            $categories = EventCategory::inRandomOrder()->take(3)->pluck('id')->unique();
            $business->eventCategories()->sync($categories);
        });
    }
}
