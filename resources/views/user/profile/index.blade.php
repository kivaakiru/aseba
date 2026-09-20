@extends('user.layouts.user')

@section('title','Profil Saya')

@section('content')

@php
    $user = auth()->user();
@endphp

<div class="container-fluid">

    <div class="card border-0 shadow-sm mb-4">

        <div class="card-body d-flex justify-content-between align-items-center">

            <div>

                <h3 class="fw-bold mb-1">

                    Profil Saya

                </h3>

                <small class="text-muted">

                    Informasi akun Anda.

                </small>

            </div>

            <a
                href="{{ route('user.profile.edit') }}"
                class="btn btn-primary">

                <i class="bi bi-pencil-square me-2"></i>

                Edit Profil

            </a>

        </div>

    </div>

    <div class="card border-0 shadow-sm">

        <div class="card-body">

            <div class="row">

                <div class="col-lg-3 text-center border-end">

                    <img
                    src="{{ url('storage/users/'.$user->photo) }}"
                    class="rounded-circle shadow"
                    width="140"
                    height="140"
                    style="object-fit:cover;"
                    alt="User">

                    <h4 class="fw-bold mt-3 mb-1">

                        {{ $user->name }}

                    </h4>

                    <span class="badge bg-primary">

                        {{ ucfirst($user->user_type) }}

                    </span>

                </div>

                <div class="col-lg-9">
                                        @if($user->user_type == 'personal')

                        <div class="row g-4">

                            <div class="col-md-6">

                                <label class="form-label text-muted">

                                    Nama Lengkap

                                </label>

                                <div class="fw-semibold fs-5">

                                    {{ $user->name }}

                                </div>

                            </div>

                            <div class="col-md-6">

                                <label class="form-label text-muted">

                                    Email

                                </label>

                                <div class="fw-semibold fs-5">

                                    {{ $user->email }}

                                </div>

                            </div>

                            <div class="col-md-6">

                                <label class="form-label text-muted">

                                    Nomor HP

                                </label>

                                <div class="fw-semibold fs-5">

                                    {{ $user->phone }}

                                </div>

                            </div>

                        </div>

                    @else

                        <div class="row g-4">

                            <div class="col-md-6">

                                <label class="form-label text-muted">

                                    Nama Klub

                                </label>

                                <div class="fw-semibold fs-5">

                                    {{ $user->name }}

                                </div>

                            </div>

                            <div class="col-md-6">

                                <label class="form-label text-muted">

                                    Ketua Klub

                                </label>

                                <div class="fw-semibold fs-5">

                                    {{ $user->leader_name }}

                                </div>

                            </div>

                            <div class="col-md-6">

                                <label class="form-label text-muted">

                                    Email

                                </label>

                                <div class="fw-semibold fs-5">

                                    {{ $user->email }}

                                </div>

                            </div>

                            <div class="col-md-6">

                                <label class="form-label text-muted">

                                    Nomor HP

                                </label>

                                <div class="fw-semibold fs-5">

                                    {{ $user->phone }}

                                </div>

                            </div>

                        </div>

                    @endif

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
