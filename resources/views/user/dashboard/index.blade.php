@extends('user.layouts.user')

@section('title','Dashboard')

@section('content')

<div class="container-fluid px-0">

    {{-- PAGE HEADER --}}

    <div class="mb-4">

        <h4
            class="fw-bold mb-1">

            Halo,
            {{ auth()->user()->name }}

            👋

        </h4>

        <p
            class="text-muted small mb-0">

            Selamat datang di
            ASEBA Basketball Reservation.

        </p>

    </div>

    {{-- SUMMARY --}}

    <div class="row g-3 mb-4">

        <div class="col-6">

            <div class="card-dashboard h-100 p-3">

                <div
                    class="d-flex justify-content-between align-items-start">

                    <div>

                        <small
                            class="text-muted d-block">

                            Total Booking

                        </small>

                        <h3
                            class="fw-bold mt-2 mb-0">

                            {{ $totalBooking }}

                        </h3>

                    </div>

                    <div
                        class="rounded-circle d-flex align-items-center justify-content-center"
                        style="
                            width:46px;
                            height:46px;
                            background:#FFF7ED;
                            color:#EA580C;
                            font-size:20px;
                        ">

                        <i class="bi bi-calendar2-check"></i>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-6">

            <div class="card-dashboard h-100 p-3">

                <div
                    class="d-flex justify-content-between align-items-start">

                    <div>

                        <small
                            class="text-muted d-block">

                            Pending

                        </small>

                        <h3
                            class="fw-bold text-warning mt-2 mb-0">

                            {{ $pendingBooking }}

                        </h3>

                    </div>

                    <div
                        class="rounded-circle d-flex align-items-center justify-content-center"
                        style="
                            width:46px;
                            height:46px;
                            background:#FEF3C7;
                            color:#D97706;
                            font-size:20px;
                        ">

                        <i class="bi bi-hourglass-split"></i>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-6">

            <div class="card-dashboard h-100 p-3">

                <div
                    class="d-flex justify-content-between align-items-start">

                    <div>

                        <small
                            class="text-muted d-block">

                            Approved

                        </small>

                        <h3
                            class="fw-bold text-success mt-2 mb-0">

                            {{ $approvedBooking }}

                        </h3>

                    </div>

                    <div
                        class="rounded-circle d-flex align-items-center justify-content-center"
                        style="
                            width:46px;
                            height:46px;
                            background:#DCFCE7;
                            color:#16A34A;
                            font-size:20px;
                        ">

                        <i class="bi bi-check-circle"></i>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-6">

            <div class="card-dashboard h-100 p-3">

                <div
                    class="d-flex justify-content-between align-items-start">

                    <div>

                        <small
                            class="text-muted d-block">

                            Belum Bayar

                        </small>

                        <h3
                            class="fw-bold text-danger mt-2 mb-0">

                            {{ $unpaidBooking }}

                        </h3>

                    </div>

                    <div
                        class="rounded-circle d-flex align-items-center justify-content-center"
                        style="
                            width:46px;
                            height:46px;
                            background:#FEE2E2;
                            color:#DC2626;
                            font-size:20px;
                        ">

                        <i class="bi bi-wallet2"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>
        {{-- NEXT BOOKING --}}

    <div class="card-dashboard p-3 mb-4">

        <div
            class="d-flex justify-content-between align-items-center mb-3">

            <div>

                <h6
                    class="fw-bold mb-1">

                    Booking Berikutnya

                </h6>

                <small
                    class="text-muted">

                    Jadwal bermain terdekat.

                </small>

            </div>

            <i
                class="bi bi-calendar-event text-primary fs-4">

            </i>

        </div>

        @if($nextBooking)

            <div
                class="row g-3">

                <div class="col-4">

                    <small
                        class="text-muted d-block">

                        Tanggal

                    </small>

                    <div
                        class="fw-semibold">

                        {{ \Carbon\Carbon::parse($nextBooking->booking_date)->format('d M Y') }}

                    </div>

                </div>

                <div class="col-4">

                    <small
                        class="text-muted d-block">

                        Jam

                    </small>

                    <div
                        class="fw-semibold">

                        {{ substr($nextBooking->start_time,0,5) }}

                        -

                        {{ substr($nextBooking->end_time,0,5) }}

                    </div>

                </div>

                <div class="col-4">

                    <small
                        class="text-muted d-block">

                        Status

                    </small>

                    <span
                        class="badge bg-{{
                            $nextBooking->status == 'approved'
                                ? 'success'
                                : ($nextBooking->status == 'pending'
                                    ? 'warning text-dark'
                                    : 'secondary')
                        }}">

                        {{ ucfirst($nextBooking->status) }}

                    </span>

                </div>

            </div>

        @else

            <div
                class="text-center py-4">

                <i
                    class="bi bi-calendar-x fs-1 text-secondary">

                </i>

                <p
                    class="text-muted mb-0 mt-2">

                    Belum ada booking.

                </p>

            </div>

        @endif

    </div>

    {{-- QUICK ACTION --}}

    <div class="row g-3 mb-4">

        <div class="col-6">

            <a
                href="{{ route('user.booking.index') }}"
                class="card-dashboard text-dark text-center d-block p-3">

                <i
                    class="bi bi-plus-circle fs-2 text-primary">

                </i>

                <div
                    class="fw-semibold mt-2">

                    Booking Baru

                </div>

            </a>

        </div>

        <div class="col-6">

            <a
                href="{{ route('user.booking.history') }}"
                class="card-dashboard text-dark text-center d-block p-3">

                <i
                    class="bi bi-clock-history fs-2 text-success">

                </i>

                <div
                    class="fw-semibold mt-2">

                    Riwayat

                </div>

            </a>

        </div>

    </div>
        {{-- LATEST BOOKING --}}

    <div class="card-dashboard p-3">

        <div
            class="d-flex justify-content-between align-items-center mb-3">

            <div>

                <h6
                    class="fw-bold mb-1">

                    Riwayat Booking Terakhir

                </h6>

                <small
                    class="text-muted">

                    Maksimal 5 booking terakhir.

                </small>

            </div>

            <a
                href="{{ route('user.booking.history') }}"
                class="small fw-semibold text-decoration-none">

                Lihat Semua

            </a>

        </div>

        @forelse($latestBookings as $booking)

            <div
                class="border rounded-4 p-3 mb-3">

                <div
                    class="d-flex justify-content-between align-items-start">

                    <div>

                        <div
                            class="fw-semibold">

                            {{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}

                        </div>

                        <small
                            class="text-muted">

                            {{ substr($booking->start_time,0,5) }}

                            -

                            {{ substr($booking->end_time,0,5) }}

                        </small>

                    </div>

                    <span
                        class="badge bg-{{
                            $booking->status == 'approved'
                                ? 'success'
                                : ($booking->status == 'pending'
                                    ? 'warning text-dark'
                                    : ($booking->status == 'cancelled'
                                        ? 'secondary'
                                        : 'danger'))
                        }}">

                        {{ ucfirst($booking->status) }}

                    </span>

                </div>

                <hr class="my-3">

                <div
                    class="d-flex justify-content-between align-items-center">

                    <small
                        class="text-muted">

                        Payment

                    </small>

                    <span
                        class="badge bg-{{
                            $booking->payment_status == 'paid'
                                ? 'success'
                                : 'secondary'
                        }}">

                        {{ ucfirst($booking->payment_status) }}

                    </span>

                </div>

            </div>

        @empty

            <div
                class="text-center py-5">

                <i
                    class="bi bi-calendar-x fs-1 text-secondary">

                </i>

                <h6
                    class="mt-3">

                    Belum Ada Booking

                </h6>

                <p
                    class="text-muted small mb-3">

                    Silakan lakukan booking lapangan pertama Anda.

                </p>

                <a
                    href="{{ route('user.booking.index') }}"
                    class="btn btn-primary">

                    Booking Sekarang

                </a>

            </div>

        @endforelse

    </div>

</div>

@endsection
