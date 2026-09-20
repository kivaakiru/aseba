@extends('admin.layouts.admin')

@section('title', 'Pengaturan Lapangan')

@section('page-title', 'Pengaturan Lapangan')

@section('page-subtitle', 'Kelola jadwal latihan, hari libur, dan override lapangan.')

@section('content')

<div class="container-fluid px-0">

    {{-- SUMMARY --}}
    <div class="row g-4 mb-4">

        <div class="col-xl-3 col-md-6">

            <div class="setting-summary-card">

                <div class="summary-icon bg-warning-subtle text-warning">

                    <i class="bi bi-dribbble"></i>

                </div>

                <div>

                    <small>Practice</small>

                    <h3 id="practiceCount">

                        {{ $practiceCount ?? 0 }}

                    </h3>

                    <span>Weekly Schedule</span>

                </div>

            </div>

        </div>

        <div class="col-xl-3 col-md-6">

            <div class="setting-summary-card">

                <div class="summary-icon bg-danger-subtle text-danger">

                    <i class="bi bi-calendar-x"></i>

                </div>

                <div>

                    <small>Holiday</small>

                    <h3 id="holidayCount">

                        {{ $holidayCount ?? 0 }}

                    </h3>

                    <span>Holiday Rules</span>

                </div>

            </div>

        </div>

        <div class="col-xl-3 col-md-6">

            <div class="setting-summary-card">

                <div class="summary-icon bg-primary-subtle text-primary">

                    <i class="bi bi-lightning-charge"></i>

                </div>

                <div>

                    <small>Override</small>

                    <h3 id="overrideCount">

                        {{ $overrideCount ?? 0 }}

                    </h3>

                    <span>Special Rules</span>

                </div>

            </div>

        </div>

        <div class="col-xl-3 col-md-6">

            <div class="setting-summary-card">

                <div class="summary-icon bg-success-subtle text-success">

                    <i class="bi bi-check2-circle"></i>

                </div>

                <div>

                    <small>Active Rules</small>

                    <h3 id="totalRule">

                        {{ $totalRule ?? 0 }}

                    </h3>

                    <span>Master Schedule</span>

                </div>

            </div>

        </div>

    </div>

    <div class="row g-4">

        {{-- FORM --}}
        <div class="col-xl-5">

            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-header bg-white">

                    <h5 class="fw-bold mb-1">

                        Schedule Configuration

                    </h5>

                    <small class="text-secondary">

                        Tambahkan aturan baru.

                    </small>

                </div>

                <div class="card-body">

                    <form
                        id="scheduleForm"
                        action="{{ route('admin.courts.settings.store') }}"
                        method="POST">

                        @csrf

                        {{-- MODE --}}

                        <div class="mb-4">

                            <label class="form-label fw-semibold">

                                Category

                            </label>

                            <div class="setting-mode">

                                <button
                                    type="button"
                                    class="setting-mode-btn active"
                                    data-mode="practice">

                                    <i class="bi bi-dribbble me-2"></i>

                                    Practice

                                </button>

                                <button
                                    type="button"
                                    class="setting-mode-btn"
                                    data-mode="holiday">

                                    <i class="bi bi-calendar-x me-2"></i>

                                    Holiday

                                </button>

                                <button
                                    type="button"
                                    class="setting-mode-btn"
                                    data-mode="override">

                                    <i class="bi bi-lightning-charge me-2"></i>

                                    Override

                                </button>

                            </div>

                            <input
                                type="hidden"
                                name="mode"
                                id="mode"
                                value="practice">

                        </div>

                        {{-- TYPE --}}

                        <div class="mb-4">

                            <label class="form-label fw-semibold">

                                Schedule Type

                            </label>

                            <div class="schedule-type-selector">

                                <button
                                    type="button"
                                    class="schedule-type-btn active"
                                    data-type="weekly">

                                    <i class="bi bi-calendar-week me-2"></i>
                                    Weekly

                                </button>

                                <button
                                    type="button"
                                    class="schedule-type-btn"
                                    data-type="daily">

                                    <i class="bi bi-calendar-date me-2"></i>
                                    Daily

                                </button>

                            </div>

                            <input
                                type="hidden"
                                name="schedule_type"
                                id="scheduleType"
                                value="weekly">

                        </div>

                        {{-- DAYS --}}

                        <div class="mb-4">

                            <label class="form-label fw-semibold">

                                Select Day

                            </label>

                            <div class="day-selector">

                                @foreach([
                                    'Monday',
                                    'Tuesday',
                                    'Wednesday',
                                    'Thursday',
                                    'Friday',
                                    'Saturday',
                                    'Sunday'
                                    ] as $day)

                                    <button
                                        type="button"
                                        class="day-btn"
                                        data-day="{{ $day }}">

                                        {{ strtoupper(substr($day,0,2)) }}

                                    </button>

                                @endforeach

                            </div>

                            <input
                                type="hidden"
                                id="selectedDay"
                                name="day_name">

                        </div>

                        {{-- DATE --}}

                        <div class="mb-4">

                            <label class="form-label fw-semibold">

                                Specific Date

                            </label>

                            <input
                                type="date"
                                class="form-control"
                                name="date">

                        </div>

                        {{-- ALL DAY --}}

                        <div class="form-check form-switch mb-4">

                            <input
                                class="form-check-input"
                                type="checkbox"
                                id="allDay"
                                name="all_day">

                            <label class="form-check-label fw-semibold">

                                Full Day

                            </label>

                        </div>

                        {{-- TIME --}}

                        <div class="row g-3 mb-4">

                            <div class="col-6">

                                <label class="form-label">

                                    Start

                                </label>

                                <select
                                    required
                                    class="form-select"
                                    name="start_time"
                                    id="startTime">

                                    <option value="">--:--</option>

                                    @for($hour=8;$hour<=22;$hour++)

                                        <option value="{{ sprintf('%02d:00',$hour) }}">

                                            {{ sprintf('%02d:00',$hour) }}

                                        </option>

                                    @endfor

                                </select>

                            </div>

                            <div class="col-6">

                                <label class="form-label">

                                    End

                                </label>

                                <select
                                    required
                                    class="form-select"
                                    name="end_time"
                                    id="endTime">

                                    <option value="">--:--</option>

                                    @for($hour=9;$hour<=23;$hour++)

                                        <option value="{{ sprintf('%02d:00',$hour) }}">

                                            {{ sprintf('%02d:00',$hour) }}

                                        </option>

                                    @endfor

                                </select>

                            </div>

                        </div>

                        {{-- DESCRIPTION --}}

                        <div class="mb-4">

                            <label class="form-label fw-semibold">

                                Description

                            </label>

                            <textarea
                                required
                                class="form-control"
                                rows="3"
                                name="description"
                                placeholder="Contoh : Latihan Tim Senior"></textarea>

                        </div>

                        <div class="alert alert-primary rounded-4">

                            <strong>Priority Rule</strong>

                            <hr class="my-2">

                            Holiday / Practice

                            <br>

                            ↓

                            <br>

                            Override (membuka jadwal)

                            <br>

                            ↓

                            <br>

                            Booking

                            <br>

                            ↓

                            <br>

                            Available

                        </div>

                        <button
                            type="submit"
                            id="btnSaveSchedule"
                            class="btn btn-warning text-white w-100 py-3 fw-bold">

                            <i class="bi bi-save me-2"></i>

                            Save Schedule

                        </button>

                    </form>

                </div>

            </div>

        </div>

        {{-- PART 2 MULAI DI SINI --}}
        <div class="col-xl-7">

            <div class="card border-0 shadow-sm rounded-4 h-100">

    <div class="card-header bg-white d-flex justify-content-between align-items-center">

        <div>

            <h5 class="fw-bold mb-1">

                Active Schedule Rules

            </h5>

            <small class="text-secondary">

                Seluruh aturan yang sedang aktif.

            </small>

        </div>

        <span class="badge bg-primary rounded-pill px-3 py-2">

            {{ $totalRule ?? 0 }}

            Rules

        </span>

    </div>

    <div class="card-body">

        {{-- FILTER --}}

        <div class="row g-3 mb-4">

            <div class="col-lg-4">

                <select
                    class="form-select"
                    id="ruleType">

                    <option value="">
                        All
                    </option>

                    <option value="weekly">
                        Weekly
                    </option>

                    <option value="daily">
                        Daily
                    </option>

                </select>

            </div>

            <div class="col-lg-5">

                <input
                    type="text"
                    class="form-control"
                    id="ruleSearch"
                    placeholder="Search description...">

            </div>

            <div class="col-lg-3">

                <button
                    class="btn btn-warning text-white w-100">

                    <i class="bi bi-funnel me-2"></i>

                    Filter

                </button>

            </div>

        </div>

        {{-- HEADER --}}

        <div class="rule-header d-none d-lg-grid">

            <div>

                Category

            </div>

            <div>

                Schedule

            </div>

            <div>

                Time

            </div>

            <div>

                Description

            </div>

            <div>

                Action

            </div>

        </div>

        <div id="ruleList">

            @forelse($rules ?? [] as $rule)

            <div
                class="rule-item"
                data-mode="{{ $rule->mode }}"
                data-type="{{ $rule->schedule_type }}"
                data-search="{{ strtolower($rule->description) }}">

                <div>

                    @if($rule->mode=='practice')

                        <span class="badge bg-warning text-dark">

                            Practice

                        </span>

                    @elseif($rule->mode=='holiday')

                        <span class="badge bg-danger">

                            Holiday

                        </span>

                    @else

                        <span class="badge bg-primary">

                            Override

                        </span>

                    @endif

                </div>

                <div>

                    @if($rule->schedule_type=='weekly')

                        Weekly • {{ $rule->day_name }}

                    @else

                        Daily • {{ optional($rule->date)->format('d M Y') }}

                    @endif

                </div>

                <div>

                    @if($rule->all_day)

                        Full Day

                    @else

                        {{ substr($rule->start_time,0,5) }}

                        -

                        {{ substr($rule->end_time,0,5) }}

                    @endif

                </div>

                <div>

                    {{ $rule->description }}

                </div>

                <div class="text-end">

                    <a
                        href="{{ route('admin.courts.settings.edit',$rule) }}"
                        class="btn btn-sm btn-outline-primary">

                        <i class="bi bi-pencil"></i>

                    </a>

                    <form
                        action="{{ route('admin.courts.settings.destroy',$rule) }}"
                        method="POST"
                        class="d-inline delete-form">

                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            class="btn btn-sm btn-outline-danger">

                            <i class="bi bi-trash"></i>

                        </button>

                    </form>

                </div>

            </div>

            @empty

            <div class="text-center py-5">

                <i class="bi bi-calendar-x display-5 text-secondary"></i>

                <h5 class="mt-3">

                    No Schedule

                </h5>

                <p class="text-secondary mb-0">

                    Belum ada aturan yang dibuat.

                </p>

            </div>

            @endforelse

        </div>

    </div>

