@extends('admin.layouts.admin')

@section('title', 'Booking Lapangan')

@section('page-title', 'Booking Lapangan')

@section('page-subtitle', 'Kelola seluruh reservasi lapangan ABHC.')

@section('content')

<style>

:root{

    --primary:#EA580C;
    --primary-soft:#FFF7ED;

    --success:#22C55E;
    --warning:#F59E0B;
    --danger:#EF4444;
    --training:#2563EB;

    --border:#E2E8F0;

    --card:#FFFFFF;

    --background:#F8FAFC;

    --slot-width:155px;

    --slot-height:82px;

    --time-width:120px;

}

.booking-page{

    display:flex;

    flex-direction:column;

    gap:24px;

}

/* ===========================================
SUMMARY
=========================================== */

.booking-summary-card{

    border:none;

    border-radius:24px;

}

.booking-summary-card .card-header{

    background:white;

    border-bottom:1px solid var(--border);

}

.booking-summary-card .card-body{

    padding:0;

}

/* ===========================================
FILTER
=========================================== */

.booking-filter-card{

    border:none;

    border-radius:24px;

}

.booking-filter-card .card-body{

    padding:24px;

}

/* ===========================================
TOOLBAR
=========================================== */

.booking-toolbar{

    border:none;

    border-radius:24px;

}

.booking-toolbar .card-body{

    padding:20px 24px;

}

/* ===========================================
DESKTOP BOARD
=========================================== */

.schedule-card{

    border:none;

    border-radius:24px;

    overflow:hidden;

}

.schedule-card .card-body{

    padding:0;

}

.schedule-wrapper{

    overflow:auto;

    background:white;

}

/* ===========================================
TABLE
=========================================== */

.schedule-table{

    width:100%;

    min-width:1300px;

    border-collapse:separate;

    border-spacing:0;

}

.schedule-table thead th{

    background:white;

    border-bottom:1px solid var(--border);

    position:sticky;

    top:0;

    z-index:15;

    padding:18px;

    white-space:nowrap;

}

.calendar-header{

    display:flex;

    flex-direction:column;

    align-items:center;

    justify-content:center;

    padding:10px 6px;

    border-radius:14px;

    transition:.25s;

}

.calendar-day{

    font-size:13px;

    font-weight:700;

    color:#64748B;

}

.calendar-date{

    font-size:24px;

    font-weight:800;

    color:#0F172A;

    line-height:1.2;

}

.calendar-header small{

    color:#94A3B8;

}

.active-day{

    background:#FFF7ED;

    border:2px solid #EA580C;

}

.active-day .calendar-day,

.active-day .calendar-date{

    color:#EA580C;

}

.schedule-table tbody td{

    border-bottom:1px solid #EDF2F7;

    border-right:1px solid #EDF2F7;

    height:var(--slot-height);

}

.time-column{

    position:sticky;

    left:0;

    background:white;

    width:var(--time-width);

    min-width:var(--time-width);

    text-align:center;

    font-weight:700;

    z-index:10;

}

.slot{

    min-width:var(--slot-width);

    width:var(--slot-width);

    cursor:pointer;

    position:relative;

    transition:.25s;

}

.slot:hover{

    background:#FFF7ED;

}

.slot:hover .bi-plus-lg{

    color:#EA580C;

    transform:scale(1.15);

}

.slot .bi-plus-lg{

    transition:.25s;

}

.slot:hover{

    background:var(--primary-soft);

}

/* ===========================================
STATUS
=========================================== */

.status-approved{

    background:#DCFCE7;

}

.status-pending{

    background:#FEF3C7;

}

.status-practice{
    background:#FEF3C7;
}

.status-holiday{
    background:#FEE2E2;
}

.status-override{
    background:#DBEAFE;
}

.booking-card{

    border-radius:12px;

    padding:10px;

    height:100%;

    transition:.25s;

}

.booking-card:hover{

    transform:translateY(-2px);

    box-shadow:0 8px 20px rgba(0,0,0,.08);

}

/* ===========================================
MOBILE
=========================================== */

.mobile-board{

    display:flex;

    flex-direction:column;

    gap:16px;

}



.mobile-time-row{

    display:grid;

    grid-template-columns:95px 1fr;

    gap:12px;

    align-items:center;

    margin-bottom:12px;

}

.mobile-hour{

    font-size:13px;

    font-weight:700;

    color:#334155;

}

