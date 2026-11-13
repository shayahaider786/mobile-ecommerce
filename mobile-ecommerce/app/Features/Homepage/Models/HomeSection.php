<?php

namespace App\Features\Homepage\Models;

use Illuminate\Database\Eloquent\Model;

class HomeSection extends Model
{
    protected $fillable = ['section_key', 'title', 'sort_order', 'is_active', 'limit', 'layout'];
    
    protected $casts = [
        'is_active' => 'boolean',
    ];
}