@extends('main.layout.layout')

@section('title', 'Anggota ASEBA')

@section('content')

<div class="container my-5">

    {{-- HEADER --}}
    <div class="mb-4">
        <h3 class="fw-bold mb-1">Anggota ASEBA</h3>
        <div class="text-muted">Daftar anggota & atlet yang tergabung dalam klub ASEBA</div>
    </div>

    @php
        $members = $members ?? [];
    @endphp

    @if(count($members) === 0)
        <div class="alert alert-light border">
            Data anggota belum tersedia.
        </div>
    @else
        <div class="row g-3">
            @foreach($members as $member)
                <div class="col-md-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body d-flex align-items-center gap-3">

                            <div class="rounded-circle bg-secondary-subtle"
                                 style="width:60px;height:60px;"></div>

                            <div class="flex-grow-1">
                                <div class="fw-bold">{{ $member->name }}</div>
                                <div class="text-muted small">
                                    {{ $member->role ?? 'Atlet ASEBA' }}
                                </div>
                            </div>

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
