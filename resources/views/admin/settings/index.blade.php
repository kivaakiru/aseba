@extends('admin.layouts.admin')

@section('title','My Account')

@section('content')

<div class="container-fluid">
    @if ($errors->any())

        <div class="alert alert-danger">

            <ul class="mb-0">

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    @if(session('success'))

        <div class="alert alert-success">

            {{ session('success') }}

        </div>

    @endif

    <h3 class="fw-bold mb-4">

        My Account

    </h3>

    <div class="card shadow-sm border-0">

        <form
            action="{{ route('admin.settings.update') }}"
            method="POST"
            enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="card-body">

                <div class="row g-4">

                    <div class="col-lg-4 text-center">

                        @if(auth()->user()->photo)

                            <img
                                src="{{ asset('storage/users/'.auth()->user()->photo) }}"
                                class="rounded-circle border mb-3"
                                width="150"
                                height="150"
                                style="object-fit:cover;">

                        @else

                            <div
                                class="rounded-circle bg-primary text-white d-inline-flex justify-content-center align-items-center fw-bold mb-3"
                                style="width:150px;height:150px;font-size:48px;">

                                {{ strtoupper(substr(auth()->user()->name,0,1)) }}

                            </div>

                        @endif

                        <input
                            type="file"
                            name="photo"
                            class="form-control">

                    </div>

                    <div class="col-lg-8">

                        <div class="row g-3">

                            <div class="col-md-6">

                                <label class="form-label">

                                    Nama

                                </label>

                                <input
                                    type="text"
                                    name="name"
                                    class="form-control"
                                    value="{{ old('name',auth()->user()->name) }}">

                            </div>

                            <div class="col-md-6">

                                <label class="form-label">

                                    Email

                                </label>

                                <input
                                    type="email"
                                    class="form-control"
                                    value="{{ auth()->user()->email }}"
                                    readonly>

                            </div>

                            <div class="col-md-6">

                                <label class="form-label">

                                    Nomor HP

                                </label>

                                <input
                                    type="text"
                                    name="phone"
                                    class="form-control"
                                    value="{{ old('phone',auth()->user()->phone) }}">

                            </div>

                            <div class="col-md-6">

                                <label class="form-label">

                                    Role

                                </label>

                                <input
                                    type="text"
                                    class="form-control"
                                    value="{{ ucfirst(auth()->user()->user_level) }}"
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

                    </div>

                </div>

            </div>

            <div class="card-footer bg-white text-end">

                <button class="btn btn-primary">

                    <i class="bi bi-save me-1"></i>

                    Simpan Perubahan

                </button>

            </div>

        </form>

    </div>

</div>

@endsection
