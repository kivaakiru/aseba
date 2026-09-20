@extends('main.layout.layout')

@section('title', 'Detail Pemain')

@section('content')



<style>

.player-page{
    background:#f8fafc;
    min-height:100vh;
    padding:60px 0;
}

.back-link{
    display:inline-flex;
    align-items:center;
    gap:8px;
    text-decoration:none;
    color:#64748b;
    font-weight:600;
    margin-bottom:20px;
}

.back-link:hover{
    color:#ea580c;
}

.player-card{
    background:#fff;
    border-radius:32px;
    overflow:hidden;
    border:1px solid #e5e7eb;
    box-shadow:0 20px 50px rgba(15,23,42,.08);
}

.player-card .row{
    align-items:stretch;
}

.player-card .col-lg-4{
    display:flex;
}

.player-card .col-lg-4 .player-image{
    flex:1;
}

.player-image{
    position:relative;

    width:100%;
    height:100%;
    min-height:100%;

    background:#020617;

    overflow:hidden;

    border-radius:32px 0 0 32px;
}

.player-card{
    background:#fff;
    border-radius:32px;
    overflow:hidden;
    border:1px solid #e5e7eb;
    box-shadow:0 20px 50px rgba(15,23,42,.08);
}

.player-card .row{
    overflow:hidden;
    border-radius:32px;
}

.player-card .col-lg-4{
    overflow:hidden;
}

.player-photo{
    position:absolute;

    inset:0;

    width:100%;
    height:100%;

    display:block;

    object-fit:cover;
    object-position:center center;
}

.player-image.has-photo::before{
    display:none;
}



.player-image::after{
    content:"";
    position:absolute;
    inset:0;

    background:
        linear-gradient(
            to top,
            rgba(2,6,23,.98) 0%,
            rgba(2,6,23,.72) 28%,
            rgba(2,6,23,.15) 58%,
            transparent 78%
        );

    z-index:4;
    pointer-events:none;
}

/* FOTO ASLI TIDAK DIBERI OVERLAY */
.player-image.has-photo::after{
    display:none;
}


/* =========================================================
   PLAYER SILHOUETTE
========================================================= */

.player-silhouette{
    position:absolute;

    left:50%;
    bottom:-5px;

    width:390px;
    height:510px;

    transform:translateX(-50%);

    z-index:3;

    pointer-events:none;
}

/*
|--------------------------------------------------------------------------
| ORANGE BACKLIGHT
|--------------------------------------------------------------------------
*/

.silhouette-glow{
    position:absolute;

    left:50%;
    top:34%;

    width:360px;
    height:360px;

    transform:translate(-50%,-50%);

    background:
        radial-gradient(
            ellipse at center,
            rgba(234,88,12,.70) 0%,
            rgba(234,88,12,.38) 22%,
            rgba(234,88,12,.16) 44%,
            transparent 70%
        );

    filter:blur(18px);

    z-index:0;
}

/*
|--------------------------------------------------------------------------
| SILHOUETTE
|--------------------------------------------------------------------------
*/

.silhouette-svg{
    position:absolute;

    left:50%;
    bottom:0;

    width:100%;
    height:100%;

    transform:translateX(-50%);

    z-index:2;
}

/*
|--------------------------------------------------------------------------
| ORANGE RIM LIGHT
|--------------------------------------------------------------------------
*/

.silhouette-svg path{
    filter:
        drop-shadow(0 0 3px rgba(234,88,12,.55));
}

.player-overlay{
    position:absolute;

    left:30px;
    right:30px;
    bottom:28px;

    z-index:5;
}

.player-number{
    font-size:95px;
    line-height:.8;

    font-weight:900;
    font-style:italic;

    color:rgba(234,88,12,.65);

    margin-bottom:8px;
}

.player-jersey{
    margin-top:-10px;
    color:white;
    font-size:15px;
    font-weight:800;
    letter-spacing:.35em;
    text-transform:uppercase;
}

.player-content{
    padding:50px;
}

.player-name{
    font-size:3rem;
    font-weight:800;
    text-transform:uppercase;
    margin-bottom:10px;
}

.player-position{
    display:inline-block;
    background:#fff7ed;
    color:#ea580c;
    padding:8px 16px;
    border-radius:999px;
    font-size:12px;
    font-weight:700;
    text-transform:uppercase;
    margin-bottom:35px;
}

.player-info-list{
    border-top:1px solid #e5e7eb;
}

.info-item{
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:22px 0;
    border-bottom:1px solid #e5e7eb;
}

.info-title{
    color:#64748b;
    font-size:16px;
    font-weight:500;
}

.info-data{
    color:#0f172a;
    font-size:18px;
    font-weight:800;
}

