<div class="card booking-toolbar shadow-sm border-0 rounded-4">

    <div class="card-body">

        <div class="row align-items-center gy-3">

            {{-- Navigation --}}
            <div class="col-lg-4">

                <div class="d-flex align-items-center justify-content-center justify-content-lg-start gap-2">

                    <button
                        id="previousWeek"
                        class="btn btn-outline-secondary rounded-circle d-flex align-items-center justify-content-center"
                        style="width:42px;height:42px;">

                        <i class="bi bi-chevron-left"></i>

                    </button>

                    <div class="text-center px-2">

                        <div
                            id="weekLabel"
                            class="fw-bold fs-5">

                            Monday, 22 June 2026

                        </div>

                    </div>

                    <button
                        id="nextWeek"
                        class="btn btn-outline-secondary rounded-circle d-flex align-items-center justify-content-center"
                        style="width:42px;height:42px;">

                        <i class="bi bi-chevron-right"></i>

                    </button>

                </div>

            </div>

            {{-- Calendar --}}
            <div class="col-lg-4 text-center">



            </div>

            {{-- Live Clock --}}
            <div class="col-lg-4">

                <div class="text-center text-lg-end">

                    <div class="small text-secondary">

                        LIVE CLOCK

                    </div>

                    <div
                        id="liveClock"
                        class="fw-bold text-warning"
                        style="font-size:2rem;letter-spacing:1px;">

                        --:--:--

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>
