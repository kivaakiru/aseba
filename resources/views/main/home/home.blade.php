@extends('main.layout.layout')

@section('title', 'Dashboard')

@section('content')

<style>

:root{
    --primary:#f97316;
    --primary-dark:#ea580c;
    --dark:#020617;
    --dark-soft:#0f172a;
    --light:#f8fafc;
    --gray:#94a3b8;
    --card:#ffffff;
}

.hero-section{
    background:
        linear-gradient(rgba(2,6,23,.88), rgba(2,6,23,.92)),
        url('{{ asset('images/gallery/basket6.jfif') }}');

    background-size:cover;
    background-position:center;
    min-height:92vh;

    display:flex;
    align-items:center;
}

.hero-subtitle{
    color:var(--primary);
    font-size:.8rem;
    letter-spacing:4px;
    font-weight:800;
    text-transform:uppercase;
}

.hero-title{
    margin:25px 0;
    line-height:.88;
    font-size:6rem;
    font-weight:900;
    text-transform:uppercase;
    font-style:italic;
    color:#fff;
}

.hero-title span{
    color:var(--primary);
}

.hero-desc{
    max-width:560px;
    color:#cbd5e1;
    line-height:2;
    font-size:1.05rem;
}

.timeline-card{
    background:#fff;
    border-radius:40px;
    padding:35px;
    box-shadow:
        0 20px 60px rgba(0,0,0,.15);
}

.timeline-label{
    color:#94a3b8;
    font-size:.75rem;
    text-transform:uppercase;
    font-weight:800;
    letter-spacing:2px;
}

.timeline-title{
    font-size:2rem;
    font-weight:900;
    font-style:italic;
    text-transform:uppercase;
}
.current-time{
    font-size:2.2rem;
    font-weight:900;
    color:#f97316;
    line-height:1;
}

.current-time-label{
    font-size:.75rem;
    font-weight:700;
    color:#94a3b8;
    text-transform:uppercase;
    letter-spacing:2px;
}
.timeline-item{
    background:#f8fafc;
    border:1px solid #e2e8f0;

    border-radius:20px;
    padding:18px 22px;

    margin-bottom:12px;

    transition:.3s;
}

.timeline-item:hover{
    transform:translateY(-4px);
}

.timeline-item.booked{
    background:#fff7ed;
    border-color:#fed7aa;
}

/* LATIHAN / PRACTICE */
.timeline-item.practice{
    background:#eff6ff;
    border-color:#bfdbfe;
}

.timeline-item.practice .timeline-time,
.timeline-item.practice .timeline-status{
    color:#2563eb;
}

/* LIBUR / HOLIDAY / LAPANGAN TUTUP */
.timeline-item.closed{
    background:#fef2f2;
    border-color:#fecaca;
    color:#dc2626;
}

.timeline-item.closed .timeline-time,
.timeline-item.closed .timeline-status{
    color:#dc2626;
}

.timeline-item.closed .timeline-time,
.timeline-item.closed .timeline-status{
    color:#94a3b8;
}

.timeline-time{
    font-weight:800;
    font-size:1rem;
}

.timeline-status{
    font-weight:600;
    color:#475569;
}

.section-space{
    padding:70px 0;
}

.section-title{
    font-size:3rem;
    font-weight:900;
    text-transform:uppercase;
    font-style:italic;
}

.section-title span{
    color:var(--primary);
}

.practice-card{
    background:#fff;
    border-radius:28px;
    padding:30px;
    height:100%;
    transition:.35s;
    border:1px solid #e5e7eb;
}

.practice-card:hover{
    transform:translateY(-8px);
}

.practice-tag{
    display:inline-flex;
    align-items:center;

    padding:8px 16px;

    border-radius:999px;

    background:var(--primary);
    color:#fff;

    font-size:.75rem;
    font-weight:700;

    text-transform:uppercase;
}

.practice-date{
    color:#64748b;
    margin-top:18px;
    font-weight:600;
}

.practice-time{
    margin-top:8px;
    font-size:1.15rem;
    font-weight:800;
}

.summary-card{
    background:#fff;
    border-radius:28px;
    padding:40px 25px;
    text-align:center;
    border:1px solid #e5e7eb;
    height:100%;
    transition:.35s;
}

.summary-card:hover{
    transform:translateY(-8px);
}

.summary-number{
    font-size:3rem;
    font-weight:900;
    line-height:1;
}

.summary-label{
    margin-top:10px;
    color:#64748b;
    text-transform:uppercase;
    font-weight:700;
    letter-spacing:1px;
}

.achievement-card{
    background:#fff;
    border-radius:28px;
    overflow:hidden;

    border:1px solid #e5e7eb;

    transition:.35s;

    height:100%;
}

