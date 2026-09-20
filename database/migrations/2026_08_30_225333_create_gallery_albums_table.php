<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGalleryAlbumsTable extends Migration
{
    public function up()
    {
        Schema::create('gallery_albums', function (Blueprint $table) {

            $table->id();

            // Nama album
            $table->string('name');

            // URL-friendly
            $table->string('slug')->unique();

            // Deskripsi album
            $table->text('description')->nullable();

            // Training / Tournament / Event / Achievement
            $table->string('category')->default('Training');

            // Tanggal kegiatan
            $table->date('album_date')->nullable();

            /*
             * Cover manual bersifat OPSIONAL.
             *
             * Jika NULL:
             * sistem akan mengambil foto TERBARU
             * dari gallery_photos sebagai cover.
             */
            $table->string('cover')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('gallery_albums');
    }
}