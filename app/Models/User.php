<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Notifications\AdminNewUserNotification;
use App\Notifications\WelcomeUserNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

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
            $user->reviews->delete();
            $user->complaints->delete();
            $user->places->delete();
        });

        static::created(function ($user) {
            $user->notify(new WelcomeUserNotification());
            $admins = User::where('isAdmin', '=', 1)->get();
            foreach ($admins as $admin) {
                $admin->notify(new AdminNewUserNotification($user));
            }
        });
    }
}
