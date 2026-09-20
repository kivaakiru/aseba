@extends('admin.layouts.admin')

@section('title', 'Booking History')

@section('page-title', 'Booking History')

@section('page-subtitle', 'Riwayat seluruh aktivitas booking lapangan.')

@section('content')

<div class="history-page">

    {{-- ============================= --}}
    {{-- SUMMARY --}}
    {{-- ============================= --}}

    <div class="row g-4 mb-4">

        <div class="col-xl-4 col-md-4">

            <div class="summary-card">

                <div class="summary-icon bg-primary-subtle text-primary">

                    <i class="bi bi-journal-text"></i>

                </div>

                <div>

                    <small>Total Booking</small>

                    <h3>{{ $totalBooking }}</h3>

                </div>

            </div>

        </div>

        <div class="col-xl-4 col-md-4">

            <div class="summary-card">

                <div class="summary-icon bg-success-subtle text-success">

                    <i class="bi bi-check-circle-fill"></i>

                </div>

                <div>

                    <small>Approved</small>

                    <h3>{{ $approvedCount }}</h3>

                </div>

            </div>

        </div>

        <div class="col-xl-4 col-md-4">

            <div class="summary-card">

                <div class="summary-icon bg-warning-subtle text-warning">

                    <i class="bi bi-cash-stack"></i>

                </div>

                <div>

                    <small>Revenue</small>

                    <h3>

                        @php
                            $revenue = $bookings
                                ->filter(function ($booking) {
                                    return $booking->status === 'approved'
                                        && (
                                            $booking->payment_method !== 'cash'
                                            || $booking->payment_status === 'paid'
                                        );
                                })
                                ->sum('total_price');
                        @endphp

                        Rp {{ number_format($revenue, 0, ',', '.') }}

                    </h3>

                </div>

            </div>

        </div>

    </div>

    {{-- ============================= --}}
    {{-- FILTER --}}
    {{-- ============================= --}}

    <div class="card border-0 shadow-sm rounded-4 mb-4">

        <form

            action="{{ route('admin.courts.history') }}"

            method="GET">

       <div class="card-body">

            <div class="row g-3">

                <div class="col-lg-3">

                    <input
                        type="text"
                        class="form-control"
                        id="historySearch"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Customer / Club / Phone">
                </div>

                <div class="col-lg-2">

                    <select

                        class="form-select"

                        id="historyStatus"

                        name="status">



                        <option value="" {{ request('status') == '' ? 'selected' : '' }}>
                            All Status
                        </option>

                        <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>
                            Approved
                        </option>

                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>
                            Rejected
                        </option>

                    </select>

                </div>

                <div class="col-lg-2">

                    <select

                        class="form-select"

                        id="historyPayment"

                        name="payment">

                        <option value="" {{ request('payment') == '' ? 'selected' : '' }}>
                            All Payment
                        </option>

                        <option value="cash" {{ request('payment') == 'cash' ? 'selected' : '' }}>
                            Cash
                        </option>

                        <option value="transfer" {{ request('payment') == 'transfer' ? 'selected' : '' }}>
                            Transfer
                        </option>

                    </select>

                </div>

                <div class="col-lg-3">

                    <input

                    type="date"

                    class="form-control"

                    id="historyDate"

                    name="date"

                    value="{{ request('date', $selectedDate) }}">

                </div>

                <div class="col-lg-2 d-grid">

                    <button

                        type="submit"

                        class="btn btn-warning text-white">

                        <i class="bi bi-funnel-fill me-2"></i>

                        Filter

                    </button>

                </div>

            </div>

        </div>
        </form>

    </div>

    {{-- ============================= --}}
    {{-- LIST HEADER --}}
    {{-- ============================= --}}

    <div class="history-table-header d-none d-lg-grid">

        <div>Customer</div>

        <div>Date</div>

        <div>Time</div>

        <div>Payment</div>

        <div>Total</div>

        <div>Status</div>

        <div class="text-end">Action</div>

    </div>

    <div id="historyList">

       @forelse($bookings as $booking)

