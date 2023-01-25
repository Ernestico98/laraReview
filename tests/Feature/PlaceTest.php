<?php

namespace Tests\Feature;

use App\Models\Place;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PlaceTest extends TestCase
{
    use RefreshDatabase;

    public $places;

    public function setUp() : void {
        parent::setUp();

        $this->places = Place::factory(10)->create();  
    }
    
}