</div>

</div>

</div>



@endsection

<style>

/* ==========================================
GENERAL
========================================== */

.setting-summary-card{

    background:#FFFFFF;

    border-radius:22px;

    padding:22px;

    display:flex;

    align-items:center;

    gap:18px;

    border:1px solid #E2E8F0;

    box-shadow:0 8px 25px rgba(15,23,42,.05);

    height:100%;

}

.setting-summary-card h3{

    margin:0;

    font-size:28px;

    font-weight:800;

    color:#0F172A;

}

.setting-summary-card small{

    display:block;

    color:#64748B;

    font-weight:700;

}

.setting-summary-card span{

    color:#94A3B8;

    font-size:13px;

}

.summary-icon{

    width:58px;

    height:58px;

    border-radius:18px;

    display:flex;

    justify-content:center;

    align-items:center;

    font-size:24px;

}

/* ==========================================
MODE
========================================== */

.setting-mode{

    display:grid;

    grid-template-columns:repeat(3,1fr);

    gap:10px;

}

.schedule-type-selector{
    display:grid;
    grid-template-columns:repeat(2,1fr);
    gap:12px;
}

.schedule-type-btn{

    flex:1;

    border:2px solid #E2E8F0;

    background:#FFFFFF;

    border-radius:14px;

    padding:14px;

    font-weight:700;

    transition:.25s;

}