.achievement-card:hover{
    transform:translateY(-8px);
}

.achievement-image{
    height:220px;

    background:
        linear-gradient(rgba(2,6,23,.65), rgba(2,6,23,.8)),
        url('https://images.unsplash.com/photo-1519861531473-9200262188bf?q=80&w=1200');

    background-size:cover;
    background-position:center;
}

.achievement-content{
    padding:25px;
}

.achievement-badge{
    color:var(--primary);
    font-size:.75rem;
    font-weight:800;
    text-transform:uppercase;
    letter-spacing:2px;
}

.achievement-title{
    margin-top:12px;
    font-size:1.25rem;
    font-weight:800;
    line-height:1.5;
}

.cta-section{
    background:var(--dark);
    border-radius:40px;
    padding:70px;
    text-align:center;
}

.cta-title{
    color:#fff;
    font-size:3rem;
    font-weight:900;
    text-transform:uppercase;
    font-style:italic;
}

.cta-title span{
    color:var(--primary);
}

.cta-desc{
    color:#cbd5e1;
    max-width:700px;
    margin:auto;
    margin-top:20px;
    line-height:2;
}

@media(max-width:991px){

    .hero-section{
        min-height:auto;
        padding:120px 0;
    }

    .hero-title{
        font-size:3.5rem;
    }

    .timeline-card{
        margin-top:40px;
    }

    .section-title{
        font-size:2.1rem;
    }

    .cta-section{
        padding:40px 25px;
    }

    .cta-title{
        font-size:2rem;
    }
}

</style>

<section class="hero-section">

    <div class="container">

        <div class="row align-items-center g-5">

            <div class="col-lg-7">

                <div class="hero-subtitle">
                    Management Control
                </div>

                <h1 class="hero-title">
                    Arena
                    <br>
                    <span>Command Center.</span>
                </h1>

                <p class="hero-desc">
                    Monitor aktivitas klub, jadwal latihan,
                    dan reservasi lapangan dalam satu dashboard
                    modern terintegrasi.
                </p>

                <div class="d-flex flex-wrap gap-3 mt-5">

                    <a href="{{ url('/profil') }}"
                       class="btn-premium">
                        About Club
                    </a>

                    <a href="{{ url('/roster') }}"
                       class="btn-outline-premium">
                        View Team
                    </a>

                </div>

            </div>

            <div class="col-lg-5">

                <div class="timeline-card">

                    <div class="timeline-label">
                        Today's Timeline
                    </div>

                    <div class="timeline-title">
                        Upcoming Schedule
                    </div>

                     <div class="mt-3 mb-4">

                         <div class="current-time-label">
                            Current Time
                          </div>

                          <div class="current-time" id="currentTime">
                             00:00 WIB
                          </div>

                     </div>

                    <div id="timelineContainer"></div>

                    <div class="row g-3 mt-2 justify-content-center">

                        <div class="col-4">
                            <div class="text-center">
                                <div class="fw-bold fs-4" id="reservationCount">
                                    0
                                </div>

                                <small class="text-secondary">
                                    Reservasi
                                </small>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="text-center">
                                <div class="fw-bold fs-4" id="practiceCount">
                                    0
                                </div>

                                <small class="text-secondary">
                                    Latihan
                                </small>
                            </div>
                        </div>

                    </div>

                    <a href="{{ url('/jadwal') }}"
                       class="btn btn-dark w-100 py-3 rounded-4 fw-bold mt-3">

                        GO TO SCHEDULE PAGE

                    </a>

                </div>

            </div>

        </div>

    </div>

</section>
{{-- ================= LATIHAN ASEBA ================= --}}
<section class="section-space">

    <div class="container">

        <div class="mb-5">

            <h2 class="section-title">
                Latihan ASEBA
                <span>Minggu Ini</span>
            </h2>

        </div>

        <div class="row g-4">

            @forelse($practiceSchedules as $practice)

                <div class="col-lg-3 col-md-6">

                    <div class="practice-card">

                        <div class="practice-tag">
                            LATIHAN ASEBA
                        </div>

                        <div class="practice-date">

                            {{ $practice['date']->translatedFormat('l, d F Y') }}

                        </div>

                        <div class="practice-time">

                            {{ $practice['start'] }}
                            -
                            {{ $practice['end'] }}
                            WIB

                        </div>

                        <div class="mt-3 text-secondary">

                            {{ $practice['description'] }}

                        </div>

                    </div>

                </div>

            @empty

                <div class="col-12">

                    <div class="practice-card text-center">

                        <div class="text-secondary">

                            <i class="bi bi-calendar-x fs-1"></i>

                            <div class="fw-bold mt-3">
                                Tidak ada jadwal latihan ASEBA minggu ini.
                            </div>

                            <small>
                                Belum terdapat jadwal latihan yang tersedia.
                            </small>

                        </div>

                    </div>

                </div>

            @endforelse

        </div>

    </div>

