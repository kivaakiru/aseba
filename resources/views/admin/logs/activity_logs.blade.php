@extends('admin.layouts.admin')

@section('title', 'Activity Logs')
@section('page-title', 'Activity Logs')
@section('page-subtitle', 'Riwayat aktivitas pengguna dan perubahan pada sistem ASEBA')

@section('content')

<div class="activity-log-page">

    {{-- =========================================================
         HEADER
    ========================================================== --}}
    <div class="activity-header">

        <div>

            <div class="activity-eyebrow">
                <i class="bi bi-shield-check"></i>
                SYSTEM ACTIVITY
            </div>

            <h1>Activity Logs</h1>

            <p>
                Pantau seluruh aktivitas yang terjadi di dalam sistem
                manajemen ASEBA.
            </p>

        </div>

    </div>


    {{-- =========================================================
         SUMMARY
    ========================================================== --}}
    <div class="row g-3 mb-4">

        <div class="col-12 col-sm-6 col-xl-3">

            <div class="activity-summary-card">

                <div class="summary-icon">
                    <i class="bi bi-activity"></i>
                </div>

                <div>

                    <span>Total Aktivitas</span>

                    <strong>0</strong>

                    <small>
                        Seluruh aktivitas tercatat
                    </small>

                </div>

            </div>

        </div>


        <div class="col-12 col-sm-6 col-xl-3">

            <div class="activity-summary-card">

                <div class="summary-icon login">
                    <i class="bi bi-box-arrow-in-right"></i>
                </div>

                <div>

                    <span>Login Hari Ini</span>

                    <strong>0</strong>

                    <small>
                        Aktivitas login pengguna
                    </small>

                </div>

            </div>

        </div>


        <div class="col-12 col-sm-6 col-xl-3">

            <div class="activity-summary-card">

                <div class="summary-icon booking">
                    <i class="bi bi-calendar-check"></i>
                </div>

                <div>

                    <span>Booking Hari Ini</span>

                    <strong>0</strong>

                    <small>
                        Aktivitas reservasi
                    </small>

                </div>

            </div>

        </div>


        <div class="col-12 col-sm-6 col-xl-3">

            <div class="activity-summary-card">

                <div class="summary-icon admin">
                    <i class="bi bi-person-gear"></i>
                </div>

                <div>

                    <span>Admin Activity</span>

                    <strong>0</strong>

                    <small>
                        Aktivitas administrator
                    </small>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
         MAIN PANEL
    ========================================================== --}}
    <div class="activity-panel">

        {{-- PANEL HEADER --}}
        <div class="activity-panel-header">

            <div class="panel-title-wrapper">

                <div class="panel-title-icon">
                    <i class="bi bi-clock-history"></i>
                </div>

                <div>

                    <h2>Riwayat Aktivitas</h2>

                    <p>
                        Semua aktivitas sistem akan ditampilkan di sini.
                    </p>

                </div>

            </div>

        </div>


        {{-- =====================================================
             FILTER
        ====================================================== --}}
        <div class="activity-filter">

            <div class="row g-3">

                <div class="col-12 col-md-4">

                    <label>
                        Cari Aktivitas
                    </label>

                    <div class="activity-search">

                        <i class="bi bi-search"></i>

                        <input
                            type="text"
                            class="form-control"
                            placeholder="Cari aktivitas, user, atau keterangan..."
                        >

                    </div>

                </div>


                <div class="col-12 col-md-3">

                    <label>
                        Aktivitas
                    </label>

                    <select class="form-select">

                        <option value="">
                            Semua Aktivitas
                        </option>

                        <option value="login">
                            Login
                        </option>

                        <option value="logout">
                            Logout
                        </option>

                        <option value="booking">
                            Booking
                        </option>

                        <option value="approval">
                            Approval
                        </option>

                        <option value="payment">
                            Payment
                        </option>

                        <option value="user">
                            User Management
                        </option>

                        <option value="gallery">
                            Gallery
                        </option>

                        <option value="setting">
                            Setting
                        </option>

                    </select>

                </div>


                <div class="col-12 col-md-3">

                    <label>
                        Periode
                    </label>

                    <select class="form-select">

                        <option value="">
                            Semua Waktu
                        </option>

                        <option value="today">
                            Hari Ini
                        </option>

                        <option value="week">
                            7 Hari Terakhir
                        </option>

                        <option value="month">
                            30 Hari Terakhir
                        </option>

                    </select>

                </div>


                <div class="col-12 col-md-2">

                    <label class="filter-label-hidden">
                        Action
                    </label>

                    <button
                        type="button"
                        class="btn btn-activity-filter">

                        <i class="bi bi-funnel-fill"></i>

                        Filter

                    </button>

                </div>

            </div>

        </div>


        {{-- =====================================================
             ACTIVITY TIMELINE
        ====================================================== --}}
        <div class="activity-content">

            <div class="activity-date-heading">

                <span>
                    Aktivitas Terbaru
                </span>

            </div>


            {{-- EMPTY STATE --}}
            <div class="activity-empty">

                <div class="activity-empty-icon">

                    <i class="bi bi-clock-history"></i>

                </div>

                <h3>
                    Belum Ada Aktivitas
                </h3>

                <p>
                    Aktivitas sistem akan muncul di halaman ini
                    setelah fitur Activity Log terhubung dengan
                    proses sistem.
                </p>

            </div>

        </div>


        {{-- =====================================================
             PANEL FOOTER
        ====================================================== --}}
        <div class="activity-footer">

            <div class="activity-result">
                Menampilkan <strong>0</strong> aktivitas
            </div>

        </div>

    </div>

