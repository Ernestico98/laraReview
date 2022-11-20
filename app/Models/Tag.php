<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    public $guarded = [];

    public function places()
    {
        return $this->belongsToMany(Place::class)->using(PlaceTag::class);
    }

    protected static function booted()
    {
        static::deleting(function ($tag) {
            $tag->places()->sync([]);
        });
    }
}