</section>

{{-- ================= ASEBA SUMMARY ================= --}}
<section class="pb-5">

    <div class="container">

        <div class="mb-5">

            <h2 class="section-title">

                ASEBA
                <span>Summary</span>

            </h2>

        </div>

        <div class="row g-4">

            <div class="col-lg-6 col-md-6">

                <div class="summary-card">

                    <div class="summary-number">
                        {{ $totalAnggota }}
                    </div>

                    <div class="summary-label">
                        Total Anggota
                    </div>

                </div>

            </div>


            <div class="col-lg-6 col-md-6">

                <div class="summary-card">

                    <div class="summary-number">
                        {{ $totalTim }}
                    </div>

                    <div class="summary-label">
                        Total Tim
                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

{{-- ================= PREVIEW PRESTASI ================= --}}
<section class="section-space pt-0">

    <div class="container">

        <div class="d-flex justify-content-between align-items-center mb-5 flex-wrap gap-3">

            <h2 class="section-title">

                Prestasi
                <span>ASEBA</span>

            </h2>

            <a href="{{ url('/profil') }}"
               class="fw-bold text-decoration-none">

                Lihat Semua →

            </a>

        </div>

        <div class="row g-4">

            <div class="col-12">

                <div class="achievement-card">

                    <div class="achievement-content text-center py-5">

                        <div class="text-secondary">

                            <i class="bi bi-trophy fs-1"></i>

                            <div class="fw-bold mt-3">
                                Belum ada data prestasi ASEBA.
                            </div>

                            <small>
                                Data prestasi akan ditampilkan setelah fitur Gallery tersedia.
                            </small>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>
{{-- ================= CTA RESERVASI ================= --}}
<section class="pb-5">

    <div class="container">

        <div class="cta-section">

            <div class="cta-title">

                Siap Bermain di ABHC?

                <br>
                <span>Cek jadwal lapangan dan lakukan reservasi secara online</span>

            </div>

            <p class="cta-desc">

                Cek ketersediaan lapangan,
                lihat jadwal penggunaan,
                dan lakukan reservasi secara online
                melalui sistem reservasi ABHC.

            </p>

            <div class="mt-5">

                <a href="{{ url('/jadwal') }}"
                   class="btn btn-light rounded-pill px-5 py-3 fw-bold">

                    LIHAT JADWAL LAPANGAN

                </a>

            </div>

        </div>

    </div>

</section>
@push('scripts')

<script>

const todayBookings = @json($todayBookings);
const todayPractices = @json($todayPractices);

/*
|--------------------------------------------------------------------------
| WAKTU WIB
|--------------------------------------------------------------------------
*/

function getJakartaTime()
{
    const parts = new Intl.DateTimeFormat('en-US', {
        timeZone: 'Asia/Jakarta',
        hour: '2-digit',
        minute: '2-digit',
        hour12: false
    }).formatToParts(new Date());

    const hour = parseInt(
        parts.find(part => part.type === 'hour').value
    );

    const minute = parseInt(
        parts.find(part => part.type === 'minute').value
    );

    const now = new Date();

    now.setHours(hour);
    now.setMinutes(minute);
    now.setSeconds(0);
    now.setMilliseconds(0);

    return now;
}

function updateSummary() {

    const now = getJakartaTime();

    /*
     * ================================
     * RESERVASI HARI INI
     * ================================
     */
    const reservationCount = todayBookings.length;


    /*
     * ================================
     * LATIHAN HARI INI
     * ================================
     */
    const todayDate = now.toISOString().split('T')[0];

    const practiceCount = todayPractices.length;


    /*
     * ================================
     * AVAILABLE HARI INI
     *
     * Operasional:
     * 08:00 - 23:00
     *
     * Total = 15 slot
     * ================================
     */
    const totalSlots = 15;

    let occupiedSlots = 0;

    todayBookings.forEach(function (booking) {

        const start = parseInt(
            booking.start.substring(0, 2)
        );

        const end = parseInt(
            booking.end.substring(0, 2)
        );

        occupiedSlots += Math.max(
            0,
            end - start
        );

    });


    const availableCount = Math.max(
        0,
        totalSlots - occupiedSlots
    );


    /*
     * ================================
     * UPDATE TAMPILAN
     * ================================
     */

    document.getElementById('reservationCount').textContent =
        reservationCount;

    document.getElementById('practiceCount').textContent =
        practiceCount;

    
}
/*
|--------------------------------------------------------------------------
| CURRENT TIME
|--------------------------------------------------------------------------
*/

