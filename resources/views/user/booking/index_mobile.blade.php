<div class="mobile-booking">

    {{-- HEADER --}}

    <div class="mobile-header">

        <h4>

            Booking Lapangan

        </h4>

        <p>

            Aseba Basketball Home Court

        </p>

    </div>

    {{-- WEEK NAVIGATION --}}

    <div class="mobile-week-navigation">

        <button

            id="mobilePreviousWeek"

            class="mobile-nav-button">

            <i class="bi bi-chevron-left"></i>

        </button>

        <div

            id="mobileWeekLabel"

            class="mobile-week-label">

            Loading...

        </div>

        <button

            id="mobileNextWeek"

            class="mobile-nav-button">

            <i class="bi bi-chevron-right"></i>

        </button>

    </div>

    {{-- MINI BOARD --}}

    <div class="mobile-board">

        <div

            class="mobile-board-scroll"

            id="mobileBoardScroll">

            <div

                class="mobile-grid"

                id="mobileGrid">

                {{-- Corner --}}
                <div class="mobile-corner"></div>

                {{-- Header Hari --}}
                @for($day=0;$day<7;$day++)

                    <div

                        class="mobile-day-header"

                        id="mobileHeader{{ $day }}"

                        data-day="{{ $day }}">

                        <div

                            class="mobile-day-name"

                            id="mobileDayName{{ $day }}">

                            MON

                        </div>

                        <div

                            class="mobile-day-date"

                            id="mobileDayDate{{ $day }}">

                            01

                        </div>

                    </div>

                @endfor

                {{-- Jam 08-22 --}}
                @for($hour=8;$hour<=22;$hour++)

                    <div class="mobile-time">

                        {{ sprintf('%02d',$hour) }}

                    </div>

                    @for($day=0;$day<7;$day++)

                        <div

                            class="mobile-slot"

                            id="mobileSlot-{{ $day }}-{{ $hour }}"

                            data-day="{{ $day }}"

                            data-hour="{{ $hour }}">

                        </div>

                    @endfor

                @endfor

            </div>

        </div>

    </div>

    {{-- AGENDA --}}

    <div class="mobile-agenda">

        <div class="mobile-agenda-header">

            <div>

                <h5>

                    Agenda Hari Ini

                </h5>

                <small

                    id="mobileAgendaDate">

                    Loading...

                </small>

            </div>

        </div>

        <div

            id="mobileAgendaList"

            class="mobile-agenda-list">

        </div>

    </div>

</div>

<style>

.mobile-booking{

    width:100%;

    max-width:100%;

    margin:0;

}

.mobile-header{

    background:#fff;

    border-radius:22px;

    padding:18px;

    margin-bottom:18px;

    box-shadow:0 8px 25px rgba(15,23,42,.06);

}

.mobile-header h4{

    margin:0;

    font-size:25px;

    font-weight:700;

    color:#0F172A;

}

.mobile-header p{

    margin-top:4px;

    color:#64748B;

    font-size:14px;

}

.mobile-week-navigation{

    display:flex;

    align-items:center;

    justify-content:space-between;

    margin-bottom:18px;

}

.mobile-nav-button{

    width:44px;

    height:44px;

    border:none;

    border-radius:14px;

    background:#fff;

    box-shadow:0 5px 18px rgba(15,23,42,.08);

}

.mobile-week-label{

    font-size:17px;

    font-weight:700;

    color:#0F172A;

}

.mobile-board{

    background:#fff;

    border-radius:22px;

    padding:10px;

    box-shadow:0 8px 25px rgba(15,23,42,.05);

}

.mobile-board-scroll{

    max-height:430px;

    overflow-y:auto;

}

.mobile-grid{

    display:grid;

    grid-template-columns:42px repeat(7,1fr);

    grid-template-rows:52px repeat(15,44px);

    gap:3px;

}

.mobile-corner{

    background:#FFFFFF;

    position:sticky;

    top:0;

    z-index:4;

}

.mobile-day-header{

    position:sticky;

    top:0;

    z-index:3;

    background:#FFFFFF;
    padding:4px;

    border-radius:12px;

    display:flex;

    flex-direction:column;

    align-items:center;

    justify-content:center;

    border-radius:10px;

    cursor:pointer;

    transition:.2s;

}

