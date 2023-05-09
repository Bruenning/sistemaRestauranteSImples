<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservations extends Model
{
    use HasFactory;

    // The attributes that are mass assignable.
    protected $fillable = [
        'start',
        'end',
        'user_id',
    ];

    // Get the user that owns the reservation.
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * 
     */
}
