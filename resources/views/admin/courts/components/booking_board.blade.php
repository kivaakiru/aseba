<div class="card schedule-card shadow-sm">

    <div class="card-header bg-white border-0 py-4">

        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

            <div>

                <h4 class="fw-bold mb-1">

                    <i class="bi bi-calendar3 me-2 text-warning"></i>

                    Schedule Board

                </h4>

                <div class="text-secondary">

                    Court reservation schedule

                </div>

            </div>

            <div class="d-flex gap-2">

                <button
                    id="refreshBoard"
                    class="btn btn-outline-secondary rounded-3"
                    title="Refresh Schedule">

                    <i class="bi bi-arrow-clockwise me-2"></i>

                    Refresh

                </button>

                <a
                    href="{{ route('admin.courts.bookings.create') }}"
                    class="btn btn-warning text-white rounded-3">

                    <i class="bi bi-plus-circle me-2"></i>

                    Booking Baru

                </a>

            </div>

        </div>

    </div>

    <div class="card-body p-0">

        <div
            class="schedule-wrapper"
            id="scheduleBoard">

            <table
                class="schedule-table"
                id="scheduleTable">

                <thead>

                    <tr>

                        <th class="time-column">

                            Time

                        </th>

                        <th class="calendar-header-cell">

                            <div class="calendar-day fw-bold">

                                Monday

                            </div>

                            <small class="calendar-date">

                                22 Jun

                            </small>

                        </th>

                        <th class="calendar-header-cell">

                            <div class="calendar-day fw-bold">

                                Tuesday

                            </div>

                            <small class="calendar-date">

                                23 Jun

                            </small>

                        </th>

                        <th class="calendar-header-cell">

                            <div class="calendar-day fw-bold">

                                Wednesday

                            </div>

                            <small class="calendar-date">

                                24 Jun

                            </small>

                        </th>

                        <th class="calendar-header-cell">

                            <div class="calendar-day fw-bold">

                                Thursday

                            </div>

                            <small class="calendar-date">

                                25 Jun

                            </small>

                        </th>

                        <th class="calendar-header-cell">

                            <div class="calendar-day fw-bold">

                                Friday

                            </div>

                            <small class="calendar-date">

                                26 Jun

                            </small>

                        </th>

                        <th class="calendar-header-cell">

                            <div class="calendar-day fw-bold">

                                Saturday

                            </div>

                            <small class="calendar-date">

                                27 Jun

                            </small>

                        </th>

                        <th class="calendar-header-cell">

                            <div class="calendar-day fw-bold">

                                Sunday

                            </div>

                            <small class="calendar-date">

                                28 Jun

                            </small>

                        </th>

                    </tr>

                </thead>

                <tbody>

                    @for($hour=8;$hour<=19;$hour++)

                        <tr>

                            <td
                                class="time-column"
                                data-time="{{ sprintf('%02d:00',$hour) }}">

                                {{ sprintf('%02d:00',$hour) }}

                            </td>

                            @for($day=1;$day<=7;$day++)

                                <td
                                    class="slot"
                                    data-day="{{ $day }}"
                                    data-hour="{{ $hour }}">

                                    {{-- MONDAY 08.00 --}}

                                    @if($hour==8 && $day==1)

                                        <div
                                            class="booking-card approved"
                                            data-status="approved">

                                            <div class="booking-card-title">

                                                Fajar

                                            </div>

                                            <div class="booking-card-time">

                                                08:00 - 09:00

                                            </div>

                                            <div class="booking-card-source">

                                                User

                                            </div>

                                        </div>

                                    {{-- MONDAY 09.00 --}}

                                    @elseif($hour==9 && $day==1)

                                        <div
                                            class="booking-card approved"
                                            data-status="approved">

                                            <div class="booking-card-title">

                                                Pelita Club

                                            </div>

                                            <div class="booking-card-time">

                                                09:00 - 10:00

                                            </div>

                                            <div class="booking-card-source">

                                                Admin

                                            </div>

                                        </div>

                                    {{-- THURSDAY TRAINING --}}

                                    @elseif($hour==15 && $day==4)

                                        <div
                                            class="booking-card training"
                                            data-status="training">

                                            <div class="booking-card-title">

                                                ASEBA KU-16

                                            </div>

                                            <div class="booking-card-time">

                                                15:00 - 17:00

                                            </div>

                                            <div class="booking-card-source">

                                                Internal

                                            </div>

                                        </div>

                                    {{-- SATURDAY PENDING --}}

                                    @elseif($hour==18 && $day==6)

                                        <div
                                            class="booking-card pending"
                                            data-status="pending">

                                            <div class="booking-card-title">

                                                Januar

                                            </div>

                                            <div class="booking-card-time">

                                                18:00 - 19:00

                                            </div>

                                            <div class="booking-card-source">

                                                User

                                            </div>

                                        </div>

                                    @else

                                        <button
                                            class="btn btn-light btn-sm booking-empty-slot w-100 h-100 border-0 rounded-0">

                                            <i class="bi bi-plus-lg"></i>

                                        </button>

                                    @endif

                                </td>

                            @endfor

                        </tr>
                                            @endfor

                    @for($hour=20;$hour<=22;$hour++)

                        <tr>

                            <td
                                class="time-column"
                                data-time="{{ sprintf('%02d:00',$hour) }}">

                                {{ sprintf('%02d:00',$hour) }}

                            </td>

                            @for($day=1;$day<=7;$day++)

                                <td
                                    class="slot"
                                    data-day="{{ $day }}"
                                    data-hour="{{ $hour }}">

                                    <button
                                         class="btn btn-light booking-empty-slot border-0 rounded-0 w-100 h-100">

                                        <i class="bi bi-plus-lg"></i>

                                    </button>

                                </td>

                            @endfor

                        </tr>

                    @endfor

                </tbody>

            </table>

        </div>

    </div>

