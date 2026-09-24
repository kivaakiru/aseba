<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginAdminController;

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PlayerController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\ReportController;

use App\Http\Controllers\Admin\Aseba\GalleryController;
use App\Http\Controllers\Admin\Aseba\ProfileController;
use App\Http\Controllers\Admin\Aseba\ProfileContactController;


/*
|--------------------------------------------------------------------------
| ADMIN AUTH
|--------------------------------------------------------------------------
*/

Route::get('/admin/login', function () {

    if (auth()->check()) {
        return redirect()->route('admin.dashboard');
    }

    return app(LoginAdminController::class)->showLoginForm();

})->name('admin.login');


Route::post('/admin/login', [LoginAdminController::class, 'login'])
    ->name('admin.login.store');


Route::post('/admin/logout', [LoginAdminController::class, 'logout'])
    ->name('admin.logout');


/*
|--------------------------------------------------------------------------
| ADMIN AREA
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {


        /*
        |--------------------------------------------------------------------------
        | DASHBOARD
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/dashboard',
            [DashboardController::class, 'index']
        )->name('dashboard');


        /*
        |--------------------------------------------------------------------------
        | USERS
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'users',
            UserController::class
        )->except([
            'show'
        ]);


        /*
        |--------------------------------------------------------------------------
        | PLAYERS
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/players/export',
            [PlayerController::class, 'export']
        )->name('players.export');

        Route::resource(
            'players',
            PlayerController::class
        );


        /*
        |--------------------------------------------------------------------------
        | TEAMS
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'teams',
            TeamController::class
        );


        /*
        |--------------------------------------------------------------------------
        | PROFILE ASEBA
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/profile',
            [ProfileController::class, 'index']
        )->name('aseba.profile');


        /*
        |--------------------------------------------------------------------------
        | PROFILE - MANAGEMENT BOARD
        |--------------------------------------------------------------------------
        */

        Route::post(
            '/profile/management',
            [ProfileController::class, 'storeManagement']
        )->name('aseba.profile.management.store');

        Route::put(
            '/profile/management/{id}',
            [ProfileController::class, 'updateManagement']
        )->name('aseba.profile.management.update');

        Route::delete(
            '/profile/management/{id}',
            [ProfileController::class, 'destroyManagement']
        )->name('aseba.profile.management.destroy');

        Route::patch(
            '/profile/management/{id}/toggle',
            [ProfileController::class, 'toggleManagement']
        )->name('aseba.profile.management.toggle');


        /*
        |--------------------------------------------------------------------------
        | PROFILE - CLUB HISTORY
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/profile/history',
            [ProfileController::class, 'history']
        )->name('aseba.profile.history');

        Route::get(
            '/profile/history/create',
            [ProfileController::class, 'createHistory']
        )->name('aseba.profile.history.create');

        Route::post(
            '/profile/history',
            [ProfileController::class, 'storeHistory']
        )->name('aseba.profile.history.store');

        Route::get(
            '/profile/history/{id}/edit',
            [ProfileController::class, 'editHistory']
        )->name('aseba.profile.history.edit');

        Route::put(
            '/profile/history/{id}',
            [ProfileController::class, 'updateHistory']
        )->name('aseba.profile.history.update');

        Route::delete(
            '/profile/history/{id}',
            [ProfileController::class, 'destroyHistory']
        )->name('aseba.profile.history.destroy');


        /*
        |--------------------------------------------------------------------------
        | PROFILE - MANAGEMENT PAGE
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/profile/management',
            [ProfileController::class, 'management']
        )->name('aseba.profile.management');

        Route::get(
            '/profile/management/{id}/edit',
            [ProfileController::class, 'editManagement']
        )->name('aseba.profile.management.edit');


        /*
        |--------------------------------------------------------------------------
        | PROFILE - ACHIEVEMENTS
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/profile/achievements',
            [ProfileController::class, 'achievements']
        )->name('aseba.profile.achievements');

        Route::get(
            '/profile/achievements/create',
            [ProfileController::class, 'createAchievement']
        )->name('aseba.profile.achievements.create');

        Route::post(
            '/profile/achievements',
            [ProfileController::class, 'storeAchievement']
        )->name('aseba.profile.achievements.store');

        Route::get(
            '/profile/achievements/{id}/edit',
            [ProfileController::class, 'editAchievement']
        )->name('aseba.profile.achievements.edit');

        Route::put(
            '/profile/achievements/{id}',
            [ProfileController::class, 'updateAchievement']
        )->name('aseba.profile.achievements.update');

        Route::delete(
            '/profile/achievements/{id}',
            [ProfileController::class, 'destroyAchievement']
        )->name('aseba.profile.achievements.destroy');


        /*
        |--------------------------------------------------------------------------
        | PROFILE - KONTAK & SOSIAL MEDIA
        |--------------------------------------------------------------------------
        */

        Route::prefix('profile/kontak')
            ->name('aseba.profile.contact.')
            ->controller(ProfileContactController::class)
            ->group(function () {

                Route::get(
                    '/',
                    'index'
                )->name('index');

                Route::post(
                    '/address',
                    'storeAddress'
                )->name('address.store');

                Route::post(
                    '/social',
                    'storeSocial'
                )->name('social.store');

                Route::put(
                    '/{id}',
                    'update'
                )->name('update');

                Route::delete(
                    '/{id}',
                    'destroy'
                )->name('destroy');

                Route::post(
                    '/reorder',
                    'reorder'
                )->name('reorder');
            });


        /*
        |--------------------------------------------------------------------------
        | GALLERY ASEBA
        |--------------------------------------------------------------------------
        */

        Route::prefix('gallery')
            ->name('gallery.')
            ->controller(GalleryController::class)
            ->group(function () {


                /*
                |--------------------------------------------------------------------------
                | Album
                |--------------------------------------------------------------------------
                */

                Route::get(
                    '/',
                    'index'
                )->name('index');

                Route::get(
                    '/create',
                    'create'
                )->name('create');

                Route::post(
                    '/',
                    'store'
                )->name('store');

                Route::get(
                    '/edit/{id}',
                    'edit'
                )->name('edit');

                Route::put(
                    '/{id}',
                    'update'
                )->name('update');

                Route::get(
                    '/show/{id}',
                    'show'
                )->name('show');

                Route::delete(
                    '/{id}',
                    'destroy'
                )->name('destroy');


                /*
                |--------------------------------------------------------------------------
                | Foto dalam Album
                |--------------------------------------------------------------------------
                */

                Route::post(
                    '/{id}/photos',
                    'storePhotos'
                )->name('photos.store');

                Route::delete(
                    '/{albumId}/photos/{photoId}',
                    'destroyPhoto'
                )->name('photos.destroy');
            });


        /*
        |--------------------------------------------------------------------------
        | COURTS
        |--------------------------------------------------------------------------
        */

        Route::prefix('courts')
            ->name('courts.')
            ->group(function () {


                /*
                |--------------------------------------------------------------------------
                | Booking
                |--------------------------------------------------------------------------
                */

                Route::get(
                    '/bookings',
                    [BookingController::class, 'index']
                )->name('bookings');

                Route::get(
                    '/bookings/create',
                    [BookingController::class, 'create']
                )->name('bookings.create');

                Route::post(
                    '/bookings',
                    [BookingController::class, 'store']
                )->name('bookings.store');

                Route::get(
                    '/bookings/{booking}',
                    [BookingController::class, 'show']
                )->name('bookings.show');

                Route::get(
                    '/bookings/{booking}/edit',
                    [BookingController::class, 'edit']
                )->name('bookings.edit');

                Route::put(
                    '/bookings/{booking}',
                    [BookingController::class, 'update']
                )->name('bookings.update');

                Route::delete(
                    '/bookings/{booking}',
                    [BookingController::class, 'destroy']
                )->name('bookings.destroy');


                /*
                |--------------------------------------------------------------------------
                | Approval
                |--------------------------------------------------------------------------
                */

                Route::get(
                    '/approval',
                    [BookingController::class, 'approval']
                )->name('approval');

                Route::patch(
                    '/approval/{booking}/approve',
                    [BookingController::class, 'approve']
                )->name('approve');

                Route::patch(
                    '/approval/{booking}/reject',
                    [BookingController::class, 'reject']
                )->name('reject');

                Route::patch(
                    '/approval/{booking}/confirm-payment',
                    [BookingController::class, 'confirmPayment']
                )->name('confirmPayment');


                /*
                |--------------------------------------------------------------------------
                | History
                |--------------------------------------------------------------------------
                */

                Route::get(
                    '/history',
                    [BookingController::class, 'history']
                )->name('history');


                /*
                |--------------------------------------------------------------------------
                | Settings
                |--------------------------------------------------------------------------
                */

                Route::get(
                    '/settings',
                    [BookingController::class, 'settings']
                )->name('settings');

                Route::post(
                    '/settings',
                    [BookingController::class, 'storeSetting']
                )->name('settings.store');

                Route::get(
                    '/settings/{schedule}/edit',
                    [BookingController::class, 'editSetting']
                )->name('settings.edit');

                Route::put(
                    '/settings/{schedule}',
                    [BookingController::class, 'updateSetting']
                )->name('settings.update');

                Route::delete(
                    '/settings/{schedule}',
                    [BookingController::class, 'destroySetting']
                )->name('settings.destroy');

                Route::patch(
                    '/settings/{schedule}/toggle',
                    [BookingController::class, 'toggleSetting']
                )->name('settings.toggle');

                Route::get(
                    '/master-schedules',
                    [BookingController::class, 'masterSchedules']
                )->name('masterSchedules');
            });


        /*
        |--------------------------------------------------------------------------
        | REPORTS
        |--------------------------------------------------------------------------
        */

        Route::prefix('reports')
            ->name('reports.')
            ->group(function () {

                Route::get(
                    '/',
                    [ReportController::class, 'index']
                )->name('index');

                Route::get(
                    '/reservation',
                    [ReportController::class, 'reservation']
                )->name('reservation');
            });


        /*
        |--------------------------------------------------------------------------
        | LOGS
        |--------------------------------------------------------------------------
        */

        Route::prefix('logs')
            ->name('logs.')
            ->group(function () {

                Route::view(
                    '/',
                    'admin.logs.activity_logs'
                )->name('index');
            });


        /*
        |--------------------------------------------------------------------------
        | ADMIN SETTINGS
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/settings',
            [SettingsController::class, 'index']
        )->name('settings.index');

        Route::put(
            '/settings',
            [SettingsController::class, 'update']
        )->name('settings.update');

    });