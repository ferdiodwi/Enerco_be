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
        Schema::create('energy_sources', function (Blueprint $table) {
            $table->id();
            $table->foreignId('provider_id')->constrained('users')->cascadeOnDelete();
            $table->string('name');
            $table->enum('type', ['solar', 'wind', 'hydro', 'biomass', 'hybrid']);
            $table->text('description')->nullable();
            $table->string('address');
            $table->string('city');
            $table->string('province');
            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);
            $table->decimal('capacity_kwh', 12, 2)->comment('Total capacity in kWh');
            $table->decimal('available_kwh', 12, 2)->comment('Available capacity in kWh');
            $table->decimal('cost_per_kwh', 10, 2)->comment('Cost per kWh in Rupiah');
            $table->enum('status', ['active', 'full', 'maintenance', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('energy_sources');
    }
};
