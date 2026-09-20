<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\MasterSchedule;
use App\Models\Player;
use App\Models\Team;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;




class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        $startOfWeek  = Carbon::now()->startOfWeek();
        $startOfMonth = Carbon::now()->startOfMonth();
        $startOfYear  = Carbon::now()->startOfYear();

        // DEFAULT VALUE
        $revenueToday = 0;
        $revenueWeek  = 0;
        $revenueMonth = 0;
        $revenueYear  = 0;

        $bookingTodayCount = 0;
        $upcomingEvents    = 0;
        $bookingPending     = 0;
        $bookingApproved    = 0;
        $bookingThisMonth   = 0;
        $bookingRejected = 0;
        $bookingTotal    = 0;

        $activePlayers      = 0;
        $activeTeams        = 0;

        $latestBookings     = collect();
        $todaySchedules = collect();

        // REVENUE
        if (Schema::hasTable('bookings')) {

            $revenueToday = Booking::whereDate('booking_date', $today)
                ->where('payment_status', 'paid')
                ->where('status', 'approved')
                ->sum('total_price');
            $revenueWeek = Booking::whereBetween('booking_date', [
                    $startOfWeek->toDateString(),
                    now()->toDateString()
                ])
                ->where('payment_status', 'paid')
                ->where('status', 'approved')
                ->sum('total_price');
            $revenueMonth = Booking::whereMonth('booking_date', now()->month)
                ->whereYear('booking_date', now()->year)
                ->where('payment_status', 'paid')
                ->where('status', 'approved')
                ->sum('total_price');
            $revenueYear = Booking::whereYear('booking_date', now()->year)
                ->where('payment_status', 'paid')
                ->where('status', 'approved')
                ->sum('total_price');
        }

        // BOOKING
        if (Schema::hasTable('bookings')) {

            $bookingTodayCount = Booking::whereDate('booking_date', $today)->count();

            $bookingPending = Booking::where('status', 'pending')->count();

            $bookingApproved = Booking::where('status', 'approved')->count();

            $bookingThisMonth = Booking::whereMonth('booking_date', now()->month)
                ->whereYear('booking_date', now()->year)
                ->count();
                $bookingRejected = Booking::where('status', 'rejected')->count();

                $bookingTotal = Booking::count();

            $latestBookings = Booking::latest()
                ->take(5)
                ->get();
                $todaySchedules = MasterSchedule::where('is_active', 1)

                    ->where(function ($q) use ($today) {

                        $q->where(function ($daily) use ($today) {

                            $daily->where('schedule_type', 'daily')
                                ->whereDate('date', $today);

                        })

                        ->orWhere(function ($weekly) use ($today) {

                            $weekly->where('schedule_type', 'weekly')
                                ->where('day_name', strtolower($today->format('l')));

                        });

                    })

                    ->orderBy('start_time')

                    ->get();

        }



        // PLAYER & TEAM
        $totalPlayers  = Player::count();

        $totalTeams    = Team::count();

        $playersNoTeam = Player::whereNull('team_id')->count();

        /*
        |--------------------------------------------------------------------------
        | ACTIVE DATA
        |--------------------------------------------------------------------------
        */

        $activePlayers = Player::where('status', 'active')->count();

        $activeTeams = Team::count();

        // ===========================
        // CHART: HARIAN (7 hari)
        // ===========================
        $dailyLabels = [];
        $dailyData   = [];

        for ($i = 6; $i >= 0; $i--) {

            $date = Carbon::today()->subDays($i);
            $dailyLabels[] = $date->format('d M');
            $dailyData[] = Booking::whereDate('booking_date', $date)
                ->where('payment_status', 'paid')
                ->where('status', 'approved')
                ->sum('total_price');
        }

        // ===========================
        // CHART: MINGGUAN (8 minggu)
        // ===========================
        $weeklyLabels = [];
        $weeklyData   = [];

        for ($i = 7; $i >= 0; $i--) {

            $start = Carbon::now()->startOfWeek()->subWeeks($i);
            $end = (clone $start)->endOfWeek();
            $weeklyLabels[] = 'M-' . $start->format('W');
            $weeklyData[] = Booking::whereBetween(
                    'booking_date',
                    [
                        $start->toDateString(),
                        $end->toDateString()
                    ]
                )
                ->where('payment_status', 'paid')
                ->where('status', 'approved')
                ->sum('total_price');
        }

        // ===========================
        // BOOKING CHART (12 BULAN)
        // ===========================

        $monthlyLabels = [];
        $monthlyData   = [];

        for ($i = 11; $i >= 0; $i--) {

            $start = Carbon::now()->startOfMonth()->subMonths($i);
            $end   = (clone $start)->endOfMonth();

            $monthlyLabels[] = $start->translatedFormat('M');

            $monthlyData[] = Booking::whereBetween(
                'booking_date',
                [$start->toDateString(), $end->toDateString()]
            )->count();
        }

        $chartLabels  = $monthlyLabels;
        $chartRevenue = $monthlyData;

        return view('admin.dashboard.index', compact(

            'revenueToday',
            'revenueWeek',
            'revenueMonth',
            'revenueYear',

            'bookingTodayCount',
            'bookingPending',
            'bookingApproved',
            'bookingThisMonth',
            'bookingRejected',
            'bookingTotal',

            'upcomingEvents',

            'totalPlayers',
            'activePlayers',

            'totalTeams',
            'activeTeams',

            'playersNoTeam',

            'latestBookings',
            'todaySchedules',

            'dailyLabels',
            'dailyData',

            'weeklyLabels',
            'weeklyData',

            'monthlyLabels',
            'monthlyData',

            'chartLabels',
            'chartRevenue',

        ));
    }
}