.mobile-day-date{

    width:28px;

    height:28px;

.mobile-day-name{

    font-size:9px;

    font-weight:700;

    color:#94A3B8;

}

.mobile-day-date{

    margin-top:2px;

    width:22px;

    height:22px;

    border-radius:50%;

    display:flex;

    align-items:center;

    justify-content:center;

    font-size:11px;

    font-weight:700;

    color:#0F172A;

}

.mobile-day-header.active

.mobile-day-date{

    background:#2563EB;

    color:#fff;

}

.mobile-time{

    display:flex;

    align-items:center;

    justify-content:center;

    font-size:10px;

    color:#94A3B8;

    font-weight:600;

}

.mobile-slot{

    padding:3px;

}

.mobile-event{

    width:100%;

    height:100%;

    border-radius:10px;

    border:1px solid #E2E8F0;

    background:#F8FAFC;

    transition:.2s;

    box-shadow:0 1px 4px rgba(15,23,42,.04);

}

.mobile-event.booked{

    background:#22C55E;

    border:none;

}

.mobile-event.pending{

    background:#F59E0B;

    border:none;

}

.mobile-event.practice{

    background:#3B82F6;

    border:none;

}

.mobile-event.holiday{

    background:#EF4444;

    border:none;

}

.mobile-agenda{

    margin-top:14px;

    background:#fff;

    border-radius:22px;

    padding:16px;

    box-shadow:0 8px 25px rgba(15,23,42,.05);

}

.mobile-agenda-header{

    display:flex;

    justify-content:space-between;

    align-items:center;

    margin-bottom:16px;

}

.mobile-agenda-header h5{

    margin:0;

    font-weight:700;

}

.mobile-agenda-header small{

    color:#64748B;

}

.mobile-agenda-list{

    display:flex;

    flex-direction:column;

    gap:12px;

}
/*====================================================
MOBILE AGENDA
====================================================*/

.mobile-agenda-item{

    display:flex;

    align-items:center;

    gap:12px;

    padding:12px 14px;

    min-height:72px;

    background:#FFFFFF;

    border:1px solid #E2E8F0;

    border-radius:16px;

    transition:.2s;

}

.mobile-agenda-item:hover{

    transform:translateY(-2px);

    box-shadow:0 8px 20px rgba(15,23,42,.06);

}

.mobile-indicator{

    width:6px;

    min-width:6px;

    height:52px;

    border-radius:999px;

}

.mobile-indicator.available{

    background:#CBD5E1;

}

.mobile-indicator.booked{

    background:#22C55E;

}

.mobile-indicator.pending{

    background:#F59E0B;

}

.mobile-indicator.practice{

    background:#2563EB;

}

.mobile-indicator.holiday{

    background:#EF4444;

}

.mobile-content{

    flex:1;

    min-width:0;

}

.mobile-title{

    font-size:14px;

    font-weight:700;

    color:#0F172A;

    overflow:hidden;

    white-space:nowrap;

    text-overflow:ellipsis;

}

.mobile-subtitle{

    margin-top:4px;

    font-size:12px;

    color:#64748B;

}

.mobile-status{

    display:flex;

    align-items:center;

    justify-content:center;

    min-width:74px;

    padding:6px 10px;

    border-radius:999px;

    font-size:10px;

    font-weight:700;

    text-transform:uppercase;

}

.mobile-status.booked{

    background:#DCFCE7;

    color:#15803D;

}

.mobile-status.practice{

    background:#DBEAFE;

    color:#1D4ED8;

}

.mobile-status.holiday{

    background:#FEE2E2;

    color:#DC2626;

}

.mobile-book-btn{

    border:none;

    background:#EA580C;

    color:#FFFFFF;

    font-size:12px;

    font-weight:700;

    padding:8px 14px;

    border-radius:10px;

    transition:.2s;

}

.mobile-book-btn:hover{

    background:#C2410C;

}

.mobile-book-btn:active{

    transform:scale(.95);

}

</style>

<script>

const bookings=@json($bookings);

const masterSchedules=@json($masterSchedules);

const mobileDayNames=[
'MIN','SEN','SEL','RAB','KAM','JUM','SAB'
];

const mobileMonthNames=[
'Jan','Feb','Mar','Apr','Mei','Jun',
'Jul','Agu','Sep','Okt','Nov','Des'
];

let mobileCurrentWeek=new Date();

let mobileSelectedDate=new Date();

/* ===================================== */

function mobileClone(date){

    return new Date(date.getTime());

}

function mobileMonday(date){

    const d=mobileClone(date);

    const day=d.getDay();

    const diff=d.getDate()-day+(day===0?-6:1);

    d.setDate(diff);

    d.setHours(0,0,0,0);

    return d;

}

function mobileFormat(date){

    return date.getFullYear()

    +'-'

    +String(date.getMonth()+1)

    .padStart(2,'0')

    +'-'

    +String(date.getDate())

    .padStart(2,'0');

}

/* ===================================== */

function renderMobileWeek(){

    const monday=

    mobileMonday(

        mobileCurrentWeek

    );

    const sunday=

    new Date(monday);

    sunday.setDate(

        monday.getDate()+6

    );

    document

    .getElementById(

        'mobileWeekLabel'

    )

    .innerHTML=

        monday.getDate()

        +' '

        +mobileMonthNames[monday.getMonth()]

        +' - '

        +sunday.getDate()

        +' '

        +mobileMonthNames[sunday.getMonth()];

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

            'mobileDayName'+i

        )

        .innerHTML=

        mobileDayNames[

            current.getDay()

        ];

        document

        .getElementById(

            'mobileDayDate'+i

        )

        .innerHTML=

        current.getDate();

        const header=

        document

        .getElementById(

            'mobileHeader'+i

        );

        header.classList.remove(

            'active'

        );

        if(

            mobileFormat(current)

            ===

            mobileFormat(

                mobileSelectedDate

            )

        ){

            header.classList.add(

                'active'

            );

        }

        header.onclick=function(){

            mobileSelectedDate=

            mobileClone(current);

            renderMobileWeek();

            renderMobileAgenda();

        };

    }

}

