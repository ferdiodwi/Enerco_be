<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('energy_needs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_id')->constrained()->cascadeOnDelete();
            $table->string('period', 20);
            $table->decimal('monthly_need_kwh', 12, 2);
            $table->integer('operating_hours_per_day');
            $table->text('main_equipment');
            $table->decimal('current_energy_cost', 15, 2);
            $table->text('energy_problem');
            $table->enum('validation_status', ['pending', 'validated', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('energy_needs');
    }
};
