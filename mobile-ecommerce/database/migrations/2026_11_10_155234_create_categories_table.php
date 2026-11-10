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
        Schema::create('categories', function (Blueprint $table) {
           $table->id();
            $table->string('name');                          // "Shirts"
            $table->string('slug')->unique();                // "shirts" (URL ke liye)
            $table->text('description')->nullable();         // optional
            $table->string('image')->nullable();             // category image
            $table->boolean('is_active')->default(true);     // show/hide
            $table->integer('sort_order')->default(0);       // order
            $table->timestamps();

            $table->index('slug');        // Fast lookup
            $table->index('is_active');   // Fast filter
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
