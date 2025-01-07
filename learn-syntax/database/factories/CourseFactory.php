<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'image' => $this->faker->imageUrl(640, 480, 'education', true, 'course'),
            'status' => $this->faker->boolean(),
            'course_slug' =>  Str::slug($this->faker->sentence(3)),
        ];
    }
}
