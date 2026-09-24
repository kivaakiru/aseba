<!doctype html>
<html lang="id">

<head>

    <meta charset="utf-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <title>
        @yield('title', 'ASEBA x ABHC')
    </title>


    {{-- Bootstrap --}}

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >


    {{-- Bootstrap Icons --}}

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
        rel="stylesheet"
    >


    {{-- Google Font --}}

    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >


    <style>

        :root{

            --primary:#ea580c;

            --dark:#020617;

            --dark-soft:#0f172a;

            --gray:#64748b;

            --light:#f8fafc;

            --border:#e2e8f0;
        }


        *{

            font-family:'Plus Jakarta Sans', sans-serif;
        }


        body{

            background:var(--light);

            color:var(--dark);

            overflow-x:hidden;
        }


        a{

            text-decoration:none;
        }


        /* ================= NAVBAR ================= */


        .navbar-main{

            background:rgba(255,255,255,.92);

            backdrop-filter:blur(14px);

            border-bottom:1px solid #f1f5f9;

            padding:18px 0;
        }


        .navbar-brand{

            font-size:1.7rem;

            font-weight:800;

            font-style:italic;

            letter-spacing:-1px;

            color:var(--dark) !important;
        }


        .navbar-brand span{

            color:var(--primary);
        }


        .nav-link{

            font-size:.72rem;

            font-weight:800;

            text-transform:uppercase;

            letter-spacing:1.5px;

            color:var(--gray);

            transition:.3s;

            position:relative;
        }


        .nav-link:hover,
        .nav-link.active{

            color:var(--primary);
        }


        .nav-link.active::after{

            content:'';

            position:absolute;

            left:0;

            bottom:-8px;

            width:100%;

            height:2px;

            background:var(--primary);

            border-radius:10px;
        }


        /* ================= BUTTON ================= */


        .btn-premium{

            background:var(--primary);

            color:#fff;

            border:none;

            padding:14px 24px;

            border-radius:18px;

            font-size:.7rem;

            font-weight:800;

            text-transform:uppercase;

            letter-spacing:2px;

            transition:.3s;
        }


        .btn-premium:hover{

            background:var(--dark);

            color:#fff;

            transform:translateY(-2px);
        }


        .btn-outline-premium{

            border:1px solid #cbd5e1;

            background:#fff;

            color:var(--dark);

            padding:14px 24px;

            border-radius:18px;

            font-size:.7rem;

            font-weight:800;

            text-transform:uppercase;

            letter-spacing:2px;

            transition:.3s;
        }


        .btn-outline-premium:hover{

            background:var(--dark);

            border-color:var(--dark);

            color:#fff;
        }


        /* ================= CARD ================= */


        .card-premium{

            background:#fff;

            border:1px solid #f1f5f9;

            border-radius:36px;

            transition:.4s;

            overflow:hidden;
        }


        .card-premium:hover{

            transform:translateY(-6px);

            box-shadow:0 25px 50px rgba(2,6,23,.08);
        }


        /* ================= SECTION ================= */


        .section-title{

            font-size:3rem;

            font-weight:800;

            text-transform:uppercase;

            font-style:italic;

            letter-spacing:-2px;
        }


        .section-title span{

            color:var(--primary);
        }


        /* ================= AVATAR ================= */


        .navbar-avatar{

            width:42px;

            height:42px;

            object-fit:cover;

            border-radius:50%;

            border:2px solid #fff;
        }


        /* ================= FOOTER ================= */


        footer{

            background:var(--dark);

            color:#94a3b8;

            padding:80px 0 50px;

            margin-top:120px;
        }


        .footer-title{

            color:#fff;

            font-weight:800;

            text-transform:uppercase;

            font-style:italic;

            letter-spacing:2px;
        }


        .footer-mini{

            font-size:.7rem;

            text-transform:uppercase;

            letter-spacing:3px;
        }


        /* ================= FOOTER CONTACT ================= */


        .footer-contact-wrapper{

            max-width:950px;

            margin:0 auto 45px;
        }


        .footer-contact-grid{

            display:grid;

            grid-template-columns:repeat(2, minmax(0, 1fr));

            gap:55px;

            text-align:left;
        }


        .footer-contact-column{

            min-width:0;
        }


        .footer-contact-title{

            color:#fff;

            font-size:.72rem;

            font-weight:800;

            text-transform:uppercase;

            letter-spacing:2px;

            margin-bottom:18px;
        }


        .footer-contact-item{

            display:flex;

            align-items:flex-start;

            gap:12px;

            margin-bottom:14px;
        }


        .footer-contact-icon{

            width:34px;

            height:34px;

            min-width:34px;

            border-radius:10px;

            display:flex;

            align-items:center;

            justify-content:center;

            background:rgba(255,255,255,.08);

            color:#fff;

            font-size:15px;
        }


        .footer-contact-content{

            min-width:0;

            flex:1;

            padding-top:4px;
        }


        .footer-contact-value{

            color:#94a3b8;

            font-size:.72rem;

            line-height:1.7;

            word-break:break-word;
        }


        .footer-contact-value a{

            color:#94a3b8;

            transition:.2s;
        }


        .footer-contact-value a:hover{

            color:#fff;
        }


        .footer-map-link{

            display:inline-flex;

            align-items:center;

            gap:5px;

            margin-top:3px;

            color:var(--primary) !important;

            font-size:.65rem;

            font-weight:700;

            text-transform:uppercase;

            letter-spacing:.5px;
        }


        .footer-map-link:hover{

            color:#fb923c !important;
        }


        /* ================= SOCIAL COLORS ================= */


        .footer-icon-instagram{

            color:#e1306c;
        }


        .footer-icon-facebook{

            color:#1877f2;
        }


        .footer-icon-tiktok{

            color:#fff;
        }


        .footer-icon-youtube{

            color:#ff0000;
        }


        .footer-icon-x{

            color:#fff;
        }


        .footer-icon-whatsapp{

            color:#25d366;
        }


        .footer-icon-telegram{

            color:#229ed9;
        }


        .footer-icon-email{

            color:#fb923c;
        }


        .footer-icon-website{

            color:#60a5fa;
        }


        /* ================= RESPONSIVE ================= */


        @media(max-width:991px){

            .section-title{

                font-size:2.2rem;
            }


            .navbar-collapse{

                padding-top:20px;
            }


            .nav-link{

                padding:12px 0;
            }
        }


        @media(max-width:767px){

            .footer-contact-grid{

                grid-template-columns:1fr;

                gap:25px;
            }

        }

    </style>


    @stack('styles')

