<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    public function report(Request $request, $review_id)
    {
        Complaint::firstOrCreate([
            'review_id' => $review_id,
        ]);

        return redirect()->back();
    }
}
