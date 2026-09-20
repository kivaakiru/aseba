@extends('admin.layouts.admin')

@section('title', $album->name)
@section('page-title', 'Gallery Album')
@section('page-subtitle', $album->name)

@section('content')

<style>
    .gallery-show-page {
        width: 100%;
    }

    .gallery-back {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        margin-bottom: 18px;
        color: #64748b;
        font-size: 14px;
        font-weight: 700;
        text-decoration: none;
    }

    .gallery-back:hover {
        color: #ea580c;
    }

    .album-detail-header {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        gap: 25px;
        margin-bottom: 25px;
    }

    .album-detail-label {
        display: block;
        margin-bottom: 8px;
        color: #ea580c;
        font-size: 13px;
        font-weight: 800;
        letter-spacing: .28em;
        text-transform: uppercase;
    }

    .album-detail-title {
        margin: 0;
        color: #0f172a;
        font-size: 35px;
        line-height: 1.05;
        font-weight: 900;
        font-style: italic;
        text-transform: uppercase;
        letter-spacing: -1.3px;
    }

    .album-detail-meta {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 14px;
        margin-top: 10px;
        color: #64748b;
        font-size: 14px;
    }

    .album-detail-meta span {
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .album-detail-meta i {
        color: #ea580c;
    }

    .album-description {
        max-width: 700px;
        margin: 12px 0 0;
        color: #64748b;
        font-size: 14px;
        line-height: 1.6;
    }

    .album-actions {
        display: flex;
        align-items: center;
        gap: 9px;
        flex-shrink: 0;
    }

    .album-action-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        min-height: 44px;
        padding: 0 15px;
        border-radius: 9px;
        font-size: 14px;
        font-weight: 800;
        text-decoration: none;
        text-transform: uppercase;
        transition: .2s ease;
    }

    .album-action-secondary {
        border: 1px solid #dbe2ea;
        background: #fff;
        color: #475569;
    }

    .album-action-secondary:hover {
        background: #f8fafc;
        color: #0f172a;
    }

    .album-action-primary {
        border: 0;
        background: #ea580c;
        color: #fff;
        cursor: pointer;
        box-shadow: 0 6px 16px rgba(234,88,12,.16);
    }

    .album-action-primary:hover {
        background: #c2410c;
    }

    .upload-card {
        display: none;
        margin-bottom: 25px;
        padding: 20px;
        border: 1px solid #e2e8f0;
        border-radius: 13px;
        background: #fff;
        box-shadow: 0 5px 18px rgba(15,23,42,.04);
    }

    .upload-card.active {
        display: block;
    }

    .upload-title {
        margin-bottom: 14px;
        color: #0f172a;
        font-size: 16px;
        font-weight: 800;
    }

    .upload-drop {
        position: relative;
        padding: 28px;
        border: 1px dashed #cbd5e1;
        border-radius: 11px;
        background: #f8fafc;
        text-align: center;
        transition: .2s ease;
    }

    .upload-drop:hover {
        border-color: #ea580c;
        background: #fff7ed;
    }

    .upload-drop i {
        display: block;
        margin-bottom: 8px;
        color: #ea580c;
        font-size: 30px;
    }

    .upload-drop strong {
        display: block;
        margin-bottom: 5px;
        color: #0f172a;
        font-size: 15px;
    }

    .upload-drop span {
        display: block;
        margin-bottom: 15px;
        color: #94a3b8;
        font-size: 13px;
    }

    .upload-input {
        display: block;
        width: 100%;
        font-size: 14px;
    }

    .upload-submit {
        margin-top: 14px;
        padding: 10px 17px;
        border: 0;
        border-radius: 8px;
        background: #ea580c;
        color: #fff;
        font-size: 14px;
        font-weight: 800;
        cursor: pointer;
    }

    .photo-masonry {
        columns: 4 220px;
        column-gap: 14px;
    }

    .photo-item {
        position: relative;
        display: inline-block;
        width: 100%;
        margin: 0 0 14px;
        overflow: hidden;
        break-inside: avoid;
        border-radius: 11px;
        background: #e2e8f0;
    }

    .photo-item img {
        display: block;
        width: 100%;
        height: auto;
        transition: transform .35s ease;
    }

    .photo-item:hover img {
        transform: scale(1.025);
    }

    .photo-overlay {
        position: absolute;
        inset: 0;
        display: flex;
        align-items: flex-end;
        justify-content: flex-end;
        padding: 11px;
        opacity: 0;
        background: linear-gradient(
            to top,
            rgba(2,6,23,.65),
            transparent 45%
        );
        transition: .2s ease;
    }

    .photo-item:hover .photo-overlay {
        opacity: 1;
    }

    .photo-delete {
        width: 34px;
        height: 34px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid rgba(255,255,255,.3);
        border-radius: 8px;
        background: rgba(15,23,42,.75);
        color: #fff;
        cursor: pointer;
    }

    .photo-delete:hover {
        background: #dc2626;
    }

    .photo-date {
        position: absolute;
        left: 10px;
        bottom: 10px;
        padding: 5px 8px;
        border-radius: 6px;
        background: rgba(15,23,42,.72);
        color: #fff;
        font-size: 11px;
        opacity: 0;
        transition: .2s ease;
    }

    .photo-item:hover .photo-date {
        opacity: 1;
    }

    .gallery-empty {
        padding: 75px 20px;
        border: 1px dashed #cbd5e1;
        border-radius: 14px;
        background: #fff;
        text-align: center;
    }

    .gallery-empty-icon {
        width: 65px;
        height: 65px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 15px;
        border-radius: 50%;
        background: #fff7ed;
        color: #ea580c;
        font-size: 27px;
    }

    .gallery-empty h3 {
        margin: 0 0 7px;
        color: #0f172a;
        font-size: 17px;
        font-weight: 800;
    }

    .gallery-empty p {
        max-width: 450px;
        margin: 0 auto 18px;
        color: #64748b;
        font-size: 14px;
        line-height: 1.6;
    }

    @media (max-width: 900px) {

        .album-detail-header {
            align-items: flex-start;
            flex-direction: column;
        }

        .album-actions {
            width: 100%;
        }

        .album-action-btn {
            flex: 1;
        }

        .photo-masonry {
            columns: 3 180px;
        }
    }

    @media (max-width: 600px) {

        .album-detail-title {
            font-size: 28px;
        }

        .album-actions {
            flex-direction: column;
        }

        .album-action-btn {
            width: 100%;
        }

        .photo-masonry {
            columns: 2 140px;
            column-gap: 9px;
        }

        .photo-item {
            margin-bottom: 9px;
            border-radius: 8px;
        }
    }
