<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>@yield('title','Dashboard') | ASEBA User</title>

    <meta name="theme-color"
          content="#EA580C">

    <!-- Bootstrap -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <!-- Bootstrap Icons -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
          rel="stylesheet">

    <!-- Google Font -->

    <link rel="preconnect"
          href="https://fonts.googleapis.com">

    <link rel="preconnect"
          href="https://fonts.gstatic.com"
          crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
          rel="stylesheet">

    <style>

        /* ==========================================================
                            ROOT
        ========================================================== */

        :root{

            --primary:#EA580C;
            --primary-hover:#C2410C;

            --dark:#0F172A;
            --dark-light:#1E293B;

            --background:#F8FAFC;

            --card:#FFFFFF;

            --border:#E2E8F0;

            --text:#0F172A;
            --muted:#64748B;

            --success:#22C55E;
            --danger:#EF4444;
            --warning:#F59E0B;
            --info:#3B82F6;

            --radius:20px;

            --shadow:

                0 15px 40px rgba(15,23,42,.08);

            --transition:.30s ease;

            --sidebar-width:280px;

            --sidebar-collapse:90px;

            --topbar-height:82px;

        }

        /* ==========================================================
                            RESET
        ========================================================== */

        *{

            margin:0;
            padding:0;

            box-sizing:border-box;

        }

        html{

            scroll-behavior:smooth;

        }

        body{

            font-family:'Inter',sans-serif;
            background:var(--background);
            color:var(--text);
            overflow-x:hidden;
            width:100%;
            min-width:320px;

        }

        html{
            overflow-x:hidden;

        }

        img{

            max-width:100%;

            display:block;

        }

        a{

            color:inherit;

            text-decoration:none;

        }

        button{

            border:none;

            outline:none;

            background:none;

        }

        ul{

            list-style:none;

            margin:0;

            padding:0;

        }

        input,
        textarea,
        select{

            outline:none;

            box-shadow:none;

        }

        /* ==========================================================
                            SCROLLBAR
        ========================================================== */

        ::-webkit-scrollbar{

            width:8px;
            height:8px;

        }

        ::-webkit-scrollbar-track{

            background:#F1F5F9;

        }

        ::-webkit-scrollbar-thumb{

            background:#CBD5E1;

            border-radius:100px;

        }

        ::-webkit-scrollbar-thumb:hover{

            background:#94A3B8;

        }

        ::selection{

            background:#EA580C;

            color:#fff;

        }

        /* ==========================================================
                            APP
        ========================================================== */

        .app{

            display:flex;

            min-height:100vh;

        }

        /* ==========================================================
                            SIDEBAR
        ========================================================== */

        .sidebar{

            position:fixed;

            left:0;
            top:0;

            width:var(--sidebar-width);

            height:100vh;

            background:var(--dark);

            display:flex;

            flex-direction:column;

            transition:var(--transition);

            z-index:1050;

            overflow:hidden;

        }

        .sidebar.collapsed{

            width:var(--sidebar-collapse);

        }

        /* ==========================================================
                            BRAND
        ========================================================== */

        .sidebar-brand{

            height:84px;

            display:flex;

            align-items:center;

            gap:16px;

            padding:0 24px;

            border-bottom:1px solid rgba(255,255,255,.08);

            flex-shrink:0;

        }

        .brand-logo{

            width:50px;
            height:50px;

            border-radius:16px;

            background:linear-gradient(

                135deg,

                #EA580C,

                #FB923C

            );

            display:flex;

            justify-content:center;

            align-items:center;

            color:#fff;

            font-size:22px;

            flex-shrink:0;

        }

        .brand-text{

            transition:.25s;

        }

        .brand-text h4{

            color:#fff;

            font-size:18px;

            font-weight:800;

            margin:0;

            line-height:1;

        }

        .brand-text span{

            color:#94A3B8;

            font-size:12px;

            display:block;

            margin-top:4px;

        }
        /* ==========================================================
                            SIDEBAR MENU
        ========================================================== */

        .sidebar-menu{

            flex:1;

            overflow-y:auto;

            overflow-x:hidden;

            padding:24px 18px;

            scrollbar-width:thin;

            scrollbar-color:#334155 transparent;

        }

        .sidebar-menu::-webkit-scrollbar{

            width:6px;

        }

        .sidebar-menu::-webkit-scrollbar-thumb{

            background:#334155;

            border-radius:100px;

        }

        .sidebar-menu::-webkit-scrollbar-track{

            background:transparent;

        }

        .menu-title{

            color:#64748B;

            font-size:11px;

            font-weight:700;

            letter-spacing:.15em;

            text-transform:uppercase;

            margin:24px 16px 12px;

            user-select:none;

        }

        .menu-item{

            display:flex;

            align-items:center;

            gap:16px;

            padding:14px 18px;

            margin-bottom:6px;

            border-radius:16px;

            color:#CBD5E1;

            font-size:15px;

            font-weight:600;

            transition:var(--transition);

            position:relative;

            overflow:hidden;

        }

        .menu-item i{

            min-width:22px;

            text-align:center;

            font-size:20px;

            transition:.25s;

        }

        .menu-item span{

            white-space:nowrap;

            transition:.25s;

        }

        .menu-item:hover{

            color:#fff;

            background:rgba(234,88,12,.10);

            transform:translateX(4px);

        }

        .menu-item:hover i{

            transform:scale(1.1);

        }

        .menu-item.active{

            background:linear-gradient(

                135deg,

                #EA580C,

                #FB923C

            );

            color:#fff;

            box-shadow:

                0 10px 24px rgba(234,88,12,.35);

        }

        .menu-item.active::before{

            content:"";

            position:absolute;

            left:0;

            top:0;

            width:4px;

            height:100%;

            background:#fff;

            border-radius:0 8px 8px 0;

        }

        /* ==========================================================
                            SIDEBAR FOOTER
        ========================================================== */

        .sidebar-footer{

            padding:20px;

            border-top:1px solid rgba(255,255,255,.08);

            flex-shrink:0;

            background:rgba(255,255,255,.02);

        }

        .admin-card{

            display:flex;

            align-items:center;

            gap:14px;

            margin-bottom:18px;

        }

        .admin-card img{

            width:50px;

            height:50px;

            object-fit:cover;

            border-radius:50%;

            border:3px solid rgba(255,255,255,.08);

            flex-shrink:0;

        }

        .admin-info{

            overflow:hidden;

        }

        .admin-info h6{

            color:#fff;

            font-size:15px;

            font-weight:700;

            margin:0;

            white-space:nowrap;

            overflow:hidden;

            text-overflow:ellipsis;

        }

        .admin-info small{

            display:block;

            color:#94A3B8;

            margin-top:3px;

            font-size:12px;

        }

        .logout-btn{

            width:100%;

            height:48px;

            border:none;

            border-radius:14px;

            background:#EF4444;

            color:#fff;

            display:flex;

            align-items:center;

            justify-content:center;

            gap:10px;

            font-weight:600;

            transition:var(--transition);

            cursor:pointer;

        }

        .logout-btn:hover{

            background:#DC2626;

            transform:translateY(-2px);

        }

        /* ==========================================================
                        COLLAPSE SIDEBAR
        ========================================================== */

        .sidebar.collapsed .brand-text,

        .sidebar.collapsed .menu-title,

        .sidebar.collapsed .menu-item span,

        .sidebar.collapsed .admin-info{

            display:none;

        }

        .sidebar.collapsed .sidebar-brand{

            justify-content:center;

            padding:0;

        }

        .sidebar.collapsed .menu-item{

            justify-content:center;

            padding:16px;

        }

        .sidebar.collapsed .sidebar-footer{

            padding:16px;

        }

        .sidebar.collapsed .admin-card{

            justify-content:center;

        }

        .sidebar.collapsed .logout-btn{

            width:58px;

            height:58px;

            margin:auto;

            border-radius:16px;

        }

        .sidebar.collapsed .logout-btn span{

            display:none;

        }
        /* ==========================================================
                            MAIN CONTENT
        ========================================================== */

        .main-content{

             flex:1;
             margin-left:var(--sidebar-width);
             width:calc(100% - var(--sidebar-width));
             min-width:0;
             min-height:100vh;
             display:flex;
             flex-direction:column;
             transition:var(--transition);

        }

        body.sidebar-collapse .main-content{

            margin-left:var(--sidebar-collapse);

        }

        /* ==========================================================
                            TOPBAR
        ========================================================== */

        .topbar{

            position:sticky;

            top:0;

            z-index:1000;

            height:var(--topbar-height);

            background:#fff;

            border-bottom:1px solid var(--border);

            display:flex;

            align-items:center;

            justify-content:space-between;

            padding:0 30px;

        }

        .topbar-left{

            display:flex;

            align-items:center;

            gap:18px;

        }

        .toggle-sidebar{

            width:48px;

            height:48px;

            border-radius:14px;

            background:#fff;

            box-shadow:var(--shadow);

            display:flex;

            align-items:center;

            justify-content:center;

            cursor:pointer;

            transition:var(--transition);

        }

        .toggle-sidebar:hover{

            background:var(--primary);

            color:#fff;

            transform:translateY(-2px);

        }

        .toggle-sidebar i{

            font-size:22px;

        }

        .page-info{

            display:flex;

            flex-direction:column;

        }

        .page-title{

            margin:0;

            font-size:24px;

            font-weight:800;

            color:var(--text);

        }

        .page-subtitle{

            margin-top:3px;

            font-size:13px;

            color:var(--muted);

        }

        /* ==========================================================
                            TOPBAR RIGHT
        ========================================================== */

        .topbar-right{

            display:flex;

            align-items:center;

            gap:14px;

        }

        .icon-btn{

            width:46px;

            height:46px;

            border-radius:14px;

            background:#fff;

            display:flex;

            align-items:center;

            justify-content:center;

            box-shadow:var(--shadow);

            cursor:pointer;

            transition:var(--transition);

            position:relative;

        }

        .icon-btn i{

            font-size:18px;

        }

        .icon-btn:hover{

            background:var(--primary);

            color:#fff;

            transform:translateY(-2px);

        }

        .notification-dot{

            position:absolute;

            top:10px;

            right:10px;

            width:8px;

            height:8px;

            border-radius:50%;

            background:#EF4444;

        }

        .profile-box{

            display:flex;

            align-items:center;

            gap:14px;

            margin-left:8px;

        }

        .profile-box img{

            width:48px;

            height:48px;

            border-radius:50%;

            object-fit:cover;

            border:3px solid #F1F5F9;

        }

        .profile-box h6{

            margin:0;

            font-size:15px;

            font-weight:700;

            color:var(--text);

        }

        .profile-box small{

            display:block;

            margin-top:2px;

            color:var(--muted);

            font-size:12px;

        }

        /* ==========================================================
                            CONTENT
        ========================================================== */

        .content-wrapper{

            flex:1;
            width:100%;
            max-width:100%;
            overflow-x:hidden;
            padding:30px;

        }

        /* ==========================================================
                            COMPONENT
        ========================================================== */

        .dashboard-card,
        .card{

            border:none;

            border-radius:var(--radius);

            box-shadow:var(--shadow);

            transition:var(--transition);

        }

        .dashboard-card:hover,
        .card:hover{

            transform:translateY(-4px);

        }

        .btn{

            border-radius:14px;

            font-weight:600;

        }

        .form-control,
        .form-select{

            min-height:48px;

            border-radius:14px;

            border-color:var(--border);

        }

        .form-control:focus,
        .form-select:focus{

            border-color:var(--primary);

            box-shadow:0 0 0 .2rem rgba(234,88,12,.15);

        }

        .table{

            vertical-align:middle;

        }

        .table th{

            border-bottom:none;

            color:var(--muted);

            font-size:13px;

            font-weight:700;

            text-transform:uppercase;

        }

        .badge{

            border-radius:100px;

            padding:8px 14px;

            font-weight:600;

        }
