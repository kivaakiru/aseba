<div class="col-md-6 col-xl-3">

    <div class="card border-0 shadow-sm h-100">

        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center mb-3">

                <div>

                    <h6 class="text-muted mb-1">
                        Revenue
                    </h6>

                    <h4 class="fw-bold text-success mb-0">
                        Rp {{ number_format($revenueToday, 0, ',', '.') }}
                    </h4>

                    <small class="text-muted">
                        Hari Ini
                    </small>

                </div>

                <div class="rounded-circle bg-success bg-opacity-10 p-3">

                    <i class="bi bi-cash-stack fs-3 text-success"></i>

                </div>

            </div>

            <hr>

            <div class="d-flex justify-content-between mb-2">

                <span class="text-muted">
                    Minggu Ini
                </span>

                <strong>

                    Rp {{ number_format($revenueWeek, 0, ',', '.') }}

                </strong>

            </div>

            <div class="d-flex justify-content-between mb-2">

                <span class="text-muted">
                    Bulan Ini
                </span>

                <strong class="text-primary">

                    Rp {{ number_format($revenueMonth, 0, ',', '.') }}

                </strong>

            </div>

            <div class="d-flex justify-content-between">

                <span class="text-muted">
                    Tahun Ini
                </span>

                <strong class="text-success">

                    Rp {{ number_format($revenueYear, 0, ',', '.') }}

                </strong>

            </div>

        </div>

    </div>

</div>
