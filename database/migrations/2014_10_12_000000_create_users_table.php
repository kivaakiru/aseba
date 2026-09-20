<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            // AUTH
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');

            // ACCOUNT TYPE
            // personal = user biasa
            // club = klub / komunitas
            $table->enum('account_type', ['personal', 'club']);

            // ACCOUNT LEVEL
            // reguler = user biasa
            // eo = event organizer (hasil approval admin)
            // admin = admin sistem
            // superadmin = owner (hardcode, tidak dihapus)
            $table->enum('account_level', ['reguler', 'eo', 'admin', 'superadmin'])
                  ->default('reguler');

            // PROFILE
            $table->string('phone')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('photo')->nullable();

            // STATUS
            $table->enum('status', ['active', 'inactive'])->default('active');

            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
