<div class="card border-0 shadow-sm h-100">

    <div class="card-header bg-white border-0">

        <h5 class="fw-bold mb-0">

            Today's Schedule

        </h5>

    </div>

    <div class="card-body p-0">

        <div class="list-group list-group-flush">

            @forelse($todaySchedules as $schedule)

                @php

                    $color = match($schedule->mode){

                        'practice' => 'primary',

                        'holiday' => 'danger',

                        'override' => 'warning',

                        default => 'secondary'

                    };

                @endphp

                <div class="list-group-item">

                    <div class="d-flex justify-content-between">

                        <strong>

                            {{ substr($schedule->start_time,0,5) }}

                            -

                            {{ substr($schedule->end_time,0,5) }}

                        </strong>

                        <span class="badge bg-{{ $color }}">

                            {{ ucfirst($schedule->mode) }}

                        </span>

                    </div>

                    @if($schedule->description)

                        <small class="text-muted">

                            {{ $schedule->description }}

                        </small>

                    @endif

                </div>

            @empty

                <div class="p-4 text-center text-muted">

                    Tidak ada jadwal hari ini.

                </div>

            @endforelse

        </div>

    </div>

</div>
