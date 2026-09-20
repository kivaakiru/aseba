@extends('admin.layouts.admin')

@section('title', 'Edit Album')
@section('page-title', 'Edit Album')
@section('page-subtitle', 'Perbarui informasi album gallery ASEBA')

@section('content')

<style>
    .gallery-edit-page {
        max-width: 1000px;
        margin: 0 auto;
    }

    .gallery-heading {
        margin-bottom: 28px;
    }

    .gallery-label {
        display: block;
        margin-bottom: 8px;
        color: #ea580c;
        font-size: 13px;
        font-weight: 800;
        letter-spacing: .3em;
        text-transform: uppercase;
    }

    .gallery-title {
        margin: 0;
        color: #0f172a;
        font-size: 35px;
        line-height: 1;
        font-weight: 900;
        font-style: italic;
        text-transform: uppercase;
        letter-spacing: -1.4px;
    }

    .gallery-title span {
        color: #ea580c;
    }

    .gallery-subtitle {
        margin: 11px 0 0;
        color: #64748b;
        font-size: 15px;
    }

    .gallery-card {
        overflow: hidden;
        border: 1px solid #e2e8f0;
        border-radius: 15px;
        background: #fff;
        box-shadow: 0 7px 25px rgba(15,23,42,.045);
    }

    .gallery-card-body {
        padding: 30px;
    }

    .section-title {
        display: flex;
        align-items: center;
        gap: 11px;
        margin-bottom: 20px;
    }

    .section-icon {
        width: 38px;
        height: 38px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        background: #fff1e8;
        color: #ea580c;
    }

    .section-title h3 {
        margin: 0;
        color: #0f172a;
        font-size: 18px;
        font-weight: 800;
    }

    .section-title p {
        margin: 3px 0 0;
        color: #94a3b8;
        font-size: 14px;
    }

    .gallery-label-form {
        display: block;
        margin-bottom: 8px;
        color: #334155;
        font-size: 14px;
        font-weight: 700;
    }

    .required {
        color: #ea580c;
    }

    .gallery-input,
    .gallery-textarea {
        width: 100%;
        border: 1px solid #dbe2ea;
        border-radius: 9px;
        background: #fff;
        color: #0f172a;
        font-size: 15px;
        outline: none;
        transition: .2s ease;
    }

    .gallery-input {
        height: 45px;
        padding: 0 13px;
    }

    .gallery-textarea {
        min-height: 130px;
        padding: 12px 13px;
        resize: vertical;
    }

    .gallery-input:focus,
    .gallery-textarea:focus {
        border-color: #ea580c;
        box-shadow: 0 0 0 3px rgba(234,88,12,.08);
    }

    .gallery-help {
        display: block;
        margin-top: 6px;
        color: #94a3b8;
        font-size: 13px;
    }

    .gallery-info {
        margin-top: 25px;
        padding: 15px;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        background: #f8fafc;
        color: #64748b;
        font-size: 14px;
        line-height: 1.6;
    }

    .gallery-info strong {
        color: #334155;
    }

    .gallery-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        padding: 17px 30px;
        border-top: 1px solid #edf1f5;
        background: #fafbfc;
    }

    .btn-gallery {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        min-height: 46px;
        padding: 0 17px;
        border-radius: 9px;
        font-size: 14px;
        font-weight: 800;
        text-decoration: none;
        text-transform: uppercase;
        transition: .2s ease;
    }

    .btn-back {
        border: 1px solid #dbe2ea;
        background: #fff;
        color: #475569;
    }

    .btn-back:hover {
        background: #f8fafc;
        color: #0f172a;
    }

    .btn-save {
        border: 0;
        background: #ea580c;
        color: #fff;
        cursor: pointer;
        box-shadow: 0 6px 15px rgba(234,88,12,.17);
    }

    .btn-save:hover {
        background: #c2410c;
    }

    @media(max-width:600px) {

        .gallery-card-body {
            padding: 22px;
        }

        .gallery-footer {
            padding: 16px 22px;
            flex-direction: column-reverse;
            align-items: stretch;
        }

        .btn-gallery {
            width: 100%;
        }

        .gallery-title {
            font-size: 28px;
        }
    }
</style>


<div class="container-fluid">

    <div class="gallery-edit-page">


        <div class="gallery-heading">

            <span class="gallery-label">
                Gallery Management
            </span>

            <h1 class="gallery-title">
                Edit <span>Album.</span>
            </h1>

            <p class="gallery-subtitle">
                Perbarui informasi album <strong>{{ $album->name }}</strong>.
            </p>

        </div>


        @if($errors->any())

            <div class="alert alert-danger border-0 shadow-sm small">

                <strong>Periksa kembali data.</strong>

                <ul class="mb-0 mt-2">

                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                </ul>

            </div>

        @endif


        <div class="gallery-card">

            <form
                method="POST"
                action="{{ route('admin.gallery.update', $album->id) }}"
            >

                @csrf
                @method('PUT')


                <div class="gallery-card-body">

                    <div class="section-title">

                        <div class="section-icon">
                            <i class="bi bi-folder2-open"></i>
                        </div>

                        <div>

                            <h3>
                                Informasi Album
                            </h3>

                            <p>
                                Ubah informasi dasar album.
                            </p>

                        </div>

                    </div>


                    <div class="row g-3">

                        <div class="col-md-8">

                            <label
                                for="name"
                                class="gallery-label-form"
                            >
                                Nama Album
                                <span class="required">*</span>
                            </label>

                            <input
                                type="text"
                                id="name"
                                name="name"
                                value="{{ old('name', $album->name) }}"
                                class="gallery-input @error('name') is-invalid @enderror"
                                maxlength="150"
                                required
                            >

                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        <div class="col-md-4">

                            <label
                                for="album_date"
                                class="gallery-label-form"
                            >
                                Tanggal Kegiatan
                            </label>

                            <input
                                type="date"
                                id="album_date"
                                name="album_date"
                                value="{{ old('album_date', $album->album_date) }}"
                                class="gallery-input @error('album_date') is-invalid @enderror"
                            >

                            @error('album_date')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        <div class="col-12">

                            <label
                                for="description"
                                class="gallery-label-form"
                            >
                                Deskripsi Album
                            </label>

                            <textarea
                                id="description"
                                name="description"
                                class="gallery-textarea @error('description') is-invalid @enderror"
                                maxlength="1000"
                            >{{ old('description', $album->description) }}</textarea>

                            @error('description')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                    </div>


                    <div class="gallery-info">

                        <i class="bi bi-info-circle me-1"></i>

                        <strong>
                            Informasi foto:
                        </strong>

                        Foto di dalam album tidak diubah dari halaman ini.
                        Gunakan halaman album untuk menambahkan atau menghapus foto.
                        Foto terbaru akan otomatis menjadi tampilan utama album.

                    </div>

                </div>


                <div class="gallery-footer">

                    <a
                        href="{{ route('admin.gallery.show', $album->id) }}"
                        class="btn-gallery btn-back"
                    >
                        <i class="bi bi-arrow-left"></i>
                        Batal
                    </a>


                    <button
                        type="submit"
                        class="btn-gallery btn-save"
                    >
                        <i class="bi bi-check-lg"></i>
                        Simpan Perubahan
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection