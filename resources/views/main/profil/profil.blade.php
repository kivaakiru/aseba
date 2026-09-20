@extends('main.layout.layout')

@section('title', 'Profil Klub')

@section('content')

<style>

    /* ================= HERO ================= */

    .profile-hero{
        background:
        linear-gradient(rgba(2,6,23,.88), rgba(2,6,23,.92)),
        url('{{ asset('images/gallery/basket4.png') }}');

        background-size:cover;
        background-position:center;

        padding:140px 0 110px;
        overflow:hidden;
        position:relative;
    }

    .profile-subtitle{
        color:#f97316;
        font-size:.72rem;
        font-weight:800;
        text-transform:uppercase;
        letter-spacing:4px;
    }

    .profile-title{
        font-size:5rem;
        font-weight:800;
        line-height:.95;
        text-transform:uppercase;
        font-style:italic;
        letter-spacing:-4px;

        color:#fff;

        margin:25px 0;
    }

    .profile-title span{
        color:#ea580c;
    }

    .profile-desc{
        color:#cbd5e1;
        max-width:680px;
        line-height:1.9;
    }

    /* ================= TIMELINE ================= */

    .timeline-section{
        padding:120px 0;
        position:relative;
    }

    .section-heading{
        text-align:center;
        margin-bottom:90px;
    }

    .section-heading h2{
        font-size:3rem;
        font-weight:800;
        text-transform:uppercase;
        font-style:italic;
        letter-spacing:-2px;
    }

    .section-heading span{
        color:#ea580c;
    }

    .timeline-wrapper{
        position:relative;
        max-width:1000px;
        margin:auto;
    }

    .timeline-line{
        position:absolute;
        left:50%;
        top:0;

        width:2px;
        height:100%;

        background:#e2e8f0;

        transform:translateX(-50%);
    }

    .timeline-item{
        position:relative;
        margin-bottom:100px;
    }

    .timeline-dot{
        width:20px;
        height:20px;

        background:#ea580c;

        border-radius:50%;

        position:absolute;
        left:50%;
        top:10px;

        transform:translateX(-50%);

        border:5px solid #fff;

        box-shadow:0 0 0 3px #ea580c;
    }

    .timeline-content{
        width:42%;
        background:#fff;

        border-radius:32px;
        padding:35px;

        border:1px solid #f1f5f9;

        box-shadow:0 15px 40px rgba(2,6,23,.04);
    }

    .timeline-left{
        margin-right:auto;
        text-align:right;
    }

    .timeline-right{
        margin-left:auto;
    }

    .timeline-year{
        color:#ea580c;

        font-size:.72rem;
        font-weight:800;
        text-transform:uppercase;
        letter-spacing:3px;

        margin-bottom:12px;
    }

    .timeline-title{
        font-size:2rem;
        font-weight:800;
        text-transform:uppercase;
        font-style:italic;

        margin-bottom:15px;
    }

    .timeline-desc{
        color:#64748b;
        line-height:1.9;
    }

    /* ================= MANAGEMENT ================= */

    .management-section{
        padding:20px 0 120px;
    }

    .management-card{
        background:#fff;

        border-radius:32px;

        padding:50px 35px;

        text-align:center;

        border:1px solid #e5e7eb;

        box-shadow:0 20px 45px rgba(15,23,42,.08);

        transition:.35s;

        height:100%;
    }

    .management-card:hover{
        transform:translateY(-8px);
    }

    .management-photo{

           width:170px;
           height:170px;

           margin:0 auto 30px;

           border-radius:50%;

           border:6px solid #fff;

           background:#000;

           object-fit:cover;

           box-shadow:0 15px 40px rgba(15,23,42,.15);

           display:block;

    }

    .management-card:hover .management-photo{
        border-color:#ea580c;
    }

    .management-name{
        font-size:1.3rem;
        font-weight:800;
        text-transform:uppercase;
        font-style:italic;
    }

    .management-role{
        color:#ea580c;

        font-size:.72rem;
        font-weight:800;
        text-transform:uppercase;
        letter-spacing:3px;

        margin-top:10px;
    }
    .management-divider{

    width:70%;

    height:1px;

    background:#e5e7eb;

    margin:18px auto;

}

.management-role{

    color:#475569;

    font-size:.9rem;

    font-weight:700;

    letter-spacing:.18em;

    text-transform:uppercase;

}

    /* ================= GALLERY ================= */

    /* ================= GALLERY ================= */

.gallery-section{

    padding:40px 0 120px;

}

.gallery-link{

    text-decoration:none;

    font-weight:800;

    color:#0f172a;

    transition:.3s;

}

.gallery-link:hover{

    color:#ea580c;

}

.gallery-preview{

    position:relative;

    display:block;

    overflow:hidden;

    border-radius:28px;

    aspect-ratio:4/3;

    background:#000;

    box-shadow:0 15px 35px rgba(15,23,42,.08);

}

.gallery-preview img{

    width:100%;

    height:100%;

    object-fit:cover;

    transition:.4s;

}

.gallery-overlay{

    position:absolute;

    inset:0;

    display:flex;

    justify-content:center;

    align-items:center;

    background:rgba(2,6,23,.45);

    opacity:0;

    transition:.3s;

}

.gallery-overlay i{

    color:#fff;

    font-size:30px;

}

.gallery-preview:hover img{

    transform:scale(1.08);

}

.gallery-preview:hover .gallery-overlay{

    opacity:1;

}

