<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
        ]);

        \App\Models\User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'isAdmin' => 1,
        ]);

        \App\Models\Place::factory(10)->create();

        \App\Models\Tag::factory(10)->create();

        \App\Models\PlaceTag::factory(30)->create();

        \App\Models\Review::factory(100)->create();

        \App\Models\Complaint::factory(10)->create();
    }
}
