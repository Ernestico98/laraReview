<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use App\Models\Review;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    public function index()
    {
        $reviews = Review::where('complaints_count', '>', 0)
            ->orderBy('complaints_count', 'desc')
            ->paginate(10);

        return view('complaints.index', compact('reviews'));
    }

    public function report(Request $request, $review_id, $user_id)
    {
        Complaint::firstOrCreate([
            'review_id' => $review_id,
            'user_id' => $user_id,
        ]);

        return redirect()->back();
    }

    public function hide_review(Request $request, $review_id)
    {
        $review = Review::findOrFail($review_id);

        $review->update([
            'hidden' => 1,
        ]);

        $complaints = Complaint::where('review_id', '=', $review_id)->get();
        foreach ($complaints as $complaint) {
            $complaint->delete();
        }

        $review->place->update([
            'review_count' => $review->place->review_count - 1,
        ]);

        return redirect()->back();
    }
}