.mobile-slot-card{

    border-radius:14px;

    padding:10px 14px;

    display:flex;

    justify-content:space-between;

    align-items:center;

    border:1px solid #E2E8F0;

    min-height:56px;

}

.mobile-slot-card.available{

    background:#F8FAFC;

}

.mobile-slot-card.approved{

    background:#DCFCE7;

    border-left:4px solid #22C55E;

}

.mobile-slot-card.pending{

    background:#FEF3C7;

    border-left:4px solid #F59E0B;

}

.mobile-slot-card.practice{
    background:#FEF3C7;
    border-left:4px solid #F59E0B;
}

.mobile-slot-card.holiday{
    background:#FEE2E2;
    border-left:4px solid #DC2626;
}

.mobile-slot-card.override{
    background:#DBEAFE;
    border-left:4px solid #2563EB;
}

/* ===========================================
RESPONSIVE
=========================================== */

@media(max-width:991px){

.schedule-wrapper{

display:none;

}

}

@media(min-width:992px){

.mobile-board{

display:none;

}

}

</style>

<div class="booking-page">

    {{-- ===================================== --}}
    {{-- BOOKING LIST --}}
    {{-- ===================================== --}}

    @include('admin.courts.components.booking_summary')

    {{-- ===================================== --}}
    {{-- FILTER --}}
    {{-- ===================================== --}}

    @include('admin.courts.components.booking_filter')

    {{-- ===================================== --}}
    {{-- TOOLBAR --}}
    {{-- ===================================== --}}

    @include('admin.courts.components.booking_toolbar')

    {{-- ===================================== --}}
    {{-- DESKTOP BOARD --}}
    {{-- ===================================== --}}

    @include('admin.courts.components.booking_board')

    {{-- ===================================== --}}
    {{-- MOBILE BOARD --}}
    {{-- ===================================== --}}

    @include('admin.courts.components.booking_mobile')

</div>

<script>

const monthNames = [

'January',
'February',
'March',
'April',
'May',
'June',
'July',
'August',
'September',
'October',
'November',
'December'

];

const dayNames=[

'Sunday',
'Monday',
'Tuesday',
'Wednesday',
'Thursday',
'Friday',
'Saturday'

];

let scheduleDate = new Date();




const bookings = @json($bookings);
const masterSchedules = @json($masterSchedules);
function findMasterSchedule(date, hour) {

    const slotTime = String(hour).padStart(2, '0') + ':00';

    const currentDate = new Date(date);

    const dayName = currentDate.toLocaleDateString(
        'en-US',
        {
            weekday: 'long'
        }
    );

    const matched = masterSchedules.filter(function(rule){



        if(rule.schedule_type === 'daily'){

            if(rule.date !== date){
                return false;
            }

        }else{

            if(rule.day_name !== dayName){
                return false;
            }

        }
        if (
            rule.mode === 'override' &&
            rule.schedule_type === 'weekly'
        ) {
            return false;
        }

        if(rule.all_day){
            return true;
        }

        return (
            rule.start <= slotTime &&
            rule.end > slotTime
        );

    });

    const dailyCustom = matched.find(x =>
        x.schedule_type === 'daily' &&
        !x.all_day &&
        x.mode === 'override'
    );

    if (dailyCustom) {
        return {
            blocked: false,
            type: 'available'
        };
    }

    const dailyPractice = matched.find(x =>
        x.schedule_type === 'daily' &&
        !x.all_day &&
        x.mode === 'practice'
    );

    if (dailyPractice) {
        return {
            blocked: true,
            type: 'practice',
            description: dailyPractice.description
        };
    }

    const dailyHoliday = matched.find(x =>
        x.schedule_type === 'daily' &&
        !x.all_day &&
        x.mode === 'holiday'
    );

    if (dailyHoliday) {
        return {
            blocked: true,
            type: 'holiday',
            description: dailyHoliday.description
        };
    }

    const dailyFull = matched.find(x =>
        x.schedule_type === 'daily' &&
        x.all_day
    );

    if (dailyFull) {

        if (dailyFull.mode === 'override') {
            return {
                blocked: false,
                type: 'available'
            };
        }

        if (dailyFull.mode === 'practice') {
            return {
                blocked: true,
                type: 'practice',
                description: dailyFull.description
            };
        }

        if (dailyFull.mode === 'holiday') {
            return {
                blocked: true,
                type: 'holiday',
                description: dailyFull.description
            };
        }
    }

    const weeklyPractice = matched.find(x =>
        x.schedule_type === 'weekly' &&
        !x.all_day &&
        x.mode === 'practice'
    );

    if (weeklyPractice) {
        return {
            blocked: true,
            type: 'practice',
            description: weeklyPractice.description
        };
    }

    const weeklyHoliday = matched.find(x =>
        x.schedule_type === 'weekly' &&
        x.mode === 'holiday'
    );

    if (weeklyHoliday) {
        return {
            blocked: true,
            type: 'holiday',
            description: weeklyHoliday.description
        };
    }

    return {
        blocked: false,
        type: 'available'
    };

}
console.log('BOOKINGS :', bookings);
console.log(

    'MASTER SCHEDULE :',

    masterSchedules

);

