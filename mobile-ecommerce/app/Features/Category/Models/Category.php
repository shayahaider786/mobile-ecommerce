<?php

namespace App\Features\Category\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'is_active',
        'parent_id',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Auto-generate slug from name
    protected static function booted(): void
    {
        static::creating(function ($category) {
            if (empty($category->slug)) {
                $category->slug = Str::slug($category->name);
            }
        });

        static::updating(function ($category) {
            if ($category->isDirty('name') && empty($category->slug)) {
                $category->slug = Str::slug($category->name);
            }
        });
    }

    // Relationships
    public function products()
    {
        return $this->hasMany(\App\Features\Product\Models\Product::class);
    }

    // Scope: only active categories
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function parent() 
    { 
        return $this->belongsTo(Category::class, 'parent_id'); 
    }
    public function children()
    { 
        return $this->hasMany(Category::class, 'parent_id'); 
    }
}