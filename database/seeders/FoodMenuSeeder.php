<?php

namespace Database\Seeders;

use App\Models\FoodMenu;
use App\Models\Business;
use Illuminate\Database\Seeder;

class FoodMenuSeeder extends Seeder
{
    public function run(): void
    {
        $foodMenus = [
            [
                'menu_name' => 'Menu 1',
                'short_description' => 'This is a short description for Menu 1',
                'pdf_url' => '/path/to/menu1.pdf',
                'price' => 50.00,
                'allergens' => 'Nuts, Dairy',
            ],
            [
                'menu_name' => 'Menu 2',
                'short_description' => 'This is a short description for Menu 2',
                'pdf_url' => '/path/to/menu2.pdf',
                'price' => 60.00,
                'allergens' => 'Gluten, Soy',
            ],
        ];

        // Get all businesses
        $businesses = Business::all();

        // Assign 3 random menus to each business
        foreach ($businesses as $business) {
            foreach ($foodMenus as $menu) {
                FoodMenu::create(array_merge($menu, ['business_id' => $business->id]));
            }
        }
    }
}
