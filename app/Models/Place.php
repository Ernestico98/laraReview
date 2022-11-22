<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Place extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

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
            $place->reviews()->delete();
            $place->tags()->sync([]);
        });
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this
            ->addMediaConversion('place')
            ->fit(Manipulations::FIT_CROP, 500, 500)
            ->nonQueued();
    }

    // Policies ========================================================
    public function canEdit(?int $user_id = null)
    {
        if (auth()->user()->isAdmin) {
            return true;
        }
        if ($user_id === null) {
            $user_id = auth()->id();
        }

        return $this->author_id === $user_id;
    }
}
