<?php

namespace App\Http\Controllers;

use App\Models\Tag;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::with('places')->orderBy('name')->get();

        return view('tags.index', compact('tags'));
    }

    public function show($id)
    {
        $tag = Tag::with('places', 'places.tags', 'places.author')->findOrFail($id);
        $places = $tag->places()->paginate(5);

        return view('tags.show', compact('tag', 'places'));
    }
}
