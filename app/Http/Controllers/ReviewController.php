<?php

namespace App\Http\Controllers;

use App\Models\Place;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function create($place_id)
    {
        $place = Place::findOrFail($place_id);

        return view('reviews.create', compact('place'));
    }

    public function store(Request $request, $place_id)
    {
        $place = Place::findOrFail($place_id);

        $validated = $request->validate([
            'score' => 'integer|min:1|max:5',
            'review' => 'string|max:255,',
        ]);

        Review::create([
            'score' => $request->score,
            'review' => $request->review,
            'place_id' => $place->id,
            'author_id' => auth()->user()->id,
        ]);

        return redirect()->route('places.show', $place->id);
    }
}
