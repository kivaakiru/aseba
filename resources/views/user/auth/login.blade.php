@extends('user.layouts.auth')

@section('title', 'Login')

@section('content')

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="card shadow p-4" style="width: 380px;">

        <h3 class="fw-bold text-center mb-3">Login</h3>
        <p class="text-center text-muted mb-4">Masuk ke akun ASEBA Anda</p>

        @if($errors->any())
            <div class="alert alert-danger">
                Email atau password salah.
            </div>
        @endif

        @if (session('success'))
    <div class="alert alert-success d-flex align-items-center shadow-sm" id="successAlert">
        <i class="bi bi-check-circle-fill me-2 fs-5"></i>
        <div>
            <strong>Pendaftaran Berhasil</strong><br>
            <small>{{ session('success') }}</small>
        </div>
    </div>

    <script>
        setTimeout(() => {
            document.getElementById('successAlert')?.remove();
        }, 3000);
    </script>
@endif


        <form method="POST" action="/user/login">
            @csrf

            <div class="mb-3">
                <label class="form-label fw-bold">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <p class="text-center">
                <a href="{{ route('user.forgot-password') }}">Lupa password?</a>
            </p>

            <button type="submit" class="btn btn-primary w-100 mb-3">
                Login
            </button>
        </form>

        <p class="text-center mt-2">
            Belum punya akun?
            <a href="{{ route('user.register.personal') }}">Daftar</a>
        </p>

    </div>
</div>

@endsection
