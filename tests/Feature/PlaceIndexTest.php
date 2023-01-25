<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PlaceIndexTest extends PlaceTest
{
    use RefreshDatabase;

    public $guest_response, $user_response, $admin_response;

    public $author;

    public function setUp(): void {
        parent::setUp();

        $this->guest_response = $this->get('/places');
        $this->user_response = $this->actingAs($this->user)->get('/places');
        $this->admin_response = $this->actingAs($this->admin)->get('/places');
    }

    public function test_index_status() {
        $this->user_response->assertStatus(200);
        
        $this->admin_response->assertStatus(200);

        $this->guest_response->assertStatus(302); // redirects to login
        $this->guest_response->assertRedirect('login');   
    }

    public function test_first_place_in_view() {
        $this->user_response->assertSee($this->places->first()->name);
        $this->admin_response->assertSee($this->places->first()->name);
    }

    public function test_last_place_not_in_view() {
        $this->user_response->assertDontSee($this->places->last()->name);
        $this->admin_response->assertDontSee($this->places->last()->name);
    }   

    public function test_view_has_first_five_places() { // pagination
        $this->places->take(5)->map(fn($place) => $this->user_response->assertSee($place->name));
        $this->places->take(5)->map(fn($place) => $this->user_response->assertSee($place->author->name));
    }

    public function test_admin_can_see_delete_button_on_places() {
        $this->admin_response->assertSee('<input type="hidden" name="_method" value="delete">', false);
    }

    public function test_user_cannot_see_delete_button_in_places() {
        $this->user_response->assertDontSee('<input type="hidden" name="_method" value="delete">', false);        
    }

}
