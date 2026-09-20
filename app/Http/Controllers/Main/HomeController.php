<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\MasterSchedule;
use App\Models\Player;
use App\Models\Team;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | HARI INI
        |--------------------------------------------------------------------------
        */

        $today = Carbon::today('Asia/Jakarta');

        /*
        |--------------------------------------------------------------------------
        | BOOKING HARI INI
        |--------------------------------------------------------------------------
        |
        | Hanya booking yang sudah APPROVED yang ditampilkan
        | di Landing Page.
        |
        */

        $todayBookings = Booking::whereDate(
                'booking_date',
                $today
            )
            ->where('status', 'approved')
            ->orderBy('start_time')
            ->get()
            ->map(function ($booking) {

                return [
                    'start' => substr(
                        (string) $booking->start_time,
                        0,
                        5
                    ),

                    'end' => substr(
                        (string) $booking->end_time,
                        0,
                        5
                    ),

                    'customer' =>
                        $booking->club_name
                        ?: $booking->customer_name,

                    'status' => 'Booked',
                ];
            })
            ->values();

        /*
        |--------------------------------------------------------------------------
        | LATIHAN ASEBA MINGGU INI
        |--------------------------------------------------------------------------
        */

        $weekStart = $today->copy()->startOfWeek(
            Carbon::MONDAY
        );

        $weekEnd = $today->copy()->endOfWeek(
            Carbon::SUNDAY
        );

        $practiceSchedules = MasterSchedule::active()
            ->practice()
            ->get()
            ->flatMap(function ($schedule) use (
                $weekStart,
                $weekEnd
            ) {

                $result = collect();

                /*
                |--------------------------------------------------------------------------
                | WEEKLY
                |--------------------------------------------------------------------------
                */

                if ($schedule->schedule_type === 'weekly') {

                    $current = $weekStart->copy();

                    while ($current->lte($weekEnd)) {

                        if (
                            strcasecmp(
                                $schedule->day_name,
                                $current->format('l')
                            ) === 0
                        ) {

                            $result->push([
                                'date' => $current->copy(),
                                'description' =>
                                    $schedule->description,
                                'start' =>
                                    substr(
                                        (string) $schedule->start_time,
                                        0,
                                        5
                                    ),
                                'end' =>
                                    substr(
                                        (string) $schedule->end_time,
                                        0,
                                        5
                                    ),
                            ]);
                        }

                        $current->addDay();
                    }
                }

                /*
                |--------------------------------------------------------------------------
                | DAILY
                |--------------------------------------------------------------------------
                */

                if (
                    $schedule->schedule_type === 'daily'
                    && $schedule->date
                ) {

                    $scheduleDate = Carbon::parse(
                        $schedule->date
                    );

                    if (
                        $scheduleDate->between(
                            $weekStart,
                            $weekEnd
                        )
                    ) {

                        $result->push([
                            'date' => $scheduleDate,
                            'description' =>
                                $schedule->description,
                            'start' =>
                                substr(
                                    (string) $schedule->start_time,
                                    0,
                                    5
                                ),
                            'end' =>
                                substr(
                                    (string) $schedule->end_time,
                                    0,
                                    5
                                ),
                        ]);
                    }
                }

                return $result;
            })
            ->sortBy(function ($item) {
                return $item['date']->format('Y-m-d')
                    . ' '
                    . $item['start'];
            })
            ->values();

            /*
            |--------------------------------------------------------------------------
            | LATIHAN HARI INI
            |--------------------------------------------------------------------------
            */

            $todayPractices = $practiceSchedules
                ->filter(function ($practice) use ($today) {
                    return $practice['date']->isSameDay($today);
                })
                ->values();

        /*
        |--------------------------------------------------------------------------
        | ASEBA SUMMARY
        |--------------------------------------------------------------------------
        |
        | Anggota = player aktif
        | Tim = seluruh tim
        |
        */

        $totalAnggota = Player::where(
            'status',
            'active'
        )->count();

        $totalTim = Team::count();

        /*
        |--------------------------------------------------------------------------
        | LANDING PAGE
        |--------------------------------------------------------------------------
        */

        return view(
            'main.home.home',
            compact(
                'todayBookings',
                'todayPractices',
                'practiceSchedules',
                'totalAnggota',
                'totalTim'
            )
        );
    }
}
