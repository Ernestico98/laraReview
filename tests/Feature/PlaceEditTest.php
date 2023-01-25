<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PlaceEditTest extends PlaceTest
{
    use RefreshDatabase;
    
    public $place, $response;

    public function setUp() : void {
        parent::setUp();

        $this->place = $this->places->first();

        $this->response = $this->actingAs($this->admin)->get(route('places.edit', $this->place->id));
    }

    public function test_edit_status()
    {
        $this->response->assertStatus(200);
        $this->response->assertViewIs('places.edit');
    }

    public function test_view_has_place_model() {
        $this->response->assertViewHas(['place']);
    }

}
