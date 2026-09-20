{{-- resources/views/main/roster/roster.blade.php --}}
@extends('main.layout.layout')

@section('title', 'Roster ASEBA')

@section('content')

<style>

    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

    :root{
        --brand-orange:#ea580c;
        --brand-dark:#0f172a;
    }

    body{
        font-family:'Plus Jakarta Sans', sans-serif;
        background:#f8fafc;
    }

    /*
    |--------------------------------------------------------------------------
    | HERO
    |--------------------------------------------------------------------------
    */
    .roster-hero{

        background:
        linear-gradient(rgba(2,6,23,.45), rgba(2,6,23,.60)),
        url('{{ asset('images/gallery/basket3.png') }}');

        background-size:cover;
        background-position:center;
        background-repeat:no-repeat;

        padding:120px 0 95px;

    }

    .hero-subtitle{

        color:#f97316;

        font-size:.72rem;

        font-weight:800;

        text-transform:uppercase;

        letter-spacing:4px;
    }

    .hero-title{

        font-size:4.5rem;

        font-weight:800;

        line-height:.95;

        text-transform:uppercase;

        font-style:italic;

        letter-spacing:-4px;

        color:#fff;

        margin:25px 0;
    }

    .hero-title span{
        color:#ea580c;
    }

    .hero-desc{

        color:#e2e8f0;

        max-width:620px;

        line-height:1.9;
    }

    /*
    |--------------------------------------------------------------------------
    | SECTION
    |--------------------------------------------------------------------------
    */
    .roster-section{

        padding:90px 0 120px;
    }

    /*
    |--------------------------------------------------------------------------
    | FILTER
    |--------------------------------------------------------------------------
    */
    .filter-wrap{

        display:flex;
        gap:12px;

        flex-wrap:wrap;
    }

    .filter-btn{

        border:none;

        background:#fff;

        border:1px solid #e2e8f0;

        padding:14px 22px;

        border-radius:16px;

        font-size:.7rem;

        font-weight:800;

        text-transform:uppercase;

        letter-spacing:.08em;

        color:#64748b;

        transition:.2s ease;
    }

    .filter-btn.active,
    .filter-btn:hover{

        background:#ea580c;

        color:#fff;

        border-color:#ea580c;
    }

    /*
    |--------------------------------------------------------------------------
    | PLAYER CARD
    |--------------------------------------------------------------------------
    */
    .player-card{

        position:relative;

        border-radius:34px;

        overflow:hidden;

        background:#0f172a;

        height:470px;

        transition:.35s ease;

        text-decoration:none;

        display:block;

        box-shadow:0 20px 40px rgba(15,23,42,.12);
    }

    .player-card:hover{

         transform:translateY(-8px);

        }

        @media(max-width:991px){

        .player-card:hover{

        transform:none;

        }

        }

    .player-bg{
        position:absolute;
        inset:0;

        background-color:#020617;
        background-size:cover;
        background-position:center;

        transition:.4s ease;
        overflow:hidden;
    }

    .player-bg::after{
        content:"";
        position:absolute;
        inset:0;

        background:
            radial-gradient(
                circle at 50% 28%,
                rgba(234,88,12,.48) 0%,
                rgba(234,88,12,.20) 22%,
                rgba(2,6,23,.05) 45%,
                rgba(2,6,23,.72) 78%,
                rgba(2,6,23,.96) 100%
            );

        pointer-events:none;
        z-index:1;
    }
    .player-photo-bg::after{
        display:none !important;
    }

        .player-placeholder{
        position: absolute;
        inset: 0;

        display: flex;
        align-items: flex-end;
        justify-content: center;

        overflow: hidden;

        background:
            radial-gradient(
                circle at 50% 35%,
                #aebbd0 0%,
                #7f8fa7 35%,
                #53627a 70%,
                #3d4a60 100%
            );
    }

    .player-placeholder i{
        position: absolute;

        left: 50%;
        bottom: -18px;

        transform: translateX(-50%);

        font-size: 245px;
        line-height: 1;

        color: #020617;

        opacity: .98;

        z-index: 1;
    }

    .player-placeholder{
        background:
            radial-gradient(
                circle at 50% 28%,
                rgba(234,88,12,.50) 0%,
                rgba(234,88,12,.20) 24%,
                rgba(2,6,23,.10) 45%,
                rgba(2,6,23,.80) 75%,
                #020617 100%
            ) !important;

        display:flex;
        align-items:center;
        justify-content:center;
    }

    .player-placeholder i{
        position:absolute;
        bottom:-35px;

        font-size:390px;
        line-height:1;

        color:#020617;

        opacity:.95;
    }

    .player-card:hover .player-bg{

        transform:scale(1.05);
    }

    /*
    |--------------------------------------------------------------------------
    | NUMBER
    |--------------------------------------------------------------------------
    */
    .player-number{

        position:absolute;

        top:28px;
        left:28px;

        font-size:4.2rem;

        font-weight:800;

        font-style:italic;

        color:rgba(255,255,255,.12);

        z-index:5;

        transition:.3s ease;
    }

    .player-card:hover .player-number{

        color:rgba(234,88,12,.35);
    }

    /*
    |--------------------------------------------------------------------------
    | CONTENT
    |--------------------------------------------------------------------------
    */
    .player-content{

        position:absolute;

        bottom:0;
        left:0;
        right:0;

        padding:35px;

        z-index:10;
    }

    .player-position{

        color:#f97316;

        font-size:.65rem;

        font-weight:800;

        text-transform:uppercase;

        letter-spacing:.2em;

        margin-bottom:10px;
    }

    .player-name{

        color:#fff;

        font-size:1.7rem;

        font-weight:800;

        line-height:1;

        text-transform:uppercase;

        font-style:italic;

        margin-bottom:15px;
    }

    .player-meta{

        display:flex;
        align-items:center;
        gap:15px;

        color:#cbd5e1;

        font-size:.75rem;

        font-weight:600;
    }

    .player-line{

        width:0;

        height:4px;

        background:#ea580c;

        margin-top:20px;

        border-radius:999px;

        transition:.35s ease;
    }

    .player-card:hover .player-line{

        width:70px;
    }

    /*
    |--------------------------------------------------------------------------
    | TITLE
    |--------------------------------------------------------------------------
    */
    .section-title{

        font-size:3rem;

        font-weight:800;

        text-transform:uppercase;

        font-style:italic;

        letter-spacing:-2px;

        color:#0f172a;
    }

    .section-title span{
        color:#ea580c;
    }

    /*
    |--------------------------------------------------------------------------
    | RESPONSIVE
    |--------------------------------------------------------------------------
    */
    @media(max-width:991px){

    .hero-title{

    font-size:3rem;

    }

    .section-title{

    font-size:2rem;

    }

    .filter-wrap{

    flex-wrap:nowrap;

    overflow-x:auto;

    padding-bottom:6px;

    scrollbar-width:none;

    }

    .filter-wrap::-webkit-scrollbar{

    display:none;

    }

    .filter-btn{

    flex:0 0 auto;

    }

    .player-card{

    height:260px;

    border-radius:22px;

    }

    .player-content{

    padding:18px;

    }

    .player-number{

    font-size:58px;

    top:14px;

    left:16px;

    }

    .player-position{

    font-size:9px;

    margin-bottom:6px;

    letter-spacing:.12em;

    }

    .player-name{

    font-size:1rem;

    margin-bottom:8px;

    }

    .player-meta{

    font-size:10px;

    gap:8px;

    }

    .player-line{

    margin-top:10px;

    }

    }

