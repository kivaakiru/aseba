<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [

        'user_id',

        'customer_name',

        'club_name',

        'phone',

        'booking_source',

        'booking_date',

        'start_time',

        'end_time',

        'purpose',

        'notes',

        'status',

        'payment_method',

        'payment_status',

        'total_price',

        'approved_by',

        'reject_reason',

        'payment_proof',

    ];

    protected $casts = [

    'booking_date' => 'date',

    'total_price' => 'decimal:2',

];

    /*
    |--------------------------------------------------------------------------
    | RELATION
    |--------------------------------------------------------------------------
    */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    public function scopeBookingDate($query, $date)
    {
        return $query->whereDate('booking_date', $date);
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESSOR
    |--------------------------------------------------------------------------
    */

    public function getDurationAttribute()
{
    if (!$this->start_time || !$this->end_time) {
        return 0;
    }

    $start = \Carbon\Carbon::createFromFormat(
        'H:i:s',
        $this->start_time
    );

    $end = \Carbon\Carbon::createFromFormat(
        'H:i:s',
        $this->end_time
    );

    return $start->diffInHours($end);
}

}
