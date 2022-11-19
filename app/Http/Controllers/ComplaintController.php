<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    public function report(Request $request, $review_id, $user_id)
    {
        Complaint::firstOrCreate([
            'review_id' => $review_id,
            'user_id' => $user_id,
        ]);

        return redirect()->back();
    }
}
