@extends('admin.layouts.admin')

@section('title','Users')
@section('page-title','Users Management')
@section('page-subtitle','Kelola seluruh akun pengguna ASEBA')

@section('content')

<div class="container-fluid">

    {{-- ===========================
            SUMMARY
    ============================ --}}

    @php
        $totalUsers = $users->count();
        $adminCount = $users
            ->whereIn('user_level', ['admin','superadmin'])
            ->count();
        $memberCount = $users
            ->where('user_level','user')
            ->count();
        $eoCount = $users->where('is_event_organizer',1)->count();
    @endphp

    <div class="row g-2 mb-3">

        <div class="col-6 col-xl-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body py-2 px-3">

                    <small class="text-muted">
                        Total User
                    </small>

                    <h3 class="fw-bold mt-2 mb-0">
                        {{ $totalUsers }}
                    </h3>

                </div>
            </div>
        </div>

        <div class="col-6 col-xl-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body py-2 px-3">

                    <small class="text-muted">
                        Administrator
                    </small>

                    <h3 class="fw-bold mt-2 mb-0 text-danger">
                        {{ $adminCount }}
                    </h3>

                </div>
            </div>
        </div>

        <div class="col-6 col-xl-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body py-2 px-3">

                    <small class="text-muted">
                        Member
                    </small>

                    <h3 class="fw-bold mt-2 mb-0 text-primary">
                        {{ $memberCount }}
                    </h3>

                </div>
            </div>
        </div>

        <div class="col-6 col-xl-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body py-2 px-3">

                    <small class="text-muted">
                        Event Organizer
                    </small>

                    <h3 class="fw-bold mt-2 mb-0 text-success">
                        {{ $eoCount }}
                    </h3>

                </div>
            </div>
        </div>

    </div>

    {{-- ===========================
            HEADER
    ============================ --}}

    <div class="card border-0 shadow-sm mb-4">

        <div class="card-body py-2 px-3">

            <div class="row g-3 align-items-center">

                <div class="col-lg-5">

                    <input
                        type="text"
                        id="searchUser"
                        class="form-control"
                        placeholder="Cari nama, email atau nomor HP...">

                </div>

                <div class="col-lg-3">

                    <select
                        id="filterRole"
                        class="form-select">

                        <option value="">
                            Semua Role
                        </option>

                        <option value="admin">
                            Admin
                        </option>
                        <option value="superadmin">
                            Super Admin
                        </option>

                        <option value="user">
                            User
                        </option>

                    </select>

                </div>

                <div class="col-lg-4 text-lg-end">

                    <a
                        href="{{ route('admin.users.create') }}"
                        class="btn btn-primary">

                        <i class="bi bi-plus-circle me-1"></i>

                        Tambah User

                    </a>

                </div>

            </div>

        </div>

    </div>

    @if(session('success'))

        <div class="alert alert-success">

            {{ session('success') }}

        </div>

    @endif

    {{-- ===========================
            TABLE
    ============================ --}}

    <div class="card border-0 shadow-sm">

        {{-- ===========================
                MOBILE LIST
        =========================== --}}

        <div class="d-lg-none">

            @forelse($users as $user)

            <div class="card border-0 shadow-sm mb-2">

                <div class="card-body p-3">

                    <div class="d-flex justify-content-between align-items-start">

                        <div class="d-flex">

                            @if($user->photo)

                            <img
                                src="{{ asset('storage/users/'.$user->photo) }}"
                                class="rounded-circle me-3 border"
                                width="42"
                                height="42"
                                style="object-fit:cover;">

                            @else

                            <div
                                class="rounded-circle bg-primary text-white fw-bold d-flex justify-content-center align-items-center me-3"
                                style="width:42px;height:42px;font-size:14px;">

                                {{ strtoupper(substr($user->name,0,1)) }}

                            </div>

                            @endif

                            <div>

                                <div class="fw-semibold" style="font-size:14px">
                                    {{ $user->name }}
                                </div>

                                <small class="text-muted">
                                    {{ $user->email }}
                                </small>

                                @if($user->user_level === 'user')
                                    <div class="mt-1">
                                        @if($user->user_type === 'club')
                                            <small class="text-primary">
                                                Club
                                                @if($user->leader_name)
                                                    • Leader: {{ $user->leader_name }}
                                                @endif
                                            </small>
                                        @else
                                            <small class="text-secondary">
                                                Personal
                                            </small>
                                        @endif
                                    </div>
                                @endif

                            </div>

                        </div>

                        <span class="badge bg-{{ $user->status=='active'?'success':'secondary' }}">

                            {{ ucfirst($user->status) }}

                        </span>

                    </div>

                    <div class="row mt-3 g-2">

                        <div class="col-6">

                            <small class="text-muted">

                                Phone

                            </small>

                            <div>

                                {{ $user->phone ?: '-' }}

                            </div>

                        </div>

                        <div class="col-3">

                            <small class="text-muted">

                                Role

                            </small>

                            <div>

                                {{ ucfirst($user->user_level) }}

                            </div>

                        </div>

                        <div class="col-3">

                            <small class="text-muted">

                                EO

                            </small>

                            <div>

                                {{ $user->is_event_organizer ? 'Yes' : 'No' }}

                            </div>

                        </div>

                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-3">

                        @if(
                            auth()->id() != $user->id &&
                            (
                                auth()->user()->user_level == 'superadmin'
                                || $user->user_level == 'user'
                            )
                        )

                        <a href="{{ route('admin.users.edit',$user->id) }}"
                        class="btn btn-warning btn-sm">

                            <i class="bi bi-pencil"></i>

                        </a>

                        @endif


                        @if(
                            auth()->id() != $user->id &&
                            $user->user_level != 'admin'
                        )

                        <form
                            action="{{ route('admin.users.destroy',$user->id) }}"
                            method="POST"
                            onsubmit="return confirm('Hapus user ini?')">

                            @csrf
                            @method('DELETE')

                            <button class="btn btn-danger btn-sm">

                                <i class="bi bi-trash"></i>

                            </button>

                        </form>

                        @endif

                    </div>

                </div>

            </div>

            @empty

            <div class="alert alert-light text-center">

                Tidak ada user.

            </div>

            @endforelse

        </div>

        <div class="table-responsive d-none d-lg-block">

            <table class="table table-hover align-middle mb-0">

                <thead class="table-light">

                <tr>

                    <th>User</th>

                    <th>Phone</th>

                    <th>Role</th>

                    <th>EO</th>

                    <th>Status</th>

                    <th width="120">
                        Action
                    </th>

                </tr>

                </thead>

                <tbody id="userTable">

                @forelse($users as $user)

                    <tr>

                        <td>

                            <div class="d-flex align-items-center">

                                @if($user->photo)

                                <img
                                    src="{{ asset('storage/users/'.$user->photo) }}"
                                    class="rounded-circle border me-3"
                                    width="45"
                                    height="45"
                                    style="object-fit:cover;">

                                @else

                                <div
                                    class="rounded-circle bg-primary text-white d-flex justify-content-center align-items-center fw-bold me-3"
                                    style="width:45px;height:45px;">

                                    {{ strtoupper(substr($user->name,0,1)) }}

                                </div>

                                @endif

                                <div>
                                    <div class="fw-semibold">
                                        {{ $user->name }}
                                    </div>

                                    <small class="text-muted">
                                        {{ $user->email }}
                                    </small>

                                    @if($user->user_level === 'user')
                                        <div class="mt-1">
                                            @if($user->user_type === 'club')
                                                <small class="text-primary">
                                                    Club
                                                    @if($user->leader_name)
                                                        • Leader: {{ $user->leader_name }}
                                                    @endif
                                                </small>
                                            @else
                                                <small class="text-secondary">
                                                    Personal
                                                </small>
                                            @endif
                                        </div>
                                    @endif
                                </div>

                            </div>

                        </td>

                        <td>

                            {{ $user->phone ?: '-' }}

                        </td>

                        <td>

                            <span class="badge bg-{{
                                $user->user_level=='superadmin'
                                    ? 'dark'
                                    : ($user->user_level=='admin'
                                        ? 'danger'
                                        : 'secondary')
                            }}">

                                {{ ucfirst($user->user_level) }}

                            </span>

                        </td>

                        <td>

                            @if($user->is_event_organizer)

                                <span class="badge bg-success">

                                    Yes

                                </span>

                            @else

                                <span class="badge bg-light text-dark">

                                    No

                                </span>

                            @endif

                        </td>

                        <td>

                            <span class="badge bg-{{ $user->status=='active' ? 'success':'secondary' }}">

                                {{ ucfirst($user->status) }}

                            </span>

                        </td>

                        <td>

                            <div class="d-flex gap-2">

                                {{-- EDIT --}}

                                @if(
                                    auth()->id() != $user->id &&
                                    (
                                        auth()->user()->user_level == 'superadmin'
                                        || $user->user_level == 'user'
                                    )
                                )

                                <a
                                    href="{{ route('admin.users.edit',$user->id) }}"
                                    class="btn btn-sm btn-warning">

                                    <i class="bi bi-pencil"></i>

                                </a>

                                @endif


                                {{-- DELETE --}}

                                @if(
                                    auth()->id() != $user->id &&
                                    $user->user_level == 'user'
                                )

                                    <form
                                        method="POST"
                                        action="{{ route('admin.users.destroy',$user->id) }}"
                                        onsubmit="return confirm('Hapus user ini?')">

                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-sm btn-danger">

                                            <i class="bi bi-trash"></i>

                                        </button>

                                    </form>

                                @elseif(
                                    auth()->id() != $user->id &&
                                    auth()->user()->user_level == 'superadmin'
                                    && $user->user_level == 'admin'
                                )

                                    <form
                                        method="POST"
                                        action="{{ route('admin.users.destroy',$user->id) }}"
                                        onsubmit="return confirm('Hapus Admin ini?')">

                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-sm btn-danger">

                                            <i class="bi bi-trash"></i>

                                        </button>

                                    </form>

                                @endif

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="6" class="text-center py-5">

                            Tidak ada data user.

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

<script>

document.getElementById('searchUser').addEventListener('keyup',function(){

    let value=this.value.toLowerCase();

    document.querySelectorAll('#userTable tr').forEach(function(row){

        row.style.display=row.innerText.toLowerCase().includes(value)
            ?''
            :'none';

    });

});

document.getElementById('filterRole').addEventListener('change',function(){

    let role=this.value;

    document.querySelectorAll('#userTable tr').forEach(function(row){

        if(role===''){

            row.style.display='';

            return;

        }

        row.style.display=row.innerText.toLowerCase().includes(role)
            ?''
            :'none';

    });

});

</script>

@endsection
