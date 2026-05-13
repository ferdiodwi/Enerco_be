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
        Schema::create('priority_scores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_id')->constrained('businesses')->cascadeOnDelete();
            $table->decimal('energy_need_score', 5, 2)->default(0);
            $table->decimal('economic_impact_score', 5, 2)->default(0);
            $table->decimal('distance_score', 5, 2)->default(0);
            $table->decimal('sustainability_score', 5, 2)->default(0);
            $table->decimal('emission_reduction_score', 5, 2)->default(0);
            $table->decimal('total_score', 5, 2)->default(0);
            $table->enum('priority_level', ['low', 'medium', 'high', 'urgent'])->default('low');
            $table->timestamp('calculated_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('priority_scores');
    }
};
