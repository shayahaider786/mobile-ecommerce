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
        Schema::create('navigation_links', function (Blueprint $table) {
            $table->id();
             $table->string('title'); // Link ka naam (e.g. "Products", "Blogs")
            $table->string('url')->nullable(); // Custom URL (e.g. "/about")
            
            // Agar category link hai toh yahan category ki ID aayegi
            $table->foreignId('category_id')->nullable()->constrained('categories')->onDelete('cascade');
            
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('navigation_links');
    }
};
