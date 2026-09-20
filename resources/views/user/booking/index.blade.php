@extends('user.layouts.user')

@section('title','Booking Lapangan')

@section('content')

<div class="booking-container">

    {{-- HEADER --}}

    <div class="booking-header">

        <h3>

            Booking Lapangan

        </h3>

        <p>

            Pilih jadwal lapangan yang tersedia

        </p>

    </div>

    {{-- WEEK NAVIGATION --}}

    <div class="week-navigation">

        <button

            id="previousWeek"

            class="week-button">

            <i class="bi bi-chevron-left"></i>

        </button>

        <div

            id="weekLabel"

            class="week-label">

            Loading...

        </div>

        <button

            id="nextWeek"

            class="week-button">

            <i class="bi bi-chevron-right"></i>

        </button>

    </div>

    {{-- BOARD --}}

    <div class="board-card">

        <div

            class="schedule-scroll"

            id="scheduleScroll">

            <div

                class="schedule-grid"

                id="scheduleGrid">

                {{-- Corner --}}
                <div class="grid-corner"></div>

                {{-- Header Hari --}}
                @for($day=0;$day<7;$day++)

                    <div

                        class="grid-header"

                        id="header-{{ $day }}"

                        data-day="{{ $day }}">

                        <div

                            class="grid-day"

                            id="dayName{{ $day }}">

                            MON

                        </div>

                        <div

                            class="grid-date"

                            id="dayDate{{ $day }}">

                            01

                        </div>

                    </div>

                @endfor

                {{-- Jam --}}
                @for($hour=8;$hour<=22;$hour++)

                    <div

                        class="grid-time">

                        {{ sprintf('%02d.00',$hour) }}

                    </div>

                    @for($day=0;$day<7;$day++)

                        <div

                            class="grid-cell"

                            id="cell-{{ $day }}-{{ $hour }}"

                            data-day="{{ $day }}"

                            data-hour="{{ $hour }}">

                        </div>

                    @endfor

                @endfor

            </div>

        </div>

    </div>

    <div class="board-footer">

    <div class="board-legend">

        <div class="legend-item">
            <span class="legend-color available"></span>
            Available
        </div>

        <div class="legend-item">
            <span class="legend-color booked"></span>
            Approved
        </div>

        <div class="legend-item">
            <span class="legend-color pending"></span>
            Pending
        </div>

        <div class="legend-item">
            <span class="legend-color practice"></span>
            Practice
        </div>

        <div class="legend-item">
            <span class="legend-color holiday"></span>
            Holiday
        </div>

    </div>

    <a
        href="javascript:void(0)"
        class="new-booking-btn"
        onclick="openBooking()">

        <i class="bi bi-plus-circle"></i>

        New Booking

    </a>

</div>

    {{-- AGENDA --}}

    <div class="agenda-card">

        <div class="agenda-header">

            <div>

                <h5 class="mb-1">

                    Agenda Hari Ini

                </h5>

                <small
                    id="agendaDate"
                    class="text-muted">

                    Loading...

                </small>

            </div>

            <div class="agenda-navigation">

                <button
                    type="button"
                    id="agendaPrev">

                    <i class="bi bi-chevron-left"></i>

                </button>

                <button
                    type="button"
                    id="agendaToday">

                    Today

                </button>

                <button
                    type="button"
                    id="agendaNext">

                    <i class="bi bi-chevron-right"></i>

                </button>

            </div>

        </div>

        <div

            id="agendaList"

            class="agenda-list">

        </div>

    </div>

</div>
@include('user.booking.create')
<style>

.booking-container{

    width:100%;

    max-width:none;

    margin:0;

    padding:0 18px;

}

.booking-header{

    background:#fff;

    border-radius:20px;

    padding:22px;

    margin-bottom:18px;

    box-shadow:0 8px 30px rgba(15,23,42,.05);

}

.booking-header h3{

    font-size:28px;

    font-weight:700;

    color:#0F172A;

    margin-bottom:4px;

}

.booking-header p{

    color:#64748B;

    margin:0;

}

.week-navigation{

    display:flex;

    align-items:center;

    justify-content:space-between;

    margin-bottom:18px;

}

.week-button{

    width:46px;

    height:46px;

    border:none;

    border-radius:14px;

    background:#fff;

    box-shadow:0 4px 18px rgba(15,23,42,.08);

}

.week-label{

    font-size:18px;

    font-weight:700;

    color:#0F172A;

}

.board-card{

    background:#fff;

    border-radius:22px;

    padding:18px;

    width:100%;

    box-shadow:0 8px 30px rgba(15,23,42,.05);

}

.schedule-scroll{

    width:100%;

    height:calc(100vh - 240px);

    min-height:900px;

    overflow-y:auto;

    overflow-x:hidden;

}

