@extends('admin.layouts.admin')

@section('content')

<style>
    .history-page {
        padding-bottom: 40px;
    }

    .history-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 20px;
        margin-bottom: 28px;
    }

    .history-heading-label {
        font-size: 13px;
        font-weight: 700;
        letter-spacing: .08em;
        text-transform: uppercase;
        color: #ea580c;
        margin-bottom: 6px;
    }

    .history-heading h1 {
        margin: 0;
        font-size: 32px;
        font-weight: 800;
        color: #0f172a;
    }

    .history-heading p {
        margin: 8px 0 0;
        color: #64748b;
        font-size: 15px;
    }

    .history-back-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        min-height: 44px;
        padding: 0 18px;
        border-radius: 10px;
        border: 1px solid #e2e8f0;
        background: #fff;
        color: #334155;
        text-decoration: none;
        font-size: 14px;
        font-weight: 600;
        transition: .2s ease;
    }

    .history-back-btn:hover {
        background: #f8fafc;
        color: #0f172a;
    }

    .history-layout {
        display: grid;
        grid-template-columns: 360px minmax(0, 1fr);
        gap: 24px;
        align-items: start;
    }

    .history-form-card,
    .history-list-card {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        box-shadow: 0 8px 24px rgba(15, 23, 42, .05);
    }

    .history-form-card {
        padding: 24px;
        position: sticky;
        top: 20px;
    }

    .history-form-title {
        font-size: 19px;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 5px;
    }

    .history-form-subtitle {
        color: #64748b;
        font-size: 13px;
        line-height: 1.6;
        margin-bottom: 22px;
    }

    .history-label {
        display: block;
        font-size: 14px;
        font-weight: 700;
        color: #334155;
        margin-bottom: 7px;
    }

    .history-input,
    .history-textarea {
        width: 100%;
        border: 1px solid #cbd5e1;
        border-radius: 10px;
        padding: 11px 13px;
        font-size: 14px;
        color: #0f172a;
        background: #fff;
        outline: none;
        transition: .2s ease;
    }

    .history-input:focus,
    .history-textarea:focus {
        border-color: #ea580c;
        box-shadow: 0 0 0 3px rgba(234, 88, 12, .10);
    }

    .history-textarea {
        min-height: 130px;
        resize: vertical;
    }

    .history-form-group {
        margin-bottom: 18px;
    }

    .history-help {
        margin-top: 6px;
        color: #94a3b8;
        font-size: 12px;
        line-height: 1.5;
    }

    .history-submit {
        width: 100%;
        min-height: 46px;
        border: 0;
        border-radius: 10px;
        background: #ea580c;
        color: #fff;
        font-size: 14px;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        cursor: pointer;
        transition: .2s ease;
    }

    .history-submit:hover {
        background: #c2410c;
    }

    .history-cancel {
        width: 100%;
        min-height: 44px;
        margin-top: 9px;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        background: #fff;
        color: #475569;
        text-decoration: none;
        font-size: 14px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .history-list-card {
        padding: 28px;
    }

    .history-list-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        margin-bottom: 30px;
    }

    .history-list-title {
        font-size: 20px;
        font-weight: 800;
        color: #0f172a;
        margin: 0;
    }

    .history-count {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 34px;
        height: 28px;
        padding: 0 9px;
        border-radius: 20px;
        background: #fff7ed;
        color: #ea580c;
        font-size: 13px;
        font-weight: 800;
    }

    /* TIMELINE */

    .history-timeline {
        position: relative;
        padding: 10px 0 30px;
    }

    .history-timeline::before {
        content: "";
        position: absolute;
        top: 0;
        bottom: 0;
        left: 50%;
        width: 2px;
        transform: translateX(-50%);
        background: #e2e8f0;
    }

    .history-item {
        position: relative;
        width: 50%;
        padding: 0 42px 38px 0;
    }

    .history-item:nth-child(even) {
        margin-left: 50%;
        padding: 0 0 38px 42px;
    }

    .history-dot {
        position: absolute;
        top: 8px;
        right: -8px;
        width: 16px;
        height: 16px;
        border-radius: 50%;
        background: #ea580c;
        border: 4px solid #fff;
        box-shadow: 0 0 0 2px #ea580c;
        z-index: 2;
    }

    .history-item:nth-child(even) .history-dot {
        left: -8px;
        right: auto;
    }

    .history-card {
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        padding: 20px;
        background: #fff;
        transition: .2s ease;
    }

    .history-card:hover {
        border-color: #fed7aa;
        box-shadow: 0 8px 22px rgba(15, 23, 42, .06);
    }

    .history-date {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        color: #ea580c;
        font-size: 12px;
        font-weight: 800;
        margin-bottom: 9px;
    }

    .history-title {
        margin: 0 0 8px;
        font-size: 17px;
        font-weight: 800;
        color: #0f172a;
        line-height: 1.35;
    }

    .history-description {
        margin: 0;
        color: #64748b;
        font-size: 13px;
        line-height: 1.7;
        white-space: pre-line;
    }

    .history-actions {
        display: flex;
        gap: 7px;
        margin-top: 17px;
        padding-top: 14px;
        border-top: 1px solid #f1f5f9;
    }

    .history-action {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
        min-height: 34px;
        padding: 0 11px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 700;
        text-decoration: none;
        border: 1px solid transparent;
    }

    .history-action-edit {
        background: #eff6ff;
        color: #2563eb;
        border-color: #dbeafe;
    }

    .history-action-delete {
        background: #fef2f2;
        color: #dc2626;
        border-color: #fee2e2;
        cursor: pointer;
    }

    .history-empty {
        text-align: center;
        padding: 65px 20px;
        color: #64748b;
    }

    .history-empty-icon {
        width: 62px;
        height: 62px;
        margin: 0 auto 15px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #fff7ed;
        color: #ea580c;
        font-size: 27px;
    }

    .history-empty h3 {
        margin: 0 0 7px;
        color: #334155;
        font-size: 18px;
        font-weight: 800;
    }

    .history-empty p {
        margin: 0;
        font-size: 13px;
    }

    .alert-success {
        border: 0;
        border-radius: 10px;
        background: #ecfdf5;
        color: #047857;
        font-size: 14px;
        padding: 12px 15px;
        margin-bottom: 20px;
    }

    .alert-danger {
        border: 0;
        border-radius: 10px;
        background: #fef2f2;
        color: #b91c1c;
        font-size: 13px;
        padding: 12px 15px;
        margin-bottom: 20px;
    }

    .history-invalid {
        color: #dc2626;
        font-size: 12px;
        margin-top: 5px;
    }

    @media (max-width: 1100px) {
        .history-layout {
            grid-template-columns: 320px minmax(0, 1fr);
        }

        .history-item {
            padding-right: 28px;
        }

        .history-item:nth-child(even) {
            padding-left: 28px;
        }
    }

    @media (max-width: 850px) {
        .history-layout {
            grid-template-columns: 1fr;
        }

        .history-form-card {
            position: static;
        }

        .history-timeline::before {
            left: 14px;
            transform: none;
        }

        .history-item,
        .history-item:nth-child(even) {
            width: 100%;
            margin-left: 0;
            padding: 0 0 28px 42px;
        }

        .history-dot,
        .history-item:nth-child(even) .history-dot {
            left: 6px;
            right: auto;
        }
    }

    @media (max-width: 576px) {
        .history-header {
            flex-direction: column;
        }

        .history-back-btn {
            width: 100%;
            justify-content: center;
        }

        .history-list-card,
        .history-form-card {
            padding: 20px;
            border-radius: 13px;
        }

        .history-heading h1 {
            font-size: 27px;
        }

        .history-card {
            padding: 16px;
        }

        .history-actions {
            flex-wrap: wrap;
        }
    }
