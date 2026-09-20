@extends('admin.layouts.admin')

@section('title','Booking Baru')

@section('page-title','Booking Baru')

@section('page-subtitle','Tambah reservasi lapangan baru.')

@section('content')

<style>

:root{

    --primary:#EA580C;
    --primary-soft:#FFF7ED;
    --success:#16A34A;
    --danger:#DC2626;
    --border:#E2E8F0;
    --bg:#F8FAFC;

}

.booking-wrapper{

    display:flex;
    flex-direction:column;
    gap:24px;

}

.booking-card{

    border:none;
    border-radius:24px;
    overflow:hidden;

}

.booking-card .card-header{

    background:#fff;
    padding:24px 30px;
    border-bottom:1px solid var(--border);

}

.booking-card .card-body{

    padding:30px;

}

.section-title{

    font-size:15px;
    font-weight:700;
    margin-bottom:20px;
    color:#0F172A;

}

.section-divider{

    margin:30px 0;
    border-top:1px solid #E2E8F0;

}

.booking-type{

    border:2px solid #E2E8F0;
    border-radius:20px;
    padding:20px;
    cursor:pointer;
    transition:.25s;

}

.booking-type:hover{

    border-color:#EA580C;
    background:#FFF7ED;

}

.booking-type.active{

    border-color:#EA580C;
    background:#FFF7ED;

}

.booking-type-icon{

    width:56px;
    height:56px;
    border-radius:18px;
    background:#FFF7ED;
    color:#EA580C;
    display:flex;
    justify-content:center;
    align-items:center;
    font-size:24px;

}

.info-box{

    border:1px solid #E2E8F0;
    border-radius:18px;
    background:#F8FAFC;
    padding:22px;

}

.info-title{

    font-size:12px;
    color:#64748B;
    margin-bottom:4px;

}

.info-value{

    font-weight:700;
    color:#0F172A;

}

#manualSection{

    display:none;

}

.required{

    color:#DC2626;

}

.form-label{

    font-weight:600;

}

.summary-card{

    border-radius:18px;
    background:#F8FAFC;
    border:1px solid #E2E8F0;
    padding:20px;
    height:100%;

}

.summary-price{

    font-size:28px;
    color:#16A34A;
    font-weight:800;

}

.summary-duration{

    font-size:26px;
    color:#EA580C;
    font-weight:800;

}

</style>

<div class="booking-wrapper">

<div class="d-flex justify-content-between align-items-center">

<div>

<h3 class="fw-bold mb-1">

Booking Baru

</h3>

<div class="text-secondary">

Tambah reservasi lapangan baru.

</div>

</div>

<a

href="{{ route('admin.courts.bookings') }}"

class="btn btn-light border rounded-pill px-4"

>

<i class="bi bi-arrow-left me-2"></i>

Kembali

</a>

</div>

<form

id="bookingForm"

method="POST"

action="{{ route('admin.courts.bookings.store') }}"

>

@csrf

<input

type="hidden"

name="booking_source"

value="admin"

>

<input

type="hidden"

name="payment_method"

value="cash"

>

<input

type="hidden"

name="payment_status"

value="unpaid"

>

<input

type="hidden"

name="status"

value="approved"

>

<input

type="hidden"

name="total_price"

id="totalPrice"

>

<input

type="hidden"

name="booking_type"

id="bookingType"

value="user"

>

<div class="card booking-card shadow-sm">

<div class="card-header">

<h5 class="fw-bold mb-1">

Data Booking

</h5>

<div class="text-secondary">

Silahkan lengkapi informasi booking.

</div>

</div>

<div class="card-body">

<div class="section-title">

Jenis Booking

</div>

<div class="row g-4">

<div class="col-lg-6">

<div

class="booking-type active"

id="userCard"

>

<div class="d-flex gap-3 align-items-center">

<div class="booking-type-icon">

<i class="bi bi-person-check"></i>

</div>

<div>

<h5 class="fw-bold mb-1">

User Terdaftar

</h5>

<div class="text-secondary">

Booking menggunakan akun yang sudah terdaftar.

</div>

</div>

</div>

</div>

</div>

<div class="col-lg-6">

<div

class="booking-type"

id="manualCard"

>

<div class="d-flex gap-3 align-items-center">

<div class="booking-type-icon">

<i class="bi bi-pencil-square"></i>

</div>

<div>

<h5 class="fw-bold mb-1">