</head>


<body>


{{-- ================= NAVBAR ================= --}}

<nav class="navbar navbar-expand-lg navbar-main sticky-top">

    <div class="container">


        {{-- LOGO --}}

        <a
            class="navbar-brand"
            href="{{ url('/') }}"
        >

            ASEBA<span>.</span>ABHC

        </a>


        {{-- TOGGLER --}}

        <button
            class="navbar-toggler border-0 shadow-none"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#mainNavbar"
        >

            <i class="bi bi-list fs-2"></i>

        </button>


        {{-- MENU --}}

        <div
            class="collapse navbar-collapse"
            id="mainNavbar"
        >


            {{-- CENTER MENU --}}

            <ul class="navbar-nav mx-auto gap-lg-4">


                <li class="nav-item">

                    <a
                        class="nav-link {{ request()->is('/') ? 'active' : '' }}"
                        href="{{ url('/') }}"
                    >

                        Dashboard

                    </a>

                </li>


                <li class="nav-item">

                    <a
                        class="nav-link {{ request()->is('jadwal*') ? 'active' : '' }}"
                        href="{{ url('/jadwal') }}"
                    >

                        Jadwal Lapangan

                    </a>

                </li>


                <li class="nav-item">

                    <a
                        class="nav-link {{ request()->is('roster*') ? 'active' : '' }}"
                        href="{{ url('/roster') }}"
                    >

                        Roster ASEBA

                    </a>

                </li>


                <li class="nav-item">

                    <a
                        class="nav-link {{ request()->is('profil*') ? 'active' : '' }}"
                        href="{{ url('/profil') }}"
                    >

                        Profil Klub

                    </a>

                </li>


            </ul>


            {{-- RIGHT MENU --}}

            <div class="d-flex align-items-center gap-2">


                @guest

                    <a
                        href="{{ url('/user/login') }}"
                        class="btn btn-outline-premium"
                    >

                        Login

                    </a>


                    <a
                        href="{{ url('/user/register/personal') }}"
                        class="btn btn-premium"
                    >

                        Register

                    </a>

                @endguest


                @auth

                    <div class="dropdown">


                        <button
                            class="btn btn-light rounded-pill px-2 py-2 border d-flex align-items-center gap-2"
                            data-bs-toggle="dropdown"
                        >

                            <img
                                src="{{ auth()->user()->photo
                                    ? asset('storage/users/'.auth()->user()->photo)
                                    : asset('images/default-avatar.png')
                                }}"
                                class="navbar-avatar"
                            >


                            <span class="fw-bold small d-none d-lg-inline">

                                {{ auth()->user()->name }}

                            </span>

                        </button>


                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg p-2 rounded-4">


                            <li>

                                <a
                                    class="dropdown-item rounded-3 py-2"
                                    href="{{ url('/user/profile') }}"
                                >

                                    <i class="bi bi-person me-2"></i>

                                    Profil

                                </a>

                            </li>


                            <li>

                                <hr class="dropdown-divider">

                            </li>


                            <li>

                                <form
                                    method="POST"
                                    action="{{ route('logout') }}"
                                >

                                    @csrf

                                    <button
                                        class="dropdown-item text-danger rounded-3 py-2"
                                    >

                                        <i class="bi bi-box-arrow-right me-2"></i>

                                        Logout

                                    </button>

                                </form>

                            </li>


                        </ul>


                    </div>

                @endauth


            </div>


        </div>


    </div>

