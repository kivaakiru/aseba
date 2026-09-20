<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\MasterSchedule;
use App\Models\User;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * ==========================================================
     * Booking List
     * ==========================================================
     */
    public function index()
    {
        $bookings = Booking::query()
            ->orderBy('booking_date')
            ->orderBy('start_time')
            ->get()
            ->map(function ($booking) {

                return [

                    'id' => $booking->id,

                    'date' => date(
                        'Y-m-d',
                        strtotime($booking->booking_date)
                    ),

                    'start' => substr(
                        $booking->start_time,
                        0,
                        5
                    ),

                    'end' => substr(
                        $booking->end_time,
                        0,
                        5
                    ),

                    'customer' => $booking->club_name
                        ?: $booking->customer_name,

                    'phone' => $booking->phone,

                    'booking_source' => $booking->booking_source,

                    'status' => $booking->status,

                    'added_by' => optional(
                        $booking->user
                    )->name
                    ?? 'Administrator',
                    'source' => strtolower($booking->booking_source),

                    'payment_method' => $booking->payment_method,

                    'payment_status' => $booking->payment_status,

                    'total_price' => $booking->total_price,

                    'purpose' => $booking->purpose,

                    'notes' => $booking->notes,

                ];

            });

        $masterSchedules = $this->getMasterSchedules();

        return view(
            'admin.courts.bookings',
            compact(
                'bookings',
                'masterSchedules'
            )
        );
    }

    /**
     * ==========================================================
     * Create Booking
     * ==========================================================
     */
    public function create()
{
    $users = User::where('status', 'active')
    ->orderBy('user_type')
    ->orderBy('name')
    ->get([
        'id',
        'name',
        'email',
        'phone',
        'user_type',
        'status'
    ]);

    $bookings = Booking::whereIn('status', [
        'approved',
        'pending',
        'training'
    ])
    ->get()
    ->map(function ($booking) {

        return [

            'booking_date' => optional($booking->booking_date)
                ->format('Y-m-d'),

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

        ];

    })
    ->values();

    $masterSchedules = $this->getMasterSchedules();

    return view(
        'admin.courts.create',
        compact(
            'users',
            'bookings',
            'masterSchedules'
        )
    );
}

    /**
     * ==========================================================
     * Store Booking
     * ==========================================================
     */
    public function store(Request $request)
{
    $request->validate([

        'booking_date' => ['required','date'],

        'start_time' => ['required'],

        'end_time' => ['required'],

    ]);

    /*
    |--------------------------------------------------------------------------
    | CUSTOMER
    |--------------------------------------------------------------------------
    */

    $customerName = null;
    $clubName = null;
    $phone = null;
    $userId = null;

    if ($request->booking_type === 'user') {

        $user = User::findOrFail($request->user_id);

        $userId = $user->id;

        if ($user->user_type === 'club') {

            $customerName = $user->name;

            $clubName = $user->name;

        } else {

            $customerName = $user->name;

            $clubName = null;

        }

        $phone = $user->phone;

    } else {

        $customerName = $request->customer_name;

        $clubName = $request->club_name;

        $phone = $request->phone;

    }

    /*
|--------------------------------------------------------------------------
| CEK MASTER SCHEDULE
|--------------------------------------------------------------------------
*/

$startHour = (int) substr($request->start_time, 0, 2);
$endHour   = (int) substr($request->end_time, 0, 2);

for ($hour = $startHour; $hour < $endHour; $hour++) {

    $status = $this->getSlotStatus(
        $request->booking_date,
        sprintf('%02d:00:00', $hour)
    );

    if ($status === 'holiday') {

        return back()

            ->withInput()

            ->with(
                'error',
                'Jam '.sprintf('%02d:00', $hour).' sedang libur.'
            );

    }

    if ($status === 'practice') {

        return back()

            ->withInput()

            ->with(
                'error',
                'Jam '.sprintf('%02d:00', $hour).' digunakan untuk latihan klub.'
            );

    }

}


    /*
    |--------------------------------------------------------------------------
    | CEK BENTROK
    |--------------------------------------------------------------------------
    */

    $exists = Booking::whereDate(
            'booking_date',
            $request->booking_date
        )
        ->where(function ($query) use ($request) {

            $query->where(
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
        ->whereIn('status',[
            'approved',
            'pending'
        ])
        ->exists();

    if($exists){

        return back()

            ->withInput()

            ->with(
                'error',
                'Jadwal tersebut sudah dibooking.'
            );

    }

    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */

    Booking::create([

        'user_id' => $userId,

        'customer_name' => $customerName,

        'club_name' => $clubName,

        'phone' => $phone,

        'booking_source' => 'admin',

        'booking_date' => $request->booking_date,

        'start_time' => $request->start_time,

        'end_time' => $request->end_time,

        'purpose' => $request->purpose,

        'notes' => $request->notes,

        'status' => 'approved',

        'payment_method' => 'cash',

        'payment_status' => 'unpaid',

        'total_price' => $request->total_price,

        'approved_by' => auth()->id(),

    ]);

    return redirect()

        ->route('admin.courts.bookings')

        ->with(
            'success',
            'Booking berhasil ditambahkan.'
        );
}

        /**
     * ==========================================================
     * Show Booking
     * ==========================================================
     */
    public function show(Booking $booking)
    {
        $masterSchedules = $this->getMasterSchedules();

        return view(
            'admin.courts.show',
            compact(
                'booking',
                'masterSchedules'
            )
        );
    }

    /**
     * ==========================================================
     * Edit Booking
     * ==========================================================
     */
    public function edit(Booking $booking)
    {
        $masterSchedules = $this->getMasterSchedules();

        return view(
            'admin.courts.bookings.edit',
            compact(
                'booking',
                'masterSchedules'
            )
        );
    }

    /**
     * ==========================================================
     * Update Booking
     * ==========================================================
     */
    public function update(
    Request $request,
    Booking $booking
)
{
    $request->validate([
        'payment_status' => 'required|in:unpaid,paid',
    ]);

    $booking->update([
        'payment_status' => $request->payment_status,
    ]);

    return redirect()
        ->route('admin.courts.history', [
            'date' => $booking->booking_date,
        ])
        ->with(
            'success',
            'Status pembayaran berhasil diperbarui.'
        );
}

    /**
     * ==========================================================
     * Delete Booking
     * ==========================================================
     */
    public function destroy(Booking $booking)
    {
        $booking->delete();

        return redirect()
            ->route('admin.courts.bookings')
            ->with(
                'success',
                'Booking berhasil dihapus.'
            );
    }

    /**
     * ==========================================================
     * Approval List
     * ==========================================================
     */
    public function approval()
    {
        $bookings = Booking::with([
                'user',
                'approver'
            ])
            ->where('booking_source', 'user')
            ->where(function ($query) {

                $query->where('status', 'pending')

                    ->orWhere(function ($q) {

                        $q->where('status', 'approved')
                        ->where('payment_method', 'cash')
                        ->where('payment_status', 'unpaid');

                    });

            })
            ->orderBy('booking_date')
            ->orderBy('start_time')
            ->get();

        $pendingCount = $bookings->count();

        $approvedToday = Booking::whereDate(
                'updated_at',
                today()
            )
            ->where('booking_source', 'user')
            ->where('status', 'approved')
            ->count();

        $rejectedToday = Booking::whereDate(
                'updated_at',
                today()
            )
            ->where('booking_source', 'user')
            ->where('status', 'rejected')
            ->count();

        $waitingPayment = Booking::where(
            'booking_source',
            'user'
        )
        ->where('status','approved')
        ->where('payment_method','cash')
        ->where('payment_status','unpaid')
        ->count();

        return view(
            'admin.courts.approval',
            compact(
                'bookings',
                'pendingCount',
                'approvedToday',
                'rejectedToday',
                'waitingPayment'
            )
        );
    }

        /**
     * ==========================================================
     * Approve Booking
     * ==========================================================
     */
    public function approve(Booking $booking)
        {
            $booking->status = 'approved';

            $booking->approved_by = auth()->id();

            /*
            |--------------------------------------------------------------------------
            | PAYMENT
            |--------------------------------------------------------------------------
            */

            if ($booking->payment_method === 'transfer') {

                // transfer sudah dibayar user
                $booking->payment_status = 'paid';

            } else {

                // cash bayar di lapangan
                $booking->payment_status = 'unpaid';

            }

            $booking->save();

            return back()->with(
                'success',
                'Booking berhasil disetujui.'
            );
        }

    /**
     * ==========================================================
     * Reject Booking
     * ==========================================================
     */
    public function reject(
        Request $request,
        Booking $booking
    )

    {
        $request->validate([

            'reject_reason' => 'required|string|max:1000',

        ]);

        $booking->status = 'rejected';

        $booking->reject_reason = $request->reject_reason;

        $booking->approved_by = auth()->id();

        /*
        |--------------------------------------------------------------------------
        | PAYMENT
        |--------------------------------------------------------------------------
        */

        if ($booking->payment_method === 'cash') {

            $booking->payment_status = 'unpaid';

        } else {

            // transfer tetap paid karena uang sudah diterima
            $booking->payment_status = 'paid';

        }

        $booking->save();

        return back()->with(
            'success',
            'Booking berhasil ditolak.'
        );

    }
    public function confirmPayment(Booking $booking)
    {
        if ($booking->payment_method !== 'cash') {

            return back()->with(
                'error',
                'Konfirmasi pembayaran hanya untuk metode Cash.'
            );

        }

        if ($booking->status !== 'approved') {

            return back()->with(
                'error',
                'Booking harus sudah disetujui.'
            );

        }

        if ($booking->payment_status === 'paid') {

            return back()->with(
                'info',
                'Pembayaran sudah dikonfirmasi.'
            );

        }

        $booking->payment_status = 'paid';

        $booking->save();

        return back()->with(
            'success',
            'Pembayaran berhasil dikonfirmasi.'
        );
    }

    /**
     * ==========================================================
     * Booking History
     * ==========================================================
     */
    public function history(Request $request)
{
    $selectedDate = $request->date ?: now()->toDateString();

    $query = Booking::with([
            'user',
            'approver'
        ])
        ->whereIn('status', [
            'approved',
            'rejected'
        ])
        ->whereDate('booking_date', $selectedDate);

    if ($request->filled('search')) {

        $query->where(function ($q) use ($request) {

            $q->where('customer_name', 'like', '%' . $request->search . '%')
              ->orWhere('club_name', 'like', '%' . $request->search . '%')
              ->orWhere('phone', 'like', '%' . $request->search . '%');

        });

    }

    if ($request->filled('status')) {

        $query->where('status', $request->status);

    }

    if ($request->filled('payment')) {

        $query->where('payment_method', $request->payment);

    }

    $bookings = $query
        ->orderBy('start_time')
        ->get();

    $totalBooking = $bookings->count();

    $approvedCount = $bookings
        ->where('status', 'approved')
        ->count();

    $rejectedCount = $bookings
        ->where('status', 'rejected')
        ->count();

    return view(
        'admin.courts.history',
        compact(
            'bookings',
            'totalBooking',
            'approvedCount',
            'rejectedCount',
            'selectedDate'
        )
    );
}

public function masterSchedules()
{
    return response()->json(

        MasterSchedule::active()

            ->orderBy('mode')

            ->orderBy('day_name')

            ->orderBy('start_time')

            ->get([

                'id',

                'mode',

                'schedule_type',

                'day_name',

                'date',

                'all_day',

                'start_time',

                'end_time',

                'description',

            ])

    );
}

public function settings()
{
    $rules = MasterSchedule::active()
        ->latest()
        ->get();

    $practiceCount = MasterSchedule::active()
        ->practice()
        ->count();

    $holidayCount = MasterSchedule::active()
        ->holiday()
        ->count();

    $overrideCount = MasterSchedule::active()
        ->override()
        ->count();

    $totalRule = MasterSchedule::active()->count();

    $masterSchedules = $this->getMasterSchedules();

    return view(
        'admin.courts.settings',
        compact(
            'rules',
            'practiceCount',
            'holidayCount',
            'overrideCount',
            'totalRule',
            'masterSchedules'
        )
    );
}

public function storeSetting(Request $request)
{
    $request->validate([

        'mode' => 'required|in:practice,holiday,override',

        'schedule_type' => 'required|in:weekly,daily',

        'description' => 'required|max:255',

    ]);

    if ($request->schedule_type === 'weekly') {

        if (!$request->filled('day_name')) {

            return back()

                ->withInput()

                ->withErrors([

                    'day_name' => 'Silakan pilih hari.'

                ]);

        }

    }

    $allDay = $request->boolean('all_day');

    /*
|--------------------------------------------------------------------------
| VALIDASI DUPLICATE RULE
|--------------------------------------------------------------------------
*/

$exists = MasterSchedule::query()

    ->where('is_active', true)

    ->where('schedule_type', $request->schedule_type)

    ->when($request->schedule_type === 'weekly', function ($query) use ($request) {

        $query->where('day_name', $request->day_name);

    })

    ->when($request->schedule_type === 'daily', function ($query) use ($request) {

        $query->whereDate('date', $request->date);

    })

    ->where(function ($query) use ($request, $allDay) {

        if ($allDay) {

            $query->where(function ($q) {

                $q->where('all_day', true)
                  ->orWhere(function ($time) {

                      $time->where('all_day', false);

                  });

            });

        } else {

            $query->where(function ($time) use ($request) {

                $time->where('all_day', true)

                     ->orWhere(function ($overlap) use ($request) {

                        $overlap
                            ->where('start_time', '<', $request->end_time)
                            ->where('end_time', '>', $request->start_time);

                     });

            });

        }

    })

    ->exists();

if ($exists) {

    return back()

        ->withInput()

        ->with(
            'error',
            'Sudah ada rule pada jadwal tersebut. Silakan edit rule yang sudah ada.'
        );

}

    /*
|--------------------------------------------------------------------------
| DUPLICATE RULE
|--------------------------------------------------------------------------
*/

$exists = MasterSchedule::query()
    ->where('schedule_type', $request->schedule_type)
    ->when($request->schedule_type === 'weekly', function ($q) use ($request) {
        $q->where('day_name', $request->day_name);
    })
    ->when($request->schedule_type === 'daily', function ($q) use ($request) {
        $q->whereDate('date', $request->date);
    })
    ->where(function ($q) use ($request, $allDay) {

        if ($allDay) {

            $q->where('all_day', true);

        } else {

            $q->where(function ($time) use ($request) {

                $time->where('start_time', '<', $request->end_time)
                     ->where('end_time', '>', $request->start_time);

            });

        }

    })
    ->exists();

if ($exists) {

    return back()
        ->withInput()
        ->with(
            'error',
            'Sudah ada rule pada jadwal tersebut. Gunakan Edit jika ingin mengubah aturan.'
        );

}

    MasterSchedule::create([

        'mode' => $request->mode,

        'schedule_type' => $request->schedule_type,

        'day_name' => $request->schedule_type === 'weekly'
            ? $request->day_name
            : null,

        'date' => $request->schedule_type === 'daily'
            ? $request->date
            : null,

        'all_day' => $allDay,

        'start_time' => $allDay
            ? '08:00:00'
            : $request->start_time,

        'end_time' => $allDay
            ? '23:00:00'
            : $request->end_time,

        'description' => $request->description,

        'is_active' => true,

        'created_by' => auth()->id(),

    ]);

    return redirect()

        ->route('admin.courts.settings')

        ->with(

            'success',

            'Pengaturan lapangan berhasil disimpan.'

        );
}

public function editSetting(MasterSchedule $schedule)
{
    return view(
        'admin.courts.setting_edit',
        compact('schedule')
    );
}

public function updateSetting(
    Request $request,
    MasterSchedule $schedule
)
{
    $request->validate([

        'mode' => 'required|in:practice,holiday,override',

        'schedule_type' => 'required|in:weekly,daily',

        'description' => 'required|max:255',

    ]);


    if (
        $request->schedule_type === 'weekly' &&
        !$request->filled('day_name')
    ) {

        return back()
            ->withInput()
            ->withErrors([
                'day_name' => 'Silakan pilih hari.'
            ]);

    }

    $allDay = $request->boolean('all_day');

    /*
|--------------------------------------------------------------------------
| VALIDASI DUPLICATE RULE
|--------------------------------------------------------------------------
*/

$exists = MasterSchedule::query()

    ->where('id', '!=', $schedule->id)

    ->where('is_active', true)

    ->where('schedule_type', $request->schedule_type)

    ->when($request->schedule_type === 'weekly', function ($query) use ($request) {

        $query->where('day_name', $request->day_name);

    })

    ->when($request->schedule_type === 'daily', function ($query) use ($request) {

        $query->whereDate('date', $request->date);

    })

    ->where(function ($query) use ($request, $allDay) {

        if ($allDay) {

            $query->where('all_day', true);

        } else {

            $query->where(function ($time) use ($request) {

                $time->where('all_day', true)

                     ->orWhere(function ($overlap) use ($request) {

                        $overlap
                            ->where('start_time', '<', $request->end_time)
                            ->where('end_time', '>', $request->start_time);

                     });

            });

        }

    })

    ->exists();

if ($exists) {

    return back()

        ->withInput()

        ->with(
            'error',
            'Sudah ada rule pada jadwal tersebut. Silakan edit rule yang sudah ada.'
        );

}

    $schedule->update([

        'mode' => $request->mode,

        'schedule_type' => $request->schedule_type,

        'day_name' => $request->schedule_type === 'weekly'
            ? $request->day_name
            : null,

        'date' => $request->schedule_type === 'daily'
            ? $request->date
            : null,

        'all_day' => $allDay,

        'start_time' => $allDay
            ? '08:00:00'
            : $request->start_time,

        'end_time' => $allDay
            ? '23:00:00'
            : $request->end_time,

        'description' => $request->description,

    ]);


    return redirect()
        ->route('admin.courts.settings')
        ->with(
            'success',
            'Pengaturan berhasil diperbarui.'
        );
}



public function toggleSetting(MasterSchedule $schedule)
{
    $schedule->update([

        'is_active' => ! $schedule->is_active,

    ]);

    return back();
}

public function destroySetting(MasterSchedule $schedule)
{
    $schedule->delete();

    return redirect()
        ->route('admin.courts.settings')
        ->with(
            'success',
            'Pengaturan berhasil dihapus.'
        );
}

protected function getMasterSchedules()
{
    return MasterSchedule::active()

        ->orderBy('mode')

        ->orderBy('day_name')

        ->orderBy('date')

        ->orderBy('start_time')

        ->get()

        ->map(function ($schedule) {

            return [

                'id' => $schedule->id,

                'mode' => $schedule->mode,

                'schedule_type' => $schedule->schedule_type,

                'day_name' => $schedule->day_name,

                'date' => optional(
                    $schedule->date
                )?->format('Y-m-d'),

                'all_day' => $schedule->all_day,

                'start' => substr(
                    $schedule->start_time,
                    0,
                    5
                ),

                'end' => substr(
                    $schedule->end_time,
                    0,
                    5
                ),

                'description' => $schedule->description,

            ];

        })

        ->values();
}

protected function getSlotStatus($date, $time)
{
    $dayName = date('l', strtotime($date));

    /*
    |--------------------------------------------------------------------------
    | DAILY RULE (Prioritas Tertinggi)
    |--------------------------------------------------------------------------
    */

    /*
|--------------------------------------------------------------------------
| DAILY OVERRIDE
|--------------------------------------------------------------------------
*/

$dailyOverride = MasterSchedule::active()
    ->override()
    ->where('schedule_type', 'daily')
    ->whereDate('date', $date)
    ->where(function ($query) use ($time) {
        $query
            ->where('all_day', true)
            ->orWhere(function ($slot) use ($time) {
                $slot
                    ->where('start_time', '<=', $time)
                    ->where('end_time', '>', $time);
            });
    })
    ->exists();

if ($dailyOverride) {
    return 'available';
}

/*
|--------------------------------------------------------------------------
| DAILY PRACTICE
|--------------------------------------------------------------------------
*/

$dailyPractice = MasterSchedule::active()
    ->practice()
    ->where('schedule_type', 'daily')
    ->whereDate('date', $date)
    ->where(function ($query) use ($time) {
        $query
            ->where('all_day', true)
            ->orWhere(function ($slot) use ($time) {
                $slot
                    ->where('start_time', '<=', $time)
                    ->where('end_time', '>', $time);
            });
    })
    ->exists();

if ($dailyPractice) {
    return 'practice';
}

/*
|--------------------------------------------------------------------------
| DAILY HOLIDAY
|--------------------------------------------------------------------------
*/

$dailyHoliday = MasterSchedule::active()
    ->holiday()
    ->where('schedule_type', 'daily')
    ->whereDate('date', $date)
    ->where(function ($query) use ($time) {
        $query
            ->where('all_day', true)
            ->orWhere(function ($slot) use ($time) {
                $slot
                    ->where('start_time', '<=', $time)
                    ->where('end_time', '>', $time);
            });
    })
    ->exists();

if ($dailyHoliday) {
    return 'holiday';
}

    /*
    |--------------------------------------------------------------------------
    | WEEKLY RULE
    |--------------------------------------------------------------------------
    */

    /*
|--------------------------------------------------------------------------
| WEEKLY HOLIDAY
|--------------------------------------------------------------------------
*/

$weeklyHoliday = MasterSchedule::active()
    ->holiday()
    ->where('schedule_type', 'weekly')
    ->where('day_name', $dayName)
    ->where(function ($query) use ($time) {
        $query
            ->where('all_day', true)
            ->orWhere(function ($slot) use ($time) {
                $slot
                    ->where('start_time', '<=', $time)
                    ->where('end_time', '>', $time);
            });
    })
    ->exists();

if ($weeklyHoliday) {
    return 'holiday';
}

/*
|--------------------------------------------------------------------------
| WEEKLY PRACTICE
|--------------------------------------------------------------------------
*/

$weeklyPractice = MasterSchedule::active()
    ->practice()
    ->where('schedule_type', 'weekly')
    ->where('day_name', $dayName)
    ->where(function ($query) use ($time) {
        $query
            ->where('all_day', true)
            ->orWhere(function ($slot) use ($time) {
                $slot
                    ->where('start_time', '<=', $time)
                    ->where('end_time', '>', $time);
            });
    })
    ->exists();

if ($weeklyPractice) {
    return 'practice';
}

return 'available';
}

}