</div>


<style>

/* =========================================================
   PAGE
========================================================= */

.activity-log-page {
    width: 100%;
    padding-bottom: 40px;
}


/* =========================================================
   HEADER
========================================================= */

.activity-header {
    margin-bottom: 28px;
}

.activity-eyebrow {
    display: flex;
    align-items: center;
    gap: 7px;

    margin-bottom: 8px;

    color: #EA580C;

    font-size: 13px;
    font-weight: 800;

    letter-spacing: .09em;
    text-transform: uppercase;
}

.activity-header h1 {
    margin: 0;

    color: #0F172A;

    font-size: 32px;
    line-height: 1.15;

    font-weight: 800;
}

.activity-header p {
    margin: 8px 0 0;

    color: #64748B;

    font-size: 15px;
    line-height: 1.6;
}


/* =========================================================
   SUMMARY
========================================================= */

.activity-summary-card {
    min-height: 135px;

    display: flex;
    align-items: center;

    gap: 15px;

    padding: 20px;

    background: #FFFFFF;

    border: 1px solid #E2E8F0;
    border-radius: 12px;

    box-shadow: 0 4px 15px rgba(15, 23, 42, .05);
}

.summary-icon {
    width: 48px;
    height: 48px;

    flex: 0 0 48px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 11px;

    background: rgba(234, 88, 12, .10);

    color: #EA580C;

    font-size: 21px;
}

.summary-icon.login {
    background: rgba(37, 99, 235, .10);
    color: #2563EB;
}

.summary-icon.booking {
    background: rgba(22, 163, 74, .10);
    color: #16A34A;
}

.summary-icon.admin {
    background: rgba(124, 58, 237, .10);
    color: #7C3AED;
}

.activity-summary-card span {
    display: block;

    margin-bottom: 4px;

    color: #64748B;

    font-size: 13px;
    font-weight: 600;
}

.activity-summary-card strong {
    display: block;

    color: #0F172A;

    font-size: 26px;
    line-height: 1;

    font-weight: 800;
}

.activity-summary-card small {
    display: block;

    margin-top: 7px;

    color: #94A3B8;

    font-size: 12px;
}


/* =========================================================
   MAIN PANEL
========================================================= */

.activity-panel {
    background: #FFFFFF;

    border: 1px solid #E2E8F0;
    border-radius: 12px;

    box-shadow: 0 4px 15px rgba(15, 23, 42, .05);

    overflow: hidden;
}


/* =========================================================
   PANEL HEADER
========================================================= */

.activity-panel-header {
    min-height: 78px;

    display: flex;
    align-items: center;

    padding: 18px 21px;

    border-bottom: 1px solid #E2E8F0;
}

