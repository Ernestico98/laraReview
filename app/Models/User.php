<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Notifications\AdminNewUserNotification;
use App\Notifications\WelcomeUserNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class User extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasFactory, Notifiable, InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'isAdmin',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function places()
    {
        return $this->hasMany(Place::class, 'author_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'author_id');
    }

    public function complaints()
    {
        return $this->hasMany(Complaint::class);
    }

    protected static function booted()
    {
        static::deleting(function ($user) {
            $user->reviews()->delete();
            $user->complaints()->delete();
            $user->places()->delete();
        });

        static::created(function ($user) {
            $user->notify(new WelcomeUserNotification());
            $admins = User::where('isAdmin', '=', 1)->get();
            foreach ($admins as $admin) {
                $admin->notify(new AdminNewUserNotification($user));
            }
        });
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this
            ->addMediaConversion('avatar')
            ->fit(Manipulations::FIT_CROP, 500, 500)
            ->nonQueued();
    }

    // Policies =======================================================
    public function canEditOrView(?int $user_id = null)
    {
        if (auth()->user()->isAdmin) {
            return true;
        }
        if ($user_id === null) {
            $user_id = auth()->id();
        }

        return $this->id === $user_id;
    }
}