@media(max-width:991px){

    .gallery-link{

        font-size:.9rem;

    }

    .gallery-preview{

        border-radius:18px;

    }

}

    /* ================= RESPONSIVE ================= */

    @media(max-width:991px){

        .profile-title{
            font-size:3rem;
        }

        .timeline-line{
            display:none;
        }

        .timeline-dot{
            display:none;
        }

        .timeline-content{
            width:100%;
            text-align:left;
        }

        .timeline-left,
        .timeline-right{
            margin:auto;
        }

        .section-heading h2{
            font-size:2.2rem;
        }
    }

</style>

{{-- ================= HERO ================= --}}
<section class="profile-hero">

    <div class="container">

        <div class="row">

            <div class="col-lg-8">

                <div class="profile-subtitle">
                    ASEBA Basketball Academy
                </div>

                <h1 class="profile-title">
                    Our <span>Journey.</span>
                </h1>

                <p class="profile-desc">
                    Mengenal sejarah, perjalanan, dan perkembangan
                    ASEBA Basketball Academy dalam membangun
                    ekosistem basket modern dan profesional.
                </p>

            </div>

        </div>

    </div>

</section>

{{-- ================= HISTORY ================= --}}
<section class="timeline-section">

    <div class="container">

        <div class="section-heading">

            <h2>
                Club <span>History</span>
            </h2>

        </div>

        <div class="timeline-wrapper">

            <div class="timeline-line"></div>

            @forelse($histories as $index => $history)

                <div class="timeline-item">

                    <div class="timeline-dot"></div>

                    <div class="timeline-content {{ $index % 2 === 0 ? 'timeline-left' : 'timeline-right' }}">

                        <div class="timeline-year">
                            Year {{ $history->year }}
                        </div>

                        <div class="timeline-title">
                            {{ $history->title }}
                        </div>

                        @if($history->description)
                            <div class="timeline-desc">
                                {{ $history->description }}
                            </div>
                        @endif

                    </div>

                </div>

            @empty

                <div class="text-center py-5">
                    <p class="text-muted mb-0">
                        Belum ada sejarah ASEBA.
                    </p>
                </div>

            @endforelse

        </div>

    </div>

</section>

{{-- ================= MANAGEMENT ================= --}}
<section class="management-section">

    <div class="container">

        <div class="section-heading">

            <h2>
                Management <span>Board</span>
            </h2>

            <p class="text-muted mt-3">
                Struktur kepengurusan ASEBA Basketball Academy.
            </p>

        </div>

        <div class="row justify-content-center g-5">

            @forelse($managementBoards as $management)

                <div class="col-lg-5 col-md-6">

                    <div class="management-card">

                        {{-- FOTO --}}
                        @if($management->photo && file_exists(public_path('storage/' . $management->photo)))

                            <img
                                src="{{ asset('storage/' . $management->photo) }}"
                                class="management-photo"
                                alt="{{ $management->name }}">

                        @else

                            <div
                                class="management-photo d-flex align-items-center justify-content-center">

                                <i class="bi bi-person-fill text-white"
                                style="font-size:4rem;">
                                </i>

                            </div>

                        @endif


                        {{-- NAMA --}}
                        <div class="management-name">
                            {{ $management->name }}
                        </div>


                        {{-- ROLE --}}
                        <div class="management-role">

                            @foreach($management->roles as $role)

                                <div class="management-divider"></div>

                                <div class="management-role">
                                    {{ $role }}
                                </div>

                            @endforeach

                        </div>

                    </div>

                </div>

            @empty

                <div class="col-12 text-center">

                    <p class="text-muted">
                        Belum ada Management Board.
                    </p>

                </div>

            @endforelse

        </div>

    </div>

</section>

{{-- ================= GALLERY ================= --}}
{{-- ================= GALLERY ================= --}}
<section class="gallery-section">

    <div class="container">

        <div class="d-flex justify-content-between align-items-end mb-5">

            <div>
                <p
                    class="text-uppercase fw-bold mb-2"
                    style="
                        color:#ea580c;
                        font-size:11px;
                        letter-spacing:.35em;
                    ">
                    ASEBA Memories
                </p>

                <h2 class="section-title">
                    Gallery <span>Moments</span>
                </h2>
            </div>

            <a
                href="{{ route('main.galeri') }}"
                class="gallery-link">

                View All Gallery
                <i class="bi bi-arrow-right ms-2"></i>

            </a>

        </div>


        <div class="row g-4">

            @forelse($albums as $album)

                <div class="col-6 col-lg-3">

                    <a
                        href="{{ route('main.galeri.show', $album->slug) }}"
                        class="gallery-preview">

                        @if($album->latestPhoto)

                            <img
                                src="{{ asset('storage/' . $album->latestPhoto->photo) }}"
                                alt="{{ $album->name }}">

                        @else

                            <div class="d-flex align-items-center justify-content-center h-100">
                                <i class="bi bi-images text-white fs-1"></i>
                            </div>

                        @endif

                        <div class="gallery-overlay">

                            <div class="text-center text-white">

                                <i class="bi bi-folder2-open"></i>

                                <div class="mt-2 fw-bold">
                                    {{ $album->name }}
                                </div>

                            </div>

                        </div>

                    </a>

                </div>

            @empty

                <div class="col-12">

                    <div class="text-center py-5">

                        <i class="bi bi-images fs-1 text-muted"></i>

                        <p class="mt-3 text-muted mb-0">
                            Belum ada album gallery.
                        </p>

                    </div>

                </div>

            @endforelse

        </div>

    </div>

</section>

@endsection
