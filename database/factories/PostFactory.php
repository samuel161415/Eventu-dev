<?php
namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition()
    {
        $title = $this->faker->sentence;
        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'content' => $this->faker->paragraphs(3, true),
            'user_id' => User::factory(),
            'image' => 'images/eventu-hero.jpg',
            'meta_title' => $title,
            'meta_description' => $this->faker->sentence,
            'meta_keywords' => implode(',', $this->faker->words(5)),
            'canonical_url' => $this->faker->url,
            'is_published' => $this->faker->boolean,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