</div>

<style>

.booking-card{

    height:100%;

    min-height:72px;

    border-radius:14px;

    padding:8px 10px;

    display:flex;

    flex-direction:column;

    justify-content:center;

    gap:2px;

    transition:.2s;

    cursor:pointer;

    border-left:4px solid transparent;

}

.booking-card:hover{

    transform:scale(1.02);

    box-shadow:0 6px 18px rgba(0,0,0,.08);

}

.booking-card.approved{

    background:#ECFDF5;

    border-left-color:#16A34A;

}

.booking-card.pending{

    background:#FFFBEB;

    border-left-color:#D97706;

}

.booking-card.practice{
    background:#FEF3C7;
    border-left:4px solid #F59E0B;
}

.booking-card.holiday{
    background:#FEE2E2;
    border-left:4px solid #DC2626;
}

.booking-card.override{
    background:#DBEAFE;
    border-left:4px solid #2563EB;
}



.booking-card-title{

    font-size:13px;

    font-weight:700;

    color:#0F172A;

    overflow:hidden;

    white-space:nowrap;

    text-overflow:ellipsis;

}

.booking-card-time{

    font-size:11px;

    color:#475569;

}

.booking-card-source{

    font-size:11px;

    color:#64748B;

}

.schedule-table thead th{

    text-align:center;

    vertical-align:middle;

}

.schedule-table thead small{

    color:#64748B;

}

.schedule-table tbody tr:hover{

    background:#FFFBEB;

}

.slot{

    padding:4px;

    background:#FFFFFF;

}

.slot>.btn{

    color:#CBD5E1;

    transition:.2s;

}

.slot>.btn:hover{

    background:#FFF7ED;

    color:#EA580C;

}

.time-column{

    font-size:13px;

    font-weight:700;

    color:#334155;

    background:#FFFFFF;

}

@media(max-width:991px){

.schedule-card{

display:none;

}

}

</style>
