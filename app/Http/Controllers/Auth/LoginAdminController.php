<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginAdminController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        // login pakai table users, tapi dibatasi admin
        if (
            Auth::attempt([
                'email' => $credentials['email'],
                'password' => $credentials['password'],
                'status' => 'active',
            ])
        ) {

            $request->session()->regenerate();

            if (!in_array(auth()->user()->user_level, ['admin', 'superadmin'])) {

                Auth::logout();

                return back()->withErrors([
                    'email' => 'Akun ini tidak memiliki akses Admin.',
                ]);

            }

            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors([
            'email' => 'Email atau password admin salah.',
        ])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // ✅ logout admin balik ke login admin
        return redirect()->route('admin.login');
    }
}