/* ===================================== */

document

.getElementById(

'mobilePreviousWeek'

)

.onclick=function(){

    mobileCurrentWeek.setDate(

        mobileCurrentWeek.getDate()-7

    );

    mobileSelectedDate=

    mobileMonday(

        mobileCurrentWeek

    );

    renderMobileWeek();

    renderMobileBoard();

    renderMobileAgenda();

};

document

.getElementById(

'mobileNextWeek'

)

.onclick=function(){

    mobileCurrentWeek.setDate(

        mobileCurrentWeek.getDate()+7

    );

    mobileSelectedDate=

    mobileMonday(

        mobileCurrentWeek

    );

    renderMobileWeek();

    renderMobileBoard();

    renderMobileAgenda();

};

/* =========================================
FIND BOOKING
========================================= */

function findMobileBooking(date, hour){

    const current = mobileFormat(date);

    return bookings.find(function(item){

        // REJECTED = SLOT KEMBALI AVAILABLE
        if (
            String(item.status).toLowerCase() === 'rejected'
        ) {
            return false;
        }

        // Hanya booking aktif yang mengunci slot
        if (
            !['pending', 'approved', 'booked'].includes(
                String(item.status).toLowerCase()
            )
        ) {
            return false;
        }

        const bookingDate =
            item.booking_date ??
            item.date;

        if (
            String(bookingDate).substring(0, 10)
            !== current
        ) {
            return false;
        }

        const start = parseInt(
            (item.start_time ?? item.start)
            .substring(0, 2)
        );

        const end = parseInt(
            (item.end_time ?? item.end)
            .substring(0, 2)
        );

        return (
            hour >= start &&
            hour < end
        );
    });
}

/* =========================================
FIND MASTER SCHEDULE
========================================= */

function findMobileSchedule(date,hour){

    const current=mobileFormat(date);

    const day=date.getDay();

    const time=

        String(hour)

        .padStart(2,'0')

        +':00';

    return masterSchedules.find(function(item){

        if(item.schedule_type==='daily'){

            if(item.date!==current){

                return false;

            }

        }

        if(item.schedule_type==='weekly'){

            const dayMap={

                sunday:'MIN',

                monday:'SEN',

                tuesday:'SEL',

                wednesday:'RAB',

                thursday:'KAM',

                friday:'JUM',

                saturday:'SAB'

            };

            const currentDay=

            dayMap[

                item.day_name.toLowerCase()

            ];

            if(

                currentDay!==

                mobileDayNames[day]

            ){

                return false;

            }

        }

        if(item.all_day){

            return true;

        }

        return(

            item.start_time<=time

            &&

            item.end_time>time

        );

    });

}

/* =========================================
RENDER BOARD
========================================= */

