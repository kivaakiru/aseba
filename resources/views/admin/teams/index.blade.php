@extends('admin.layouts.admin')

@section('title','Daftar Tim')

@section('page-title','Database Tim')

@section('page-subtitle','Manajemen seluruh tim ASEBA')

@section('content')

<div class="container-fluid">

    <div class="team-header mb-5">

        <div class="row align-items-end g-4">

            <div class="col-lg-8">

                <span class="page-label">

                    DATABASE TIM

                </span>

                <h1 class="page-heading">

                    DAFTAR <span>TIM.</span>

                </h1>

            </div>

            <div class="col-lg-4 text-lg-end">

                <a href="{{ route('admin.teams.create') }}"
                   class="btn btn-add-team">

                    <i class="bi bi-plus-lg me-2"></i>

                    TAMBAH TIM

                </a>

            </div>

        </div>

    </div>

    @if(session('success'))

        <div class="alert alert-success border-0 rounded-4 shadow-sm mb-4">

            {{ session('success') }}

        </div>

    @endif

    <!-- SEARCH -->

    <div class="search-card mb-4">

        <div class="search-box">

            <i class="bi bi-search"></i>

            <input

                type="text"

                id="teamSearch"

                placeholder="Cari nama tim..."

                autocomplete="off">

        </div>

    </div>

    <!-- TEAM LIST -->

    <div class="row g-4" id="teamWrapper">

        @forelse($teams as $team)

        <div class="col-xl-4 col-lg-6 team-item">

            <div class="team-card">

                <div class="team-top">

                    <div class="team-avatar">

                        {{ strtoupper(substr($team->name,0,1)) }}

                    </div>

                    <div class="team-info">

                        <h4>

                            {{ $team->name }}

                        </h4>

                        <span>

                            {{ $team->category ?? '-' }}

                        </span>

                    </div>

                </div>

                <div class="team-stat">

                    <div>

                        <small>

                            Jumlah Atlet

                        </small>

                        <h5>

                            {{ $team->players_count }}

                        </h5>

                    </div>

                    <div>

                        <small>

                            Kategori

                        </small>

                        <span class="badge-category">

                            {{ $team->category }}

                        </span>

                    </div>

                </div>

                <hr>

                <div class="team-action">

                    <a

                        href="{{ route('admin.teams.show',$team->id) }}"

                        class="btn-detail">

                        DETAIL

                    </a>

                    <a

                        href="{{ route('admin.teams.edit',$team->id) }}"

                        class="btn-edit">

                        EDIT

                    </a>

                    <form

                        action="{{ route('admin.teams.destroy',$team->id) }}"

                        method="POST"

                        onsubmit="return confirm('Hapus tim ini?')">

                        @csrf

                        @method('DELETE')

                        <button

                            class="btn-delete">

                            HAPUS

                        </button>

                    </form>

                </div>

            </div>

        </div>

        @empty

        <div class="col-12">

            <div class="empty-card">

                <i class="bi bi-people-fill"></i>

                <h4>

                    Belum ada tim

                </h4>

                <p>

                    Tambahkan tim pertama ASEBA.

                </p>

            </div>

        </div>

        @endforelse

    </div>
        <div class="d-flex justify-content-between align-items-center mt-5 flex-wrap gap-3">

        <div class="text-muted fw-semibold">

            Total Tim :

            <span class="text-dark">

                {{ $teams->count() }}

            </span>

        </div>

        <div>

            {{ $teams->links('pagination::bootstrap-4') }}

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

.search-card{

    background:#fff;

    border-radius:24px;

    padding:20px;

    box-shadow:0 18px 40px rgba(15,23,42,.05);

}

.search-box{

    position:relative;

}

.search-box i{

    position:absolute;

    left:20px;

    top:50%;

    transform:translateY(-50%);

    color:#94A3B8;

    font-size:18px;

}

