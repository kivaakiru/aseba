<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGalleryPhotosTable extends Migration
{
    public function up()
    {
        Schema::create('gallery_photos', function (Blueprint $table) {

            $table->id();

            /*
             * Album induk.
             *
             * Jika album dihapus,
             * seluruh fotonya ikut dihapus.
             */
            $table->foreignId('gallery_album_id')
                ->constrained('gallery_albums')
                ->cascadeOnDelete();

            // Lokasi file foto
            $table->string('photo');

            // Judul foto opsional
            $table->string('title')->nullable();

            // Keterangan foto opsional
            $table->text('description')->nullable();

            // Urutan foto jika nanti diperlukan
            $table->unsignedInteger('sort_order')
                ->default(0);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('gallery_photos');
    }
}