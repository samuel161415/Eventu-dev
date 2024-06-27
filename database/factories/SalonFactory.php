<?php

namespace Database\Factories;

use App\Models\Salon;
use Illuminate\Database\Eloquent\Factories\Factory;

class SalonFactory extends Factory
{
    protected $model = Salon::class;

    public function definition()
    {
        return [
            'business_id' => 1,
            'salon_name' => $this->faker->company,
            'min_people' => $this->faker->numberBetween(10, 50),
            'max_people' => $this->faker->numberBetween(51, 300),
            'street' => $this->faker->streetAddress,
            'description' => $this->faker->paragraph(4),
            'number' => $this->faker->buildingNumber,
            'city' => $this->faker->city,
            'postcode' => $this->faker->postcode,
            'image' => 'images/eventu-hero.jpg'
        ];
    }
}
