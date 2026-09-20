<div
    class="offcanvas offcanvas-end booking-offcanvas"
    tabindex="-1"
    id="bookingCanvas">

    <div class="offcanvas-header">

        <div>

            <h4 class="mb-0 fw-bold">

                New Booking

            </h4>

            <small class="text-muted">

                Basketball Court Reservation

            </small>

        </div>

        <button
            type="button"
            class="btn-close"
            data-bs-dismiss="offcanvas">
        </button>

    </div>

    <div class="offcanvas-body">

        @if($errors->any())

            <div class="alert alert-danger mb-4">

                <div class="fw-bold mb-1">
                    Booking tidak dapat diproses.
                </div>

                <ul class="mb-0 ps-3">

                    @foreach($errors->all() as $error)

                        <li>
                            {{ $error }}
                        </li>

                    @endforeach

                </ul>

            </div>

        @endif

        <form
            id="bookingForm"
            method="POST"
            action="{{ route('user.booking.store') }}"
            enctype="multipart/form-data">

            @csrf

            <input
                type="hidden"
                name="booking_source"
                value="user">

            <input
                type="hidden"
                name="status"
                value="Pending">

            <input
                type="hidden"
                name="payment_status"
                value="Unpaid">



            <div class="mb-4">

                <label class="form-label">

                    Tanggal Booking

                </label>

                <input
                    type="date"
                    class="form-control"
                    id="bookingDate"
                    name="booking_date"
                    required>

            </div>

            <div class="row">

                <div class="col-6">

                    <div class="mb-3">

                        <label class="form-label">

                            Jam Mulai

                        </label>

                        <select
                            id="startTime"
                            name="start_time"
                            class="form-select"
                            required>

                        </select>

                    </div>

                </div>

                <div class="col-6">

                    <div class="mb-3">

                        <label class="form-label">

                            Jam Selesai

                        </label>

                        <select
                            id="endTime"
                            name="end_time"
                            class="form-select"
                            required>

                        </select>

                    </div>

                </div>

            </div>

            <div class="card border-0 bg-light mb-3">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <span>

                            Durasi

                        </span>

                        <strong
                            id="bookingDuration">

                            1 Jam

                        </strong>

                    </div>

                    <hr>

                    <div class="d-flex justify-content-between">

                        <span>

                            Total

                        </span>

                        <strong
                            id="bookingPrice">

                            Rp 80.000

                        </strong>

                    </div>

                </div>

            </div>
                        <div class="mb-4">

                <label class="form-label">

                    Nama Penyewa

                </label>

                <input
                    type="text"
                    class="form-control"
                    name="customer_name"
                    value="{{ auth()->user()->name }}"
                    readonly>

            </div>

            <div class="mb-4">

                <label class="form-label">

                    Nomor WhatsApp

                </label>

                <input
                    type="text"
                    class="form-control"
                    name="phone"
                    value="{{ auth()->user()->phone }}"
                    readonly>

            </div>

            @if(auth()->user()->user_type=='club')

                <div class="mb-4">

                    <label class="form-label">

                        Nama Club

                    </label>

                    <input
                        type="text"
                        class="form-control"
                        name="club_name"
                        value="{{ auth()->user()->club_name }}"
                        readonly>

                </div>

            @endif

            <div class="mb-4">

                <label class="form-label">

                    Tujuan Booking

                </label>

                <select
                    name="purpose"
                    class="form-select"
                    required>

                    <option value="Latihan">

                        Latihan

                    </option>

                    <option value="Fun Game">

                        Fun Game

                    </option>

                    <option value="Sparring">

                        Sparring

                    </option>

                    <option value="Turnamen">

                        Turnamen

                    </option>

                    <option value="Lainnya">

                        Lainnya

                    </option>

                </select>

            </div>

            <div class="mb-4">

                <label class="form-label">

                    Catatan

                </label>

                <textarea
                    class="form-control"
                    rows="3"
                    name="notes"
                    placeholder="Opsional"></textarea>

            </div>

            <div class="mb-4">

                <label class="form-label">

                    Metode Pembayaran

                </label>

                <div class="d-grid gap-2">

                    <div class="form-check">

                        <input
                            class="form-check-input"
                            type="radio"
                            name="payment_method"
                            id="transfer"
                            value="transfer"
                            checked>

                        <label
                            class="form-check-label"
                            for="transfer">

                            Transfer Bank

                        </label>

                    </div>

                    <div class="form-check">

                        <input
                            class="form-check-input"
                            type="radio"
                            name="payment_method"
                            id="cash"
                            value="cash">

                        <label
                            class="form-check-label"
                            for="cash">

                            Cash

                        </label>

                    </div>

                </div>

            </div>

            <div
                id="transferArea">
                <div class="alert alert-primary mb-3">

                    <strong>Transfer ke:</strong>

                    <hr>

                    <div>
                        <strong>Bank BCA</strong><br>
                        112233445566
                    </div>

                    <div class="mt-2">
                        <strong>a.n. ASEBA Basketball Home Court</strong>
                    </div>

                </div>

                <div class="mb-4">

                    <label class="form-label">

                        Upload Bukti Transfer

                    </label>

                    <input
                        type="file"
                        class="form-control"
                        name="payment_proof"
                        accept=".jpg,.jpeg,.png">

                </div>

            </div>

            <div
                id="cashArea"
                class="alert alert-warning d-none">

                Pembayaran dilakukan langsung kepada Admin
                sebelum jadwal bermain dimulai.

            </div>
                        <div class="form-check mt-4">

                <input
                    class="form-check-input"
                    type="checkbox"
                    id="bookingAgreement"
                    required>

                <label
                    class="form-check-label"
                    for="bookingAgreement">

                    Saya telah membaca dan menyetujui seluruh
                    ketentuan reservasi lapangan ABHC.

                </label>

            </div>

            <div class="alert alert-info mt-4 mb-4">

                <strong>Informasi</strong>

                <ul class="mb-0 mt-2">

                    <li>Maksimal reservasi 4 jam.</li>

                    <li>Booking akan berstatus <strong>Pending</strong>.</li>

                    <li>Admin akan melakukan verifikasi terlebih dahulu.</li>

                    <li>Slot yang sudah dibooking tidak dapat dipilih.</li>

                </ul>

            </div>

            <div class="d-grid">

                <button
                    type="submit"
                    class="btn btn-warning btn-lg fw-bold">

                    <i class="bi bi-calendar-check me-2"></i>

                    BOOK NOW

                </button>

            </div>

        </form>

    </div>

</div>