.schedule-grid{

    display:grid;

    width:100%;

    min-width:100%;

    grid-template-columns:60px repeat(7,minmax(140px,1fr));

    grid-template-rows:60px repeat(15,54px);

}

.grid-corner{

    position:sticky;

    top:0;

    z-index:5;

    background:#fff;

    border-right:1px solid #F1F5F9;

    border-bottom:1px solid #F1F5F9;

}

.grid-header{

    position:sticky;

    top:0;

    z-index:4;

    background:#fff;

    display:flex;

    flex-direction:column;

    justify-content:center;

    align-items:center;

    gap:4px;

    cursor:pointer;

    border-bottom:1px solid #F1F5F9;

    border-right:1px solid #F8FAFC;

    transition:.2s;

}

.grid-header.active{

    background:#EFF6FF;

}

.grid-day{

    font-size:12px;

    font-weight:700;

    color:#64748B;

    letter-spacing:.4px;

}

.grid-date{

    width:32px;

    height:32px;

    border-radius:50%;

    display:flex;

    align-items:center;

    justify-content:center;

    font-size:16px;

    font-weight:700;

    color:#0F172A;

}

.grid-header.active .grid-date{

    background:#2563EB;

    color:#fff;

}

.grid-time{

    display:flex;

    align-items:center;

    justify-content:center;

    font-size:13px;

    font-weight:700;

    color:#64748B;

    border-right:1px solid #F1F5F9;

    border-bottom:1px solid #F8FAFC;

    background:#fff;

}

.grid-cell{

    border-right:1px solid #F1F5F9;

    border-bottom:1px solid #F1F5F9;

    padding:6px;

    background:#fff;

}

.grid-event{

    width:100%;

    height:100%;

    border-radius:8px;

    transition:.2s;

}

.grid-event:hover{

    transform:scale(.95);

}

.grid-event.booked{

    background:#22C55E;

}

.grid-event.pending{

    background:#F59E0B;

}

.grid-event.practice{

    background:#3B82F6;

}

.grid-event.holiday{

    background:#EF4444;

}

.grid-event.available{

    background:#F8FAFC;

    border:1px solid #E2E8F0;

}
.board-footer{

    margin-top:18px;

    display:flex;

    justify-content:space-between;

    align-items:center;

    gap:20px;

    flex-wrap:wrap;

}

.board-legend{

    display:flex;

    gap:18px;

    flex-wrap:wrap;

}

.legend-item{

    display:flex;

    align-items:center;

    gap:8px;

    font-size:14px;

    font-weight:600;

    color:#475569;

}

.legend-color{

    width:16px;

    height:16px;

    border-radius:6px;

}

.legend-color.available{

    background:#F8FAFC;

    border:1px solid #CBD5E1;

}

.legend-color.booked{

    background:#22C55E;

}

.legend-color.pending{

    background:#F59E0B;

}

.legend-color.practice{

    background:#3B82F6;

}

.legend-color.holiday{

    background:#EF4444;

}

.new-booking-btn{

    background:#EA580C;

    color:#fff;

    padding:10px 18px;

    border-radius:12px;

    text-decoration:none;

    font-weight:700;

    display:flex;

    align-items:center;

    gap:8px;

    transition:.2s;

}

.new-booking-btn:hover{

    background:#C2410C;

    color:#fff;

}
.agenda-card{

    width:100%;

    margin-top:20px;

    background:#fff;

    border-radius:22px;

    padding:22px;

    box-shadow:0 8px 30px rgba(15,23,42,.05);

}
.agenda-header{

    display:flex;

    justify-content:space-between;

    align-items:center;

    gap:18px;

    margin-bottom:18px;

}

.agenda-navigation{

    display:flex;

    align-items:center;

    gap:10px;

}

.agenda-navigation button{

    border:none;

    background:#fff;

    border:1px solid #E2E8F0;

    width:42px;

    height:42px;

    border-radius:12px;

    font-weight:700;

    transition:.2s;

}

.agenda-navigation button:hover{

    background:#F8FAFC;

}

#agendaToday{

    width:auto;

    padding:0 16px;

    color:#EA580C;

    border:1px solid #EA580C;

    background:#FFF7ED;

}

.agenda-title h5{

    font-size:32px;

    font-weight:700;

    color:#0F172A;

    margin:0;

}

.agenda-title small{

    font-size:18px;

    color:#64748B;

}

.agenda-list{

    display:flex;

    flex-direction:column;

    gap:12px;

}

/* =====================================================
AGENDA
===================================================== */