.schedule-type-btn:hover{

    border-color:#EA580C;

    background:#FFF7ED;

}

.schedule-type-btn.active{

    background:#EA580C;

    color:#FFFFFF;

    border-color:#EA580C;

}

.setting-mode-btn{

    border:none;

    background:#F8FAFC;

    border:1px solid #E2E8F0;

    border-radius:14px;

    padding:14px;

    font-weight:700;

    transition:.2s;

}

.setting-mode-btn:hover{

    border-color:#EA580C;

}

.setting-mode-btn.active{

    background:#EA580C;

    color:#fff;

    border-color:#EA580C;

}

/* ==========================================
DAY
========================================== */

.day-selector{

    display:grid;

    grid-template-columns:repeat(7,1fr);

    gap:10px;

}

.day-btn{

    border:none;

    background:#F8FAFC;

    border:1px solid #E2E8F0;

    border-radius:12px;

    height:52px;

    font-weight:700;

    transition:.2s;

}

.day-btn:hover{

    border-color:#EA580C;

}

.day-btn.active{

    background:#EA580C;

    color:#fff;

    border-color:#EA580C;

}

/* ==========================================
RULE
========================================== */

.rule-header{

    display:grid;

    grid-template-columns:

    120px

    190px

    150px

    1fr

    90px;

    gap:16px;

    padding:0 18px 14px;

    color:#64748B;

    font-size:13px;

    font-weight:700;

}