function updateClock(){

    const clock=document.getElementById('liveClock');

    if(!clock) return;

    clock.innerHTML=new Date().toLocaleTimeString('id-ID');

}

updateClock();

setInterval(updateClock,1000);

function cloneDate(date){

    return new Date(date.getTime());

}

function getMonday(date){

    let d=cloneDate(date);

    let day=d.getDay();

    let diff=d.getDate()-day+(day===0?-6:1);

    d.setDate(diff);

    d.setHours(0,0,0,0);

    return d;

}

function formatDate(date){

    return dayNames[date.getDay()]
    +', '+
    date.getDate()
    +' '+
    monthNames[date.getMonth()]
    +' '+
    date.getFullYear();

}

function formatShort(date){

    return date.getDate()
    +' '+
    monthNames[date.getMonth()]
    +' '+
    date.getFullYear();

}

function refreshPage(){



    renderToolbar();

    if(typeof renderSummary==='function'){

        renderSummary();

    }

    renderBoard();

    renderBoardBooking();

    renderMobile();

    initSearch();

    initFilter();

}
/* ===========================================
SEARCH
=========================================== */

function initSearch(){

    const input=document.getElementById('bookingSearch');

    if(!input) return;

    input.onkeyup=function(){

        const keyword=this.value.toLowerCase();

        document.querySelectorAll('.booking-card').forEach(card=>{

            card.style.display=

            card.innerText.toLowerCase().includes(keyword)

            ?''

            :'none';

        });

    };

}

/* ===========================================
FILTER
=========================================== */

function initFilter(){

    const searchInput=document.getElementById('bookingSearch');
    const statusInput=document.getElementById('bookingStatus');
    const sourceInput=document.getElementById('bookingSource');
    const dateInput=document.getElementById('bookingDate');

    function applyFilter(){

        renderSummary();

    }

    if(searchInput){

        searchInput.oninput=applyFilter;

    }

    if(statusInput){

        statusInput.onchange=applyFilter;

    }

    if(sourceInput){

        sourceInput.onchange=applyFilter;

    }

    if(dateInput){

        dateInput.onchange=function(){

            scheduleDate=new Date(this.value);

            refreshPage();

        };

    }

}
/* ===========================================
REFRESH BUTTON
=========================================== */

const filterButton=document.getElementById('btnFilter');

if(filterButton){

    filterButton.addEventListener(

        'click',

        function(){

            refreshPage();

        }

    );

}

/* ===========================================
DATE FILTER
=========================================== */

const bookingDate=document.getElementById('bookingDate');

if(bookingDate){

    bookingDate.value=bookingDateString();

    bookingDate.addEventListener(

        'change',

        function(){

            scheduleDate=new Date(this.value);

            refreshPage();

        }

    );

}

    /* ===========================================
MOBILE
=========================================== */

let mobilePage=1;