function updateCurrentTime()
{
    const now = getJakartaTime();

    const jam = String(
        now.getHours()
    ).padStart(2, '0');

    const menit = String(
        now.getMinutes()
    ).padStart(2, '0');

    document.getElementById('currentTime').innerHTML =
        jam + ':' + menit + ' WIB';

    generateTimeline(now);
}


/*
|--------------------------------------------------------------------------
| UPCOMING SCHEDULE
|--------------------------------------------------------------------------
*/

function generateTimeline(now)
{
    let html = '';

    const currentHour = now.getHours();

    let reservationCount = 0;
    let practiceCount = 0;
    

    /*
    |--------------------------------------------------------------------------
    | TAMPILKAN 4 JAM KE DEPAN
    |--------------------------------------------------------------------------
    */

    for (let i = 0; i < 4; i++) {

        const startHour = currentHour + i;
        const endHour = startHour + 1;

        const startText =
            String(startHour % 24).padStart(2, '0') + ':00';

        const endText =
            String(endHour % 24).padStart(2, '0') + ':00';


        /*
        |--------------------------------------------------------------------------
        | LAPANGAN TUTUP
        |--------------------------------------------------------------------------
        */

        if (
            startHour >= 23 ||
            startHour < 8
        ) {

            html += `
                <div class="timeline-item closed">

                    <div class="d-flex justify-content-between">

                        <div class="timeline-time">
                            ${startText} - ${endText}
                        </div>

                        <div class="timeline-status">
                            Lapangan Tutup
                        </div>

                    </div>

                </div>
            `;

            continue;
        }


        /*
        |--------------------------------------------------------------------------
        | CARI BOOKING
        |--------------------------------------------------------------------------
        */

        const booking = todayBookings.find(function(item) {

            const bookingStart =
                parseInt(item.start.substring(0, 2));

            const bookingEnd =
                parseInt(item.end.substring(0, 2));

            return (
                startHour >= bookingStart &&
                startHour < bookingEnd
            );
        });


        /*
        |--------------------------------------------------------------------------
        | CARI LATIHAN
        |--------------------------------------------------------------------------
        */

        const practice = todayPractices.find(function(item) {

            const practiceStart =
                parseInt(item.start.substring(0, 2));

            const practiceEnd =
                parseInt(item.end.substring(0, 2));

            return (
                startHour >= practiceStart &&
                startHour < practiceEnd
            );
        });


        /*
        |--------------------------------------------------------------------------
        | PRIORITAS BOOKING
        |--------------------------------------------------------------------------
        */

        if (booking) {

            reservationCount++;

            html += `
                <div class="timeline-item booked">

                    <div class="d-flex justify-content-between">

                        <div>

                            <div class="timeline-time">
                                ${startText} - ${endText}
                            </div>

                            <div class="timeline-status">
                                ${booking.customer}
                            </div>

                        </div>

                        <div class="timeline-status">
                            Reservasi
                        </div>

                    </div>

                </div>
            `;
        }


        /*
        |--------------------------------------------------------------------------
        | LATIHAN
        |--------------------------------------------------------------------------
        */

        else if (practice) {

            practiceCount++;

            html += `
                <div class="timeline-item practice">

                    <div class="d-flex justify-content-between">

                        <div>

                            <div class="timeline-time">
                                ${startText} - ${endText}
                            </div>

                            <div class="timeline-status">
                                ${practice.description}
                            </div>

                        </div>

                        <div class="timeline-status">
                            Latihan
                        </div>

                    </div>

                </div>
            `;
        }


        /*
        |--------------------------------------------------------------------------
        | AVAILABLE
        |--------------------------------------------------------------------------
        */

        else {

           

            html += `
                <div class="timeline-item">

                    <div class="d-flex justify-content-between">

                        <div class="timeline-time">
                            ${startText} - ${endText}
                        </div>

                        <div class="timeline-status">
                            Available
                        </div>

                    </div>

                </div>
            `;
        }
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE TIMELINE
    |--------------------------------------------------------------------------
    */

    document.getElementById(
        'timelineContainer'
    ).innerHTML = html;


    /*
    |--------------------------------------------------------------------------
    | UPDATE SUMMARY
    |--------------------------------------------------------------------------
    */

    

    
}


/*
|--------------------------------------------------------------------------
| INITIAL LOAD
|--------------------------------------------------------------------------
*/

updateCurrentTime();
updateSummary();


/*
|--------------------------------------------------------------------------
| REALTIME SETIAP DETIK
|--------------------------------------------------------------------------
*/

setInterval(
    updateCurrentTime,
    1000
);

</script>

@endpush
@endsection
