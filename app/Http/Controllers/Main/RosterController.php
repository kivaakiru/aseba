<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Player;
use App\Models\Team;
use Illuminate\Support\Str;

class RosterController extends Controller
{
    /**
     * ==========================================================
     * ROSTER MAIN PAGE
     * ==========================================================
     */
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | AMBIL SEMUA TIM DARI DATABASE
        |--------------------------------------------------------------------------
        */
        $teams = Team::orderBy('name')->get();

        /*
        |--------------------------------------------------------------------------
        | AMBIL SEMUA PLAYER AKTIF
        |--------------------------------------------------------------------------
        |
        | Player diambil berdasarkan database.
        | Relasi team ikut di-load supaya nama tim bisa langsung digunakan
        | di Blade.
        |
        */
        $players = Player::with('team')
            ->where('status', 'active')
            ->whereNotNull('team_id')
            ->orderBy('full_name')
            ->get();

        return view(
            'main.roster.roster',
            compact(
                'teams',
                'players'
            )
        );
    }

    /**
     * ==========================================================
     * DETAIL PLAYER
     * ==========================================================
     */
    public function detail($slug)
    {
        /*
        |--------------------------------------------------------------------------
        | CARI PLAYER BERDASARKAN SLUG NAMA
        |--------------------------------------------------------------------------
        */
        $players = Player::with('team')
            ->where('status', 'active')
            ->whereNotNull('team_id')
            ->get();

        $player = $players->first(function ($item) use ($slug) {
            return Str::slug($item->full_name) === $slug;
        });

        abort_if(!$player, 404);

        return view(
            'main.roster.detail',
            compact('player')
        );
    }
}