function renderMobile(){

    const timeline=document.getElementById('mobileTimeline');

    if(!timeline) return;

    timeline.innerHTML='';

    const now=new Date();

    now.setHours(0,0,0,0);

    const selectedDate=new Date(scheduleDate);

    selectedDate.setHours(0,0,0,0);

    for(let hour=8;hour<=22;hour++){

        const booking=findBooking(scheduleDate,hour);
        const schedule = findMasterSchedule(
            bookingDateString(),
            hour
        );

        const isPastDay=selectedDate<now;

        const isToday=
            selectedDate.getTime()===now.getTime();

        const isPast=
            isPastDay ||
            (isToday && hour<new Date().getHours());

        if (schedule.blocked) {

            let label = schedule.description ?? 'Holiday';

            if (schedule.type === 'practice') {
                label = schedule.description ?? 'Practice';
            }

            timeline.innerHTML += `

                <div class="mobile-time-row">

                    <div class="mobile-hour">

                        ${String(hour).padStart(2,'0')}:00 -
                        ${String(hour+1).padStart(2,'0')}:00

                    </div>

                    <div class="mobile-slot-card ${schedule.type}">

                        <strong>${label}</strong>

                    </div>

                </div>

            `;

            continue;
        }

        if(!booking){

            if(isPast){

                timeline.innerHTML+=`

                    <div class="mobile-time-row">

                        <div class="mobile-hour">

                            ${String(hour).padStart(2,'0')}:00 -
                            ${String(hour+1).padStart(2,'0')}:00

                        </div>

                        <div class="mobile-slot-card available">

                        </div>

                    </div>

                `;

            }else{

                timeline.innerHTML+=`

                    <div class="mobile-time-row">

                        <div class="mobile-hour">

                            ${String(hour).padStart(2,'0')}:00 -
                            ${String(hour+1).padStart(2,'0')}:00

                        </div>

                        <div class="mobile-slot-card available">

                            <span>Available</span>

                            <button
                                class="btn btn-success btn-sm"
                                onclick="openCreateBooking(
                                '${scheduleDateString()}',
                                '${String(hour).padStart(2,'0')}:00'
                                )">

                                Book

                            </button>

                        </div>

                    </div>

                `;

            }

            continue;

        }

        let status='approved';
        let badge='✔';

        switch(booking.status){

            case 'pending':
                status='pending';
                badge='⏳';
            break;

            case 'practice':
                status='practice';
                badge='🏀';
            break;

            case 'holiday':
                status='holiday';
                badge='📅';
            break;

        }

        timeline.innerHTML+=`

            <div class="mobile-time-row">

                <div class="mobile-hour">

                    ${booking.start} - ${booking.end}

                </div>

                <div class="mobile-slot-card ${status}">

                    <div>

                        <strong>${booking.customer}</strong>

                        <br>

                        <small>${booking.added_by}</small>

                    </div>

                    <div>${badge}</div>

                </div>

            </div>

        `;

    }

}


function renderToolbar(){

    const monday=getMonday(scheduleDate);

    const sunday=cloneDate(monday);

    sunday.setDate(monday.getDate()+6);

    /*
    |--------------------------------------------------------------------------
    | Toolbar Date
    |--------------------------------------------------------------------------
    */

    const weekLabel=document.getElementById('weekLabel');

    if(weekLabel){

        weekLabel.innerHTML=

        formatDate(scheduleDate);

    }

    /*
    |--------------------------------------------------------------------------
    | Booking Summary
    |--------------------------------------------------------------------------
    */

    const bookingListDate=document.getElementById('bookingListDate');

    if(bookingListDate){

        bookingListDate.innerHTML=
        formatDate(scheduleDate);

    }

    /*
    |--------------------------------------------------------------------------
    | Mobile Header
    |--------------------------------------------------------------------------
    */

    const mobileDayName=document.getElementById('mobileDayName');

    if(mobileDayName){

        mobileDayName.innerHTML=

        dayNames[scheduleDate.getDay()];

    }

    const mobileDate=document.getElementById('mobileDate');

    if(mobileDate){

        mobileDate.innerHTML=

        formatDate(scheduleDate);

    }

    /*
    |--------------------------------------------------------------------------
    | Left Calendar Card
    |--------------------------------------------------------------------------
    */

    const dayCard=document.querySelector('.summary-day');

    if(dayCard){

        dayCard.innerHTML=

        dayNames[scheduleDate.getDay()].toUpperCase();

    }

    const dateCard=document.querySelector('.summary-date');

    if(dateCard){

        dateCard.innerHTML=

        scheduleDate.getDate();

    }

    const monthCard=document.querySelector('.summary-month');

    if(monthCard){

        monthCard.innerHTML=

        monthNames[scheduleDate.getMonth()].toUpperCase()

        +' '+

        scheduleDate.getFullYear();

    }

}

document
.getElementById('previousWeek')
?.addEventListener(
'click',
function(){

    scheduleDate.setDate(
        scheduleDate.getDate()-7
    );



    refreshPage();

});

document
.getElementById('nextWeek')
?.addEventListener(
'click',
function(){

    scheduleDate.setDate(
        scheduleDate.getDate()+7
    );



    refreshPage();

});

document
.getElementById('mobilePrevDay')
?.addEventListener(
'click',
function(){

    scheduleDate.setDate(
        scheduleDate.getDate()-1
    );



    refreshPage();

});