</style>

{{-- HERO --}}
<section class="roster-hero">

    <div class="container">

        <div class="row">

            <div class="col-lg-8">

                <div class="hero-subtitle">
                    ASEBA Basketball Club
                </div>

                <h1 class="hero-title">
                    Aseba <span>Roster.</span>
                </h1>

                <p class="hero-desc">
                    Lihat daftar pemain ASEBA Basketball Club dari berbagai kategori usia,
                    lengkap dengan profil atlet.
                </p>

            </div>

        </div>

    </div>

</section>

{{-- MAIN --}}
<section class="roster-section">

    <div class="container">

        {{-- TOP --}}
        <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-end gap-4 mb-5">

            <div>

                <p class="text-uppercase fw-bold mb-2"
                   style="
                        color:#ea580c;
                        font-size:10px;
                        letter-spacing:.4em;
                   ">

                    ASEBA Athlete Database

                </p>

                <h2 class="section-title">

                    Team <span>Roster</span>

                </h2>

            </div>

            {{-- FILTER TEAM --}}
            <div class="filter-wrap">



                {{-- TEAM DARI DATABASE --}}
                @foreach($teams as $team)

                    <button
                        type="button"
                        class="filter-btn"
                        data-filter="team-{{ $team->id }}"
                    >
                        {{ $team->name }}
                    </button>

                @endforeach

            </div>

        </div>



            {{-- PLAYER GRID --}}
            {{-- PLAYER GRID --}}
            <div class="row g-4">

                @forelse($players as $player)

                    @php

                        $positionMap = [
                            'PG' => 'Point Guard',
                            'SG' => 'Shooting Guard',
                            'SF' => 'Small Forward',
                            'PF' => 'Power Forward',
                            'C'  => 'Center',
                        ];

                        $position = $positionMap[$player->position]
                            ?? $player->position
                            ?? '-';

                        $teamName = $player->team->name ?? 'Belum ada tim';

                        $slug = \Illuminate\Support\Str::slug(
                            $player->full_name
                        );

                    @endphp

                    <div
                        class="col-6 col-md-6 col-lg-4 col-xl-3 roster-player"
                        data-team-id="{{ $player->team_id }}"
                        data-team-name="{{ strtolower($teamName) }}"
                    >

                        <a
                            href="{{ route('main.roster.detail', $slug) }}"
                            class="player-card"
                        >

                            {{-- FOTO --}}
                            @if($player->photo && file_exists(public_path('storage/' . $player->photo)))

                                <div
                                    class="player-bg player-photo-bg"
                                    style="
                                        background-image:
                                            url('{{ asset('storage/' . $player->photo) }}');
                                        background-size: cover;
                                        background-position: center;
                                        background-repeat: no-repeat;
                                    "
                                ></div>

                            @else

                                <div class="player-bg player-placeholder">

                                    <i class="bi bi-person-fill"></i>

                                </div>

                            @endif


                            {{-- NOMOR --}}
                            <div class="player-number">

                                {{ str_pad(
                                    $player->jersey_number,
                                    2,
                                    '0',
                                    STR_PAD_LEFT
                                ) }}

                            </div>


                            {{-- CONTENT --}}
                            <div class="player-content">

                                <div class="player-position">
                                    {{ $position }}
                                </div>

                                <div class="player-name">
                                    {{ $player->full_name }}
                                </div>

                                <div class="player-meta">

                                    <span>
                                        {{ $player->height
                                            ? $player->height . ' CM'
                                            : '-'
                                        }}
                                    </span>

                                    <span>•</span>

                                    <span>
                                        {{ $player->age
                                            ? $player->age . ' Years'
                                            : '-'
                                        }}
                                    </span>

                                </div>

                                <div class="player-line"></div>

                            </div>

                        </a>

                    </div>

                @empty

                    <div class="col-12">

                        <div class="text-center py-5">

                            <div class="text-muted mb-2">

                                <i
                                    class="bi bi-people"
                                    style="font-size:42px;"
                                ></i>

                            </div>

                            <h5 class="fw-bold">
                                Belum ada roster
                            </h5>

                            <p class="text-muted mb-0">
                                Belum ada pemain aktif yang terdaftar dalam tim.
                            </p>

                        </div>

                    </div>

                @endforelse

            </div>

        </div>

    </div>

</section>
<script>
document.addEventListener('DOMContentLoaded', function () {

    const filterButtons =
        document.querySelectorAll('.filter-btn');

    const players =
        document.querySelectorAll('.roster-player');


    filterButtons.forEach(function (button) {

        button.addEventListener('click', function () {

            filterButtons.forEach(function (btn) {
                btn.classList.remove('active');
            });

            this.classList.add('active');

            const filter = this.dataset.filter;

            players.forEach(function (player) {

                const teamId = player.dataset.teamId;

                const show =
                    filter === 'team-' + teamId;

                player.style.display =
                    show ? '' : 'none';

            });

        });

    });

});
</script>

@endsection
