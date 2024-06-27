<?php
namespace Database\Factories;

use App\Models\Media;
use App\Models\Business;
use Illuminate\Support\Str;
use App\Models\EventCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class BusinessFactory extends Factory
{
    protected $model = Business::class;

    public function definition(): array
    {
        $name = $this->faker->company();
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'user_id' => 1,
            'location_id' => 1,
            'slogan' => $this->faker->catchPhrase(),
            'short_description' => $this->faker->paragraph(),
            'city' => $this->faker->city(),
            'district' => $this->faker->state(),
            'address' => $this->faker->address(),
            'profile_picture_url' => $this->faker->imageUrl(),
            'cover_photo_url' => $this->faker->imageUrl(),
            'phone' => $this->faker->phoneNumber(),
            'email' => $this->faker->email(),
            'website_url' => $this->faker->url(),
            'fiscal_attribute' => $this->faker->word(),
            'identification_code' => $this->faker->word(),
            'control_digit' => $this->faker->word(),
            'registration_prefix' => $this->faker->word(),
            'county_code' => $this->faker->word(),
            'order_number' => $this->faker->randomNumber(),
            'min_people' => $this->faker->numberBetween(0, 200),
            'max_people' => $this->faker->numberBetween(200, 600),
            'pret_min_nunta' => $this->faker->numberBetween(200, 1000),
            'pret_min_botez' => $this->faker->numberBetween(200, 1000),
            'registration_year' => $this->faker->year(),
            'latitude' => $this->faker->latitude(),
            'longitude' => $this->faker->longitude(),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Business $business) {
            for ($i = 1; $i <= 3; $i++) {
                Media::factory()->create([
                    'url' => 'eventu-hero.jpg',
                    'mediable_id' => $business->id,
                    'mediable_type' => Business::class,
                ]);
            }
    
            $categories = EventCategory::inRandomOrder()->take(rand(1, 3))->pluck('id');
            $business->eventCategories()->attach($categories);
        });
    }
    
    
}
