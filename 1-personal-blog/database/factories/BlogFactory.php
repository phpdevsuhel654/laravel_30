<?php
// database/factories/BlogFactory.php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BlogFactory extends Factory
{
    public function definition(): array
    {
        $title = $this->faker->sentence(5);
        return [
            'user_id' => null, // Will be overridden by seeder
            'title' => $title,
            'content' => $this->faker->paragraph(10),
            'slug' => Str::slug($title) . '-' . Str::random(5),
        ];
    }
}
