<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('recommendations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_id')->constrained()->cascadeOnDelete();
            $table->foreignId('energy_source_id')->constrained()->cascadeOnDelete();
            $table->foreignId('priority_score_id')->constrained()->cascadeOnDelete();
            $table->decimal('recommended_energy_kwh', 12, 2);
            $table->decimal('distance_km', 10, 2);
            $table->decimal('estimated_cost_saving', 15, 2);
            $table->decimal('estimated_emission_reduction', 12, 2);
            $table->text('ai_summary')->nullable();
            $table->text('ai_reasoning')->nullable();
            $table->text('action_plan')->nullable();
            $table->decimal('confidence_score', 5, 2)->nullable();
            $table->enum('status', ['draft', 'reviewed', 'approved', 'rejected'])->default('draft');
            $table->foreignId('generated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('recommendations');
    }
};
