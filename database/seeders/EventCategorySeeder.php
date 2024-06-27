<?php

namespace Database\Seeders;

use App\Models\EventCategory;
use Illuminate\Database\Seeder;
use App\Models\LocationCategory;

class EventCategorySeeder extends Seeder
{
    public function run()
    {
        $eventTypes = [
            'Botez',
            'Nuntă',
            'Corporate'
        ];
        
        // Create the tags
        foreach ($eventTypes as $event) {
            EventCategory::create(['name' => $event]);
        }

    }
}
