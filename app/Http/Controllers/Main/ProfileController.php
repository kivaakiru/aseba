<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\ClubHistory;
use App\Models\ManagementBoard;
use App\Models\GalleryAlbum;

class ProfileController extends Controller
{
    /**
     * ==========================================================
     * PROFILE MAIN PAGE
     * ==========================================================
     */
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | CLUB HISTORY
        |--------------------------------------------------------------------------
        | Main Page:
        | Tahun paling lama → paling baru.
        */

        $histories = ClubHistory::orderBy('year')
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | MANAGEMENT BOARD
        |--------------------------------------------------------------------------
        | Hanya anggota aktif.
        */

        $managementBoards = ManagementBoard::where(
                'is_active',
                true
            )
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | GALLERY ALBUM
        |--------------------------------------------------------------------------
        | Profile Main Page hanya menampilkan maksimal 4 album.
        |
        | Cover album menggunakan latestPhoto.
        */

        $albums = GalleryAlbum::with('latestPhoto')
            ->withCount('photos')
            ->orderByDesc('created_at')
            ->take(4)
            ->get();


        return view(
            'main.profil.profil',
            compact(
                'histories',
                'managementBoards',
                'albums'
            )
        );
    }
}