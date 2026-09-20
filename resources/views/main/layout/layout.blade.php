<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'ASEBA x ABHC')</title>

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Bootstrap Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    {{-- Google Font --}}
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

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
    </style>

    @stack('styles')
</head>
<body>

{{-- ================= NAVBAR ================= --}}
<nav class="navbar navbar-expand-lg navbar-main sticky-top">
    <div class="container">

        {{-- LOGO --}}
        <a class="navbar-brand" href="{{ url('/') }}">
            ASEBA<span>.</span>ABHC
        </a>

        {{-- TOGGLER --}}
        <button class="navbar-toggler border-0 shadow-none"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#mainNavbar">

            <i class="bi bi-list fs-2"></i>
        </button>

        {{-- MENU --}}
        <div class="collapse navbar-collapse" id="mainNavbar">

            {{-- CENTER MENU --}}
            <ul class="navbar-nav mx-auto gap-lg-4">

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/') ? 'active' : '' }}"
                       href="{{ url('/') }}">
                        Dashboard
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('jadwal*') ? 'active' : '' }}"
                       href="{{ url('/jadwal') }}">
                        Jadwal Lapangan
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('roster*') ? 'active' : '' }}"
                       href="{{ url('/roster') }}">
                        Roster ASEBA
                    </a>
                </li>



                <li class="nav-item">
                    <a class="nav-link {{ request()->is('profil*') ? 'active' : '' }}"
                       href="{{ url('/profil') }}">
                        Profil Klub
                    </a>
                </li>

            </ul>

            {{-- RIGHT MENU --}}
            <div class="d-flex align-items-center gap-2">

                @guest

                    <a href="{{ url('/user/login') }}"
                       class="btn btn-outline-premium">
                        Login
                    </a>

                    <a href="{{ url('/user/register/personal') }}"
                       class="btn btn-premium">
                        Register
                    </a>

                @endguest

                @auth

                    <div class="dropdown">

                        <button class="btn btn-light rounded-pill px-2 py-2 border d-flex align-items-center gap-2"
                                data-bs-toggle="dropdown">

                            <img
                                src="{{ auth()->user()->photo
                                    ? asset('storage/users/'.auth()->user()->photo)
                                    : asset('images/default-avatar.png')
                                }}"
                                class="navbar-avatar">

                            <span class="fw-bold small d-none d-lg-inline">
                                {{ auth()->user()->name }}
                            </span>
                        </button>

                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg p-2 rounded-4">

                            <li>
                                <a class="dropdown-item rounded-3 py-2"
                                   href="{{ url('/user/profile') }}">

                                    <i class="bi bi-person me-2"></i>
                                    Profil
                                </a>
                            </li>

                            <li><hr class="dropdown-divider"></li>

                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <button class="dropdown-item text-danger rounded-3 py-2">

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
<footer>
    <div class="container text-center">

        <div class="footer-title mb-3">
            Victory Starts Within
        </div>

        <div class="footer-mini mb-4 text-warning">
            ASEBA x ABHC MANAGEMENT SYSTEM
        </div>

        <p class="small text-secondary mb-2">
            Sistem Manajemen Klub dan Reservasi Lapangan Basket Modern
        </p>

        <p class="small text-secondary mb-0">
            © {{ date('Y') }} ASEBA x ABHC • Cikande, Banten
        </p>

    </div>
</footer>

{{-- Bootstrap --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

@stack('scripts')

</body>
</html>
