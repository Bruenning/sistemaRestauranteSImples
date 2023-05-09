<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable;

    // The attributes that are mass assignable.
    protected $fillable = [
        'email',
        'password',
        'first_name',
        'last_name',
        'is_admin',

    ];

    // The attributes that should be hidden for arrays.
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // The attributes that should be cast.

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // The accessors to append to the model's array form.

    protected $appends = [
        'full_name',
    ];

    // Get the user's full name.

    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    // Get the user's reservations.

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    /**
     * functions
     */

     // get a remember token

    public function getAuthPassword()
    {
        return $this->password;
    }

    // set a remember token


}
