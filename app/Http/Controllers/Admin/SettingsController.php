<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    public function index()
    {
        return view('admin.settings.index');
    }

    public function update(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'password' => 'nullable|min:6|same:password_confirmation',
        ]);

        $user->name = $data['name'];
        $user->phone = $data['phone'] ?? null;

        if ($request->filled('password')) {

            if ($request->password !== $request->password_confirmation) {

                return back()
                    ->withErrors([
                        'password' => 'Konfirmasi password tidak sesuai.'
                    ])
                    ->withInput();

            }

            $user->password = Hash::make($request->password);

        }

        if ($request->hasFile('photo')) {

            if (
                $user->photo &&
                file_exists(public_path('storage/users/'.$user->photo))
            ) {
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

        return back()->with(
            'success',
            'Profil berhasil diperbarui.'
        );
    }
}
