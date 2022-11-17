<?php

namespace App\Http\Controllers;

use App\Models\Tag;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::all()->sortBy('name');

        return view('tags.index', compact('tags'));
    }

    public function show($id)
    {
        $tag = Tag::with('places')->findOrFail($id);

        return view('tags.show', compact('tag'));
    }
}
