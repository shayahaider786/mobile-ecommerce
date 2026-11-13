<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Home Sections table jismein main configuration rahegi (category_id hata diya gaya hai)
        if (!Schema::hasTable('home_sections')) {
            Schema::create('home_sections', function (Blueprint $table) {
                $table->id();
                $table->string('section_key'); 
                $table->string('title')->nullable(); 
                $table->integer('sort_order')->default(0); 
                $table->boolean('is_active')->default(true); 
                $table->integer('limit')->default(8); 
                $table->string('layout')->default('grid'); 
                $table->timestamps();
            });
        }

        // 2. Pivot Table for Multi-Category Selection
        Schema::create('home_section_category', function (Blueprint $table) {
            $table->id();
            $table->foreignId('home_section_id')->constrained('home_sections')->cascadeOnDelete();
            $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('home_section_category');
        Schema::dropIfExists('home_sections');
    }
};