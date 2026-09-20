@extends('admin.layouts.admin')

@section('title', 'Laporan')
@section('page-title', 'Laporan')
@section('page-subtitle', 'Ringkasan aktivitas reservasi dan pembayaran lapangan')

@section('content')

<div class="container-fluid report-dashboard">

    {{-- ==========================================================
        HEADER
    =========================================================== --}}
    <div class="report-page-header">

        <div>
            <div class="report-eyebrow">
                <i class="bi bi-bar-chart-line-fill"></i>
                REPORT MANAGEMENT
            </div>

            <h1>Reservation Reports</h1>

            <p>
                Ringkasan aktivitas reservasi, status booking,
                pembayaran, dan pendapatan ABHC.
            </p>
        </div>

        <div class="report-header-action">
            <a href="{{ route('admin.reports.reservation') }}"
               class="btn btn-report-primary">

                <i class="bi bi-file-earmark-bar-graph"></i>

                <span>Detail Laporan</span>

            </a>
        </div>

    </div>


    {{-- ==========================================================
        BOOKING SUMMARY
    =========================================================== --}}
    <div class="section-heading">
        <div>
            <h2>Booking Overview</h2>
            <p>Ringkasan status reservasi lapangan.</p>
        </div>
    </div>

    <div class="row g-3 mb-4">

        {{-- TOTAL --}}
        <div class="col-12 col-sm-6 col-xl-3">

            <div class="report-stat-card">

                <div class="stat-icon">
                    <i class="bi bi-calendar-check"></i>
                </div>

                <div class="stat-content">

                    <span>Total Booking</span>

                    <strong>
                        {{ number_format($totalBooking) }}
                    </strong>

                    <small>
                        Seluruh data reservasi
                    </small>

                </div>

            </div>

        </div>


        {{-- TODAY --}}
        <div class="col-12 col-sm-6 col-xl-3">

            <div class="report-stat-card">

                <div class="stat-icon">
                    <i class="bi bi-calendar-day"></i>
                </div>

                <div class="stat-content">

                    <span>Booking Hari Ini</span>

                    <strong>
                        {{ number_format($todayBooking) }}
                    </strong>

                    <small>
                        Reservasi pada hari ini
                    </small>

                </div>

            </div>

        </div>


        {{-- APPROVED --}}
        <div class="col-12 col-sm-6 col-xl-3">

            <div class="report-stat-card">

                <div class="stat-icon success">
                    <i class="bi bi-check-circle"></i>
                </div>

                <div class="stat-content">

                    <span>Booking Approved</span>

                    <strong class="text-success">
                        {{ number_format($approvedBooking) }}
                    </strong>

                    <small>
                        Reservasi telah disetujui
                    </small>

                </div>

            </div>

        </div>


        {{-- PENDING --}}
        <div class="col-12 col-sm-6 col-xl-3">

            <div class="report-stat-card">

                <div class="stat-icon warning">
                    <i class="bi bi-hourglass-split"></i>
                </div>

                <div class="stat-content">

                    <span>Booking Pending</span>

                    <strong class="text-warning">
                        {{ number_format($pendingBooking) }}
                    </strong>

                    <small>
                        Menunggu proses approval
                    </small>

                </div>

            </div>

        </div>

    </div>


    {{-- ==========================================================
        STATUS & PAYMENT
    =========================================================== --}}
    <div class="section-heading">

        <div>
            <h2>Status & Payment</h2>
            <p>Informasi status booking dan pembayaran.</p>
        </div>

    </div>

    <div class="row g-3 mb-4">

        {{-- REJECTED --}}
        <div class="col-6 col-md-4 col-xl-2">

            <div class="mini-stat-card">

                <div class="mini-stat-icon danger">
                    <i class="bi bi-x-circle"></i>
                </div>

                <span>Rejected</span>

                <strong>
                    {{ number_format($rejectedBooking) }}
                </strong>

            </div>

        </div>


        {{-- CANCELLED --}}
        <div class="col-6 col-md-4 col-xl-2">

            <div class="mini-stat-card">

                <div class="mini-stat-icon secondary">
                    <i class="bi bi-calendar-x"></i>
                </div>

                <span>Cancelled</span>

                <strong>
                    {{ number_format($cancelledBooking) }}
                </strong>

            </div>

        </div>


        {{-- PAID --}}
        <div class="col-6 col-md-4 col-xl-2">

            <div class="mini-stat-card">

                <div class="mini-stat-icon success">
                    <i class="bi bi-credit-card"></i>
                </div>

                <span>Payment Paid</span>

                <strong>
                    {{ number_format($paidBooking) }}
                </strong>

            </div>

        </div>


        {{-- PENDING PAYMENT --}}
        <div class="col-6 col-md-4 col-xl-2">

            <div class="mini-stat-card">

                <div class="mini-stat-icon warning">
                    <i class="bi bi-clock-history"></i>
                </div>

                <span>Payment Pending</span>

                <strong>
                    {{ number_format($pendingPayment) }}
                </strong>

            </div>

        </div>


        {{-- FAILED --}}
        <div class="col-6 col-md-4 col-xl-2">

            <div class="mini-stat-card">

                <div class="mini-stat-icon danger">
                    <i class="bi bi-credit-card-2-front"></i>
                </div>

                <span>Payment Failed</span>

                <strong>
                    {{ number_format($failedPayment) }}
                </strong>

            </div>

        </div>


        {{-- UNPAID --}}
        <div class="col-6 col-md-4 col-xl-2">

            <div class="mini-stat-card">

                <div class="mini-stat-icon secondary">
                    <i class="bi bi-wallet2"></i>
                </div>

                <span>Booking Unpaid</span>

                <strong>
                    {{ number_format($unpaidBooking) }}
                </strong>

            </div>

        </div>

    </div>


    {{-- ==========================================================
        REVENUE + LATEST BOOKING
    =========================================================== --}}
    <div class="row g-3">

        {{-- REVENUE --}}
        <div class="col-12 col-xl-4">

            <div class="report-panel h-100">

                <div class="panel-header">

                    <div>
                        <h3>Revenue</h3>
                        <p>Ringkasan pendapatan reservasi.</p>
                    </div>

                    <div class="panel-icon">
                        <i class="bi bi-cash-stack"></i>
                    </div>

                </div>


                <div class="revenue-item">

                    <span>
                        Revenue Bulan Ini
                    </span>

                    <strong class="text-primary">
                        Rp {{ number_format($monthRevenue, 0, ',', '.') }}
                    </strong>

                </div>


                <div class="revenue-divider"></div>


                <div class="revenue-item">

                    <span>
                        Total Revenue
                    </span>

                    <strong class="text-success">
                        Rp {{ number_format($totalRevenue, 0, ',', '.') }}
                    </strong>

                </div>

            </div>

        </div>


        {{-- LATEST BOOKING --}}
        <div class="col-12 col-xl-8">

            <div class="report-panel h-100">

                <div class="panel-header">

                    <div>
                        <h3>Latest Booking</h3>
                        <p>Lima reservasi terbaru.</p>
                    </div>

                    <a href="{{ route('admin.reports.reservation') }}"
                       class="panel-link">

                        Lihat Semua
                        <i class="bi bi-arrow-right"></i>

                    </a>

                </div>


                <div class="table-responsive">

                    <table class="table latest-booking-table align-middle mb-0">

                        <thead>

                            <tr>
                                <th>Customer</th>
                                <th>Tanggal</th>
                                <th>Jam</th>
                                <th>Status</th>
                                <th class="text-end">Total</th>
                            </tr>

                        </thead>

                        <tbody>

                        @forelse($latestBookings as $booking)

                            <tr>

                                <td>

                                    <div class="customer-cell">

                                        <div class="customer-avatar">
                                            <i class="bi bi-person-fill"></i>
                                        </div>

                                        <div>

                                            <strong>
                                                {{ $booking->customer_name }}
                                            </strong>

                                            @if($booking->club_name)

                                                <small>
                                                    {{ $booking->club_name }}
                                                </small>

                                            @endif

                                        </div>

                                    </div>

                                </td>


                                <td>

                                    <span class="table-main-text">

                                        {{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}

                                    </span>

                                </td>


                                <td>

                                    <span class="time-badge">

                                        <i class="bi bi-clock"></i>

                                        {{ substr($booking->start_time, 0, 5) }}
                                        -
                                        {{ substr($booking->end_time, 0, 5) }}

                                    </span>

                                </td>


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

                                    @else

                                        <span class="status-badge cancelled">
                                            <i class="bi bi-dash-circle-fill"></i>
                                            Cancelled
                                        </span>

                                    @endif

                                </td>


                                <td class="text-end">

                                    <strong class="price-text">

                                        Rp {{ number_format($booking->total_price, 0, ',', '.') }}

                                    </strong>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="5">

                                    <div class="empty-state">

                                        <i class="bi bi-calendar-x"></i>

                                        <strong>
                                            Belum ada data booking
                                        </strong>

                                        <span>
                                            Data reservasi akan muncul di sini.
                                        </span>

                                    </div>

                                </td>

                            </tr>

                        @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</div>


<style>

/* ==========================================================
   BASE
========================================================== */

.report-dashboard {
    padding-bottom: 30px;
}


/* ==========================================================
   HEADER
========================================================== */

.report-page-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    gap: 20px;
    margin-bottom: 30px;
}