.panel-title-wrapper {
    display: flex;
    align-items: center;

    gap: 12px;
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

.panel-title-wrapper h2 {
    margin: 0;

    color: #0F172A;

    font-size: 18px;
    font-weight: 800;
}

.panel-title-wrapper p {
    margin: 3px 0 0;

    color: #64748B;

    font-size: 13px;
}


/* =========================================================
   FILTER
========================================================= */

.activity-filter {
    padding: 20px 21px;

    background: #F8FAFC;

    border-bottom: 1px solid #E2E8F0;
}

.activity-filter label {
    display: block;

    margin-bottom: 7px;

    color: #334155;

    font-size: 13px;
    font-weight: 700;
}

.filter-label-hidden {
    opacity: 0;
    pointer-events: none;
}

.activity-filter .form-control,
.activity-filter .form-select {
    min-height: 44px;

    border: 1px solid #CBD5E1;

    border-radius: 8px;

    background: #FFFFFF;

    color: #0F172A;

    font-size: 14px;
}

.activity-filter .form-control:focus,
.activity-filter .form-select:focus {
    border-color: #EA580C;

    box-shadow: 0 0 0 .2rem rgba(234, 88, 12, .10);
}

.activity-search {
    position: relative;
}

.activity-search i {
    position: absolute;

    top: 50%;
    left: 14px;

    z-index: 2;

    transform: translateY(-50%);

    color: #94A3B8;

    font-size: 15px;
}

.activity-search .form-control {
    padding-left: 40px;
}

.btn-activity-filter {
    width: 100%;

    min-height: 44px;

    display: inline-flex;
    align-items: center;
    justify-content: center;

    gap: 7px;

    border: 0;
    border-radius: 8px;

    background: #EA580C;
    color: #FFFFFF;

    font-size: 14px;
    font-weight: 700;
}

.btn-activity-filter:hover {
    background: #C2410C;
    color: #FFFFFF;
}


/* =========================================================
   ACTIVITY CONTENT
========================================================= */

.activity-content {
    min-height: 390px;

    padding: 24px 21px;
}

.activity-date-heading {
    display: flex;
    align-items: center;

    margin-bottom: 18px;
}

.activity-date-heading::after {
    content: "";

    flex: 1;

    height: 1px;

    margin-left: 14px;

    background: #E2E8F0;
}

.activity-date-heading span {
    color: #64748B;

    font-size: 12px;
    font-weight: 800;

    text-transform: uppercase;

    letter-spacing: .06em;
}


/* =========================================================
   EMPTY STATE
========================================================= */

.activity-empty {
    min-height: 285px;

    display: flex;
    align-items: center;
    justify-content: center;

    flex-direction: column;

    text-align: center;

    border: 1px dashed #CBD5E1;

    border-radius: 12px;

    background: #FAFBFC;
}

.activity-empty-icon {
    width: 62px;
    height: 62px;

    display: flex;
    align-items: center;
    justify-content: center;

    margin-bottom: 15px;

    border-radius: 14px;

    background: #FFF7ED;

    color: #EA580C;

    font-size: 27px;
}

.activity-empty h3 {
    margin: 0 0 7px;

    color: #334155;

    font-size: 17px;
    font-weight: 800;
}

.activity-empty p {
    max-width: 500px;

    margin: 0 auto;

    color: #94A3B8;

    font-size: 13px;
    line-height: 1.6;
}


/* =========================================================
   FOOTER
========================================================= */

.activity-footer {
    min-height: 63px;

    display: flex;
    align-items: center;

    padding: 13px 21px;

    border-top: 1px solid #E2E8F0;
}

.activity-result {
    color: #64748B;

    font-size: 13px;
}

.activity-result strong {
    color: #334155;

    font-weight: 800;
}


/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 767.98px) {

    .activity-header h1 {
        font-size: 27px;
    }

    .activity-header p {
        font-size: 14px;
    }

    .activity-summary-card {
        min-height: 120px;
        padding: 17px;
    }

    .activity-summary-card strong {
        font-size: 23px;
    }

    .activity-filter {
        padding: 17px;
    }

    .activity-content {
        padding: 18px 17px;
    }

    .filter-label-hidden {
        display: none;
    }

}

@media (max-width: 575.98px) {

    .activity-header h1 {
        font-size: 24px;
    }

    .activity-eyebrow {
        font-size: 11px;
    }

    .activity-summary-card {
        gap: 11px;
    }

    .summary-icon {
        width: 42px;
        height: 42px;
        flex-basis: 42px;

        font-size: 18px;
    }

    .activity-summary-card span {
        font-size: 12px;
    }

    .activity-summary-card strong {
        font-size: 21px;
    }

    .activity-summary-card small {
        font-size: 11px;
    }

}


/* =========================================================
   PRINT
========================================================= */

@media print {

    .activity-filter {
        display: none !important;
    }

    .activity-panel {
        box-shadow: none !important;
        border: 1px solid #D1D5DB;
    }

    .activity-empty {
        border: 1px solid #D1D5DB;
    }

}

</style>

@endsection