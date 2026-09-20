<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\GalleryAlbum;

class GalleryController extends Controller
{
    /**
     * ==========================================================
     * GALLERY MAIN PAGE
     * ==========================================================
     */
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | ALBUM GALLERY
        |--------------------------------------------------------------------------
        | Main Page hanya menampilkan maksimal 4 album.
        |
        | latestPhoto digunakan sebagai cover album.
        */

        $albums = GalleryAlbum::with('latestPhoto')
            ->withCount('photos')
            ->orderByDesc('created_at')
            ->take(4)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | TOTAL ALBUM
        |--------------------------------------------------------------------------
        | Digunakan untuk menentukan apakah tombol
        | "View All Gallery" perlu ditampilkan.
        */

        $totalAlbums = GalleryAlbum::count();


        return view(
            'main.galeri.galeri',
            compact(
                'albums',
                'totalAlbums'
            )
        );
    }


    /**
     * ==========================================================
     * DETAIL ALBUM
     * ==========================================================
     */
    public function show($slug)
    {
        $album = GalleryAlbum::with([
            'photos' => function ($query) {
                $query
                    ->orderByDesc('created_at')
                    ->orderByDesc('id');
            }
        ])
        ->where('slug', $slug)
        ->firstOrFail();


        return view(
            'main.galeri.show',
            compact('album')
        );
    }
}