#ruleList{

    display:flex;

    flex-direction:column;

    gap:12px;

}

.rule-item{

    display:grid;

    grid-template-columns:

    120px

    190px

    150px

    1fr

    90px;

    gap:16px;

    align-items:center;

    padding:18px;

    background:#FFFFFF;

    border:1px solid #E2E8F0;

    border-radius:18px;

    transition:.2s;

}

.rule-item:hover{

    border-color:#EA580C;

    background:#FFF7ED;

}

/* ==========================================
PREVIEW
========================================== */

.schedule-preview{

    overflow:auto;

}

.schedule-preview table{

    min-width:1100px;

}

.schedule-preview th{

    background:#F8FAFC;

    text-align:center;

    font-size:13px;

    font-weight:700;

    vertical-align:middle;

}

.schedule-preview td{

    padding:0;

    height:54px;

}

.preview-slot{

    width:100%;

    height:54px;

    border:none;

    background:#FFFFFF;

    transition:.2s;

    font-size:12px;

    font-weight:600;

}

.preview-slot:hover{

    background:#F8FAFC;

}

.preview-slot.available{

    background:#FFFFFF;

    color:#64748B;

}

.preview-slot.practice{

    background:#FFF7ED;

    color:#EA580C;

}

.preview-slot.holiday{

    background:#FEF2F2;

    color:#DC2626;

}

.preview-slot.override{

    background:#EFF6FF;

    color:#2563EB;

}

.preview-slot.booked{

    background:#DCFCE7;

    color:#166534;

}

/* ==========================================
FORM
========================================== */

.form-control,

.form-select{

    border-radius:14px;

    min-height:48px;

}

textarea.form-control{

    min-height:120px;

}

.form-check{

    border:1px solid #E2E8F0;

    border-radius:14px;

    padding:14px 18px 14px 42px;

}

.form-switch{

    padding-top:8px;

    padding-bottom:8px;

}

/* ==========================================
MOBILE
========================================== */

@media(max-width:991px){

.rule-header{

display:none;

}

.rule-item{

grid-template-columns:1fr;

gap:10px;

}

.rule-item>div:last-child{

text-align:left!important;

}

.schedule-preview table{

min-width:900px;

}

}

