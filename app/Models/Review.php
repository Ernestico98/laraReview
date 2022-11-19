<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function place()
    {
        return $this->belongsTo(Place::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class);
    }

    protected static function booted()
    {
        static::created(function ($review) {
            $place = Place::findOrFail($review->place_id);

            $count = $place->reviews->count();
            $new_score = round((($place->score * ($count - 1) + $review->score) / $count), 1);

            $place->update([
                'score' => $new_score,
            ]);
        });
    }
}
