@extends('admin.layouts.admin')

@section('title','Registrasi Pemain')

@section('page-title','Database Atlet')

@section('page-subtitle','Registrasi pemain baru ASEBA Basketball Club')

@section('content')

<div class="container-fluid">

    <!-- HEADER -->

    <div class="player-header mb-5">

        <div class="row align-items-end g-4">

            <div class="col-lg-8">

                <span class="page-label">

                    DATABASE ATLET

                </span>

                <h1 class="page-heading">

                    REGISTRASI <span>PEMAIN.</span>

                </h1>

            </div>

            <div class="col-lg-4 text-lg-end">

                <a href="{{ route('admin.players.index') }}"
                   class="btn btn-back">

                    <i class="bi bi-arrow-left me-2"></i>

                    KEMBALI

                </a>

            </div>

        </div>

    </div>

    @if($errors->any())

        <div class="alert alert-danger border-0 shadow-sm rounded-4 mb-4">

            <div class="fw-bold mb-2">

                <i class="bi bi-exclamation-triangle-fill me-2"></i>

                Terjadi kesalahan

            </div>

            <ul class="mb-0">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    <form action="{{ route('admin.players.store') }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf

        <div class="row g-4">

            <!-- FOTO -->

            <div class="col-lg-4">

                <div class="form-card">

                    <div class="card-title">

                        Foto Pemain

                    </div>

                    <div class="photo-wrapper">

                        <img

                            src="https://placehold.co/300x300/E2E8F0/64748B?text=PLAYER"

                            id="previewImage"

                            class="player-preview">

                    </div>

                    <div class="mt-4">

                        <label class="form-label fw-bold">

                            Upload Foto

                        </label>

                        <input

                            type="file"

                            name="photo"

                            id="photo"

                            class="form-control @error('photo') is-invalid @enderror"

                            accept="image/*">

                        @error('photo')

                            <div class="invalid-feedback">

                                {{ $message }}

                            </div>

                        @enderror

                        <small class="text-muted d-block mt-2">

                            JPG, PNG, WEBP (Max 10MB)

                        </small>

                    </div>

                </div>

            </div>

            <!-- FORM -->

            <div class="col-lg-8">

                <div class="form-card">

                    <div class="card-title mb-4">

                        Informasi Pemain

                    </div>

                    <div class="row g-4">

                        <!-- NAMA -->

                        <div class="col-md-6">

                            <label class="form-label">

                                Nama Lengkap <span>*</span>

                            </label>

                            <input

                                type="text"

                                name="full_name"

                                value="{{ old('full_name') }}"

                                class="form-control @error('full_name') is-invalid @enderror"

                                placeholder="Contoh : Michael Jordan"

                                required>

                            @error('full_name')

                                <div class="invalid-feedback">

                                    {{ $message }}

                                </div>

                            @enderror

                        </div>

                        <!-- JERSEY NAME -->

                        <div class="col-md-6">

                            <label class="form-label">

                                Nama Punggung <span>*</span>

                            </label>

                            <input

                                type="text"

                                name="jersey_name"

                                value="{{ old('jersey_name') }}"

                                class="form-control @error('jersey_name') is-invalid @enderror"

                                placeholder="Contoh : JORDAN"

                                required>

                            @error('jersey_name')

                                <div class="invalid-feedback">

                                    {{ $message }}

                                </div>

                            @enderror

                        </div>

                        <!-- NOMOR -->

                        <div class="col-md-4">

                            <label class="form-label">

                                Nomor Punggung

                            </label>

                            <input

                                type="number"

                                name="jersey_number"

                                value="{{ old('jersey_number') }}"

                                class="form-control"

                                placeholder="23">

                        </div>

                        <!-- TEAM -->

                        <div class="col-md-4">

                            <label class="form-label">

                                Tim

                            </label>

                            <select

                                name="team_id"

                                class="form-select">

                                <option value="">

                                    Belum Memiliki Tim

                                </option>

                                @foreach($teams as $team)

                                    <option

                                        value="{{ $team->id }}"

                                        {{ old('team_id')==$team->id?'selected':'' }}>

                                        {{ $team->name }}

                                    </option>

                                @endforeach

                            </select>

                        </div>

                        <!-- POSISI -->

                        <div class="col-md-4">

                            <label class="form-label">

                                Posisi <span>*</span>

                            </label>

                            <select

                                name="position"

                                class="form-select @error('position') is-invalid @enderror"

                                required>

                                <option value="">Pilih Posisi</option>

                                <option value="PG">Point Guard</option>

                                <option value="SG">Shooting Guard</option>

                                <option value="SF">Small Forward</option>

                                <option value="PF">Power Forward</option>

                                <option value="C">Center</option>

                            </select>

                            @error('position')

                                <div class="invalid-feedback">

                                    {{ $message }}

                                </div>

                            @enderror

                        </div>

                                                <!-- TANGGAL LAHIR -->

                        <div class="col-md-6">

                            <label class="form-label">

                                Tanggal Lahir <span>*</span>

                            </label>

                            <input

                                type="date"

                                name="date_of_birth"

                                value="{{ old('date_of_birth') }}"

                                class="form-control @error('date_of_birth') is-invalid @enderror"

                                required>

                            @error('date_of_birth')

                                <div class="invalid-feedback">

                                    {{ $message }}

                                </div>

                            @enderror

                        </div>

                        <!-- TINGGI -->

                        <div class="col-md-3">

                            <label class="form-label">

                                Tinggi Badan

                            </label>

                            <div class="input-group">

                                <input

                                    type="number"

                                    name="height"

                                    value="{{ old('height') }}"

                                    class="form-control"

                                    placeholder="170">

                                <span class="input-group-text">

                                    cm

                                </span>

                            </div>

                        </div>

                        <!-- BERAT -->

                        <div class="col-md-3">

                            <label class="form-label">

                                Berat Badan

                            </label>

                            <div class="input-group">

                                <input

                                    type="number"

                                    name="weight"

                                    value="{{ old('weight') }}"

                                    class="form-control"

                                    placeholder="65">

                                <span class="input-group-text">

                                    kg

                                </span>

                            </div>

                        </div>

                        <!-- SOSIAL MEDIA -->
                        <div class="col-md-6">
                            <label class="form-label">
                                Nama Sosial Media
                            </label>

                            <input
                                type="text"
                                name="social_media_name"
                                value="{{ old('social_media_name') }}"
                                class="form-control @error('social_media_name') is-invalid @enderror"
                                placeholder="Contoh: Instagram @aqil">

                            @error('social_media_name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">
                                Link Sosial Media
                            </label>

                            <input
                                type="url"
                                name="social_media_url"
                                value="{{ old('social_media_url') }}"
                                class="form-control @error('social_media_url') is-invalid @enderror"
                                placeholder="https://instagram.com/aqil">

                            @error('social_media_url')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                    </div>

                </div>

                <!-- ACTION -->

                <div class="form-card mt-4">

                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                        <div>

                            <h5 class="mb-1 fw-bold">

                                Simpan Data Pemain

                            </h5>

                            <small class="text-muted">

                                Pastikan seluruh data yang bertanda (*) telah diisi.

                            </small>

                        </div>

                        <div class="d-flex gap-2">

                            <a href="{{ route('admin.players.index') }}"
                               class="btn btn-light btn-cancel">

                                Batal

                            </a>

                            <button
                                type="submit"
                                class="btn btn-save">

                                <i class="bi bi-check-circle-fill me-2"></i>

                                SIMPAN PEMAIN

                            </button>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </form>

</div>

<style>

.player-header{

    margin-bottom:40px;

}

.page-label{

    display:block;

    color:#EA580C;

    font-size:11px;

    font-weight:800;

    letter-spacing:.45em;

    margin-bottom:14px;

}

.page-heading{

    margin:0;

    font-size:58px;

    font-weight:900;

    font-style:italic;

    letter-spacing:-2px;

    color:#0F172A;

}

.page-heading span{

    color:#EA580C;

}

.form-card{

    background:#fff;

    border-radius:28px;

    padding:30px;

    box-shadow:0 20px 45px rgba(15,23,42,.05);

}

.card-title{

    font-size:13px;

    text-transform:uppercase;

    font-weight:800;

    letter-spacing:.15em;

    color:#EA580C;

}

.photo-wrapper{

    display:flex;

    justify-content:center;

    align-items:center;

    margin-top:25px;

}

.player-preview{

    width:220px;

    height:220px;

    border-radius:50%;

    object-fit:cover;

    border:8px solid #F8FAFC;

    background:#EEF2F7;

}

.form-label{

    font-weight:700;

    color:#0F172A;

    margin-bottom:8px;

}

.form-label span{

    color:#EA580C;

}

.form-control,

.form-select{

    height:56px;

    border-radius:16px;

    border:1px solid #E2E8F0;

    font-weight:600;

    box-shadow:none!important;

}

.form-control:focus,

.form-select:focus{

    border-color:#EA580C;

    box-shadow:0 0 0 .18rem rgba(234,88,12,.15)!important;

}

.input-group-text{

    border-radius:0 16px 16px 0;

    border:1px solid #E2E8F0;

    background:#F8FAFC;

    font-weight:700;

}

.btn-save{

    background:#EA580C;

    color:#fff;

    padding:14px 28px;

    border-radius:16px;

    font-weight:800;

    letter-spacing:.06em;

    transition:.3s;

}

.btn-save:hover{

    background:#C2410C;

    color:#fff;

    transform:translateY(-2px);

}

.btn-back{

    background:#fff;

    border:1px solid #E2E8F0;

    padding:14px 26px;

    border-radius:16px;

    font-weight:800;

    color:#0F172A;

}

.btn-back:hover{

    background:#0F172A;

    color:#fff;

}

.btn-cancel{

    border-radius:16px;

    padding:14px 24px;

    font-weight:700;

}

.alert{

    border-radius:18px;

}

@media(max-width:992px){

    .page-heading{

        font-size:42px;

    }

    .player-preview{

        width:180px;

        height:180px;

    }

}

@media(max-width:768px){

    .page-heading{

        font-size:32px;

    }

    .form-card{

        padding:22px;

        border-radius:22px;

    }

    .player-preview{

        width:150px;

        height:150px;

    }

    .btn-save,

    .btn-cancel,

    .btn-back{

        width:100%;

    }

    .d-flex.gap-2{

        width:100%;

        flex-direction:column;

    }

}

</style>

<script>

const photoInput=document.getElementById('photo');

const preview=document.getElementById('previewImage');

photoInput.addEventListener('change',function(e){

    const file=e.target.files[0];

    if(!file) return;

    preview.src=URL.createObjectURL(file);

});

</script>

@endsection