.search-box input{

    width:100%;

    height:60px;

    border:none;

    background:#F8FAFC;

    border-radius:18px;

    padding-left:55px;

    font-weight:600;

    outline:none;

}

.team-card{

    background:#fff;

    border-radius:28px;

    padding:28px;

    box-shadow:0 18px 40px rgba(15,23,42,.06);

    transition:.3s;

    height:100%;

}

.team-card:hover{

    transform:translateY(-6px);

    box-shadow:0 30px 55px rgba(15,23,42,.12);

}

.team-top{

    display:flex;

    gap:18px;

    align-items:center;

}

.team-avatar{

    width:70px;

    height:70px;

    border-radius:50%;

    background:#EA580C;

    color:#fff;

    font-size:26px;

    font-weight:900;

    display:flex;

    align-items:center;

    justify-content:center;

    flex-shrink:0;

}

.team-info{

    flex:1;

}

.team-info h4{

    margin:0;

    font-size:24px;

    font-weight:800;

    color:#0F172A;

}

.team-info span{

    color:#64748B;

    font-weight:600;

}

.team-stat{

    margin-top:28px;

    display:flex;

    justify-content:space-between;

    gap:15px;

}

.team-stat small{

    color:#94A3B8;

    display:block;

    margin-bottom:5px;

}

.team-stat h5{

    margin:0;

    font-size:26px;

    font-weight:900;

}

.badge-category{

    display:inline-block;

    padding:8px 16px;

    border-radius:30px;

    background:#FFF7ED;

    color:#EA580C;

    font-weight:700;

}

.team-action{

    display:flex;

    gap:10px;

    margin-top:22px;

}

.team-action a,

.team-action button{

    flex:1;

    border:none;

    text-decoration:none;

    border-radius:14px;

    height:46px;

    display:flex;

    align-items:center;

    justify-content:center;

    font-weight:700;

    transition:.25s;

}

.btn-detail{

    background:#EEF2FF;

    color:#4338CA;

}

.btn-detail:hover{

    background:#4338CA;

    color:#fff;

}

.btn-edit{

    background:#FEF3C7;

    color:#B45309;

}

.btn-edit:hover{

    background:#B45309;

    color:#fff;

}

.btn-delete{

    background:#FEE2E2;

    color:#DC2626;

    cursor:pointer;

}

.btn-delete:hover{

    background:#DC2626;

    color:#fff;

}

.btn-add-team{

    background:#EA580C;

    color:#fff;

    border-radius:16px;

    padding:14px 26px;

    font-weight:800;

    transition:.25s;

}

.btn-add-team:hover{

    background:#C2410C;

    color:#fff;

    transform:translateY(-2px);

}

.empty-card{

    background:#fff;

    border-radius:30px;

    padding:80px 30px;

    text-align:center;

    box-shadow:0 20px 45px rgba(15,23,42,.05);

}

.empty-card i{

    font-size:70px;

    color:#EA580C;

    margin-bottom:20px;

}

.empty-card h4{

    font-weight:800;

    color:#0F172A;

}

.empty-card p{

    color:#64748B;

    margin:0;

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

    .team-card{

        padding:20px;

        border-radius:22px;

    }

    .team-avatar{

        width:56px;

        height:56px;

        font-size:20px;

    }

    .team-info h4{

        font-size:20px;

    }

    .team-stat{

        flex-direction:column;

        gap:12px;

    }

    .team-action{

        flex-direction:column;

    }

    .team-action a,

    .team-action button,

    .btn-add-team{

        width:100%;

    }

}

</style>

<script>

const search=document.getElementById('teamSearch');

const items=document.querySelectorAll('.team-item');

search.addEventListener('keyup',function(){

    const keyword=this.value.toLowerCase();

    items.forEach(item=>{

        const text=item.innerText.toLowerCase();

        item.style.display=text.includes(keyword)?'':'none';

    });

});

</script>

@endsection