.agenda-item{

    display:flex;

    align-items:center;

    gap:18px;

    padding:18px 22px;

    background:#FFFFFF;

    border:1px solid #EEF2F7;

    border-radius:16px;

    transition:.2s;

    box-shadow:0 2px 8px rgba(15,23,42,.04);

}

.agenda-item:hover{

    transform:translateY(-2px);

    box-shadow:0 8px 20px rgba(15,23,42,.08);

}

.agenda-color{

    width:10px;

    min-width:10px;

    height:62px;

    border-radius:999px;

}

.agenda-color.booked{

    background:#22C55E;

}

.agenda-color.pending{

    background:#F59E0B;

}

.agenda-color.practice{

    background:#3B82F6;

}

.agenda-color.holiday{

    background:#EF4444;

}

.agenda-color.available{

    background:#CBD5E1;

}

.agenda-info{

    flex:1;

    min-width:0;

}

.agenda-name{

    font-size:20px;

    font-weight:700;

    color:#0F172A;

    white-space:nowrap;

    overflow:hidden;

    text-overflow:ellipsis;

}

.agenda-time{

    margin-top:6px;

    font-size:16px;

    font-weight:500;

    color:#64748B;

}

.agenda-badge{

    padding:5px 10px;

    border-radius:999px;

    background:#EFF6FF;

    color:#2563EB;

    font-size:11px;

    font-weight:700;

    text-transform:capitalize;

}

.book-button{

    border:none;

    border-radius:12px;

    background:#EA580C;

    color:#fff;

    font-size:15px;

    font-weight:700;

    padding:12px 22px;

    transition:.2s;

}

.book-button:hover{

    background:#C2410C;

}

@media(max-width:768px){

    .booking-container{

        padding:0 6px;

    }

    .booking-header{

        border-radius:16px;

        padding:16px;

        margin-bottom:14px;

    }

    .booking-header h3{

        font-size:20px;

    }

    .week-button{

        width:40px;

        height:40px;

        border-radius:12px;

    }

    .week-label{

        font-size:15px;

    }

    .board-card{

        border-radius:16px;

        padding:8px;

    }

    .schedule-scroll{

        height:500px;

    }

    .agenda-card{

        border-radius:16px;

        padding:14px;

    }

    .agenda-item{

        padding:12px;

        gap:10px;

    }

    .agenda-name{

        font-size:13px;

    }

    .agenda-time{

        font-size:11px;

    }

    .book-button{

        padding:6px 10px;

        font-size:11px;

    }
    .board-footer{

    flex-direction:column;

    align-items:flex-start;

    }

.board-legend{

    gap:12px;

}

.legend-item{

    font-size:12px;

}

.new-booking-btn{

    width:100%;

    justify-content:center;

}
.agenda-header{

    flex-direction:column;

    align-items:flex-start;

}

.agenda-navigation{

    width:100%;

    justify-content:space-between;

}

.agenda-navigation button{

    flex:1;

}

}

@media(max-width:992px){

    .booking-container{

        max-width:430px;

        margin:auto;

        padding:0 8px;

    }

    .board-card{

        padding:10px;

    }

    .schedule-scroll{

        height:520px;

    }

    .schedule-grid{

        grid-template-columns:48px repeat(7,1fr);

        grid-template-rows:52px repeat(15,46px);

    }

}

    .booking-header{

        padding:18px;

    }

    .booking-header h3{

        font-size:22px;

    }

    .week-label{

        font-size:16px;

    }

    .board-card{

        padding:10px;

        border-radius:18px;

    }

    .schedule-scroll{

        height:520px;

    }

}

/* =====================================================
BOOKING OFFCANVAS
===================================================== */

.booking-offcanvas{

    width:520px !important;

    border-left:none;

    background:#F8FAFC;

}

.booking-offcanvas .offcanvas-header{

    padding:22px 24px;

    border-bottom:1px solid #E2E8F0;

    background:#FFFFFF;

}

.booking-offcanvas .offcanvas-body{

    padding:24px;

}

.booking-offcanvas .form-label{

    font-size:14px;

    font-weight:700;

    color:#334155;

    margin-bottom:8px;

}

.booking-offcanvas .form-control,

.booking-offcanvas .form-select{

    height:48px;

    border-radius:12px;

    border:1px solid #CBD5E1;

    font-size:14px;

}

.booking-offcanvas textarea.form-control{

    height:auto;

    min-height:100px;

}

.booking-offcanvas .form-control:focus,

.booking-offcanvas .form-select:focus{

    border-color:#EA580C;

    box-shadow:0 0 0 .2rem rgba(234,88,12,.15);

}

.booking-offcanvas .card{

    border-radius:16px;

    border:1px solid #E2E8F0 !important;

}

.booking-offcanvas .card-body{

    padding:18px;

}

.booking-offcanvas .card strong{

    color:#EA580C;

    font-size:18px;

}

