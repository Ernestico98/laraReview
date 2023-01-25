<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PlaceCreateTest extends PlaceTest
{
    use RefreshDatabase;

    public $response;

    public function setUp(): void {
        parent::setUp();

        $this->response = $this->actingAs($this->user)->get(route('places.create'));
    }

    public function test_create_response()
    {
        $this->response->assertStatus(200);
        $this->response->assertViewIs('places.create');
    }

    public function test_city_label_is_present() {
        $html_code = '<label for="city" class="w-24 text-sm text-gray-500 ">City</label>';
        $this->response->assertSee($html_code, false);
    }

    public function test_see_create_button() {
        $this->response->assertSee("Create"); // this will only appear once in the create view
    }
}