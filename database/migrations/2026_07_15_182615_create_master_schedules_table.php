<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('master_schedules', function (Blueprint $table) {

            $table->id();

            // PRACTICE | HOLIDAY | OVERRIDE
            $table->enum('mode', [
                'practice',
                'holiday',
                'override'
            ]);

            // WEEKLY | DAILY
            $table->enum('schedule_type', [
                'weekly',
                'daily'
            ]);

            // Monday - Sunday
            $table->string('day_name')->nullable();

            // Khusus Daily
            $table->date('date')->nullable();

            // Full Day
            $table->boolean('all_day')
                ->default(false);

            $table->time('start_time');

            $table->time('end_time');

            // Nama Rule
            $table->string('description');

            // Active / Inactive
            $table->boolean('is_active')
                ->default(true);

            // Admin yang membuat
            $table->foreignId('created_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('master_schedules');
    }
};
