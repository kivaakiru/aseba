@extends('user.layouts.user')

@section('title','Edit Profil')

@section('content')

@php
    $user = auth()->user();
@endphp

<div class="container-fluid">

    <div class="card border-0 shadow-sm mb-4">

        <div class="card-body d-flex justify-content-between align-items-center">

            <div>

                <h3 class="fw-bold mb-1">

                    Edit Profil

                </h3>

                <small class="text-muted">

                    Perbarui informasi akun Anda.

                </small>

            </div>

            <a
                href="{{ route('user.profile.index') }}"
                class="btn btn-outline-secondary">

                <i class="bi bi-arrow-left me-2"></i>

                Kembali

            </a>

        </div>

    </div>

    @if(session('success'))

        <div class="alert alert-success">

            {{ session('success') }}

        </div>

    @endif

    @if($errors->any())

        <div class="alert alert-danger">

            <ul class="mb-0">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    <form
        action="{{ route('user.profile.update') }}"
        method="POST"
        enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div class="card border-0 shadow-sm">

            <div class="card-body">

                <div class="text-center mb-4">

                    <img
                        src="{{ url('storage/users/'.$user->photo) }}"
                        class="rounded-circle shadow mb-3"
                        width="140"
                        height="140"
                        style="object-fit:cover;"
                        alt="User">
                        <div class="mt-3">

                        <input
                            type="file"
                            name="photo"
                            class="form-control">

                    </div>

                </div>

                <div class="row g-4">

                    @if($user->user_type == 'personal')

                        <div class="col-md-6">

                            <label class="form-label">

                                Nama Lengkap

                            </label>

                            <input
                                type="text"
                                name="name"
                                class="form-control"
                                value="{{ old('name',$user->name) }}">

                        </div>

                    @else

                        <div class="col-md-6">

                            <label class="form-label">

                                Nama Klub

                            </label>

                            <input
                                type="text"
                                name="name"
                                class="form-control"
                                value="{{ old('name',$user->name) }}">

                        </div>

                        <div class="col-md-6">

                            <label class="form-label">

                                Nama Ketua Klub

                            </label>

                            <input
                                type="text"
                                name="leader_name"
                                class="form-control"
                                value="{{ old('leader_name',$user->leader_name) }}">

                        </div>

                    @endif

                    <div class="col-md-6">

                        <label class="form-label">

                            Nomor HP

                        </label>

                        <input
                            type="text"
                            name="phone"
                            class="form-control"
                            value="{{ old('phone',$user->phone) }}">

                    </div>

                    <div class="col-md-6">

                        <label class="form-label">

                            Email

                        </label>

                        <input
                            type="email"
                            class="form-control"
                            value="{{ $user->email }}"
                            readonly>

                    </div>

                    <div class="col-md-6">

                        <label class="form-label">

                            Password Baru

                        </label>

                        <input
                            type="password"
                            name="password"
                            class="form-control">

                    </div>

                    <div class="col-md-6">

                        <label class="form-label">

                            Konfirmasi Password

                        </label>

                        <input
                            type="password"
                            name="password_confirmation"
                            class="form-control">

                    </div>

                </div>

                <hr>

                <div class="text-end">

                    <button
                        type="submit"
                        class="btn btn-primary px-4">

                        <i class="bi bi-check-circle me-2"></i>

                        Simpan Perubahan

                    </button>

                </div>

            </div>

        </div>

    </form>

</div>

@endsection
