@extends('admin.layouts.admin')

@section('title', 'Laporan Reservasi')
@section('page-title', 'Laporan Reservasi')
@section('page-subtitle', 'Laporan seluruh aktivitas reservasi lapangan')

@section('content')

<div class="container-fluid reservation-report-page">

    {{-- ==========================================================
        PRINT HEADER
    =========================================================== --}}
    <div class="print-header">

        <div class="print-brand">
            ASEBA BASKETBALL CLUB
        </div>

        <div class="print-title">
            LAPORAN RESERVASI LAPANGAN
        </div>

        <div class="print-date">
            Dicetak pada {{ now()->format('d M Y H:i') }}
        </div>

    </div>


    {{-- ==========================================================
        PAGE HEADER
    =========================================================== --}}
    <div class="reservation-header">

        <div>

            <div class="report-eyebrow">
                <i class="bi bi-file-earmark-bar-graph"></i>
                RESERVATION REPORT
            </div>

            <h1>Laporan Reservasi</h1>

            <p>
                Pantau, filter, dan cetak seluruh data reservasi lapangan.
            </p>

        </div>


        <div class="header-actions">

            <button type="button"
                    onclick="window.print()"
                    class="btn btn-print">

                <i class="bi bi-printer"></i>

                Cetak Laporan

            </button>

        </div>

    </div>


    {{-- ==========================================================
        SUMMARY
    =========================================================== --}}
    <div class="row g-3 mb-4">

        <div class="col-6 col-xl-3">

            <div class="summary-card">

                <div class="summary-icon">
                    <i class="bi bi-calendar-check"></i>
                </div>

                <div>
                    <span>Total Booking</span>

                    <strong>
                        {{ number_format($totalBooking) }}
                    </strong>
                </div>

            </div>

        </div>


        <div class="col-6 col-xl-3">

            <div class="summary-card">

                <div class="summary-icon success">
                    <i class="bi bi-check-circle"></i>
                </div>

                <div>
                    <span>Approved</span>

                    <strong class="text-success">
                        {{ number_format($approvedBooking) }}
                    </strong>
                </div>

            </div>

        </div>


        <div class="col-6 col-xl-3">

            <div class="summary-card">

                <div class="summary-icon warning">
                    <i class="bi bi-hourglass-split"></i>
                </div>

                <div>
                    <span>Pending</span>

                    <strong class="text-warning">
                        {{ number_format($pendingBooking) }}
                    </strong>
                </div>

            </div>

        </div>


        <div class="col-6 col-xl-3">

            <div class="summary-card">

                <div class="summary-icon revenue">
                    <i class="bi bi-cash-stack"></i>
                </div>

                <div>
                    <span>Paid Revenue</span>

                    <strong class="revenue-value">
                        Rp {{ number_format($paidRevenue, 0, ',', '.') }}
                    </strong>
                </div>

            </div>

        </div>

    </div>


    {{-- ==========================================================
        FILTER
    =========================================================== --}}
    <div class="report-panel filter-panel mb-4">

        <div class="panel-title">

            <div class="panel-title-icon">
                <i class="bi bi-funnel"></i>
            </div>

            <div>
                <h2>Filter Laporan</h2>

                <p>
                    Gunakan filter untuk menampilkan data tertentu.
                </p>
            </div>

        </div>


        <form method="GET"
              action="{{ route('admin.reports.reservation') }}">

            <div class="row g-3">

                {{-- DATE START --}}
                <div class="col-12 col-md-6 col-xl-2">

                    <label for="start_date">
                        Dari Tanggal
                    </label>

                    <input type="date"
                           id="start_date"
                           name="start_date"
                           value="{{ request('start_date') }}"
                           class="form-control">

                </div>


                {{-- DATE END --}}
                <div class="col-12 col-md-6 col-xl-2">

                    <label for="end_date">
                        Sampai Tanggal
                    </label>

                    <input type="date"
                           id="end_date"
                           name="end_date"
                           value="{{ request('end_date') }}"
                           class="form-control">

                </div>


                {{-- STATUS --}}
                <div class="col-12 col-md-6 col-xl-2">

                    <label for="status">
                        Status Booking
                    </label>

                    <select id="status"
                            name="status"
                            class="form-select">

                        <option value="">
                            Semua Status
                        </option>

                        @foreach([
                            'pending' => 'Pending',
                            'approved' => 'Approved',
                            'rejected' => 'Rejected',
                            'cancelled' => 'Cancelled'
                        ] as $value => $label)

                            <option value="{{ $value }}"
                                @selected(request('status') === $value)>

                                {{ $label }}

                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- PAYMENT STATUS --}}
                <div class="col-12 col-md-6 col-xl-2">

                    <label for="payment_status">
                        Payment
                    </label>

                    <select id="payment_status"
                            name="payment_status"
                            class="form-select">

                        <option value="">
                            Semua Payment
                        </option>

                        @foreach([
                            'paid' => 'Paid',
                            'pending' => 'Pending',
                            'failed' => 'Failed',
                            'unpaid' => 'Unpaid'
                        ] as $value => $label)

                            <option value="{{ $value }}"
                                @selected(request('payment_status') === $value)>

                                {{ $label }}

                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- PAYMENT METHOD --}}
                <div class="col-12 col-md-6 col-xl-2">

                    <label for="payment_method">
                        Metode Pembayaran
                    </label>

                    <select id="payment_method"
                            name="payment_method"
                            class="form-select">

                        <option value="">
                            Semua Metode
                        </option>

                        <option value="transfer"
                            @selected(request('payment_method') === 'transfer')>
                            Transfer
                        </option>

                        <option value="cash"
                            @selected(request('payment_method') === 'cash')>
                            Cash
                        </option>

                    </select>

                </div>


                {{-- SOURCE --}}
                <div class="col-12 col-md-6 col-xl-2">

                    <label for="booking_source">
                        Sumber Booking
                    </label>

                    <select id="booking_source"
                            name="booking_source"
                            class="form-select">

                        <option value="">
                            Semua Sumber
                        </option>

                        <option value="user"
                            @selected(request('booking_source') === 'user')>
                            User
                        </option>

                        <option value="admin"
                            @selected(request('booking_source') === 'admin')>
                            Admin
                        </option>

                    </select>

                </div>


                {{-- CUSTOMER --}}
                <div class="col-12 col-md-8">

                    <label for="keyword">
                        Customer / Club
                    </label>

                    <div class="search-input">

                        <i class="bi bi-search"></i>

                        <input type="text"
                               id="keyword"
                               name="keyword"
                               value="{{ request('keyword') }}"
                               class="form-control"
                               placeholder="Cari nama customer atau club...">

                    </div>

                </div>


                {{-- ACTION --}}
                <div class="col-12 col-md-4">

                    <label class="filter-label-hidden">
                        Action
                    </label>

                    <div class="filter-actions">

                        <button type="submit"
                                class="btn btn-filter">

                            <i class="bi bi-funnel-fill"></i>

                            Terapkan Filter

                        </button>

                        <a href="{{ route('admin.reports.reservation') }}"
                           class="btn btn-reset">

                            <i class="bi bi-arrow-counterclockwise"></i>

                            Reset

                        </a>

                    </div>

                </div>

            </div>

        </form>

    </div>


    {{-- ==========================================================
        TABLE
    =========================================================== --}}
    <div class="report-panel">

        <div class="table-header">

            <div>

                <h2>Data Reservasi</h2>

                <p>
                    Menampilkan
                    <strong>{{ $bookings->total() }}</strong>
                    data reservasi.
                </p>

            </div>

            @if(request()->hasAny([
                'start_date',
                'end_date',
                'status',
                'payment_status',
                'payment_method',
                'booking_source',
                'keyword'
            ]))

                <div class="active-filter">

                    <i class="bi bi-funnel-fill"></i>

                    Filter aktif

                </div>

            @endif

        </div>


        <div class="table-responsive">

            <table class="table reservation-table align-middle mb-0">

                <thead>

                    <tr>

                        <th width="55">#</th>

                        <th>Tanggal</th>

                        <th>Customer</th>

                        <th>Club</th>

                        <th>Jam</th>

                        <th>Status</th>

                        <th>Payment</th>

                        <th>Metode</th>

                        <th class="text-end">Total</th>

                    </tr>

                </thead>


                <tbody>

                @forelse($bookings as $booking)

                    <tr>

                        <td class="number-cell">

                            {{ $bookings->firstItem() + $loop->index }}

                        </td>


                        {{-- DATE --}}
                        <td>

                            <div class="date-cell">

                                <strong>
                                    {{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}
                                </strong>

                            </div>

                        </td>


                        {{-- CUSTOMER --}}
                        <td>

                            <div class="customer-cell">

                                <div class="customer-avatar">
                                    <i class="bi bi-person-fill"></i>
                                </div>

                                <div>

                                    <strong>
                                        {{ $booking->customer_name }}
                                    </strong>

                                    @if($booking->phone)

                                        <small>
                                            {{ $booking->phone }}
                                        </small>

                                    @endif

                                </div>

                            </div>

                        </td>


                        {{-- CLUB --}}
                        <td>

                            @if($booking->club_name)

                                <span class="club-name">
                                    {{ $booking->club_name }}
                                </span>

                            @else

                                <span class="muted-value">
                                    Personal
                                </span>

                            @endif

                        </td>


                        {{-- TIME --}}
                        <td>

                            <span class="time-value">

                                <i class="bi bi-clock"></i>

                                {{ substr($booking->start_time, 0, 5) }}

                                <span>-</span>

                                {{ substr($booking->end_time, 0, 5) }}

                            </span>

                        </td>


                        {{-- STATUS --}}
                        <td>

                            @if($booking->status === 'approved')

                                <span class="status-badge approved">
                                    <i class="bi bi-check-circle-fill"></i>
                                    Approved
                                </span>

                            @elseif($booking->status === 'pending')

                                <span class="status-badge pending">
                                    <i class="bi bi-hourglass-split"></i>
                                    Pending
                                </span>

                            @elseif($booking->status === 'rejected')

                                <span class="status-badge rejected">
                                    <i class="bi bi-x-circle-fill"></i>
                                    Rejected
                                </span>

                            @elseif($booking->status === 'cancelled')

                                <span class="status-badge cancelled">
                                    <i class="bi bi-dash-circle-fill"></i>
                                    Cancelled
                                </span>

                            @else

                                <span class="status-badge neutral">
                                    {{ ucfirst($booking->status) }}
                                </span>

                            @endif

                        </td>


                        {{-- PAYMENT --}}
                        <td>

                            @php
                                $paymentStatus = $booking->payment_status;
                            @endphp

                            @if($paymentStatus === 'paid')

                                <span class="payment-badge paid">
                                    <i class="bi bi-check-circle-fill"></i>
                                    Paid
                                </span>

                            @elseif($paymentStatus === 'pending')

                                <span class="payment-badge pending">
                                    <i class="bi bi-clock-fill"></i>
                                    Pending
                                </span>

                            @elseif($paymentStatus === 'failed')

                                <span class="payment-badge failed">
                                    <i class="bi bi-x-circle-fill"></i>
                                    Failed
                                </span>

                            @elseif($paymentStatus === 'unpaid')

                                <span class="payment-badge unpaid">
                                    <i class="bi bi-dash-circle-fill"></i>
                                    Unpaid
                                </span>

                            @else

                                <span class="payment-badge unpaid">
                                    {{ ucfirst($paymentStatus ?? '-') }}
                                </span>

                            @endif

                        </td>


                        {{-- METHOD --}}
                        <td>

                            @if($booking->payment_method)

                                <span class="method-value">

                                    @if($booking->payment_method === 'transfer')

                                        <i class="bi bi-bank"></i>
                                        Transfer

                                    @elseif($booking->payment_method === 'cash')

                                        <i class="bi bi-cash"></i>
                                        Cash

                                    @else

                                        {{ ucfirst($booking->payment_method) }}

                                    @endif

                                </span>

                            @else

                                <span class="muted-value">
                                    -
                                </span>

                            @endif

                        </td>


                        {{-- TOTAL --}}
                        <td class="text-end">

                            <strong class="price-value">

                                Rp {{ number_format($booking->total_price, 0, ',', '.') }}

                            </strong>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="9">

                            <div class="empty-report">

                                <div class="empty-report-icon">

                                    <i class="bi bi-calendar-x"></i>

                                </div>

                                <strong>
                                    Tidak ada data reservasi
                                </strong>

                                <span>
                                    Tidak ditemukan booking berdasarkan filter yang dipilih.
                                </span>

                            </div>

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>


        {{-- ======================================================
            FOOTER
        ======================================================= --}}
        <div class="report-footer">

            <div class="report-result">

                Menampilkan
                <strong>{{ $bookings->firstItem() ?? 0 }}</strong>
                -
                <strong>{{ $bookings->lastItem() ?? 0 }}</strong>
                dari
                <strong>{{ $bookings->total() }}</strong>
                reservasi

            </div>


            <div class="report-pagination">

                {{ $bookings->links('pagination::bootstrap-4') }}

            </div>

        </div>


        {{-- ======================================================
            REPORT TOTAL
        ======================================================= --}}
        <div class="report-summary-footer">

            <div>

                <span>Total Booking</span>

                <strong>
                    {{ number_format($totalBooking) }}
                </strong>

            </div>

            <div>

                <span>Approved</span>

                <strong class="text-success">
                    {{ number_format($approvedBooking) }}
                </strong>

            </div>

            <div>

                <span>Pending</span>

                <strong class="text-warning">
                    {{ number_format($pendingBooking) }}
                </strong>

            </div>

            <div class="summary-revenue">

                <span>Paid Revenue</span>

                <strong>
                    Rp {{ number_format($paidRevenue, 0, ',', '.') }}
                </strong>

            </div>

        </div>

    </div>

</div>


<style>

/* ==========================================================
   BASE
========================================================== */

.reservation-report-page {
    padding-bottom: 35px;
}


/* ==========================================================
   PRINT HEADER
========================================================== */

.print-header {
    display: none;
}


/* ==========================================================
   HEADER
========================================================== */

.reservation-header {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    gap: 20px;
    margin-bottom: 25px;
}

.report-eyebrow {
    display: flex;
    align-items: center;
    gap: 7px;
    margin-bottom: 7px;
    font-size: 13px;
    font-weight: 700;
    letter-spacing: .08em;
    color: #EA580C;
}

.reservation-header h1 {
    margin: 0;
    font-size: 31px;
    font-weight: 800;
    color: #0F172A;
}

.reservation-header p {
    margin: 7px 0 0;
    font-size: 15px;
    color: #64748B;
}

.btn-print {
    min-height: 45px;
    padding: 0 18px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    border: 0;
    border-radius: 9px;
    background: #16A34A;
    color: #fff;
    font-size: 14px;
    font-weight: 700;
}

.btn-print:hover {
    background: #15803D;
    color: #fff;
}


/* ==========================================================
   SUMMARY
========================================================== */

.summary-card {
    min-height: 112px;
    padding: 19px;
    display: flex;
    align-items: center;
    gap: 15px;
    background: #fff;
    border: 1px solid #E2E8F0;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(15, 23, 42, .05);
}

.summary-icon {
    width: 45px;
    height: 45px;
    flex: 0 0 45px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 10px;
    background: rgba(234, 88, 12, .10);
    color: #EA580C;
    font-size: 20px;
}

.summary-icon.success {
    background: rgba(22, 163, 74, .10);
    color: #16A34A;
}

.summary-icon.warning {
    background: rgba(245, 158, 11, .12);
    color: #D97706;
}

.summary-icon.revenue {
    background: rgba(37, 99, 235, .10);
    color: #2563EB;
}

.summary-card span {
    display: block;
    font-size: 13px;
    font-weight: 600;
    color: #64748B;
}

.summary-card strong {
    display: block;
    margin-top: 4px;
    font-size: 24px;
    font-weight: 800;
    color: #0F172A;
}

.summary-card .revenue-value {
    font-size: 18px;
}


/* ==========================================================
   PANEL
========================================================== */

.report-panel {
    background: #fff;
    border: 1px solid #E2E8F0;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(15, 23, 42, .05);
    overflow: hidden;
}


/* ==========================================================
   FILTER
========================================================== */

.filter-panel {
    padding: 20px;
}

.panel-title {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 20px;
}

.panel-title-icon {
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 9px;
    background: rgba(234, 88, 12, .10);
    color: #EA580C;
    font-size: 18px;
}

.panel-title h2 {
    margin: 0;
    font-size: 18px;
    font-weight: 800;
    color: #0F172A;
}

.panel-title p {
    margin: 3px 0 0;
    font-size: 13px;
    color: #64748B;
}

.filter-panel label {
    display: block;
    margin-bottom: 7px;
    font-size: 13px;
    font-weight: 700;
    color: #334155;
}

.filter-panel .form-control,
.filter-panel .form-select {
    min-height: 43px;
    border-color: #CBD5E1;
    border-radius: 8px;
    font-size: 14px;
    color: #0F172A;
}

.filter-panel .form-control:focus,
.filter-panel .form-select:focus {
    border-color: #EA580C;
    box-shadow: 0 0 0 .2rem rgba(234, 88, 12, .10);
}

.search-input {
    position: relative;
}

.search-input i {
    position: absolute;
    top: 50%;
    left: 13px;
    transform: translateY(-50%);
    color: #94A3B8;
    z-index: 2;
}

.search-input .form-control {
    padding-left: 38px;
}

.filter-label-hidden {
    opacity: 0;
    pointer-events: none;
}

.filter-actions {
    display: flex;
    gap: 8px;
}

.btn-filter,
.btn-reset {
    min-height: 43px;
    padding: 0 15px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 700;
}

.btn-filter {
    background: #EA580C;
    border-color: #EA580C;
    color: #fff;
}

.btn-filter:hover {
    background: #C2410C;
    border-color: #C2410C;
    color: #fff;
}

.btn-reset {
    border: 1px solid #CBD5E1;
    color: #475569;
    background: #fff;
}

.btn-reset:hover {
    background: #F8FAFC;
    color: #0F172A;
}


/* ==========================================================
   TABLE HEADER
========================================================== */

.table-header {
    min-height: 76px;
    padding: 18px 20px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 15px;
    border-bottom: 1px solid #E2E8F0;
}

.table-header h2 {
    margin: 0;
    font-size: 18px;
    font-weight: 800;
    color: #0F172A;
}

.table-header p {
    margin: 4px 0 0;
    font-size: 13px;
    color: #64748B;
}

.active-filter {
    padding: 6px 10px;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    border-radius: 20px;
    background: #FFF7ED;
    color: #C2410C;
    font-size: 12px;
    font-weight: 700;
}


/* ==========================================================
   TABLE
========================================================== */

.reservation-table {
    min-width: 1050px;
}

.reservation-table thead th {
    padding: 13px 14px;
    background: #F8FAFC;
    border-bottom: 1px solid #E2E8F0;
    font-size: 11px;
    font-weight: 800;
    color: #64748B;
    text-transform: uppercase;
    letter-spacing: .04em;
    white-space: nowrap;
}

.reservation-table tbody td {
    padding: 14px;
    border-bottom: 1px solid #F1F5F9;
    font-size: 13px;
    color: #334155;
}

.reservation-table tbody tr:last-child td {
    border-bottom: 0;
}

.reservation-table tbody tr:hover {
    background: #FAFAFA;
}

.number-cell {
    color: #94A3B8 !important;
    font-weight: 700;
}

.date-cell strong {
    font-size: 13px;
    color: #334155;
    white-space: nowrap;
}

.customer-cell {
    display: flex;
    align-items: center;
    gap: 9px;
}

.customer-avatar {
    width: 34px;
    height: 34px;
    flex: 0 0 34px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 8px;
    background: #F1F5F9;
    color: #64748B;
}

.customer-cell strong {
    display: block;
    font-size: 13px;
    color: #0F172A;
}

.customer-cell small {
    display: block;
    margin-top: 2px;
    font-size: 11px;
    color: #94A3B8;
}

.club-name {
    font-size: 13px;
    font-weight: 600;
    color: #475569;
}

.muted-value {
    color: #94A3B8;
    font-size: 12px;
}

.time-value {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    white-space: nowrap;
    font-size: 12px;
    font-weight: 700;
    color: #475569;
}

.time-value i {
    color: #EA580C;
}

.time-value span {
    color: #CBD5E1;
}

.status-badge,
.payment-badge {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 5px 9px;
    border-radius: 20px;
    white-space: nowrap;
    font-size: 11px;
    font-weight: 700;
}

.status-badge.approved,
.payment-badge.paid {
    background: #DCFCE7;
    color: #15803D;
}

.status-badge.pending,
.payment-badge.pending {
    background: #FEF3C7;
    color: #B45309;
}

.status-badge.rejected,
.payment-badge.failed {
    background: #FEE2E2;
    color: #B91C1C;
}

.status-badge.cancelled,
.payment-badge.unpaid,
.status-badge.neutral {
    background: #F1F5F9;
    color: #475569;
}

.method-value {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 12px;
    font-weight: 600;
    color: #475569;
}

.method-value i {
    color: #64748B;
}

.price-value {
    font-size: 13px;
    color: #0F172A;
    white-space: nowrap;
}


/* ==========================================================
   EMPTY
========================================================== */

.empty-report {
    min-height: 250px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    gap: 6px;
}

.empty-report-icon {
    width: 55px;
    height: 55px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 5px;
    border-radius: 12px;
    background: #F1F5F9;
    color: #94A3B8;
    font-size: 25px;
}

.empty-report strong {
    font-size: 15px;
    color: #475569;
}

.empty-report span {
    font-size: 13px;
    color: #94A3B8;
}


/* ==========================================================
   FOOTER
========================================================== */

.report-footer {
    min-height: 70px;
    padding: 13px 20px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 15px;
    border-top: 1px solid #E2E8F0;
}

.report-result {
    font-size: 13px;
    color: #64748B;
}

.report-result strong {
    color: #334155;
}

.report-pagination .pagination {
    margin: 0;
}

.report-pagination .page-link {
    font-size: 12px;
}


/* ==========================================================
   SUMMARY FOOTER
========================================================== */

.report-summary-footer {
    padding: 17px 20px;
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
    background: #F8FAFC;
    border-top: 1px solid #E2E8F0;
}

.report-summary-footer span {
    display: block;
    margin-bottom: 4px;
    font-size: 12px;
    color: #64748B;
}

.report-summary-footer strong {
    font-size: 16px;
    font-weight: 800;
    color: #0F172A;
}

.summary-revenue {
    text-align: right;
}

.summary-revenue strong {
    color: #16A34A;
}


/* ==========================================================
   MOBILE
========================================================== */

@media (max-width: 991.98px) {

    .reservation-header {
        align-items: flex-start;
    }

    .reservation-table {
        min-width: 1000px;
    }

}

@media (max-width: 767.98px) {

    .reservation-header {
        flex-direction: column;
        margin-bottom: 20px;
    }

    .header-actions {
        width: 100%;
    }

    .btn-print {
        width: 100%;
    }

    .reservation-header h1 {
        font-size: 27px;
    }

    .reservation-header p {
        font-size: 14px;
        line-height: 1.5;
    }

    .filter-panel {
        padding: 16px;
    }

    .filter-actions {
        width: 100%;
    }

    .btn-filter,
    .btn-reset {
        flex: 1;
    }

    .filter-label-hidden {
        display: none;
    }

    .table-header {
        padding: 16px;
        align-items: flex-start;
        flex-direction: column;
    }

    .report-footer {
        padding: 13px 16px;
        align-items: flex-start;
        flex-direction: column;
    }

    .report-summary-footer {
        grid-template-columns: repeat(2, 1fr);
        gap: 15px;
    }

    .summary-revenue {
        text-align: left;
    }

}

@media (max-width: 575.98px) {

    .reservation-header h1 {
        font-size: 24px;
    }

    .report-eyebrow {
        font-size: 11px;
    }

    .summary-card {
        min-height: 100px;
        padding: 14px;
        gap: 10px;
    }

    .summary-icon {
        width: 38px;
        height: 38px;
        flex-basis: 38px;
        font-size: 17px;
    }

    .summary-card span {
        font-size: 12px;
    }

    .summary-card strong {
        font-size: 20px;
    }

    .summary-card .revenue-value {
        font-size: 15px;
    }

}


/* ==========================================================
   PRINT
========================================================== */

@media print {

    @page {
        size: landscape;
        margin: 12mm;
    }

    body {
        background: #fff !important;
    }

    .print-header {
        display: block;
        text-align: center;
        margin-bottom: 20px;
    }

    .print-brand {
        font-size: 17px;
        font-weight: 800;
    }

    .print-title {
        margin-top: 4px;
        font-size: 15px;
        font-weight: 700;
    }

    .print-date {
        margin-top: 4px;
        font-size: 11px;
    }

    .reservation-header,
    .filter-panel,
    .report-footer,
    .active-filter,
    .pagination {
        display: none !important;
    }

    .summary-card {
        min-height: 75px;
        box-shadow: none !important;
        border: 1px solid #ddd !important;
    }

    .report-panel {
        border: 1px solid #ddd !important;
        box-shadow: none !important;
    }

    .table-header {
        padding: 12px 15px;
    }

    .reservation-table {
        min-width: 100%;
    }

    .reservation-table thead th {
        font-size: 9px;
        padding: 8px;
    }

    .reservation-table tbody td {
        font-size: 10px;
        padding: 8px;
    }

    .customer-avatar {
        display: none;
    }

    .customer-cell strong {
        font-size: 10px;
    }

    .customer-cell small {
        font-size: 8px;
    }

    .status-badge,
    .payment-badge {
        padding: 3px 6px;
        font-size: 8px;
    }

    .report-summary-footer {
        border: 1px solid #ddd;
        grid-template-columns: repeat(4, 1fr);
        background: #fff;
    }

}

</style>

@endsection