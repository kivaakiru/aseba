@extends('main.layout.layout')

@section('title', 'Gallery')

@section('content')

<style>

:root {
    --brand: #ea580c;
    --dark: #0f172a;
}


/* ==========================================================
   HERO
========================================================== */

.gallery-hero {

    background:
        linear-gradient(
            rgba(2,6,23,.55),
            rgba(2,6,23,.70)
        ),
        url('{{ asset('images/gallery/basket1.png') }}');

    background-size: cover;
    background-position: center;

    padding: 130px 0 110px;
}


.gallery-subtitle {

    color: #fb923c;

    font-size: .72rem;

    font-weight: 800;

    letter-spacing: .35em;

    text-transform: uppercase;
}


.gallery-title {

    color: white;

    font-size: 4.8rem;

    font-weight: 900;

    line-height: .95;

    text-transform: uppercase;

    font-style: italic;

    margin: 22px 0;
}


.gallery-title span {

    color: var(--brand);
}


.gallery-desc {

    color: #cbd5e1;

    max-width: 620px;

    line-height: 1.9;
}


/* ==========================================================
   TOP BAR
========================================================== */

.gallery-top {

    padding: 70px 0 40px;
}


.gallery-count {

    font-size: 14px;

    color: #64748b;

    font-weight: 700;
}


.gallery-count b {

    color: #0f172a;
}


/* ==========================================================
   ALBUM GRID
========================================================== */

.gallery-grid {

    padding: 0 0 90px;
}


.album-grid {

    display: grid;

    grid-template-columns:
        repeat(4, minmax(0, 1fr));

    gap: 24px;
}


/* ==========================================================
   ALBUM CARD
========================================================== */

.album-card {

    position: relative;

    display: block;

    overflow: hidden;

    background: #ffffff;

    border-radius: 24px;

    border: 1px solid #e5e7eb;

    text-decoration: none;

    box-shadow:
        0 18px 40px
        rgba(15,23,42,.07);

    transition:
        transform .3s ease,
        box-shadow .3s ease;
}


.album-card:hover {

    transform: translateY(-6px);

    box-shadow:
        0 25px 50px
        rgba(15,23,42,.12);
}


/* ==========================================================
   ALBUM COVER
========================================================== */

.album-cover {

    position: relative;

    width: 100%;

    aspect-ratio: 4 / 3;

    overflow: hidden;

    background: #e2e8f0;
}


.album-cover img {

    width: 100%;

    height: 100%;

    object-fit: cover;

    transition:
        transform .5s ease;
}


.album-card:hover .album-cover img {

    transform: scale(1.06);
}


.album-placeholder {

    width: 100%;

    height: 100%;

    display: flex;

    align-items: center;

    justify-content: center;

    color: #94a3b8;

    font-size: 42px;
}


/* ==========================================================
   ALBUM OVERLAY
========================================================== */

.album-cover-overlay {

    position: absolute;

    inset: 0;

    display: flex;

    align-items: flex-end;

    padding: 20px;

    background:
        linear-gradient(
            transparent 40%,
            rgba(2,6,23,.75)
        );

    opacity: 0;

    transition: opacity .3s ease;
}


.album-card:hover .album-cover-overlay {

    opacity: 1;
}


.album-open-label {

    display: inline-flex;

    align-items: center;

    gap: 7px;

    color: white;

    font-size: 12px;

    font-weight: 800;

    text-transform: uppercase;

    letter-spacing: .08em;
}


/* ==========================================================
   ALBUM INFORMATION
========================================================== */

.album-info {

    padding: 19px 20px 21px;
}


.album-name {

    color: #0f172a;

    font-size: 19px;

    font-weight: 800;

    line-height: 1.3;

    margin-bottom: 8px;
}


.album-meta {

    display: flex;

    align-items: center;

    gap: 14px;

    flex-wrap: wrap;

    color: #64748b;

    font-size: 12px;
}


.album-meta span {

    display: inline-flex;

    align-items: center;

    gap: 5px;
}


.album-meta i {

    color: var(--brand);
}


/* ==========================================================
   EMPTY
========================================================== */

.gallery-empty {

    padding: 80px 20px;

    text-align: center;

    border: 1px dashed #cbd5e1;

    border-radius: 22px;

    background: #ffffff;
}


.gallery-empty-icon {

    width: 68px;

    height: 68px;

    margin: 0 auto 18px;

    border-radius: 50%;

    display: flex;

    align-items: center;

    justify-content: center;

    background: #fff7ed;

    color: var(--brand);

    font-size: 28px;
}


.gallery-empty h3 {

    margin: 0 0 8px;

    color: #0f172a;

    font-size: 19px;

    font-weight: 800;
}


.gallery-empty p {

    margin: 0;

    color: #64748b;

    font-size: 14px;
}


/* ==========================================================
   VIEW ALL
========================================================== */

.gallery-footer {

    padding: 0 0 100px;

    text-align: center;
}


