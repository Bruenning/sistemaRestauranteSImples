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

    protected $table = 'user';

    // The attributes that are mass assignable.
    protected $fillable = [
        'email',
        'password',
        'name',
        'is_admin',
        'remember_token'
    ];

    // The attributes that should be hidden for arrays.
    protected $hidden = [
        'password',
        'remember_token',
        'is_admin'
    ];


    // Get the user's reservations.

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    // Get the user's is_admin.
    
    public function isAdmin()
    {
        return $this->is_admin;
    }

    // create a new user

    public static function create(array $attributes = [])
    {
        $user = new User();
        $user->email = $attributes['email'];
        $user->password = $attributes['password'];
        $user->name = $attributes['name'];
        $user->remember_token = $attributes['remember_token'];
        $user->is_admin = false;

        $user->save();

        return $user;
    }

    /**
     * scope
     */

    public function scopeAdmin($query)
    {
        return $query->where('is_admin', true);
    }


}
