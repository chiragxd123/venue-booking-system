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
        Schema::create('availabilities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('venue_id')->constrained('venues')->cascadeOnDelete();
            $table->date('blocked_date');
            $table->string('reason')->nullable();
            $table->timestamps();
    
            // Index for efficient querying
            $table->index(['venue_id', 'blocked_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('availabilities');
    }
};