.gallery-button {

    display: inline-flex;

    align-items: center;

    gap: 10px;

    padding: 16px 34px;

    border-radius: 999px;

    background: #ea580c;

    color: white;

    font-weight: 800;

    text-decoration: none;

    transition: .3s;

    box-shadow:
        0 18px 35px
        rgba(234,88,12,.25);
}


.gallery-button:hover {

    background: #c2410c;

    color: white;

    transform: translateY(-3px);
}


.gallery-button i {

    transition: .3s;
}


.gallery-button:hover i {

    transform: translateX(4px);
}


/* ==========================================================
   RESPONSIVE
========================================================== */

@media(max-width: 1100px) {

    .album-grid {

        grid-template-columns:
            repeat(3, minmax(0, 1fr));
    }
}


@media(max-width: 991px) {

    .gallery-title {

        font-size: 3rem;
    }

    .gallery-desc {

        font-size: 15px;
    }

    .gallery-top {

        padding: 50px 0 30px;
    }

    .album-grid {

        grid-template-columns:
            repeat(2, minmax(0, 1fr));
    }
}


@media(max-width: 576px) {

    .gallery-title {

        font-size: 2.5rem;
    }

    .gallery-hero {

        padding: 100px 0 80px;
    }

    .album-grid {

        grid-template-columns: 1fr;

        gap: 18px;
    }

    .album-card {

        border-radius: 18px;
    }

    .album-name {

        font-size: 17px;
    }

    .gallery-button {

        width: 100%;

        justify-content: center;
    }
}

</style>


{{-- ==========================================================
     HERO
========================================================== --}}

<section class="gallery-hero">

    <div class="container">

        <div class="row">

            <div class="col-lg-8">

                <div class="gallery-subtitle">
                    ASEBA Basketball Academy
                </div>

                <h1 class="gallery-title">

                    Gallery
                    <span>Moments.</span>

                </h1>

                <p class="gallery-desc">

                    Dokumentasi kegiatan latihan, pertandingan,
                    event, serta berbagai momen terbaik
                    ASEBA Basketball Academy.

                </p>

            </div>

        </div>

    </div>

</section>


{{-- ==========================================================
     ALBUM HEADER
========================================================== --}}

<section class="gallery-top">

    <div class="container">

        <div class="d-flex justify-content-between align-items-center">

            <div class="gallery-count">

                Showing

                <b>
                    {{ $albums->count() }}
                </b>

                of

                <b>
                    {{ $totalAlbums }}
                </b>

                Albums

            </div>

        </div>

    </div>

</section>


{{-- ==========================================================
     ALBUM GRID
========================================================== --}}

<section class="gallery-grid">

    <div class="container">

        @if($albums->count())

            <div class="album-grid">

                @foreach($albums as $album)

                    <a
                        href="{{ route('main.galeri.show', $album->slug) }}"
                        class="album-card"
                    >

                        {{-- COVER --}}

                        <div class="album-cover">

                            @if(
                                $album->latestPhoto &&
                                $album->latestPhoto->photo
                            )

                                <img
                                    src="{{ asset('storage/' . $album->latestPhoto->photo) }}"
                                    alt="{{ $album->name }}"
                                >

                            @else

                                <div class="album-placeholder">

                                    <i class="bi bi-images"></i>

                                </div>

                            @endif


                            <div class="album-cover-overlay">

                                <div class="album-open-label">

                                    Buka Album

                                    <i class="bi bi-arrow-right"></i>

                                </div>

                            </div>

                        </div>


                        {{-- INFO --}}

                        <div class="album-info">

                            <div class="album-name">

                                {{ $album->name }}

                            </div>


                            <div class="album-meta">

                                <span>

                                    <i class="bi bi-images"></i>

                                    {{ $album->photos_count }} Foto

                                </span>


                                @if($album->album_date)

                                    <span>

                                        <i class="bi bi-calendar3"></i>

                                        {{
                                            \Carbon\Carbon::parse(
                                                $album->album_date
                                            )->translatedFormat('d F Y')
                                        }}

                                    </span>

                                @endif

                            </div>

                        </div>

                    </a>

                @endforeach

            </div>

        @else

            <div class="gallery-empty">

                <div class="gallery-empty-icon">

                    <i class="bi bi-images"></i>

                </div>

                <h3>
                    Belum Ada Album
                </h3>

                <p>
                    Dokumentasi Gallery ASEBA belum tersedia.
                </p>

            </div>

        @endif

    </div>

</section>


{{-- ==========================================================
     VIEW ALL GALLERY
========================================================== --}}

@if($totalAlbums > $albums->count())

    <section class="gallery-footer">

        <div class="container">

            <a
                href="{{ route('main.galeri') }}"
                class="gallery-button"
            >

                View All Gallery

                <i class="bi bi-arrow-right"></i>

            </a>

        </div>

    </section>

@endif


@endsection