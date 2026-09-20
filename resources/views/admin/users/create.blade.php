@extends('admin.layouts.admin')

@section('title','Tambah User')
@section('page-title','Tambah User')
@section('page-subtitle','Buat akun baru untuk administrator atau member')

@section('content')

<div class="container-fluid">

    @if ($errors->any())

        <div class="alert alert-danger">

            <ul class="mb-0">

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    <form action="{{ route('admin.users.store') }}"
          method="POST">

        @csrf

        <div class="card border-0 shadow-sm">

            <div class="card-header bg-white">

                <h5 class="mb-0 fw-bold">

                    Informasi User

                </h5>

            </div>

            <div class="card-body">

                <div class="row g-3">

                    <div class="col-lg-6">

                        <label class="form-label">

                            Nama Lengkap

                        </label>

                        <input
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            class="form-control"
                            required>

                    </div>

                    <div class="col-lg-6">

                        <label class="form-label">

                            Email

                        </label>

                        <input
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            class="form-control"
                            required>

                    </div>

                    <div class="col-lg-6">

                        <label class="form-label">

                            Nomor HP

                        </label>

                        <input
                            type="text"
                            name="phone"
                            value="{{ old('phone') }}"
                            class="form-control">

                    </div>

                    <div class="col-lg-6">

                        <label class="form-label">

                            User Type

                        </label>

                        <select
                            name="user_type"
                            class="form-select">

                            <option value="personal">

                                Personal

                            </option>

                            <option value="club">

                                Club / Komunitas

                            </option>

                        </select>

                        <div class="col-lg-6" id="leaderNameGroup" style="display:none;">
                            <label class="form-label">Nama Leader</label>
                            <input
                                type="text"
                                name="leader_name"
                                value="{{ old('leader_name') }}"
                                class="form-control"
                                placeholder="Nama ketua / leader komunitas">
                        </div>

                    </div>
                    <div class="col-lg-6">

                        <label class="form-label">

                            User Level

                        </label>

                        <select
                            name="user_level"
                            class="form-select"
                            required>

                            <option value="user">
                                User
                            </option>

                            @if(auth()->user()->user_level=='superadmin')

                            <option value="admin">

                                Admin

                            </option>

                            <option value="superadmin">

                                Super Admin

                            </option>

                            @endif

                            @if(auth()->user()->user_level == 'superadmin')

                            <option value="superadmin">
                                Super Admin
                            </option>

                            @endif

                        </select>

                    </div>

                    <div class="col-lg-6">

                        <label class="form-label">

                            Password

                        </label>

                        <div class="input-group">

                            <input
                                id="password"
                                type="password"
                                name="password"
                                class="form-control"
                                required>

                            <button
                                class="btn btn-outline-secondary"
                                type="button"
                                onclick="togglePassword('password',this)">

                                <i class="bi bi-eye"></i>

                            </button>

                        </div>

                    </div>

                    <div class="col-lg-6">

                        <label class="form-label">

                            Konfirmasi Password

                        </label>

                        <div class="input-group">

                            <input
                                id="password_confirmation"
                                type="password"
                                name="password_confirmation"
                                class="form-control"
                                required>

                            <button
                                class="btn btn-outline-secondary"
                                type="button"
                                onclick="togglePassword('password_confirmation',this)">

                                <i class="bi bi-eye"></i>

                            </button>

                        </div>

                    </div>

                    <div class="col-12">

                        <div class="form-check">

                            <input
                                class="form-check-input"
                                type="checkbox"
                                name="is_event_organizer"
                                value="1">

                            <label class="form-check-label">

                                Jadikan sebagai Event Organizer

                            </label>

                        </div>

                    </div>

                </div>

            </div>

            <div class="card-footer bg-white">

                <div class="d-flex justify-content-end gap-2">

                    <a
                        href="{{ route('admin.users.index') }}"
                        class="btn btn-light border">

                        Batal

                    </a>

                    <button
                        class="btn btn-primary">

                        <i class="bi bi-check-circle me-1"></i>

                        Simpan User

                    </button>

                </div>

            </div>

        </div>

    </form>

</div>

<script>

function togglePassword(id,button){

    let input=document.getElementById(id);

    let icon=button.querySelector('i');

    if(input.type==="password"){

        input.type="text";

        icon.className="bi bi-eye-slash";

    }else{

        input.type="password";

        icon.className="bi bi-eye";

    }

}

</script>
<script>
document.addEventListener('DOMContentLoaded', function () {

    const userType = document.querySelector('select[name="user_type"]');
    const leaderGroup = document.getElementById('leaderNameGroup');
    const leaderInput = document.querySelector('input[name="leader_name"]');

    function toggleLeader() {
        if (userType.value === 'club') {
            leaderGroup.style.display = '';
            leaderInput.required = true;
        } else {
            leaderGroup.style.display = 'none';
            leaderInput.required = false;
            leaderInput.value = '';
        }
    }

    userType.addEventListener('change', toggleLeader);

    toggleLeader();
});
</script>

@endsection