.booking-offcanvas .alert{

    border:none;

    border-radius:14px;

    font-size:14px;

}

.booking-offcanvas .btn-warning{

    background:#EA580C;

    border-color:#EA580C;

    color:#FFFFFF;

    border-radius:14px;

    height:52px;

    font-size:15px;

    font-weight:700;

}

.booking-offcanvas .btn-warning:hover{

    background:#C2410C;

    border-color:#C2410C;

}

.booking-offcanvas .form-check{

    padding-left:28px;

}

.booking-offcanvas .form-check-input{

    margin-top:.25rem;

}

.booking-offcanvas .form-check-label{

    font-size:14px;

    color:#475569;

}

.booking-offcanvas hr{

    margin:12px 0;

}

@media(max-width:768px){

    .booking-offcanvas{

        width:100% !important;

    }

    .booking-offcanvas .offcanvas-body{

        padding:18px;

    }

    .booking-offcanvas .offcanvas-header{

        padding:18px;

    }

}
</style>
<script>

const bookings=@json($bookingsJson);
console.log(bookings);

const masterSchedules=@json($masterSchedulesJson);

const dayNames=[
'MIN','SEN','SEL','RAB','KAM','JUM','SAB'
];

const monthNames=[
'Jan','Feb','Mar','Apr','Mei','Jun',
'Jul','Agu','Sep','Okt','Nov','Des'
];

let currentWeek=new Date();

let selectedDate=new Date();
let agendaDate = new Date();

/* ========================================= */

function cloneDate(date){

    return new Date(date.getTime());

}

function getMonday(date){

    const d=cloneDate(date);

    const day=d.getDay();

    const diff=d.getDate()-day+(day===0?-6:1);

    d.setDate(diff);

    d.setHours(0,0,0,0);

    return d;

}

function formatDate(date){

    return date.getFullYear()

    +'-'

    +String(date.getMonth()+1)

    .padStart(2,'0')

    +'-'

    +String(date.getDate())

    .padStart(2,'0');

}

/* ========================================= */

function renderWeek(){

    const monday=getMonday(currentWeek);

    const sunday=new Date(monday);

    sunday.setDate(

        monday.getDate()+6

    );

    document
    .getElementById(
        'weekLabel'
    )
    .innerHTML=

        monday.getDate()

        +' '

        +monthNames[monday.getMonth()]

        +' - '

        +sunday.getDate()

        +' '

        +monthNames[sunday.getMonth()];

    for(

        let i=0;

        i<7;

        i++

    ){

        const current=

        new Date(monday);

        current.setDate(

            monday.getDate()+i

        );

        document
        .getElementById(
            'dayName'+i
        )
        .innerHTML=

        dayNames[
            current.getDay()
        ];

        document
        .getElementById(
            'dayDate'+i
        )
        .innerHTML=

        current.getDate();

        const header=

        document
        .getElementById(
            'header-'+i
        );

        header.classList.remove(

            'active'

        );

        const today = new Date();

            if(
                formatDate(current)
                ===
                formatDate(today)
            ){
                header.classList.add('active');
            }

        header.onclick=function(){

            selectedDate = cloneDate(current);

            renderAgenda();

        };

    }

}

/* ========================================= */

document

.getElementById(

'previousWeek'

)

.onclick=function(){

    currentWeek.setDate(

        currentWeek.getDate()-7

    );

    selectedDate=

    getMonday(currentWeek);

    renderWeek();

    renderBoard();

    renderAgenda();

};

document

.getElementById(

'nextWeek'

)

.onclick=function(){

    currentWeek.setDate(

        currentWeek.getDate()+7

    );

    selectedDate=

    getMonday(currentWeek);

    renderWeek();

    renderBoard();

    renderAgenda();

};
/* =========================================
BOOKING
========================================= */

function findBooking(date, hour)
{
    const currentDate = formatDate(date);

    for(const booking of bookings){

        // Hanya booking aktif yang dianggap memakai slot
        const status = String(booking.status || '').toLowerCase();

        if(!['pending', 'approved', 'booked'].includes(status)){
            continue;
        }

        const bookingDate = String(booking.date).substring(0,10);

        if(bookingDate !== currentDate){
            continue;
        }

        const startHour = parseInt(
            String(booking.start).substring(0,2)
        );

        const endHour = parseInt(
            String(booking.end).substring(0,2)
        );

        if(hour >= startHour && hour < endHour){
            return booking;
        }
    }

    return null;
}


/* =========================================
MASTER SCHEDULE
========================================= */

