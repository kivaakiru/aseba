@extends('admin.layouts.admin')

@section('title', 'Edit Pengaturan Lapangan')

@section('page-title', 'Edit Pengaturan Lapangan')

@section('page-subtitle', 'Perbarui aturan jadwal latihan, hari libur, atau override.')

@section('content')

<div class="container-fluid">

    <div class="row justify-content-center">

        <div class="col-xl-8">

            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-header bg-white py-3">

                    <h4 class="fw-bold mb-1">

                        Edit Schedule Rule

                    </h4>

                    <small class="text-secondary">

                        Perbarui informasi rule yang dipilih.

                    </small>

                </div>

                <div class="card-body">

                    <form
                        action="{{ route('admin.courts.settings.update', $schedule) }}"
                        method="POST">

                        @csrf
                        @method('PUT')

                        {{-- MODE --}}

                        <div class="mb-4">

                            <label class="form-label fw-semibold">

                                Category

                            </label>

                            <div class="setting-mode">

                                <button
                                    type="button"
                                    class="setting-mode-btn {{ $schedule->mode=='practice' ? 'active' : '' }}"
                                    data-mode="practice">

                                    <i class="bi bi-dribbble me-2"></i>

                                    Practice

                                </button>

                                <button
                                    type="button"
                                    class="setting-mode-btn {{ $schedule->mode=='holiday' ? 'active' : '' }}"
                                    data-mode="holiday">

                                    <i class="bi bi-calendar-x me-2"></i>

                                    Holiday

                                </button>

                                <button
                                    type="button"
                                    class="setting-mode-btn {{ $schedule->mode=='override' ? 'active' : '' }}"
                                    data-mode="override">

                                    <i class="bi bi-lightning-charge me-2"></i>

                                    Override

                                </button>

                            </div>

                            <input
                                type="hidden"
                                id="mode"
                                name="mode"
                                value="{{ $schedule->mode }}">

                        </div>

                        {{-- TYPE --}}

                        <div class="mb-4">

                            <label class="form-label fw-semibold">

                                Schedule Type

                            </label>

                            <div class="row">

                                <div class="col-md-6">

                                    <div class="form-check">

                                        <input
                                            class="form-check-input"
                                            type="radio"
                                            name="schedule_type"
                                            value="weekly"
                                            {{ $schedule->schedule_type=='weekly' ? 'checked' : '' }}>

                                        <label class="form-check-label">

                                            Weekly

                                        </label>

                                    </div>

                                </div>

                                <div class="col-md-6">

                                    <div class="form-check">

                                        <input
                                            class="form-check-input"
                                            type="radio"
                                            name="schedule_type"
                                            value="daily"
                                            {{ $schedule->schedule_type=='daily' ? 'checked' : '' }}>

                                        <label class="form-check-label">

                                            Daily

                                        </label>

                                    </div>

                                </div>

                            </div>

                        </div>

                        {{-- DAY --}}

                        <div
                            class="mb-4"
                            id="dayWrapper">

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
                                        class="day-btn {{ $schedule->day_name==$day ? 'active' : '' }}"
                                        data-day="{{ $day }}">

                                        {{ strtoupper(substr($day,0,2)) }}

                                    </button>

                                @endforeach

                            </div>

                            <input
                                type="hidden"
                                id="selectedDay"
                                name="day_name"
                                value="{{ $schedule->day_name }}">

                        </div>

                        {{-- DATE --}}

                        <div
                            class="mb-4"
                            id="dateWrapper">

                            <label class="form-label fw-semibold">

                                Specific Date

                            </label>

                            <input
                                type="date"
                                class="form-control"
                                name="date"
                                value="{{ optional($schedule->date)->format('Y-m-d') }}">

                        </div>

                                                {{-- ALL DAY --}}

                        <div class="form-check form-switch mb-4">

                            <input
                                class="form-check-input"
                                type="checkbox"
                                id="allDay"
                                name="all_day"
                                {{ $schedule->all_day ? 'checked' : '' }}>

                            <label class="form-check-label fw-semibold">

                                Full Day

                            </label>

                        </div>

                        {{-- TIME --}}

                        <div class="row g-3 mb-4">

                            <div class="col-md-6">

                                <label class="form-label fw-semibold">

                                    Start Time

                                </label>

                                <select
                                    class="form-select"
                                    id="startTime"
                                    name="start_time">

                                    <option value="">--:--</option>

                                    @for($hour=8;$hour<=22;$hour++)

                                        @php
                                            $time=sprintf('%02d:00',$hour);
                                        @endphp

                                        <option
                                            value="{{ $time }}"
                                            {{ substr($schedule->start_time,0,5)==$time ? 'selected' : '' }}>

                                            {{ $time }}

                                        </option>

                                    @endfor

                                </select>

                            </div>

                            <div class="col-md-6">

                                <label class="form-label fw-semibold">

                                    End Time

                                </label>

                                <select
                                    class="form-select"
                                    id="endTime"
                                    name="end_time">

                                    <option value="">--:--</option>

                                    @for($hour=9;$hour<=23;$hour++)

                                        @php
                                            $time=sprintf('%02d:00',$hour);
                                        @endphp

                                        <option
                                            value="{{ $time }}"
                                            {{ substr($schedule->end_time,0,5)==$time ? 'selected' : '' }}>

                                            {{ $time }}

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
                                class="form-control"
                                rows="4"
                                name="description"
                                required>{{ $schedule->description }}</textarea>

                        </div>

                        <div class="d-flex justify-content-between">

                            <a
                                href="{{ route('admin.courts.settings') }}"
                                class="btn btn-light px-4">

                                <i class="bi bi-arrow-left me-2"></i>

                                Cancel

                            </a>

                            <button
                                type="submit"
                                class="btn btn-warning text-white px-5">

                                <i class="bi bi-save me-2"></i>

                                Update Schedule

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection

<style>

.setting-mode{

    display:grid;

    grid-template-columns:repeat(3,1fr);

    gap:10px;

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

.setting-mode-btn.active{

    background:#EA580C;

    color:#fff;

    border-color:#EA580C;

}

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

}

.day-btn.active{

    background:#EA580C;

    color:#fff;

    border-color:#EA580C;

}

.form-control,
.form-select{

    min-height:48px;

    border-radius:14px;

}

textarea{

    min-height:130px;

}

@media(max-width:768px){

    .setting-mode{

        grid-template-columns:1fr;

    }

    .day-selector{

        grid-template-columns:repeat(4,1fr);

    }

}

</style>
<script>

document.addEventListener('DOMContentLoaded',function(){

    /*=========================================
    MODE
    =========================================*/

    const modeInput=document.getElementById('mode');

    document.querySelectorAll('.setting-mode-btn').forEach(function(btn){

        btn.addEventListener('click',function(){

            document
                .querySelectorAll('.setting-mode-btn')
                .forEach(function(item){

                    item.classList.remove('active');

                });

            this.classList.add('active');

            modeInput.value=this.dataset.mode;

        });

    });

    /*=========================================
    DAY SELECTOR
    =========================================*/

    const hiddenDay=document.getElementById('selectedDay');

    document.querySelectorAll('.day-btn').forEach(function(btn){

        btn.addEventListener('click',function(){

            document
                .querySelectorAll('.day-btn')
                .forEach(function(item){

                    item.classList.remove('active');

                });

            this.classList.add('active');

            hiddenDay.value=this.dataset.day;

        });

    });

    /*=========================================
    WEEKLY / DAILY
    =========================================*/

    const weekly=document.querySelector('input[value="weekly"]');
    const daily=document.querySelector('input[value="daily"]');

    const dayWrapper=document.getElementById('dayWrapper');
    const dateWrapper=document.getElementById('dateWrapper');

    function refreshScheduleType(){

        if(weekly.checked){

            dayWrapper.style.display='block';

            dateWrapper.style.display='none';

        }else{

            dayWrapper.style.display='none';

            dateWrapper.style.display='block';

        }

    }

    weekly.addEventListener('change',refreshScheduleType);

    daily.addEventListener('change',refreshScheduleType);

    refreshScheduleType();

    /*=========================================
    ALL DAY
    =========================================*/

    const allDay=document.getElementById('allDay');

    const start=document.getElementById('startTime');

    const end=document.getElementById('endTime');

    function toggleAllDay(){

        if(allDay.checked){

            start.value='08:00';

            end.value='23:00';

            start.disabled=true;

            end.disabled=true;

        }else{

            start.disabled=false;

            end.disabled=false;

            refreshEndTime();

        }

    }

    allDay.addEventListener('change',toggleAllDay);

    /*=========================================
    END TIME
    =========================================*/

    function refreshEndTime(){

        if(start.disabled){

            return;

        }

        if(start.value===''){

            return;

        }

        const startHour=parseInt(start.value);

        [...end.options].forEach(function(option){

            if(option.value===''){

                return;

            }

            option.disabled=parseInt(option.value)<=startHour;

        });

        if(

            end.value=='' ||

            end.options[end.selectedIndex].disabled

        ){

            for(const option of end.options){

                if(

                    option.value!=='' &&

                    !option.disabled

                ){

                    end.value=option.value;

                    break;

                }

            }

        }

    }

    start.addEventListener('change',refreshEndTime);

    toggleAllDay();

    refreshEndTime();

});

</script>
