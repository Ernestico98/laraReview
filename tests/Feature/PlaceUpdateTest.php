<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class PlaceUpdateTest extends PlaceTest
{

    public $author, $place, $file, $response;

    public function setUp() : void {
        parent::setUp();
    
        $this->place = $this->places->first();
        $this->author = $this->place->author;

        Storage::fake('public');

        $this->file = UploadedFile::fake()->image('image.jpg');

        $this->response = $this->actingAs($this->author)->patch(route('places.update', $this->place->id), [
            'name' => 'Updated Place',
            'description' => 'This is an updated place',
            'city' => 'Updated City',
            'tags' => 'tag,tog,tug',
            'image' => $this->file,
        ]);
    
    }

    public function test_status_and_redirect() {
        $this->response->assertRedirect(route('places.show', $this->place->id));

    }

    public function test_data_changed_on_database() {
        $this->assertDatabaseHas('places', [
            'id' => $this->place->id,
            'name' => 'Updated Place',
            'description' => 'This is an updated place',
            'city' => 'Updated City',
            'author_id' => $this->author->id,
        ]);
    }
}