</style>


<div class="container-fluid">

    <div class="gallery-show-page">


        <a
            href="{{ route('admin.gallery.index') }}"
            class="gallery-back"
        >
            <i class="bi bi-arrow-left"></i>
            Kembali ke Gallery
        </a>


        {{-- HEADER --}}
        <div class="album-detail-header">

            <div>

                <span class="album-detail-label">
                    Gallery Album
                </span>

                <h1 class="album-detail-title">
                    {{ $album->name }}
                </h1>


                <div class="album-detail-meta">

                    <span>
                        <i class="bi bi-images"></i>
                        {{ $album->photos->count() }} Foto
                    </span>


                    @if($album->album_date)

                        <span>
                            <i class="bi bi-calendar3"></i>

                            {{ \Carbon\Carbon::parse($album->album_date)->translatedFormat('d F Y') }}

                        </span>

                    @endif

                </div>


                @if($album->description)

                    <p class="album-description">
                        {{ $album->description }}
                    </p>

                @endif

            </div>


            <div class="album-actions">

                <a
                    href="{{ route('admin.gallery.edit', $album->id) }}"
                    class="album-action-btn album-action-secondary"
                >
                    <i class="bi bi-pencil"></i>
                    Edit Album
                </a>


                <button
                    type="button"
                    class="album-action-btn album-action-primary"
                    id="toggleUpload"
                >
                    <i class="bi bi-cloud-arrow-up"></i>
                    Tambah Foto
                </button>

            </div>

        </div>


        {{-- ALERT --}}
        @if(session('success'))

            <div class="alert alert-success border-0 shadow-sm small">
                {{ session('success') }}
            </div>

        @endif


        @if(session('error'))

            <div class="alert alert-danger border-0 shadow-sm small">
                {{ session('error') }}
            </div>

        @endif


        {{-- UPLOAD --}}
        <div
            class="upload-card"
            id="uploadCard"
        >

            <div class="upload-title">
                Tambahkan Foto ke Album
            </div>


            <form
                action="{{ route('admin.gallery.photos.store', $album->id) }}"
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf


                <div class="upload-drop">

                    <i class="bi bi-images"></i>

                    <strong>
                        Pilih foto untuk album ini
                    </strong>

                    <span>
                        JPG, JPEG, PNG atau WEBP — maksimal 10 MB per foto
                    </span>

                    <input
                        type="file"
                        name="photos[]"
                        class="upload-input"
                        accept="image/jpeg,image/png,image/webp"
                        multiple
                        required
                    >


                    <button
                        type="submit"
                        class="upload-submit"
                    >
                        <i class="bi bi-upload me-1"></i>
                        Upload Foto
                    </button>

                </div>

            </form>

        </div>


        {{-- FOTO --}}
        @if($album->photos->count())

            <div class="photo-masonry">

                @foreach($album->photos as $photo)

                    <div class="photo-item">

                        <img
                            src="{{ asset('storage/' . $photo->photo) }}"
                            alt="{{ $album->name }}"
                            loading="lazy"
                        >


                        <div class="photo-overlay">

                            <form
                                action="{{ route('admin.gallery.photos.destroy', [$album->id, $photo->id]) }}"
                                method="POST"
                                onsubmit="return confirm('Hapus foto ini dari album?')"
                            >

                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="photo-delete"
                                    title="Hapus foto"
                                >
                                    <i class="bi bi-trash"></i>
                                </button>

                            </form>

                        </div>


                        <div class="photo-date">

                            {{ $photo->created_at
                                ? $photo->created_at->translatedFormat('d M Y H:i')
                                : ''
                            }}

                        </div>

                    </div>

                @endforeach

            </div>

        @else

            <div class="gallery-empty">

                <div class="gallery-empty-icon">
                    <i class="bi bi-images"></i>
                </div>

                <h3>
                    Album Masih Kosong
                </h3>

                <p>
                    Belum ada foto di dalam album ini.
                    Tambahkan dokumentasi pertama untuk album ini.
                </p>

                <button
                    type="button"
                    class="album-action-btn album-action-primary"
                    onclick="document.getElementById('toggleUpload').click()"
                >
                    <i class="bi bi-cloud-arrow-up"></i>
                    Tambah Foto
                </button>

            </div>

        @endif

    </div>

</div>


<script>
document.addEventListener('DOMContentLoaded', function () {

    const toggleUpload = document.getElementById('toggleUpload');
    const uploadCard = document.getElementById('uploadCard');

    if (toggleUpload && uploadCard) {

        toggleUpload.addEventListener('click', function () {

            uploadCard.classList.toggle('active');

            if (uploadCard.classList.contains('active')) {
                uploadCard.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
            }

        });

    }

});
</script>

@endsection