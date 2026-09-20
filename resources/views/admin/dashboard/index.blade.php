@extends('admin.layouts.admin')

@section('title', 'Dashboard')

@section('page-title', 'Dashboard')

@section('page-subtitle', 'Ringkasan aktivitas ASEBA Basketball Club & Home Court')

@section('content')

{{-- ==========================================================
    DESKTOP DASHBOARD
========================================================== --}}

<div class="d-none d-lg-block">

<div class="container-fluid">

    <!-- ==========================================================
                            HEADER
    =========================================================== -->

    <div class="row align-items-center mb-4 g-3">

        <div class="col-lg-7">

            <h3 class="fw-bold mb-2">

                Dashboard Overview 👋

            </h3>

            <p class="text-muted mb-0">

                Selamat datang kembali di Admin ASEBA. Berikut ringkasan aktivitas hari ini.

            </p>

        </div>

        <div class="col-lg-5">

            <div class="d-flex justify-content-lg-end flex-wrap gap-2">

                <button class="btn btn-light border">

                    <i class="bi bi-calendar3 me-2"></i>

                    {{ now()->translatedFormat('d F Y') }}

                </button>

                <button class="btn btn-primary">

                    <i class="bi bi-arrow-clockwise me-2"></i>

                    Refresh

                </button>

            </div>

        </div>

    </div>

    <div class="row g-3 mb-4">

        @include('admin.dashboard.components.bookings_summary')

        @include('admin.dashboard.components.players_summary')

        @include('admin.dashboard.components.teams_summary')

        @include('admin.dashboard.components.revenue_card')

    </div>

    <!-- ==========================================================
                        CONTENT
    =========================================================== -->

    <div class="row g-4">

        <div class="col-lg-8">

            @include('admin.dashboard.components.latest_bookings')

        </div>

        <div class="col-lg-4">

            @include('admin.dashboard.components.today_schedule')

        </div>

    </div>

    {{-- ==========================================================
        ROW 2
    ========================================================== --}}

    <div class="row g-4 mt-1">

        {{-- Revenue Chart --}}
        <div class="col-lg-8">

            @include('admin.dashboard.components.revenue_chart')

        </div>

        {{-- Quick Action + Activity --}}
        <div class="col-lg-4">

            @include('admin.dashboard.components.quick_action')

            @include('admin.dashboard.components.activity')

        </div>

    </div>

<style>

.summary-card{

    background:#fff;

    border-radius:18px;

    padding:20px;

    display:flex;

    justify-content:space-between;

    align-items:center;

    box-shadow:0 10px 25px rgba(15,23,42,.05);

    transition:.25s;

    min-height:95px;
    padding:18px;

}

.summary-card:hover{

    transform:translateY(-4px);

}

.summary-card small{

    display:block;

    color:#64748B;

    font-weight:600;

    margin-bottom:8px;

}

.summary-card h3{

    margin:0;

    font-size:28px;

    font-weight:800;

}

.summary-card span{

    font-size:13px;

    font-weight:600;

    color:#16A34A;

}

.summary-icon{

    width:62px;

    height:62px;

    border-radius:16px;

    display:flex;

    align-items:center;

    justify-content:center;

    color:#fff;

    font-size:20px;

}

.booking-card .summary-icon{

    background:#EA580C;

}

.member-card .summary-icon{

    background:#2563EB;

}

.team-card .summary-icon{

    background:#7C3AED;

}

.income-card .summary-icon{

    background:#16A34A;

}

.dashboard-card{

    background:#fff;

    border-radius:18px;

    padding:22px;

    box-shadow:0 10px 25px rgba(15,23,42,.05);

}

.card-title-custom{

    display:flex;

    justify-content:space-between;

    align-items:center;

    margin-bottom:20px;

}

.card-title-custom h5{

    margin:0;

    font-size:18px;

    font-weight:700;

}

