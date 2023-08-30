<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->name(),
            'slug' => $this->faker->slug(),
            'description' => $this->faker->paragraph(mt_rand(5, 25)),
            'genre_id' => mt_rand(1, 6),
            'director' => $this->faker->name(),
            'release_date' => $this->faker->date(),
            'thumbnail' => 'movie'.mt_rand(1, 25).'.jpg',
            'background' => 'movie'.mt_rand(1, 25).'.jpg',
        ];
    }
}
