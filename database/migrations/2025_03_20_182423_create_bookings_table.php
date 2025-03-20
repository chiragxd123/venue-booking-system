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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('venue_id')->constrained('venues')->cascadeOnDelete();
            $table->string('user_name');
            $table->string('user_email');
            $table->date('start_date');
            $table->date('end_date');
            $table->timestamps();
    
            // Index for efficient searching
            $table->index(['start_date', 'end_date']);
        });
    
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
