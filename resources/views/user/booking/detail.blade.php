@extends('user.layouts.user')

@section('title','Detail Booking')

@section('content')

<div class="container-fluid py-4">

    <div class="row mb-4">

        <div class="col-12">

            <div class="card border-0 shadow-sm">

                <div class="card-body d-flex justify-content-between align-items-center">

                    <div>

                        <h3 class="fw-bold mb-1">

                            Detail Booking

                        </h3>

                        <p class="text-muted mb-0">

                            Informasi lengkap reservasi lapangan.

                        </p>

                    </div>

                    <a
                        href="{{ route('user.booking.history') }}"
                        class="btn btn-outline-secondary">

                        <i class="bi bi-arrow-left me-2"></i>

                        Kembali

                    </a>

                </div>

            </div>

        </div>

    </div>

    <div class="row">

        <div class="col-lg-8">

            <div class="card border-0 shadow-sm mb-4">

                <div class="card-header bg-white">

                    <h5 class="mb-0 fw-bold">

                        Informasi Booking

                    </h5>

                </div>

                <div class="card-body">

                    <div class="row g-4">

                        <div class="col-md-6">

                            <small class="text-muted">

                                Tanggal

                            </small>

                            <div class="fw-semibold">

                                {{ \Carbon\Carbon::parse($booking->booking_date)->translatedFormat('l, d F Y') }}

                            </div>

                        </div>

                        <div class="col-md-6">

                            <small class="text-muted">

                                Jam Bermain

                            </small>

                            <div class="fw-semibold">

                                {{ substr($booking->start_time,0,5) }}

                                -

                                {{ substr($booking->end_time,0,5) }}

                            </div>

                        </div>

                        <div class="col-md-6">

                            <small class="text-muted">

                                Nama Penyewa

                            </small>

                            <div class="fw-semibold">

                                {{ $booking->customer_name }}

                            </div>

                        </div>

                        <div class="col-md-6">

                            <small class="text-muted">

                                Nomor WhatsApp

                            </small>

                            <div class="fw-semibold">

                                {{ $booking->phone }}

                            </div>

                        </div>

                        @if($booking->club_name)

                        <div class="col-md-6">

                            <small class="text-muted">

                                Club

                            </small>

                            <div class="fw-semibold">

                                {{ $booking->club_name }}

                            </div>

                        </div>

                        @endif

                        <div class="col-md-6">

                            <small class="text-muted">

                                Tujuan

                            </small>

                            <div class="fw-semibold">

                                {{ $booking->purpose }}

                            </div>

                        </div>

                        <div class="col-12">

                            <small class="text-muted">

                                Catatan

                            </small>

                            <div class="fw-semibold">

                                {{ $booking->notes ?: '-' }}

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-lg-4">

            <div class="card border-0 shadow-sm mb-4">

                <div class="card-header bg-white">

                    <h5 class="mb-0 fw-bold">

                        Status Booking

                    </h5>

                </div>

                <div class="card-body">

                    <div class="mb-3">

                        <small class="text-muted">

                            Status Booking

                        </small>

                        <div>

                            @switch($booking->status)

                                @case('Pending')
                                    <span class="badge bg-warning fs-6">Pending</span>
                                @break

                                @case('Approved')
                                    <span class="badge bg-success fs-6">Approved</span>
                                @break

                                @case('Rejected')
                                    <span class="badge bg-danger fs-6">Rejected</span>
                                @break

                                @default
                                    <span class="badge bg-secondary fs-6">
                                        {{ $booking->status }}
                                    </span>
                            @endswitch

                        </div>

                    </div>

                    <div class="mb-3">

                        <small class="text-muted">

                            Metode Pembayaran

                        </small>

                        <div class="fw-semibold text-capitalize">

                            {{ $booking->payment_method }}

                        </div>

                    </div>

                    <div class="mb-3">

                        <small class="text-muted">

                            Status Pembayaran

                        </small>

                        <div class="fw-semibold">

                            {{ ucfirst($booking->payment_status) }}

                        </div>

                    </div>

                    <div>

                        <small class="text-muted">

                            Total Pembayaran

                        </small>

                        <div class="fw-bold fs-4 text-warning">

                            Rp {{ number_format($booking->total_price,0,',','.') }}

                        </div>

                    </div>

                </div>

            </div>

            @if($booking->payment_proof)

            <div class="card border-0 shadow-sm mb-4">

                <div class="card-header bg-white">

                    <h5 class="mb-0 fw-bold">

                        Bukti Transfer

                    </h5>

                </div>

                <div class="card-body text-center">

                    <img
                        src="{{ asset('storage/'.$booking->payment_proof) }}"
                        class="img-fluid rounded">

                </div>

            </div>

            @endif

            @if($booking->reject_reason)

            <div class="card border-0 border-danger">

                <div class="card-header bg-danger text-white">

                    Alasan Penolakan

                </div>

                <div class="card-body">

                    {{ $booking->reject_reason }}

                </div>

            </div>

            @endif

        </div>

    </div>

</div>

@endsection