Manual

</h5>

<div class="text-secondary">

Booking customer tanpa akun.

</div>

</div>

</div>

</div>

</div>

</div>

<div class="section-divider"></div>

<div id="userSection">

<div class="section-title">

Informasi Penyewa

</div>

<div class="row g-4">

<div class="col-lg-12">

<label class="form-label">

Pilih User

<span class="required">*</span>

</label>

<select

class="form-select"

name="user_id"

id="userSelect"

>

<option value="">

Pilih User

</option>

@foreach($users as $user)

<option value="{{ $user->id }}">

{{ $user->user_type == 'club' ? '🏀' : '👤' }}

{{ $user->name }}

</option>

@endforeach

{{-- @foreach($users as $user) --}}

{{-- <option value="">👤 Kui</option> --}}

{{-- <option value="">🏀 Pelita Club</option> --}}

</select>

</div>

<div class="col-lg-12">

<div class="info-box">

<div class="row g-4">

<div class="col-md-4">

<div class="info-title">

Nama

</div>

<div

class="info-value"

id="infoName"

>

-

</div>

</div>

<div class="col-md-4">

<div class="info-title">

Club Leader

</div>

<div

class="info-value"

id="infoLeader"

>

-

</div>

</div>

<div class="col-md-4">

<div class="info-title">

User Type

</div>

<div

class="info-value"

id="infoType"

>

-

</div>

</div>

<div class="col-md-4">

<div class="info-title">

Email

</div>

<div

class="info-value"

id="infoEmail"

>

-

</div>

</div>

<div class="col-md-4">

<div class="info-title">

Nomor HP

</div>

<div

class="info-value"

id="infoPhone"

>

-

</div>

</div>

<div class="col-md-4">

<div class="info-title">

Status

</div>

<div

class="info-value"

id="infoStatus"

>

-

</div>

</div>
</div>

</div>

</div>

</div>

</div>

</div>

<div id="manualSection">

<div class="section-title">

Informasi Penyewa

</div>

<div class="row g-4">

<div class="col-lg-6">

<label class="form-label">

Nama Customer

<span class="required">*</span>

</label>

<input

type="text"

class="form-control"

name="customer_name"

id="customerName"

placeholder="Masukkan nama customer"

>

</div>

<div class="col-lg-6">

<label class="form-label">

Nama Club

</label>

<input

type="text"

class="form-control"

name="club_name"

id="clubName"

placeholder="Opsional"

>

</div>

<div class="col-lg-6">

<label class="form-label">

Nomor HP

<span class="required">*</span>

</label>

<input

type="text"

class="form-control"

name="phone"

id="customerPhone"

placeholder="08xxxxxxxxxx"

>

</div>

<div class="col-lg-6">

<label class="form-label">

Email

</label>

<input

type="email"

class="form-control"

name="customer_email"

id="customerEmail"

placeholder="Opsional"

>

</div>

</div>

</div>

<div class="section-divider"></div>

<div class="section-title">

Jadwal Booking

</div>

<div class="row g-4">

<div class="col-lg-4">

<label class="form-label">

Tanggal

<span class="required">*</span>

</label>

<input

type="date"

class="form-control"

name="booking_date"

id="bookingDate"

>

</div>

<div class="col-lg-4">

<label class="form-label">

Jam Mulai

<span class="required">*</span>

</label>

<select

class="form-select"

name="start_time"

id="startTime"

>

<option value="">

Pilih Jam

</option>

</select>

</div>

<div class="col-lg-4">

<label class="form-label">

Jam Selesai

<span class="required">*</span>

</label>

<select

class="form-select"

name="end_time"

id="endTime"

>

<option value="">

Pilih Jam

</option>

</select>

</div>

<div class="col-lg-6">

<div class="summary-card">

<div class="text-secondary mb-2">

Total Durasi

</div>

<div

class="summary-duration"

id="bookingDuration"

>

0 Jam

</div>

<div class="progress mt-3">

<div

class="progress-bar bg-warning"

id="durationProgress"

style="width:0%;"

>

</div>

</div>

</div>

</div>

<div class="col-lg-6">

<div class="summary-card">

<div class="text-secondary mb-2">

Total Harga

</div>

<div

class="summary-price"

id="bookingPrice"

>

Rp 0

</div>

<div class="text-secondary mt-2">

Rp80.000 / Jam

</div>

</div>

</div>

</div>

