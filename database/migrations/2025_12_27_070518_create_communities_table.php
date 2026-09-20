<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommunitiesTable extends Migration
{
    public function up()
    {
        Schema::create('communities', function (Blueprint $table) {
            $table->id();

            // WAJIB bigInteger + unsigned
            $table->unsignedBigInteger('user_id');

            $table->string('club_name');
            $table->string('leader_name');
            $table->string('leader_phone')->nullable();
            $table->enum('club_type', ['Klub', 'Komunitas', 'Sekolah Basket'])->nullable();

            $table->timestamps();

            // FK MANUAL (AMAN)
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('communities');
    }
}


