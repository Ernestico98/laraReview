<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\PlaceRequest;
use App\Http\Resources\PlaceResource;
use Illuminate\Http\Request;
use App\Models\Place;
use App\Models\PlaceTag;
use App\Models\Tag;
use App\Models\User;

class PlaceController extends Controller
{
    private function resourceNotFound() {
        return response()->json(
            [
                "status" => 404,
                "message" => "The resource you are requesting does not exists.",
            ]);
    }

    public function index() {
        $places = Place::paginate(5);

        return PlaceResource::collection($places);
        // return new PlaceResource($places);
        // return response($places->toJson(), 200)->header('Content-Type', 'application/json');
    }   

    public function show($id) {    
        $place = Place::find($id);
        if ($place == null)
            return $this->resourceNotFound();

        return PlaceResource::make($place);
    }

    public function store(PlaceRequest $request) {    
         
        $place = Place::create([
            'name' => $request->name,
            'description' => $request->description,
            'city' => $request->city,
            'author_id' => $request->author_id,
            'score' => 0,
            'review_count' => 0,
        ]);

        if ($request->has('image')) {
            $place->media()->first()?->delete();
            $place->addMediaFromRequest('image')->toMediaCollection();
        }

        $tags = collect(explode(',', $request->tags))->map(fn ($tag) => ucfirst(trim($tag)));

        foreach ($tags as $key => $tag) {
            $tag_object = Tag::firstOrCreate([
                'name' => $tag,
            ]);
            PlaceTag::firstOrcreate([
                'place_id' => $place->id,
                'tag_id' => $tag_object->id,
            ]);
        }

        return PlaceResource::make($place);
    }


    public function update(PlaceRequest $request, $id)
    {
        $place = Place::find($id);

        if ($place == null)
            return $this->resourceNotFound();

        $place->tags->map(fn ($item) => $item->delete());

        $tags = collect(explode(',', $request->tags))->map(fn ($tag) => ucfirst(trim($tag)));

        foreach ($tags as $key => $tag) {
            $tag_object = Tag::firstOrCreate([
                'name' => $tag,
            ]);
            PlaceTag::create([
                'place_id' => $place->id,
                'tag_id' => $tag_object->id,
            ]);
        }

        $place->update([
            'name' => $request->name,
            'description' => $request->description,
            'city' => $request->city,
        ]);

        if ($request->has('image')) {
            $place->media()->first()?->delete();
            $place->addMediaFromRequest('image')->toMediaCollection();
        }

        return PlaceResource::make($place);
    }

    public function destroy($id)
    {
        $place = Place::find($id);

        if ($place == null)
            return $this->resourceNotFound();

        $place->delete();

        return response()->json(
            [
                "message" => "Element deleted"
            ]
        );
    }
}
