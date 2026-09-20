<div class="card border-0 shadow-sm mb-4">

    <div class="card-header bg-white border-0">
        <h5 class="fw-bold mb-0">
            Quick Action
        </h5>
    </div>

    <div class="card-body">

        <div class="row g-2">

            <div class="col-6">
                <a href="{{ route('admin.courts.bookings') }}"
                   class="btn btn-light border w-100 py-3">

                    <i class="bi bi-calendar-plus d-block fs-3 text-primary mb-2"></i>

                    Booking
                </a>
            </div>

            <div class="col-6">
                <a href="{{ route('admin.players.index') }}"
                   class="btn btn-light border w-100 py-3">

                    <i class="bi bi-person-badge d-block fs-3 text-success mb-2"></i>

                    Player
                </a>
            </div>

            <div class="col-6">
                <a href="{{ route('admin.teams.index') }}"
                   class="btn btn-light border w-100 py-3">

                    <i class="bi bi-dribbble d-block fs-3 text-warning mb-2"></i>

                    Team
                </a>
            </div>

            <div class="col-6">
                <a href="{{ route('admin.courts.settings') }}"
                   class="btn btn-light border w-100 py-3">

                    <i class="bi bi-calendar-week d-block fs-3 text-danger mb-2"></i>

                    Schedule
                </a>
            </div>

        </div>

    </div>

</div>