function findSchedule(date, hour)
{
    const currentDate = formatDate(date);

    const englishDay = date.toLocaleDateString(
        'en-US',
        {
            weekday:'long'
        }
    );

    const currentTime =
        String(hour).padStart(2,'0') + ':00';

    let weeklyPractice = null;
    let weeklyHoliday = null;
    let dailyPractice = null;
    let dailyHoliday = null;
    let dailyOverride = null;

    masterSchedules.forEach(schedule=>{

        /*
        ---------------------------------
        WEEKLY
        ---------------------------------
        */

        if(schedule.schedule_type==='weekly'){

            if(schedule.day_name!==englishDay){
                return;
            }

        }

        /*
        ---------------------------------
        DAILY
        ---------------------------------
        */

        if(schedule.schedule_type==='daily'){

            if(schedule.date!==currentDate){
                return;
            }

        }

        /*
        ---------------------------------
        TIME
        ---------------------------------
        */

        if(!schedule.all_day){

            if(
                currentTime<schedule.start ||
                currentTime>=schedule.end
            ){
                return;
            }

        }

        /*
        ---------------------------------
        PRIORITY
        ---------------------------------
        */

        if(schedule.schedule_type==='daily'){

            if(schedule.mode==='override'){
                dailyOverride=schedule;
            }

            if(schedule.mode==='holiday'){
                dailyHoliday=schedule;
            }

            if(schedule.mode==='practice'){
                dailyPractice=schedule;
            }

        }else{

            if(schedule.mode==='holiday'){
                weeklyHoliday=schedule;
            }

            if(schedule.mode==='practice'){
                weeklyPractice=schedule;
            }

        }

    });

    if(dailyOverride) return dailyOverride;

    if(dailyHoliday) return dailyHoliday;

    if(dailyPractice) return dailyPractice;

    if(weeklyHoliday) return weeklyHoliday;

    if(weeklyPractice) return weeklyPractice;

    return null;
}

/* =========================================
BOARD
========================================= */

function renderBoard(){

    const monday=getMonday(currentWeek);

    document

    .querySelectorAll(

        '.grid-cell'

    )

    .forEach(function(cell){

        cell.innerHTML='';

        const day=parseInt(

            cell.dataset.day

        );

        const hour=parseInt(

            cell.dataset.hour

        );

        const current=

        new Date(monday);

        current.setDate(

            monday.getDate()+day

        );
        const booking = findBooking(current, hour);
        const schedule = findSchedule(current, hour);


        /*
        |--------------------------------------------------------------------------
        | PRIORITY 1
        | HOLIDAY
        |--------------------------------------------------------------------------
        */

        if (schedule && schedule.mode === 'holiday') {

            const div = document.createElement('div');

            div.className = 'grid-event holiday';

            cell.appendChild(div);

            return;

        }

        /*
        |--------------------------------------------------------------------------
        | PRIORITY 2
        | BOOKING
        |--------------------------------------------------------------------------
        */

        if (booking) {

            const div = document.createElement('div');

            div.className =
                'grid-event ' +
                (booking.status.toLowerCase() === 'pending'
                    ? 'pending'
                    : 'booked');

            cell.appendChild(div);

            return;

        }

        /*
        |--------------------------------------------------------------------------
        | PRIORITY 3
        | PRACTICE
        |--------------------------------------------------------------------------
        */

        if (schedule && schedule.mode === 'practice') {

            const div = document.createElement('div');

            div.className = 'grid-event practice';

            cell.appendChild(div);

            return;

        }

        /*
        |--------------------------------------------------------------------------
        | AVAILABLE
        |--------------------------------------------------------------------------
        */

        const div = document.createElement('div');

        div.className = 'grid-event available';

        cell.appendChild(div);



    });

}

/* =========================================
AGENDA
========================================= */