</nav>


{{-- ================= CONTENT ================= --}}

<main>

    @yield('content')

</main>


{{-- ================= FOOTER ================= --}}

@php

    $footerAddresses = \App\Models\ProfileContact::where(
        'type',
        'address'
    )
    ->orderBy('sort_order')
    ->orderBy('id')
    ->get();


    $footerSocials = \App\Models\ProfileContact::where(
        'type',
        '!=',
        'address'
    )
    ->orderBy('sort_order')
    ->orderBy('id')
    ->get();

@endphp


<footer>

    <div class="container text-center">


        <div class="footer-title mb-3">

            Victory Starts Within

        </div>


        <div class="footer-mini mb-4 text-warning">

            ASEBA x ABHC MANAGEMENT SYSTEM

        </div>


        {{-- ================= FOOTER CONTACT ================= --}}

        @if(
            $footerAddresses->count()
            ||
            $footerSocials->count()
        )

            <div class="footer-contact-wrapper">

                <div class="footer-contact-grid">


                    {{-- ================= ALAMAT ================= --}}

                    @if($footerAddresses->count())

                        <div class="footer-contact-column">

                            <div class="footer-contact-title">

                                Alamat Lokasi

                            </div>


                            @foreach($footerAddresses as $address)

                                <div class="footer-contact-item">


                                    <div class="footer-contact-icon">

                                        <i class="bi bi-geo-alt-fill"></i>

                                    </div>


                                    <div class="footer-contact-content">


                                        <div class="footer-contact-value">

                                            <strong
                                                style="color:#fff;"
                                            >

                                                {{ $address->label }}

                                            </strong>

                                        </div>


                                        <div class="footer-contact-value">

                                            {{ $address->value }}

                                        </div>


                                        @if($address->link)

                                            <a
                                                href="{{ $address->link }}"
                                                target="_blank"
                                                rel="noopener noreferrer"
                                                class="footer-map-link"
                                            >

                                                <i class="bi bi-map-fill"></i>

                                                Google Maps

                                                <i class="bi bi-arrow-up-right"></i>

                                            </a>

                                        @endif


                                    </div>


                                </div>

                            @endforeach

                        </div>

                    @endif


                    {{-- ================= SOSIAL MEDIA ================= --}}

                    @if($footerSocials->count())

                        <div class="footer-contact-column">

                            <div class="footer-contact-title">

                                Sosial Media & Kontak

                            </div>


                            @foreach($footerSocials as $social)

                                @php

                                    $iconClass = match($social->type) {

                                        'instagram' =>
                                            'bi-instagram footer-icon-instagram',

                                        'facebook' =>
                                            'bi-facebook footer-icon-facebook',

                                        'tiktok' =>
                                            'bi-tiktok footer-icon-tiktok',

                                        'youtube' =>
                                            'bi-youtube footer-icon-youtube',

                                        'x' =>
                                            'bi-twitter-x footer-icon-x',

                                        'whatsapp' =>
                                            'bi-whatsapp footer-icon-whatsapp',

                                        'telegram' =>
                                            'bi-telegram footer-icon-telegram',

                                        'email' =>
                                            'bi-envelope-fill footer-icon-email',

                                        'website' =>
                                            'bi-globe2 footer-icon-website',

                                        default =>
                                            'bi-link-45deg',

                                    };

                                @endphp


                                <div class="footer-contact-item">


                                    <div class="footer-contact-icon">

                                        <i class="bi {{ $iconClass }}"></i>

                                    </div>


                                    <div class="footer-contact-content">

                                        <div class="footer-contact-value">

                                            @if($social->link)

                                                <a
                                                    href="{{ $social->link }}"
                                                    target="_blank"
                                                    rel="noopener noreferrer"
                                                >

                                                    {{ $social->value }}

                                                </a>

                                            @else

                                                {{ $social->value }}

                                            @endif

                                        </div>

                                    </div>


                                </div>

                            @endforeach

                        </div>

                    @endif


                </div>

            </div>

        @endif


        <p class="small text-secondary mb-2">

            Sistem Manajemen Klub ASEBA dan Reservasi Lapangan Basket ABHC

        </p>


        <p class="small text-secondary mb-0">

            © {{ date('Y') }} ASEBA x ABHC • Serang, Banten

        </p>


    </div>

</footer>


{{-- Bootstrap --}}

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>


@stack('scripts')


</body>

</html>