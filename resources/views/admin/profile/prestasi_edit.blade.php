@extends('admin.layouts.admin')

@section('title', 'Achievements')

@section('content')

<style>
    .achievement-page {
        padding: 10px 0 35px;
    }

    /* =========================
       HEADER
    ========================= */
    .achievement-heading {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 28px;
    }

    .achievement-eyebrow {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #EA580C;
        font-size: 13px;
        font-weight: 700;
        letter-spacing: .08em;
        text-transform: uppercase;
        margin-bottom: 8px;
    }

    .achievement-heading h1 {
        margin: 0;
        color: #0F172A;
        font-size: 30px;
        font-weight: 800;
    }

    .achievement-heading p {
        margin: 8px 0 0;
        color: #64748B;
        font-size: 14px;
    }

    .achievement-back {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        color: #64748B;
        font-size: 13px;
        font-weight: 700;
        text-decoration: none;
        white-space: nowrap;
    }

    .achievement-back:hover {
        color: #EA580C;
    }

    /* =========================
       FORM
    ========================= */
    .achievement-form-card {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 16px;
        padding: 25px;
        margin-bottom: 30px;
        box-shadow: 0 3px 12px rgba(15, 23, 42, .035);
    }

    .achievement-form-header {
        display: flex;
        align-items: center;
        gap: 12px;
        padding-bottom: 18px;
        margin-bottom: 22px;
        border-bottom: 1px solid #F1F5F9;
    }

    .achievement-form-icon {
        width: 42px;
        height: 42px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 11px;
        background: #FFF7ED;
        color: #EA580C;
        font-size: 19px;
    }

    .achievement-form-header h2 {
        margin: 0;
        color: #0F172A;
        font-size: 17px;
        font-weight: 800;
    }

    .achievement-form-header p {
        margin: 3px 0 0;
        color: #94A3B8;
        font-size: 12px;
    }

    .achievement-label {
        display: block;
        margin-bottom: 7px;
        color: #334155;
        font-size: 13px;
        font-weight: 700;
    }

    .achievement-label .required {
        color: #EA580C;
    }

    .achievement-input,
    .achievement-textarea {
        width: 100%;
        border: 1px solid #CBD5E1;
        border-radius: 9px;
        background: #FFFFFF;
        color: #0F172A;
        font-size: 14px;
        padding: 10px 12px;
        outline: none;
        transition: all .2s ease;
    }

    .achievement-input {
        min-height: 43px;
    }

    .achievement-textarea {
        min-height: 105px;
        resize: vertical;
    }

    .achievement-input:focus,
    .achievement-textarea:focus {
        border-color: #EA580C;
        box-shadow: 0 0 0 3px rgba(234, 88, 12, .08);
    }

    .achievement-help {
        display: block;
        margin-top: 6px;
        color: #94A3B8;
        font-size: 11px;
        line-height: 1.5;
    }

    .achievement-photo-input {
        padding: 8px 10px;
    }

    .achievement-submit {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        min-height: 43px;
        padding: 0 18px;
        border: 0;
        border-radius: 9px;
        background: #EA580C;
        color: #FFFFFF;
        font-size: 13px;
        font-weight: 700;
    }

    .achievement-submit:hover {
        background: #C2410C;
    }

    /* =========================
       LIST HEADER
    ========================= */
    .achievement-list-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        margin-bottom: 15px;
    }

    .achievement-list-header h2 {
        margin: 0;
        color: #0F172A;
        font-size: 18px;
        font-weight: 800;
    }

    .achievement-count {
        padding: 6px 10px;
        border-radius: 7px;
        background: #F8FAFC;
        color: #64748B;
        font-size: 12px;
        font-weight: 700;
    }

    /* =========================
       ACHIEVEMENT CARD
    ========================= */
    .achievement-card {
        height: 100%;
        overflow: hidden;
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 15px;
        box-shadow: 0 3px 12px rgba(15, 23, 42, .035);
        transition: all .2s ease;
    }

    .achievement-card:hover {
        transform: translateY(-2px);
        border-color: #CBD5E1;
        box-shadow: 0 10px 24px rgba(15, 23, 42, .065);
    }

    .achievement-image-wrap {
        position: relative;
        height: 185px;
        overflow: hidden;
        background: #F1F5F9;
    }

    .achievement-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .achievement-image-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #0F172A;
        color: #FB923C;
        font-size: 42px;
    }

    .achievement-year {
        position: absolute;
        top: 12px;
        right: 12px;
        padding: 6px 9px;
        border-radius: 7px;
        background: rgba(15, 23, 42, .9);
        color: #FFFFFF;
        font-size: 11px;
        font-weight: 800;
    }

    .achievement-card-body {
        padding: 19px;
    }

    .achievement-title {
        margin: 0 0 7px;
        color: #0F172A;
        font-size: 16px;
        font-weight: 800;
        line-height: 1.4;
    }

    .achievement-description {
        margin: 0;
        color: #64748B;
        font-size: 13px;
        line-height: 1.6;
    }

    .achievement-card-footer {
        display: flex;
        align-items: center;
        gap: 7px;
        margin-top: 17px;
        padding-top: 14px;
        border-top: 1px solid #F1F5F9;
    }

    .achievement-action {
        flex: 1;
        min-height: 35px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        border: 1px solid #E2E8F0;
        border-radius: 8px;
        background: #FFFFFF;
        color: #64748B;
        font-size: 11px;
        font-weight: 700;
        text-decoration: none;
    }

    .achievement-action:hover {
        background: #F8FAFC;
        color: #0F172A;
    }

    .achievement-action.delete:hover {
        background: #FEF2F2;
        border-color: #FECACA;
        color: #DC2626;
    }

    /* =========================
       EMPTY
    ========================= */
    .achievement-empty {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 16px;
        text-align: center;
        padding: 65px 20px;
    }

    .achievement-empty-icon {
        width: 64px;
        height: 64px;
        margin: 0 auto 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 16px;
        background: #FFF7ED;
        color: #EA580C;
        font-size: 27px;
    }

    .achievement-empty h3 {
        margin: 0 0 7px;
        color: #0F172A;
        font-size: 18px;
        font-weight: 800;
    }

    .achievement-empty p {
        max-width: 440px;
        margin: 0 auto;
        color: #94A3B8;
        font-size: 13px;
        line-height: 1.6;
    }

    .achievement-alert {
        border: 0;
        border-radius: 10px;
        font-size: 13px;
    }

    /* =========================
       MOBILE
    ========================= */
    @media (max-width: 767.98px) {

        .achievement-heading {
            align-items: flex-start;
            flex-direction: column;
        }

        .achievement-heading h1 {
            font-size: 27px;
        }

        .achievement-back {
            width: 100%;
            min-height: 40px;
            justify-content: center;
            border: 1px solid #E2E8F0;
            border-radius: 9px;
        }

        .achievement-form-card {
            padding: 19px;
        }

        .achievement-submit {
            width: 100%;
        }

        .achievement-list-header {
            align-items: flex-start;
            flex-direction: column;
        }
    }
