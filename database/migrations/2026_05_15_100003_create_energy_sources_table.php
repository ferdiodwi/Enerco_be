<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('energy_sources', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('region_id')->nullable()->constrained()->nullOnDelete();
            $table->string('name', 150);
            $table->enum('type', ['solar', 'wind', 'hydro', 'biomass', 'geothermal', 'other']);
            $table->text('description');
            $table->text('address');
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 11, 8);
            $table->decimal('total_capacity_kwh', 12, 2);
            $table->decimal('available_capacity_kwh', 12, 2);
            $table->enum('status', ['active', 'inactive', 'maintenance'])->default('active');
            $table->string('photo', 255)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('energy_sources');
    }
};
