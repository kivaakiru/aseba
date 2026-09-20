<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GalleryAlbum extends Model
{
    use HasFactory;

    protected $table = 'gallery_albums';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'category',
        'album_date',
        'cover',
    ];

    protected $casts = [
        'album_date' => 'date',
    ];

    /**
     * Album mempunyai banyak foto.
     */
    public function photos()
    {
        return $this->hasMany(
            GalleryPhoto::class,
            'gallery_album_id'
        );
    }

    /**
     * Foto terbaru dijadikan cover otomatis
     * jika album tidak mempunyai cover manual.
     */
    public function latestPhoto()
    {
        return $this->hasOne(
            GalleryPhoto::class,
            'gallery_album_id'
        )->latestOfMany();
    }

    /**
     * Cover album.
     *
     * Prioritas:
     *
     * 1. cover manual
     * 2. foto terakhir yang di-upload
     */
    public function getCoverPhotoAttribute()
    {
        if ($this->cover) {
            return $this->cover;
        }

        return optional($this->latestPhoto)->photo;
    }
}