document
.getElementById('mobileNextDay')
?.addEventListener(
'click',
function(){

    scheduleDate.setDate(
        scheduleDate.getDate()+1
    );



    refreshPage();

});
function renderBoardBooking(){

    const monday=getMonday(scheduleDate);

    const rows=document.querySelectorAll(

        '.schedule-table tbody tr'

    );

    rows.forEach((row,rowIndex)=>{

        const hour=8+rowIndex;

        const cells=row.querySelectorAll('td');

        for(let day=1;day<=7;day++){

            const cell=cells[day];
            cell.className='slot';
            cell.innerHTML='';
            if(!cell) continue;

            const current=new Date(monday);

            current.setDate(

                monday.getDate()+(day-1)

            );

            const currentDateString =
                current.getFullYear()
                + '-'
                + String(current.getMonth()+1).padStart(2,'0')
                + '-'
                + String(current.getDate()).padStart(2,'0');

            const schedule =
                findMasterSchedule(currentDateString, hour);

const booking = findBooking(current, hour);

/*
|--------------------------------------------------------------------------
| PRIORITAS:
| Booking
| >
| Holiday / Practice
| >
| Available
|--------------------------------------------------------------------------
*/

if (booking) {

    let badge = 'approved';

    if (booking.status === 'pending') {
        badge = 'pending';
    }

    if (booking.status === 'practice') {
        badge = 'practice';
    }

    cell.className = 'slot status-' + badge;

    cell.innerHTML = `

        <div class="booking-card ${badge}">

            <div class="booking-card-title">
                ${booking.customer}
            </div>

            <div class="booking-card-time">
                ${booking.start} - ${booking.end}
            </div>

            <div class="booking-card-source">
                ${booking.added_by}
            </div>

        </div>

    `;

    continue;

}

if (schedule.blocked) {

    cell.className = 'slot status-' + schedule.type;

    cell.innerHTML = `

        <div class="booking-card ${schedule.type}">

            <div class="booking-card-title">
                ${schedule.description ?? schedule.type.toUpperCase()}
            </div>

        </div>

    `;

    continue;

}

const now = new Date();

                now.setHours(0,0,0,0);

                const currentDate = new Date(current);

                currentDate.setHours(0,0,0,0);

                const isPastDay = currentDate < now;

                const isToday = currentDate.getTime() === now.getTime();

                const isPast =
                    isPastDay ||
                    (isToday && hour < new Date().getHours());





            if(!booking){

                if(isPast){

                    cell.className='slot';

                    continue;

                }

                cell.className='slot';
                cell.innerHTML=`

                    <button

                    class="btn btn-light border-0 rounded-0 w-100 h-100"

                    onclick="openCreateBooking(

                    '${current.getFullYear()}-${String(current.getMonth()+1).padStart(2,'0')}-${String(current.getDate()).padStart(2,'0')}',

                    '${String(hour).padStart(2,'0')}:00'

                    )"

                    >

                    <i class="bi bi-plus-lg"></i>

                    </button>

                    `;

                continue;

            }



        }

    });

}
function renderBoard(){

    const monday=getMonday(scheduleDate);

    const headers=document.querySelectorAll('.schedule-table thead th');

    if(headers.length<8) return;

    for(let i=1;i<=7;i++){

        const date=new Date(monday);

        date.setDate(monday.getDate()+(i-1));

        const today = new Date();

        today.setHours(0,0,0,0);

        const compareDate = new Date(date);

        compareDate.setHours(0,0,0,0);

        const isToday =
            compareDate.getTime() === today.getTime();

        headers[i].innerHTML=`

            <div class="calendar-header ${isToday?'active-day':''}">

                <div class="calendar-day">

                    ${dayNames[date.getDay()]}

                </div>

                <div class="calendar-date">

                    ${date.getDate()}

                </div>

                <small>

                    ${monthNames[date.getMonth()].substring(0,3)}

                </small>

            </div>

        `;

    }

}

/* ===========================================
DEMO BOOKINGS
=========================================== */

/*
|--------------------------------------------------------------------------
| DEMO BOOKINGS
|--------------------------------------------------------------------------
| Nanti array ini diganti dari database Laravel.
*/



function bookingDateString(){

    return scheduleDate.getFullYear()
    + '-'
    + String(scheduleDate.getMonth()+1).padStart(2,'0')
    + '-'
    + String(scheduleDate.getDate()).padStart(2,'0');

}

