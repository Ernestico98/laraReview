<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Place>
 */
class PlaceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->realTextBetween(10, 13),
            'description' => fake()->realTextBetween(20, 30),
            'author_id' => fake()->numberBetween(1, \App\Models\User::count()),
            'city' => fake()->city(),
        ];
    }
}
