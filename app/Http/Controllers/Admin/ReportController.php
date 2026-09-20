<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Dashboard Report
     */
    public function index()
    {
        $today = Carbon::today();

        $totalBooking = Booking::count();

        $todayBooking = Booking::whereDate(
            'booking_date',
            $today
        )->count();

        $pendingBooking = Booking::where(
            'status',
            'pending'
        )->count();

        $approvedBooking = Booking::where(
            'status',
            'approved'
        )->count();

        $rejectedBooking = Booking::where(
            'status',
            'rejected'
        )->count();

        $cancelledBooking = Booking::where(
            'status',
            'cancelled'
        )->count();

        $paidBooking = Booking::where(
            'payment_status',
            'paid'
        )->count();
        $pendingPayment = Booking::where(
            'payment_status',
            'pending'
        )->count();
        $failedPayment = Booking::where(
            'payment_status',
            'failed'
        )->count();
        $unpaidBooking = Booking::where(
            'payment_status',
            'unpaid'
        )->count();

        $totalRevenue = Booking::where(
            'payment_status',
            'paid'
        )
        ->where(
            'status',
            'approved'
        )
        ->sum('total_price');

        $monthRevenue = Booking::whereMonth(
                'booking_date',
                now()->month
            )
            ->whereYear(
                'booking_date',
                now()->year
            )
            ->where(
                'payment_status',
                'paid'
            )
            ->where(
                'status',
                'approved'
            )
            ->sum('total_price');

        $latestBookings = Booking::latest('booking_date')
            ->take(5)
            ->get();

        return view(
            'admin.reports.index',
            compact(
                'totalBooking',
                'todayBooking',
                'pendingBooking',
                'approvedBooking',
                'rejectedBooking',
                'cancelledBooking',
                'paidBooking',
                'pendingPayment',
                'failedPayment',
                'unpaidBooking',
                'totalRevenue',
                'monthRevenue',
                'latestBookings'
            )
        );
    }

    /**
     * Reservation Report
     */
    public function reservation(Request $request)
    {
        $query = Booking::query();

        /*
        |--------------------------------------------------------------------------
        | FILTER TANGGAL
        |--------------------------------------------------------------------------
        */

        if ($request->filled('start_date')) {

            $query->whereDate(
                'booking_date',
                '>=',
                $request->start_date
            );

        }

        if ($request->filled('end_date')) {

            $query->whereDate(
                'booking_date',
                '<=',
                $request->end_date
            );

        }

        /*
        |--------------------------------------------------------------------------
        | STATUS
        |--------------------------------------------------------------------------
        */

        if ($request->filled('status')) {

            $query->where(
                'status',
                $request->status
            );

        }

        /*
        |--------------------------------------------------------------------------
        | PAYMENT
        |--------------------------------------------------------------------------
        */

        if ($request->filled('payment_status')) {

            $query->where(
                'payment_status',
                $request->payment_status
            );

        }

        if ($request->filled('payment_method')) {

            $query->where(
                'payment_method',
                $request->payment_method
            );

        }

        /*
        |--------------------------------------------------------------------------
        | SOURCE
        |--------------------------------------------------------------------------
        */

        if ($request->filled('booking_source')) {

            $query->where(
                'booking_source',
                $request->booking_source
            );

        }

        /*
        |--------------------------------------------------------------------------
        | CUSTOMER
        |--------------------------------------------------------------------------
        */

        if ($request->filled('keyword')) {

            $query->where(function ($q) use ($request) {

                $q->where(
                    'customer_name',
                    'like',
                    '%'.$request->keyword.'%'
                )
                ->orWhere(
                    'club_name',
                    'like',
                    '%'.$request->keyword.'%'
                );

            });

        }

        $bookings = $query
            ->orderByDesc('booking_date')
            ->orderBy('start_time')
            ->paginate(15)
            ->withQueryString();

        /*
        |--------------------------------------------------------------------------
        | SUMMARY
        |--------------------------------------------------------------------------
        */

        $summary = (clone $query);

        $totalBooking = $summary->count();

        $approvedBooking = (clone $query)
            ->where('status','approved')
            ->count();

        $pendingBooking = (clone $query)
            ->where('status','pending')
            ->count();

        $rejectedBooking = (clone $query)
            ->where('status','rejected')
            ->count();

        $cancelledBooking = (clone $query)
            ->where('status','cancelled')
            ->count();

        $paidRevenue = (clone $query)
            ->where('payment_status','paid')
            ->where('status','approved')
            ->sum('total_price');

        return view(
            'admin.reports.reservation_reports',
            compact(
                'bookings',

                'totalBooking',
                'approvedBooking',
                'pendingBooking',
                'rejectedBooking',
                'cancelledBooking',

                'paidRevenue'
            )
        );
    }
}
