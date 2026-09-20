<div class="col-md-6 col-xl-3">

    <div class="card border-0 shadow-sm h-100">

        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center mb-3">

                <div>
                    <h6 class="text-muted mb-1">Teams</h6>
                    <h4 class="fw-bold mb-0">{{ number_format($totalTeams) }}</h4>
                    <small class="text-muted">Registered Team</small>
                </div>

                <div class="rounded-circle bg-warning bg-opacity-10 p-3">
                    <i class="bi bi-dribbble fs-3 text-warning"></i>
                </div>

            </div>

            <hr>

            <div class="d-flex justify-content-between mb-2">

                <span class="text-muted">
                    Active Team
                </span>

                <strong class="text-success">
                    {{ $activeTeams }}
                </strong>

            </div>

            <div class="d-flex justify-content-between">

                <span class="text-muted">
                    Average Player / Team
                </span>

                <strong class="text-primary">
                    {{ $totalTeams > 0 ? number_format($totalPlayers / $totalTeams, 1) : 0 }}
                </strong>

            </div>

        </div>

    </div>

</div>