@media(max-width:767px){

.setting-summary-card{

padding:18px;

}

.summary-icon{

width:50px;

height:50px;

font-size:20px;

}

.setting-mode{

grid-template-columns:1fr;

}

.day-selector{

grid-template-columns:repeat(4,1fr);

}

.form-check{

padding-left:40px;

}

.rule-item{

padding:14px;

}

.schedule-preview table{

min-width:820px;

}

}

</style>

<script>

document.addEventListener('DOMContentLoaded',function(){
    const masterRules = @json($masterSchedules);
    const btnSave = document.getElementById('btnSaveSchedule');

    function hourToInt(value){

        return parseInt(value.split(':')[0]);

    }

        function overlap(start1,end1,start2,end2){

        return start1 < end2 && end1 > start2;

    }

    function selectedKey(){

        if(scheduleTypeInput.value==='weekly'){
            return hiddenDay.value;
        }

        return document.querySelector('input[name="date"]').value;

    }

    function refreshRuleAvailability(){

    const key = selectedKey();

    if(!key){
        btnSave.disabled = false;
        return;
    }

    const startHour = parseInt(start.value || 0);
    const endHour   = parseInt(end.value || 0);

    let overlapFound = false;

    masterRules.forEach(function(rule){

        const sameSchedule =
            (
                rule.schedule_type === 'weekly' &&
                scheduleTypeInput.value === 'weekly' &&
                rule.day_name === key
            )
            ||
            (
                rule.schedule_type === 'daily' &&
                scheduleTypeInput.value === 'daily' &&
                rule.date === key
            );

        if(!sameSchedule){
            return;
        }

        if(rule.all_day){
            overlapFound = true;
            return;
        }

        const ruleStart = parseInt(rule.start);
        const ruleEnd   = parseInt(rule.end);

        if(
            startHour &&
            endHour &&
            overlap(startHour,endHour,ruleStart,ruleEnd)
        ){
            overlapFound = true;
        }

    });

    btnSave.disabled = overlapFound;

    if(overlapFound){

        btnSave.classList.remove('btn-warning');

        btnSave.classList.add('btn-danger');

        btnSave.innerHTML =
            '<i class="bi bi-lock-fill me-2"></i>Jadwal sudah digunakan';

    }else{

        btnSave.classList.remove('btn-danger');

        btnSave.classList.add('btn-warning');

        btnSave.innerHTML =
            '<i class="bi bi-save me-2"></i>Save Schedule';

    }

}

/* ==========================================
MODE
========================================== */

const modeInput=document.getElementById('mode');

document.querySelectorAll('.setting-mode-btn').forEach(function(btn){

    btn.addEventListener('click',function(){

        document.querySelectorAll('.setting-mode-btn').forEach(function(b){

            b.classList.remove('active');

        });

        this.classList.add('active');

        modeInput.value=this.dataset.mode;

    });

});

const scheduleTypeInput =
    document.getElementById('scheduleType');

document
.querySelectorAll('.schedule-type-btn')
.forEach(button=>{

    button.onclick=function(){

        document
        .querySelectorAll('.schedule-type-btn')
        .forEach(x=>x.classList.remove('active'));

        this.classList.add('active');

        scheduleTypeInput.value=this.dataset.type;

        toggleScheduleType();

    };

});

/* ==========================================
DAY SELECTOR
========================================== */

const hiddenDay = document.getElementById('selectedDay');

document.querySelectorAll('.day-btn').forEach(function(btn){

    btn.addEventListener('click',function(){

        document.querySelectorAll('.day-btn').forEach(function(item){

            item.classList.remove('active');

        });

        this.classList.add('active');

        hiddenDay.value = this.dataset.day;

        hiddenDay.dispatchEvent(new Event('change'));

    });

});

/* ==========================================
WEEKLY / DAILY
========================================== */

const daySelector =
    document.querySelector('.day-selector').closest('.mb-4');

const datePicker =
    document.querySelector('input[name="date"]').closest('.mb-4');

function toggleScheduleType(){

    if(scheduleTypeInput.value === 'weekly'){

        daySelector.style.display='block';

        datePicker.style.display='none';

    }else{

        daySelector.style.display='none';

        datePicker.style.display='block';

    }



    refreshRuleAvailability();

}

toggleScheduleType();

/* ==========================================
ALL DAY
========================================== */

const allDay=document.getElementById('allDay');

const start=document.getElementById('startTime');

const end=document.getElementById('endTime');

function toggleAllDay(){

    if(allDay.checked){

        start.value='08:00';

        end.value='23:00';

        start.disabled=true;

        end.disabled=true;

        start.classList.add('bg-light');

        end.classList.add('bg-light');

    }else{

        start.disabled=false;

        end.disabled=false;

        start.classList.remove('bg-light');

        end.classList.remove('bg-light');

    }

}

allDay.addEventListener('change',toggleAllDay);

toggleAllDay();
function refreshEndTime(){

    if(start.disabled){
        return;
    }

    if(start.value===''){
        end.value='';
        return;
    }

    const startHour=parseInt(start.value);

    [...end.options].forEach(function(option){

        if(option.value===''){
            return;
        }

        option.disabled =
            parseInt(option.value)<=startHour;

    });

    if(
        end.value==='' ||
        end.selectedOptions.length===0 ||
        end.options[end.selectedIndex].disabled
    ){

        for(const option of end.options){

            if(option.value!=='' && !option.disabled){

                end.value=option.value;
                break;

            }

        }

    }

}

start.addEventListener('change',refreshEndTime);

refreshEndTime();

refreshRuleAvailability();

start.addEventListener('change',refreshRuleAvailability);

end.addEventListener('change',refreshRuleAvailability);

hiddenDay.addEventListener('change',refreshRuleAvailability);

document
.querySelector('input[name="date"]')
.addEventListener('change',refreshRuleAvailability);

scheduleTypeInput.addEventListener('change',refreshRuleAvailability);

allDay.addEventListener('change',refreshRuleAvailability);

/* ==========================================
FILTER RULE
========================================== */

const ruleSearch=document.getElementById('ruleSearch');

const ruleType=document.getElementById('ruleType');

function filterRule(){

    document.querySelectorAll('.rule-item').forEach(function(item){

        const type = item.dataset.type || '';

        const keyword=item.dataset.search||'';

        let show=true;

        if(

            ruleType.value!=='' &&

            type!==ruleType.value

        ){

            show=false;

        }

        if(

            ruleSearch.value!=='' &&

            !keyword.includes(

                ruleSearch.value.toLowerCase()

            )

        ){

            show=false;

        }

        item.style.display=show?'grid':'none';

    });

}

ruleSearch.addEventListener('keyup',filterRule);

ruleType.addEventListener('change',filterRule);

/* ==========================================
PREVIEW DEMO
========================================== */

document.querySelectorAll('.preview-slot').forEach(function(slot){

    slot.addEventListener('click',function(){

        this.classList.remove(

            'available',

            'practice',

            'holiday',

            'override'

        );

        this.classList.remove('booked');
        switch(modeInput.value){

            case'practice':

                this.classList.add('practice');

                this.innerHTML='Practice';

                break;

            case'holiday':

                this.classList.add('holiday');

                this.innerHTML='Holiday';

                break;

            case'override':

                this.classList.add('override');

                this.innerHTML='Override';

                break;

        }

    });

});

/* ==========================================
SAVE DEMO
========================================== */



});



</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

document.querySelectorAll('.delete-form').forEach(function(form){

    form.addEventListener('submit',function(e){

        e.preventDefault();

        Swal.fire({

            title:'Hapus Pengaturan?',

            text:'Data yang dihapus tidak dapat dikembalikan.',

            icon:'warning',

            showCancelButton:true,

            confirmButtonColor:'#dc3545',

            cancelButtonColor:'#6c757d',

            confirmButtonText:'Ya, Hapus',

            cancelButtonText:'Batal'

        }).then(function(result){

            if(result.isConfirmed){

                form.submit();

            }

        });

    });

});

</script>

