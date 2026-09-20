@extends('main.layout.layout')

@section('title', 'Jadwal Lapangan')

@section('content')

<style>
/* =========================================================
   MAIN SCHEDULE BOARD
   Tema Main Page tetap DARK + ORANGE
   Struktur mengikuti User Schedule Board
========================================================= */

:root {
    --main-dark: #020617;
    --main-dark-2: #0f172a;
    --main-dark-3: #1e293b;
    --main-orange: #ea580c;

    --available: #0f172a;
    --approved: #22c55e;
    --pending: #f59e0b;
    --practice: #2563eb;
    --holiday: #ef4444;

    --border: #334155;
}

/* =========================================================
   PAGE
========================================================= */

.main-schedule-page {
    background: #f8fafc;
    min-height: 100vh;
    padding-bottom: 70px;
}

/* =========================================================
   HERO
========================================================= */

.schedule-hero {
    background:
        linear-gradient(
            rgba(2, 6, 23, .55),
            rgba(2, 6, 23, .65)
        ),
        url('{{ asset('images/gallery/basket5.png') }}');

    background-size: cover;
    background-position: center;

    padding: 80px 0 60px;
}

.schedule-subtitle {
    color: var(--main-orange);
    font-size: .75rem;
    text-transform: uppercase;
    letter-spacing: 4px;
    font-weight: 800;
}

.schedule-title {
    color: white;
    font-size: 4rem;
    font-weight: 900;
    font-style: italic;
    text-transform: uppercase;
    line-height: .95;
    margin: 15px 0;
}

.schedule-title span {
    color: var(--main-orange);
}

.schedule-desc {
    color: #cbd5e1;
    max-width: 650px;
    line-height: 1.8;
}

/* =========================================================
   HERO INFO
========================================================= */

.hero-info {
    display: flex;
    gap: 15px;
    flex-wrap: wrap;
    margin-top: 30px;
}

.hero-box {
    background: rgba(255,255,255,.07);
    border: 1px solid rgba(255,255,255,.10);
    backdrop-filter: blur(12px);

    padding: 15px 20px;
    border-radius: 16px;

    color: white;
    min-width: 175px;
}

.hero-box small {
    display: block;
    color: #94a3b8;
    text-transform: uppercase;
    font-size: 10px;
    letter-spacing: 2px;
    margin-bottom: 6px;
}

.hero-box strong {
    font-size: 20px;
}

/* =========================================================
   SECTION
========================================================= */

.schedule-section {
    padding: 55px 0;
}

.board-heading {
    margin-bottom: 25px;
}

.board-title {
    font-size: 2.7rem;
    font-weight: 900;
    font-style: italic;
    text-transform: uppercase;
    margin: 0;
}

.board-title span {
    color: var(--main-orange);
}

.live-status {
    display: flex;
    align-items: center;
    gap: 9px;
    margin-top: 8px;
}

.live-dot {
    width: 9px;
    height: 9px;
    border-radius: 50%;
    background: #22c55e;

    animation: livePulse 2s infinite;
}

@keyframes livePulse {

    0% {
        box-shadow: 0 0 0 0 rgba(34,197,94,.5);
    }

    70% {
        box-shadow: 0 0 0 10px rgba(34,197,94,0);
    }

    100% {
        box-shadow: 0 0 0 0 rgba(34,197,94,0);
    }
}

.live-clock {
    color: #64748b;
    font-size: 12px;
    font-weight: 700;
}

/* =========================================================
   DESKTOP BOARD - FULL WIDTH
   ========================================================= */

@media (min-width: 992px) {

    .schedule-section > .container {
        width: 96%;
        max-width: 1600px;
    }

    .schedule-section .desktop-schedule {
        width: 100%;
    }

    .schedule-section .board-card {
        width: 100%;
    }

    .schedule-section .schedule-grid {
        width: 100%;
        min-width: 0;

        grid-template-columns:
            85px
            repeat(7, minmax(0, 1fr));
    }
}



/* =========================================================
   WEEK NAVIGATION
========================================================= */

.week-navigation {
    display: flex;
    align-items: center;
    justify-content: space-between;

    margin-bottom: 12px;
}

.week-button {
    width: 44px;
    height: 44px;

    border: 1px solid #cbd5e1;
    background: white;
    color: #475569;

    border-radius: 50%;

    display: flex;
    align-items: center;
    justify-content: center;

    transition: .2s;
}

.week-button:hover {
    border-color: var(--main-orange);
    color: var(--main-orange);
}

.week-label {
    font-size: 14px;
    font-weight: 800;
    color: #0f172a;
}

/* =========================================================
   BOARD CARD
========================================================= */

.board-card {
    background: var(--main-dark-2);

    border-radius: 22px;

    border: 1px solid #1e293b;

    box-shadow:
        0 25px 50px rgba(2,6,23,.25);

    overflow: hidden;
}

.schedule-scroll {
    width: 100%;
    overflow-x: auto;
}

.schedule-grid {
    display: grid;

    grid-template-columns:
        90px
        repeat(7, minmax(0, 1fr));

    width: 100%;
    min-width: 0;
}

/* =========================================================
   CORNER
========================================================= */

.grid-corner {
    height: 62px;
    background: var(--main-dark-3);

    border-right: 1px solid var(--border);
    border-bottom: 1px solid var(--border);
}

/* =========================================================
   DAY HEADER
========================================================= */

.grid-header {
    height: 62px;

    background: var(--main-dark-3);

    border-right: 1px solid var(--border);
    border-bottom: 1px solid var(--border);

    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;

    color: #cbd5e1;
}

.grid-header.today {
    background: #263548;
}

.grid-header.today .grid-day {
    color: var(--main-orange);
}

.grid-header.today .grid-date {
    background: var(--main-orange);
    color: white;

    width: 30px;
    height: 30px;

    border-radius: 50%;

    display: flex;
    align-items: center;
    justify-content: center;
}

.grid-day {
    font-size: 12px;
    font-weight: 800;

    text-transform: uppercase;
    letter-spacing: 1px;
}

.grid-date {
    font-size: 18px;
    font-weight: 900;

    margin-top: 3px;
}

/* =========================================================
   TIME
========================================================= */

.grid-time {
    height: 54px;

    background: var(--main-dark-3);

    border-right: 1px solid var(--border);
    border-bottom: 1px solid var(--border);

    display: flex;
    align-items: center;
    justify-content: center;

    color: #cbd5e1;

    font-size: 13px;
    font-weight: 700;
}

/* =========================================================
   SLOT
========================================================= */

.grid-cell {
    height: 54px;

    padding: 4px;

    background: var(--main-dark);

    border-right: 1px solid var(--border);
    border-bottom: 1px solid var(--border);

    cursor: default;
}

/*
|--------------------------------------------------------------------------
| AVAILABLE
|--------------------------------------------------------------------------
*/

