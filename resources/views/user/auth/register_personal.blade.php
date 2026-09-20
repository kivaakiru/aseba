@extends('user.layouts.auth')

@section('title', 'Daftar Personal')

@section('content')

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">

    <div class="card shadow p-4" style="width: 420px;">

        <h3 class="fw-bold text-center mb-3">Daftar Personal</h3>
        <p class="text-center text-muted mb-4">
            Buat akun personal untuk booking lapangan
        </p>

        {{-- ERROR GLOBAL --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="/user/register/personal">
            @csrf

            {{-- NAMA --}}
            <div class="mb-3">
                <label class="form-label fw-bold">Nama Lengkap</label>
                <input type="text"
                       name="name"
                       class="form-control @error('name') is-invalid @enderror"
                       value="{{ old('name') }}"
                       required>

                <small class="text-muted">
                    Gunakan nama asli. Nama ini akan ditampilkan pada jadwal booking lapangan.
                </small>

                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            {{-- NOMOR HP --}}
            <div class="mb-3">

                <label class="form-label fw-bold">

                    Nomor HP

                </label>

                <input
                    type="text"
                    name="phone"
                    class="form-control @error('phone') is-invalid @enderror"
                    value="{{ old('phone') }}"
                    placeholder="08xxxxxxxxxx"
                    required>

                @error('phone')

                    <div class="invalid-feedback">

                        {{ $message }}

                    </div>

                @enderror

            </div>

            {{-- EMAIL --}}
            <div class="mb-3">
                <label class="form-label fw-bold">Email</label>
                <input type="email"
                       name="email"
                       class="form-control @error('email') is-invalid @enderror"
                       value="{{ old('email') }}"
                       required>

                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- PASSWORD --}}
            <div class="mb-3">
                <label class="form-label fw-bold">Password</label>
                <input type="password"
                       name="password"
                       class="form-control @error('password') is-invalid @enderror"
                       required>

                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- KONFIRMASI PASSWORD --}}
            <div class="mb-3">
                <label class="form-label fw-bold">Konfirmasi Password</label>
                <input type="password"
                       name="password_confirmation"
                       class="form-control @error('password') is-invalid @enderror"
                       required>
            </div>

            <button type="submit" class="btn btn-success w-100 mb-3">
                Daftar
            </button>
        </form>

        <p class="text-center mt-2">
            Mendaftar sebagai klub?
            <a href="{{ route('user.register.club') }}">Daftar Klub</a>
        </p>

        <p class="text-center mt-2">
            Sudah punya akun?
            <a href="{{ route('user.login') }}">Login</a>
        </p>

    </div>

</div>

@endsection