<div

    class="history-item"

    data-name="{{ strtolower($booking->customer_name.' '.$booking->club_name.' '.$booking->phone) }}"

    data-status="{{ strtolower($booking->status) }}"

    data-payment="{{ strtolower($booking->payment_method) }}"

    data-date="{{ optional($booking->booking_date)->format('Y-m-d') }}">

    @php

        $hours = \Carbon\Carbon::parse($booking->end_time)

            ->diffInHours(

                \Carbon\Carbon::parse($booking->start_time)

            );

    @endphp

    <div class="history-col customer">

        <div class="history-name">

            {{ $booking->customer_name }}

        </div>

        <div class="history-sub">

            {{ $booking->club_name ?: 'Personal Booking' }}

        </div>

        <span class="history-badge">

            {{ strtoupper($booking->club_name ? 'CLUB' : 'PERSONAL') }}

        </span>

    </div>

    <div class="history-col">

        <div class="history-value">

            {{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}

        </div>

        <small>

            {{ \Carbon\Carbon::parse($booking->booking_date)->translatedFormat('l') }}

        </small>

    </div>

    <div class="history-col">

        <div class="history-value">

            {{ substr($booking->start_time,0,5) }}

            -

            {{ substr($booking->end_time,0,5) }}

        </div>

        <small>

            {{ $hours }}

            {{ $hours>1?'Hours':'Hour' }}

        </small>

    </div>

    <div class="history-col">

        <div class="history-value">

            {{ strtoupper($booking->payment_method) }}

        </div>

        <small>

            {{ ucfirst($booking->payment_status) }}

        </small>
        @if(
            $booking->status === 'approved' &&
            $booking->payment_method === 'cash' &&
            $booking->payment_status === 'unpaid'
        )
            <form
                action="{{ route('admin.courts.confirmPayment', $booking) }}"
                method="POST"
                class="mt-2"
            >
                @csrf
                @method('PATCH')

                <button
                    type="submit"
                    class="btn btn-primary btn-sm"
                >
                    <i class="bi bi-cash-stack me-1"></i>
                    Confirm Payment
                </button>
            </form>
        @endif

    </div>

    <div class="history-col">

        <div class="history-value">

            Rp {{ number_format($booking->total_price,0,',','.') }}

        </div>

    </div>

    <div class="history-col">

        @if($booking->status=='approved')

            <span class="badge bg-success-subtle text-success">

                Approved

            </span>

        @elseif($booking->status=='pending')

            <span class="badge bg-warning-subtle text-warning">

                Pending

            </span>

        @elseif($booking->status=='cancelled')

            <span class="badge bg-secondary-subtle text-secondary">

                Cancelled

            </span>

        @else

            <span class="badge bg-danger-subtle text-danger">

                Rejected

            </span>

        @endif

    </div>

    <div class="history-col action">

        <button

            class="btn btn-sm btn-outline-secondary"

            data-bs-toggle="modal"

            data-bs-target="#historyModal{{ $booking->id }}">

            <i class="bi bi-eye"></i>

            Detail

        </button>
        <a
            href="{{ route('admin.courts.bookings.edit', $booking->id) }}"
            class="btn btn-sm btn-outline-primary">
            <i class="bi bi-pencil"></i>
            Edit
        </a>

    </div>

</div>

@include('admin.courts.components.history_modal')

@empty

<div class="history-empty">

    <i class="bi bi-clock-history display-5"></i>

    <h5 class="mt-3">

        No Booking History

    </h5>

    <p class="text-secondary mb-0">

        Belum ada riwayat booking.

    </p>

</div>

@endforelse

</div>

</div>
@if(session('success'))

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

Swal.fire({

    icon:'success',

    title:'Success',

    text:'{{ session('success') }}',

    timer:1800,

    showConfirmButton:false

});

</script>

@endif

@endsection

<style>

/* ==========================
GENERAL
========================== */

.history-page{

    display:flex;

    flex-direction:column;

    gap:24px;

}

/* ==========================
SUMMARY
========================== */

.summary-card{

    background:#fff;

    border-radius:20px;

    padding:22px;

    display:flex;

    align-items:center;

    gap:18px;

    box-shadow:0 8px 24px rgba(15,23,42,.05);

}

.summary-icon{

    width:58px;

    height:58px;

    border-radius:16px;

    display:flex;

    justify-content:center;

    align-items:center;

    font-size:24px;

}

/* ==========================
TABLE HEADER
========================== */

.history-table-header{

    display:grid;

    grid-template-columns:

    2fr

    1.2fr

    1.4fr

    1fr

    1fr

    .8fr

    .9fr;

    gap:18px;

    padding:0 18px 14px;

    font-size:13px;

    font-weight:700;

    color:#64748B;

}

/* ==========================
LIST
========================== */

#historyList{

    display:flex;

    flex-direction:column;

    gap:12px;

}

/* ==========================
ITEM
========================== */

.history-item{

    display:grid;

    grid-template-columns:

    2fr

    1.2fr

    1.4fr

    1fr

    1fr

    .8fr

    .9fr;

    gap:18px;

    align-items:center;

    background:#fff;

    border:1px solid #E2E8F0;

    border-radius:18px;

    padding:18px;

    transition:.2s;

}

.history-item:hover{

    border-color:#EA580C;

    box-shadow:0 10px 22px rgba(15,23,42,.06);

}

/* ==========================
COLUMN
========================== */

.history-col{

    min-width:0;

}

.history-name{

    font-weight:700;

    font-size:16px;

    color:#0F172A;

}

.history-sub{

    color:#64748B;

    font-size:13px;

    margin-top:2px;

}

.history-value{

    font-weight:600;

    color:#0F172A;

}

.history-col small{

    display:block;

    color:#94A3B8;

    margin-top:2px;

    font-size:12px;

}

.history-badge{

    display:inline-block;

    margin-top:8px;

    padding:3px 10px;

    border-radius:999px;

    background:#EFF6FF;

    color:#2563EB;

    font-size:11px;

    font-weight:700;

}

/* ==========================
ACTION
========================== */

.history-col.action{

    text-align:right;

}

.history-col.action .btn{

    border-radius:999px;

    padding:6px 16px;

}

/* ==========================
EMPTY
========================== */

.history-empty{

    background:#fff;

    border-radius:18px;

    padding:60px;

    text-align:center;

    border:1px solid #E2E8F0;

}

/* ==========================
TABLET
========================== */

@media(max-width:991px){

.history-table-header{

display:none;

}

.history-item{

grid-template-columns:

1fr

1fr;

gap:14px;

}

.history-col.action{

grid-column:1/3;

text-align:right;

}

}

/* ==========================
MOBILE
========================== */

@media(max-width:767px){

.summary-card{

padding:16px;

}

.summary-icon{

width:48px;

height:48px;

font-size:20px;

}

.history-item{

grid-template-columns:

1fr

1fr;

gap:12px;

padding:14px;

}

.history-name{

font-size:15px;

}

.history-sub{

font-size:12px;

}

.history-value{

font-size:14px;

}

.history-col small{

font-size:11px;

}

.history-col.customer{

grid-column:1/3;

}

.history-col.action{

grid-column:2;

justify-self:end;

}

.history-col.action .btn{

padding:5px 12px;

font-size:12px;

}

}

</style>
