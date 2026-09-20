<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GalleryPhoto extends Model
{
    use HasFactory;

    protected $table = 'gallery_photos';

    protected $fillable = [
        'gallery_album_id',
        'photo',
        'title',
        'description',
        'sort_order',
    ];

    /**
     * Foto milik satu album.
     */
    public function album()
    {
        return $this->belongsTo(
            GalleryAlbum::class,
            'gallery_album_id'
        );
    }
}