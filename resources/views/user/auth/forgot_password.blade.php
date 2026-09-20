@extends('user.layouts.auth')

@section('title', 'Forgot Password')

@section('content')

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="card shadow p-4" style="width: 380px;">

        <h3 class="fw-bold text-center mb-3">Forgot Password</h3>
        <p class="text-center text-muted mb-4">Masukkan email yang sudah terdaftar sebelumnya</p>

        {{-- Menampilkan Error Validasi --}}
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Menampilkan Pesan Sukses --}}
        @if (session('success') || session('status'))
            <div class="alert alert-success d-flex align-items-center shadow-sm" id="successAlert">
                <i class="bi bi-check-circle-fill me-2 fs-5"></i>
                <div>
                    <strong>Berhasil!</strong><br>
                    <small>{{ session('success') ?? session('status') }}</small>
                </div>
            </div>

            <script>
                setTimeout(() => {
                    document.getElementById('successAlert')?.remove();
                }, 5000);
            </script>
        @endif

<form method="POST" action="{{ route('user.forgot.password.send') }}">
    @csrf
    <div class="mb-3">
        <label class="form-label fw-bold">Email</label>
        <input type="email" name="email" class="form-control" required autofocus>
    </div>
    <button type="submit" class="btn btn-primary w-100 mb-3">
        Send Password Reset Link
    </button>
</form>

        <p class="text-center mt-2">
            <a href="{{ route('user.login') }}" class="text-decoration-none">Kembali ke Halaman Login</a>
        </p>

    </div>
</div>

@endsection