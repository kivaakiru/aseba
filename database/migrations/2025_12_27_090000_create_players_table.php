<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayersTable extends Migration
{
    public function up()
    {
        Schema::create('players', function (Blueprint $table) {
            $table->id();

            // FOTO PEMAIN
            $table->string('photo')->nullable();

            // IDENTITAS UTAMA
            $table->string('full_name');
            $table->string('jersey_name');
            $table->unsignedInteger('jersey_number');

            // DATA LAHIR
            $table->date('date_of_birth');
            $table->unsignedTinyInteger('age');

            // POSISI
            $table->string('position', 10);

            // FISIK (OPSIONAL)
            $table->unsignedSmallInteger('height')->nullable(); // cm
            $table->unsignedSmallInteger('weight')->nullable(); // kg

            // STATUS
            $table->enum('status', ['active', 'inactive'])->default('active');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('players');
    }
}
