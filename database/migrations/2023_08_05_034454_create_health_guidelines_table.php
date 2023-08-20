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
        Schema::create('health_guidelines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id');
            $table->boolean('enable')->default(false);
            $table->boolean('face_mask')->default(false);
            $table->boolean('temperature')->default(false);
            $table->boolean('physical_distance')->default(false);
            $table->boolean('sanitize_before_event')->default(false);
            $table->boolean('held_outside')->default(false);
            $table->boolean('vaccination')->default(false);
            $table->string('other')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('health_guidelines');
    }
};
