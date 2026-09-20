<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\BookingController;
use App\Http\Controllers\ForgotPasswordController;

/*
|--------------------------------------------------------------------------
| LOGIN ALIAS
|--------------------------------------------------------------------------
*/

Route::get('/login', function () {

        if (auth()->check()) {
            return redirect()->route('user.dashboard');
        }

        return redirect('/user/login');

    })->name('login');

/*
|--------------------------------------------------------------------------
| USER AUTH VIEW
|--------------------------------------------------------------------------
*/

Route::get('/user/reset-password/{token}', function ($token) {
    return view('user.auth.reset_password', ['token' => $token]);
})->name('password.reset');

Route::prefix('user')->name('user.')->group(function () {

    Route::view('/forgot-password', 'user.auth.forgot_password')
        ->name('forgot-password');

    Route::get('/login', function () {

        if (auth()->check()) {
            return redirect()->route('user.dashboard');
        }

        return view('user.auth.login');

    })->name('login');

    Route::prefix('register')->name('register.')->group(function () {

        Route::view('/personal', 'user.auth.register_personal')
            ->name('personal');

        Route::view('/club', 'user.auth.register_club')
            ->name('club');
    });
});

/*
|--------------------------------------------------------------------------
| USER AUTH ACTION
|--------------------------------------------------------------------------
*/

Route::post('/user/register/personal', [RegisterController::class, 'registerPersonal'])
    ->name('user.register.personal.store');

Route::post('/user/register/club', [RegisterController::class, 'registerClub'])
    ->name('user.register.club.store');

Route::post('/user/login', [LoginController::class, 'login'])
    ->name('user.login.store');

Route::post('/user/send-reset-email', [ForgotPasswordController::class, 'sendResetEmail'])
    ->name('user.forgot.password.send');

Route::post('/user/update-password', [ForgotPasswordController::class, 'resetPassword'])
    ->name('user.reset.password');

Route::post('/logout', [LoginController::class, 'logout'])
    ->name('logout');

/*
|--------------------------------------------------------------------------
| USER AREA
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'user'])
    ->group(function () {

        Route::get(
            '/user/dashboard',
            [\App\Http\Controllers\User\DashboardController::class,'index']
        )->name('user.dashboard');

        Route::prefix('user/booking')
        ->name('user.booking.')
        ->group(function () {

            Route::get(
                '/',
                [BookingController::class, 'index']
            )->name('index');

            Route::post(
                '/store',
                [BookingController::class, 'store']
            )->name('store');

            Route::view(
                '/create',
                'user.booking.create'
            )->name('create');

            Route::get(
                '/detail/{id}',
                [BookingController::class, 'detail']
            )->name('detail');

            Route::get(
                '/history',
                [BookingController::class, 'history']
            )->name('history');

        });



        Route::prefix('user/profile')->name('user.profile.')->group(function () {

            Route::view('/', 'user.profile.index')->name('index');
            Route::view('/edit', 'user.profile.edit')->name('edit');

            Route::put('/update', [ProfileController::class, 'update'])
                ->name('update');
        });
    });