function renderAgenda(){

    const agendaDate=

    document.getElementById(

        'agendaDate'

    );

    const agendaList=

    document.getElementById(

        'agendaList'

    );

    agendaList.innerHTML='';

    agendaDate.innerHTML=

        dayNames[selectedDate.getDay()]

        +', '

        +selectedDate.getDate()

        +' '

        +monthNames[selectedDate.getMonth()]

        +' '

        +selectedDate.getFullYear();

    for(

        let hour=8;

        hour<=22;

        hour++

    ){

        const booking=

        findBooking(

            selectedDate,

            hour

        );

        const schedule=

        findSchedule(

            selectedDate,

            hour

        );

        let card=document.createElement(

            'div'

        );

        card.className='agenda-item';

        /* ---------------- BOOKING ---------------- */

        if(booking){

            card.innerHTML=`

                <div class="agenda-color booked"></div>

                <div class="agenda-info">

                    <div class="agenda-name">

                        ${booking.customer}

                    </div>

                    <div class="agenda-time">

                        ${booking.start}

                        -

                        ${booking.end}

                    </div>

                </div>

                <span class="agenda-badge">

                    ${booking.status}

                </span>

            `;

        }

        /* ---------------- MASTER SCHEDULE ---------------- */


        else if(schedule){

            /*
            ---------------------------------------
            Override = Available
            ---------------------------------------
            */

            if(schedule.mode==='override'){

                card.innerHTML=`

                    <div class="agenda-color available"></div>

                    <div class="agenda-info">

                        <div class="agenda-name">
                            Available
                        </div>

                        <div class="agenda-time">
                            ${String(hour).padStart(2,'0')}:00 -
                            ${String(hour+1).padStart(2,'0')}:00
                        </div>

                    </div>

                    ${
                        (() => {

                            const now = new Date();

                            const slotDate = new Date(selectedDate);

                            slotDate.setHours(
                                hour,
                                0,
                                0,
                                0
                            );

                            return slotDate > now
                                ? `
                                    <button
                                        class="book-button"
                                        onclick="bookSlot(${hour})">

                                        Book

                                    </button>
                                `
                                : '';

                        })()
                    }

                `;

            }else{

                const cls=
                    schedule.mode==='holiday'
                    ?'holiday'
                    :'practice';

                card.innerHTML=`

                    <div class="agenda-color ${cls}"></div>

                    <div class="agenda-info">

                        <div class="agenda-name">
                            ${schedule.description ?? schedule.mode}
                        </div>

                        <div class="agenda-time">
                            ${schedule.all_day
                                ? 'All Day'
                                : schedule.start+' - '+schedule.end}
                        </div>

                    </div>

                    <span class="agenda-badge">

                        ${schedule.mode}

                    </span>

                `;

            }

        }

        /* ---------------- AVAILABLE ---------------- */

        else{

            const now = new Date();

            const slotDate = new Date(selectedDate);

            slotDate.setHours(
                hour,
                0,
                0,
                0
            );

            const isPast = slotDate <= now;

            card.innerHTML=`

                <div class="agenda-color available"></div>

                <div class="agenda-info">

                    <div class="agenda-name">

                        Available

                    </div>

                    <div class="agenda-time">

                        ${String(hour).padStart(2,'0')}:00

                        -

                        ${String(hour+1).padStart(2,'0')}:00

                    </div>

                </div>

                ${
                    isPast
                    ? ''
                    : `
                        <button
                            class="book-button"
                            onclick="bookSlot(${hour})">

                            Book

                        </button>
                    `
                }

            `;

        }

        agendaList.appendChild(

            card

        );

    }

}

/* =========================================
BOOK
========================================= */

function bookSlot(hour){

    const today = new Date();

    today.setHours(
        0,
        0,
        0,
        0
    );

    const selected = new Date(
        selectedDate
    );

    selected.setHours(
        0,
        0,
        0,
        0
    );

    if(selected < today){

        return;

    }

    const date = formatDate(
        selectedDate
    );

    const start =
        String(hour).padStart(2,'0')
        + ':00';

    openBooking(
        date,
        start
    );

}

document
.getElementById('agendaPrev')
.onclick=function(){

    selectedDate.setDate(
        selectedDate.getDate()-1
    );

    currentWeek = cloneDate(selectedDate);

    renderWeek();

    renderBoard();

    renderAgenda();

};

document
.getElementById('agendaToday')
.onclick=function(){

    selectedDate = new Date();

    currentWeek = cloneDate(selectedDate);

    renderWeek();

    renderBoard();

    renderAgenda();

};

document
.getElementById('agendaNext')
.onclick=function(){

    selectedDate.setDate(
        selectedDate.getDate()+1
    );

    currentWeek = cloneDate(selectedDate);

    renderWeek();

    renderBoard();

    renderAgenda();

};

/* =========================================
OFFCANVAS BOOKING
========================================= */

let bookingCanvas = null;
const bookingDate = document.getElementById('bookingDate');
const startTime = document.getElementById('startTime');
const endTime = document.getElementById('endTime');

const bookingDuration = document.getElementById('bookingDuration');
const bookingPrice = document.getElementById('bookingPrice');

const transferArea = document.getElementById('transferArea');
const cashArea = document.getElementById('cashArea');

const PRICE_PER_HOUR = 80000;

bookingDate.addEventListener('change', function(){

    refreshBookedTime();

});

startTime.addEventListener('change', function(){

    refreshEndTime();

    const startHour = parseInt(startTime.value);

    const nextHour =
        String(startHour + 1).padStart(2,'0') + ':00';

    if(
        [...endTime.options].some(
            option =>
                option.value === nextHour &&
                !option.disabled
        )
    ){
        endTime.value = nextHour;
    }

    calculateBooking();

});

endTime.addEventListener('change', function(){

    calculateBooking();

});

