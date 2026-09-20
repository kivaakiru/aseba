<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('club_histories', function (Blueprint $table) {
            $table->unsignedSmallInteger('id')->autoIncrement();

            $table->unsignedSmallInteger('year');
            $table->string('title', 150);
            $table->text('description')->nullable();

            $table->unsignedTinyInteger('sort_order')->default(0);

            $table->timestamps();

            $table->index(['year', 'sort_order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('club_histories');
    }
};