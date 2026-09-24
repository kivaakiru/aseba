<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('profile_contacts', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Type
            |--------------------------------------------------------------------------
            | address
            | instagram
            | facebook
            | tiktok
            | youtube
            | x
            | whatsapp
            | telegram
            | email
            | website
            */

            $table->string('type', 30);

            /*
            |--------------------------------------------------------------------------
            | Label
            |--------------------------------------------------------------------------
            | Hanya digunakan untuk alamat:
            | contoh: ASEBA Basketball Home Court
            |
            | Sosial media tidak menggunakan label.
            */

            $table->string('label', 150)->nullable();

            /*
            |--------------------------------------------------------------------------
            | Value
            |--------------------------------------------------------------------------
            | Alamat:
            |   Jl. Aseba ...
            |
            | Sosial media:
            |   @asebabasketball
            |   aseba@gmail.com
            |   628123456789
            */

            $table->text('value');

            /*
            |--------------------------------------------------------------------------
            | Link
            |--------------------------------------------------------------------------
            | Alamat:
            |   Google Maps URL
            |
            | Sosial media:
            |   Instagram URL
            |   Facebook URL
            |   mailto:
            |   wa.me
            |   dll.
            */

            $table->text('link')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Sort Order
            |--------------------------------------------------------------------------
            */

            $table->unsignedSmallInteger('sort_order')
                ->default(0);

            $table->timestamps();

            $table->index([
                'type',
                'sort_order'
            ]);
        });
    }

    public function down()
    {
        Schema::dropIfExists('profile_contacts');
    }
};