<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'username' => $this->faker->name(),
            'email' => $this->faker->unique()->freeEmail(),
            'password' => Hash::make('user'),
            'dob' => now(),
            'phone' => $this->faker->e164PhoneNumber(),   
            'is_admin' => false
        ];
    }
}
