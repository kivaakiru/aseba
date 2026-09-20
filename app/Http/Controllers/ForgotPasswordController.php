<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    public function showRequestForm(){
        return view("auth.forgot-password");
    }

 public function sendResetEmail(Request $request){
    $request->validate(['email' => 'required|email' ]);

    Config::set('auth.passwords.users.expire', 60); 

    $response = Password::sendResetLink(
        $request->only('email'),
        function ($user, $token) {
            $user->sendPasswordResetNotification($token);
        }
    );

    if ($response == Password::RESET_LINK_SENT){
        return back()->with('status', __($response));
    } else {
        return back()->withErrors(['email' => __($response)]);
    }
}
    public function resetPassword(Request $request){
        $request->validate(['token' => 'required', 
        'email'=> 'required|email',
        'password'=> 'required|confirmed|min:8']);

        $status = Password::reset($request->only('email', 'password', 'password_confirmation', 'token'),
        function($user, $password){
            $user->password = bcrypt($password);
            $user->save();
            }
        );

        return $status == Password::PASSWORD_RESET
        ? redirect()->route('user.login')->with('success', __($status))
        : back()->withErrors(['email' => [__($status)]]);
    }
}