function renderMobileBoard(){

    const monday=

    mobileMonday(

        mobileCurrentWeek

    );

    document

    .querySelectorAll(

        '.mobile-slot'

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

        const booking=

        findMobileBooking(

            current,

            hour

        );

        if(booking){

            const block=

            document.createElement('div');

            block.className=

            'mobile-event '

            +(booking.status==='pending'

            ?'pending'

            :'booked');

            cell.appendChild(block);

            return;

        }

        const schedule=

        findMobileSchedule(

            current,

            hour

        );

        if(schedule){

            const block=

            document.createElement('div');

            block.className=

            'mobile-event '

            +(schedule.mode==='holiday'

            ?'holiday'

            :'practice');

            cell.appendChild(block);

            return;

        }

        const empty=

        document.createElement('div');

        empty.className='mobile-event';

        cell.appendChild(empty);

    });

}

/* =========================================
RENDER AGENDA
========================================= */

function renderMobileAgenda(){

    const list=document.getElementById(

        'mobileAgendaList'

    );

    const agendaDate=document.getElementById(

        'mobileAgendaDate'

    );

    list.innerHTML='';

    agendaDate.innerHTML=

        mobileDayNames[

            mobileSelectedDate.getDay()

        ]

        +', '

        +mobileSelectedDate.getDate()

        +' '

        +mobileMonthNames[

            mobileSelectedDate.getMonth()

        ]

        +' '

        +mobileSelectedDate.getFullYear();

    for(

        let hour=8;

        hour<=22;

        hour++

    ){

        const booking=

        findMobileBooking(

            mobileSelectedDate,

            hour

        );

        const schedule=

        findMobileSchedule(

            mobileSelectedDate,

            hour

        );

        let html='';

        /* ================= BOOKING ================= */

        if(booking){

            html=`

            <div class="mobile-agenda-item">

                <div class="mobile-indicator booked"></div>

                <div class="mobile-content">

                    <div class="mobile-title">

                        ${booking.customer_name}

                    </div>

                    <div class="mobile-subtitle">

                        ${booking.start_time}

                        -

                        ${booking.end_time}

                    </div>

                </div>

                <span class="mobile-status booked">

                    BOOKED

                </span>

            </div>

            `;

        }

        /* ================= MASTER ================= */

        else if(schedule){

            const cls=

                schedule.mode==='holiday'

                ?'holiday'

                :'practice';

            html=`

            <div class="mobile-agenda-item">

                <div class="mobile-indicator ${cls}"></div>

                <div class="mobile-content">

                    <div class="mobile-title">

                        ${schedule.description??schedule.mode}

                    </div>

                    <div class="mobile-subtitle">

                        ${schedule.all_day

                        ?'Full Day'

                        :schedule.start_time+' - '+schedule.end_time}

                    </div>

                </div>

                <span class="mobile-status ${cls}">

                    ${schedule.mode.toUpperCase()}

                </span>

            </div>

            `;

        }

        /* ================= AVAILABLE ================= */

        else{

            const now = new Date();

            const slotDate = new Date(mobileSelectedDate);

            slotDate.setHours(
                hour,
                0,
                0,
                0
            );

            const isPast = slotDate <= now;

            html=`

            <div class="mobile-agenda-item">

                <div class="mobile-indicator available"></div>

                <div class="mobile-content">

                    <div class="mobile-title">

                        Available

                    </div>

                    <div class="mobile-subtitle">

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
                            class="mobile-book-btn"
                            onclick="mobileBook(${hour})">

                            Book

                        </button>
                    `
                }

            </div>

            `;

        }
        list.insertAdjacentHTML(

            'beforeend',

            html

        );

    }

}

/* =========================================
BOOK
========================================= */

function mobileBook(hour){

    const now = new Date();

    const slotDate = new Date(
        mobileSelectedDate
    );

    slotDate.setHours(
        hour,
        0,
        0,
        0
    );

    if(slotDate <= now){

        return;

    }

    const date=

        mobileFormat(

            mobileSelectedDate

        );

    const start=

        String(hour)

        .padStart(2,'0')

        +':00';

    window.location=

        "{{ route('user.booking.create') }}"

        +"?date="

        +date

        +"&start="

        +start;

}

/* =========================================
INITIALIZE
========================================= */

renderMobileWeek();

renderMobileBoard();

renderMobileAgenda();

</script>

@endsection
