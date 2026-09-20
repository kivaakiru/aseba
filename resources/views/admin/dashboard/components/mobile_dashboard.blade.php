{{-- ==========================================================
    MOBILE DASHBOARD
    Hanya tampil pada layar < lg
========================================================== --}}

<div class="container-fluid px-2 py-2">

    {{-- ======================================================
        SUMMARY
    ======================================================= --}}

    <div class="row g-2 mb-3">

        {{-- Booking --}}
        <div class="col-6">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body p-3">

                    <div class="d-flex justify-content-between align-items-start">

                        <div>

                            <small class="text-muted d-block">
                                Booking
                            </small>

                            <h3 class="fw-bold mb-0">
                                {{ $bookingTodayCount }}
                            </h3>

                        </div>

                        <div
                            class="rounded-circle bg-primary bg-opacity-10 d-flex align-items-center justify-content-center"
                            style="width:42px;height:42px;">

                            <i class="bi bi-calendar-check text-primary"></i>

                        </div>

                    </div>

                    <hr class="my-2">

                    <div class="d-flex justify-content-between small">

                        <span class="text-muted">

                            Pending

                        </span>

                        <strong class="text-warning">

                            {{ $bookingPending }}

                        </strong>

                    </div>

                    <div class="d-flex justify-content-between small mt-1">

                        <span class="text-muted">

                            Approved

                        </span>

                        <strong class="text-success">

                            {{ $bookingApproved }}

                        </strong>

                    </div>

                </div>

            </div>

        </div>

        {{-- Player --}}
        <div class="col-6">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body p-3">

                    <div class="d-flex justify-content-between align-items-start">

                        <div>

                            <small class="text-muted d-block">

                                Players

                            </small>

                            <h3 class="fw-bold mb-0">

                                {{ $totalPlayers }}

                            </h3>

                        </div>

                        <div
                            class="rounded-circle bg-success bg-opacity-10 d-flex align-items-center justify-content-center"
                            style="width:42px;height:42px;">

                            <i class="bi bi-people-fill text-success"></i>

                        </div>

                    </div>

                    <hr class="my-2">

                    <div class="d-flex justify-content-between small">

                        <span class="text-muted">

                            Active

                        </span>

                        <strong class="text-success">

                            {{ $activePlayers }}

                        </strong>

                    </div>

                    <div class="d-flex justify-content-between small mt-1">

                        <span class="text-muted">

                            No Team

                        </span>

                        <strong class="text-danger">

                            {{ $playersNoTeam }}

                        </strong>

                    </div>

                </div>

            </div>

        </div>

        {{-- Team --}}
        <div class="col-6">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body p-3">

                    <div class="d-flex justify-content-between align-items-start">

                        <div>

                            <small class="text-muted d-block">

                                Teams

                            </small>

                            <h3 class="fw-bold mb-0">

                                {{ $totalTeams }}

                            </h3>

                        </div>

                        <div
                            class="rounded-circle bg-warning bg-opacity-10 d-flex align-items-center justify-content-center"
                            style="width:42px;height:42px;">

                            <i class="bi bi-dribbble text-warning"></i>

                        </div>

                    </div>

                    <hr class="my-2">

                    <div class="d-flex justify-content-between small">

                        <span class="text-muted">

                            Registered

                        </span>

                        <strong>

                            {{ $totalTeams }}

                        </strong>

                    </div>

                </div>

            </div>

        </div>

        {{-- Revenue --}}
        <div class="col-6">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body p-3">

                    <div class="d-flex justify-content-between align-items-start">

                        <div>

                            <small class="text-muted d-block">

                                Revenue

                            </small>

                            <h5 class="fw-bold text-success mb-0">

                                Rp {{ number_format($revenueToday,0,',','.') }}

                            </h5>

                        </div>

                        <div
                            class="rounded-circle bg-success bg-opacity-10 d-flex align-items-center justify-content-center"
                            style="width:42px;height:42px;">

                            <i class="bi bi-cash-stack text-success"></i>

                        </div>

                    </div>

                    <hr class="my-2">

                    <div class="d-flex justify-content-between small">

                        <span class="text-muted">

                            Month

                        </span>

                        <strong class="text-primary">

                            Rp {{ number_format($revenueMonth,0,',','.') }}

                        </strong>

                    </div>

                </div>

            </div>

        </div>

    </div>

    {{-- ======================================================
        TODAY'S SCHEDULE
    ======================================================= --}}

    <div class="card border-0 shadow-sm mb-3">

        <div class="card-header bg-white border-0">

            <div class="d-flex justify-content-between align-items-center">

                <h6 class="fw-bold mb-0">

                    Today's Schedule

                </h6>

                <a
                    href="{{ route('admin.courts.bookings') }}"
                    class="small text-decoration-none">

                    View All

                </a>

            </div>

        </div>

        <div class="list-group list-group-flush">

            @forelse($todaySchedules->take(3) as $schedule)

                @php

                    $badge = match($schedule->mode){

                        'practice' => 'primary',

                        'holiday' => 'danger',

                        'override' => 'warning',

                        default => 'secondary'

                    };

                @endphp

                <div class="list-group-item py-2">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <div class="fw-semibold">

                                {{ substr($schedule->start_time,0,5) }}

                                -

                                {{ substr($schedule->end_time,0,5) }}

                            </div>

                            <small class="text-muted">

                                {{ $schedule->description }}

                            </small>

                        </div>

                        <span class="badge bg-{{ $badge }}">

                            {{ ucfirst($schedule->mode) }}

                        </span>

                    </div>

                </div>

            @empty

                <div class="text-center text-muted py-3">

                    Tidak ada jadwal hari ini.

                </div>

            @endforelse

        </div>

    </div>
{{-- ======================================================
    LATEST BOOKINGS
====================================================== --}}

