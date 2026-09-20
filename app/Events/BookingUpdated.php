<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class BookingUpdated implements ShouldBroadcastNow
{
    
    public $booking;
    public function __construct($booking)
    {
        $this->booking = $booking;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('booking-channel');
    }

    public function broadcastAs()
    {
        // Jika pakai ini, di JS panggil .listen('BookingUpdated') tanpa titik
        return 'BookingUpdated';
    }
}
