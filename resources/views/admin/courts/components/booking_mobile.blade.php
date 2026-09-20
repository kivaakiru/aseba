<div class="mobile-board">

    {{-- Navigation --}}
    <div class="card border-0 shadow-sm rounded-4 mb-3">

        <div class="card-body py-3">

            <div class="d-flex align-items-center justify-content-between">

                <button
                    class="btn btn-light rounded-circle shadow-sm"
                    id="mobilePrevDay">

                    <i class="bi bi-chevron-left"></i>

                </button>

                <div class="text-center">

                    <div
                        class="fw-bold"
                        id="mobileDayName">

                        Monday

                    </div>

                    <small
                        class="text-secondary"
                        id="mobileDate">

                        22 June 2026

                    </small>

                </div>

                <button
                    class="btn btn-light rounded-circle shadow-sm"
                    id="mobileNextDay">

                    <i class="bi bi-chevron-right"></i>

                </button>

            </div>

        </div>

    </div>

    {{-- Timeline --}}

    <div class="card border-0 shadow-sm rounded-4">

        <div class="card-body">

            <h6 class="fw-bold mb-3">

                Jadwal Hari Ini

            </h6>

            <div
                id="mobileTimeline"
                class="mobile-timeline">

                @for($hour=8;$hour<=22;$hour++)

                    <div
                        class="mobile-time-row"
                        data-hour="{{ $hour }}">

                        <div class="mobile-hour">

                            {{ sprintf('%02d:00',$hour) }}

                            -

                            {{ sprintf('%02d:00',$hour+1) }}

                        </div>

                        <div
                            class="mobile-slot-card available"
                            data-status="available">

                            <div>

                                Available

                            </div>

                            <button
                                class="btn btn-success btn-sm rounded-pill mobile-book-button">

                                <i class="bi bi-plus-circle me-1"></i>

                                Book

                            </button>

                        </div>

                    </div>

                @endfor

            </div>

        </div>

    </div>

        <div
            id="mobilePagination"
            class="d-flex justify-content-center align-items-center gap-2 mt-4 mb-3">

        </div>

    <div class="d-grid mt-3">

        <button
            id="manualBookingButton"
            class="btn btn-primary rounded-pill py-3">

            <i class="bi bi-calendar-plus me-2"></i>

            Book Manual (Booking oleh Admin)

        </button>

    </div>

</div>
