<div class="col-md-6 col-xl-3">

    <div class="card border-0 shadow-sm h-100">

        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center mb-3">

                <div>

                    <h6 class="text-muted mb-1">
                        Booking
                    </h6>

                    <h3 class="fw-bold mb-0">
                        {{ number_format($bookingTodayCount) }}
                    </h3>

                    <small class="text-muted">
                        Booking Hari Ini
                    </small>

                </div>

                <div class="rounded-circle bg-primary bg-opacity-10 d-flex justify-content-center align-items-center"
                     style="width:58px;height:58px;">

                    <i class="bi bi-calendar-check fs-3 text-primary"></i>

                </div>

            </div>

            <hr>

            <div class="d-flex justify-content-between mb-2">

                <span class="text-muted">

                    Pending

                </span>

                <span class="badge bg-warning">

                    {{ $bookingPending }}

                </span>

            </div>

            <div class="d-flex justify-content-between mb-2">

                <span class="text-muted">

                    Approved

                </span>

                <span class="badge bg-success">

                    {{ $bookingApproved }}

                </span>

            </div>

            <div class="d-flex justify-content-between">

                <span class="text-muted">

                    Bulan Ini

                </span>

                <strong class="text-primary">

                    {{ $bookingThisMonth }}

                </strong>

            </div>

        </div>

    </div>

</div>
