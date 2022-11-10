<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PlaceTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\PlaceTag::factory(40)->create();
    }
}