<div class="section-divider"></div>

<div class="section-title">

Informasi Booking

</div>

<div class="row g-4">

<div class="col-lg-6">

<label class="form-label">

Keperluan

</label>

<select

class="form-select"

name="purpose"

id="purpose"

>

<option value="Main Basket">

Main Basket

</option>

<option value="Latihan Klub">

Latihan Klub

</option>

<option value="Sparing">

Sparing

</option>

<option value="Friendly Match">

Friendly Match

</option>

<option value="Turnamen">

Turnamen

</option>

<option value="Komunitas">

Komunitas

</option>

<option value="Event">

Event

</option>

<option value="Lainnya">

Lainnya

</option>

</select>

</div>

<div class="col-lg-6">

<label class="form-label">

Status Booking

</label>

<input

type="text"

class="form-control"

value="Approved"

readonly

>

</div>

<div class="col-lg-12">

<label class="form-label">

Catatan

</label>

<textarea

class="form-control"

rows="5"

name="notes"

id="notes"

placeholder="Tambahkan catatan jika diperlukan..."

></textarea>

</div>

</div>

<div class="section-divider"></div>

<div class="d-flex justify-content-end gap-3">

<a

href="{{ route('admin.courts.bookings') }}"

class="btn btn-light border rounded-pill px-4"

>

Batal

</a>

<button

type="submit"

class="btn btn-warning text-white rounded-pill px-5"

>

<i class="bi bi-check-circle me-2"></i>

Simpan Booking

</button>

</div>

</div>

</div>

</form>

</div>

<script>

const PRICE_PER_HOUR = 80000;

const userCard=document.getElementById('userCard');

const manualCard=document.getElementById('manualCard');

const userSection=document.getElementById('userSection');

const manualSection=document.getElementById('manualSection');

const bookingType=document.getElementById('bookingType');

const bookingDate=document.getElementById('bookingDate');

const startTime=document.getElementById('startTime');

const endTime=document.getElementById('endTime');

const bookingDuration=document.getElementById('bookingDuration');

const bookingPrice=document.getElementById('bookingPrice');

const durationProgress=document.getElementById('durationProgress');

const totalPrice=document.getElementById('totalPrice');
function toggleBookingMode(type){

    bookingType.value = type;

    if(type === 'user'){

        userCard.classList.add('active');
        manualCard.classList.remove('active');

        userSection.style.display = 'block';
        manualSection.style.display = 'none';

    }else{

        manualCard.classList.add('active');
        userCard.classList.remove('active');

        userSection.style.display = 'none';
        manualSection.style.display = 'block';

    }

}

userCard.addEventListener(

    'click',

    function(){

        toggleBookingMode('user');

    }

);

manualCard.addEventListener(

    'click',

    function(){

        toggleBookingMode('manual');

    }

);

