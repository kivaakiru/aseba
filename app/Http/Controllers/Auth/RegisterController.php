<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * REGISTER PERSONAL
     */
    public function registerPersonal(Request $request)
    {
        $request->validate(
            [
                'name'     => 'required|string|max:255',
                'phone'    => 'required|string|max:20|unique:users,phone',
                'email'    => 'required|email|max:255|unique:users,email',
                'password' => 'required|min:6|confirmed',
            ],
            [
                'name.required'        => 'Nama wajib diisi.',

                'phone.required'       => 'Nomor HP wajib diisi.',
                'phone.unique'         => 'Nomor HP sudah digunakan.',
                'phone.max'            => 'Nomor HP maksimal 20 karakter.',

                'email.required'       => 'Email wajib diisi.',
                'email.email'          => 'Format email tidak valid.',
                'email.unique'         => 'Email sudah terdaftar.',

                'password.required'    => 'Password wajib diisi.',
                'password.min'         => 'Password minimal 6 karakter.',
                'password.confirmed'   => 'Konfirmasi password tidak sesuai.',
            ]
        );

        User::create([
            'name'               => $request->name,
            'leader_name'        => $request->name,
            'email'              => $request->email,
            'phone'              => $request->phone,
            'password'           => Hash::make($request->password),
            'photo'              => null,
            'user_type'          => 'personal',
            'user_level'         => 'user',
            'is_event_organizer' => 0,
            'status'             => 'active',
        ]);

        return redirect('/user/login')
            ->with('success', 'Pendaftaran akun personal berhasil.');
    }

    /**
     * REGISTER CLUB / COMMUNITY
     */
    public function registerClub(Request $request)
    {
        $request->validate(
            [
                'club_name'   => 'required|string|max:255',
                'leader_name' => 'required|string|max:255',
                'phone'       => 'required|string|max:20|unique:users,phone',
                'email'       => 'required|email|max:255|unique:users,email',
                'password'    => 'required|min:6|confirmed',
            ],
            [
                'club_name.required'   => 'Nama klub wajib diisi.',

                'leader_name.required' => 'Nama ketua klub wajib diisi.',

                'phone.required'       => 'Nomor HP wajib diisi.',
                'phone.unique'         => 'Nomor HP sudah digunakan.',
                'phone.max'            => 'Nomor HP maksimal 20 karakter.',

                'email.required'       => 'Email wajib diisi.',
                'email.email'          => 'Format email tidak valid.',
                'email.unique'         => 'Email sudah terdaftar.',

                'password.required'    => 'Password wajib diisi.',
                'password.min'         => 'Password minimal 6 karakter.',
                'password.confirmed'   => 'Konfirmasi password tidak sesuai.',
            ]
        );

        User::create([
            'name'               => $request->club_name,
            'leader_name'        => $request->leader_name,
            'email'              => $request->email,
            'phone'              => $request->phone,
            'password'           => Hash::make($request->password),
            'photo'              => null,
            'user_type'          => 'club',
            'user_level'         => 'user',
            'is_event_organizer' => 0,
            'status'             => 'active',
        ]);

        return redirect('/user/login')
            ->with('success', 'Pendaftaran akun klub / komunitas berhasil.');
    }
}