/* ==========================================================
   DASHBOARD CARD
========================================================== */

.card-dashboard{
    background:#ffffff;
    border:1px solid #E5E7EB;
    border-radius:18px;
    box-shadow:0 2px 10px rgba(15,23,42,.05);
    transition:.25s ease;
}

.card-dashboard:hover{
    box-shadow:0 10px 24px rgba(15,23,42,.08);
    transform:translateY(-2px);
}

.card-dashboard a{
    text-decoration:none;
}

.card-dashboard .badge{
    border-radius:999px;
    font-weight:600;
}

.card-dashboard hr{
    border-color:#E5E7EB;
}



.status-badge{
    display:inline-flex;
    justify-content:center;
    align-items:center;

    width:96px;
    height:30px;

    border-radius:999px;

    font-size:12px;
    font-weight:700;
    text-transform:uppercase;
    letter-spacing:.3px;
}

.status-approved{
    background:#16A34A !important;
    color:#fff !important;
}


.status-pending{
    background:#F59E0B !important;
    color:#fff !important;
}

.status-rejected{
    background:#EF4444 !important;
    color:#fff !important;
}

.status-cancelled{
    background:#64748B !important;
    color:#fff !important;
}

.status-default{
    background:#1F2937 !important;
    color:#fff !important;
}



</style>



@stack('styles')




</head>

<body>

<div class="app">

    <!-- ==========================================================
                            SIDEBAR
    =========================================================== -->

    <aside class="sidebar"
           id="sidebar">

        <!-- ================= BRAND ================= -->

        <div class="sidebar-brand">

            <div class="brand-logo">

                <i class="bi bi-dribbble"></i>

            </div>

            <div class="brand-text">

                <h4>ASEBA</h4>

                <span>User Panel</span>

            </div>

        </div>

        <!-- ================= MENU ================= -->

        <div class="sidebar-menu">

                        <!-- MAIN -->

                        <div class="menu-title">

                Main

            </div>

            <a
                href="{{ route('user.dashboard') }}"
                class="menu-item {{ request()->routeIs('user.dashboard') ? 'active' : '' }}">

                <i class="bi bi-grid-fill"></i>

                <span>Dashboard</span>

            </a>

            <div class="menu-title">

                Reservasi

            </div>

            <a
                href="{{ route('user.booking.index') }}"
                class="menu-item {{ request()->routeIs('user.booking.index') ? 'active' : '' }}">

                <i class="bi bi-calendar-check-fill"></i>

                <span>Booking Lapangan</span>

            </a>

            <a
                href="{{ route('user.booking.history') }}"
                class="menu-item {{ request()->routeIs('user.booking.history') ? 'active' : '' }}">

                <i class="bi bi-clock-history"></i>

                <span>Riwayat Booking</span>

            </a>

            <div class="menu-title">

                Akun

            </div>

            <a
                href="{{ route('user.profile.index') }}"
                class="menu-item {{ request()->routeIs('user.profile.*') ? 'active' : '' }}">

                <i class="bi bi-person-circle"></i>

                <span>Profil Saya</span>

            </a>
        </div>

        <!-- ================= FOOTER ================= -->

        <div class="sidebar-footer">

            <div class="admin-card">

                <img
                    src="{{ auth()->user()->photo
                        ? asset('storage/users/'.auth()->user()->photo)
                        : asset('images/default-avatar.png') }}"
                    alt="User">

                <div class="admin-info">

                    <h6>

                        {{ auth()->user()->name ?? 'Administrator' }}

                    </h6>

                    <small>

                        {{ ucfirst(auth()->user()->user_type ?? 'User') }}

                    </small>

                </div>

            </div>

            <form method="POST"
                  action="{{ route('logout') }}">

                @csrf

                <button
                    type="submit"
                    class="logout-btn">

                    <i class="bi bi-box-arrow-right"></i>

                    <span>Logout</span>

                </button>

            </form>

        </div>

    </aside>
        <!-- ==========================================================
                            MAIN CONTENT
    =========================================================== -->

    <main class="main-content">

        <!-- ================= TOPBAR ================= -->

        <header class="topbar">

            <div class="topbar-left">

                <button
                    class="toggle-sidebar"
                    id="toggleSidebar">

                    <i class="bi bi-list"></i>

                </button>

                <div class="page-info">

                    <h3 class="page-title">

                        @yield('page-title','Dashboard')

                    </h3>

                    <p class="page-subtitle">

                        @yield('page-subtitle','Selamat datang kembali di ASEBA User Panel.')

                    </p>

                </div>

            </div>

            <div class="topbar-right">

                <a
                    href="{{ route('main.home') }}"
                    class="icon-btn"
                    title="Home Page">

                    <i class="bi bi-house-door-fill"></i>

                </a>

                <button
                    class="icon-btn"
                    title="Notification">

                    <i class="bi bi-bell"></i>

                </button>

                <div class="profile-box">

                    <img
                        src="{{ auth()->user()->photo
                            ? asset('storage/users/'.auth()->user()->photo)
                            : asset('images/default-avatar.png') }}"
                        alt="User">

                    <div>

                        <h6>

                            {{ auth()->user()->name }}

                        </h6>

                        <small>

                            {{ ucfirst(auth()->user()->user_type ?? 'User') }}

                        </small>

                    </div>

                </div>

            </div>

        </header>

        <!-- ================= CONTENT ================= -->

        <section class="content-wrapper">

            @yield('content')

        </section>

    </main>

