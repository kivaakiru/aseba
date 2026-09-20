<div class="card booking-summary-card shadow-sm">

    <div class="card-header">

        <div class="row align-items-center gy-3">

            <div class="col-lg-8">

                <div class="d-flex align-items-center gap-3">

                    <div class="summary-icon">

                        <i class="bi bi-calendar2-week"></i>

                    </div>

                    <div>

                        <h4 class="fw-bold mb-1">

                            Booking List

                        </h4>

                        <div
                            class="text-secondary"
                            id="bookingListDate">

                            Monday, 22 June 2026

                        </div>

                    </div>

                </div>

            </div>

            <div class="col-lg-4 text-lg-end">

                <span
                    class="badge rounded-pill bg-success-subtle text-success px-3 py-2 fs-6"
                    id="bookingCounter">

                    4 Booking

                </span>

            </div>

        </div>

    </div>

    <div class="card-body">

        <div class="row g-4 align-items-stretch">

            {{-- LEFT DATE CARD --}}

            <div class="col-xl-2 col-lg-3">

                <div class="summary-date-card">

                    <div class="summary-day">

                        MONDAY

                    </div>

                    <div class="summary-date">

                        22

                    </div>

                    <div class="summary-month">

                        JUNE 2026

                    </div>

                    <span class="badge rounded-pill bg-primary-subtle text-primary mt-3">

                        Today

                    </span>

                </div>

            </div>

            {{-- BOOKING LIST --}}

            <div class="col-xl-7 col-lg-6">

                <div
                    class="booking-summary-list"
                    id="bookingSummaryList">

                    <div class="text-center py-5 text-secondary">

                        <div class="spinner-border spinner-border-sm me-2"></div>

                        Memuat data booking...

                    </div>

                </div>

            </div>

            {{-- RIGHT ILLUSTRATION --}}

            <div class="col-xl-3 col-lg-3">

                <div class="summary-illustration">

                    <div class="illustration-circle">

                        <i class="bi bi-clipboard2-check"></i>

                    </div>

                    <h5 class="fw-bold mt-4">

                        Court Activity

                    </h5>

                    <p class="text-secondary mb-0">

                        Monitor all reservations and court activities for the selected date.

                    </p>

                </div>

            </div>

        </div>
                </div>

    </div>

</div>

<style>

.summary-icon{

    width:52px;

    height:52px;

    border-radius:16px;

    background:#FFF7ED;

    color:#EA580C;

    display:flex;

    justify-content:center;

    align-items:center;

    font-size:24px;

}

.summary-date-card{

    height:100%;

    background:#FFFFFF;

    border:1px solid #E2E8F0;

    border-radius:24px;

    padding:26px 20px;

    display:flex;

    flex-direction:column;

    justify-content:center;

    align-items:center;

    text-align:center;

}

.summary-day{

    font-size:13px;

    color:#64748B;

    font-weight:700;

    letter-spacing:1px;

}

.summary-date{

    font-size:68px;

    line-height:1;

    font-weight:800;

    margin:12px 0;

    color:#0F172A;

}

.summary-month{

    font-size:14px;

    color:#64748B;

    font-weight:600;

}

.booking-summary-list{

    display:flex;

    flex-direction:column;

    gap:12px;

    height:420px;

    overflow-y:auto;

    padding-right:6px;

}

.booking-summary-list::-webkit-scrollbar{

    width:8px;

}

.booking-summary-list::-webkit-scrollbar-thumb{

    background:#CBD5E1;

    border-radius:999px;

}

.booking-summary-list::-webkit-scrollbar-thumb:hover{

    background:#94A3B8;

}

.booking-summary-item{

    display:grid;

    grid-template-columns:

    140px

    1fr

    190px

    140px;

    align-items:center;

    gap:18px;

    padding:16px 18px;

    background:#FFFFFF;

    border:1px solid #E5E7EB;

    border-radius:18px;

    transition:.25s;

}

.booking-summary-item:hover{

    border-color:#EA580C;

    background:#FFF7ED;

}

.booking-time{

    font-size:15px;

    font-weight:700;

    text-align:center;

    border-radius:999px;

    padding:8px 12px;

}

.booking-time.approved{

    background:#DCFCE7;

    color:#166534;

}

.booking-time.training{

    background:#DBEAFE;

    color:#1D4ED8;

}

.booking-time.pending{

    background:#FEF3C7;

    color:#92400E;

}

.booking-user{

    font-size:16px;

    color:#334155;

}

.booking-user strong{

    color:#0F172A;

}

.booking-added{

    display:flex;

    align-items:center;

    gap:10px;

    font-size:14px;

    color:#64748B;

}

.booking-avatar{

    width:34px;

    height:34px;

    border-radius:50%;

    object-fit:cover;

}

.booking-status{

    text-align:right;

}

.summary-illustration{

    height:100%;

    border-radius:24px;

    border:1px solid #E2E8F0;

    background:linear-gradient(180deg,#FFFFFF,#F8FAFC);

    display:flex;

    flex-direction:column;

    justify-content:center;

    align-items:center;

    padding:28px;

    text-align:center;

}

.illustration-circle{

    width:110px;

    height:110px;

    border-radius:50%;

    background:#FFF7ED;

    color:#EA580C;

    display:flex;

    justify-content:center;

    align-items:center;

    font-size:54px;

}

@media(max-width:1199px){

.booking-summary-item{

grid-template-columns:

130px

1fr;

}

.booking-added{

grid-column:2;

}

.booking-status{

grid-column:2;

text-align:left;

}

.summary-illustration{

display:none;

}

}

@media(max-width:991px){

.booking-summary-list{

height:420px;

max-height:420px;

overflow-y:auto;

overflow-x:hidden;

}

}

@media(max-width:767px){

.summary-date-card{

padding:20px;

}

.summary-date{

font-size:52px;

}

.booking-summary-item{

grid-template-columns:1fr;

gap:10px;

padding:16px;

}

.booking-time{

width:fit-content;

}

.booking-added{

grid-column:auto;

}

.booking-status{

grid-column:auto;

text-align:left;

}

.booking-user{

font-size:15px;

}

.booking-added{

font-size:13px;

}

}

</style>
