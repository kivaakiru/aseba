@extends('admin.layouts.admin')

@section('title', 'Approval Booking')

@section('page-title', 'Approval Booking')

@section('page-subtitle', 'Kelola seluruh booking dari user yang menunggu persetujuan.')

@section('content')

<div class="approval-page">

    {{-- ========================================= --}}
    {{-- SUMMARY --}}
    {{-- ========================================= --}}

    <div class="row g-4 mb-4">

        <div class="col-xl-3 col-md-6">

            <div class="card approval-summary-card pending">

                <div class="card-body">

                    <div class="summary-icon">

                        <i class="bi bi-hourglass-split"></i>

                    </div>

                    <div class="summary-content">

                        <div class="summary-title">

                            Pending Booking

                        </div>

                        <h2>

                            {{ $pendingCount }}

                        </h2>

                        <small>

                            Waiting Approval

                        </small>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-xl-3 col-md-6">

            <div class="card approval-summary-card approved">

                <div class="card-body">

                    <div class="summary-icon">

                        <i class="bi bi-check-circle-fill"></i>

                    </div>

                    <div class="summary-content">

                        <div class="summary-title">

                            Approved Today

                        </div>

                        <h2 id="approvedCount">

                            {{ $approvedToday }}

                        </h2>

                        <small>

                            Successfully Approved

                        </small>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-xl-3 col-md-6">

            <div class="card approval-summary-card rejected">

                <div class="card-body">

                    <div class="summary-icon">

                        <i class="bi bi-x-circle-fill"></i>

                    </div>

                    <div class="summary-content">

                        <div class="summary-title">

                            Rejected Today

                        </div>

                        <h2 id="rejectedCount">

                            {{ $rejectedToday }}

                        </h2>

                        <small>

                            Booking Rejected

                        </small>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-xl-3 col-md-6">

            <div class="card approval-summary-card income">

                <div class="card-body">

                    <div class="summary-icon">

                        <i class="bi bi-cash-stack"></i>

                    </div>

                    <div class="summary-content">

                        <div class="summary-title">

                            Waiting Payment

                        </div>

                        <h2>

                            {{ $waitingPayment }}

                        </h2>

                        <small>

                            Transfer Verification

                        </small>

                    </div>

                </div>

            </div>

        </div>

    </div>

    {{-- ========================================= --}}
    {{-- FILTER --}}
    {{-- ========================================= --}}

    <div class="card approval-filter-card shadow-sm mb-4">

        <div class="card-body">

            <div class="row g-3">

                <div class="col-lg-4">

                    <label class="form-label">

                        Search

                    </label>

                    <input
                        type="text"
                        id="approvalSearch"
                        class="form-control"
                        placeholder="Customer / Club / Phone">

                </div>

                <div class="col-lg-2">

                    <label class="form-label">

                        Status

                    </label>

                    <select
                        id="approvalStatus"
                        class="form-select">

                        <option value="">

                            All Status

                        </option>

                        <option value="pending">

                            Pending

                        </option>

                        <option value="approved">

                            Approved

                        </option>

                        <option value="rejected">

                            Rejected

                        </option>

                    </select>

                </div>

                <div class="col-lg-2">

                    <label class="form-label">

                        Payment

                    </label>

                    <select
                        id="approvalPayment"
                        class="form-select">

                        <option value="">

                            All

                        </option>

                        <option value="transfer">

                            Transfer

                        </option>

                        <option value="cash">

                            Cash

                        </option>

                    </select>

                </div>

                <div class="col-lg-2">

                    <label class="form-label">

                        Booking Date

                    </label>

                    <input
                        type="date"
                        id="approvalDate"
                        class="form-control">

                </div>

                <div class="col-lg-2 d-grid">

                    <label class="form-label invisible">

                        Filter

                    </label>

                    <button
                        type="button"
                        id="btnApprovalFilter"
                        class="btn btn-warning text-white">

                        <i class="bi bi-funnel-fill me-2"></i>

                        Filter

                    </button>

                </div>

            </div>

        </div>

    </div>

    {{-- ========================================= --}}
    {{-- APPROVAL LIST --}}
    {{-- ========================================= --}}

    <div
    id="approvalList"
    class="approval-list">

    @forelse($bookings as $booking)

        <div
            class="approval-card"

            data-name="{{ strtolower($booking->customer_name) }} {{ strtolower($booking->club_name) }}"

            data-payment="{{ strtolower($booking->payment_method) }}"

            data-status="{{ strtolower($booking->status) }}"

            data-date="{{ optional($booking->booking_date)->format('Y-m-d') }}">

            <div class="approval-card-body">

                <div class="approval-header">

                    <div>

                        <div class="customer-name">

                            {{ $booking->customer_name }}

                        </div>

                        <div class="d-flex align-items-center gap-2 mt-2">

                            @if($booking->club_name)

                                <span class="badge bg-primary-subtle text-primary">

                                    <i class="bi bi-people-fill me-1"></i>

                                    CLUB

                                </span>

                                <div class="customer-club mb-0">

                                    {{ $booking->club_name }}

                                </div>

                            @else

                                <span class="badge bg-secondary-subtle text-secondary">

                                    <i class="bi bi-person-fill me-1"></i>

                                    PERSONAL

                                </span>

                            @endif

                        </div>

                    </div>

                    @if($booking->status == 'pending')

                        <span class="approval-status status-pending">

                            Pending Approval

                        </span>

                    @elseif(
                        $booking->status == 'approved'
                        && $booking->payment_method == 'cash'
                        && $booking->payment_status == 'unpaid'
                    )

                        <span class="approval-status status-waiting">

                            Waiting Payment

                        </span>

                    @elseif($booking->status == 'approved')

                        <span class="approval-status status-approved">

                            Approved

                        </span>

                    @elseif($booking->status == 'rejected')

                        <span class="approval-status status-rejected">

                            Rejected

                        </span>

                    @elseif($booking->status == 'cancelled')

                        <span class="approval-status status-cancelled">

                            Cancelled

                        </span>

                    @endif

                </div>

                <div class="approval-detail">

                    <div class="detail-box">

                        <div class="detail-title">

                            Booking Date

                        </div>

                        <div class="detail-value">

                            {{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}

                            <br>

                            <small class="text-secondary">

                                {{ \Carbon\Carbon::parse($booking->booking_date)->translatedFormat('l') }}

                            </small>

                        </div>

                    </div>

                    <div class="detail-box">

                        <div class="detail-title">

                            Time

                        </div>

                        <div class="detail-value">

                            {{ substr($booking->start_time,0,5) }}

                            -

                            {{ substr($booking->end_time,0,5) }}

                            <br>

                            @php

                                $hours =
                                    \Carbon\Carbon::parse($booking->end_time)
                                    ->diffInHours(
                                        \Carbon\Carbon::parse($booking->start_time)
                                    );

                            @endphp

                            <small class="text-secondary">

                                ({{ $hours }}

                                {{ $hours > 1 ? 'Hours' : 'Hour' }})

                            </small>

                        </div>

                    </div>

                    <div class="detail-box">

                        <div class="detail-title">

                            Payment

                        </div>

                        <div class="detail-value">

                            {{ strtoupper($booking->payment_method) }}

                            <br>

                            @if($booking->payment_status=='paid')

                                <span class="badge bg-success">

                                    Paid

                                </span>

                            @elseif($booking->payment_method=='transfer')

                                <span class="badge bg-warning text-dark">

                                    Waiting Verification

                                </span>

                            @else

                                <span class="badge bg-secondary">

                                    Unpaid

                                </span>

                            @endif

                        </div>

                    </div>

                    <div class="detail-box">

                        <div class="detail-title">

                            Total

                        </div>

                        <div class="detail-box">

                            <div class="detail-title">

                                Booking Source

                            </div>

                            <div class="detail-value">

                                {{ ucfirst($booking->booking_source) }}

                            </div>

                        </div>

                        <div class="detail-value">

                            Rp {{ number_format($booking->total_price,0,',','.') }}

                        </div>

                    </div>

                </div>

                @if($booking->purpose)

                    <div class="approval-note">

                        <strong>

                            Purpose

                        </strong>

                        <br>

                        {{ $booking->purpose }}

                    </div>

                @endif

                @if($booking->notes)

                    <div class="approval-note mt-3">

                        <strong>

                            Notes

                        </strong>

                        <br>

                        {{ $booking->notes }}

                    </div>

                @endif

                <div class="approval-action">

                    <button
                        class="btn btn-outline-secondary"

                        data-bs-toggle="modal"

                        data-bs-target="#detailModal{{ $booking->id }}">

                        <i class="bi bi-eye me-2"></i>

                        Detail

                    </button>

                    @if($booking->status == 'pending')

                    <button
                        type="button"
                        class="btn btn-outline-danger"
                        data-bs-toggle="modal"
                        data-bs-target="#rejectModal{{ $booking->id }}">

                        <i class="bi bi-x-circle me-2"></i>

                        Reject

                    </button>

                    <form
                        class="approve-form"
                        action="{{ route('admin.courts.approve',$booking) }}"
                        method="POST">

                        @csrf
                        @method('PATCH')

                        <button
                            class="btn btn-success">

                            <i class="bi bi-check-circle me-2"></i>

                            Approve

                        </button>

                    </form>

                    @endif

                    @if(
                        $booking->status == 'approved'
                        && $booking->payment_method == 'cash'
                        && $booking->payment_status == 'unpaid'
                    )

                    <form
                        action="{{ route('admin.courts.confirmPayment',$booking) }}"
                        method="POST">

                        @csrf
                        @method('PATCH')

                        <button
                            class="btn btn-primary">

                            <i class="bi bi-cash-stack me-2"></i>

                            Confirm Payment

                        </button>

                    </form>

                    @endif


                </div>

            </div>

        </div>

    <div
        class="modal fade"
        id="detailModal{{ $booking->id }}"
        tabindex="-1">

        <div class="modal-dialog modal-lg modal-dialog-centered">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title">

                        Booking Detail

                    </h5>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">
                    </button>

                </div>

                <div class="modal-body">

                    <div class="row g-3">

                        <div class="col-md-6">

                            <strong>Customer</strong>

                            <p>{{ $booking->customer_name }}</p>

                        </div>

                        <div class="col-md-6">

                            <strong>Club</strong>

                            <p>{{ $booking->club_name ?: '-' }}</p>

                        </div>

                        <div class="col-md-6">

                            <strong>Phone</strong>

                            <p>{{ $booking->phone }}</p>

                        </div>

                        <div class="col-md-6">

                            <strong>Date</strong>

                            <p>{{ optional($booking->booking_date)->format('d F Y') }}</p>

                        </div>

                        <div class="col-md-6">

                            <strong>Time</strong>

                            <p>

                                {{ substr($booking->start_time,0,5) }}

                                -

                                {{ substr($booking->end_time,0,5) }}

                            </p>

                        </div>

                        <div class="col-md-6">

                            <strong>Total</strong>

                            <p>

                                Rp {{ number_format($booking->total_price,0,',','.') }}

                            </p>

                        </div>

                        <div class="col-12">

                            <strong>Purpose</strong>

                            <p>{{ $booking->purpose ?: '-' }}</p>

                        </div>

                        <div class="col-12">

                            <strong>Notes</strong>

                            <p>{{ $booking->notes ?: '-' }}</p>

                            @if($booking->reject_reason)

                            <hr>

                            <strong class="text-danger">

                            Reject Reason

                            </strong>

                            <p class="mb-0 text-danger">

                            {{ $booking->reject_reason }}

                            </p>

                            @endif
                            @if($booking->payment_method == 'transfer')

                                <hr>

                                <div class="col-12">

                                    <strong>Bukti Transfer</strong>

                                    @if($booking->payment_proof)

                                        <div class="mt-3 text-center">

                                            <img
                                                src="{{ asset('storage/'.$booking->payment_proof) }}"
                                                class="img-fluid rounded border shadow-sm"
                                                style="max-height:450px;">

                                        </div>

                                        <div class="text-center mt-3">

                                            <a
                                                href="{{ asset('storage/'.$booking->payment_proof) }}"
                                                target="_blank"
                                                class="btn btn-outline-primary">

                                                <i class="bi bi-arrows-fullscreen me-2"></i>

                                                Lihat Ukuran Asli

                                            </a>

                                        </div>

                                    @else

                                        <div class="alert alert-warning mt-3 mb-0">

                                            User belum mengupload bukti transfer.

                                        </div>

                                    @endif

                                </div>

                            @endif

                        </div>

                    </div>

                </div>

            </div>

        </div>

</div>

<div
    class="modal fade"
    id="rejectModal{{ $booking->id }}"
    tabindex="-1">

    <div class="modal-dialog">

        <div class="modal-content rounded-4 border-0">

            <form
                action="{{ route('admin.courts.reject',$booking) }}"
                method="POST">

                @csrf

                @method('PATCH')

                <div class="modal-header">

                    <h5 class="modal-title">

                        Reject Booking

                    </h5>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">
                    </button>

                </div>

                <div class="modal-body">

                    <label class="form-label">

                        Reject Reason

                    </label>

                    <textarea
                        name="reject_reason"
                        rows="5"
                        class="form-control"
                        placeholder="Masukkan alasan penolakan..."
                        required></textarea>

                </div>

                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-light"
                        data-bs-dismiss="modal">

                        Cancel

                    </button>

                    <button
                        class="btn btn-danger">

                        Reject Booking

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@empty

        <div class="card border-0 shadow-sm">

            <div class="card-body text-center py-5">

                <i class="bi bi-check2-circle display-3 text-success"></i>

                <h4 class="mt-4">

                    No Pending Booking

                </h4>

                <p class="text-secondary mb-0">

                    There are currently no booking requests awaiting approval.

                </p>

            </div>

        </div>

    @endforelse

</div>







<style>

.approval-page{

    display:flex;

    flex-direction:column;

    gap:24px;

}

/* ======================================
SUMMARY
====================================== */

.approval-summary-card{

    border:none;

    border-radius:22px;

    overflow:hidden;

    transition:.25s;

}

.approval-summary-card:hover{

    transform:translateY(-3px);

    box-shadow:0 14px 30px rgba(0,0,0,.08);

}

.approval-summary-card .card-body{

    display:flex;

    align-items:center;

    gap:18px;

    padding:24px;

}

.summary-icon{

    width:64px;

    height:64px;

    border-radius:18px;

    display:flex;

    justify-content:center;

    align-items:center;

    font-size:28px;

}

.summary-content h2{

    margin:2px 0;

    font-size:34px;

    font-weight:800;

}

.summary-title{

    font-weight:700;

    color:#475569;

}

.pending .summary-icon{

    background:#FEF3C7;

    color:#D97706;

}

.approved .summary-icon{

    background:#DCFCE7;

    color:#16A34A;

}

.rejected .summary-icon{

    background:#FEE2E2;

    color:#DC2626;

}

.income .summary-icon{

    background:#DBEAFE;

    color:#2563EB;

}

/* ======================================
FILTER
====================================== */

.approval-filter-card{

    border:none;

    border-radius:22px;

}

.approval-filter-card .card-body{

    padding:24px;

}

/* ======================================
APPROVAL LIST
====================================== */

.approval-list{

    display:flex;

    flex-direction:column;

    gap:18px;

}

/* ======================================
APPROVAL CARD
====================================== */

.approval-card{

    border:1px solid #E2E8F0;

    border-radius:22px;

    background:#FFF;

    transition:.25s;

    overflow:hidden;

}

.approval-card:hover{

    border-color:#EA580C;

    box-shadow:0 12px 26px rgba(0,0,0,.07);

}

.approval-card-body{

    padding:24px;

}

.approval-header{

    display:flex;

    justify-content:space-between;

    align-items:flex-start;

    gap:18px;

    margin-bottom:18px;

}

.customer-name{

    font-size:22px;

    font-weight:800;

    color:#0F172A;

}

.customer-club{

    color:#64748B;

    margin-top:3px;

}

.approval-status{

    font-size:13px;

    padding:8px 14px;

    border-radius:999px;

    font-weight:700;

}

.status-pending{

    background:#FEF3C7;

    color:#92400E;

}

.status-approved{

    background:#DCFCE7;

    color:#166534;

}



.status-waiting{

    background:#DBEAFE;

    color:#1D4ED8;

}

.status-cancelled{

    background:#E5E7EB;

    color:#374151;

}

/* ======================================
DETAIL GRID
====================================== */

.approval-detail{

    display:grid;

    grid-template-columns:repeat(4,1fr);

    gap:18px;

    margin-top:10px;

}

.detail-box{

    background:#F8FAFC;

    border-radius:16px;

    padding:16px;

}

.detail-title{

    font-size:12px;

    color:#94A3B8;

    margin-bottom:6px;

}

.detail-value{

    font-weight:700;

    color:#0F172A;

}

/* ======================================
NOTE
====================================== */

.approval-note{

    margin-top:18px;

    border-left:4px solid #EA580C;

    background:#FFF7ED;

    padding:14px 18px;

    border-radius:12px;

    color:#475569;

}

/* ======================================
ACTION
====================================== */

.approval-action{

    display:flex;

    justify-content:flex-end;

    gap:12px;

    margin-top:22px;

}

.approval-action .btn{

    min-width:130px;

    border-radius:12px;

    font-weight:600;

}

/* ======================================
RESPONSIVE
====================================== */

@media(max-width:991px){

.approval-detail{

grid-template-columns:1fr 1fr;

}

}

@media(max-width:767px){

.approval-summary-card .card-body{

padding:18px;

}

.summary-icon{

width:56px;

height:56px;

font-size:24px;

}

.summary-content h2{

font-size:28px;

}

.approval-header{

flex-direction:column;

}

.approval-detail{

grid-template-columns:1fr;

}

.approval-action{

flex-direction:column;

}

.approval-action .btn{

width:100%;

}

}

</style>

<script>

function filterApproval(){

    const keyword =
        document
        .getElementById('approvalSearch')
        .value
        .toLowerCase()
        .trim();

    const status =
        document
        .getElementById('approvalStatus')
        .value;

    const payment =
        document
        .getElementById('approvalPayment')
        .value;

    const date =
        document
        .getElementById('approvalDate')
        .value;

    document
    .querySelectorAll('.approval-card')
    .forEach(function(card){

        let show = true;

        if(
            keyword &&
            !card.dataset.name.includes(keyword)
        ){

            show = false;

        }

        if(
            status &&
            card.dataset.status !== status
        ){

            show = false;

        }

        if(
            payment &&
            card.dataset.payment !== payment
        ){

            show = false;

        }

        if(
            date &&
            card.dataset.date !== date
        ){

            show = false;

        }

        card.style.display =
            show
            ? ''
            : 'none';

    });

}

document
.getElementById('btnApprovalFilter')
.addEventListener(
'click',
filterApproval
);

document
.getElementById('approvalSearch')
.addEventListener(
'keyup',
filterApproval
);

document
.getElementById('approvalStatus')
.addEventListener(
'change',
filterApproval
);

document
.getElementById('approvalPayment')
.addEventListener(
'change',
filterApproval
);

document
.getElementById('approvalDate')
.addEventListener(
'change',
filterApproval
);

</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>



</script>

@if(session('success'))

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

