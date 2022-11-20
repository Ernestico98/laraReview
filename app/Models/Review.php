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

    public function complaints()
    {
        return $this->hasMany(Complaint::class);
    }

    protected static function booted()
    {
        static::created(function ($review) {
            $place = Place::findOrFail($review->place_id);

            $new_score = round((($place->score * $place->review_count + $review->score) / ($place->review_count + 1)), 1);

            $place->update([
                'score' => $new_score,
                'review_count' => $place->review_count + 1,
            ]);
        });

        static::deleting(function ($review) {
            $review->complaints->delete();
        });
    }
}
