@extends('admin.layouts.admin')

@section('title','Edit User')
@section('page-title','Edit User')
@section('page-subtitle','Perbarui informasi akun pengguna')

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

    <form
        action="{{ route('admin.users.update',$user->id) }}"
        method="POST"
        enctype="multipart/form-data">

        @csrf
        @method('PUT')

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
                            value="{{ old('name',$user->name) }}"
                            class="form-control"
                            required>

                    </div>

                    <div class="col-lg-6">

                        <label class="form-label">

                            Email

                        </label>

                        <input
                            type="email"
                            value="{{ $user->email }}"
                            class="form-control"
                            disabled>

                    </div>

                    <div class="col-lg-6">

                        <label class="form-label">

                            Nomor HP

                        </label>

                        <input
                            type="text"
                            name="phone"
                            value="{{ old('phone',$user->phone) }}"
                            class="form-control">

                    </div>

                    <div class="col-lg-6">

                        <label class="form-label">

                            Foto Profil

                        </label>

                        <div class="d-flex align-items-center gap-3">

                            <img
                                src="{{ $user->photo ? asset('storage/users/'.$user->photo) : asset('images/default-avatar.png') }}"
                                class="rounded-circle border"
                                width="70"
                                height="70"
                                style="object-fit:cover;">

                            <div class="flex-grow-1">

                                <input
                                    type="file"
                                    name="photo"
                                    accept=".jpg,.jpeg,.png,.webp"
                                    class="form-control">

                                <small class="text-muted">

                                    Kosongkan jika tidak ingin mengganti foto.

                                </small>

                            </div>

                        </div>

                    </div>

                    <div class="col-lg-6">

                        <label class="form-label">

                            Status

                        </label>

                        <select
                            name="status"
                            class="form-select">

                            <option
                                value="active"
                                {{ $user->status=='active'?'selected':'' }}>

                                Active

                            </option>

                            <option
                                value="inactive"
                                {{ $user->status=='inactive'?'selected':'' }}>

                                Inactive

                            </option>

                        </select>

                    </div>

                    @if($user->user_level=='user')

                    <div class="col-lg-6">

                        <label class="form-label">

                            User Type

                        </label>

                        <select
                            name="user_type"
                            class="form-select">

                            <option
                                value="personal"
                                {{ $user->user_type=='personal'?'selected':'' }}>

                                Personal

                            </option>

                            <option
                                value="club"
                                {{ $user->user_type=='club'?'selected':'' }}>

                                Club

                            </option>

                        </select>
                        <div
                            class="col-lg-6"
                            id="leaderNameGroup"
                            style="{{ $user->user_type === 'club' ? '' : 'display:none;' }}"
                        >
                            <label class="form-label">Nama Leader</label>

                            <input
                                type="text"
                                name="leader_name"
                                value="{{ old('leader_name', $user->leader_name) }}"
                                class="form-control"
                                placeholder="Nama ketua / leader komunitas"
                                {{ $user->user_type === 'club' ? 'required' : '' }}
                            >
                        </div>

                    </div>

                    @endif

                    <div class="col-lg-6">

                        <label class="form-label">

                            User Level

                        </label>

                        <select
                            name="user_level"
                            class="form-select"
                            {{ auth()->user()->user_level!='superadmin'?'disabled':'' }}>

                            <option
                                value="user"
                                {{ $user->user_level=='user'?'selected':'' }}>

                                User

                            </option>

                            <option
                                value="admin"
                                {{ $user->user_level=='admin'?'selected':'' }}>

                                Admin

                            </option>

                            <option
                                value="superadmin"
                                {{ $user->user_level=='superadmin'?'selected':'' }}>

                                Super Admin

                            </option>

                        </select>

                    </div>

                    @if($user->user_level=='user')

                    <div class="col-12">

                        <div class="form-check">

                            <input
                                class="form-check-input"
                                type="checkbox"
                                name="is_event_organizer"
                                value="1"
                                {{ $user->is_event_organizer ? 'checked':'' }}>

                            <label class="form-check-label">

                                Event Organizer

                            </label>

                        </div>

                    </div>

                    @endif

                    <div class="col-lg-6">

                        <label class="form-label">

                            Password Baru

                        </label>

                        <div class="input-group">

                            <input
                                id="password"
                                type="password"
                                name="password"
                                class="form-control">

                            <button
                                type="button"
                                class="btn btn-outline-secondary"
                                onclick="togglePassword('password',this)">

                                <i class="bi bi-eye"></i>

                            </button>

                        </div>

                        <small class="text-muted">

                            Kosongkan jika tidak ingin mengganti password.

                        </small>

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
                                class="form-control">

                            <button
                                type="button"
                                class="btn btn-outline-secondary"
                                onclick="togglePassword('password_confirmation',this)">

                                <i class="bi bi-eye"></i>

                            </button>

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

                        Update User

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
