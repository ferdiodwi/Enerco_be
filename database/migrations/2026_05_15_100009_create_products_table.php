<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_id')->constrained()->cascadeOnDelete();
            $table->string('name', 150);
            $table->text('description');
            $table->string('category', 100);
            $table->decimal('price', 15, 2);
            $table->integer('stock');
            $table->string('image', 255)->nullable();
            $table->boolean('is_clean_energy_powered')->default(false);
            $table->enum('status', ['pending', 'active', 'rejected', 'archived'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
