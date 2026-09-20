<div class="card border-0 shadow-sm">

    <div class="card-header bg-white border-0">

        <h5 class="fw-bold mb-0">

            Recent Activity

        </h5>

    </div>

    <div class="card-body p-0">

        <div class="list-group list-group-flush">

            @forelse($latestBookings->take(5) as $booking)

                @php
                    $badge = match($booking->status){

                        'approved' => 'success',

                        'pending' => 'warning',

                        'rejected' => 'danger',

                        default => 'secondary'

                    };
                @endphp

                <div class="list-group-item border-0 py-3">

                    <div class="d-flex justify-content-between align-items-start">

                        <div>

                            <div class="fw-semibold">

                                {{ $booking->customer_name }}

                            </div>

                            <small class="text-muted">

                                {{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}

                                •

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

                <div class="text-center text-muted py-4">

                    Belum ada aktivitas.

                </div>

            @endforelse

        </div>

    </div>

</div>
