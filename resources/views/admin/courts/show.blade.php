@extends('admin.layouts.admin')

@section('title', 'Pengaturan Lapangan')

@section('content')

@php
    $settings = $settings ?? null;
@endphp

<div class="container-fluid">

    <h3 class="fw-bold mb-4">Pengaturan Lapangan ABHC</h3>

    <div class="card shadow-sm p-4">

        <form action="#" method="POST">
            @csrf

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Jam Buka</label>
                    <input type="time" class="form-control"
                           value="{{ $settings->open_time ?? '' }}">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Jam Tutup</label>
                    <input type="time" class="form-control"
                           value="{{ $settings->close_time ?? '' }}">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Harga Sewa per Jam (Rp)</label>
                <input type="number" class="form-control"
                       value="{{ $settings->price_per_hour ?? '' }}"
                       placeholder="Contoh: 150000">
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Durasi Minimal Booking (jam)</label>
                <input type="number" class="form-control"
                       value="{{ $settings->min_duration ?? '' }}"
                       placeholder="Contoh: 1">
            </div>

            <div class="text-end">
                <button class="btn btn-success">
                    <i class="bi bi-save"></i> Simpan Pengaturan
                </button>
            </div>

        </form>

    </div>

</div>

@endsection
