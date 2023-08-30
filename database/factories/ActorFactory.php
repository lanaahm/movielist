<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ActorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'slug' => $this->faker->slug(),
            'gender' => mt_rand(0, 1),
            'biography' => $this->faker->sentence(mt_rand(40, 100)),
            'date_of_birth' => $this->faker->date(),
            'place_of_birth' => $this->faker->city(),
            'popularity' => mt_rand(40, 100),
            'photo' => 'actor'.mt_rand(1, 20).'.jpg',
        ];
    }
}
