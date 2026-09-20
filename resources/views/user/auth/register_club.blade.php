@extends('user.layouts.auth')

@section('title', 'Daftar Klub / Komunitas')

@section('content')

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="card shadow p-4" style="width: 420px;">

        <h3 class="fw-bold text-center mb-3">Daftar Klub / Komunitas</h3>
        <p class="text-center text-muted mb-4">
            Buat akun klub untuk booking dan event
        </p>

        {{-- ❗ NOTIF ERROR VALIDASI --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0 small">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="/user/register/club">
            @csrf

            <div class="mb-3">
                <label class="form-label fw-bold">Nama Klub / Komunitas</label>
                <input type="text"
                       name="club_name"
                       class="form-control"
                       value="{{ old('club_name') }}"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Nama Penanggung Jawab</label>
                <input type="text"
                       name="leader_name"
                       class="form-control"
                       value="{{ old('leader_name') }}"
                       required>
            </div>

            <div class="mb-3">

                <label class="form-label fw-bold">

                    Nomor HP

                </label>

                <input
                    type="text"
                    name="phone"
                    class="form-control"
                    value="{{ old('phone') }}"
                    placeholder="08xxxxxxxxxx"
                    required>

            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Email Klub</label>
                <input type="email"
                       name="email"
                       class="form-control"
                       value="{{ old('email') }}"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Password</label>
                <input type="password"
                       name="password"
                       class="form-control"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Konfirmasi Password</label>
                <input type="password"
                       name="password_confirmation"
                       class="form-control"
                       required>
            </div>

            <button type="submit" class="btn btn-success w-100 mb-3">
                Daftar
            </button>
        </form>

        <p class="text-center mt-2">
            Mendaftar sebagai personal?
            <a href="{{ route('user.register.personal') }}">Daftar Personal</a>
        </p>

        <p class="text-center mt-2">
            Sudah punya akun?
            <a href="{{ route('user.login') }}">Login</a>
        </p>

    </div>
</div>

@endsection
