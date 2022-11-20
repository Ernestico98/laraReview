<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    use HasFactory;

    public $guarded = [];

    public function author()
    {
        return $this->belongsTo(User::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class)->using(PlaceTag::class);
    }

    protected static function booted()
    {
        static::deleting(function ($place) {
            $place->reviews->delete();
            $place->tags()->sync([]);
        });
    }
}
