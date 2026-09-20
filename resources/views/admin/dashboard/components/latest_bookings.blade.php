<div class="card border-0 shadow-sm h-100">

    <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">

        <div>

            <h5 class="mb-0 fw-bold">
                Latest Bookings
            </h5>

            <small class="text-muted">
                5 booking terbaru
            </small>

        </div>

        <a href="{{ route('admin.courts.bookings') }}" class="btn btn-sm btn-outline-primary">

            Lihat Semua

        </a>

    </div>

    {{-- ============================
Desktop
============================ --}}

<div class="table-responsive d-none d-lg-block">

    <table class="table table-hover align-middle mb-0">

        <thead>

            <tr>

                <th>Customer</th>

                <th>Date</th>

                <th>Time</th>

                <th>Status</th>

                <th class="text-end">Total</th>

            </tr>

        </thead>

        <tbody>

            @forelse($latestBookings as $booking)

                @php
                    $badge = match($booking->status){

                        'approved' => 'success',

                        'pending' => 'warning',

                        'cancelled' => 'danger',

                        'rejected' => 'danger',

                        default => 'secondary'

                    };
                @endphp

                <tr>

                    <td>

                        <strong>{{ $booking->customer_name }}</strong>

                        @if($booking->club_name)

                            <br>

                            <small class="text-muted">

                                {{ $booking->club_name }}

                            </small>

                        @endif

                    </td>

                    <td>

                        {{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}

                    </td>

                    <td>

                        {{ substr($booking->start_time,0,5) }}

                        -

                        {{ substr($booking->end_time,0,5) }}

                    </td>

                    <td>

                        <span class="badge bg-{{ $badge }}">

                            {{ ucfirst($booking->status) }}

                        </span>

                    </td>

                    <td class="text-end fw-semibold">

                        Rp {{ number_format($booking->total_price,0,',','.') }}

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="5" class="text-center py-4 text-muted">

                        Belum ada booking.

                    </td>

                </tr>

            @endforelse

        </tbody>

    </table>

</div>

{{-- ============================
Mobile
============================ --}}

    <div class="d-block d-lg-none">

        @forelse($latestBookings as $booking)

            @php

                $badge = match($booking->status){

                    'approved' => 'success',

                    'pending' => 'warning',

                    'cancelled' => 'danger',

                    'rejected' => 'danger',

                    default => 'secondary'

                };

            @endphp

            <div class="border-bottom p-3">

                <div class="d-flex justify-content-between align-items-start">

                    <div>

                        <div class="fw-bold">

                            {{ $booking->customer_name }}

                        </div>

                        @if($booking->club_name)

                            <small class="text-muted">

                                {{ $booking->club_name }}

                            </small>

                        @endif

                    </div>

                    <span class="badge bg-{{ $badge }}">

                        {{ ucfirst($booking->status) }}

                    </span>

                </div>

                <div class="mt-2 small text-muted">

                    <div>

                        <i class="bi bi-calendar3"></i>

                        {{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}

                    </div>

                    <div>

                        <i class="bi bi-clock"></i>

                        {{ substr($booking->start_time,0,5) }}

                        -

                        {{ substr($booking->end_time,0,5) }}

                    </div>

                    <div class="fw-semibold text-dark mt-1">

                        Rp {{ number_format($booking->total_price,0,',','.') }}

                    </div>

                </div>

            </div>

        @empty

            <div class="text-center text-muted py-4">

                Belum ada booking.

            </div>

        @endforelse

    </div>

</div>
