<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Topic>
 */
class TopicFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'chapter_id' =>\App\Models\Chapter::exists() 
            ? \App\Models\Chapter::inRandomOrder()->first()->id 
            : \App\Models\Chapter::factory()->create()->id, // This will be dynamically assigned in the seeder
            'topic_name' => $this->faker->sentence(3),
            'topic_description' => $this->faker->paragraph(),
            'topic_slug' => $this->faker->slug(),
            'order' => $this->faker->numberBetween(1, 10),
        ];
    }

}