.report-eyebrow {
    display: flex;
    align-items: center;
    gap: 7px;
    font-size: 13px;
    font-weight: 700;
    letter-spacing: .08em;
    color: #EA580C;
    margin-bottom: 7px;
}

.report-page-header h1 {
    margin: 0;
    font-size: 32px;
    line-height: 1.15;
    font-weight: 800;
    color: #0F172A;
}

.report-page-header p {
    margin: 8px 0 0;
    font-size: 15px;
    color: #64748B;
}

.btn-report-primary {
    min-height: 46px;
    padding: 0 20px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    border: 0;
    border-radius: 9px;
    background: #EA580C;
    color: #fff;
    font-size: 14px;
    font-weight: 700;
}

.btn-report-primary:hover {
    background: #C2410C;
    color: #fff;
}


/* ==========================================================
   SECTION HEADING
========================================================== */

.section-heading {
    margin-bottom: 14px;
}

.section-heading h2 {
    margin: 0;
    font-size: 19px;
    font-weight: 800;
    color: #0F172A;
}

.section-heading p {
    margin: 4px 0 0;
    font-size: 14px;
    color: #64748B;
}


/* ==========================================================
   MAIN STAT
========================================================== */

.report-stat-card {
    min-height: 142px;
    display: flex;
    align-items: center;
    gap: 17px;
    padding: 21px;
    background: #fff;
    border: 1px solid #E2E8F0;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(15, 23, 42, .05);
}

