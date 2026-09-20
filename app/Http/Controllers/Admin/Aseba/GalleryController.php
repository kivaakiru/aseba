<?php

namespace App\Http\Controllers\Admin\Aseba;

use App\Http\Controllers\Controller;
use App\Models\GalleryAlbum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GalleryController extends Controller
{
    /**
     * ==========================================================
     * GALLERY INDEX
     * ==========================================================
     */
    public function index()
    {
        $albums = GalleryAlbum::with('latestPhoto')
            ->withCount('photos')
            ->orderByDesc('created_at')
            ->get();

        return view(
            'admin.gallery.index',
            compact('albums')
        );
    }


    /**
     * ==========================================================
     * CREATE ALBUM
     * ==========================================================
     */
    public function create()
    {
        return view('admin.gallery.create');
    }


    /**
     * ==========================================================
     * STORE ALBUM
     * ==========================================================
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => [
                'required',
                'string',
                'max:150',
            ],

            'description' => [
                'nullable',
                'string',
                'max:1000',
            ],

            'album_date' => [
                'nullable',
                'date',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | SLUG
        |--------------------------------------------------------------------------
        */

        $slug = Str::slug($data['name']);

        $originalSlug = $slug;

        $counter = 1;

        while (
            GalleryAlbum::where('slug', $slug)->exists()
        ) {
            $slug = $originalSlug . '-' . $counter;

            $counter++;
        }


        /*
        |--------------------------------------------------------------------------
        | CREATE ALBUM
        |--------------------------------------------------------------------------
        |
        | Tidak ada kategori.
        | Tidak ada foto pada saat membuat album.
        |
        */

        $album = GalleryAlbum::create([
            'name' => $data['name'],

            'slug' => $slug,

            'description' =>
                $data['description'] ?? null,

            'album_date' =>
                $data['album_date'] ?? null,

            /*
             * Kolom cover tetap dibiarkan null.
             * Cover akan menggunakan foto terbaru
             * melalui relationship latestPhoto.
             */
            'cover' => null,
        ]);


        return redirect()
            ->route(
                'admin.gallery.show',
                $album->id
            )
            ->with(
                'success',
                'Album berhasil dibuat. Silakan tambahkan foto.'
            );
    }


    /**
     * ==========================================================
     * SHOW ALBUM
     * ==========================================================
     */
    public function show($id)
    {
        $album = GalleryAlbum::with([
            'photos' => function ($query) {
                $query->orderByDesc('created_at');
            }
        ])->findOrFail($id);


        return view(
            'admin.gallery.show',
            compact('album')
        );
    }


    /**
     * ==========================================================
     * EDIT ALBUM
     * ==========================================================
     */
    public function edit($id)
    {
        $album = GalleryAlbum::findOrFail($id);

        return view(
            'admin.gallery.edit',
            compact('album')
        );
    }


    /**
     * ==========================================================
     * UPDATE ALBUM
     * ==========================================================
     */
    public function update(
        Request $request,
        $id
    ) {
        $album = GalleryAlbum::findOrFail($id);


        $data = $request->validate([
            'name' => [
                'required',
                'string',
                'max:150',
            ],

            'description' => [
                'nullable',
                'string',
                'max:1000',
            ],

            'album_date' => [
                'nullable',
                'date',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | SLUG
        |--------------------------------------------------------------------------
        */

        $slug = Str::slug($data['name']);

        $originalSlug = $slug;

        $counter = 1;

        while (
            GalleryAlbum::where('slug', $slug)
                ->where('id', '!=', $album->id)
                ->exists()
        ) {
            $slug = $originalSlug . '-' . $counter;

            $counter++;
        }


        /*
        |--------------------------------------------------------------------------
        | UPDATE
        |--------------------------------------------------------------------------
        */

        $album->update([
            'name' =>
                $data['name'],

            'slug' =>
                $slug,

            'description' =>
                $data['description'] ?? null,

            'album_date' =>
                $data['album_date'] ?? null,
        ]);


        return redirect()
            ->route(
                'admin.gallery.show',
                $album->id
            )
            ->with(
                'success',
                'Album berhasil diperbarui.'
            );
    }

    /**
     * ==========================================================
     * STORE PHOTO
     * ==========================================================
     */
    public function storePhoto(Request $request, $album)
    {
        $album = GalleryAlbum::findOrFail($album);

        $request->validate([
            'photos' => [
                'required',
                'array',
                'min:1',
            ],

            'photos.*' => [
                'required',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:10240',
            ],
        ]);

        foreach ($request->file('photos') as $file) {

            $path = $file->store(
                'gallery/photos',
                'public'
            );

            $album->photos()->create([
                'photo' => $path,
            ]);
        }

        return redirect()
            ->route('admin.gallery.show', $album->id)
            ->with(
                'success',
                'Foto berhasil ditambahkan ke album.'
            );
    }


    /**
     * ==========================================================
     * DELETE ALBUM
     * ==========================================================
     */
    public function destroy($id)
    {
        $album = GalleryAlbum::with('photos')
            ->findOrFail($id);


        /*
        |--------------------------------------------------------------------------
        | DELETE COVER
        |--------------------------------------------------------------------------
        */

        if (
            $album->cover &&
            Storage::disk('public')
                ->exists($album->cover)
        ) {
            Storage::disk('public')
                ->delete($album->cover);
        }


        /*
        |--------------------------------------------------------------------------
        | DELETE PHOTOS
        |--------------------------------------------------------------------------
        */

        foreach ($album->photos as $photo) {

            if (
                $photo->photo &&
                Storage::disk('public')
                    ->exists($photo->photo)
            ) {
                Storage::disk('public')
                    ->delete($photo->photo);
            }
        }


        /*
        |--------------------------------------------------------------------------
        | DELETE ALBUM
        |--------------------------------------------------------------------------
        */

        $album->delete();


        return redirect()
            ->route('admin.gallery.index')
            ->with(
                'success',
                'Album berhasil dihapus.'
            );
    }


    /**
     * ==========================================================
     * STORE PHOTOS
     * ==========================================================
     */
    public function storePhotos(
        Request $request,
        $id
    ) {
        $album = GalleryAlbum::findOrFail($id);


        $request->validate([
            'photos' => [
                'required',
                'array',
                'min:1',
            ],

            'photos.*' => [
                'required',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:10240',
            ],
        ]);


        foreach ($request->file('photos') as $file) {

            /*
             * Gunakan relationship album->photos
             * sehingga foreign key mengikuti konfigurasi
             * relationship model.
             */

            $photo = $album->photos()->make();

            $photo->photo = $file->store(
                'gallery/photos',
                'public'
            );

            $photo->save();
        }


        return redirect()
            ->route(
                'admin.gallery.show',
                $album->id
            )
            ->with(
                'success',
                'Foto berhasil ditambahkan ke album.'
            );
    }


    /**
     * ==========================================================
     * DELETE PHOTO
     * ==========================================================
     */
    public function destroyPhoto(
        $albumId,
        $photoId
    ) {
        $album = GalleryAlbum::findOrFail($albumId);

        $photo = $album->photos()
            ->where('id', $photoId)
            ->firstOrFail();


        /*
        |--------------------------------------------------------------------------
        | DELETE FILE
        |--------------------------------------------------------------------------
        */

        if (
            $photo->photo &&
            Storage::disk('public')
                ->exists($photo->photo)
        ) {
            Storage::disk('public')
                ->delete($photo->photo);
        }


        /*
        |--------------------------------------------------------------------------
        | DELETE DATABASE
        |--------------------------------------------------------------------------
        */

        $photo->delete();


        return back()
            ->with(
                'success',
                'Foto berhasil dihapus.'
            );
    }
}