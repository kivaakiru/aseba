<div class="card border-0 shadow-sm h-100">

    <div class="card-header bg-white border-0">

        <div class="d-flex justify-content-between align-items-center">

            <div>

                <h5 class="fw-bold mb-1">

                    Booking Statistics

                </h5>

                <small class="text-muted">

                    Jumlah booking selama 12 bulan terakhir

                </small>

            </div>

            <span class="badge bg-success">

                {{ date('Y') }}

            </span>

        </div>

    </div>

    <div class="card-body">

        <canvas
            id="revenueChart"
            height="110">
        </canvas>

    </div>

</div>

@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const revenueChart = document.getElementById('revenueChart');

if(revenueChart){

    new Chart(revenueChart,{

        type:'line',

        data:{

            labels:@json($chartLabels),

            datasets:[{

                label:'Total Booking',

                data:@json($chartRevenue),

                borderWidth:3,

                tension:.35,

                fill:true,

                backgroundColor:'rgba(234,88,12,.10)',

                borderColor:'#EA580C',

                pointRadius:4,

                pointHoverRadius:6

            }]

        },

        options:{

            responsive:true,

            maintainAspectRatio:false,

            plugins:{

                legend:{

                    display:false

                }

            },

            scales:{

                y:{

                    beginAtZero:true,

                    ticks:{

                        callback:function(value){

                            return value + ' Booking';

                        }

                    }

                }

            }

        }

    });

}

</script>

@endpush
