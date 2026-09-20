<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Booking;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'leader_name',
        'email',
        'password',
        'phone',
        'photo',

        'user_type',
        'user_level',
        'is_event_organizer',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /* ================= RELATION ================= */



/**
 * Booking yang dibuat oleh user
 */
public function bookings()
{
    return $this->hasMany(Booking::class);
}

/**
 * Booking yang telah di-approve admin
 */
public function approvedBookings()
{
    return $this->hasMany(
        Booking::class,
        'approved_by'
    );
}
}
