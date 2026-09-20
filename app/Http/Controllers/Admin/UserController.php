<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('user_level')->orderBy('name')->get();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'      => 'required|string',
            'email'     => 'required|email|unique:users',
            'password'  => 'required|min:6|confirmed', // ✅ FIX: harus sama dengan konfirmasi
            'phone'       => 'nullable|string',
            'user_type'   => 'required|in:personal,club',
            'leader_name' => 'nullable|string',
            'user_level'  => 'required|in:user,admin,superadmin',
            'photo'=>'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $photo = null;

        if($request->hasFile('photo')){

            $photo = time().'_'.$request->photo->getClientOriginalName();

            $request->photo->storeAs('users',$photo,'public');

        }
        if (
            auth()->user()->user_level !== 'superadmin'
            && $request->user_level !== 'user'
        ) {
            abort(403);
        }

        User::create([
            'name'               => $data['name'],
            'leader_name'         => $data['user_type'] === 'club'
                ? ($data['leader_name'] ?? null)
                : null,
            'email'              => $data['email'],
            'password'           => Hash::make($data['password']),
            'phone'              => $data['phone'] ?? null,
            'user_type'          => $data['user_type'],
            'user_level' => $request->user_level ?? 'user',
            'is_event_organizer' => $request->has('is_event_organizer') ? 1 : 0, // ✅ FIX
            'status'             => 'active',
            'photo'=>$photo,
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil ditambahkan');
    }

    public function edit(User $user)
    {
        if (
            auth()->user()->user_level !== 'superadmin'
            && $user->user_level !== 'user'
        ) {
            abort(403);
        }

        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        if (
            auth()->user()->user_level !== 'superadmin'
            && $user->user_level !== 'user'
        ) {
            abort(403);
        }
        $data = $request->validate([
            'user_level' => 'nullable|in:user,admin,superadmin',
            'name'      => 'required|string',
            'phone'       => 'nullable|string',
            'status'      => 'required|in:active,inactive',
            'password'    => 'nullable|confirmed|min:6',
            'user_type'   => 'nullable|in:personal,club',
            'leader_name' => 'nullable|string',
            'photo'=>'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $user->name   = $data['name'];
        $user->phone  = $data['phone'] ?? null;
        $user->status = $data['status'];
        $user->leader_name = ($data['user_type'] ?? $user->user_type) === 'club'
            ? ($data['leader_name'] ?? null)
            : null;
        if (auth()->user()->user_level === 'superadmin') {

            if (
                auth()->id() == $user->id
                && $data['user_level'] != 'superadmin'
            ) {

                return back()->with(
                    'error',
                    'Super Admin tidak dapat mengubah role akunnya sendiri.'
                );

            }

            $user->user_level = $data['user_level'];

        }

        // ❗ ADMIN TIDAK PUNYA TIPE AKUN
        if ($user->user_level !== 'admin') {
            $user->user_type = $data['user_type'] ?? $user->user_type;
            $user->is_event_organizer = $request->has('is_event_organizer') ? 1 : 0;
        }

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }


        if ($request->hasFile('photo')) {

            if ($user->photo && file_exists(public_path('storage/users/'.$user->photo))) {

                unlink(public_path('storage/users/'.$user->photo));

            }

            $photo = time().'_'.$request->file('photo')->getClientOriginalName();

            $request->file('photo')->move(
                public_path('storage/users'),
                $photo
            );

            $user->photo = $photo;
        }

        $user->save();

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil diperbarui');
    }

    public function destroy(User $user)
    {
        if (
            $user->user_level == 'superadmin'
            && auth()->id() == $user->id
        ) {

            return back()->with(
                'error',
                'Anda tidak dapat menghapus akun Super Admin yang sedang digunakan.'
            );

        }
        $totalSuperAdmin = User::where(
            'user_level',
            'superadmin'
        )->count();

        if (
            $user->user_level == 'superadmin'
            && $totalSuperAdmin <= 1
        ) {

            return back()->with(
                'error',
                'Minimal harus ada satu akun Super Admin.'
            );

        }

        if(
            auth()->user()->user_level !== 'superadmin'
            && $user->user_level === 'admin'
        ){

            return back()->with('error','Admin tidak dapat menghapus admin lain.');

        }
        $user->delete();

        return back()->with('success', 'User berhasil dihapus');
    }
}
