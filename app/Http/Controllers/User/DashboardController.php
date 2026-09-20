<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        /*
        |--------------------------------------------------------------------------
        | SUMMARY
        |--------------------------------------------------------------------------
        */

        $totalBooking = Booking::where(
            'user_id',
            $user->id
        )->count();

        $pendingBooking = Booking::where(
            'user_id',
            $user->id
        )
        ->where(
            'status',
            'pending'
        )
        ->count();

        $approvedBooking = Booking::where(
            'user_id',
            $user->id
        )
        ->where(
            'status',
            'approved'
        )
        ->count();

        $unpaidBooking = Booking::where(
            'user_id',
            $user->id
        )
        ->where(
            'payment_status',
            'unpaid'
        )
        ->count();

        /*
        |--------------------------------------------------------------------------
        | NEXT BOOKING
        |--------------------------------------------------------------------------
        */

        $nextBooking = Booking::where(
            'user_id',
            $user->id
        )
        ->whereDate(
            'booking_date',
            '>=',
            Carbon::today()
        )
        ->orderBy(
            'booking_date'
        )
        ->orderBy(
            'start_time'
        )
        ->first();

        /*
        |--------------------------------------------------------------------------
        | LAST BOOKINGS
        |--------------------------------------------------------------------------
        */

        $latestBookings = Booking::where(
            'user_id',
            $user->id
        )
        ->latest()
        ->take(5)
        ->get();

        return view(
            'user.dashboard.index',
            compact(

                'totalBooking',

                'pendingBooking',

                'approvedBooking',

                'unpaidBooking',

                'nextBooking',

                'latestBookings'

            )
        );
    }
}
