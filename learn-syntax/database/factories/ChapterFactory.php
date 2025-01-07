<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Chapter>
 */
class ChapterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
{
    return [
        'course_id' => \App\Models\Course::exists() 
            ? \App\Models\Course::inRandomOrder()->first()->id 
            : \App\Models\Course::factory()->create()->id,
        'chapter_name' => $this->faker->sentence(3),
        'chapter_description' => $this->faker->paragraph(),
        'chapter_slug' => Str::slug($this->faker->sentence(3)),
        'order' => $this->faker->numberBetween(1, 20),
    ];
}

}
