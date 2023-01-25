<?php

namespace Tests\Feature;

use App\Models\Place;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PlaceDestroyTest extends PlaceTest
{
    use RefreshDatabase;

    public $place, $response;

    public function setUp() : void {
        parent::setUp();

        $this->place = $this->places->first();
        
        $this->response = $this->actingAs($this->admin)->delete(route('places.destroy', $this->place->id));
    }

    public function test_redirect() {
        ray($this->response);

        $this->response->assertStatus(302);
    }

    public function test_element_deleted()
    {        
        $this->assertDatabaseMissing('places', [
            'id' => $this->place->id,
        ]);
    }
}
