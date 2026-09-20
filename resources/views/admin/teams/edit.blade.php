@extends('admin.layouts.admin')

@section('title','Edit Tim')

@section('page-title','Database Tim')

@section('page-subtitle','Perbarui informasi tim')

@section('content')

<div class="container-fluid">

    <div class="team-header mb-5">

        <div class="row align-items-end g-4">

            <div class="col-lg-8">

                <span class="page-label">

                    DATABASE TIM

                </span>

                <h1 class="page-heading">

                    EDIT <span>TIM.</span>

                </h1>

            </div>

            <div class="col-lg-4 text-lg-end">

                <a

                    href="{{ route('admin.teams.show',$team->id) }}"

                    class="btn btn-back">

                    <i class="bi bi-arrow-left me-2"></i>

                    KEMBALI

                </a>

            </div>

        </div>

    </div>

    @if($errors->any())

    <div class="alert alert-danger border-0 rounded-4 shadow-sm mb-4">

        <strong>

            Terjadi kesalahan.

        </strong>

        <ul class="mb-0 mt-2">

            @foreach($errors->all() as $error)

                <li>{{ $error }}</li>

            @endforeach

        </ul>

    </div>

    @endif

    <form

        action="{{ route('admin.teams.update',$team->id) }}"

        method="POST">

        @csrf

        @method('PUT')

        <div class="row g-4">

            <!-- LEFT -->

            <div class="col-lg-4">

                <div class="form-card">

                    <div class="card-title">

                        Ringkasan Tim

                    </div>

                    <div class="team-logo">

                        {{ strtoupper(substr($team->name,0,1)) }}

                    </div>

                    <div class="team-preview">

                        <h4 id="previewName">

                            {{ old('name',$team->name) }}

                        </h4>

                        <span id="previewCategory">

                            {{ old('category',$team->category) }}

                        </span>

                    </div>

                    <hr>

                    <div class="text-center">

                        <span class="badge-player">

                            {{ $team->players->count() }}

                            Pemain

                        </span>

                    </div>

                </div>

            </div>

            <!-- RIGHT -->

            <div class="col-lg-8">

                <div class="form-card">

                    <div class="card-title mb-4">

                        Informasi Tim

                    </div>

                    <div class="row g-4">

                        <div class="col-md-6">

                            <label class="form-label">

                                Nama Tim <span>*</span>

                            </label>

                            <input

                                type="text"

                                id="teamName"

                                name="name"

                                class="form-control"

                                value="{{ old('name',$team->name) }}"

                                required>

                        </div>

                        <div class="col-md-6">

                            <label class="form-label">

                                Kategori <span>*</span>

                            </label>

                            <select

                                id="teamCategory"

                                name="category"

                                class="form-select"

                                required>

                                @foreach(['U-8','U-10','U-12','U-14','U-16','U-18','Senior'] as $cat)

                                <option

                                    value="{{ $cat }}"

                                    {{ old('category',$team->category)==$cat?'selected':'' }}>

                                    {{ $cat }}

                                </option>

                                @endforeach

                            </select>

                        </div>

                        <div class="col-12">

                            <label class="form-label">

                                Deskripsi

                            </label>

                            <textarea

                                name="description"

                                class="form-control"

                                rows="4">{{ old('description',$team->description) }}</textarea>

                        </div>

                    </div>

                </div>

                <!-- PLAYER -->

                <div class="form-card mt-4">

                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">

                        <div>

                            <div class="card-title">

                                Kelola Anggota Tim

                            </div>

                            <small class="text-muted">

                                Centang pemain untuk masuk ke tim ini.

                            </small>

                        </div>

                        <span class="badge-player">

                            {{ $players->count() }}

                            Atlet

                        </span>

                    </div>

                    <div class="search-player">

                        <i class="bi bi-search"></i>

                        <input

                            type="text"

                            id="playerSearch"

                            class="form-control"

                            placeholder="Cari nama pemain...">

                    </div>

                    <div class="player-wrapper">

                                                <div class="table-responsive">

                            <table class="table align-middle team-table">

                                <thead>

                                    <tr>

                                        <th width="55">

                                            Pilih

                                        </th>

                                        <th>

                                            Nama

                                        </th>

                                        <th width="90">

                                            No

                                        </th>

                                        <th width="170">

                                            Posisi

                                        </th>

                                        <th width="90">

                                            Umur

                                        </th>

                                        <th width="160">

                                            Status

                                        </th>

                                    </tr>

                                </thead>

                                <tbody>

                                    @forelse($players as $player)

                                    @php

                                        $disabled = !is_null($player->team_id) && $player->team_id != $team->id;

                                        $checked = $player->team_id == $team->id;

                                        $position=[

                                            'PG'=>'Point Guard',

                                            'SG'=>'Shooting Guard',

                                            'SF'=>'Small Forward',

                                            'PF'=>'Power Forward',

                                            'C'=>'Center',

                                        ];

                                    @endphp

                                    <tr class="player-row {{ $disabled ? 'table-secondary' : '' }}">

                                        <td>

                                            <input

                                                class="form-check-input"

                                                type="checkbox"

                                                name="players[]"

                                                value="{{ $player->id }}"

                                                {{ $checked ? 'checked' : '' }}

                                                {{ $disabled ? 'disabled' : '' }}>

                                        </td>

                                        <td>

                                            <div class="player-info">

                                                <strong>

                                                    {{ $player->full_name }}

                                                </strong>

                                                <small>

                                                    {{ $player->jersey_name }}

                                                </small>

                                            </div>

                                        </td>

                                        <td>

                                            #{{ $player->jersey_number ?: '-' }}

                                        </td>

                                        <td>

                                            {{ $position[$player->position] ?? '-' }}

                                        </td>

                                        <td>

                                            {{ $player->age }}

                                        </td>

                                        <td>

                                            @if($disabled)

                                                <span class="badge bg-secondary">

                                                    {{ $player->team->name }}

                                                </span>

                                            @elseif($checked)

                                                <span class="badge bg-primary">

                                                    Tim Ini

                                                </span>

                                            @else

                                                <span class="badge bg-success">

                                                    Tersedia

                                                </span>

                                            @endif

                                        </td>

                                    </tr>

                                    @empty

                                    <tr>

                                        <td colspan="6"

                                            class="text-center py-5 text-muted">

                                            Belum ada pemain.

                                        </td>

                                    </tr>

                                    @endforelse

                                </tbody>

                            </table>

                        </div>

                </div>

                <div class="form-card mt-4">

                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                        <div>

                            <h5 class="fw-bold mb-1">

                                Simpan Perubahan

                            </h5>

                            <small class="text-muted">

                                Perubahan anggota tim akan langsung diperbarui.

                            </small>

                        </div>

                        <div class="d-flex gap-2">

                            <a

                                href="{{ route('admin.teams.show',$team->id) }}"

                                class="btn btn-light btn-cancel">

                                Batal

                            </a>

                            <button

                                type="submit"

                                class="btn btn-save">

                                <i class="bi bi-floppy-fill me-2"></i>

                                SIMPAN PERUBAHAN

                            </button>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </form>

</div>

<style>

.page-label{

    display:block;

    color:#EA580C;

    font-size:11px;

    font-weight:800;

    letter-spacing:.45em;

    margin-bottom:14px;

}

.page-heading{

    margin:0;

    font-size:58px;

    font-weight:900;

    font-style:italic;

    letter-spacing:-2px;

    color:#0F172A;

}

.page-heading span{

    color:#EA580C;

}

.form-card{

    background:#fff;

    border-radius:28px;

    padding:28px;

    box-shadow:0 20px 45px rgba(15,23,42,.05);

}

.team-logo{

    width:120px;

    height:120px;

    margin:auto;

    border-radius:50%;

    background:#EA580C;

    color:#fff;

    display:flex;

    align-items:center;

    justify-content:center;

    font-size:48px;

    font-weight:900;

}

.team-preview{

    text-align:center;

    margin-top:20px;

}

.team-preview h4{

    margin-bottom:6px;

    font-weight:800;

    color:#0F172A;

}

.team-preview span{

    color:#64748B;

    font-weight:600;

}

.card-title{

    font-size:13px;

    text-transform:uppercase;

    letter-spacing:.18em;

    color:#EA580C;

    font-weight:800;

}

.form-label{

    font-weight:700;

    color:#0F172A;

    margin-bottom:8px;

}

.form-label span{

    color:#EA580C;

}

.form-control,

.form-select{

    height:56px;

    border-radius:16px;

    border:1px solid #E2E8F0;

    box-shadow:none!important;

    font-weight:600;

}

textarea.form-control{

    min-height:120px;

    height:auto;

    resize:none;

    padding-top:15px;

}

.form-control:focus,

.form-select:focus{

    border-color:#EA580C;

    box-shadow:0 0 0 .18rem rgba(234,88,12,.15)!important;

}

.search-player{

    position:relative;

    margin-bottom:20px;

}

.search-player i{

    position:absolute;

    left:18px;

    top:50%;

    transform:translateY(-50%);

    color:#94A3B8;

    z-index:10;

}

.search-player input{

    padding-left:50px;

}

.player-wrapper{

    max-height:520px;

    overflow:auto;

}

.team-table thead th{

    background:#F8FAFC;

    border:none;

    color:#64748B;

    font-size:13px;

    text-transform:uppercase;

    letter-spacing:.08em;

}

.team-table tbody td{

    vertical-align:middle;

}

.player-row{

    transition:.25s;

}

.player-row:hover{

    background:#FFF7ED;

}

.player-info{

    display:flex;

    flex-direction:column;

}

.player-info strong{

    color:#0F172A;

}

.player-info small{

    color:#94A3B8;

}

.badge-player{

    background:#FFF7ED;

    color:#EA580C;

    padding:8px 14px;

    border-radius:30px;

    font-weight:700;

}

.btn-save{

    background:#EA580C;

    color:#fff;

    border:none;

    border-radius:16px;

    padding:14px 28px;

    font-weight:800;

}

.btn-save:hover{

    background:#C2410C;

    color:#fff;

}

.btn-back{

    background:#fff;

    border:1px solid #E2E8F0;

    border-radius:16px;

    padding:14px 26px;

    font-weight:800;

}

.btn-back:hover{

    background:#0F172A;

    color:#fff;

}

.btn-cancel{

    border-radius:16px;

    padding:14px 22px;

    font-weight:700;

}

@media(max-width:992px){

    .page-heading{

        font-size:42px;

    }

}

@media(max-width:768px){

    .page-heading{

        font-size:32px;

    }

    .form-card{

        padding:20px;

        border-radius:22px;

    }

    .team-logo{

        width:90px;

        height:90px;

        font-size:34px;

    }

    .player-wrapper{

        max-height:none;

    }

    .btn-save,

    .btn-back,

    .btn-cancel{

        width:100%;

    }

    .d-flex.gap-2{

        width:100%;

        flex-direction:column;

    }

}

</style>

<script>

const teamName=document.getElementById('teamName');

const teamCategory=document.getElementById('teamCategory');

const previewName=document.getElementById('previewName');

const previewCategory=document.getElementById('previewCategory');

const logo=document.querySelector('.team-logo');

teamName.addEventListener('keyup',function(){

    previewName.innerText=this.value||'Nama Tim';

    logo.innerText=(this.value||'T').charAt(0).toUpperCase();

});

teamCategory.addEventListener('change',function(){

    previewCategory.innerText=this.value||'Kategori';

});

const searchPlayer=document.getElementById('playerSearch');

const rows=document.querySelectorAll('.player-row');

searchPlayer.addEventListener('keyup',function(){

    const keyword=this.value.toLowerCase();

    rows.forEach(row=>{

        row.style.display=row.innerText.toLowerCase().includes(keyword)?'':'none';

    });

});

</script>

@endsection
