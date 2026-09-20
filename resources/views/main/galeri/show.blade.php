@extends('main.layout.layout')

@section('title', $album->name . ' - Gallery')

@section('content')

<style>

:root {
    --brand: #ea580c;
    --dark: #0f172a;
}


/* ==========================================================
   PAGE
========================================================== */

.album-detail-page {

    padding: 80px 0 120px;

    background: #f8fafc;
}


/* ==========================================================
   BACK
========================================================== */

.album-back {

    display: inline-flex;

    align-items: center;

    gap: 8px;

    margin-bottom: 30px;

    color: #64748b;

    font-size: 13px;

    font-weight: 700;

    text-decoration: none;

    transition: .2s;
}


.album-back:hover {

    color: var(--brand);
}


/* ==========================================================
   HEADER
========================================================== */

.album-detail-header {

    background: #ffffff;

    border: 1px solid #e2e8f0;

    border-radius: 24px;

    padding: 34px;

    margin-bottom: 35px;

    box-shadow:
        0 12px 35px
        rgba(15,23,42,.05);
}


.album-label {

    display: inline-block;

    margin-bottom: 10px;

    color: var(--brand);

    font-size: 11px;

    font-weight: 800;

    letter-spacing: .18em;

    text-transform: uppercase;
}


.album-title {

    margin: 0;

    color: var(--dark);

    font-size: 42px;

    font-weight: 900;

    line-height: 1.1;
}


.album-meta {

    display: flex;

    align-items: center;

    gap: 18px;

    flex-wrap: wrap;

    margin-top: 16px;

    color: #64748b;

    font-size: 13px;
}


.album-meta span {

    display: inline-flex;

    align-items: center;

    gap: 6px;
}


.album-meta i {

    color: var(--brand);
}


.album-description {

    max-width: 760px;

    margin: 18px 0 0;

    color: #64748b;

    font-size: 14px;

    line-height: 1.8;
}


/* ==========================================================
   MASONRY
========================================================== */

.photo-masonry {

    columns: 4 220px;

    column-gap: 16px;
}


.photo-item {

    position: relative;

    display: inline-block;

    width: 100%;

    margin: 0 0 16px;

    overflow: hidden;

    border-radius: 14px;

    background: #e2e8f0;

    break-inside: avoid;
}


.photo-item img {

    display: block;

    width: 100%;

    height: auto;

    transition:
        transform .45s ease;
}


.photo-item:hover img {

    transform: scale(1.04);
}


.photo-overlay {

    position: absolute;

    inset: 0;

    display: flex;

    align-items: flex-end;

    padding: 16px;

    background:
        linear-gradient(
            transparent 55%,
            rgba(2,6,23,.65)
        );

    opacity: 0;

    transition: opacity .3s ease;
}


.photo-item:hover .photo-overlay {

    opacity: 1;
}


.photo-date {

    color: white;

    font-size: 11px;

    font-weight: 700;
}


/* ==========================================================
   EMPTY
========================================================== */

.album-empty {

    padding: 90px 20px;

    background: #ffffff;

    border: 1px dashed #cbd5e1;

    border-radius: 22px;

    text-align: center;
}


.album-empty-icon {

    width: 70px;

    height: 70px;

    margin: 0 auto 18px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 50%;

    background: #fff7ed;

    color: var(--brand);

    font-size: 30px;
}


.album-empty h3 {

    margin: 0 0 8px;

    color: var(--dark);

    font-size: 19px;

    font-weight: 800;
}


.album-empty p {

    margin: 0;

    color: #64748b;

    font-size: 14px;
}


/* ==========================================================
   RESPONSIVE
========================================================== */

@media(max-width: 1100px) {

    .photo-masonry {

        columns: 3 190px;
    }
}


@media(max-width: 768px) {

    .album-detail-page {

        padding: 55px 0 80px;
    }

    .album-detail-header {

        padding: 25px;

        border-radius: 18px;
    }

    .album-title {

        font-size: 32px;
    }

    .photo-masonry {

        columns: 2 150px;

        column-gap: 10px;
    }

    .photo-item {

        margin-bottom: 10px;

        border-radius: 9px;
    }
}


@media(max-width: 480px) {

    .album-title {

        font-size: 27px;
    }

    .album-detail-header {

        padding: 20px;
    }

    .photo-masonry {

        columns: 2 130px;

        column-gap: 8px;
    }

    .photo-item {

        margin-bottom: 8px;
    }
}

</style>


<section class="album-detail-page">

    <div class="container">


        {{-- ==================================================
             BACK
        ================================================== --}}

        <a
            href="{{ route('main.galeri') }}"
            class="album-back"
        >

            <i class="bi bi-arrow-left"></i>

            Kembali ke Gallery

        </a>


        {{-- ==================================================
             ALBUM HEADER
        ================================================== --}}

        <div class="album-detail-header">

            <span class="album-label">
                Gallery Album
            </span>


            <h1 class="album-title">

                {{ $album->name }}

            </h1>


            <div class="album-meta">

                <span>

                    <i class="bi bi-images"></i>

                    {{ $album->photos->count() }} Foto

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


            @if($album->description)

                <p class="album-description">

                    {{ $album->description }}

                </p>

            @endif

        </div>


        {{-- ==================================================
             PHOTO MASONRY
        ================================================== --}}

        @if($album->photos->count())

            <div class="photo-masonry">

                @foreach($album->photos as $photo)

                    <div class="photo-item">

                        <img
                            src="{{ asset('storage/' . $photo->photo) }}"
                            alt="{{ $album->name }}"
                            loading="lazy"
                        >


                        <div class="photo-overlay">

                            <div class="photo-date">

                                {{
                                    $photo->created_at
                                        ? $photo->created_at
                                            ->translatedFormat('d F Y')
                                        : ''
                                }}

                            </div>

                        </div>

                    </div>

                @endforeach

            </div>

        @else

            <div class="album-empty">

                <div class="album-empty-icon">

                    <i class="bi bi-images"></i>

                </div>


                <h3>
                    Album Masih Kosong
                </h3>


                <p>
                    Belum ada foto yang ditambahkan ke album ini.
                </p>

            </div>

        @endif


    </div>

</section>

@endsection