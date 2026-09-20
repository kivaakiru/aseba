<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('players', function (Blueprint $table) {
            $table->string('social_media_name', 20)->nullable()->after('weight');
            $table->string('social_media_url', 100)->nullable()->after('social_media_name');
        });
    }

    public function down(): void
    {
        Schema::table('players', function (Blueprint $table) {
            $table->dropColumn([
                'social_media_name',
                'social_media_url',
            ]);
        });
    }
};
