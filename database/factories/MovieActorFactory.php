<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MovieActorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'movie_id' => mt_rand(1, 40),
            'actor_id' => mt_rand(1, 20),
            'character_name' => $this->faker->name(),
        ];
    }
}
