@extends('admin.layouts.admin')

@section('title', 'Data Pemain')

@section('page-title', 'Database Atlet')

@section('page-subtitle', 'Kelola seluruh data pemain ASEBA Basketball Club')

@section('content')

@php

$positions = [

    'PG' => 'Point Guard',
    'SG' => 'Shooting Guard',
    'SF' => 'Small Forward',
    'PF' => 'Power Forward',
    'C'  => 'Center',

];

@endphp

<div class="container-fluid">

    <!-- ================= HEADER ================= -->

    <div class="player-header mb-5">

        <div class="row align-items-end g-4">

            <div class="col-lg-8">

                <span class="page-label">

                    DATABASE ATLET

                </span>

                <h1 class="page-heading">

                    DAFTAR <span>PEMAIN.</span>

                </h1>

            </div>

            <div class="col-lg-4 text-lg-end">

                <a href="{{ route('admin.players.create') }}" class="btn btn-register">
                    <i class="bi bi-plus-lg me-2"></i>
                    REGISTER BARU
                </a>
                <a href="{{ route('admin.players.export') }}" class="btn btn-success">
                    <i class="bi bi-file-earmark-excel me-1"></i>
                    Download Excel
                </a>

            </div>

        </div>

    </div>

    <!-- ================= FILTER ================= -->

        <form
            method="GET"
            action="{{ route('admin.players.index') }}"
            class="row g-3 align-items-center mb-4"
        >

            <!-- SEARCH -->

            <div class="col-12 col-xl-4">

                <div class="search-box">

                    <i class="bi bi-search"></i>

                    <input
                        type="text"
                        name="search"
                        class="form-control"
                        value="{{ request('search') }}"
                        placeholder="Cari nama atau inisial pemain..."
                    >

                </div>

            </div>


            <!-- TEAM -->

            <div class="col-6 col-xl-2">

                <select
                    name="team_id"
                    class="form-select"
                    onchange="this.form.submit()"
                >

                    <option value="">
                        Semua Tim
                    </option>

                    @foreach($teams as $team)

                        <option
                            value="{{ $team->id }}"
                            {{ (string) request('team_id') === (string) $team->id ? 'selected' : '' }}
                        >
                            {{ $team->name }}
                        </option>

                    @endforeach

                </select>

            </div>

            <!-- STATUS -->

            <div class="col-6 col-xl-2">
                <select
                    name="status"
                    class="form-select"
                    onchange="this.form.submit()"
                >
                    <option value="">
                        Semua Status
                    </option>

                    <option
                        value="active"
                        {{ request('status') === 'active' ? 'selected' : '' }}
                    >
                        Active
                    </option>

                    <option
                        value="inactive"
                        {{ request('status') === 'inactive' ? 'selected' : '' }}
                    >
                        Inactive
                    </option>
                </select>
            </div>


            <!-- POSITION -->

            <div class="col-6 col-xl-2">

                <select
                    name="position"
                    class="form-select"
                    onchange="this.form.submit()"
                >

                    <option value="">
                        Semua Posisi
                    </option>

                    @foreach($positions as $code => $name)

                        <option
                            value="{{ $code }}"
                            {{ request('position') === $code ? 'selected' : '' }}
                        >
                            {{ $name }}
                        </option>

                    @endforeach

                </select>

            </div>
            <!-- UMUR -->

            <div class="col-6 col-xl-1">
                <select
                    name="age_sort"
                    class="form-select"
                    onchange="this.form.submit()"
                >
                    <option value="">
                        Urutkan Umur
                    </option>

                    <option
                        value="asc"
                        {{ request('age_sort') === 'asc' ? 'selected' : '' }}
                    >
                        Umur Termuda
                    </option>

                    <option
                        value="desc"
                        {{ request('age_sort') === 'desc' ? 'selected' : '' }}
                    >
                        Umur Tertua
                    </option>
                </select>
            </div>


            <!-- SEARCH BUTTON -->

            <div class="col-12 col-xl-1">

                <button
                    type="submit"
                    class="btn btn-register w-100"
                    style="height:66px;"
                >
                    <i class="bi bi-search me-2"></i>
                    FILTER
                </button>

            </div>

        </form>

    <!-- ================= TABLE ================= -->

    <div class="player-card">

        <div class="table-responsive">

            <table class="table align-middle mb-0" id="playersTable">

                <thead>

                    <tr>

                        <th>Pemain</th>

                        <th>Identitas</th>

                        <th>Posisi</th>
                        <th>Umur</th>

                        <th>Tim</th>

                        <th class="text-end">

                            Profil

                        </th>

                    </tr>

                </thead>

                <tbody>

                @forelse($players as $player)

                    <tr>

                        <!-- PLAYER -->

                        <td>

                            <div class="player-info">

                                <img

                                    src="{{ $player->photo ? asset('storage/'.$player->photo) : asset('images/default-avatar.png') }}"

                                    class="player-avatar">

                                <div>

                                    <h6>

                                        {{ strtoupper($player->full_name) }}

                                    </h6>

                                    <small>

                                        <span
                                            class="status-dot {{ ($player->status ?? 'active') === 'inactive' ? 'inactive' : '' }}"
                                        ></span>

                                        {{ ucfirst($player->status ?? 'Active') }}

                                    </small>

                                </div>

                            </div>

                        </td>

                        <!-- IDENTITAS -->

                        <td>

                            <strong>

                                "{{ strtoupper($player->jersey_name) }}"

                            </strong>

                            <span class="jersey-number">

                                #{{ $player->jersey_number }}

                            </span>

                        </td>

                        <!-- POSITION -->

                        <td data-position="{{ strtolower($player->position) }}">

                            {{ $positions[$player->position] ?? $player->position }}

                        </td>

                        <!-- UMUR -->

                        <td>
                            {{ $player->age ?? '-' }} Tahun
                        </td>

                        <!-- TEAM -->

                        <td>

                            <span class="team-badge">

                                {{ $player->team->name ?? '-' }}

                            </span>

                        </td>

                        <!-- ACTION -->

                        <td class="text-end">

                            <a

                                href="{{ route('admin.players.show',$player->id) }}"

                                class="detail-link">

                                Detail →

                            </a>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="6" class="text-center py-5 text-muted">

                            Belum ada data pemain.

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>


        <!-- ================= FOOTER ================= -->

         <div class="player-footer">

            <div class="d-flex align-items-center gap-3">

                <div>
                    <div class="d-flex align-items-center gap-3">

                        <div>
                            Menampilkan
                            <strong>{{ $players->total() }}</strong>
                            pemain
                        </div>

                        <form method="GET" action="{{ route('admin.players.index') }}">
                            @foreach(request()->except(['per_page', 'page']) as $key => $value)
                                <input
                                    type="hidden"
                                    name="{{ $key }}"
                                    value="{{ $value }}"
                                >
                            @endforeach

                            <select
                                name="per_page"
                                class="form-select form-select-sm"
                                onchange="this.form.submit()"
                                style="width: 85px;"
                            >
                                @foreach([10, 20, 30, 40, 50] as $size)
                                    <option
                                        value="{{ $size }}"
                                        {{ (int) request('per_page', 10) === $size ? 'selected' : '' }}
                                    >
                                        {{ $size }}
                                    </option>
                                @endforeach
                            </select>
                        </form>

                    </div>
                </div>

                <div class="d-flex align-items-center gap-2">
                    <span class="text-muted">Tampilkan</span>

                    <form method="GET" action="{{ route('admin.players.index') }}">
                        @foreach(request()->except(['per_page', 'page']) as $key => $value)
                            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                        @endforeach

                        <select
                            name="per_page"
                            class="form-select form-select-sm"
                            onchange="this.form.submit()"
                            style="width:80px;"
                        >
                            @foreach([10,20,30,40,50] as $size)
                                <option
                                    value="{{ $size }}"
                                    {{ (int) request('per_page', 10) === $size ? 'selected' : '' }}
                                >
                                    {{ $size }}
                                </option>
                            @endforeach
                        </select>
                    </form>
                </div>

            </div>

            <div>

                {{ $players->links('pagination::bootstrap-4') }}

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

    line-height:1;

    letter-spacing:-2px;

    color:#0F172A;

}

