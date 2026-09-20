<div
    class="modal fade"
    id="historyModal{{ $booking->id }}"
    tabindex="-1"
    aria-hidden="true">

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content border-0 shadow rounded-4">

            <div class="modal-header">

                <div>

                    <h5 class="fw-bold mb-1">

                        Booking Detail

                    </h5>

                    <small class="text-secondary">

                        Booking #{{ $booking->id }}

                    </small>

                </div>

                <button
                    class="btn-close"
                    data-bs-dismiss="modal">
                </button>

            </div>

            <div class="modal-body">

                <div class="row g-4">

                    <div class="col-md-6">

                        <label class="text-secondary small">

                            Customer

                        </label>

                        <div class="fw-semibold">

                            {{ $booking->customer_name }}

                        </div>

                    </div>

                    <div class="col-md-6">

                        <label class="text-secondary small">

                            Club

                        </label>

                        <div class="fw-semibold">

                            {{ $booking->club_name ?: '-' }}

                        </div>

                    </div>

                    <div class="col-md-6">

                        <label class="text-secondary small">

                            Phone

                        </label>

                        <div class="fw-semibold">

                            {{ $booking->phone }}

                        </div>

                    </div>

                    <div class="col-md-6">

                        <label class="text-secondary small">

                            Booking Source

                        </label>

                        <div class="fw-semibold">

                            {{ ucfirst($booking->booking_source) }}

                        </div>

                    </div>

                    <div class="col-md-6">

                        <label class="text-secondary small">

                            Booking Date

                        </label>

                        <div class="fw-semibold">

                            {{ \Carbon\Carbon::parse($booking->booking_date)->translatedFormat('l, d F Y') }}

                        </div>

                    </div>

                    <div class="col-md-6">

                        <label class="text-secondary small">

                            Booking Time

                        </label>

                        <div class="fw-semibold">

                            {{ substr($booking->start_time,0,5) }}

                            -

                            {{ substr($booking->end_time,0,5) }}

                        </div>

                    </div>

                    <div class="col-md-6">

                        <label class="text-secondary small">

                            Payment Method

                        </label>

                        <div>

                            <span class="badge bg-primary">

                                {{ strtoupper($booking->payment_method) }}

                            </span>

                        </div>

                    </div>

                    <div class="col-md-6">

                        <label class="text-secondary small">

                            Payment Status

                        </label>

                        <div>

                            @if($booking->payment_status=='paid')

                                <span class="badge bg-success">

                                    Paid

                                </span>

                            @else

                                <span class="badge bg-warning text-dark">

                                    {{ ucfirst($booking->payment_status) }}

                                </span>

                            @endif

                        </div>

                    </div>

                    <div class="col-md-6">

                        <label class="text-secondary small">

                            Booking Status

                        </label>

                        <div>

                            @if($booking->status=='approved')

                                <span class="badge bg-success">

                                    Approved

                                </span>

                            @else

                                <span class="badge bg-danger">

                                    Rejected

                                </span>

                            @endif

                        </div>

                    </div>

                    <div class="col-md-6">

                        <label class="text-secondary small">

                            Total Payment

                        </label>

                        <div class="fw-bold text-success">

                            Rp {{ number_format($booking->total_price,0,',','.') }}

                        </div>

                    </div>

                    <div class="col-12">

                        <label class="text-secondary small">

                            Purpose

                        </label>

                        <div class="border rounded-3 p-3">

                            {{ $booking->purpose ?: '-' }}

                        </div>

                    </div>

                    <div class="col-12">

                        <label class="text-secondary small">

                            Notes

                        </label>

                        <div class="border rounded-3 p-3">

                            {{ $booking->notes ?: '-' }}

                        </div>

                    </div>

                    @if($booking->reject_reason)

                    <div class="col-12">

                        <label class="text-danger small">

                            Reject Reason

                        </label>

                        <div class="border border-danger rounded-3 p-3 text-danger">

                            {{ $booking->reject_reason }}

                        </div>

                    </div>

                    @endif

                    <div class="col-md-6">

                        <label class="text-secondary small">

                            Processed By

                        </label>

                        <div class="fw-semibold">

                            {{ optional($booking->approver)->name ?? '-' }}

                        </div>

                    </div>

                    <div class="col-md-6">

                        <label class="text-secondary small">

                            Created At

                        </label>

                        <div class="fw-semibold">

                            {{ optional($booking->created_at)->format('d M Y H:i') }}

                        </div>

                    </div>

                </div>

            </div>

            <div class="modal-footer">

                <button
                    class="btn btn-secondary"
                    data-bs-dismiss="modal">

                    Close

                </button>

            </div>

        </div>

    </div>

</div>






