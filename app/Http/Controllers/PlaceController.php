<?php

namespace App\Http\Controllers;

use App\Models\Place;
use App\Models\PlaceTag;
use App\Models\Tag;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $places = Place::with('author', 'tags', 'media')->orderBy('created_at', 'desc')->paginate(5);

        return view('places.index', compact('places'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('places.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:2|max:30',
            'description' => 'required|max:255',
            'city' => 'required',
            'tags' => 'required|regex:"^[a-zA-Z]+(,[a-zA-Z]+)*$"',
            'image' => ['nullable', 'file', 'image'],
        ]);

        $place = Place::create([
            'name' => $request->name,
            'description' => $request->description,
            'city' => $request->city,
            'author_id' => auth()->user()->id,
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
            PlaceTag::create([
                'place_id' => $place->id,
                'tag_id' => $tag_object->id,
            ]);
        }

        return redirect()->route('places.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $place = Place::with('reviews', 'author', 'reviews.author', 'tags', 'media')->findOrFail($id);
        $reviews = $place->reviews()->orderBy('created_at', 'desc')->where('hidden', '=', false)->paginate(10);
        $reviews->load('author.media');

        return view('places.show', compact('place', 'reviews'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $place = Place::findOrFail($id);
        $auth_user = auth()->user();

        if (! $auth_user->isAdmin && $place->author_id != $auth_user->id) {
            abort(403);
        }

        $place->load('tags');

        return view('places.edit', compact('place'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $place = Place::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|min:2|max:30',
            'description' => 'required|max:255',
            'city' => 'required',
            'tags' => 'required|regex:"^[a-zA-Z]+(,[a-zA-Z]+)*$"',
            'image' => ['nullable', 'file', 'image'],
        ]);

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

        return redirect()->route('places.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $place = Place::findOrFail($id)->delete();

        return redirect()->back();
    }
}
