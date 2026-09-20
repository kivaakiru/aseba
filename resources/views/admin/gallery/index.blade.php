@extends('admin.layouts.admin')

@section('title', 'Gallery')
@section('page-title', 'Gallery')
@section('page-subtitle', 'Kelola album dan dokumentasi kegiatan ASEBA Basketball Club')

@section('content')

<style>
    .gallery-page {
        width: 100%;
    }

    .gallery-header {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        gap: 25px;
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
        font-size: 36px;
        line-height: 1;
        font-weight: 900;
        font-style: italic;
        text-transform: uppercase;
        letter-spacing: -1.5px;
    }

    .gallery-title span {
        color: #ea580c;
    }

    .gallery-subtitle {
        margin: 11px 0 0;
        color: #64748b;
        font-size: 15px;
    }

    .gallery-create-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        min-width: 145px;
        height: 46px;
        padding: 0 18px;
        border: 0;
        border-radius: 10px;
        background: #ea580c;
        color: #fff;
        font-size: 14px;
        font-weight: 800;
        text-decoration: none;
        text-transform: uppercase;
        box-shadow: 0 7px 18px rgba(234, 88, 12, .18);
        transition: .2s ease;
    }

    .gallery-create-btn:hover {
        background: #c2410c;
        color: #fff;
        transform: translateY(-1px);
    }

    .gallery-toolbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        padding: 14px 16px;
        margin-bottom: 16px;
        border: 1px solid #e2e8f0;
        border-radius: 11px;
        background: #fff;
    }

    .gallery-toolbar-info {
        color: #64748b;
        font-size: 14px;
    }

    .gallery-toolbar-info strong {
        color: #0f172a;
    }

    .album-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 18px;
    }

    .album-card {
        overflow: hidden;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        background: #fff;
        box-shadow: 0 5px 18px rgba(15, 23, 42, .04);
        transition: .22s ease;
    }

    .album-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 28px rgba(15, 23, 42, .08);
    }

    .album-cover {
        position: relative;
        height: 210px;
        overflow: hidden;
        background:
            radial-gradient(
                circle at 20% 10%,
                rgba(234, 88, 12, .35),
                transparent 35%
            ),
            linear-gradient(
                135deg,
                #1e293b,
                #020617
            );
    }

    .album-cover img {
        width: 100%;
        height: 100%;
        display: block;
        object-fit: cover;
        transition: transform .35s ease;
    }

    .album-card:hover .album-cover img {
        transform: scale(1.04);
    }

    .album-cover::after {
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(
            to top,
            rgba(2, 6, 23, .85),
            rgba(2, 6, 23, .05) 70%
        );
        pointer-events: none;
    }

    .album-placeholder {
        position: absolute;
        inset: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        color: rgba(255,255,255,.3);
        font-size: 45px;
    }

    .album-cover-content {
        position: absolute;
        z-index: 2;
        left: 17px;
        right: 17px;
        bottom: 16px;
    }

    .album-cover-content h2 {
        margin: 0;
        color: #fff;
        font-size: 20px;
        line-height: 1.25;
        font-weight: 800;
    }

    .album-cover-content p {
        margin: 6px 0 0;
        color: rgba(255,255,255,.75);
        font-size: 13px;
    }

    .album-menu {
        position: absolute;
        z-index: 3;
        top: 12px;
        right: 12px;
    }

    .album-menu .dropdown-toggle {
        width: 31px;
        height: 31px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0;
        border: 1px solid rgba(255,255,255,.28);
        border-radius: 8px;
        background: rgba(15,23,42,.65);
        color: #fff;
        box-shadow: none;
    }

    .album-menu .dropdown-toggle::after {
        display: none;
    }

    .album-menu .dropdown-menu {
        min-width: 145px;
        padding: 6px;
        border: 1px solid #e2e8f0;
        border-radius: 9px;
        box-shadow: 0 10px 25px rgba(15,23,42,.12);
    }

    .album-menu .dropdown-item {
        display: flex;
        align-items: center;
        gap: 8px;
        border-radius: 6px;
        font-size: 13px;
    }

    .album-menu .dropdown-item:hover {
        background: #f8fafc;
    }

    .album-menu .dropdown-item.delete-item {
        color: #dc2626;
    }

    .album-info {
        padding: 14px 16px 15px;
    }

    .album-description {
        min-height: 35px;
        margin: 0 0 14px;
        color: #64748b;
        font-size: 13px;
        line-height: 1.55;
    }

    .album-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        padding-top: 12px;
        border-top: 1px solid #edf1f5;
    }

    .album-meta {
        display: flex;
        align-items: center;
        gap: 12px;
        color: #64748b;
        font-size: 13px;
    }

    .album-meta i {
        margin-right: 3px;
        color: #94a3b8;
    }

    .album-manage-btn {
        color: #ea580c;
        font-size: 13px;
        font-weight: 800;
        text-decoration: none;
        text-transform: uppercase;
    }

    .album-manage-btn:hover {
        color: #c2410c;
    }

    .gallery-empty {
        padding: 80px 20px;
        border: 1px dashed #cbd5e1;
        border-radius: 15px;
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

    @media (max-width: 1100px) {
        .album-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 768px) {

        .gallery-header {
            align-items: stretch;
            flex-direction: column;
        }

        .gallery-create-btn {
            width: 100%;
        }

        .gallery-title {
            font-size: 30px;
        }

        .album-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 576px) {

        .gallery-title {
            font-size: 27px;
        }

        .gallery-cover {
            height: 190px;
        }

        .gallery-toolbar {
            align-items: flex-start;
            flex-direction: column;
        }
    }
</style>


<div class="container-fluid">

    <div class="gallery-page">


        {{-- HEADER --}}
        <div class="gallery-header">

            <div>

                <span class="gallery-label">
                    Gallery Management
                </span>

                <h1 class="gallery-title">
                    Gallery <span>Album.</span>
                </h1>

                <p class="gallery-subtitle">
                    Kelola album dan dokumentasi kegiatan ASEBA Basketball Club.
                </p>

            </div>


            <div>

                <a
                    href="{{ route('admin.gallery.create') }}"
                    class="gallery-create-btn"
                >
                    <i class="bi bi-folder-plus"></i>
                    Buat Album
                </a>

            </div>

        </div>


        {{-- SUCCESS --}}
        @if(session('success'))

            <div class="alert alert-success border-0 shadow-sm small">
                {{ session('success') }}
            </div>

        @endif


        {{-- ERROR --}}
        @if(session('error'))

            <div class="alert alert-danger border-0 shadow-sm small">
                {{ session('error') }}
            </div>

        @endif


        {{-- TOOLBAR --}}
        <div class="gallery-toolbar">

            <div class="gallery-toolbar-info">

                Menampilkan

                <strong>
                    {{ $albums->count() }}
                </strong>

                album

            </div>

        </div>


        {{-- ALBUM --}}
        @if($albums->count())

            <div class="album-grid">

                @foreach($albums as $album)

                    <div class="album-card">

                        {{-- COVER --}}
                        <div class="album-cover">

                            @if(
                                $album->latestPhoto &&
                                $album->latestPhoto->photo
                            )

                                <img
                                    src="{{ asset('storage/' . $album->latestPhoto->photo) }}"
                                    alt="{{ $album->name }}"
                                >

                            @elseif($album->cover)

                                <img
                                    src="{{ asset('storage/' . $album->cover) }}"
                                    alt="{{ $album->name }}"
                                >

                            @else

                                <div class="album-placeholder">
                                    <i class="bi bi-images"></i>
                                </div>

                            @endif


                            {{-- MENU --}}
                            <div class="album-menu dropdown">

                                <button
                                    type="button"
                                    class="dropdown-toggle"
                                    data-bs-toggle="dropdown"
                                    aria-expanded="false"
                                >
                                    <i class="bi bi-three-dots-vertical"></i>
                                </button>


                                <ul class="dropdown-menu dropdown-menu-end">

                                    <li>

                                        <a
                                            class="dropdown-item"
                                            href="{{ route('admin.gallery.show', $album->id) }}"
                                        >
                                            <i class="bi bi-folder2-open"></i>
                                            Buka Album
                                        </a>

                                    </li>

                                    <li>

                                        <a
                                            class="dropdown-item"
                                            href="{{ route('admin.gallery.edit', $album->id) }}"
                                        >
                                            <i class="bi bi-pencil"></i>
                                            Edit Album
                                        </a>

                                    </li>

                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>

                                    <li>

                                        <form
                                            action="{{ route('admin.gallery.destroy', $album->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Hapus album ini beserta seluruh fotonya?')"
                                        >

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="dropdown-item delete-item"
                                            >
                                                <i class="bi bi-trash"></i>
                                                Hapus Album
                                            </button>

                                        </form>

                                    </li>

                                </ul>

                            </div>


                            {{-- TITLE --}}
                            <div class="album-cover-content">

                                <h2>
                                    {{ $album->name }}
                                </h2>

                                <p>

                                    @if($album->album_date)

                                        {{ \Carbon\Carbon::parse($album->album_date)->translatedFormat('d F Y') }}

                                    @else

                                        Dibuat {{ $album->created_at->translatedFormat('d F Y') }}

                                    @endif

                                </p>

                            </div>

                        </div>


                        {{-- INFO --}}
                        <div class="album-info">

                            <p class="album-description">

                                {{ $album->description ?: 'Belum ada deskripsi album.' }}

                            </p>


                            <div class="album-footer">

                                <div class="album-meta">

                                    <span>
                                        <i class="bi bi-images"></i>
                                        {{ $album->photos_count }} Foto
                                    </span>

                                </div>


                                <a
                                    href="{{ route('admin.gallery.show', $album->id) }}"
                                    class="album-manage-btn"
                                >
                                    Kelola
                                    <i class="bi bi-arrow-right"></i>
                                </a>

                            </div>

                        </div>

                    </div>

                @endforeach

            </div>

        @else

            {{-- EMPTY --}}
            <div class="gallery-empty">

                <div class="gallery-empty-icon">
                    <i class="bi bi-images"></i>
                </div>

                <h3>
                    Belum Ada Album
                </h3>

                <p>
                    Belum ada album gallery yang dibuat.
                    Buat album pertama untuk mulai menyimpan dokumentasi ASEBA.
                </p>

                <a
                    href="{{ route('admin.gallery.create') }}"
                    class="gallery-create-btn"
                >
                    <i class="bi bi-folder-plus"></i>
                    Buat Album Pertama
                </a>

            </div>

        @endif

    </div>

</div>

@endsection