.page-heading span{

    color:#EA580C;

}

.btn-register{

    background:#EA580C;

    color:#fff;

    border-radius:18px;

    padding:18px 34px;

    font-size:12px;

    font-weight:800;

    letter-spacing:.08em;

    box-shadow:0 15px 35px rgba(234,88,12,.25);

}

.btn-register:hover{

    background:#C2410C;

    color:#fff;

}

.search-box{

    position:relative;

}

.search-box i{

    position:absolute;

    left:22px;

    top:50%;

    transform:translateY(-50%);

    color:#94A3B8;

    font-size:18px;

}

.search-box input{

    height:66px;

    border-radius:20px;

    padding-left:58px;

    border:1px solid #E2E8F0;

    font-weight:600;

}

.form-select{

    height:66px;

    border-radius:20px;

    font-weight:700;

}

.player-card{

    background:#fff;

    border-radius:34px;

    overflow:hidden;

    box-shadow:0 20px 45px rgba(15,23,42,.05);

}

.table{

    margin:0;

}

.table thead th{

    border:none;

    background:#fff;

    color:#94A3B8;

    font-size:11px;

    letter-spacing:.12em;

    text-transform:uppercase;

    font-weight:800;

    padding:18px 22px;

}

.table tbody td{

    padding:14px 22px;

    border-color:#F1F5F9;

}

