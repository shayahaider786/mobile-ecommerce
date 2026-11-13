<?php

namespace App\Features\Homepage\Models;

use Illuminate\Database\Eloquent\Model;
use App\Features\Category\Models\Category;

class HomeSection extends Model
{
    protected $fillable = ['section_key', 'title', 'sort_order', 'is_active', 'limit', 'layout'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Many-to-Many Relation for Multiple Categories
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'home_section_category');
    }
}