<?php

namespace Tests\Feature;

use App\Models\Place;
use App\Models\Review;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PlaceShowTest extends PlaceTest
{
    
    use RefreshDatabase;

    public $place, $author;

    public $guest_response, $user_response, $admin_response, $author_response;

    public $url;

    public function setUp() : void {
        parent::setUp();

        \App\Models\Tag::factory(10)->create();
        \App\Models\PlaceTag::factory(30)->create();
        \App\Models\Review::factory(100)->create();

        $this->place = Place::first();

        $this->author = $this->place->author;
        $this->user = User::where('id', '!=', "{$this->author->id}")->get()->first();// not the author

        $this->guest_response = $this->get("/places/{$this->place->id}");
        $this->user_response = $this->actingAs($this->user)->get("/places/{$this->place->id}");
        $this->admin_response = $this->actingAs($this->admin)->get("/places/{$this->place->id}");
        $this->author_response = $this->actingAs($this->author)->get("/places/{$this->place->id}");

        $this->url = route('places.edit', $this->place->id);
    }

    public function test_show_response() {
        $this->guest_response->assertStatus(302);
        $this->guest_response->assertRedirect('login');

        $this->user_response->assertStatus(200);
        
        $this->admin_response->assertStatus(200);
    }
    
    public function test_view_has_place_name() {
        $this->user_response->assertSee("{$this->place->name}");
    }

    public function test_admin_and_author_see_edit_button() {
        $this->admin_response->assertSee("<a href=\"{$this->url}\"", false);
        $this->author_response->assertSee("<a href=\"{$this->url}\"", false);
    }

    public function test_user_cannot_see_edit_button() {
        $this->user_response->assertDontSee("<a href=\"{$this->url}\"", false);
    }

    public function test_view() {
        $this->user_response->assertViewIs('places.show');
    }

    public function test_models() {
        $this->user_response->assertViewHas(['place'], $this->place);
        $this->user_response->assertViewHas(['reviews'], $this->place->reviews);
    }

    public function test_first_review_is_visible() {
        $old_reviews = $this->place->reviews()->count();
        
        // make sure there is at least one review
        Review::create([
            "place_id" => $this->place->id,
            "author_id" => $this->user->id,
            'score' => fake()->numberBetween(1, 5),
            'review' => fake()->realText(),
        ]);

        $new_reviews = $this->place->reviews()->count();
        $this->assertEquals($old_reviews + 1, $new_reviews);

        // get new response to include new review
        $response = $this->actingAs($this->user)->get("/places/{$this->place->id}");
        
        $response->assertSee($this->place->reviews()->first()->review);
    }
}
