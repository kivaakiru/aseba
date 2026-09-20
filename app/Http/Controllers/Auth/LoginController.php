<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        /*
        |----------------------------------------------------------
        | LOGIN KHUSUS USER (BUKAN ADMIN)
        |----------------------------------------------------------
        | Admin TIDAK BOLEH login lewat sini
        */
        if (Auth::attempt([
            'email' => $credentials['email'],
            'password' => $credentials['password'],
            'user_level' => 'user', // ✅ FIX
            'status' => 'active',
        ])) {
            $request->session()->regenerate();

            // login user → ke MAIN PAGE (sesuai request lu)
            return redirect()->route('main.home');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah, atau akun tidak memiliki akses sebagai user.',
        ])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('main.home');
    }
}
