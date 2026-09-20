<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\MasterSchedule;

class ScheduleController extends Controller
{
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | BOOKING
        |--------------------------------------------------------------------------
        | Ambil booking yang memang ditampilkan pada Schedule Board.
        | Pending tetap ditampilkan karena slot sudah reserved.
        |--------------------------------------------------------------------------
        */

        $bookings = Booking::whereIn('status', [
                'approved',
                'pending',
                'training',
            ])
            ->orderBy('booking_date')
            ->orderBy('start_time')
            ->get()
            ->map(function ($booking) {

                return [
                    'id' => $booking->id,

                    'booking_date' => optional(
                        $booking->booking_date
                    )->format('Y-m-d'),

                    'start_time' => substr(
                        (string) $booking->start_time,
                        0,
                        5
                    ),

                    'end_time' => substr(
                        (string) $booking->end_time,
                        0,
                        5
                    ),

                    'customer' =>
                        $booking->club_name
                        ?: $booking->customer_name,

                    'status' => $booking->status,
                ];
            })
            ->values();

        /*
        |--------------------------------------------------------------------------
        | MASTER SCHEDULE
        |--------------------------------------------------------------------------
        | Practice / Holiday / Override
        |--------------------------------------------------------------------------
        */

        $masterSchedules = MasterSchedule::active()
            ->orderBy('schedule_type')
            ->orderBy('day_name')
            ->orderBy('start_time')
            ->get()
            ->map(function ($schedule) {

                return [
                    'id' => $schedule->id,

                    'mode' => $schedule->mode,

                    'schedule_type' =>
                        $schedule->schedule_type,

                    'day_name' =>
                        $schedule->day_name,

                    'date' => $schedule->date
                        ? $schedule->date->format('Y-m-d')
                        : null,

                    'all_day' =>
                        (bool) $schedule->all_day,

                    'start' => substr(
                        (string) $schedule->start_time,
                        0,
                        5
                    ),

                    'end' => substr(
                        (string) $schedule->end_time,
                        0,
                        5
                    ),

                    'description' =>
                        $schedule->description,
                ];
            })
            ->values();

        /*
        |--------------------------------------------------------------------------
        | VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'main.jadwal.jadwal',
            compact(
                'bookings',
                'masterSchedules'
            )
        );
    }
}
