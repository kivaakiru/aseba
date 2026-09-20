<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Main\HomeController;
use App\Http\Controllers\Main\ScheduleController;
use App\Http\Controllers\Main\RosterController;
use App\Http\Controllers\Main\ProfileController;
use App\Http\Controllers\Main\GalleryController;


/*
|--------------------------------------------------------------------------
| MAIN PAGE
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])
    ->name('main.home');

Route::get('/jadwal', [ScheduleController::class, 'index'])
    ->name('main.jadwal');

Route::view('/berita', 'main.berita.berita')
    ->name('main.berita');

/*
|--------------------------------------------------------------------------
| ROSTER ASEBA
|--------------------------------------------------------------------------
*/

Route::get('/roster', [RosterController::class, 'index'])
    ->name('main.roster');

/*
|--------------------------------------------------------------------------
| DETAIL PLAYER
|--------------------------------------------------------------------------
*/

Route::get('/roster/{slug}', [RosterController::class, 'detail'])
    ->name('main.roster.detail');

Route::get('/profil', [ProfileController::class, 'index'])
    ->name('main.profil');

/*
|--------------------------------------------------------------------------
| LEGACY ROUTES
|--------------------------------------------------------------------------
*/

Route::view('/event', 'main.event.event')
    ->name('main.event');



Route::view('/profil-aseba', 'main.profile.profile')
    ->name('main.profile');

Route::view('/profil-aseba/anggota', 'main.daftar-anggota.daftar-anggota')
    ->name('main.anggota');

Route::view('/profil-aseba/tim', 'main.daftar-tim.daftar-tim')
    ->name('main.tim');

    /*
|--------------------------------------------------------------------------
| Gallery
|--------------------------------------------------------------------------
*/

Route::get(
    '/galeri',
    [GalleryController::class, 'index']
)->name('main.galeri');

Route::get(
    '/galeri/{slug}',
    [GalleryController::class, 'show']
)->name('main.galeri.show');
