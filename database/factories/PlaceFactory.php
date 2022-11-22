<?php

namespace Database\Factories;

use App\Models\Place;
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
            'description' => fake()->realTextBetween(40, 200),
            'author_id' => fake()->numberBetween(1, \App\Models\User::count()),
            'city' => fake()->city(),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Place $place) {
            $url = 'https://source.unsplash.com/random/1200x800';
            $place
                ->addMediaFromUrl($url)
                ->toMediaCollection();
        });
    }
}