.table tbody tr{

    transition:.25s;

}

.table tbody tr:hover{

    background:#FFF7ED;

}

.player-info{

    display:flex;

    align-items:center;

    gap:12px;

}

.player-avatar{

    width:42px;

    height:42px;

    border-radius:50%;

    object-fit:cover;

    background:#0F172A;

}

.player-info h6{

    margin:0;

    font-size:16px;

    margin-bottom:2px;

    font-weight:900;

    font-style:italic;

}

.player-info small{

    display:flex;

    align-items:center;

    gap:8px;

    margin-top:2px;

    color:#94A3B8;

    font-size:10px;

    font-weight:700;

    text-transform:uppercase;

}

.status-dot{

    width:8px;

    height:8px;

    background:#22C55E;

    border-radius:50%;

    display:inline-block;

}
.status-dot.inactive{
    background:#fd0000;
}

.jersey-number{

    display:inline-block;

    margin-left:10px;

    padding:4px 8px;

    background:#0F172A;

    color:#fff;

    border-radius:10px;

    font-size:10px;

    font-weight:800;

}

.team-badge{

    background:#F1F5F9;

    padding:5px 10px;

    border-radius:100px;

    font-size:10px;

    font-weight:800;

    font-style:italic;

}

.detail-link{

    color:#CBD5E1;

    font-weight:800;

    text-transform:uppercase;

    font-size:12px;

    transition:.25s;

}

.detail-link:hover{

    color:#EA580C;

}

.player-footer{

    display:flex;

    justify-content:space-between;

    align-items:center;

    padding:20px 30px;

    border-top:1px solid #F1F5F9;

    background:#F8FAFC;

}

@media (max-width:1200px){

    .page-heading{

        font-size:46px;

    }

}

@media (max-width:992px){

    .page-header{

        text-align:center;

    }

    .btn-register{

        width:100%;

    }

    .player-footer{

        flex-direction:column;

        gap:18px;

        align-items:flex-start;

    }

}

@media (max-width:768px){

    .player-avatar{

        width:38px;

        height:38px;

    }

    .player-info h6{

        font-size:15px;

    }

    .table tbody td{

        padding:12px 18px;

    }
    .page-heading{

        font-size:34px;

    }

    .page-label{

        letter-spacing:.25em;

    }

    .search-box input{

        height:56px;

    }

    .form-select{

        height:56px;

    }

    .player-card{

        border-radius:22px;

        overflow-x:auto;

    }

    .table{

        min-width:760px;

    }

}

@media (max-width:576px){

    .page-heading{

        font-size:28px;

    }

    .player-avatar{

        width:48px;

        height:48px;

    }

    .player-info h6{

        font-size:16px;

    }

    .btn-register{

        padding:15px;

        border-radius:16px;

    }

    .search-box input{

        border-radius:16px;

    }

    .form-select{

        border-radius:16px;

    }

}

</style>



@endsection