function scheduleDateString(){

    const y=scheduleDate.getFullYear();

    const m=String(

        scheduleDate.getMonth()+1

    ).padStart(2,'0');

    const d=String(

        scheduleDate.getDate()

    ).padStart(2,'0');

    return `${y}-${m}-${d}`;

}

function getFilteredBookings(){

    let data=[...bookings];
    data = data.filter(
    booking => (booking.status || '').toLowerCase() !== 'rejected'
);

    const keyword=document.getElementById('bookingSearch')?.value
        .trim()
        .toLowerCase() ?? '';

    const status=document.getElementById('bookingStatus')?.value ?? '';

    const source=document.getElementById('bookingSource')?.value ?? '';

    const date=document.getElementById('bookingDate')?.value ?? '';

    if(date){

        data=data.filter(

            booking=>booking.date===date

        );

    }

    if(keyword){

        data=data.filter(booking=>{

            return(

                booking.customer?.toLowerCase().includes(keyword) ||

                booking.phone?.toLowerCase().includes(keyword) ||

                booking.club_name?.toLowerCase().includes(keyword)

            );

        });

    }

    if(status){

        data=data.filter(

            booking=>booking.status===status

        );

    }

    if(source){

        data=data.filter(

            booking=>booking.source===source

        );

    }

    return data;

}

function todayBookings(){

    return getFilteredBookings();

}

function renderSummary(){

    const container=document.getElementById('bookingSummaryList');

    if(!container) return;

    const counter=document.getElementById('bookingCounter');

    const data=getFilteredBookings();

    container.innerHTML='';

    if(counter){

        counter.innerHTML=`${data.length} Booking`;

    }

    if(data.length===0){

        container.innerHTML=`

            <div class="text-center py-5 text-secondary">

                <i class="bi bi-calendar-x fs-1 d-block mb-3"></i>

                Belum ada booking.

            </div>

        `;

        return;

    }

    data.forEach(function(booking){

        let statusClass='approved';
        let badgeClass='bg-success';
        let badgeText='Approved';

        switch((booking.status || '').toLowerCase()){

            case 'pending':

                statusClass='pending';
                badgeClass='bg-warning text-dark';
                badgeText='Pending';

            break;

            case 'practice':

                statusClass='practice';
                badgeClass='bg-primary';
                badgeText='Practice';

            break;

            case 'holiday':

                statusClass='holiday';
                badgeClass='bg-secondary';
                badgeText='Holiday';

            break;

            case 'cancelled':

                statusClass='pending';
                badgeClass='bg-danger';
                badgeText='Cancelled';

            break;

        }

        container.innerHTML+=`

            <div
                class="booking-summary-item"
                data-id="${booking.id}"
            >

                <div class="booking-time ${statusClass}">

                    ${booking.start}

                    -

                    ${booking.end}

                </div>

                <div class="booking-user">

                    Reserved by

                    <strong>

                        ${booking.customer}

                    </strong>

                    ${booking.club_name
                        ? `<br><small class="text-muted">${booking.club_name}</small>`
                        : ''}

                </div>

                <div class="booking-added">

                    <img
                        src="https://ui-avatars.com/api/?name=${encodeURIComponent(booking.customer)}"
                        class="booking-avatar"
                    >

                    <div>

                        <div>

                            ${booking.added_by}

                        </div>

                        <small class="text-muted">

                            ${booking.source}

                        </small>

                    </div>

                </div>

                <div class="booking-status">

                    <span class="badge ${badgeClass} rounded-pill">

                        ${badgeText}

                    </span>

                </div>

            </div>

        `;

    });

}


function findBooking(date, startHour){

    const bookingDate =
        date.getFullYear()
        + '-'
        + String(date.getMonth() + 1).padStart(2, '0')
        + '-'
        + String(date.getDate()).padStart(2, '0');

    return bookings.find(function(booking){

        // Booking yang ditolak dianggap AVAILABLE
        if ((booking.status || '').toLowerCase() === 'rejected') {
            return false;
        }

        if (booking.date !== bookingDate) {
            return false;
        }

        const start = parseInt(
            booking.start.substring(0, 2)
        );

        const end = parseInt(
            booking.end.substring(0, 2)
        );

        return startHour >= start && startHour < end;
    });
}

function openCreateBooking(date,start){

    window.location.href =
        `/admin/courts/bookings/create?date=${date}&start=${start}`;

}
document.addEventListener(

'DOMContentLoaded',

function(){



    refreshPage();

    updateClock();

});


</script>
@endsection
