<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('priority_scores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_id')->constrained()->cascadeOnDelete();
            $table->decimal('score', 5, 2);
            $table->string('category', 50);
            $table->decimal('energy_need_score', 5, 2);
            $table->decimal('economic_impact_score', 5, 2);
            $table->decimal('worker_score', 5, 2);
            $table->decimal('distance_score', 5, 2);
            $table->decimal('emission_reduction_score', 5, 2);
            $table->decimal('clean_energy_access_score', 5, 2);
            $table->text('calculation_notes')->nullable();
            $table->timestamp('calculated_at');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('priority_scores');
    }
};
