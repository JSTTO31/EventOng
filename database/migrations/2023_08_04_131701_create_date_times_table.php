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
        Schema::create('date_times', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id');
            $table->date('event_date_start')->default(now());
            $table->time('event_time_start')->default(now());
            $table->date('event_date_end')->default(now());
            $table->time('event_time_end')->default(now());
            $table->boolean('hide_end')->default(false);
            $table->boolean('month_long')->default(false);
            $table->boolean('year_long')->default(false);
            $table->boolean('progress_bar')->default(false);
            $table->boolean('all_day')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('date_times');
    }
};
