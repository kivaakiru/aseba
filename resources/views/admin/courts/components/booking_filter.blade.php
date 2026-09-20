<div class="card booking-filter-card shadow-sm">

    <div class="card-body">

        <div class="row g-3 align-items-end">

            {{-- Search --}}
            <div class="col-lg-4">

                <label class="form-label fw-semibold">

                    Search Booking

                </label>

                <div class="input-group">

                    <span class="input-group-text bg-white">

                        <i class="bi bi-search"></i>

                    </span>

                    <input
                        type="text"
                        class="form-control"
                        placeholder="Nama penyewa, club atau nomor HP..."
                        id="bookingSearch">

                </div>

            </div>

            {{-- Status --}}
            <div class="col-lg-2 col-md-4">

                <label class="form-label fw-semibold">

                    Status

                </label>

                <select
                    class="form-select"
                    id="bookingStatus">

                    <option value="">

                        Semua Status

                    </option>

                    <option value="approved">

                        Approved

                    </option>

                    <option value="pending">

                        Pending

                    </option>

                    <option value="training">

                        Training

                    </option>

                    <option value="holiday">

                        Holiday

                    </option>

                    <option value="cancelled">

                        Cancelled

                    </option>

                </select>

            </div>

            {{-- Source --}}
            <div class="col-lg-2 col-md-4">

                <label class="form-label fw-semibold">

                    Source

                </label>

                <select
                    class="form-select"
                    id="bookingSource">

                    <option value="">

                        Semua

                    </option>

                    <option value="user">

                        User

                    </option>

                    <option value="admin">

                        Admin

                    </option>

                </select>

            </div>

            {{-- Date --}}
            <div class="col-lg-2 col-md-4">

                <label class="form-label fw-semibold">

                    Date

                </label>

                <input
                    type="date"
                    class="form-control"
                    id="bookingDate">

            </div>

            {{-- Action --}}
            <div class="col-lg-2">

                <div class="d-grid">

                    <button
                        class="btn btn-warning text-white fw-semibold"
                        id="btnFilter">

                        <i class="bi bi-funnel-fill me-2"></i>

                        Filter

                    </button>

                </div>

            </div>

        </div>

        <hr class="my-4">

        <div class="d-flex flex-wrap gap-2">

            <button
                class="btn btn-outline-secondary btn-sm rounded-pill">

                Today

            </button>

            <button
                class="btn btn-outline-secondary btn-sm rounded-pill">

                This Week

            </button>

            <button
                class="btn btn-outline-secondary btn-sm rounded-pill">

                Approved

            </button>

            <button
                class="btn btn-outline-secondary btn-sm rounded-pill">

                Pending

            </button>

            <button
                class="btn btn-outline-secondary btn-sm rounded-pill">

                Training

            </button>

            <button
                class="btn btn-outline-secondary btn-sm rounded-pill">

                Clear Filter

            </button>

        </div>

    </div>

</div>
