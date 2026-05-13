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
        Schema::create('impact_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_id')->constrained('businesses')->cascadeOnDelete();
            $table->foreignId('distribution_recommendation_id')->nullable()->constrained('distribution_recommendations')->nullOnDelete();
            $table->decimal('old_energy_cost', 15, 2);
            $table->decimal('new_energy_cost', 15, 2);
            $table->decimal('cost_saving', 15, 2);
            $table->decimal('productivity_increase_percentage', 5, 2)->default(0);
            $table->decimal('estimated_emission_reduction', 10, 2)->default(0)->comment('in kg CO2');
            $table->string('report_period'); // e.g., "2026-05", "Q1 2026"
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('impact_reports');
    }
};
