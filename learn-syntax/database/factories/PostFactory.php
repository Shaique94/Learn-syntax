<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition()
    {
        return [
            'topic_id' =>\App\Models\Topic::exists() 
            ? \App\Models\Topic::inRandomOrder()->first()->id 
            : \App\Models\Topic::factory()->create()->id,
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraphs(5, true),
            'image_path' => $this->faker->imageUrl(),
            'status' => $this->faker->boolean,
        ];
    }
}
