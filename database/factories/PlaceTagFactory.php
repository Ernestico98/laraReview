<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Place>
 */
class PlaceTagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'tag_id' => fake()->numberBetween(1, \App\Models\Tag::count()),
            'place_id' => fake()->numberBetween(1, \App\Models\Place::count()),
        ];
    }
}