</div>

<!-- Bootstrap JS -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>

document.addEventListener("DOMContentLoaded",function(){

    const sidebar=document.getElementById("sidebar");

    const toggle=document.getElementById("toggleSidebar");

    /* ===============================
            TOGGLE SIDEBAR
    ================================ */

    toggle.addEventListener("click",function(){

        if(window.innerWidth<=992){

            sidebar.classList.toggle("show");

            return;

        }

        sidebar.classList.toggle("collapsed");

        document.body.classList.toggle("sidebar-collapse");

    });

    /* ===============================
            CLOSE MOBILE
    ================================ */

    document.addEventListener("click",function(e){

        if(window.innerWidth>992) return;

        if(

            !sidebar.contains(e.target) &&

            !toggle.contains(e.target)

        ){

            sidebar.classList.remove("show");

        }

    });

    /* ===============================
            WINDOW RESIZE
    ================================ */

    window.addEventListener("resize",function(){

        if(window.innerWidth>992){

            sidebar.classList.remove("show");

        }

    });

});

</script>
@stack('scripts')
<style>

/* ======================================================
                    RESPONSIVE
====================================================== */

@media (max-width:1200px){

    .sidebar{

        width:250px;

    }

    .main-content{

        margin-left:250px;

    }

}

@media (max-width:992px){

    .sidebar{

        left:-280px;

        width:280px;

        transition:.30s;

    }

    .sidebar.show{

        left:0;

        box-shadow:

            0 0 0 9999px rgba(15,23,42,.45);

    }

    .sidebar.collapsed{

        width:280px;

    }

    .sidebar.collapsed .brand-text,

    .sidebar.collapsed .menu-title,

    .sidebar.collapsed .menu-item span,

    .sidebar.collapsed .admin-info{

        display:block;

    }

    .sidebar.collapsed .menu-item{

        justify-content:flex-start;

        padding:14px 18px;

    }

    .sidebar.collapsed .sidebar-brand{

        justify-content:flex-start;

        padding:0 24px;

    }

    .sidebar.collapsed .logout-btn{

        width:100%;

        height:48px;

    }

    body.sidebar-collapse .main-content{

         width:100%;

            margin-left:0 !important;

            min-width:0;

    }

    .main-content{

        width:100%;

        margin-left:0 !important;

        min-width:0;

    }

    .content-wrapper{

        padding:22px;

    }

    .profile-box div{

        display:none;

    }

}

@media (max-width:768px){

    .topbar{

        padding:0 18px;

    }

    .page-subtitle{

        display:none;

    }

    .content-wrapper{

        padding:18px;

    }

}

@media (max-width:576px){

    .topbar{

        height:72px;

    }

    .page-title{

        font-size:20px;

    }

    .icon-btn{

        width:42px;

        height:42px;

    }

    .profile-box{

        display:none;

    }

    .content-wrapper{

        padding:15px;

    }

}

/* ======================================================
                    ANIMATION
====================================================== */

.dashboard-card,
.card{

    animation:fadeUp .45s ease;

}

@keyframes fadeUp{

    from{

        opacity:0;

        transform:translateY(12px);

    }

    to{

        opacity:1;

        transform:translateY(0);

    }

}


</style>

</body>

</html>