document
.querySelectorAll('input[name="payment_method"]')
.forEach(function(item){

    item.addEventListener('change', function(){

        if(this.value==='transfer'){

            transferArea.classList.remove('d-none');
            cashArea.classList.add('d-none');

        }else{

            transferArea.classList.add('d-none');
            cashArea.classList.remove('d-none');

        }

    });

});

document.addEventListener('DOMContentLoaded', function () {

    bookingCanvas = new bootstrap.Offcanvas(
        document.getElementById('bookingCanvas')
    );

});
function openBooking(date = null, start = null){

    if(date===null){

        bookingDate.value = formatDate(selectedDate);

    }else{

        bookingDate.value = date;

    }

    refreshBookedTime();

    if(start){

        startTime.value = start;

        refreshEndTime();

        const startHour = parseInt(startTime.value);

        const nextHour =
            String(startHour+1).padStart(2,'0') + ':00';

        if(
            [...endTime.options].some(
                o=>o.value===nextHour && !o.disabled
            )
        ){
            endTime.value = nextHour;
        }

    }else{

        startTime.value='';

        endTime.value='';

    }



    calculateBooking();

    bookingCanvas.show();

}
function rupiah(number){

    return new Intl.NumberFormat('id-ID').format(number);

}
function calculateBooking(){

    if(

        startTime.value=='' ||

        endTime.value==''

    ){

        bookingDuration.innerHTML='0 Jam';

        bookingPrice.innerHTML='Rp 0';



        return;

    }

    let start=

        parseInt(

            startTime.value.split(':')[0]

        );

    let end=

        parseInt(

            endTime.value.split(':')[0]

        );

    /*
    ------------------------------------------------

    Jam selesai tidak boleh <= jam mulai

    Jika user memilih sama,

    jam mulai otomatis mundur 1 jam

    ------------------------------------------------
    */

    if(end<=start){

        const next = start + 1;

        if(next <= 23){

            end = next;

            endTime.value =
                String(end).padStart(2,'0') + ':00';

        }

    }

    const duration=end-start;

    const total=

        duration*

        PRICE_PER_HOUR;

    bookingDuration.innerHTML=

        duration+

        ' Jam';

    bookingPrice.innerHTML=

        'Rp '+

        rupiah(total);





}
function refreshEndTime(){

    if(startTime.value===''){

        endTime.value='';

        return;

    }

    const start=parseInt(startTime.value);
    const maxEnd = start + 4;

    [...endTime.options].forEach(function(option){

        option.disabled=false;

    });

    [...endTime.options].forEach(function(option){

        if(option.value==='') return;

        const end=parseInt(option.value);

        if(end<=start){

            option.disabled=true;

        }

    });

    const selectedDate=bookingDate.value;

    let nextBookingStart = 24;

    bookings.forEach(function(item){

        if(item.date.substring(0,10)!==selectedDate){
            return;
        }

        if(
            item.status.toLowerCase() !== 'approved' &&
            item.status.toLowerCase() !== 'pending'
        ){
            return;
        }

        const bookingStart =
            parseInt(item.start.split(':')[0]);

        if(
            bookingStart > start &&
            bookingStart < nextBookingStart
        ){

            nextBookingStart = bookingStart;

        }

    });
    for(const option of startTime.options){

        if(
            option.disabled &&
            option.value!=='' &&
            parseInt(option.value)>start
        ){

            nextBookingStart=Math.min(
                nextBookingStart,
                parseInt(option.value)
            );

        }

    }

    [...endTime.options].forEach(function(option){

        if(option.value==='') return;

        const end =
            parseInt(option.value);

        if(
            end <= start ||
            end > nextBookingStart ||
            end > maxEnd
        ){
            option.disabled = true;
        }

    });

    if(

        endTime.selectedOptions.length===0 ||

        endTime.options[endTime.selectedIndex].disabled

    ){

        for(let option of endTime.options){

            if(!option.disabled && option.value!==''){

                endTime.value=option.value;

                break;

            }

        }

    }

    calculateBooking();

}
function refreshBookedTime(){

        if(bookingDate.value===''){
            return;
        }

        [...startTime.options].forEach(option => {
            option.disabled = false;
        });

        [...endTime.options].forEach(option => {
            option.disabled = false;
        });

        const selectedDate = bookingDate.value;
            const now = new Date();

            const today =
                now.getFullYear()
                + '-'
                + String(now.getMonth() + 1).padStart(2,'0')
                + '-'
                + String(now.getDate()).padStart(2,'0');

            if(selectedDate === today){

                const currentHour = now.getHours();

                [...startTime.options].forEach(function(option){

                    if(option.value === ''){
                        return;
                    }

                    const hour =
                        parseInt(
                            option.value.substring(0,2)
                        );

                    if(hour <= currentHour){
                        option.disabled = true;
                    }

                });

                [...endTime.options].forEach(function(option){

                    if(option.value === ''){
                        return;
                    }

                    const hour =
                        parseInt(
                            option.value.substring(0,2)
                    );

                    if(hour <= currentHour){
                        option.disabled = true;
                    }

                });

            }

        

        

        /*
        |--------------------------------------------------------------------------
        | TANGGAL LAMPAU
        |--------------------------------------------------------------------------
        */

        bookingDate.min = today;

        if(selectedDate < today){

            [...startTime.options].forEach(function(option){

                if(option.value !== ''){
                    option.disabled = true;
                }

            });

            [...endTime.options].forEach(function(option){

                if(option.value !== ''){
                    option.disabled = true;
                }

            });

            return;
        }

        /*
        |--------------------------------------------------------------------------
        | JAM YANG SUDAH LEWAT HARI INI
        |--------------------------------------------------------------------------
        */

        if(selectedDate === today){

            const currentHour = now.getHours();

            [...startTime.options].forEach(function(option){

                if(option.value === ''){
                    return;
                }

                const hour =
                    parseInt(
                        option.value.substring(0,2)
                    );

                if(hour <= currentHour){

                    option.disabled = true;

                }

            });

            [...endTime.options].forEach(function(option){

                if(option.value === ''){
                    return;
                }

                const hour =
                    parseInt(
                        option.value.substring(0,2)
                    );

                if(hour <= currentHour){

                    option.disabled = true;

                }

            });

        }

    const selectedDay = new Date(selectedDate)
        .toLocaleDateString('en-US',{
            weekday:'long'
        });

    /*
    |--------------------------------------------------------------------------
    | MASTER SCHEDULE
    |--------------------------------------------------------------------------
    */

    for(let hour=8;hour<=22;hour++){

        const value =
            String(hour).padStart(2,'0')+':00';

        const rules = masterSchedules.filter(function(rule){



            if(rule.schedule_type==='daily'){

                if(rule.date && rule.date.substring(0,10)!==selectedDate){
                    return false;
                }

            }else{

                if(rule.day_name!==selectedDay){
                    return false;
                }

            }

            if(rule.all_day){
                return true;
            }

            return (
                rule.start <= value &&
                rule.end > value
            );

        });

        const hasOverride =
            rules.some(r=>r.mode==='override');

        const hasHoliday =
            rules.some(r=>r.mode==='holiday');

        const hasPractice =
            rules.some(r=>r.mode==='practice');
            const today =
            now.getFullYear()
            + '-'
            + String(now.getMonth() + 1).padStart(2,'0')
            + '-'
            + String(now.getDate()).padStart(2,'0');

        const isPastSlot =
            selectedDate < today
            ||
            (
                selectedDate === today
                &&
                hour <= now.getHours()
            );

        [...startTime.options].forEach(function(option){


            if(option.value!==value){
                return;
            }

            if(hasOverride){

                option.disabled = isPastSlot;
                return;

            }

            option.disabled =
                hasHoliday ||
                hasPractice ||
                isPastSlot;

        });

    }

    /*
    |--------------------------------------------------------------------------
    | BOOKING
    |--------------------------------------------------------------------------
    */

    bookings.forEach(function(item){

        if(item.date.substring(0,10)!==selectedDate){
            return;
        }

        if(
            item.status.toLowerCase() !== 'approved' &&
            item.status.toLowerCase() !== 'pending'
        ){
            return;
        }

        const start =
            parseInt(item.start.substring(0,2));

        const end =
            parseInt(item.end.substring(0,2));

        for(let hour=start;hour<end;hour++){

            const value =
                String(hour).padStart(2,'0')+':00';


            [...startTime.options].forEach(function(option){

                if(option.value===value){

                    option.disabled=true;

                }

            });

        }

    });

    refreshEndTime();

}
function generateTimeOption(){

    startTime.innerHTML='<option value="">Pilih Jam</option>';
    endTime.innerHTML='<option value="">Pilih Jam</option>';

    for(let hour=8;hour<=22;hour++){

        const time=String(hour).padStart(2,'0')+':00';

        startTime.innerHTML+=`
            <option value="${time}">
                ${time}
            </option>
        `;
    }

    for(let hour=9;hour<=23;hour++){

        const time=String(hour).padStart(2,'0')+':00';

        endTime.innerHTML+=`
            <option value="${time}">
                ${time}
            </option>
        `;
    }
}









generateTimeOption();

refreshBookedTime();

refreshEndTime();

calculateBooking();

renderWeek();

renderBoard();

renderAgenda();

</script>
@endsection
