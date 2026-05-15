<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('impact_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_id')->constrained()->cascadeOnDelete();
            $table->foreignId('distribution_id')->nullable()->constrained()->nullOnDelete();
            $table->string('period', 20);
            $table->decimal('old_energy_cost', 15, 2);
            $table->decimal('new_energy_cost', 15, 2);
            $table->decimal('cost_saving', 15, 2);
            $table->decimal('cost_saving_percentage', 5, 2);
            $table->decimal('clean_energy_used_kwh', 12, 2);
            $table->decimal('estimated_emission_reduction', 12, 2);
            $table->decimal('productivity_before', 12, 2)->nullable();
            $table->decimal('productivity_after', 12, 2)->nullable();
            $table->decimal('productivity_increase_percentage', 5, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('impact_reports');
    }
};
