@extends('admin.layouts.admin')

@section('title', 'Profile ASEBA')

@section('content')

<style>
    .profile-page {
        padding: 10px 0 30px;
    }

    /* =========================
       HEADER
    ========================= */

    .profile-heading {
        margin-bottom: 28px;
    }

    .profile-heading .eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #EA580C;
        font-size: 13px;
        font-weight: 700;
        letter-spacing: .08em;
        text-transform: uppercase;
        margin-bottom: 8px;
    }

    .profile-heading .eyebrow i {
        font-size: 15px;
    }

    .profile-heading h1 {
        margin: 0;
        color: #0F172A;
        font-size: 32px;
        font-weight: 800;
        line-height: 1.2;
    }

    .profile-heading p {
        margin: 9px 0 0;
        color: #64748B;
        font-size: 15px;
    }


    /* =========================
       SECTION TITLE
    ========================= */

    .profile-section-title {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        margin-bottom: 15px;
    }

    .profile-section-title h3 {
        margin: 0;
        color: #0F172A;
        font-size: 18px;
        font-weight: 800;
    }

    .profile-section-title span {
        color: #94A3B8;
        font-size: 13px;
    }


    /* =========================
       PROFILE MODULE CARDS
    ========================= */

    .profile-module {
        height: 100%;
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 16px;
        padding: 22px;
        transition: all .2s ease;
        box-shadow: 0 3px 12px rgba(15, 23, 42, .035);
    }

    .profile-module:hover {
        transform: translateY(-3px);
        border-color: #CBD5E1;
        box-shadow: 0 10px 25px rgba(15, 23, 42, .07);
    }

    .module-icon {
        width: 46px;
        height: 46px;
        border-radius: 13px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #FFF7ED;
        color: #EA580C;
        font-size: 21px;
        margin-bottom: 18px;
    }

    .profile-module h4 {
        margin: 0 0 7px;
        color: #0F172A;
        font-size: 17px;
        font-weight: 800;
    }

    .profile-module-description {
        color: #64748B;
        font-size: 13px;
        line-height: 1.6;
        min-height: 42px;
        margin-bottom: 18px;
    }

    .module-bottom {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        padding-top: 15px;
        border-top: 1px solid #F1F5F9;
    }

    .module-count {
        display: flex;
        flex-direction: column;
    }

    .module-count strong {
        color: #0F172A;
        font-size: 20px;
        font-weight: 800;
        line-height: 1;
    }

    .module-count span {
        color: #94A3B8;
        font-size: 11px;
        margin-top: 5px;
    }

    .module-btn {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        min-height: 38px;
        padding: 0 14px;
        border-radius: 9px;
        background: #0F172A;
        color: #FFFFFF;
        text-decoration: none;
        font-size: 13px;
        font-weight: 700;
        transition: all .2s ease;
    }

    .module-btn:hover {
        background: #EA580C;
        color: #FFFFFF;
    }


    /* =========================
       RESPONSIVE
    ========================= */

    @media (max-width: 767.98px) {

        .profile-page {
            padding-top: 5px;
        }

        .profile-heading h1 {
            font-size: 27px;
        }

        .profile-heading p {
            font-size: 14px;
        }

        .profile-section-title {
            align-items: flex-start;
            flex-direction: column;
            gap: 4px;
        }

        .profile-module {
            padding: 19px;
        }

        .module-bottom {
            align-items: flex-start;
        }
    }
</style>


<div class="profile-page">

    {{-- =========================
         PAGE HEADER
    ========================= --}}

    <div class="profile-heading">

        <div class="eyebrow">
            <i class="bi bi-person-vcard-fill"></i>
            Club Profile
        </div>

        <h1>Profile ASEBA</h1>

        <p>
            Kelola informasi utama ASEBA yang akan ditampilkan pada halaman profil klub.
        </p>

    </div>


    {{-- =========================
         PROFILE MODULES
    ========================= --}}

    <div class="profile-section-title">

        <div>
            <h3>Kelola Konten Profile</h3>
        </div>

        <span>
            Pilih bagian yang ingin dikelola
        </span>

    </div>


    <div class="row g-3">

        {{-- =========================
             CLUB HISTORY
        ========================= --}}

        <div class="col-lg-4 col-md-6">

            <div class="profile-module">

                <div class="module-icon">
                    <i class="bi bi-clock-history"></i>
                </div>

                <h4>Club History</h4>

                <div class="profile-module-description">
                    Kelola perjalanan dan sejarah ASEBA dari awal berdiri
                    hingga perkembangan klub saat ini.
                </div>

                <div class="module-bottom">

                    <div class="module-count">

                        <strong>
                            {{ $historyCount }}
                        </strong>

                        <span>
                            History Entries
                        </span>

                    </div>

                    <a href="{{ route('admin.aseba.profile.history') }}"
                       class="module-btn">

                        Kelola

                        <i class="bi bi-arrow-right"></i>

                    </a>

                </div>

            </div>

        </div>


        {{-- =========================
             MANAGEMENT BOARD
        ========================= --}}

        <div class="col-lg-4 col-md-6">

            <div class="profile-module">

                <div class="module-icon">
                    <i class="bi bi-people-fill"></i>
                </div>

                <h4>Management Board</h4>

                <div class="profile-module-description">
                    Kelola nama, jabatan, foto, kontak dan informasi
                    anggota management ASEBA.
                </div>

                <div class="module-bottom">

                    <div class="module-count">

                        <strong>
                            {{ $managementBoards->count() }}
                        </strong>

                        <span>
                            Management Members
                        </span>

                    </div>

                    <a href="{{ route('admin.aseba.profile.management') }}"
                       class="module-btn">

                        Kelola

                        <i class="bi bi-arrow-right"></i>

                    </a>

                </div>

            </div>

        </div>


        {{-- =========================
             ACHIEVEMENTS
        ========================= --}}

        <div class="col-lg-4 col-md-6">

            <div class="profile-module">

                <div class="module-icon">
                    <i class="bi bi-trophy-fill"></i>
                </div>

                <h4>Achievements</h4>

                <div class="profile-module-description">
                    Kelola pencapaian dan prestasi ASEBA yang akan
                    ditampilkan pada halaman utama klub.
                </div>

                <div class="module-bottom">

                    <div class="module-count">

                        <strong>
                            {{ $achievementCount }}
                        </strong>

                        <span>
                            Achievements
                        </span>

                    </div>

                    <a href="{{ route('admin.aseba.profile.achievements') }}"
                       class="module-btn">

                        Kelola

                        <i class="bi bi-arrow-right"></i>

                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection