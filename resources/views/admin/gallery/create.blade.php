@extends('admin.layouts.admin')

@section('title', 'Buat Album Gallery')
@section('page-title', 'Buat Album')
@section('page-subtitle', 'Buat album baru untuk menyimpan dokumentasi ASEBA Basketball Club')

@section('content')

<style>
    .gallery-create-page {
        max-width: 1100px;
        margin: 0 auto;
    }

    .gallery-heading {
        margin-bottom: 28px;
    }

    .gallery-heading-label {
        display: block;
        margin-bottom: 8px;
        color: #ea580c;
        font-size: 13px;
        font-weight: 800;
        letter-spacing: .28em;
        text-transform: uppercase;
    }

    .gallery-heading h1 {
        margin: 0;
        color: #0f172a;
        font-size: 36px;
        line-height: 1;
        font-weight: 900;
        font-style: italic;
        text-transform: uppercase;
        letter-spacing: -1.5px;
    }

    .gallery-heading h1 span {
        color: #ea580c;
    }

    .gallery-heading p {
        margin: 12px 0 0;
        color: #64748b;
        font-size: 15px;
        line-height: 1.6;
    }

    .gallery-form-card {
        overflow: hidden;
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 16px;
        box-shadow: 0 8px 28px rgba(15, 23, 42, .05);
    }

    .gallery-form-body {
        padding: 30px;
    }

    .form-section {
        margin-bottom: 30px;
    }

    .form-section:last-child {
        margin-bottom: 0;
    }

    .form-section-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 20px;
    }

    .form-section-icon {
        width: 38px;
        height: 38px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        border-radius: 10px;
        background: #fff1e8;
        color: #ea580c;
        font-size: 17px;
    }

    .form-section-header h3 {
        margin: 0;
        color: #0f172a;
        font-size: 18px;
        font-weight: 800;
    }

    .form-section-header p {
        margin: 3px 0 0;
        color: #94a3b8;
        font-size: 14px;
    }

    .gallery-label {
        display: block;
        margin-bottom: 8px;
        color: #334155;
        font-size: 14px;
        font-weight: 700;
    }

    .gallery-required {
        color: #ea580c;
    }

    .gallery-input,
    .gallery-textarea {
        width: 100%;
        border: 1px solid #dbe2ea;
        border-radius: 10px;
        background: #fff;
        color: #0f172a;
        font-size: 15px;
        outline: none;
        transition: .2s ease;
    }

    .gallery-input {
        height: 46px;
        padding: 0 14px;
    }

    .gallery-textarea {
        min-height: 130px;
        padding: 13px 14px;
        resize: vertical;
    }

    .gallery-input:focus,
    .gallery-textarea:focus {
        border-color: #ea580c;
        box-shadow: 0 0 0 3px rgba(234, 88, 12, .08);
    }

    .gallery-help {
        display: block;
        margin-top: 7px;
        color: #94a3b8;
        font-size: 13px;
        line-height: 1.5;
    }

    .gallery-info {
        display: flex;
        gap: 12px;
        padding: 16px;
        border: 1px solid #fed7aa;
        border-radius: 11px;
        background: #fff7ed;
        color: #9a3412;
    }

    .gallery-info i {
        font-size: 17px;
        flex-shrink: 0;
    }

    .gallery-info strong {
        display: block;
        margin-bottom: 3px;
        font-size: 14px;
    }

    .gallery-info p {
        margin: 0;
        font-size: 14px;
        line-height: 1.6;
    }

    .gallery-form-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        padding: 18px 30px;
        border-top: 1px solid #eef2f7;
        background: #fafbfc;
    }

    .gallery-back-btn,
    .gallery-save-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        min-height: 46px;
        padding: 0 20px;
        border-radius: 9px;
        font-size: 14px;
        font-weight: 800;
        text-decoration: none;
        text-transform: uppercase;
        transition: .2s ease;
    }

    .gallery-back-btn {
        border: 1px solid #dbe2ea;
        background: #fff;
        color: #475569;
    }

    .gallery-back-btn:hover {
        background: #f8fafc;
        color: #0f172a;
    }

    .gallery-save-btn {
        border: 0;
        background: #ea580c;
        color: #fff;
        cursor: pointer;
        box-shadow: 0 6px 16px rgba(234, 88, 12, .18);
    }

    .gallery-save-btn:hover {
        background: #c2410c;
        transform: translateY(-1px);
    }

    .invalid-feedback {
        display: block;
        margin-top: 6px;
        font-size: 13px;
    }

    @media (max-width: 768px) {

        .gallery-create-page {
            max-width: none;
        }

        .gallery-form-body {
            padding: 22px;
        }

        .gallery-form-footer {
            padding: 16px 22px;
        }

        .gallery-heading h1 {
            font-size: 30px;
        }
    }

    @media (max-width: 576px) {

        .gallery-form-footer {
            flex-direction: column-reverse;
            align-items: stretch;
        }

        .gallery-back-btn,
        .gallery-save-btn {
            width: 100%;
        }

        .gallery-heading h1 {
            font-size: 27px;
        }
    }