@media(max-width:991px){

    .player-image{
        width:100%;
        height:480px;
    }

    .player-silhouette{
        width:280px;
        height:400px;
        bottom:-10px;
    }

    .player-silhouette::before{
        width:125px;
        height:125px;
    }

    .player-silhouette::after{
        width:270px;
        height:310px;
        top:100px;
    }

    .player-content{
        padding:35px 30px;
    }

    .player-name{
        font-size:2.2rem;
    }

    .info-item{
        flex-direction:row;
        align-items:center;
    }

}

</style>

<section class="player-page">

<div class="container">

    <a href="{{ url('/roster') }}" class="back-link">
        <i class="bi bi-arrow-left"></i>
        Kembali ke Roster
    </a>

    <div class="player-card">

        <div class="row g-0">

            <div class="col-lg-4">

                <div class="player-image {{ $player->photo ? 'has-photo' : 'no-photo' }}">

                    @if($player->photo)

                        <img
                            src="{{ asset('storage/' . $player->photo) }}"
                            alt="{{ $player->full_name }}"
                            class="player-photo"
                        >

                    @else

                        <div class="player-silhouette">

                            <div class="silhouette-glow"></div>

                            <svg
                                class="silhouette-svg"
                                viewBox="0 0 400 520"
                                preserveAspectRatio="xMidYMax meet"
                                aria-hidden="true"
                            >
                                <path
                                    d="
                                        M200 18

                                        C158 18 132 47 132 91
                                        C132 122 143 146 159 160

                                        C162 164 164 170 164 181

                                        L164 205

                                        C148 214 128 222 106 232

                                        C82 243 61 255 47 274

                                        C31 295 23 324 20 358

                                        C18 386 21 414 28 443

                                        C34 468 46 491 62 512

                                        L338 512

                                        C354 491 366 468 372 443

                                        C379 414 382 386 380 358

                                        C377 324 369 295 353 274

                                        C339 255 318 243 294 232

                                        C272 222 252 214 236 205

                                        L236 181

                                        C236 170 238 164 241 160

                                        C257 146 268 122 268 91

                                        C268 47 242 18 200 18

                                        Z
                                    "
                                    fill="#020617"
                                />
                            </svg>

                        </div>

                    @endif




                    <div class="player-overlay">

                        <div class="player-number">
                            {{ str_pad($player->jersey_number, 2, '0', STR_PAD_LEFT) }}
                        </div>

                        <div class="player-jersey">
                            {{ $player['jersey_name'] }}
                        </div>

                    </div>

                </div>

            </div>

            <div class="col-lg-8">

                <div class="player-content">

                    <h1 class="player-name">
                        {{ $player->full_name }}
                    </h1>

                    <div class="player-position">
                        @php
                            $positionMap = [
                                'PG' => 'Point Guard',
                                'SG' => 'Shooting Guard',
                                'SF' => 'Small Forward',
                                'PF' => 'Power Forward',
                                'C'  => 'Center',
                            ];
                        @endphp

                        {{ $positionMap[$player->position] ?? $player->position ?? '-' }}
                    </div>

                    <div class="player-info-list">

                        <div class="info-item">
                            <span class="info-title">
                                Nama Jersey
                            </span>

                            <span class="info-data">
                                {{ $player->jersey_name }}
                            </span>
                        </div>

                        <div class="info-item">
                            <span class="info-title">
                                Nomor Punggung
                            </span>

                            <span class="info-data">
                                {{ str_pad($player->jersey_number, 2, '0', STR_PAD_LEFT) }}
                            </span>
                        </div>

                        <div class="info-item">
                            <span class="info-title">
                                Tim
                            </span>

                            <span class="info-data">
                                {{ $player->team->name ?? '-' }}
                            </span>
                        </div>

                        <div class="info-item">
                            <span class="info-title">
                                Tinggi Badan
                            </span>

                            <span class="info-data">
                                {{ $player->height ? $player->height . ' CM' : '-' }}
                            </span>
                        </div>

                        <div class="info-item">
                            <span class="info-title">
                                Berat Badan
                            </span>

                            <span class="info-data">
                                {{ $player['weight'] }}
                            </span>
                        </div>

                        <div class="info-item">
                            <span class="info-title">
                                Umur
                            </span>

                            <span class="info-data">
                                {{ $player->age ? $player->age . ' Tahun' : '-' }}
                            </span>
                        </div>

                        @if($player->social_media_name && $player->social_media_url)

                            <div class="info-item">
                                <span class="info-title">
                                    Sosial Media
                                </span>

                                <span class="info-data">
                                    <a
                                        href="{{ $player->social_media_url }}"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        style="
                                            color:#EA580C;
                                            text-decoration:none;
                                            font-weight:800;
                                        "
                                    >
                                        {{ $player->social_media_name }}

                                        <i
                                            class="bi bi-box-arrow-up-right"
                                            style="font-size:14px; margin-left:5px;"
                                        ></i>
                                    </a>
                                </span>
                            </div>

                        @endif

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

</section>

@endsection
