@extends('admin.layouts.admin')

@section('title', 'Edit Booking')

@section('content')

<div class="container-fluid">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h3 class="fw-bold mb-1">Edit Booking</h3>
            <p class="text-muted mb-0">
                Kelola informasi booking dan status pembayaran.
            </p>
        </div>

        <a
            href="{{ route('admin.courts.history') }}"
            class="btn btn-outline-secondary"
        >
            <i class="bi bi-arrow-left"></i>
            Kembali
        </a>

    </div>


    {{-- ERROR VALIDATION --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Terjadi kesalahan:</strong>

            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    {{-- BOOKING INFORMATION --}}
    <div class="card border-0 shadow-sm mb-4">

        <div class="card-header bg-white">
            <h5 class="mb-0 fw-bold">
                <i class="bi bi-calendar-check me-2"></i>
                Informasi Booking
            </h5>
        </div>

        <div class="card-body">

            <div class="row">

                {{-- CUSTOMER --}}
                <div class="col-md-6 mb-3">

                    <label class="form-label text-muted">
                        Nama Penyewa
                    </label>

                    <div class="fw-bold">
                        {{ $booking->customer_name }}
                    </div>

                </div>


                {{-- PHONE --}}
                <div class="col-md-6 mb-3">

                    <label class="form-label text-muted">
                        Nomor WhatsApp
                    </label>

                    <div class="fw-bold">
                        {{ $booking->phone ?? '-' }}
                    </div>

                </div>


                {{-- DATE --}}
                <div class="col-md-4 mb-3">

                    <label class="form-label text-muted">
                        Tanggal Booking
                    </label>

                    <div class="fw-bold">
                        {{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}
                    </div>

                </div>


                {{-- START --}}
                <div class="col-md-4 mb-3">

                    <label class="form-label text-muted">
                        Jam Mulai
                    </label>

                    <div class="fw-bold">
                        {{ substr($booking->start_time, 0, 5) }}
                    </div>

                </div>


                {{-- END --}}
                <div class="col-md-4 mb-3">

                    <label class="form-label text-muted">
                        Jam Selesai
                    </label>

                    <div class="fw-bold">
                        {{ substr($booking->end_time, 0, 5) }}
                    </div>

                </div>


                {{-- PURPOSE --}}
                <div class="col-md-6 mb-3">

                    <label class="form-label text-muted">
                        Tujuan Booking
                    </label>

                    <div class="fw-bold">
                        {{ $booking->purpose ?? '-' }}
                    </div>

                </div>


                {{-- TOTAL --}}
                <div class="col-md-6 mb-3">

                    <label class="form-label text-muted">
                        Total Harga
                    </label>

                    <div class="fw-bold text-primary">
                        Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- EDIT PAYMENT --}}
    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white">

            <h5 class="mb-0 fw-bold">
                <i class="bi bi-wallet2 me-2"></i>
                Pembayaran
            </h5>

        </div>


        <div class="card-body">

            <form
                action="{{ route('admin.courts.bookings.update', $booking->id) }}"
                method="POST"
            >

                @csrf
                @method('PUT')


                <div class="row">

                    {{-- PAYMENT METHOD --}}
                    <div class="col-md-6 mb-3">

                        <label class="form-label fw-bold">
                            Metode Pembayaran
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            value="{{ strtoupper($booking->payment_method ?? '-') }}"
                            readonly
                        >

                        <small class="text-muted">
                            Metode pembayaran tidak diubah dari halaman ini.
                        </small>

                    </div>


                    {{-- PAYMENT STATUS --}}
                    <div class="col-md-6 mb-3">

                        <label class="form-label fw-bold">
                            Status Pembayaran
                        </label>

                        <select
                            name="payment_status"
                            class="form-select"
                            required
                        >

                            <option
                                value="unpaid"
                                {{ old('payment_status', $booking->payment_status) === 'unpaid' ? 'selected' : '' }}
                            >
                                Unpaid
                            </option>

                            <option
                                value="paid"
                                {{ old('payment_status', $booking->payment_status) === 'paid' ? 'selected' : '' }}
                            >
                                Paid
                            </option>

                        </select>

                        <small class="text-muted">
                            Untuk booking Cash, ubah menjadi Paid setelah pembayaran diterima.
                        </small>

                    </div>

                </div>


                {{-- INFO --}}
                <div class="alert alert-info">

                    <i class="bi bi-info-circle me-2"></i>

                    <strong>Catatan:</strong>

                    Booking Cash yang baru dibuat tetap berstatus
                    <strong>Unpaid</strong> sampai pembayaran benar-benar diterima
                    oleh Admin.

                </div>


                {{-- ACTION --}}
                <div class="d-flex justify-content-end gap-2">

                    <a
                        href="{{ route('admin.courts.history') }}"
                        class="btn btn-outline-secondary"
                    >
                        Batal
                    </a>

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        <i class="bi bi-save me-1"></i>
                        Simpan Perubahan
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection
