@extends('admin.layouts.admin')

@section('title','Detail Tim')

@section('page-title','Database Tim')

@section('page-subtitle','Informasi lengkap tim')

@section('content')

<div class="container-fluid">

    <div class="team-header mb-5">

        <div class="row align-items-end g-4">

            <div class="col-lg-8">

                <span class="page-label">

                    DATABASE TIM

                </span>

                <h1 class="page-heading">

                    PROFIL <span>TIM.</span>

                </h1>

            </div>

            <div class="col-lg-4 text-lg-end">

                <a

                    href="{{ route('admin.teams.index') }}"

                    class="btn btn-back">

                    <i class="bi bi-arrow-left me-2"></i>

                    KEMBALI

                </a>

            </div>

        </div>

    </div>

    <div class="row g-4">

        <!-- LEFT -->

        <div class="col-xl-4">

            <div class="profile-card">

                <div class="team-logo">

                    {{ strtoupper(substr($team->name,0,1)) }}

                </div>

                <div class="team-preview">

                    <h2>

                        {{ $team->name }}

                    </h2>

                    <span>

                        {{ $team->category }}

                    </span>

                </div>

                <hr>

                <div class="summary-list">

                    <div>

                        <small>

                            Total Atlet

                        </small>

                        <h5>

                            {{ $players->count() }}

                        </h5>

                    </div>

                    <div>

                        <small>

                            Kategori

                        </small>

                        <h5>

                            {{ $team->category }}

                        </h5>

                    </div>

                </div>

            </div>

        </div>

        <!-- RIGHT -->

        <div class="col-xl-8">

            <div class="form-card">

                <div class="card-title">

                    Informasi Tim

                </div>

                <div class="row mt-3 g-4">

                    <div class="col-md-6">

                        <div class="detail-box">

                            <label>

                                Nama Tim

                            </label>

                            <h5>

                                {{ $team->name }}

                            </h5>

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="detail-box">

                            <label>

                                Kategori

                            </label>

                            <h5>

                                {{ $team->category }}

                            </h5>

                        </div>

                    </div>

                    <div class="col-12">

                        <div class="detail-box">

                            <label>

                                Deskripsi

                            </label>

                            <p class="mb-0">

                                {{ $team->description ?: 'Belum ada deskripsi.' }}

                            </p>

                        </div>

                    </div>

                </div>

            </div>

            <div class="form-card mt-4">

                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">

                    <div>

                        <div class="card-title">

                            Daftar Atlet

                        </div>

                        <small class="text-muted">

                            {{ $players->count() }} pemain terdaftar.

                        </small>

                    </div>

                    <span class="badge-player">

                        {{ $players->count() }}

                        Pemain

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

                <div class="table-responsive">

                    <table class="table align-middle team-table">

                        <thead>

                            <tr>

                                <th>Nama</th>

                                <th>No</th>

                                <th>Posisi</th>

                                <th>Umur</th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($players as $player)

                            @php

                            $position=[

                            'PG'=>'Point Guard',

                            'SG'=>'Shooting Guard',

                            'SF'=>'Small Forward',

                            'PF'=>'Power Forward',

                            'C'=>'Center',

                            ];

                            @endphp

                            <tr class="player-row">

                                <td>

                                    <strong>

                                        {{ $player->full_name }}

                                    </strong>

                                    <br>

                                    <small class="text-muted">

                                        {{ $player->jersey_name }}

                                    </small>

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

                            </tr>

                            @empty

                            <tr>

                                <td colspan="4"

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

                            Manajemen Tim

                        </h5>

                        <small class="text-muted">

                            Kelola informasi tim maupun anggota yang tergabung.

                        </small>

                    </div>

                    <div class="d-flex gap-2 flex-wrap">

                        <a

                            href="{{ route('admin.teams.edit',$team->id) }}"

                            class="btn btn-warning btn-action">

                            <i class="bi bi-pencil-square me-2"></i>

                            EDIT

                        </a>

                        <form

                            action="{{ route('admin.teams.destroy',$team->id) }}"

                            method="POST"

                            onsubmit="return confirm('Hapus tim ini?')">

                            @csrf

                            @method('DELETE')

                            <button

                                class="btn btn-danger btn-action">

                                <i class="bi bi-trash me-2"></i>

                                HAPUS

                            </button>

                        </form>

                        <a

                            href="{{ route('admin.teams.index') }}"

                            class="btn btn-secondary btn-action">

                            KEMBALI

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

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

.profile-card,

.form-card{

    background:#fff;

    border-radius:28px;

    padding:30px;

    box-shadow:0 20px 45px rgba(15,23,42,.05);

}

.team-logo{

    width:140px;

    height:140px;

    margin:auto;

    border-radius:50%;

    background:#EA580C;

    color:#fff;

    display:flex;

    align-items:center;

    justify-content:center;

    font-size:56px;

    font-weight:900;

}

.team-preview{

    text-align:center;

    margin-top:24px;

}

.team-preview h2{

    font-weight:900;

    color:#0F172A;

    margin-bottom:6px;

}

.team-preview span{

    color:#64748B;

    font-weight:600;

}

.summary-list{

    display:flex;

    justify-content:space-between;

    gap:20px;

}

.summary-list small{

    color:#94A3B8;

}

.summary-list h5{

    margin-top:6px;

    font-weight:900;

}

.card-title{

    font-size:13px;

    font-weight:800;

    letter-spacing:.18em;

    color:#EA580C;

    text-transform:uppercase;

}

.detail-box{

    background:#F8FAFC;

    border-radius:18px;

    padding:18px;

}

.detail-box label{

    display:block;

    font-size:12px;

    color:#94A3B8;

    margin-bottom:6px;

}

.detail-box h5{

    margin:0;

    font-weight:800;

    color:#0F172A;

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

.team-table thead th{

    background:#F8FAFC;

    border:none;

    color:#64748B;

    font-size:13px;

    text-transform:uppercase;

}

.badge-player{

    background:#FFF7ED;

    color:#EA580C;

    padding:8px 16px;

    border-radius:30px;

    font-weight:700;

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

.btn-action{

    border-radius:14px;

    padding:12px 22px;

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

    .profile-card,

    .form-card{

        padding:20px;

        border-radius:22px;

    }

    .team-logo{

        width:90px;

        height:90px;

        font-size:36px;

    }

    .summary-list{

        flex-direction:column;

    }

    .btn-action,

    .btn-back{

        width:100%;

    }

}

</style>

<script>

const search=document.getElementById('playerSearch');

const rows=document.querySelectorAll('.player-row');

search.addEventListener('keyup',function(){

    const keyword=this.value.toLowerCase();

    rows.forEach(row=>{

        row.style.display=row.innerText.toLowerCase().includes(keyword)?'':'none';

    });

});

</script>

@endsection
