@extends('user.layouts.user')

@section('title','Riwayat Booking')

@section('content')

<div class="container-fluid py-4">

    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show mb-4">

            <i class="bi bi-check-circle-fill me-2"></i>

            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert">
            </button>

        </div>

    @endif

    <div class="card border-0 shadow-sm rounded-4 mb-4">

        <div class="card-body py-4 px-4">

            <div class="d-flex justify-content-between align-items-center flex-wrap">

                <div>

                    <h2 class="fw-bold mb-1">

                        Riwayat Booking

                    </h2>

                    <p class="text-muted mb-0">

                        Seluruh histori reservasi lapangan Anda.

                    </p>

                </div>

            </div>

        </div>

    </div>

    <div class="card border-0 shadow-sm rounded-4">

        <div class="card-body">

            <div class="row g-3 mb-4">

                <div class="col-lg-8">

                    <div class="position-relative">

                        <i
                            class="bi bi-search position-absolute"
                            style="
                                left:16px;
                                top:50%;
                                transform:translateY(-50%);
                                color:#94a3b8;
                                z-index:5;
                            ">
                        </i>

                        <input
                            type="text"
                            id="searchBooking"
                            class="form-control rounded-3 ps-5"
                            placeholder="Cari booking...">

                    </div>

                </div>

                <div class="col-lg-4">

                    <select
                        id="statusFilter"
                        class="form-select rounded-3">

                        <option value="">

                            Semua Status

                        </option>

                        <option value="approved">

                            Approved

                        </option>

                        <option value="pending">

                            Pending

                        </option>

                        <option value="rejected">

                            Rejected

                        </option>

                        <option value="cancelled">

                            Cancelled

                        </option>

                    </select>

                </div>

            </div>

            {{-- ===========================
                 DESKTOP TABLE
            ============================ --}}

            <div class="table-responsive d-none d-lg-block">

                <table
                    class="table align-middle mb-0"
                    id="bookingTable">

                    <thead
                        class="table-light">

                        <tr>

                            <th width="18%">

                                Tanggal

                            </th>

                            <th width="13%">

                                Jam

                            </th>

                            <th>

                                Tujuan

                            </th>

                            <th width="12%">

                                Status

                            </th>

                            <th width="12%">

                                Bayar

                            </th>

                            <th width="12%">

                                Harga

                            </th>

                            <th width="8%"
                                class="text-center">

                                Aksi

                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($bookings as $booking)

                            <tr
                                class="history-item"
                                data-search="{{ strtolower($booking->booking_date.' '.$booking->purpose.' '.$booking->payment_method.' '.$booking->status) }}"
                                data-status="{{ strtolower($booking->status) }}">

                                <td>

                                    <div class="fw-semibold">

                                        {{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}

                                    </div>

                                    <small class="text-muted">

                                        {{ \Carbon\Carbon::parse($booking->booking_date)->translatedFormat('l') }}

                                    </small>

                                </td>

                                <td>

                                    {{ substr($booking->start_time,0,5) }}

                                    -

                                    {{ substr($booking->end_time,0,5) }}

                                </td>

                                <td>

                                    {{ $booking->purpose }}

                                </td>
                                 <td>

                                    @switch($booking->status)

                                        @case('approved')

                                            <span class="badge status-badge status-approved"
                                            style="background:#16A34A!important;color:#fff!important;">

                                                Approved

                                            </span>

                                        @break

                                        @case('pending')

                                            <span class="badge status-badge status-pending"
                                            style="background:#F59E0B!important;color:#fff!important;">

                                                Pending

                                            </span>

                                        @break

                                        @case('rejected')

                                            <span class="badge status-badge status-rejected"
                                            style="background:#EF4444!important;color:#fff!important;">

                                                Rejected

                                            </span>

                                        @break

                                        @case('cancelled')

                                            <span class="badge status-badge status-cancelled"
                                            style="background:#64748B!important;color:#fff!important;">

                                                Cancelled

                                            </span>

                                        @break

                                        @default

                                            <span class="badge status-badge status-default"
                                            style="background:#1F2937!important;color:#fff!important;">

                                                {{ $booking->status }}

                                            </span>

                                    @endswitch

                                </td>

                                <td>

                                    {{ ucfirst($booking->payment_method) }}

                                </td>

                                <td class="fw-bold">

                                    Rp {{ number_format($booking->total_price,0,',','.') }}

                                </td>

                                <td class="text-center">

                                    <a
                                        href="{{ route('user.booking.detail',$booking->id) }}"
                                        class="btn btn-sm btn-outline-primary">

                                        <i class="bi bi-eye"></i>

                                    </a>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="7"
                                    class="text-center py-5">

                                    <i class="bi bi-calendar-x fs-1 text-muted"></i>

                                    <div class="mt-3">

                                        Belum ada riwayat booking.

                                    </div>

                                    <a
                                        href="{{ route('user.booking.index') }}"
                                        class="btn btn-warning mt-3">

                                        Booking Sekarang

                                    </a>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            {{-- ===========================================
                 MOBILE LIST
            ============================================ --}}

            <div class="d-lg-none">

                @forelse($bookings as $booking)

                    <div
                        class="history-item border-bottom py-3"

                        data-search="{{ strtolower($booking->booking_date.' '.$booking->purpose.' '.$booking->payment_method.' '.$booking->status) }}"

                        data-status="{{ strtolower($booking->status) }}">

                        <div class="d-flex justify-content-between">

                            <div class="fw-semibold">

                                {{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}

                            </div>

                            <div>

                                @switch(strtolower($booking->status))
                                    @case('approved')

                                        <span class="status-badge status-approved">

                                            Approved

                                        </span>

                                    @break

                                    @case('pending')

                                        <span class="status-badge status-pending">

                                            Pending

                                        </span>

                                    @break

                                    @case('rejected')

                                        <span class="status-badge status-rejected">

                                            Rejected

                                        </span>

                                    @break

                                    @default

                                        <span class="status-badge status-cancelled">

                                            {{ $booking->status }}

                                        </span>

                                @endswitch

                            </div>

                        </div>

                        <div class="small text-muted mt-1">

                            {{ substr($booking->start_time,0,5) }}

                            -

                            {{ substr($booking->end_time,0,5) }}

                        </div>

                        <div class="mt-2 fw-semibold">

                            {{ $booking->purpose }}

                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-2">

                            <div>

                                <small class="text-muted">

                                    {{ ucfirst($booking->payment_method) }}

                                </small>

                            </div>

                            <div class="fw-bold">

                                Rp {{ number_format($booking->total_price,0,',','.') }}

                            </div>

                            <a
                                href="{{ route('user.booking.detail',$booking->id) }}"
                                class="btn btn-sm btn-outline-primary">

                                Detail

                            </a>

                        </div>

                    </div>

                @empty

                    <div class="text-center py-5">

                        <i class="bi bi-calendar-x fs-1 text-muted"></i>

                        <div class="mt-3">

                            Belum ada riwayat booking.

                        </div>

                    </div>

                @endforelse

            </div>

            <div class="mt-4">

                {{ $bookings->links() }}

            </div>

        </div>

    </div>
</div>

@endsection


@push('scripts')

<script>

document.addEventListener('DOMContentLoaded',function(){

    const search =
        document.getElementById('searchBooking');

    const filter =
        document.getElementById('statusFilter');

    const items =
        document.querySelectorAll('.history-item');

    function applyFilter(){

        const keyword =
            search.value.toLowerCase().trim();

        const status =
            filter.value.toLowerCase();

        items.forEach(function(item){

            const text =
                item.dataset.search;

            const itemStatus =
                item.dataset.status;

            const matchKeyword =
                text.includes(keyword);

            const matchStatus =
                status === '' ||
                itemStatus === status;

            item.style.display =
                (matchKeyword && matchStatus)
                ? ''
                : 'none';

        });

    }

    search.addEventListener(
        'keyup',
        applyFilter
    );

    filter.addEventListener(
        'change',
        applyFilter
    );

});

</script>

@endpush