.slot-available {
    background: #0f172a;
}

/*
|--------------------------------------------------------------------------
| APPROVED
|--------------------------------------------------------------------------
*/

.slot-approved {
    background: var(--approved);
    color: white;

    display: flex;
    align-items: center;
    justify-content: center;

    text-align: center;

    font-size: 12px;
    font-weight: 800;

    border-radius: 7px;
}

/*
|--------------------------------------------------------------------------
| PENDING
|--------------------------------------------------------------------------
*/

.slot-pending {
    background: var(--pending);
    color: white;

    display: flex;
    align-items: center;
    justify-content: center;

    text-align: center;

    font-size: 12px;
    font-weight: 800;

    border-radius: 7px;
}

/*
|--------------------------------------------------------------------------
| PRACTICE
|--------------------------------------------------------------------------
*/

.slot-practice {
    background: var(--practice);
    color: white;

    display: flex;
    align-items: center;
    justify-content: center;

    text-align: center;

    font-size: 12px;
    font-weight: 800;

    border-radius: 7px;
}

/*
|--------------------------------------------------------------------------
| HOLIDAY
|--------------------------------------------------------------------------
*/

.slot-holiday {
    background: var(--holiday);
    color: white;

    display: flex;
    align-items: center;
    justify-content: center;

    text-align: center;

    font-size: 12px;
    font-weight: 800;

    border-radius: 7px;
}

/*
|--------------------------------------------------------------------------
| PAST
|--------------------------------------------------------------------------
*/

.slot-past {
    background: #0f172a;
    opacity: 1;
}

/* =========================================================
   LEGEND
========================================================= */

.board-footer {
    display: flex;

    justify-content: space-between;
    align-items: center;

    gap: 20px;

    margin-top: 12px;

    flex-wrap: wrap;
}

.board-legend {
    display: flex;
    gap: 15px;
    flex-wrap: wrap;
}

.legend-item {
    display: flex;
    align-items: center;
    gap: 7px;

    color: #475569;

    font-size: 11px;
    font-weight: 700;
}

.legend-color {
    width: 11px;
    height: 11px;

    border-radius: 3px;
}

.legend-available {
    background: #f8fafc;
    border: 1px solid #cbd5e1;
}

.legend-approved {
    background: var(--approved);
}

.legend-pending {
    background: var(--pending);
}

.legend-practice {
    background: var(--practice);
}

.legend-holiday {
    background: var(--holiday);
}

/* =========================================================
   BOOK COURT
========================================================= */

.book-court-button {
    border: none;

    background: var(--main-orange);
    color: white;

    padding: 11px 28px;

    border-radius: 25px;

    font-weight: 800;
    font-size: 12px;

    transition: .2s;
}

.book-court-button:hover {
    background: #c2410c;
    transform: translateY(-1px);
}

/* =========================================================
   AGENDA
========================================================= */

.agenda-card {
    margin-top: 22px;

    background: var(--main-dark-2);

    border-radius: 20px;

    border: 1px solid #1e293b;

    overflow: hidden;

    color: white;
}

.agenda-header {
    padding: 18px 20px;

    border-bottom: 1px solid #1e293b;

    display: flex;
    justify-content: space-between;
    align-items: center;
}

.desktop-agenda-navigation {
    display: flex;
    align-items: center;
    gap: 8px;
}

.desktop-agenda-nav {
    width: 38px;
    height: 38px;

    border: 1px solid #334155;
    background: var(--main-dark-3);
    color: #cbd5e1;

    border-radius: 10px;

    display: flex;
    align-items: center;
    justify-content: center;

    cursor: pointer;
}

.desktop-agenda-today {
    height: 38px;

    padding: 0 14px;

    border: 1px solid var(--main-orange);
    background: transparent;
    color: var(--main-orange);

    border-radius: 10px;

    font-size: 11px;
    font-weight: 800;

    cursor: pointer;
}

.desktop-agenda-nav:active,
.desktop-agenda-today:active {
    transform: scale(.96);
}

.agenda-header h5 {
    margin: 0;

    font-size: 16px;
    font-weight: 800;
}

.agenda-header small {
    color: #94a3b8;
}

.agenda-list {
    padding: 12px;
}

.agenda-item {
    min-height: 64px;

    display: flex;
    align-items: center;

    gap: 12px;

    padding: 10px 12px;

    border-bottom: 1px solid #1e293b;
}

.agenda-item:last-child {
    border-bottom: none;
}

.agenda-color {
    width: 4px;
    min-height: 42px;

    border-radius: 10px;
}

.agenda-color.approved {
    background: var(--approved);
}

.agenda-color.pending {
    background: var(--pending);
}

.agenda-color.practice {
    background: var(--practice);
}

.agenda-color.holiday {
    background: var(--holiday);
}

.agenda-color.available {
    background: #94a3b8;
}

.agenda-info {
    flex: 1;
}

.agenda-name {
    font-size: 13px;
    font-weight: 800;
}

.agenda-time {
    margin-top: 3px;

    color: #94a3b8;

    font-size: 11px;
}

.agenda-badge {
    font-size: 9px;
    font-weight: 800;

    padding: 5px 9px;

    border-radius: 10px;

    background: #1e293b;
    color: #cbd5e1;

    text-transform: uppercase;
}

.empty-agenda {
    padding: 30px 20px;

    text-align: center;

    color: #94a3b8;

    font-size: 12px;
}

/* =========================================================
   MOBILE BOARD
========================================================= */

.mobile-schedule {
    display: none;
}

