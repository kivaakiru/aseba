@extends('user.layouts.auth')

@section('title', 'Reset Password')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="card shadow p-4" style="width: 400px;">

        <h3 class="fw-bold text-center mb-3">Reset Password</h3>
        <p class="text-center text-muted mb-4">Silakan masukkan password baru Anda.</p>

        {{-- Menampilkan Error --}}
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('user.reset.password') }}">
            @csrf

            {{-- Token dan Email disembunyikan (Email diambil otomatis dari URL) --}}
            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="email" value="{{ request()->email }}">

            <div class="mb-3">
                <label class="form-label fw-bold">Email</label>
                <input type="text" class="form-control" value="{{ request()->email }}" disabled>
                <small class="text-muted">Email ini diambil otomatis dari sistem.</small>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Password Baru</label>
                <input type="password" name="password" class="form-control" required autofocus placeholder="Minimal 8 karakter">
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="form-control" required placeholder="Ulangi password baru">
            </div>

            <button type="submit" class="btn btn-primary w-100 mb-3">
                Update Password
            </button>
        </form>

    </div>
</div>
@endsection