<div class="card border-0 shadow-sm mb-3">

    <div class="card-header bg-white border-0">

        <div class="d-flex justify-content-between align-items-center">

            <h6 class="fw-bold mb-0">

                Latest Bookings

            </h6>

            <a
                href="{{ route('admin.courts.bookings') }}"
                class="small text-decoration-none">

                View All

            </a>

        </div>

    </div>

    <div class="list-group list-group-flush">

        @forelse($latestBookings->take(3) as $booking)

            @php

                $badge = match($booking->status){

                    'approved' => 'success',

                    'pending' => 'warning',

                    'rejected' => 'danger',

                    'cancelled' => 'danger',

                    default => 'secondary'

                };

            @endphp

            <div class="list-group-item py-2">

                <div class="d-flex justify-content-between align-items-start">

                    <div class="flex-grow-1">

                        <div class="fw-semibold">

                            {{ $booking->customer_name }}

                        </div>

                        <small class="text-muted">

                            {{ substr($booking->start_time,0,5) }}

                            -

                            {{ substr($booking->end_time,0,5) }}

                        </small>

                    </div>

                    <span class="badge bg-{{ $badge }}">

                        {{ ucfirst($booking->status) }}

                    </span>

                </div>

            </div>

        @empty

            <div class="text-center py-3 text-muted">

                Belum ada booking.

            </div>

        @endforelse

    </div>

</div>

{{-- ======================================================
    QUICK ACTION
====================================================== --}}

<div class="card border-0 shadow-sm">

    <div class="card-header bg-white border-0">

        <h6 class="fw-bold mb-0">

            Quick Action

        </h6>

    </div>

    <div class="card-body">

        <div class="row g-2">

            <div class="col-6">

                <a
                    href="{{ route('admin.courts.bookings') }}"
                    class="btn btn-light border w-100 py-3">

                    <i class="bi bi-calendar-plus d-block fs-4 mb-1 text-primary"></i>

                    Booking

                </a>

            </div>

            <div class="col-6">

                <a
                    href="{{ route('admin.players.index') }}"
                    class="btn btn-light border w-100 py-3">

                    <i class="bi bi-person-badge d-block fs-4 mb-1 text-success"></i>

                    Player

                </a>

            </div>

            <div class="col-6">

                <a
                    href="{{ route('admin.teams.index') }}"
                    class="btn btn-light border w-100 py-3">

                    <i class="bi bi-dribbble d-block fs-4 mb-1 text-warning"></i>

                    Team

                </a>

            </div>

            <div class="col-6">

                <a
                    href="{{ route('admin.courts.settings') }}"
                    class="btn btn-light border w-100 py-3">

                    <i class="bi bi-calendar-week d-block fs-4 mb-1 text-danger"></i>

                    Schedule

                </a>

            </div>

        </div>

    </div>

</div>
