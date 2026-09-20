<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserTypeLevelStatusToUsersTable extends Migration
{
    public function up()
{
    Schema::table('users', function (Blueprint $table) {

        if (!Schema::hasColumn('users', 'user_type')) {
            $table->enum('user_type', ['personal', 'club'])->after('password');
        }

        if (!Schema::hasColumn('users', 'user_level')) {
            $table->enum('user_level', ['reguler', 'event_organizer', 'admin'])->after('user_type');
        }

        // ❌ JANGAN TAMBAH status (SUDAH ADA)
    });
}

}

