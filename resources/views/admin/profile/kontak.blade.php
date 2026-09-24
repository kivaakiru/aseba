@extends('admin.layouts.admin')

@section('title', 'Kontak & Sosial Media')

@section('content')

<style>

    .contact-page {
        padding: 30px;
    }

    .contact-header {
        margin-bottom: 25px;
    }

    .contact-header .eyebrow {
        font-size: 12px;
        font-weight: 700;
        letter-spacing: .08em;
        text-transform: uppercase;
        color: #ea580c;
        margin-bottom: 6px;
    }

    .contact-header h1 {
        font-size: 28px;
        font-weight: 800;
        color: #0f172a;
        margin: 0;
    }

    .contact-header p {
        margin: 6px 0 0;
        color: #64748b;
        font-size: 14px;
    }

    .contact-section {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: 0 3px 12px rgba(15, 23, 42, .04);
    }

    .contact-section-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        margin-bottom: 18px;
    }

    .contact-section-title {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .contact-section-icon {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        background: #fff7ed;
        color: #ea580c;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
    }

    .contact-section-title h3 {
        margin: 0;
        font-size: 16px;
        font-weight: 800;
        color: #0f172a;
    }

    .contact-section-title p {
        margin: 2px 0 0;
        font-size: 11px;
        color: #94a3b8;
    }

    .contact-list {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .contact-item {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 14px;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        background: #fff;
        transition: .2s ease;
    }

    .contact-item:hover {
        border-color: #cbd5e1;
        box-shadow: 0 4px 12px rgba(15, 23, 42, .05);
    }

    .contact-drag {
        cursor: grab;
        color: #94a3b8;
        font-size: 17px;
        padding: 5px;
    }

    .contact-drag:active {
        cursor: grabbing;
    }

    .contact-icon {
        width: 40px;
        height: 40px;
        min-width: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 19px;
        background: #f8fafc;
    }

    .contact-info {
        flex: 1;
        min-width: 0;
    }

    .contact-type {
        font-size: 9px;
        text-transform: uppercase;
        letter-spacing: .06em;
        font-weight: 700;
        color: #94a3b8;
        margin-bottom: 2px;
    }

    .contact-name {
        font-size: 14px;
        font-weight: 700;
        color: #0f172a;
        word-break: break-word;
    }

    .contact-value {
        font-size: 12px;
        color: #64748b;
        word-break: break-word;
        margin-top: 2px;
    }

    .contact-actions {
        display: flex;
        gap: 6px;
    }

    .contact-action {
        width: 34px;
        height: 34px;
        border: 0;
        border-radius: 9px;
        background: #f1f5f9;
        color: #334155;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }

    .contact-action:hover {
        background: #e2e8f0;
    }

    .contact-action.delete:hover {
        background: #fee2e2;
        color: #dc2626;
    }

    .contact-empty {
        border: 1px dashed #cbd5e1;
        border-radius: 12px;
        padding: 35px 20px;
        text-align: center;
        color: #94a3b8;
    }

    .contact-empty i {
        display: block;
        font-size: 28px;
        margin-bottom: 8px;
    }

    .contact-empty div {
        font-size: 13px;
    }

    .sort-save {
        display: none;
        margin-top: 12px;
        justify-content: flex-end;
    }

    .sort-save.show {
        display: flex;
    }

    .btn-contact {
        border: 0;
        border-radius: 9px;
        background: #0f172a;
        color: #fff;
        padding: 9px 14px;
        font-size: 12px;
        font-weight: 700;
    }

    .btn-contact:hover {
        background: #1e293b;
        color: #fff;
    }

    .btn-contact i {
        margin-right: 5px;
    }

    .modal-content {
        border: 0;
        border-radius: 14px;
        overflow: hidden;
    }

    .modal-header {
        border-bottom: 1px solid #e2e8f0;
        padding: 16px 20px;
    }

    .modal-title {
        font-size: 16px;
        font-weight: 800;
        color: #0f172a;
    }

    .modal-body {
        padding: 20px;
    }

    .modal-footer {
        border-top: 1px solid #e2e8f0;
        padding: 12px 20px;
    }

    .form-label {
        font-size: 11px;
        font-weight: 700;
        color: #334155;
        margin-bottom: 6px;
    }

    .form-control,
    .form-select {
        border-color: #cbd5e1;
        border-radius: 8px;
        font-size: 13px;
        min-height: 40px;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #ea580c;
        box-shadow: 0 0 0 3px rgba(234, 88, 12, .08);
    }

    .form-text {
        font-size: 10px;
        color: #94a3b8;
        margin-top: 5px;
    }

    .social-preview {
        display: none;
        margin-top: 10px;
        padding: 10px 12px;
        border-radius: 8px;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        font-size: 12px;
    }

    .social-preview.show {
        display: block;
    }

    .social-preview strong {
        color: #0f172a;
    }

    /* SOCIAL COLORS */

    .icon-instagram {
        color: #e1306c;
        background: #fdf2f8;
    }

    .icon-facebook {
        color: #1877f2;
        background: #eff6ff;
    }

    .icon-tiktok {
        color: #111827;
        background: #f1f5f9;
    }

    .icon-youtube {
        color: #ff0000;
        background: #fef2f2;
    }

    .icon-x {
        color: #000;
        background: #f1f5f9;
    }

    .icon-whatsapp {
        color: #25d366;
        background: #f0fdf4;
    }

    .icon-telegram {
        color: #229ed9;
        background: #eff6ff;
    }

    .icon-email {
        color: #ea580c;
        background: #fff7ed;
    }

    .icon-website {
        color: #2563eb;
        background: #eff6ff;
    }

    .icon-address {
        color: #ea580c;
        background: #fff7ed;
    }

    .dragging {
        opacity: .45;
    }

    @media (max-width: 768px) {

        .contact-page {
            padding: 18px;
        }

        .contact-section-header {
            align-items: flex-start;
        }

        .contact-section-header .btn-contact {
            white-space: nowrap;
        }

        .contact-item {
            padding: 11px;
        }

        .contact-actions {
            flex-direction: column;
        }

    }

</style>


<div class="contact-page">

    {{-- HEADER --}}

    <div class="contact-header">

        <div class="eyebrow">
            Club Profile
        </div>

        <h1>
            Kontak & Sosial Media
        </h1>

        <p>
            Kelola alamat, lokasi Google Maps, sosial media dan kontak
            yang akan ditampilkan pada footer halaman utama ASEBA.
        </p>

    </div>


    {{-- ALERT SUCCESS --}}

    @if(session('success'))

        <div class="alert alert-success">
            {{ session('success') }}
        </div>

    @endif


    {{-- ALERT ERROR --}}

    @if($errors->any())

        <div class="alert alert-danger">

            <ul class="mb-0">

                @foreach($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- ========================================================= --}}
    {{-- ALAMAT --}}
    {{-- ========================================================= --}}

    <div class="contact-section">

        <div class="contact-section-header">

            <div class="contact-section-title">

                <div class="contact-section-icon">
                    <i class="bi bi-geo-alt-fill"></i>
                </div>

                <div>

                    <h3>
                        Alamat
                    </h3>

                    <p>
                        Alamat dan lokasi Google Maps ASEBA.
                    </p>

                </div>

            </div>

            <button
                type="button"
                class="btn-contact"
                data-bs-toggle="modal"
                data-bs-target="#addAddressModal">

                <i class="bi bi-plus-lg"></i>

                Tambah Alamat

            </button>

        </div>


        @if($addresses->count())

            <div
                class="contact-list"
                id="addressList">

                @foreach($addresses as $address)

                    <div
                        class="contact-item"
                        draggable="true"
                        data-id="{{ $address->id }}">

                        <div class="contact-drag">
                            <i class="bi bi-grip-vertical"></i>
                        </div>

                        <div class="contact-icon icon-address">
                            <i class="bi bi-geo-alt-fill"></i>
                        </div>

                        <div class="contact-info">

                            <div class="contact-type">
                                Lokasi
                            </div>

                            <div class="contact-name">
                                {{ $address->label }}
                            </div>

                            <div class="contact-value">
                                {{ $address->value }}
                            </div>

                        </div>

                        <div class="contact-actions">

                            <button
                                type="button"
                                class="contact-action"
                                data-bs-toggle="modal"
                                data-bs-target="#editAddressModal{{ $address->id }}">

                                <i class="bi bi-pencil-fill"></i>

                            </button>

                            <form
                                method="POST"
                                action="{{ route('admin.aseba.profile.contact.destroy', $address->id) }}"
                                onsubmit="return confirm('Hapus alamat ini?')">

                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="contact-action delete">

                                    <i class="bi bi-trash-fill"></i>

                                </button>

                            </form>

                        </div>

                    </div>


                    {{-- EDIT ADDRESS MODAL --}}

                    <div
                        class="modal fade"
                        id="editAddressModal{{ $address->id }}"
                        tabindex="-1">

                        <div class="modal-dialog modal-dialog-centered">

                            <div class="modal-content">

                                <form
                                    method="POST"
                                    action="{{ route('admin.aseba.profile.contact.update', $address->id) }}">

                                    @csrf
                                    @method('PUT')

                                    <div class="modal-header">

                                        <h5 class="modal-title">
                                            Edit Alamat
                                        </h5>

                                        <button
                                            type="button"
                                            class="btn-close"
                                            data-bs-dismiss="modal">
                                        </button>

                                    </div>

                                    <div class="modal-body">

                                        <div class="mb-3">

                                            <label class="form-label">
                                                Nama Lokasi / Nama Tempat
                                            </label>

                                            <input
                                                type="text"
                                                name="label"
                                                class="form-control"
                                                value="{{ $address->label }}"
                                                required>

                                        </div>

                                        <div class="mb-3">

                                            <label class="form-label">
                                                Alamat
                                            </label>

                                            <textarea
                                                name="value"
                                                class="form-control"
                                                rows="4"
                                                required>{{ $address->value }}</textarea>

                                        </div>

                                        <div>

                                            <label class="form-label">
                                                Google Maps
                                            </label>

                                            <input
                                                type="url"
                                                name="link"
                                                class="form-control"
                                                value="{{ $address->link }}"
                                                required>

                                        </div>

                                    </div>

                                    <div class="modal-footer">

                                        <button
                                            type="button"
                                            class="btn btn-light"
                                            data-bs-dismiss="modal">

                                            Batal

                                        </button>

                                        <button
                                            type="submit"
                                            class="btn-contact">

                                            Simpan

                                        </button>

                                    </div>

                                </form>

                            </div>

                        </div>

                    </div>

                @endforeach

            </div>

            <div
                class="sort-save"
                id="addressSaveBox">

                <button
                    type="button"
                    class="btn-contact"
                    onclick="saveOrder('addressList', 'addressSaveBox')">

                    <i class="bi bi-check-lg"></i>

                    Simpan Urutan

                </button>

            </div>

        @else

            <div class="contact-empty">

                <i class="bi bi-geo-alt"></i>

                <div>
                    Belum ada alamat yang ditambahkan.
                </div>

            </div>

        @endif

    </div>


    {{-- ========================================================= --}}
    {{-- SOCIAL MEDIA & CONTACT --}}
    {{-- ========================================================= --}}

    <div class="contact-section">

        <div class="contact-section-header">

            <div class="contact-section-title">

                <div class="contact-section-icon">
                    <i class="bi bi-share-fill"></i>
                </div>

                <div>

                    <h3>
                        Sosial Media & Kontak
                    </h3>

                    <p>
                        Tambahkan sosial media, email dan kontak ASEBA.
                    </p>

                </div>

            </div>

            <button
                type="button"
                class="btn-contact"
                data-bs-toggle="modal"
                data-bs-target="#addSocialModal">

                <i class="bi bi-plus-lg"></i>

                Tambah

            </button>

        </div>


        @if($socials->count())

            <div
                class="contact-list"
                id="socialList">

                @foreach($socials as $social)

                    <div
                        class="contact-item"
                        draggable="true"
                        data-id="{{ $social->id }}">

                        <div class="contact-drag">
                            <i class="bi bi-grip-vertical"></i>
                        </div>

                        <div class="contact-icon icon-{{ $social->type }}">

                            <i class="bi {{ $social->icon }}"></i>

                        </div>

                        <div class="contact-info">

                            <div class="contact-type">
                                {{ $social->type_name }}
                            </div>

                            <div class="contact-name">
                                {{ $social->value }}
                            </div>

                            <div class="contact-value">
                                {{ $social->link }}
                            </div>

                        </div>

                        <div class="contact-actions">

                            <button
                                type="button"
                                class="contact-action"
                                data-bs-toggle="modal"
                                data-bs-target="#editSocialModal{{ $social->id }}">

                                <i class="bi bi-pencil-fill"></i>

                            </button>

                            <form
                                method="POST"
                                action="{{ route('admin.aseba.profile.contact.destroy', $social->id) }}"
                                onsubmit="return confirm('Hapus data ini?')">

                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="contact-action delete">

                                    <i class="bi bi-trash-fill"></i>

                                </button>

                            </form>

                        </div>

                    </div>


                    {{-- EDIT SOCIAL MODAL --}}

                    <div
                        class="modal fade"
                        id="editSocialModal{{ $social->id }}"
                        tabindex="-1">

                        <div class="modal-dialog modal-dialog-centered">

                            <div class="modal-content">

                                <form
                                    method="POST"
                                    action="{{ route('admin.aseba.profile.contact.update', $social->id) }}">

                                    @csrf
                                    @method('PUT')

                                    <div class="modal-header">

                                        <h5 class="modal-title">
                                            Edit Sosial Media / Kontak
                                        </h5>

                                        <button
                                            type="button"
                                            class="btn-close"
                                            data-bs-dismiss="modal">
                                        </button>

                                    </div>

                                    <div class="modal-body">

                                        <div class="mb-3">

                                            <label class="form-label">
                                                Jenis
                                            </label>

                                            <select
                                                name="type"
                                                class="form-select social-type-edit"
                                                required>

                                                <option
                                                    value="instagram"
                                                    {{ $social->type === 'instagram' ? 'selected' : '' }}>
                                                    Instagram
                                                </option>

                                                <option
                                                    value="facebook"
                                                    {{ $social->type === 'facebook' ? 'selected' : '' }}>
                                                    Facebook
                                                </option>

                                                <option
                                                    value="tiktok"
                                                    {{ $social->type === 'tiktok' ? 'selected' : '' }}>
                                                    TikTok
                                                </option>

                                                <option
                                                    value="youtube"
                                                    {{ $social->type === 'youtube' ? 'selected' : '' }}>
                                                    YouTube
                                                </option>

                                                <option
                                                    value="x"
                                                    {{ $social->type === 'x' ? 'selected' : '' }}>
                                                    X
                                                </option>

                                                <option
                                                    value="whatsapp"
                                                    {{ $social->type === 'whatsapp' ? 'selected' : '' }}>
                                                    WhatsApp
                                                </option>

                                                <option
                                                    value="telegram"
                                                    {{ $social->type === 'telegram' ? 'selected' : '' }}>
                                                    Telegram
                                                </option>

                                                <option
                                                    value="email"
                                                    {{ $social->type === 'email' ? 'selected' : '' }}>
                                                    Email
                                                </option>

                                                <option
                                                    value="website"
                                                    {{ $social->type === 'website' ? 'selected' : '' }}>
                                                    Website
                                                </option>

                                            </select>

                                        </div>

                                        <div>

                                            <label class="form-label">
                                                Link / Username / Isi
                                            </label>

                                            <input
                                                type="text"
                                                name="link"
                                                class="form-control"
                                                value="{{ $social->link }}"
                                                required>

                                            <div class="form-text">
                                                Masukkan username, link, email atau nomor sesuai jenis yang dipilih.
                                            </div>

                                        </div>

                                    </div>

                                    <div class="modal-footer">

                                        <button
                                            type="button"
                                            class="btn btn-light"
                                            data-bs-dismiss="modal">

                                            Batal

                                        </button>

                                        <button
                                            type="submit"
                                            class="btn-contact">

                                            Simpan

                                        </button>

                                    </div>

                                </form>

                            </div>

                        </div>

                    </div>

                @endforeach

            </div>

            <div
                class="sort-save"
                id="socialSaveBox">

                <button
                    type="button"
                    class="btn-contact"
                    onclick="saveOrder('socialList', 'socialSaveBox')">

                    <i class="bi bi-check-lg"></i>

                    Simpan Urutan

                </button>

            </div>

        @else

            <div class="contact-empty">

                <i class="bi bi-share"></i>

                <div>
                    Belum ada sosial media atau kontak yang ditambahkan.
                </div>

            </div>

        @endif

    </div>

</div>


{{-- ========================================================= --}}
{{-- ADD ADDRESS MODAL --}}
{{-- ========================================================= --}}

<div
    class="modal fade"
    id="addAddressModal"
    tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <form
                method="POST"
                action="{{ route('admin.aseba.profile.contact.address.store') }}">

                @csrf

                <div class="modal-header">

                    <h5 class="modal-title">
                        Tambah Alamat
                    </h5>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">
                    </button>

                </div>

                <div class="modal-body">

                    <div class="mb-3">

                        <label class="form-label">
                            Nama Lokasi / Nama Tempat
                        </label>

                        <input
                            type="text"
                            name="label"
                            class="form-control"
                            placeholder="Contoh: ASEBA Basketball Home Court"
                            required>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Alamat
                        </label>

                        <textarea
                            name="value"
                            class="form-control"
                            rows="4"
                            placeholder="Masukkan alamat lengkap..."
                            required></textarea>

                    </div>

                    <div>

                        <label class="form-label">
                            Google Maps
                        </label>

                        <input
                            type="url"
                            name="link"
                            class="form-control"
                            placeholder="https://maps.google.com/..."
                            required>

                        <div class="form-text">
                            Masukkan link lokasi Google Maps ASEBA.
                        </div>

                    </div>

                </div>

                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-light"
                        data-bs-dismiss="modal">

                        Batal

                    </button>

                    <button
                        type="submit"
                        class="btn-contact">

                        <i class="bi bi-plus-lg"></i>

                        Tambah Alamat

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


{{-- ========================================================= --}}
{{-- ADD SOCIAL MODAL --}}
{{-- ========================================================= --}}

<div
    class="modal fade"
    id="addSocialModal"
    tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <form
                method="POST"
                action="{{ route('admin.aseba.profile.contact.social.store') }}">

                @csrf

                <div class="modal-header">

                    <h5 class="modal-title">
                        Tambah Sosial Media / Kontak
                    </h5>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">
                    </button>

                </div>

                <div class="modal-body">

                    <div class="mb-3">

                        <label class="form-label">
                            Jenis
                        </label>

                        <select
                            name="type"
                            id="socialType"
                            class="form-select"
                            required>

                            <option value="instagram">
                                Instagram
                            </option>

                            <option value="facebook">
                                Facebook
                            </option>

                            <option value="tiktok">
                                TikTok
                            </option>

                            <option value="youtube">
                                YouTube
                            </option>

                            <option value="x">
                                X
                            </option>

                            <option value="whatsapp">
                                WhatsApp
                            </option>

                            <option value="telegram">
                                Telegram
                            </option>

                            <option value="email">
                                Email
                            </option>

                            <option value="website">
                                Website
                            </option>

                        </select>

                    </div>

                    <div>

                        <label
                            class="form-label"
                            id="socialInputLabel">

                            Link / Username

                        </label>

                        <input
                            type="text"
                            name="link"
                            id="socialInput"
                            class="form-control"
                            placeholder="https://instagram.com/aseba"
                            required>

                        <div
                            class="form-text"
                            id="socialInputHelp">

                            Bisa masukkan username seperti @aseba
                            atau link Instagram lengkap.

                        </div>

                    </div>

                    <div
                        class="social-preview"
                        id="socialPreview">

                        Tampilan:

                        <strong id="socialPreviewValue"></strong>

                    </div>

                </div>

                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-light"
                        data-bs-dismiss="modal">

                        Batal

                    </button>

                    <button
                        type="submit"
                        class="btn-contact">

                        <i class="bi bi-plus-lg"></i>

                        Tambah

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


<script>

document.addEventListener(
    'DOMContentLoaded',
    function () {

        const type =
            document.getElementById(
                'socialType'
            );

        const input =
            document.getElementById(
                'socialInput'
            );

        const label =
            document.getElementById(
                'socialInputLabel'
            );

        const help =
            document.getElementById(
                'socialInputHelp'
            );

        const preview =
            document.getElementById(
                'socialPreview'
            );

        const previewValue =
            document.getElementById(
                'socialPreviewValue'
            );


        function updateSocialInput() {

            const selected =
                type.value;


            const settings = {

                instagram: {

                    label:
                        'Username / Link Instagram',

                    placeholder:
                        '@asebabasketball atau https://instagram.com/asebabasketball',

                    help:
                        'Masukkan username atau link Instagram.'
                },

                facebook: {

                    label:
                        'Username / Link Facebook',

                    placeholder:
                        'asebabasketball atau https://facebook.com/asebabasketball',

                    help:
                        'Masukkan username atau link Facebook.'
                },

                tiktok: {

                    label:
                        'Username / Link TikTok',

                    placeholder:
                        '@asebabasketball atau https://tiktok.com/@asebabasketball',

                    help:
                        'Masukkan username atau link TikTok.'
                },

                youtube: {

                    label:
                        'Username / Link YouTube',

                    placeholder:
                        '@asebabasketball atau https://youtube.com/@asebabasketball',

                    help:
                        'Masukkan handle atau link channel YouTube.'
                },

                x: {

                    label:
                        'Username / Link X',

                    placeholder:
                        '@asebabasketball atau https://x.com/asebabasketball',

                    help:
                        'Masukkan username atau link X.'
                },

                whatsapp: {

                    label:
                        'Nomor WhatsApp',

                    placeholder:
                        '628123456789',

                    help:
                        'Gunakan format nomor internasional. Contoh: 628123456789.'
                },

                telegram: {

                    label:
                        'Username / Link Telegram',

                    placeholder:
                        '@asebabasketball atau https://t.me/asebabasketball',

                    help:
                        'Masukkan username atau link Telegram.'
                },

                email: {

                    label:
                        'Email',

                    placeholder:
                        'aseba@gmail.com',

                    help:
                        'Email akan otomatis diarahkan menggunakan mailto:.'
                },

                website: {

                    label:
                        'Link Website',

                    placeholder:
                        'https://aseba.com',

                    help:
                        'Masukkan link website ASEBA.'
                }

            };


            const setting =
                settings[selected];


            label.textContent =
                setting.label;

            input.placeholder =
                setting.placeholder;

            help.textContent =
                setting.help;


            preview.classList.remove(
                'show'
            );

            input.value = '';

        }


        function previewSocial() {

            const value =
                input.value.trim();

            if (!value) {

                preview.classList.remove(
                    'show'
                );

                return;
            }


            let output =
                value;


            if (
                type.value === 'instagram'
                ||
                type.value === 'tiktok'
                ||
                type.value === 'youtube'
                ||
                type.value === 'x'
                ||
                type.value === 'telegram'
            ) {

                if (
                    value.startsWith(
                        'http://'
                    )
                    ||
                    value.startsWith(
                        'https://'
                    )
                ) {

                    try {

                        const url =
                            new URL(value);

                        let path =
                            url.pathname
                                .split('/')
                                .filter(Boolean);

                        if (
                            path[0] === 'channel'
                            ||
                            path[0] === 'c'
                            ||
                            path[0] === 'user'
                        ) {

                            output =
                                '@'
                                + (
                                    path[1]
                                    ?? ''
                                ).replace(
                                    /^@/,
                                    ''
                                );

                        } else {

                            output =
                                '@'
                                + (
                                    path[0]
                                    ?? ''
                                ).replace(
                                    /^@/,
                                    ''
                                );
                        }

                    } catch (error) {

                        output = value;
                    }

                } else {

                    output =
                        '@'
                        + value.replace(
                            /^@/,
                            ''
                        );
                }
            }


            if (
                type.value === 'facebook'
                &&
                (
                    value.startsWith(
                        'http://'
                    )
                    ||
                    value.startsWith(
                        'https://'
                    )
                )
            ) {

                try {

                    const url =
                        new URL(value);

                    const path =
                        url.pathname
                            .split('/')
                            .filter(Boolean);

                    output =
                        path[0] ?? value;

                } catch (error) {

                    output = value;
                }
            }


            if (
                type.value === 'email'
            ) {

                output =
                    value.replace(
                        /^mailto:/i,
                        ''
                    );
            }


            previewValue.textContent =
                output;

            preview.classList.add(
                'show'
            );
        }


        type.addEventListener(
            'change',
            updateSocialInput
        );

        input.addEventListener(
            'input',
            previewSocial
        );


        updateSocialInput();


        /*
        |--------------------------------------------------------------------------
        | DRAG & DROP
        |--------------------------------------------------------------------------
        */

        setupDragDrop(
            'addressList',
            'addressSaveBox'
        );

        setupDragDrop(
            'socialList',
            'socialSaveBox'
        );

    }
);


/*
|--------------------------------------------------------------------------
| DRAG & DROP
|--------------------------------------------------------------------------
*/

function setupDragDrop(
    listId,
    saveBoxId
) {

    const list =
        document.getElementById(
            listId
        );

    const saveBox =
        document.getElementById(
            saveBoxId
        );


    if (!list) {
        return;
    }


    let dragged = null;


    list.querySelectorAll(
        '.contact-item'
    ).forEach(
        item => {

            item.addEventListener(
                'dragstart',
                function () {

                    dragged = this;

                    this.classList.add(
                        'dragging'
                    );
                }
            );


            item.addEventListener(
                'dragend',
                function () {

                    this.classList.remove(
                        'dragging'
                    );

                    dragged = null;

                    if (saveBox) {

                        saveBox.classList.add(
                            'show'
                        );
                    }
                }
            );


            item.addEventListener(
                'dragover',
                function (event) {

                    event.preventDefault();

                    if (
                        !dragged
                        ||
                        dragged === this
                    ) {
                        return;
                    }


                    const rect =
                        this.getBoundingClientRect();

                    const middle =
                        rect.top
                        +
                        rect.height / 2;


                    if (
                        event.clientY <
                        middle
                    ) {

                        list.insertBefore(
                            dragged,
                            this
                        );

                    } else {

                        list.insertBefore(
                            dragged,
                            this.nextSibling
                        );
                    }
                }
            );

        }
    );
}


/*
|--------------------------------------------------------------------------
| SAVE ORDER
|--------------------------------------------------------------------------
*/

function saveOrder(
    listId,
    saveBoxId
) {

    const list =
        document.getElementById(
            listId
        );

    if (!list) {
        return;
    }


    const items =
        Array.from(
            list.querySelectorAll(
                '.contact-item'
            )
        ).map(
            (
                item,
                index
            ) => ({

                id:
                    item.dataset.id,

                sort_order:
                    index

            })
        );


    fetch(
        "{{ route('admin.aseba.profile.contact.reorder') }}",
        {

            method: 'POST',

            headers: {

                'Content-Type':
                    'application/json',

                'X-CSRF-TOKEN':
                    document
                        .querySelector(
                            'meta[name="csrf-token"]'
                        )
                        .getAttribute(
                            'content'
                        ),

                'Accept':
                    'application/json'
            },

            body:
                JSON.stringify({
                    items: items
                })
        }
    )
    .then(
        response =>
            response.json()
    )
    .then(
        data => {

            if (
                data.success
            ) {

                const saveBox =
                    document.getElementById(
                        saveBoxId
                    );

                if (saveBox) {

                    saveBox.classList.remove(
                        'show'
                    );
                }

                alert(
                    'Urutan berhasil disimpan.'
                );
            }
        }
    )
    .catch(
        error => {

            console.error(
                error
            );

            alert(
                'Gagal menyimpan urutan.'
            );
        }
    );
}

</script>

@endsection