.stat-icon {
    width: 50px;
    height: 50px;
    flex: 0 0 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 11px;
    background: rgba(234, 88, 12, .10);
    color: #EA580C;
    font-size: 22px;
}

.stat-icon.success {
    background: rgba(22, 163, 74, .10);
    color: #16A34A;
}

.stat-icon.warning {
    background: rgba(245, 158, 11, .12);
    color: #D97706;
}

.stat-content {
    min-width: 0;
}

.stat-content span {
    display: block;
    font-size: 14px;
    font-weight: 600;
    color: #64748B;
}

.stat-content strong {
    display: block;
    margin-top: 5px;
    font-size: 27px;
    line-height: 1;
    font-weight: 800;
    color: #0F172A;
}

.stat-content small {
    display: block;
    margin-top: 8px;
    font-size: 12px;
    color: #94A3B8;
}


/* ==========================================================
   MINI STAT
========================================================== */

.mini-stat-card {
    min-height: 126px;
    padding: 17px;
    background: #fff;
    border: 1px solid #E2E8F0;
    border-radius: 11px;
    box-shadow: 0 4px 15px rgba(15, 23, 42, .04);
}

.mini-stat-icon {
    width: 34px;
    height: 34px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 11px;
    border-radius: 8px;
    background: rgba(22, 163, 74, .10);
    color: #16A34A;
}

.mini-stat-icon.warning {
    background: rgba(245, 158, 11, .12);
    color: #D97706;
}

.mini-stat-icon.danger {
    background: rgba(220, 38, 38, .10);
    color: #DC2626;
}

.mini-stat-icon.secondary {
    background: rgba(100, 116, 139, .10);
    color: #64748B;
}

.mini-stat-card span {
    display: block;
    font-size: 13px;
    font-weight: 600;
    color: #64748B;
}

.mini-stat-card strong {
    display: block;
    margin-top: 4px;
    font-size: 23px;
    font-weight: 800;
    color: #0F172A;
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

.panel-header {
    min-height: 75px;
    padding: 18px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 15px;
    border-bottom: 1px solid #E2E8F0;
}

.panel-header h3 {
    margin: 0;
    font-size: 17px;
    font-weight: 800;
    color: #0F172A;
}

.panel-header p {
    margin: 4px 0 0;
    font-size: 13px;
    color: #64748B;
}

.panel-icon {
    width: 38px;
    height: 38px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 9px;
    background: rgba(234, 88, 12, .10);
    color: #EA580C;
    font-size: 18px;
}

.panel-link {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 13px;
    font-weight: 700;
    color: #EA580C;
    text-decoration: none;
}

.panel-link:hover {
    color: #C2410C;
}


/* ==========================================================
   REVENUE
========================================================== */

.revenue-item {
    padding: 24px 20px;
}

.revenue-item span {
    display: block;
    margin-bottom: 7px;
    font-size: 14px;
    font-weight: 600;
    color: #64748B;
}

.revenue-item strong {
    display: block;
    font-size: 25px;
    font-weight: 800;
}

.revenue-divider {
    height: 1px;
    margin: 0 20px;
    background: #E2E8F0;
}


/* ==========================================================
   LATEST BOOKING TABLE
========================================================== */

.latest-booking-table {
    min-width: 650px;
}

.latest-booking-table thead th {
    padding: 13px 16px;
    background: #F8FAFC;
    border-bottom: 1px solid #E2E8F0;
    font-size: 12px;
    font-weight: 800;
    color: #64748B;
    text-transform: uppercase;
    letter-spacing: .04em;
}

.latest-booking-table tbody td {
    padding: 14px 16px;
    border-bottom: 1px solid #F1F5F9;
    font-size: 13px;
}

.latest-booking-table tbody tr:last-child td {
    border-bottom: 0;
}

.customer-cell {
    display: flex;
    align-items: center;
    gap: 10px;
}

.customer-avatar {
    width: 35px;
    height: 35px;
    flex: 0 0 35px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 9px;
    background: #F1F5F9;
    color: #64748B;
}

.customer-cell strong {
    display: block;
    font-size: 14px;
    color: #0F172A;
}

.customer-cell small {
    display: block;
    margin-top: 2px;
    font-size: 11px;
    color: #94A3B8;
}

.table-main-text {
    font-size: 13px;
    font-weight: 600;
    color: #334155;
}

.time-badge {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    white-space: nowrap;
    font-size: 12px;
    font-weight: 700;
    color: #475569;
}

.status-badge {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 5px 9px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 700;
    white-space: nowrap;
}

.status-badge.approved {
    color: #15803D;
    background: #DCFCE7;
}

.status-badge.pending {
    color: #B45309;
    background: #FEF3C7;
}

.status-badge.rejected {
    color: #B91C1C;
    background: #FEE2E2;
}

.status-badge.cancelled {
    color: #475569;
    background: #F1F5F9;
}

.price-text {
    font-size: 13px;
    color: #0F172A;
    white-space: nowrap;
}


/* ==========================================================
   EMPTY
========================================================== */

.empty-state {
    min-height: 180px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    gap: 5px;
    color: #94A3B8;
}

.empty-state i {
    margin-bottom: 5px;
    font-size: 30px;
}

.empty-state strong {
    font-size: 14px;
    color: #64748B;
}

.empty-state span {
    font-size: 12px;
}


/* ==========================================================
   MOBILE
========================================================== */

@media (max-width: 991.98px) {

    .report-page-header {
        align-items: flex-start;
    }

}

@media (max-width: 767.98px) {

    .report-page-header {
        flex-direction: column;
        margin-bottom: 24px;
    }

    .report-header-action {
        width: 100%;
    }

    .btn-report-primary {
        width: 100%;
    }

    .report-page-header h1 {
        font-size: 27px;
    }

    .report-page-header p {
        font-size: 14px;
        line-height: 1.5;
    }

    .section-heading h2 {
        font-size: 18px;
    }

    .report-stat-card {
        min-height: 125px;
        padding: 17px;
    }

    .stat-content strong {
        font-size: 24px;
    }

    .stat-content span {
        font-size: 13px;
    }

    .mini-stat-card {
        min-height: 115px;
    }

    .mini-stat-card span {
        font-size: 12px;
    }

    .mini-stat-card strong {
        font-size: 21px;
    }

    .panel-header {
        padding: 16px;
    }

    .latest-booking-table {
        min-width: 650px;
    }

}

@media (max-width: 575.98px) {

    .report-page-header h1 {
        font-size: 24px;
    }

    .report-eyebrow {
        font-size: 11px;
    }

    .report-stat-card {
        gap: 12px;
    }

    .stat-icon {
        width: 43px;
        height: 43px;
        flex-basis: 43px;
        font-size: 18px;
    }

}

</style>

@endsection