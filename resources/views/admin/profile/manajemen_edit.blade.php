@extends('admin.layouts.admin')

@section('title', 'Management Board')

@section('content')

<style>
    .management-page {
        padding: 10px 0 35px;
    }

    .management-heading {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 28px;
    }

    .management-eyebrow {
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

    .management-heading h1 {
        margin: 0;
        color: #0F172A;
        font-size: 30px;
        font-weight: 800;
    }

    .management-heading p {
        margin: 8px 0 0;
        color: #64748B;
        font-size: 14px;
    }

    .management-back {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        color: #64748B;
        font-size: 13px;
        font-weight: 700;
        text-decoration: none;
        white-space: nowrap;
    }

    .management-back:hover {
        color: #EA580C;
    }

    /* FORM */
    .management-form-card {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 16px;
        padding: 25px;
        margin-bottom: 30px;
        box-shadow: 0 3px 12px rgba(15, 23, 42, .035);
    }

    .management-form-header {
        display: flex;
        align-items: center;
        gap: 12px;
        padding-bottom: 18px;
        margin-bottom: 22px;
        border-bottom: 1px solid #F1F5F9;
    }

    .management-form-icon {
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

    .management-form-header h2 {
        margin: 0;
        color: #0F172A;
        font-size: 17px;
        font-weight: 800;
    }

    .management-form-header p {
        margin: 3px 0 0;
        color: #94A3B8;
        font-size: 12px;
    }

    .management-label {
        display: block;
        margin-bottom: 7px;
        color: #334155;
        font-size: 13px;
        font-weight: 700;
    }

    .management-label .required {
        color: #EA580C;
    }

    .management-input,
    .management-textarea {
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

    .management-input {
        min-height: 43px;
    }

    .management-textarea {
        min-height: 95px;
        resize: vertical;
    }

    .management-input:focus,
    .management-textarea:focus {
        border-color: #EA580C;
        box-shadow: 0 0 0 3px rgba(234, 88, 12, .08);
    }

    .management-help {
        display: block;
        margin-top: 6px;
        color: #94A3B8;
        font-size: 11px;
        line-height: 1.5;
    }

    .management-photo-input {
        padding: 8px 10px;
    }

    .management-submit {
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

    .management-submit:hover {
        background: #C2410C;
    }

    /* LIST HEADER */
    .management-list-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        margin-bottom: 15px;
    }

    .management-list-header h2 {
        margin: 0;
        color: #0F172A;
        font-size: 18px;
        font-weight: 800;
    }

    .management-count {
        padding: 6px 10px;
        border-radius: 7px;
        background: #F8FAFC;
        color: #64748B;
        font-size: 12px;
        font-weight: 700;
    }

    /* MEMBER CARD */
    .management-member {
        height: 100%;
        display: flex;
        flex-direction: column;
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 15px;
        padding: 19px;
        box-shadow: 0 3px 12px rgba(15, 23, 42, .035);
        transition: all .2s ease;
    }

    .management-member:hover {
        transform: translateY(-2px);
        border-color: #CBD5E1;
        box-shadow: 0 9px 22px rgba(15, 23, 42, .06);
    }

    .management-member-top {
        display: flex;
        align-items: flex-start;
        gap: 14px;
    }

    .management-photo {
        width: 68px;
        height: 68px;
        flex: 0 0 68px;
        border-radius: 13px;
        object-fit: cover;
        background: #F1F5F9;
    }

    .management-photo-placeholder {
        width: 68px;
        height: 68px;
        flex: 0 0 68px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 13px;
        background: #F1F5F9;
        color: #94A3B8;
        font-size: 25px;
    }

    .management-member-name {
        margin: 2px 0 5px;
        color: #0F172A;
        font-size: 16px;
        font-weight: 800;
    }

    .management-status {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 4px 7px;
        border-radius: 6px;
        font-size: 10px;
        font-weight: 800;
    }

    .management-status.active {
        background: #ECFDF5;
        color: #047857;
    }

    .management-status.inactive {
        background: #F1F5F9;
        color: #64748B;
    }

    .management-status-dot {
        width: 5px;
        height: 5px;
        border-radius: 50%;
        background: currentColor;
    }

    .management-roles {
        display: flex;
        flex-wrap: wrap;
        gap: 5px;
        margin-top: 17px;
    }

    .management-role {
        display: inline-flex;
        padding: 5px 8px;
        border-radius: 6px;
        background: #FFF7ED;
        color: #C2410C;
        font-size: 10px;
        font-weight: 800;
    }

    .management-details {
        margin-top: 15px;
        padding-top: 14px;
        border-top: 1px solid #F1F5F9;
    }

    .management-detail {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 7px;
        color: #64748B;
        font-size: 12px;
    }

    .management-detail:last-child {
        margin-bottom: 0;
    }

    .management-detail i {
        width: 15px;
        color: #94A3B8;
        text-align: center;
    }

    .management-actions {
        display: flex;
        gap: 7px;
        margin-top: auto;
        padding-top: 16px;
    }

    .management-action {
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

    .management-action:hover {
        background: #F8FAFC;
        color: #0F172A;
    }

    .management-action.delete:hover {
        background: #FEF2F2;
        border-color: #FECACA;
        color: #DC2626;
    }

    .management-action.toggle:hover {
        background: #FFF7ED;
        border-color: #FED7AA;
        color: #EA580C;
    }

    /* EMPTY */
    .management-empty {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 16px;
        text-align: center;
        padding: 60px 20px;
    }

    .management-empty-icon {
        width: 62px;
        height: 62px;
        margin: 0 auto 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 16px;
        background: #FFF7ED;
        color: #EA580C;
        font-size: 25px;
    }

    .management-empty h3 {
        margin: 0 0 7px;
        color: #0F172A;
        font-size: 18px;
        font-weight: 800;
    }

    .management-empty p {
        max-width: 430px;
        margin: 0 auto;
        color: #94A3B8;
        font-size: 13px;
        line-height: 1.6;
    }

    .management-alert {
        border: 0;
        border-radius: 10px;
        font-size: 13px;
    }

    @media (max-width: 767.98px) {

        .management-heading {
            align-items: flex-start;
            flex-direction: column;
        }

        .management-heading h1 {
            font-size: 27px;
        }

        .management-back {
            width: 100%;
            min-height: 40px;
            justify-content: center;
            border: 1px solid #E2E8F0;
            border-radius: 9px;
        }

        .management-form-card {
            padding: 19px;
        }

        .management-submit {
            width: 100%;
        }

        .management-list-header {
            align-items: flex-start;
            flex-direction: column;
        }
    }
</style>


<div class="management-page">

    {{-- HEADER --}}
    <div class="management-heading">

        <div>

            <div class="management-eyebrow">
                <i class="bi bi-people-fill"></i>
                Profile ASEBA
            </div>

            <h1>Management Board</h1>

            <p>
                Kelola susunan management yang akan ditampilkan
                pada halaman profile ASEBA.
            </p>

        </div>

        <a href="{{ route('admin.aseba.profile') }}"
           class="management-back">

            <i class="bi bi-arrow-left"></i>

            Kembali ke Profile

        </a>

    </div>


    {{-- SUCCESS --}}
    @if(session('success'))

        <div class="alert alert-success management-alert mb-4">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
        </div>

    @endif


    {{-- VALIDATION --}}
    @if($errors->any())

        <div class="alert alert-danger management-alert mb-4">

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


    {{-- ADD FORM --}}
    <div class="management-form-card">

        <div class="management-form-header">

            <div class="management-form-icon">
                <i class="bi bi-person-plus-fill"></i>
            </div>

            <div>

                <h2>Tambah Management</h2>

                <p>
                    Tambahkan anggota baru ke dalam Management Board.
                </p>

            </div>

        </div>


        <form action="{{ route('admin.aseba.profile.management.store') }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf

            <div class="row g-3">

                {{-- NAME --}}
                <div class="col-md-6">

                    <label class="management-label">
                        Nama Lengkap
                        <span class="required">*</span>
                    </label>

                    <input type="text"
                           name="name"
                           class="management-input"
                           value="{{ old('name') }}"
                           placeholder="Contoh: Ahmad Fauzan"
                           required>

                </div>


                {{-- ROLE --}}
                <div class="col-md-6">

                    <label class="management-label">
                        Jabatan / Role
                        <span class="required">*</span>
                    </label>

                    <input type="text"
                           name="role"
                           class="management-input"
                           value="{{ old('role') }}"
                           placeholder="OWNER, CLUB MANAGER, HEAD COACH"
                           required>

                    <span class="management-help">
                        Jika memiliki lebih dari satu jabatan, pisahkan dengan koma.
                    </span>

                </div>


                {{-- PHOTO --}}
                <div class="col-md-6">

                    <label class="management-label">
                        Foto
                    </label>

                    <input type="file"
                           name="photo"
                           class="management-input management-photo-input"
                           accept=".jpg,.jpeg,.png,.webp">

                    <span class="management-help">
                        Maksimal 5 MB. Format JPG, JPEG, PNG atau WEBP.
                    </span>

                </div>


                {{-- PHONE --}}
                <div class="col-md-6">

                    <label class="management-label">
                        Nomor Telepon
                    </label>

                    <input type="text"
                           name="phone"
                           class="management-input"
                           value="{{ old('phone') }}"
                           placeholder="08xxxxxxxxxx">

                </div>


                {{-- EMAIL --}}
                <div class="col-md-6">

                    <label class="management-label">
                        Email
                    </label>

                    <input type="email"
                           name="email"
                           class="management-input"
                           value="{{ old('email') }}"
                           placeholder="nama@email.com">

                </div>


                {{-- INSTAGRAM --}}
                <div class="col-md-6">

                    <label class="management-label">
                        Instagram
                    </label>

                    <input type="text"
                           name="instagram"
                           class="management-input"
                           value="{{ old('instagram') }}"
                           placeholder="@username">

                </div>


                {{-- LINKEDIN --}}
                <div class="col-md-6">

                    <label class="management-label">
                        LinkedIn
                    </label>

                    <input type="text"
                           name="linkedin"
                           class="management-input"
                           value="{{ old('linkedin') }}"
                           placeholder="linkedin.com/in/username">

                </div>


                {{-- DESCRIPTION --}}
                <div class="col-12">

                    <label class="management-label">
                        Deskripsi
                    </label>

                    <textarea name="description"
                              class="management-textarea"
                              placeholder="Informasi singkat tentang anggota management...">{{ old('description') }}</textarea>

                </div>


                {{-- BUTTON --}}
                <div class="col-12">

                    <button type="submit"
                            class="management-submit">

                        <i class="bi bi-plus-lg"></i>

                        Tambahkan Management

                    </button>

                </div>

            </div>

        </form>

    </div>


    {{-- LIST --}}
    <div class="management-list-header">

        <h2>Daftar Management</h2>

        <div class="management-count">

            {{ $managementBoards->count() }} Members

        </div>

    </div>


    @if($managementBoards->count())

        <div class="row g-3">

            @foreach($managementBoards as $management)

                <div class="col-xl-4 col-md-6">

                    <div class="management-member">

                        <div class="management-member-top">

                            @if($management->photo)

                                <img src="{{ asset('storage/' . $management->photo) }}"
                                     alt="{{ $management->name }}"
                                     class="management-photo">

                            @else

                                <div class="management-photo-placeholder">

                                    <i class="bi bi-person-fill"></i>

                                </div>

                            @endif


                            <div>

                                <div class="management-member-name">
                                    {{ $management->name }}
                                </div>

                                @if($management->is_active)

                                    <div class="management-status active">
                                        <span class="management-status-dot"></span>
                                        Aktif
                                    </div>

                                @else

                                    <div class="management-status inactive">
                                        <span class="management-status-dot"></span>
                                        Tidak Aktif
                                    </div>

                                @endif

                            </div>

                        </div>


                        {{-- ROLES --}}
                        <div class="management-roles">

                            @foreach($management->roles as $role)

                                <span class="management-role">
                                    {{ $role }}
                                </span>

                            @endforeach

                        </div>


                        {{-- DETAILS --}}
                        @if(
                            $management->phone ||
                            $management->email ||
                            $management->instagram ||
                            $management->linkedin
                        )

                            <div class="management-details">

                                @if($management->phone)

                                    <div class="management-detail">

                                        <i class="bi bi-telephone-fill"></i>

                                        <span>
                                            {{ $management->phone }}
                                        </span>

                                    </div>

                                @endif


                                @if($management->email)

                                    <div class="management-detail">

                                        <i class="bi bi-envelope-fill"></i>

                                        <span>
                                            {{ $management->email }}
                                        </span>

                                    </div>

                                @endif


                                @if($management->instagram)

                                    <div class="management-detail">

                                        <i class="bi bi-instagram"></i>

                                        <span>
                                            {{ $management->instagram }}
                                        </span>

                                    </div>

                                @endif


                                @if($management->linkedin)

                                    <div class="management-detail">

                                        <i class="bi bi-linkedin"></i>

                                        <span>
                                            {{ $management->linkedin }}
                                        </span>

                                    </div>

                                @endif

                            </div>

                        @endif


                        {{-- ACTIONS --}}
                        <div class="management-actions">

                            <a href="{{ route('admin.aseba.profile.management.edit', $management->id) }}"
                               class="management-action">

                                <i class="bi bi-pencil-fill"></i>

                                Edit

                            </a>


                            <form action="{{ route('admin.aseba.profile.management.toggle', $management->id) }}"
                                  method="POST"
                                  style="flex:1;">

                                @csrf
                                @method('PATCH')

                                <button type="submit"
                                        class="management-action toggle w-100">

                                    <i class="bi bi-power"></i>

                                    {{ $management->is_active ? 'Nonaktifkan' : 'Aktifkan' }}

                                </button>

                            </form>


                            <form action="{{ route('admin.aseba.profile.management.destroy', $management->id) }}"
                                  method="POST"
                                  style="flex:1;"
                                  onsubmit="return confirm('Yakin ingin menghapus {{ $management->name }}?')">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="management-action delete w-100">

                                    <i class="bi bi-trash-fill"></i>

                                    Hapus

                                </button>

                            </form>

                        </div>

                    </div>

                </div>

            @endforeach

        </div>

    @else

        <div class="management-empty">

            <div class="management-empty-icon">
                <i class="bi bi-people"></i>
            </div>

            <h3>Belum Ada Management</h3>

            <p>
                Belum ada anggota Management Board yang ditambahkan.
                Gunakan form di atas untuk menambahkan anggota pertama.
            </p>

        </div>

    @endif

</div>

@endsection