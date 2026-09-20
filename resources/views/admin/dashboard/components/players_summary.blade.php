<div class="col-md-6 col-xl-3">

    <div class="card border-0 shadow-sm h-100">

        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center mb-3">

                <div>
                    <h6 class="text-muted mb-1">Players</h6>
                    <h4 class="fw-bold mb-0">{{ number_format($totalPlayers) }}</h4>
                    <small class="text-muted">Total Player</small>
                </div>

                <div class="rounded-circle bg-success bg-opacity-10 p-3">
                    <i class="bi bi-people-fill fs-3 text-success"></i>
                </div>

            </div>

            <hr>

            <div class="d-flex justify-content-between mb-2">

                <span class="text-muted">
                    Active Player
                </span>

                <strong class="text-success">
                    {{ $activePlayers }}
                </strong>

            </div>

            <div class="d-flex justify-content-between">

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