</style>


<div class="achievement-page">

    {{-- =========================
         HEADER
    ========================= --}}
    <div class="achievement-heading">

        <div>

            <div class="achievement-eyebrow">
                <i class="bi bi-trophy-fill"></i>
                Profile ASEBA
            </div>

            <h1>Achievements</h1>

            <p>
                Kelola pencapaian dan prestasi ASEBA yang akan
                ditampilkan pada halaman profile klub.
            </p>

        </div>

        <a href="{{ route('admin.aseba.profile') }}"
           class="achievement-back">

            <i class="bi bi-arrow-left"></i>

            Kembali ke Profile

        </a>

    </div>


    {{-- =========================
         SUCCESS
    ========================= --}}
    @if(session('success'))

        <div class="alert alert-success achievement-alert mb-4">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
        </div>

    @endif


    {{-- =========================
         VALIDATION
    ========================= --}}
    @if($errors->any())

        <div class="alert alert-danger achievement-alert mb-4">

            <strong>
                Terdapat kesalahan:
            </strong>

            <ul class="mb-0 mt-2">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- =========================
         ADD FORM
    ========================= --}}
    <div class="achievement-form-card">

        <div class="achievement-form-header">

            <div class="achievement-form-icon">
                <i class="bi bi-trophy-fill"></i>
            </div>

            <div>

                <h2>Tambah Achievement</h2>

                <p>
                    Tambahkan pencapaian baru ASEBA.
                </p>

            </div>

        </div>


        <form action="{{ route('admin.aseba.profile.achievements.store') }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf

            <div class="row g-3">

                {{-- TITLE --}}
                <div class="col-md-8">

                    <label class="achievement-label">
                        Nama Achievement
                        <span class="required">*</span>
                    </label>

                    <input type="text"
                           name="title"
                           class="achievement-input"
                           value="{{ old('title') }}"
                           placeholder="Contoh: Juara 1 Liga Basket Kota Cilegon"
                           required>

                </div>

                {{-- ACHIEVEMENT --}}
                <div class="achievement-form-group">

                    <label class="achievement-label">
                        Kompetisi / Kejuaraan
                        <span class="text-danger">*</span>
                    </label>

                    <input type="text"
                        name="competition"
                        class="achievement-input"
                        value="{{ old('competition', $achievement->competition ?? '') }}"
                        placeholder="Contoh: Yamaha 3X3"
                        maxlength="255"
                        required>

                    @error('competition')
                        <div class="achievement-invalid">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- YEAR --}}
                <div class="col-md-4">

                    <label class="achievement-label">
                        Tahun
                        <span class="required">*</span>
                    </label>

                    <input type="number"
                           name="year"
                           class="achievement-input"
                           value="{{ old('year') }}"
                           min="1900"
                           max="2100"
                           placeholder="2026"
                           required>

                </div>


                {{-- PHOTO --}}
                <div class="col-12">

                    <label class="achievement-label">
                        Foto / Dokumentasi
                    </label>

                    <input type="file"
                           name="photo"
                           class="achievement-input achievement-photo-input"
                           accept=".jpg,.jpeg,.png,.webp">

                    <span class="achievement-help">
                        Maksimal 5 MB. Format JPG, JPEG, PNG atau WEBP.
                    </span>

                </div>


                {{-- DESCRIPTION --}}
                <div class="col-12">

                    <label class="achievement-label">
                        Deskripsi
                    </label>

                    <textarea name="description"
                              class="achievement-textarea"
                              placeholder="Tuliskan informasi singkat mengenai pencapaian ini...">{{ old('description') }}</textarea>

                </div>


                {{-- BUTTON --}}
                <div class="col-12">

                    <button type="submit"
                            class="achievement-submit">

                        <i class="bi bi-plus-lg"></i>

                        Tambahkan Achievement

                    </button>

                </div>

            </div>

        </form>

    </div>


    {{-- =========================
         LIST
    ========================= --}}
    <div class="achievement-list-header">

        <h2>Daftar Achievement</h2>

        <div class="achievement-count">

            {{ $achievements->count() }} Achievements

        </div>

    </div>


    @if($achievements->count())

        <div class="row g-3">

            @foreach($achievements as $achievement)

                <div class="col-xl-4 col-md-6">

                    <div class="achievement-card">

                        {{-- IMAGE --}}
                        <div class="achievement-image-wrap">

                            @if($achievement->photo)

                                <img src="{{ asset('storage/' . $achievement->photo) }}"
                                     alt="{{ $achievement->title }}"
                                     class="achievement-image">

                            @else

                                <div class="achievement-image-placeholder">

                                    <i class="bi bi-trophy-fill"></i>

                                </div>

                            @endif


                            <div class="achievement-year">

                                {{ $achievement->year }}

                            </div>

                        </div>


                        {{-- BODY --}}
                        <div class="achievement-card-body">

                            <h3 class="achievement-title">
                                {{ $achievement->title }}
                            </h3>

                            @if($achievement->description)

                                <p class="achievement-description">
                                    {{ $achievement->description }}
                                </p>

                            @endif


                            <div class="achievement-card-footer">

                                <a href="{{ route('admin.aseba.profile.achievements.edit', $achievement->id) }}"
                                   class="achievement-action">

                                    <i class="bi bi-pencil-fill"></i>

                                    Edit

                                </a>


                                <form action="{{ route('admin.aseba.profile.achievements.destroy', $achievement->id) }}"
                                      method="POST"
                                      style="flex:1;"
                                      onsubmit="return confirm('Yakin ingin menghapus achievement ini?')">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="achievement-action delete w-100">

                                        <i class="bi bi-trash-fill"></i>

                                        Hapus

                                    </button>

                                </form>

                            </div>

                        </div>

                    </div>

                </div>

            @endforeach

        </div>

    @else

        <div class="achievement-empty">

            <div class="achievement-empty-icon">
                <i class="bi bi-trophy-fill"></i>
            </div>

            <h3>Belum Ada Achievement</h3>

            <p>
                Belum ada pencapaian yang ditambahkan.
                Tambahkan achievement pertama untuk mulai menampilkan
                prestasi ASEBA pada halaman profile.
            </p>

        </div>

    @endif

</div>

@endsection