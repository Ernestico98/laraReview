<?php

namespace Tests\Feature;

use App\Models\Place;
use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class PlaceStoreTest extends PlaceTest
{
    use RefreshDatabase;

    public $file;

    public $response;

    public function setUp(): void {
        parent::setUp();

        Storage::fake('public');

        $this->file = UploadedFile::fake()->image('image.jpg');

        $this->response = $this->actingAs($this->user)->post(route('places.store'), [
            'name' => 'Example Place',
            'description' => 'This is an example place',
            'city' => 'Example City',
            'tags' => 'tag,tog,tug',
            'image' => $this->file,
        ]);

    }

    public function test_store_status_and_redirect()
    {
        ray($this->response);

        $this->response->assertStatus(302);
        $this->response->assertRedirect(route('places.index'));
    }

    public function test_new_place_on_database() {
        $this->assertDatabaseHas('places', [
            'name' => 'Example Place',
            'description' => 'This is an example place',
            'city' => 'Example City',
            'author_id' => $this->user->id,
        ]);
    }

    public function test_new_tags_on_database() {
        $this->assertDatabaseHas('tags', [
            'name' => 'Tag',
        ]);
        $this->assertDatabaseHas('tags', [
            'name' => 'Tog',
        ]);
        $this->assertDatabaseHas('tags', [
            'name' => 'Tug',
        ]);
    }
        
    public function test_pivot_table_place_tags() {
        $this->assertDatabaseHas('place_tag', [
            'place_id' => Place::all()->last()->id,
            'tag_id' => Tag::where('name', 'Tag')->first()->id,
        ]);

        $this->assertDatabaseHas('place_tag', [
            'place_id' => Place::all()->last()->id,
            'tag_id' => Tag::where('name', 'Tog')->first()->id,
        ]);

        $this->assertDatabaseHas('place_tag', [
            'place_id' => Place::all()->last()->id,
            'tag_id' => Tag::where('name', 'Tug')->first()->id,
        ]);
    }

    public function test_image_was_stored() {
        
        
        
        $fileList = Storage::disk('public')->allFiles();
        $fileName = '1/image.jpg';
        
        $this->assertTrue( array_search($fileName, $fileList) != false );
    }
}