function generateTimeOption(){

    startTime.innerHTML='<option value="">Pilih Jam</option>';
    endTime.innerHTML='<option value="">Pilih Jam</option>';

    // Jam Mulai 08 - 22
    for(let hour=8;hour<=22;hour++){

        const time=String(hour).padStart(2,'0')+':00';

        startTime.innerHTML+=`
            <option value="${time}">
                ${time}
            </option>
        `;

    }

    // Jam Selesai 09 - 23
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

refreshEndTime();

function rupiah(number){

    return new Intl.NumberFormat(

        'id-ID'

    ).format(number);

}

function calculateBooking(){

    if(

        startTime.value=='' ||

        endTime.value==''

    ){

        bookingDuration.innerHTML='0 Jam';

        bookingPrice.innerHTML='Rp 0';

        durationProgress.style.width='0%';

        totalPrice.value='';

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

    totalPrice.value=total;

    durationProgress.style.width=

        Math.min(

            duration*10,

            100

        )+'%';

}


function refreshEndTime(){

    if(startTime.value===''){

        endTime.value='';

        return;

    }

    const start=parseInt(startTime.value);

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

        if(item.booking_date!==selectedDate){

            return;

        }

        const bookingStart =
            parseInt(item.start_time.split(':')[0]);

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
            end > nextBookingStart
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

startTime.addEventListener('change',refreshEndTime);

endTime.addEventListener('change',calculateBooking);


/*

Tanggal minimum hari ini

*/

bookingDate.min=

new Date()

.toISOString()

.split('T')[0];

/*

Jika datang dari Schedule Board

/bookings/create?date=...&start=...

*/

const url=

new URL(

window.location.href

);

const bookingDateParam=

url.searchParams.get(

'date'

);

const bookingStartParam=

url.searchParams.get(

'start'

);

if(

bookingDateParam){
    bookingDate.value=bookingDateParam;}

if(bookingStartParam){
    startTime.value=bookingStartParam;

const next=parseInt(bookingStartParam.split(':')[0])+1;

if(next<=22){
    endTime.value=

    String(next)

    .padStart(2,'0')

    +':00';

}

}

calculateBooking();

/*
|--------------------------------------------------------------------------
| USER INFORMATION
|--------------------------------------------------------------------------
|
| BookingController::create()
| kirim:
|
| $users
|
| lalu di blade:
|
| const users = @json($users);
|
*/

const users=@json($users);

const userSelect=document.getElementById(
    'userSelect'
);



userSelect.addEventListener(

    'change',

    function(){

        const user=

            users.find(

                item=>

                item.id==this.value

            );

        if(!user){

            return;

        }

        document.getElementById(

            'infoName'

        ).innerHTML=

        user.name;

        document.getElementById(

            'infoLeader'

        ).innerHTML=

        user.user_type==='club'

        ?(

            user.club_leader

            ||

            '-'

        )

        :'-';

        document.getElementById(

            'infoType'

        ).innerHTML=

        user.user_type;

        document.getElementById(

            'infoEmail'

        ).innerHTML=

        user.email??

        '-';

        document.getElementById(

            'infoPhone'

        ).innerHTML=

        user.phone??

        '-';

        document.getElementById(

            'infoStatus'

        ).innerHTML=

        user.status??

        '-';

    }

);

/*
|--------------------------------------------------------------------------
| DISABLE TIME
|--------------------------------------------------------------------------
|
| BookingController::create()
|
| kirim:
|
| const bookings=@json($bookings);
|
*/



const bookings=@json($bookings);
const masterSchedules = @json($masterSchedules);

function refreshBookedTime(){

    if(bookingDate.value===''){
        return;
    }

    [...startTime.options].forEach(option => option.disabled = false);
    [...endTime.options].forEach(option => option.disabled = false);

    const selectedDate = bookingDate.value;

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

                if(rule.date!==selectedDate){
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

        [...startTime.options].forEach(function(option){

            if(option.value!==value){
                return;
            }

            if(hasOverride){

                option.disabled=false;
                return;

            }

            option.disabled =
                hasHoliday || hasPractice;

        });

    }

    /*
    |--------------------------------------------------------------------------
    | BOOKING
    |--------------------------------------------------------------------------
    */

    bookings.forEach(function(item){

        if(item.booking_date!==selectedDate){
            return;
        }

        const start =
            parseInt(item.start_time.substring(0,2));

        const end =
            parseInt(item.end_time.substring(0,2));

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

bookingDate.addEventListener(

    'change',

    function(){

        refreshBookedTime();


        startTime.value='';

        endTime.value='';

        calculateBooking();

    }

);

/*
|--------------------------------------------------------------------------
| FORM VALIDATION
|--------------------------------------------------------------------------
*/

document

.getElementById(

    'bookingForm'

)

.addEventListener(

    'submit',

    function(e){

        if(

            bookingType.value==='user'

        ){

            if(

                userSelect.value===''

            ){

                e.preventDefault();

                alert(

                    'Silakan pilih User.'

                );

                return;

            }

        }else{

            if(

                document.getElementById(

                    'customerName'

                ).value.trim()===''

            ){

                e.preventDefault();

                alert(

                    'Nama Customer wajib diisi.'

                );

                return;

            }

            if(

                document.getElementById(

                    'customerPhone'

                ).value.trim()===''

            ){

                e.preventDefault();

                alert(

                    'Nomor HP wajib diisi.'

                );

                return;

            }

        }

        if(

            bookingDate.value===''

        ){

            e.preventDefault();

            alert(

                'Tanggal belum dipilih.'

            );

            return;

        }

        if(

            startTime.value===''

        ){

            e.preventDefault();

            alert(

                'Jam mulai belum dipilih.'

            );

            return;

        }

        if(

            endTime.value===''

        ){

            e.preventDefault();

            alert(

                'Jam selesai belum dipilih.'

            );

            return;

        }

    }

);

toggleBookingMode(

    'user'

);

refreshBookedTime();


</script>

@endsection
