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
        Schema::create('businesses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('name');
            $table->string('sector'); // food_processing, fisheries, agriculture, textile, craft, etc.
            $table->text('description')->nullable();
            $table->string('address');
            $table->string('city');
            $table->string('province');
            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);
            $table->decimal('monthly_energy_need', 10, 2)->comment('in kWh');
            $table->decimal('current_energy_cost', 15, 2)->comment('in Rupiah');
            $table->decimal('production_capacity', 10, 2)->nullable();
            $table->integer('employee_count')->default(0);
            $table->boolean('clean_energy_access')->default(false);
            $table->enum('status', ['active', 'inactive', 'pending'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('businesses');
    }
};
