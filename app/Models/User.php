<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
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
        'webpage',
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

    // Event that is executed when a user is created
    protected static function boot()
    {
        parent::boot();

        // Assign profile once a new user has been created
        static::created(function($user) {
            $user->profile()->create();
        });
    }

    // Relation 1:n of User to Recipes
    public function recipes()
    {
        return $this->hasMany(Recipe::class);
    }

    // Relation 1:1 of User and profile
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }
}