/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 991px) {

    .desktop-schedule {
        display: none;
    }

    .mobile-schedule {
        display: block;
    }

    .schedule-hero {
        padding: 55px 0 45px;
    }

    .schedule-title {
        font-size: 2.8rem;
    }

    .schedule-section {
        padding: 35px 0;
    }

    .board-title {
        font-size: 2rem;
    }

    .hero-info {
        display: grid;
        grid-template-columns: 1fr;
    }

    .hero-box {
        width: 100%;
    }

   /* =========================================================
   MOBILE BOARD
   ========================================================= */

    .mobile-board-card {
        background: var(--main-dark-2);
        border-radius: 18px;
        border: 1px solid #1e293b;
        overflow: hidden;
    }

    .mobile-board-scroll {
        width: 100%;
        overflow-x: hidden;
        overflow-y: auto;
        max-height: 500px;
    }

    .mobile-grid {
        display: grid;

        /*
        |--------------------------------------------------------------------------
        | FIX TO SCREEN
        |--------------------------------------------------------------------------
        | 1 kolom jam + 7 hari
        | Tidak ada horizontal scroll.
        */

        grid-template-columns:
            38px
            repeat(7, minmax(0, 1fr));

        grid-auto-rows: 48px;

        gap: 3px;

        width: 100%;
    }

    /* =========================================================
    CORNER
    ========================================================= */

    .mobile-corner {
        height: 55px;

        background: var(--main-dark-3);

        border-right: 1px solid var(--border);
        border-bottom: 1px solid var(--border);
    }

    /* =========================================================
    DAY HEADER
    ========================================================= */

    .mobile-day-header {
        height: 55px;

        background: var(--main-dark-3);

        border-right: 1px solid var(--border);
        border-bottom: 1px solid var(--border);

        display: flex;
        flex-direction: column;

        align-items: center;
        justify-content: center;

        color: #cbd5e1;
    }

    .mobile-day-header.today {
        background: #263548;
    }

    .mobile-day-header.today .mobile-day-name {
        color: var(--main-orange);
    }

    .mobile-day-header.today .mobile-day-date {
        background: var(--main-orange);
        color: white;

        width: 26px;
        height: 26px;

        border-radius: 50%;

        display: flex;
        align-items: center;
        justify-content: center;
    }

    .mobile-day-name {
        font-size: 8px;
        font-weight: 800;
    }

    .mobile-day-date {
        font-size: 14px;
        font-weight: 900;

        margin-top: 2px;

        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* =========================================================
    TIME
    ========================================================= */

    .mobile-time {
        height: 48px;

        background: var(--main-dark-3);

        border-right: 1px solid var(--border);
        border-bottom: 1px solid var(--border);

        display: flex;
        align-items: center;
        justify-content: center;

        color: #cbd5e1;

        font-size: 9px;
        font-weight: 700;
    }

    /* =========================================================
    SLOT
    ========================================================= */

    .mobile-slot {
        height: 48px;

        padding: 3px;

        background: var(--main-dark);

        border-right: 1px solid var(--border);
        border-bottom: 1px solid var(--border);

        /*
        |--------------------------------------------------------------------------
        | DISPLAY ONLY
        |--------------------------------------------------------------------------
        */

        pointer-events: none;
    }

    /* =========================================================
    SLOT CONTENT
    ========================================================= */

    .mobile-slot-content {
        width: 100%;
        height: 100%;

        border-radius: 6px;

        /*
        |--------------------------------------------------------------------------
        | DEFAULT = BLACK
        |--------------------------------------------------------------------------
        */

        background: var(--main-dark);

        border: 1px solid #1e293b;

        /*
        |--------------------------------------------------------------------------
        | PENTING
        |--------------------------------------------------------------------------
        | Tidak ada tulisan.
        */

        font-size: 0;
        color: transparent;
    }

    /* =========================================================
    APPROVED
    ========================================================= */

    .mobile-slot-content.approved {
        background: var(--approved);
        border: none;
    }

    /* =========================================================
    PENDING
    ========================================================= */

    .mobile-slot-content.pending {
        background: var(--pending);
        border: none;
    }

    /* =========================================================
    PRACTICE
    ========================================================= */

    .mobile-slot-content.practice {
        background: var(--practice);
        border: none;
    }

    /* =========================================================
    HOLIDAY
    ========================================================= */

    .mobile-slot-content.holiday {
        background: var(--holiday);
        border: none;
    }

    /* =========================================================
    PAST / UNAVAILABLE
    ========================================================= */

    .mobile-slot-content.past {
        /*
        |--------------------------------------------------------------------------
        | TETAP HITAM
        |--------------------------------------------------------------------------
        | Jangan ubah menjadi abu.
        */

        background: var(--main-dark);

        border: 1px solid #1e293b;

        opacity: 1;
    }

    /* Mobile agenda */

    .mobile-agenda {
        margin-top: 18px;

        background: var(--main-dark-2);

        border-radius: 18px;

        border: 1px solid #1e293b;

        overflow: hidden;
    }

    .mobile-agenda-header {
        padding: 15px 16px;

        border-bottom: 1px solid #1e293b;
    }

    /* =========================================================
    MOBILE AGENDA NAVIGATION
    ========================================================= */

    .mobile-agenda-header {
        display: flex;
        justify-content: space-between;
        align-items: center;

        gap: 12px;

        padding: 15px 16px;

        border-bottom: 1px solid #1e293b;
    }

    .mobile-agenda-navigation {
        display: flex;
        align-items: center;

        gap: 8px;
    }

    .mobile-agenda-nav {
        width: 38px;
        height: 38px;

        border: 1px solid #334155;

        background: var(--main-dark-3);
        color: #cbd5e1;

        border-radius: 10px;

        display: flex;
        align-items: center;
        justify-content: center;
    }

    .mobile-agenda-today {
        height: 38px;

        padding: 0 14px;

        border: 1px solid var(--main-orange);

        background: transparent;
        color: var(--main-orange);

        border-radius: 10px;

        font-size: 11px;
        font-weight: 800;
    }

    .mobile-agenda-nav:active,
    .mobile-agenda-today:active {
        transform: scale(.96);
    }

    .mobile-agenda-header h5 {
        margin: 0;

        font-size: 15px;
        font-weight: 800;
    }

    .mobile-agenda-header small {
        color: #94a3b8;
        font-size: 10px;
    }

    .mobile-agenda-list {
        padding: 8px;
    }

    .mobile-agenda-item {
        display: flex;

        align-items: center;

        gap: 10px;

        padding: 12px 10px;

        border-bottom: 1px solid #1e293b;
    }

    .mobile-agenda-item:last-child {
        border-bottom: none;
    }

    .mobile-agenda-color {
        width: 4px;
        height: 42px;

        border-radius: 10px;
    }

    .mobile-agenda-color.approved {
        background: var(--approved);
    }

    .mobile-agenda-color.pending {
        background: var(--pending);
    }

    .mobile-agenda-color.practice {
        background: var(--practice);
    }

    .mobile-agenda-color.holiday {
        background: var(--holiday);
    }

    .mobile-agenda-info {
        flex: 1;
    }

    .mobile-agenda-name {
        color: white;

        font-size: 12px;
        font-weight: 800;
    }

    .mobile-agenda-time {
        color: #94a3b8;

        font-size: 10px;

        margin-top: 3px;
    }

    .mobile-agenda-badge {
        font-size: 8px;
        font-weight: 800;

        color: #cbd5e1;

        background: #1e293b;

        padding: 4px 7px;

        border-radius: 8px;
    }

    .mobile-empty-agenda {
        padding: 25px 15px;

        text-align: center;

        color: #94a3b8;

        font-size: 11px;
    }

    .board-footer {
        align-items: stretch;
    }

    .board-legend {
        width: 100%;
    }

    .book-court-button {
        width: 100%;
    }
}

@media (min-width: 992px) {

    .desktop-schedule .schedule-grid {
        font-size: 14px !important;
    }

    .desktop-schedule .schedule-grid > div:first-child {
        font-size: 14px !important;
        font-weight: 700 !important;
    }

    .desktop-schedule .schedule-grid strong {
        font-size: 14px !important;
    }

    .desktop-schedule .schedule-grid small {
        font-size: 12px !important;
    }
}
</style>



<div class="main-schedule-page">

    {{-- =====================================================
         HERO
    ====================================================== --}}

    <section class="schedule-hero">

        <div class="container">

            <div class="schedule-subtitle">
                Arena Management System
            </div>

            <h1 class="schedule-title">
                Aseba <span>Schedule.</span>
            </h1>

            <p class="schedule-desc">
                Lihat jadwal penggunaan lapangan secara realtime
                melalui sistem ABHC.
            </p>

            <div class="hero-info">

                <div class="hero-box">
                    <small>Current Time</small>

                    <strong id="currentTimeHero">
                        Loading...
                    </strong>
                </div>

                <div class="hero-box">
                    <small>Today</small>

                    <strong id="todayDateHero">
                        Loading...
                    </strong>
                </div>

                <div class="hero-box">
                    <small>Court Status</small>

                    <strong style="color:#22c55e">
                        OPEN
                    </strong>
                </div>

            </div>

        </div>

    </section>


    {{-- =====================================================
         SCHEDULE SECTION
    ====================================================== --}}

    <section class="schedule-section">

        <div class="container">

            <div class="board-heading">

                <h2 class="board-title">
                    Schedule <span>Board</span>
                </h2>

                <div class="live-status">

                    <div class="live-dot"></div>

                    <div
                        class="live-clock"
                        id="liveClock">
                        Loading...
                    </div>

                </div>

            </div>


            {{-- =================================================
                 DESKTOP
            ================================================== --}}

            <div class="desktop-schedule">

                {{-- WEEK NAVIGATION --}}

                <div class="week-navigation">

                    <button
                        type="button"
                        id="previousWeek"
                        class="week-button">

                        <i class="bi bi-chevron-left"></i>

                    </button>

                    <div
                        id="weekLabel"
                        class="week-label">

                        Loading...

                    </div>

                    <button
                        type="button"
                        id="nextWeek"
                        class="week-button">

                        <i class="bi bi-chevron-right"></i>

                    </button>

                </div>


                {{-- BOARD --}}

                <div class="board-card">

                    <div
                        class="schedule-scroll"
                        id="scheduleScroll">

                        <div
                            class="schedule-grid"
                            id="scheduleGrid">

                        </div>

                    </div>

                </div>


                {{-- FOOTER --}}

                <div class="board-footer">

                    <div class="board-legend">

                        <div class="legend-item">
                            <span
                                class="legend-color legend-available">
                            </span>
                            Available
                        </div>

                        <div class="legend-item">
                            <span
                                class="legend-color legend-approved">
                            </span>
                            Approved
                        </div>

                        <div class="legend-item">
                            <span
                                class="legend-color legend-pending">
                            </span>
                            Pending
                        </div>

                        <div class="legend-item">
                            <span
                                class="legend-color legend-practice">
                            </span>
                            Practice
                        </div>

                        <div class="legend-item">
                            <span
                                class="legend-color legend-holiday">
                            </span>
                            Holiday
                        </div>

                    </div>

                    <button
                        type="button"
                        class="book-court-button"
                        onclick="bookCourt()">

                        <i class="bi bi-calendar-plus me-1"></i>

                        BOOK COURT

                    </button>

                </div>


                {{-- AGENDA DESKTOP --}}

                <div class="agenda-card">

                    <div class="agenda-header">

                        <div>
                            <h5>
                                Agenda Hari Ini
                            </h5>

                            <small id="agendaDate">
                                Loading...
                            </small>
                        </div>

                        <div class="desktop-agenda-navigation">

                            <button
                                type="button"
                                id="desktopAgendaPrevious"
                                class="desktop-agenda-nav">

                                <i class="bi bi-chevron-left"></i>

                            </button>

                            <button
                                type="button"
                                id="desktopAgendaToday"
                                class="desktop-agenda-today">

                                Today

                            </button>

                            <button
                                type="button"
                                id="desktopAgendaNext"
                                class="desktop-agenda-nav">

                                <i class="bi bi-chevron-right"></i>

                            </button>

                        </div>

                    </div>

                    <div
                        id="agendaList"
                        class="agenda-list">
                    </div>

                </div>

            </div>


            {{-- =================================================
                 MOBILE
            ================================================== --}}

            <div class="mobile-schedule">

                <div class="week-navigation">

                    <button
                        type="button"
                        id="mobilePreviousWeek"
                        class="week-button">

                        <i class="bi bi-chevron-left"></i>

                    </button>

                    <div
                        id="mobileWeekLabel"
                        class="week-label">

                        Loading...

                    </div>

                    <button
                        type="button"
                        id="mobileNextWeek"
                        class="week-button">

                        <i class="bi bi-chevron-right"></i>

                    </button>

                </div>


                <div class="mobile-board-card">

                    <div class="mobile-board-scroll">

                        <div
                            id="mobileGrid"
                            class="mobile-grid">

                        </div>

                    </div>

                </div>


                <div class="board-footer mt-3">

                    <div class="board-legend">

                        <div class="legend-item">
                            <span
                                class="legend-color legend-available">
                            </span>
                            Available
                        </div>

                        <div class="legend-item">
                            <span
                                class="legend-color legend-approved">
                            </span>
                            Approved
                        </div>

                        <div class="legend-item">
                            <span
                                class="legend-color legend-pending">
                            </span>
                            Pending
                        </div>

                        <div class="legend-item">
                            <span
                                class="legend-color legend-practice">
                            </span>
                            Practice
                        </div>

                        <div class="legend-item">
                            <span
                                class="legend-color legend-holiday">
                            </span>
                            Holiday
                        </div>

                    </div>

                    <button
                        type="button"
                        class="book-court-button"
                        onclick="bookCourt()">

                        <i class="bi bi-calendar-plus me-1"></i>

                        BOOK COURT

                    </button>

                </div>


                {{-- MOBILE AGENDA --}}

                                {{-- MOBILE AGENDA --}}
                <div class="mobile-agenda">

                    <div class="mobile-agenda-header">

                        <div>
                            <h5>
                                Agenda Hari Ini
                            </h5>

                            <small id="mobileAgendaDate">
                                Loading...
                            </small>
                        </div>

                        <div class="mobile-agenda-navigation">

                            <button
                                type="button"
                                id="mobileAgendaPrevious"
                                class="mobile-agenda-nav">
                                <i class="bi bi-chevron-left"></i>
                            </button>

                            <button
                                type="button"
                                id="mobileAgendaToday"
                                class="mobile-agenda-today">
                                Today
                            </button>

                            <button
                                type="button"
                                id="mobileAgendaNext"
                                class="mobile-agenda-nav">
                                <i class="bi bi-chevron-right"></i>
                            </button>

                        </div>

                    </div>

                    <div
                        id="mobileAgendaList"
                        class="mobile-agenda-list">
                    </div>

                </div>

            </div>

        </div>

    </section>

</div>


<script>

/* =========================================================
   DATABASE
========================================================= */

const bookings = @json($bookings ?? []);

const masterSchedules =
    @json($masterSchedules ?? []);


/* =========================================================
   TIME
========================================================= */

const START_HOUR = 8;
const END_HOUR = 22;


/* =========================================================
   DATE
========================================================= */

let baseDate = new Date();

let weekOffset = 0;

let desktopAgendaDate = new Date();

let mobileAgendaDate = new Date();


/* =========================================================
   DAY NAMES
========================================================= */

const dayNames = [
    'Sunday',
    'Monday',
    'Tuesday',
    'Wednesday',
    'Thursday',
    'Friday',
    'Saturday'
];

const shortDayNames = [
    'MIN',
    'SEN',
    'SEL',
    'RAB',
    'KAM',
    'JUM',
    'SAB'
];

const monthNames = [
    'Januari',
    'Februari',
    'Maret',
    'April',
    'Mei',
    'Juni',
    'Juli',
    'Agustus',
    'September',
    'Oktober',
    'November',
    'Desember'
];


/* =========================================================
   HELPERS
========================================================= */

function pad(value) {
    return String(value).padStart(2, '0');
}


function formatDate(date) {

    return (
        date.getFullYear()
        + '-'
        + pad(date.getMonth() + 1)
        + '-'
        + pad(date.getDate())
    );

}


function formatTime(hour) {

    return pad(hour) + ':00';

}


function getMonday(offset = 0) {

    const date = new Date(baseDate);

    const day = date.getDay();

    const diff =
        day === 0
            ? -6
            : 1 - day;

    date.setDate(
        date.getDate()
        + diff
        + (offset * 7)
    );

    date.setHours(0,0,0,0);

    return date;

}


/* =========================================================
   WEEK LABEL
========================================================= */

function updateWeekLabels() {

    const monday =
        getMonday(weekOffset);

    const sunday =
        new Date(monday);

    sunday.setDate(
        monday.getDate() + 6
    );

    const label =
        monday.getDate()
        + ' '
        + monthNames[monday.getMonth()]
        + ' - '
        + sunday.getDate()
        + ' '
        + monthNames[sunday.getMonth()];


    document.getElementById(
        'weekLabel'
    ).innerText = label;


    document.getElementById(
        'mobileWeekLabel'
    ).innerText = label;

}


/* =========================================================
   BOOKING FINDER
========================================================= */

function findBooking(date, hour) {

    const dateString =
        formatDate(date);

    const time =
        formatTime(hour);


    return bookings.find(function (booking) {

        if (
            booking.booking_date
            !== dateString
        ) {
            return false;
        }


        return (
            booking.start_time <= time
            &&
            booking.end_time > time
        );

    });

}


/* =========================================================
   MASTER SCHEDULE FINDER
========================================================= */

function findMasterSchedule(
    date,
    hour
) {

    const dateString =
        formatDate(date);

    const dayName =
        dayNames[date.getDay()];

    const time =
        formatTime(hour);


    const matched =
        masterSchedules.filter(function(rule) {

            /*
            |--------------------------------------------------------------------------
            | DAILY
            |--------------------------------------------------------------------------
            */

            if (
                rule.schedule_type
                === 'daily'
            ) {

                if (
                    rule.date
                    !== dateString
                ) {
                    return false;
                }

            }

            /*
            |--------------------------------------------------------------------------
            | WEEKLY
            |--------------------------------------------------------------------------
            */

            else {

                if (
                    rule.day_name
                    !== dayName
                ) {
                    return false;
                }

            }


            /*
            |--------------------------------------------------------------------------
            | TIME
            |--------------------------------------------------------------------------
            */

            if (rule.all_day) {
                return true;
            }


            return (
                rule.start <= time
                &&
                rule.end > time
            );

        });


    /*
    |--------------------------------------------------------------------------
    | PRIORITY
    |--------------------------------------------------------------------------
    | Override = Available
    | Holiday = Holiday
    | Practice = Practice
    |--------------------------------------------------------------------------
    */


    const override =
        matched.find(
            x => x.mode === 'override'
        );

    if (override) {
        return override;
    }


    const holiday =
        matched.find(
            x => x.mode === 'holiday'
        );

    if (holiday) {
        return holiday;
    }


    const practice =
        matched.find(
            x => x.mode === 'practice'
        );

    if (practice) {
        return practice;
    }


    return null;

}


/* =========================================================
   PAST SLOT
========================================================= */

function isPastSlot(
    date,
    hour
) {

    const now = new Date();

    const slotDate =
        new Date(date);

    slotDate.setHours(
        hour,
        0,
        0,
        0
    );


    return slotDate < now;

}


/* =========================================================
   SLOT STATUS
========================================================= */

function getSlotData(
    date,
    hour
) {

    const booking =
        findBooking(
            date,
            hour
        );


    /*
    |--------------------------------------------------------------------------
    | BOOKING PRIORITY
    |--------------------------------------------------------------------------
    */

    if (booking) {

        return {
            type: booking.status,
            label: booking.customer
        };

    }


    /*
    |--------------------------------------------------------------------------
    | MASTER SCHEDULE
    |--------------------------------------------------------------------------
    */

    const schedule =
        findMasterSchedule(
            date,
            hour
        );


    if (schedule) {

        if (
            schedule.mode
            === 'override'
        ) {

            return {
                type: 'available',
                label: ''
            };

        }


        if (
            schedule.mode
            === 'holiday'
        ) {

            return {
                type: 'holiday',
                label:
                    schedule.description
                    || 'Holiday'
            };

        }


        if (
            schedule.mode
            === 'practice'
        ) {

            return {
                type: 'practice',
                label:
                    schedule.description
                    || 'Practice'
            };

        }

    }


    return {
        type: 'available',
        label: ''
    };

}


/* =========================================================
   DESKTOP BOARD
========================================================= */

function renderDesktopBoard() {

    const grid =
        document.getElementById(
            'scheduleGrid'
        );


    grid.innerHTML = '';


    /*
    |--------------------------------------------------------------------------
    | CORNER
    |--------------------------------------------------------------------------
    */

    const corner =
        document.createElement('div');

    corner.className =
        'grid-corner';

    grid.appendChild(corner);


    const monday =
        getMonday(weekOffset);


    /*
    |--------------------------------------------------------------------------
    | HEADER DAYS
    |--------------------------------------------------------------------------
    */

    for (
        let day = 0;
        day < 7;
        day++
    ) {

        const date =
            new Date(monday);

        date.setDate(
            monday.getDate() + day
        );


        const header =
            document.createElement('div');

        header.className =
            'grid-header';


        if (
            formatDate(date)
            ===
            formatDate(new Date())
        ) {

            header.classList.add(
                'today'
            );

        }


        header.innerHTML = `
            <div class="grid-day">
                ${shortDayNames[date.getDay()]}
            </div>

            <div class="grid-date">
                ${date.getDate()}
            </div>
        `;


        grid.appendChild(header);

    }


    /*
    |--------------------------------------------------------------------------
    | HOURS
    |--------------------------------------------------------------------------
    */

    for (
        let hour = START_HOUR;
        hour <= END_HOUR;
        hour++
    ) {

        const time =
            document.createElement('div');

        time.className =
            'grid-time';

        time.innerText =
            formatTime(hour);

        grid.appendChild(time);


        for (
            let day = 0;
            day < 7;
            day++
        ) {

            const date =
                new Date(monday);

            date.setDate(
                monday.getDate() + day
            );


            const cell =
                document.createElement('div');

            cell.className =
                'grid-cell';


            const data =
                getSlotData(
                    date,
                    hour
                );


            /*
            |--------------------------------------------------------------------------
            | AVAILABLE
            |--------------------------------------------------------------------------
            */

            if (
                data.type
                === 'available'
            ) {

                cell.classList.add(
                    'slot-available'
                );

            }


            /*
            |--------------------------------------------------------------------------
            | APPROVED
            |--------------------------------------------------------------------------
            */

            else if (
                data.type
                === 'approved'
            ) {

                cell.classList.add(
                    'slot-approved'
                );

                cell.innerText =
                    data.label;

            }


            /*
            |--------------------------------------------------------------------------
            | PENDING
            |--------------------------------------------------------------------------
            */

            else if (
                data.type
                === 'pending'
            ) {

                cell.classList.add(
                    'slot-pending'
                );

                cell.innerText =
                    data.label;

            }


            /*
            |--------------------------------------------------------------------------
            | PRACTICE
            |--------------------------------------------------------------------------
            */

            else if (
                data.type
                === 'practice'
            ) {

                cell.classList.add(
                    'slot-practice'
                );

                cell.innerText =
                    data.label;

            }


            /*
            |--------------------------------------------------------------------------
            | HOLIDAY
            |--------------------------------------------------------------------------
            */

            else if (
                data.type
                === 'holiday'
            ) {

                cell.classList.add(
                    'slot-holiday'
                );

                cell.innerText =
                    data.label;

            }


            /*
            |--------------------------------------------------------------------------
            | PAST
            |--------------------------------------------------------------------------
            */

            if (
                isPastSlot(
                    date,
                    hour
                )
                &&
                data.type
                === 'available'
            ) {

                cell.classList.add(
                    'slot-past'
                );

            }


            /*
            |--------------------------------------------------------------------------
            | IMPORTANT
            |--------------------------------------------------------------------------
            | Tidak ada onclick.
            | Main Page hanya DISPLAY.
            |--------------------------------------------------------------------------
            */


            grid.appendChild(cell);

        }

    }

}


/* =========================================================
   MOBILE BOARD
   DISPLAY ONLY
   ========================================================= */

function renderMobileBoard() {

    const grid =
        document.getElementById(
            'mobileGrid'
        );

    if (!grid) {
        return;
    }

    grid.innerHTML = '';

    /*
    |--------------------------------------------------------------------------
    | CORNER
    |--------------------------------------------------------------------------
    */

    const corner =
        document.createElement('div');

    corner.className =
        'mobile-corner';

    grid.appendChild(corner);


    /*
    |--------------------------------------------------------------------------
    | WEEK
    |--------------------------------------------------------------------------
    */

    const monday =
        getMonday(weekOffset);


    /*
    |--------------------------------------------------------------------------
    | DAY HEADER
    |--------------------------------------------------------------------------
    */

    for (
        let day = 0;
        day < 7;
        day++
    ) {

        const date =
            new Date(monday);

        date.setDate(
            monday.getDate() + day
        );


        const header =
            document.createElement('div');

        header.className =
            'mobile-day-header';


        /*
        |--------------------------------------------------------------------------
        | TODAY
        |--------------------------------------------------------------------------
        */

        if (
            formatDate(date)
            ===
            formatDate(new Date())
        ) {

            header.classList.add(
                'today'
            );

        }


        header.innerHTML = `

            <div class="mobile-day-name">
                ${shortDayNames[date.getDay()]}
            </div>

            <div class="mobile-day-date">
                ${date.getDate()}
            </div>

        `;


        grid.appendChild(
            header
        );

    }


    /*
    |--------------------------------------------------------------------------
    | HOURS
    |--------------------------------------------------------------------------
    */

    for (
        let hour = START_HOUR;
        hour <= END_HOUR;
        hour++
    ) {

        const time =
            document.createElement('div');

        time.className =
            'mobile-time';

        time.innerText =
            pad(hour);

        grid.appendChild(
            time
        );


        /*
        |--------------------------------------------------------------------------
        | 7 DAYS
        |--------------------------------------------------------------------------
        */

        for (
            let day = 0;
            day < 7;
            day++
        ) {

            const date =
                new Date(monday);

            date.setDate(
                monday.getDate() + day
            );


            const slot =
                document.createElement('div');

            slot.className =
                'mobile-slot';


            const data =
                getSlotData(
                    date,
                    hour
                );


            /*
            |--------------------------------------------------------------------------
            | STATUS
            |--------------------------------------------------------------------------
            */

            const content =
                document.createElement('div');


            content.className =
                'mobile-slot-content';


            /*
            |--------------------------------------------------------------------------
            | APPROVED
            |--------------------------------------------------------------------------
            */

            if (
                data.type === 'approved'
            ) {

                content.classList.add(
                    'approved'
                );

            }


            /*
            |--------------------------------------------------------------------------
            | PENDING
            |--------------------------------------------------------------------------
            */

            else if (
                data.type === 'pending'
            ) {

                content.classList.add(
                    'pending'
                );

            }


            /*
            |--------------------------------------------------------------------------
            | PRACTICE
            |--------------------------------------------------------------------------
            */

            else if (
                data.type === 'practice'
            ) {

                content.classList.add(
                    'practice'
                );

            }


            /*
            |--------------------------------------------------------------------------
            | HOLIDAY
            |--------------------------------------------------------------------------
            */

            else if (
                data.type === 'holiday'
            ) {

                content.classList.add(
                    'holiday'
                );

            }


            /*
            |--------------------------------------------------------------------------
            | AVAILABLE / PAST
            |--------------------------------------------------------------------------
            |
            | Tetap hitam.
            |
            */

            else {

                content.classList.add(
                    'past'
                );

            }


            /*
            |--------------------------------------------------------------------------
            | NO TEXT
            |--------------------------------------------------------------------------
            */

            content.innerText = '';

            slot.appendChild(
                content
            );


            /*
            |--------------------------------------------------------------------------
            | NO CLICK
            |--------------------------------------------------------------------------
            */

            grid.appendChild(
                slot
            );

        }

    }

}


/* =========================================================
   AGENDA
========================================================= */

function renderAgenda() {

    const today =
        new Date();


    const dateLabel =
        today.toLocaleDateString(
            'id-ID',
            {
                weekday: 'long',
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            }
        );


    document.getElementById(
        'agendaDate'
    ).innerText =
        dateLabel;


    document.getElementById(
        'mobileAgendaDate'
    ).innerText =
        dateLabel;


    const desktopList =
        document.getElementById(
            'agendaList'
        );


    const mobileList =
        document.getElementById(
            'mobileAgendaList'
        );


    desktopList.innerHTML = '';
    mobileList.innerHTML = '';


    let found = false;


    /*
    |--------------------------------------------------------------------------
    | BOOKING / PRACTICE / HOLIDAY
    |--------------------------------------------------------------------------
    */

    for (
        let hour = START_HOUR;
        hour <= END_HOUR;
        hour++
    ) {

        const booking =
            findBooking(
                today,
                hour
            );


        const schedule =
            findMasterSchedule(
                today,
                hour
            );


        let type = 'available';
        let name = 'Available';
        let start = formatTime(hour);
        let end = formatTime(hour + 1);
        let badge = 'Available';


        if (booking) {

            type =
                booking.status;

            name =
                booking.customer;

            start =
                booking.start_time;

            end =
                booking.end_time;

            badge =
                booking.status;

        }

        else if (
            schedule
            &&
            schedule.mode === 'practice'
        ) {

            type = 'practice';

            name =
                schedule.description
                || 'ASEBA Practice';

            start =
                schedule.all_day
                    ? '08:00'
                    : schedule.start;

            end =
                schedule.all_day
                    ? '23:00'
                    : schedule.end;

            badge = 'Practice';

        }

        else if (
            schedule
            &&
            schedule.mode === 'holiday'
        ) {

            type = 'holiday';

            name =
                schedule.description
                || 'Holiday';

            start =
                schedule.all_day
                    ? '08:00'
                    : schedule.start;

            end =
                schedule.all_day
                    ? '23:00'
                    : schedule.end;

            badge = 'Holiday';

        }

        else {

            continue;

        }


        found = true;


        /*
        |--------------------------------------------------------------------------
        | DESKTOP
        |--------------------------------------------------------------------------
        */

        const item =
            document.createElement('div');

        item.className =
            'agenda-item';

        item.innerHTML = `
            <div class="agenda-color ${type}"></div>

            <div class="agenda-info">

                <div class="agenda-name">
                    ${name}
                </div>

                <div class="agenda-time">
                    ${start} - ${end}
                </div>

            </div>

            <span class="agenda-badge">
                ${badge}
            </span>
        `;


        desktopList.appendChild(
            item
        );


        /*
        |--------------------------------------------------------------------------
        | MOBILE
        |--------------------------------------------------------------------------
        */

        const mobileItem =
            document.createElement('div');

        mobileItem.className =
            'mobile-agenda-item';

        mobileItem.innerHTML = `
            <div
                class="mobile-agenda-color ${type}">
            </div>

            <div class="mobile-agenda-info">

                <div class="mobile-agenda-name">
                    ${name}
                </div>

                <div class="mobile-agenda-time">
                    ${start} - ${end}
                </div>

            </div>

            <span class="mobile-agenda-badge">
                ${badge}
            </span>
        `;


        mobileList.appendChild(
            mobileItem
        );

    }


    if (!found) {

        desktopList.innerHTML = `
            <div class="empty-agenda">
                Tidak ada jadwal hari ini.
            </div>
        `;


        mobileList.innerHTML = `
            <div class="mobile-empty-agenda">
                Tidak ada jadwal hari ini.
            </div>
        `;

    }

}

/* =========================================================
   DESKTOP AGENDA DAY NAVIGATION
   ========================================================= */

document.getElementById(
    'desktopAgendaPrevious'
).addEventListener(
    'click',
    function () {

        desktopAgendaDate.setDate(
            desktopAgendaDate.getDate() - 1
        );

        renderAgenda();

    }
);


document.getElementById(
    'desktopAgendaToday'
).addEventListener(
    'click',
    function () {

        desktopAgendaDate =
            new Date();

        renderAgenda();

    }
);


document.getElementById(
    'desktopAgendaNext'
).addEventListener(
    'click',
    function () {

        desktopAgendaDate.setDate(
            desktopAgendaDate.getDate() + 1
        );

        renderAgenda();

    }
);

/* =========================================================
   MOBILE AGENDA DAY NAVIGATION
   ========================================================= */

document.getElementById(
    'mobileAgendaPrevious'
).addEventListener(
    'click',
    function () {

        mobileAgendaDate.setDate(
            mobileAgendaDate.getDate() - 1
        );

        renderAgenda();

    }
);


document.getElementById(
    'mobileAgendaToday'
).addEventListener(
    'click',
    function () {

        mobileAgendaDate =
            new Date();

        renderAgenda();

    }
);


document.getElementById(
    'mobileAgendaNext'
).addEventListener(
    'click',
    function () {

        mobileAgendaDate.setDate(
            mobileAgendaDate.getDate() + 1
        );

        renderAgenda();

    }
);


/* =========================================================
   AGENDA
   ========================================================= */

function renderAgenda() {

    /*
    |--------------------------------------------------------------------------
    | DESKTOP = SELALU HARI INI
    |--------------------------------------------------------------------------
    */

    const desktopDate =
        new Date(
            desktopAgendaDate
        );

    const desktopDateLabel =
        desktopDate.toLocaleDateString(
            'id-ID',
            {
                weekday: 'long',
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            }
        );

        const agendaDateElement =
            document.getElementById('agendaDate');

        if (agendaDateElement) {
            agendaDateElement.innerText =
                desktopDateLabel;
        }


    const desktopList =
        document.getElementById(
            'agendaList'
        );


    desktopList.innerHTML = '';


    let desktopFound = false;


    for (
        let hour = START_HOUR;
        hour <= END_HOUR;
        hour++
    ) {

        const booking =
            findBooking(
                desktopDate,
                hour
            );


        const schedule =
            findMasterSchedule(
                desktopDate,
                hour
            );


        let type = 'available';
        let name = 'Available';
        let start = formatTime(hour);
        let end = formatTime(hour + 1);
        let badge = 'Available';


        if (booking) {

            type =
                booking.status;

            name =
                booking.customer;

            start =
                booking.start_time;

            end =
                booking.end_time;

            badge =
                booking.status;

        }

        else if (
            schedule
            &&
            schedule.mode === 'practice'
        ) {

            type = 'practice';

            name =
                schedule.description
                ||
                'ASEBA Practice';

            start =
                schedule.all_day
                    ? '08:00'
                    : schedule.start;

            end =
                schedule.all_day
                    ? '23:00'
                    : schedule.end;

            badge =
                'Practice';

        }

        else if (
            schedule
            &&
            schedule.mode === 'holiday'
        ) {

            type = 'holiday';

            name =
                schedule.description
                ||
                'Holiday';

            start =
                schedule.all_day
                    ? '08:00'
                    : schedule.start;

            end =
                schedule.all_day
                    ? '23:00'
                    : schedule.end;

            badge =
                'Holiday';

        }

        else {

            continue;

        }


        desktopFound = true;


        const item =
            document.createElement('div');

        item.className =
            'agenda-item';

        item.innerHTML = `

            <div
                class="agenda-color ${type}">
            </div>

            <div class="agenda-info">

                <div class="agenda-name">
                    ${name}
                </div>

                <div class="agenda-time">
                    ${start} - ${end}
                </div>

            </div>

            <span class="agenda-badge">
                ${badge}
            </span>

        `;


        desktopList.appendChild(
            item
        );

    }


    if (!desktopFound) {

        desktopList.innerHTML = `

            <div class="empty-agenda">
                Tidak ada jadwal hari ini.
            </div>

        `;

    }


    /*
    |--------------------------------------------------------------------------
    | MOBILE AGENDA
    |--------------------------------------------------------------------------
    */

    const mobileDate =
        new Date(
            mobileAgendaDate
        );


    const mobileDateLabel =
        mobileDate.toLocaleDateString(
            'id-ID',
            {
                weekday: 'long',
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            }
        );


    document.getElementById(
        'mobileAgendaDate'
    ).innerText =
        mobileDateLabel;


    const mobileList =
        document.getElementById(
            'mobileAgendaList'
        );


    mobileList.innerHTML = '';


    let mobileFound = false;


    for (
        let hour = START_HOUR;
        hour <= END_HOUR;
        hour++
    ) {

        const booking =
            findBooking(
                mobileDate,
                hour
            );


        const schedule =
            findMasterSchedule(
                mobileDate,
                hour
            );


        let type = 'available';
        let name = 'Available';
        let start = formatTime(hour);
        let end = formatTime(hour + 1);
        let badge = 'Available';


        if (booking) {

            type =
                booking.status;

            name =
                booking.customer;

            start =
                booking.start_time;

            end =
                booking.end_time;

            badge =
                booking.status;

        }

        else if (
            schedule
            &&
            schedule.mode === 'practice'
        ) {

            type = 'practice';

            name =
                schedule.description
                ||
                'ASEBA Practice';

            start =
                schedule.all_day
                    ? '08:00'
                    : schedule.start;

            end =
                schedule.all_day
                    ? '23:00'
                    : schedule.end;

            badge =
                'Practice';

        }

        else if (
            schedule
            &&
            schedule.mode === 'holiday'
        ) {

            type = 'holiday';

            name =
                schedule.description
                ||
                'Holiday';

            start =
                schedule.all_day
                    ? '08:00'
                    : schedule.start;

            end =
                schedule.all_day
                    ? '23:00'
                    : schedule.end;

            badge =
                'Holiday';

        }

        else {

            continue;

        }


        mobileFound = true;


        const mobileItem =
            document.createElement('div');

        mobileItem.className =
            'mobile-agenda-item';


        mobileItem.innerHTML = `

            <div
                class="mobile-agenda-color ${type}">
            </div>

            <div class="mobile-agenda-info">

                <div class="mobile-agenda-name">
                    ${name}
                </div>

                <div class="mobile-agenda-time">
                    ${start} - ${end}
                </div>

            </div>

            <span class="mobile-agenda-badge">
                ${badge}
            </span>

        `;


        mobileList.appendChild(
            mobileItem
        );

    }


    if (!mobileFound) {

        mobileList.innerHTML = `

            <div class="mobile-empty-agenda">
                Tidak ada jadwal pada hari ini.
            </div>

        `;

    }

}

/* =========================================================
   RENDER ALL
========================================================= */

function renderAll() {

    updateWeekLabels();

    renderDesktopBoard();

    renderMobileBoard();

    renderAgenda();

}

/* =========================================================
   WEEK BUTTON
========================================================= */

document.getElementById(
    'previousWeek'
).addEventListener(
    'click',
    function () {

        weekOffset--;

        renderAll();

    }
);


document.getElementById(
    'nextWeek'
).addEventListener(
    'click',
    function () {

        weekOffset++;

        renderAll();

    }
);


document.getElementById(
    'mobilePreviousWeek'
).addEventListener(
    'click',
    function () {

        weekOffset--;

        mobileAgendaDate =
            getMonday(weekOffset);

        renderAll();

    }
);


document.getElementById(
    'mobileNextWeek'
).addEventListener(
    'click',
    function () {

        weekOffset++;

        mobileAgendaDate =
            getMonday(weekOffset);

        renderAll();

    }
);


/* =========================================================
   REALTIME CLOCK
========================================================= */

function updateRealtimeClock() {

    const now =
        new Date();


    const time =
        now.toLocaleTimeString(
            'id-ID',
            {
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            }
        );


    const date =
        now.toLocaleDateString(
            'id-ID',
            {
                weekday: 'long',
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            }
        );


    document.getElementById(
        'currentTimeHero'
    ).innerText =
        time + ' WIB';


    document.getElementById(
        'todayDateHero'
    ).innerHTML =
        date;


    document.getElementById(
        'liveClock'
    ).innerText =
        date
        + ' • '
        + time;


    /*
    |--------------------------------------------------------------------------
    | Refresh board ketika hari berganti
    |--------------------------------------------------------------------------
    */

    if (
        formatDate(baseDate)
        !==
        formatDate(now)
    ) {

        baseDate =
            new Date();

        weekOffset = 0;

        renderAll();

    }

}


/* =========================================================
   BOOK COURT
========================================================= */

function bookCourt() {

    @if(auth()->check())

        window.location.href =
            "{{ route('user.booking.index') }}";

    @else

        alert(
            'Silakan login terlebih dahulu untuk melakukan booking.'
        );

    @endif

}


/* =========================================================
   INITIAL
========================================================= */

renderAll();

updateRealtimeClock();

setInterval(
    updateRealtimeClock,
    1000
);


/*
|--------------------------------------------------------------------------
| Refresh tampilan slot setiap menit
|--------------------------------------------------------------------------
*/

setInterval(
    function () {

        renderDesktopBoard();

        renderMobileBoard();

        renderAgenda();

    },
    60000
);

</script>

@endsection