.avatar{

    width:42px;

    height:42px;

    border-radius:50%;

    display:flex;

    justify-content:center;

    align-items:center;

    color:#fff;

    font-weight:700;

}

.calendar-grid{

    display:grid;

    grid-template-columns:repeat(7,1fr);

    gap:8px;

    text-align:center;

}

.calendar-grid>div{

    padding:8px;

    border-radius:12px;

    font-weight:600;

}

.calendar-day{

    background:#F8FAFC;

    cursor:pointer;

    transition:.25s;

}

.calendar-day:hover{

    background:#EA580C;

    color:#fff;

}

.calendar-day.active{

    background:#EA580C;

    color:#fff;

}

.schedule-list{

    display:flex;

    flex-direction:column;

    gap:14px;

}

.schedule-item{

    display:flex;

    align-items:center;

    justify-content:space-between;

    padding:14px;

    border-radius:14px;

    background:#F8FAFC;

}

.schedule-time{

    width:65px;

    font-weight:700;

    color:#EA580C;

}

.schedule-content{

    flex:1;

    padding:0 14px;

}

.schedule-content strong{

    display:block;

    font-size:14px;

}

.schedule-content small{

    color:#64748B;

}

.quick-action{

    background:#F8FAFC;

    border-radius:16px;

    display:flex;

    flex-direction:column;

    justify-content:center;

    align-items:center;

    height:72px;

    gap:8px;

    color:#0F172A;

    transition:.25s;

    font-weight:600;

}

.quick-action i{

    font-size:24px;

    color:#EA580C;

}

.quick-action:hover{

    background:#EA580C;

    color:#fff;

}

.quick-action:hover i{

    color:#fff;

}

.activity-list{

    display:flex;

    flex-direction:column;

    gap:18px;

}

.activity-item{

    display:flex;

    align-items:center;

    gap:14px;

}

.activity-icon{

    width:42px;

    height:42px;

    border-radius:50%;

    display:flex;

    justify-content:center;

    align-items:center;

    color:#fff;

    flex-shrink:0;

}

.table tbody tr:hover{

    background:#F8FAFC;

}

/* ==========================================================
                    RESPONSIVE
========================================================== */

@media (max-width:1200px){

    .summary-card{

        height:auto;

        min-height:110px;

    }

}

@media (max-width:992px){

    .dashboard-card{

        margin-bottom:20px;

    }

    .card-title-custom{

        flex-direction:column;

        align-items:flex-start;

        gap:12px;

    }

    .schedule-item{

        flex-wrap:wrap;

        gap:10px;

    }

    .schedule-content{

        padding:0;

        width:100%;

    }

}

@media (max-width:768px){

    .summary-card{

        padding:18px;

    }

    .summary-card h3{

        font-size:22px;

    }

    .summary-icon{

        width:54px;

        height:54px;

        font-size:20px;

    }

    .calendar-grid{

        gap:5px;

    }

    .calendar-grid>div{

        padding:8px 4px;

        font-size:12px;

    }

    .table{

        min-width:600px;

    }

}

@media (max-width:576px){

    .container-fluid{

        padding:0;

    }

    .dashboard-card{

        border-radius:16px;

        padding:16px;

    }

    .summary-card{

        border-radius:16px;

    }

    .summary-card h3{

        font-size:20px;

    }

    .card-title-custom h5{

        font-size:16px;

    }

    .quick-action{

        height:80px;

        font-size:13px;

    }

    .quick-action i{

        font-size:20px;

    }

    .schedule-time{

        width:55px;

        font-size:14px;

    }

    .activity-item{

        align-items:flex-start;

    }

}

</style>

</div> {{-- container-fluid --}}

</div> {{-- d-none d-lg-block --}}

{{-- ==========================================================
    MOBILE DASHBOARD
========================================================== --}}

<div class="d-block d-lg-none">

    @include('admin.dashboard.components.mobile_dashboard')

</div>

@endsection
