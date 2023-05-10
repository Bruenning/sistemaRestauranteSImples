<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class User extends Model implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract
{ 
    use Authenticatable, Authorizable, CanResetPassword, MustVerifyEmail, HasFactory, HasApiTokens, Notifiable;

    // The attributes that are mass assignable.
    protected $fillable = [
        'email',
        'password',
        'name',
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

    // Get the user's reservations.

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
    

    /**
     * scope
     */

    public function scopeAdmin($query)
    {
        return $query->where('is_admin', true);
    }

    


}