</style>

<div class="history-page">

    {{-- HEADER --}}
    <div class="history-header">

        <div class="history-heading">
            <div class="history-heading-label">
                Profile ASEBA
            </div>

            <h1>Club History</h1>

            <p>
                Kelola perjalanan dan sejarah perkembangan klub ASEBA.
            </p>
        </div>

        <a href="{{ route('admin.aseba.profile') }}"
           class="history-back-btn">
            <i class="bi bi-arrow-left"></i>
            Kembali ke Profile
        </a>

    </div>


    {{-- SUCCESS --}}
    @if(session('success'))
        <div class="alert-success">
            <i class="bi bi-check-circle-fill me-1"></i>
            {{ session('success') }}
        </div>
    @endif


    {{-- VALIDATION ERROR --}}
    @if($errors->any())
        <div class="alert-danger">
            <strong>
                <i class="bi bi-exclamation-circle me-1"></i>
                Terdapat kesalahan:
            </strong>

            <ul class="mb-0 mt-2 ps-3">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <div class="history-layout">

        {{-- FORM --}}
        <div class="history-form-card">

            @if(isset($history))

                <div class="history-form-title">
                    Edit History
                </div>

                <div class="history-form-subtitle">
                    Perbarui informasi sejarah ASEBA yang dipilih.
                </div>

                <form method="POST"
                      action="{{ route('admin.aseba.profile.history.update', $history->id) }}">

                    @method('PUT')

            @else

                <div class="history-form-title">
                    Tambah History
                </div>

                <div class="history-form-subtitle">
                    Tambahkan catatan penting perjalanan ASEBA.
                </div>

                <form method="POST"
                      action="{{ route('admin.aseba.profile.history.store') }}">

            @endif

                @csrf

                {{-- DATE --}}
                <div class="history-form-group">

                    <label class="history-label">
                        Tahun
                        <span class="text-danger">*</span>
                    </label>

                    <input type="number"
                        name="year"
                        class="history-input"
                        value="{{ old('year', $history->year ?? '') }}"
                        placeholder="Contoh: 2018"
                        min="1900"
                        max="2100"
                        required>

                    <div class="history-help">
                        Tahun perjalanan ASEBA.
                    </div>

                    @error('year')
                        <div class="history-invalid">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- TITLE --}}
                <div class="history-form-group">

                    <label class="history-label">
                        Judul History
                        <span class="text-danger">*</span>
                    </label>

                    <input type="text"
                           name="title"
                           class="history-input"
                           value="{{ old('title', $history->title ?? '') }}"
                           placeholder="Contoh: Awal Berdirinya ASEBA"
                           maxlength="255"
                           required>

                    @error('title')
                        <div class="history-invalid">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- DESCRIPTION --}}
                <div class="history-form-group">

                    <label class="history-label">
                        Deskripsi
                    </label>

                    <textarea name="description"
                              class="history-textarea"
                              placeholder="Tuliskan cerita atau informasi mengenai sejarah tersebut...">{{ old('description', $history->description ?? '') }}</textarea>

                    @error('description')
                        <div class="history-invalid">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                @if(isset($history))

                    <button type="submit"
                            class="history-submit">
                        <i class="bi bi-check-lg"></i>
                        Simpan Perubahan
                    </button>

                    <a href="{{ route('admin.aseba.profile.history') }}"
                       class="history-cancel">
                        Batal Edit
                    </a>

                @else

                    <button type="submit"
                            class="history-submit">
                        <i class="bi bi-plus-lg"></i>
                        Tambah History
                    </button>

                @endif

            </form>

        </div>


        {{-- TIMELINE --}}
        <div class="history-list-card">

            <div class="history-list-header">

                <h2 class="history-list-title">
                    Timeline Perjalanan ASEBA
                </h2>

                <span class="history-count">
                    {{ isset($histories) ? $histories->count() : 0 }}
                </span>

            </div>


            @if(isset($histories) && $histories->count())

                <div class="history-timeline">

                    @foreach($histories as $historyItem)

                        <div class="history-item">

                            <div class="history-dot"></div>

                            <div class="history-card">

                                <div class="history-date">

                                    <i class="bi bi-calendar3"></i>

                                    {{ $historyItem->year }}

                                </div>

                                <h3 class="history-title">
                                    {{ $historyItem->title }}
                                </h3>

                                @if($historyItem->description)

                                    <p class="history-description">
                                        {{ $historyItem->description }}
                                    </p>

                                @endif


                                <div class="history-actions">

                                    <a href="{{ route('admin.aseba.profile.history.edit', $historyItem->id) }}"
                                       class="history-action history-action-edit">

                                        <i class="bi bi-pencil"></i>
                                        Edit

                                    </a>


                                    <form method="POST"
                                          action="{{ route('admin.aseba.profile.history.destroy', $historyItem->id) }}"
                                          onsubmit="return confirm('Yakin ingin menghapus history ini?');"
                                          class="d-inline">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="history-action history-action-delete">

                                            <i class="bi bi-trash"></i>
                                            Hapus

                                        </button>

                                    </form>

                                </div>

                            </div>

                        </div>

                    @endforeach

                </div>

            @else

                <div class="history-empty">

                    <div class="history-empty-icon">
                        <i class="bi bi-clock-history"></i>
                    </div>

                    <h3>Belum Ada History</h3>

                    <p>
                        Belum ada perjalanan sejarah ASEBA yang ditambahkan.
                    </p>

                </div>

            @endif

        </div>

    </div>

</div>

@endsection