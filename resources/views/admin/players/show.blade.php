@extends('admin.layouts.admin')

@section('title','Detail Pemain')

@section('page-title','Database Atlet')

@section('page-subtitle','Profil lengkap pemain')

@section('content')

@php

$positions=[

'PG'=>'Point Guard',

'SG'=>'Shooting Guard',

'SF'=>'Small Forward',

'PF'=>'Power Forward',

'C'=>'Center',

];

@endphp

<div class="container-fluid">

    <div class="player-header mb-5">

        <div class="row align-items-end g-4">

            <div class="col-lg-8">

                <span class="page-label">

                    DATABASE ATLET

                </span>

                <h1 class="page-heading">

                    PROFIL <span>PEMAIN.</span>

                </h1>

            </div>

            <div class="col-lg-4 text-lg-end">

                <a href="{{ route('admin.players.index') }}"
                   class="btn btn-back">

                    <i class="bi bi-arrow-left me-2"></i>

                    KEMBALI

                </a>

            </div>

        </div>

    </div>

    <div class="row g-4">

        <!-- PROFILE -->

        <div class="col-xl-4">

            <div class="profile-card">

                <div class="profile-top">

                    <img

                        src="{{ $player->photo ? asset('storage/'.$player->photo) : 'https://placehold.co/300x300/E2E8F0/64748B?text=PLAYER' }}"

                        class="profile-photo">

                    <div class="profile-text">

                        <h2 class="player-name">

                            {{ $player->full_name }}

                        </h2>

                        <div class="jersey-name">

                            {{ $player->jersey_name }}

                        </div>

                        <div class="jersey-number">

                            #{{ $player->jersey_number ?: '--' }}

                        </div>

                    </div>

                </div>

                <hr>

                <div class="quick-info">

                    <div class="info-item">

                        <span>Tim</span>

                        <strong>

                            {{ $player->team->name ?? '-' }}

                        </strong>

                    </div>

                    <div class="info-item">

                        <span>Posisi</span>

                        <strong>

                            {{ $positions[$player->position] ?? '-' }}

                        </strong>

                    </div>

                    <div class="info-item">

                        <span>Status</span>

                        <strong class="{{ strtolower($player->status) === 'active' ? 'text-success' : 'text-danger' }}">
                            {{ ucfirst($player->status) }}
                        </strong>

                    </div>

                </div>

            </div>

        </div>

        <!-- DETAIL -->

        <div class="col-xl-8">

            <div class="detail-card">

                <div class="section-title">

                    Informasi Pemain

                </div>

                <div class="row g-4">

                    <div class="col-md-6">

                        <div class="detail-box">

                            <label>Nama Lengkap</label>

                            <h5>

                                {{ $player->full_name }}

                            </h5>

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="detail-box">

                            <label>Nama Punggung</label>

                            <h5>

                                {{ $player->jersey_name }}

                            </h5>

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="detail-box">

                            <label>Tanggal Lahir</label>

                            <h5>

                                {{ \Carbon\Carbon::parse($player->date_of_birth)->format('d M Y') }}

                            </h5>

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="detail-box">

                            <label>Umur</label>

                            <h5>

                                {{ $player->age }}

                                Tahun

                            </h5>

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="detail-box">

                            <label>Nomor</label>

                            <h5>

                                #{{ $player->jersey_number ?: '-' }}

                            </h5>

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="detail-box">

                            <label>Tinggi Badan</label>

                            <h5>

                                {{ $player->height ? $player->height.' cm' : '-' }}

                            </h5>

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="detail-box">

                            <label>Berat Badan</label>

                            <h5>

                                {{ $player->weight ? $player->weight.' kg' : '-' }}

                            </h5>

                        </div>

                    </div>
                                        <div class="col-md-6">

                        <div class="detail-box">

                            <label>Posisi</label>

                            <h5>

                                {{ $positions[$player->position] ?? '-' }}

                            </h5>

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="detail-box">

                            <label>Tim</label>

                            <h5>

                                {{ $player->team->name ?? 'Belum Memiliki Tim' }}

                            </h5>

                        </div>

                    </div>

                </div>

            </div>

            <!-- ACTION -->

            <div class="detail-card mt-4">

                <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">

                    <div>

                        <h5 class="fw-bold mb-1">

                            Manajemen Pemain

                        </h5>

                        <small class="text-muted">

                            Edit informasi atau hapus pemain dari database.

                        </small>

                    </div>

                    <div class="d-flex gap-2 flex-wrap">

                        <a href="{{ route('admin.players.edit',$player->id) }}"
                           class="btn btn-warning btn-action">

                            <i class="bi bi-pencil-square me-2"></i>

                            EDIT

                        </a>

                        <form
                            action="{{ route('admin.players.destroy',$player->id) }}"
                            method="POST"
                            onsubmit="return confirm('Hapus pemain ini?')">

                            @csrf

                            @method('DELETE')

                            <button class="btn btn-danger btn-action">

                                <i class="bi bi-trash me-2"></i>

                                HAPUS

                            </button>

                        </form>

                        <a href="{{ route('admin.players.index') }}"
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

.player-header{

    margin-bottom:40px;

}

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

.detail-card{

    background:#fff;

    border-radius:28px;

    padding:30px;

    box-shadow:0 20px 45px rgba(15,23,42,.05);

}

.profile-photo{

    width:220px;

    height:220px;

    object-fit:cover;

    border-radius:50%;

    border:8px solid #F8FAFC;

    display:block;

    margin:0 auto 20px;

}
.profile-top{

    display:flex;

    align-items:center;

    gap:24px;

}

.profile-text{

    flex:1;

}

.player-name{

    margin-top:25px;

    font-weight:900;

    font-style:italic;

    color:#0F172A;

}

.jersey-name{

    color:#64748B;

    font-weight:700;

    margin-top:6px;

}

.jersey-number{

    display:inline-block;

    margin-top:16px;

    padding:10px 22px;

    background:#EA580C;

    color:#fff;

    border-radius:14px;

    font-weight:800;

}

.quick-info{

    display:flex;

    flex-direction:column;

    gap:18px;

}

.info-item{

    display:flex;

    justify-content:space-between;

}

.info-item span{

    color:#64748B;

    font-weight:600;

}

.section-title{

    font-size:13px;

    font-weight:800;

    letter-spacing:.18em;

    text-transform:uppercase;

    color:#EA580C;

    margin-bottom:30px;

}

.detail-box{

    background:#F8FAFC;

    border-radius:18px;

    padding:18px;

    height:100%;

}

.detail-box label{

    display:block;

    color:#94A3B8;

    font-size:12px;

    margin-bottom:8px;

}

.detail-box h5{

    margin:0;

    font-weight:800;

    color:#0F172A;

}

.btn-back{

    background:#fff;

    border:1px solid #E2E8F0;

    border-radius:16px;

    padding:14px 24px;

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

    .profile-top{

    gap:14px;

}

.profile-photo{

    width:90px;

    height:90px;

    margin:0;

}

.player-name{

    margin-top:0;

    font-size:22px;

}

    .page-heading{

        font-size:32px;

    }

    .profile-photo{

        width:170px;

        height:170px;

    }

    .player-name{

        font-size:28px;

    }

    .jersey-name{

        font-size:16px;

    }

    .jersey-number{

        padding:8px 18px;

        font-size:14px;

    }

    .profile-card,

    .detail-card{

        border-radius:18px;

        padding:16px;

    }

    .btn-action,

    .btn-back{

        width:100%;

    }

}

</style>

@endsection
