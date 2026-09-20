<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('communities', function (Blueprint $table) {
            // hapus kolom enum lama
            if (Schema::hasColumn('communities', 'club_type')) {
                $table->dropColumn('club_type');
            }
        });

        Schema::table('communities', function (Blueprint $table) {
            // tambah ulang sebagai string
            $table->string('club_type')->nullable()->after('leader_phone');
        });
    }

    public function down(): void
    {
        Schema::table('communities', function (Blueprint $table) {
            $table->dropColumn('club_type');
        });

        Schema::table('communities', function (Blueprint $table) {
            $table->enum('club_type', [
                'Klub Basket',
                'Komunitas Basket',
                'Sekolah Basket',
            ])->nullable()->after('leader_phone');
        });
    }
};
