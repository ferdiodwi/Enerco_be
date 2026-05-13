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
        Schema::create('distribution_recommendations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_id')->constrained('businesses')->cascadeOnDelete();
            $table->foreignId('energy_source_id')->constrained('energy_sources')->cascadeOnDelete();
            $table->foreignId('priority_score_id')->constrained('priority_scores')->cascadeOnDelete();
            $table->decimal('recommended_energy_kwh', 12, 2);
            $table->decimal('distance_km', 8, 2);
            $table->text('recommendation_reason')->nullable();
            $table->text('ai_summary')->nullable();
            $table->enum('status', ['draft', 'recommended', 'approved', 'rejected', 'implemented'])->default('draft');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('distribution_recommendations');
    }
};
