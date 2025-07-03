<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('attendances', function (Blueprint $table) {
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->decimal('schedule_latitude', 10, 7)->nullable();
            $table->decimal('schedule_longitude', 10, 7)->nullable();
            $table->time('schedule_start_time')->nullable();
            $table->time('schedule_end_time')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('attendances', function (Blueprint $table) {
            $table->dropColumn([
                'latitude',
                'longitude',
                'schedule_latitude',
                'schedule_longitude',
                'schedule_start_time',
                'schedule_end_time',
                'created_at',
                'updated_at',
            ]);
        });
    }
};
