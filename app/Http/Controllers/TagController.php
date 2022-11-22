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
        $tag = Tag::findOrFail($id);
        $places = $tag->places()->paginate(5);
        $places->load('media', 'tags', 'author');

        return view('tags.show', compact('tag', 'places'));
    }
}
