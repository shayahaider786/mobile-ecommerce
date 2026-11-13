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
        Schema::create('home_sections', function (Blueprint $table) {
            $table->id();
             $table->string('section_key'); // Internal identifier: 'featured_products', 'testimonials'
            $table->string('title')->nullable(); // Custom title e.g. "Top Selling Phones"
            $table->integer('sort_order')->default(0); // Order on page
            $table->boolean('is_active')->default(true); // Show/Hide
            $table->integer('limit')->default(8); // Kitne products dikhein
            $table->string('layout')->default('grid'); // 'grid' ya 'slider'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_sections');
    }
};