</style>

<div class="container-fluid">

    <div class="gallery-create-page">

        <div class="gallery-heading">

            <span class="gallery-heading-label">
                Gallery Management
            </span>

            <h1>
                Buat <span>Album.</span>
            </h1>

            <p>
                Buat album baru untuk mengelompokkan dokumentasi kegiatan ASEBA.
            </p>

        </div>


        @if($errors->any())

            <div class="alert alert-danger border-0 shadow-sm mb-4">

                <strong>Periksa kembali data yang dimasukkan.</strong>

                <ul class="mb-0 mt-2">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>

            </div>

        @endif


        <div class="gallery-form-card">

            <form
                method="POST"
                action="{{ route('admin.gallery.store') }}"
            >

                @csrf


                <div class="gallery-form-body">

                    {{-- INFORMASI ALBUM --}}
                    <div class="form-section">

                        <div class="form-section-header">

                            <div class="form-section-icon">
                                <i class="bi bi-folder2-open"></i>
                            </div>

                            <div>
                                <h3>Informasi Album</h3>

                                <p>
                                    Informasi dasar yang akan ditampilkan pada album.
                                </p>
                            </div>

                        </div>


                        <div class="row g-3">

                            <div class="col-md-8">

                                <label
                                    for="name"
                                    class="gallery-label"
                                >
                                    Nama Album
                                    <span class="gallery-required">*</span>
                                </label>

                                <input
                                    type="text"
                                    id="name"
                                    name="name"
                                    value="{{ old('name') }}"
                                    class="gallery-input @error('name') is-invalid @enderror"
                                    placeholder="Contoh: Latihan ASEBA Agustus 2026"
                                    maxlength="150"
                                    required
                                >

                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                                <small class="gallery-help">
                                    Gunakan nama yang mudah dikenali.
                                </small>

                            </div>


                            <div class="col-md-4">

                                <label
                                    for="album_date"
                                    class="gallery-label"
                                >
                                    Tanggal Kegiatan
                                </label>

                                <input
                                    type="date"
                                    id="album_date"
                                    name="album_date"
                                    value="{{ old('album_date') }}"
                                    class="gallery-input @error('album_date') is-invalid @enderror"
                                >

                                @error('album_date')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                                <small class="gallery-help">
                                    Opsional.
                                </small>

                            </div>


                            <div class="col-12">

                                <label
                                    for="description"
                                    class="gallery-label"
                                >
                                    Deskripsi Album
                                </label>

                                <textarea
                                    id="description"
                                    name="description"
                                    class="gallery-textarea @error('description') is-invalid @enderror"
                                    placeholder="Tuliskan deskripsi singkat mengenai album ini..."
                                    maxlength="1000"
                                >{{ old('description') }}</textarea>

                                @error('description')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                                <small class="gallery-help">
                                    Deskripsi bersifat opsional.
                                </small>

                            </div>

                        </div>

                    </div>


                    {{-- SISTEM FOTO --}}
                    <div class="form-section">

                        <div class="form-section-header">

                            <div class="form-section-icon">
                                <i class="bi bi-images"></i>
                            </div>

                            <div>
                                <h3>Dokumentasi Foto</h3>

                                <p>
                                    Foto akan ditambahkan setelah album dibuat.
                                </p>
                            </div>

                        </div>


                        <div class="gallery-info">

                            <i class="bi bi-info-circle-fill"></i>

                            <div>

                                <strong>
                                    Cara kerja Gallery ASEBA
                                </strong>

                                <p>
                                    Setelah album dibuat, Anda akan masuk ke halaman
                                    album untuk mengunggah foto. Foto yang paling baru
                                    diunggah akan otomatis digunakan sebagai tampilan
                                    utama album.
                                </p>

                            </div>

                        </div>

                    </div>

                </div>


                <div class="gallery-form-footer">

                    <a
                        href="{{ route('admin.gallery.index') }}"
                        class="gallery-back-btn"
                    >
                        <i class="bi bi-arrow-left"></i>
                        Kembali
                    </a>


                    <button
                        type="submit"
                        class="gallery-save-btn"
                    >
                        <i class="bi bi-folder-plus"></i>
                        Buat Album
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection