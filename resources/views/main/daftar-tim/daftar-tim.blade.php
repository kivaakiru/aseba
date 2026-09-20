@extends('main.layout.layout')

@section('title', 'Tim ASEBA')

@section('content')

<div class="container my-5">

    {{-- HEADER --}}
    <div class="mb-4">
        <h3 class="fw-bold mb-1">Tim ASEBA</h3>
        <div class="text-muted">
            Tim resmi ASEBA yang mengikuti event, liga, dan turnamen
        </div>
    </div>

    @php
        $teams = $teams ?? [];
    @endphp

    @if(count($teams) === 0)
        <div class="alert alert-light border">
            Data tim belum tersedia.
        </div>
    @else
        <div class="row g-4">
            @foreach($teams as $team)
                <div class="col-md-6">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">

                            <h5 class="fw-bold mb-1">{{ $team->name }}</h5>
                            <div class="text-muted small mb-3">
                                {{ $team->category ?? 'Tim Kompetisi ASEBA' }}
                            </div>

                            <div class="mb-3">
                                <span class="badge bg-light text-dark">
                                    {{ $team->players_count ?? 0 }} Atlet
                                </span>
                            </div>

                            <hr>

                            {{-- PREVIEW ATLET --}}
                            @php
                                $players = $team->players ?? [];
                            @endphp

                            @if(count($players) === 0)
                                <div class="text-muted small">
                                    Data atlet belum tersedia.
                                </div>
                            @else
                                <ul class="list-unstyled mb-0">
                                    @foreach($players->take(5) as $player)
                                        <li class="mb-1">
                                            <i class="bi bi-person me-1"></i>
                                            {{ $player->name }}
                                        </li>
                                    @endforeach
                                </ul>
                            @endif

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <div class="mt-4">
        <a href="{{ url('/profil-aseba') }}"
           class="btn btn-outline-secondary btn-sm">
            Kembali ke Profil ASEBA
        </a>
    </div>

</div>

@endsection
