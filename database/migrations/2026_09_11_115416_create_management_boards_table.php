<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('management_boards', function (Blueprint $table) {
            $table->id();

            $table->string('name', 30);
            $table->string('role', 50);

            $table->string('photo', 255)->nullable();

            $table->string('phone', 20)->nullable();
            $table->string('email', 40)->nullable();

            $table->string('instagram', 30)->nullable();
            $table->string('linkedin', 30)->nullable();

            $table->text('description')->nullable();

            $table->unsignedTinyInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);

            $table->timestamps();

            $table->index(['is_active', 'sort_order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('management_boards');
    }
};