<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\MasterSchedule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class BookingController extends Controller
{
    public function index()


    {
        /*
        |--------------------------------------------------------------------------
        | BOOKINGS
        |--------------------------------------------------------------------------
        */

        $bookings = Booking::orderBy(
            'booking_date'
        )
        ->orderBy(
            'start_time'
        )
        ->get();

        /*
        |--------------------------------------------------------------------------
        | MASTER SCHEDULE
        |--------------------------------------------------------------------------
        */

        $masterSchedules = MasterSchedule::active()
            ->orderBy('schedule_type')
            ->get();



$bookingsJson = $bookings->map(function ($booking) {

    return [

        'id' => $booking->id,

        'date' => $booking->booking_date,

        'start' => substr($booking->start_time,0,5),

        'end' => substr($booking->end_time,0,5),

        'customer' => $booking->customer_name,

        'club_name' => $booking->club_name,

        'phone' => $booking->phone,

        'status' => strtolower($booking->status),

        'payment_status' => strtolower($booking->payment_status),

        'booking_source' => $booking->booking_source,

        'purpose' => $booking->purpose,

        'notes' => $booking->notes,

        'total_price' => $booking->total_price,

    ];

})->values();

$masterSchedulesJson = $masterSchedules->map(function ($item){

    return [

        'id'=>$item->id,

        'mode'=>$item->mode,

        'schedule_type'=>$item->schedule_type,

        'day_name'=>$item->day_name,

        'date'=>optional($item->date)->format('Y-m-d'),

        'all_day'=>(bool)$item->all_day,

        'start'=>substr($item->start_time,0,5),

        'end'=>substr($item->end_time,0,5),

        'description'=>$item->description,

    ];

})->values();
return view(
    'user.booking.index',
    [
        'bookings' => $bookings,
        'masterSchedules' => $masterSchedules,
        'bookingsJson' => $bookingsJson,
        'masterSchedulesJson' => $masterSchedulesJson,
    ]
);


    }

public function store(Request $request)
{
    $request->validate([
        'booking_date'    => 'required|date',
        'start_time'      => 'required',
        'end_time'        => 'required',
        'purpose'         => 'required|string|max:100',
        'notes'           => 'nullable|string|max:500',
        'payment_method'  => 'required|in:transfer,cash',
        'payment_proof'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    if (
        Carbon::parse($request->booking_date)
            ->startOfDay()
            ->lt(Carbon::today('Asia/Jakarta'))
    ) {
        return back()
            ->withInput()
            ->withErrors([
                'booking_date' =>
                    'Tanggal booking sudah lewat. Silakan pilih tanggal hari ini atau setelahnya.'
            ]);
    }

    $user = Auth::user();

    $start = Carbon::parse(
        $request->booking_date.' '.$request->start_time
    );

    $end = Carbon::parse(
        $request->booking_date.' '.$request->end_time
    );

    /*
    |--------------------------------------------------------------------------
    | VALIDASI DURASI
    |--------------------------------------------------------------------------
    */

    if($end->lessThanOrEqualTo($start)){
        return back()
            ->withInput()
            ->withErrors([
                'start_time' => 'Jam booking tidak valid.'
            ]);
    }

    $duration = $start->diffInHours($end);

    if($duration > 4){
        return back()
            ->withInput()
            ->withErrors([
                'end_time' => 'Maksimal booking 4 jam.'
            ]);
    }

    $totalPrice = $duration * 80000;

        /*
    |--------------------------------------------------------------------------
    | CEK BOOKING BENTROK
    |--------------------------------------------------------------------------
    */

    $bookingConflict = Booking::whereDate(
            'booking_date',
            $request->booking_date
        )
        ->whereIn('status', [
            'Pending',
            'Approved',
        ])
        ->where(function ($query) use ($request) {

            $query
                ->where(
                    'start_time',
                    '<',
                    $request->end_time
                )
                ->where(
                    'end_time',
                    '>',
                    $request->start_time
                );

        })
        ->exists();

    if ($bookingConflict) {

        return back()
            ->withInput()
            ->withErrors([
                'start_time' =>
                    'Jam tersebut sudah dibooking.'
            ]);

    }

    /*
    |--------------------------------------------------------------------------
    | CEK MASTER SCHEDULE
    |--------------------------------------------------------------------------
    */

    $masterRules = MasterSchedule::active()
        ->where(function ($query) use ($request) {

            $query
                ->whereDate(
                    'date',
                    $request->booking_date
                )
                ->orWhere(function ($q) use ($request) {

                    $dayName = Carbon::parse(
                        $request->booking_date
                    )->format('l');

                    $q->whereNull('date')
                        ->where(
                            'day_name',
                            $dayName
                        );

                });

        })
        ->get();

    foreach ($masterRules as $rule) {

        if (
            $request->start_time >= substr($rule->end_time,0,5) ||
            $request->end_time <= substr($rule->start_time,0,5)
        ) {
            continue;
        }

        /*
        |--------------------------------------------------------------------------
        | OVERRIDE = BOLEH BOOKING
        |--------------------------------------------------------------------------
        */

        if ($rule->mode === 'override') {
            continue;
        }

        /*
        |--------------------------------------------------------------------------
        | PRACTICE / HOLIDAY = TOLAK
        |--------------------------------------------------------------------------
        */

        return back()
            ->withInput()
            ->withErrors([
                'start_time' =>
                    'Lapangan tidak tersedia pada jam tersebut.'
            ]);

    }
        /*
    |--------------------------------------------------------------------------
    | BUKTI TRANSFER
    |--------------------------------------------------------------------------
    */

    $paymentProof = null;

    if ($request->payment_method === 'transfer') {

        $request->validate([
            'payment_proof' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $paymentProof = $request
            ->file('payment_proof')
            ->store('payment_proofs', 'public');

    }

    /*
    |--------------------------------------------------------------------------
    | SIMPAN BOOKING
    |--------------------------------------------------------------------------
    */

    Booking::create([

        'user_id'          => $user->id,

        'customer_name'    => $user->name,

        'club_name'        => $user->user_type == 'club'
                                ? $user->club_name
                                : null,

        'phone'            => $user->phone,

        'booking_source'   => 'user',

        'booking_date'     => $request->booking_date,

        'start_time'       => $request->start_time,

        'end_time'         => $request->end_time,

        'purpose'          => $request->purpose,

        'notes'            => $request->notes,

        'status'           => 'Pending',

        'payment_method'   => $request->payment_method,

        'payment_status'   => 'Unpaid',

        'payment_proof'    => $paymentProof,

        'total_price'      => $totalPrice,


    ]);





    return redirect()
        ->route('user.booking.history')
        ->with(
            'success',
            'Booking berhasil dibuat dan menunggu persetujuan Admin.'
        );

}

public function history()
{
    $bookings = Booking::where(
            'user_id',
            Auth::id()
        )
        ->orderByDesc('booking_date')
        ->orderByDesc('start_time')
        ->paginate(10);

    return view(
        'user.booking.history',
        [
            'bookings' => $bookings,
        ]
    );
}

public function detail($id)
{
    $booking = Booking::where(
            'user_id',
            Auth::id()
        )
        ->findOrFail($id);

    return view(
        'user.booking.detail',
        [
            'booking' => $booking,
        ]
    );
}

}

