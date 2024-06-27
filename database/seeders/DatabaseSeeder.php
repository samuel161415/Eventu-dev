<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            AdminCoreSeeder::class,
            EventCategorySeeder::class,
            LocationsTableSeeder::class,
            BusinessEventSeeder::class,
            ViewsSeeder::class,
            // BusinessSeeder::class,
            PostSeeder::class,
            SalonSeeder::class,
            TagSeeder::class,
            FoodMenuSeeder::class,
        ]);
    }
}
