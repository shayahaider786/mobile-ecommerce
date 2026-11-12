<?php

namespace App\Features\Navigation\Models;

use Illuminate\Database\Eloquent\Model;
use App\Features\Category\Models\Category;

class NavigationLink extends Model
{
    protected $fillable = ['title', 'url', 'category_id', 'sort_order', 'parent_id','is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Relationship: Agar link kisi category se juda hai
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Helper: Link ka final URL nikalne ke liye
    public function getFinalUrlAttribute()
    {
        if ($this->category_id && $this->category) {
            return route('categories.show', $this->category->slug);
        }
        return $this->url ?? '#';
    }

    public function parent() { return $this->belongsTo(NavigationLink::class, 'parent_id'); }
    public function children() { return $this->hasMany(NavigationLink::class, 'parent_id')->orderBy('sort_order'); }
}