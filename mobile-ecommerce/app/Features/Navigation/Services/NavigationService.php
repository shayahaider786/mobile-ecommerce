<?php

namespace App\Features\Navigation\Services;

use App\Features\Navigation\Models\NavigationLink;
use Illuminate\Support\Facades\Cache;

class NavigationService
{
    // Frontend ke liye (Cached)
    public function getActiveLinks()
    {
        return Cache::remember('navigation.active', 3600, function () {
            return NavigationLink::where('is_active', true)
                ->whereNull('parent_id') // Sirf main links
                ->orderBy('sort_order', 'asc')
                ->with(['children' => function($q) {
                    $q->where('is_active', true); // Sirf active sub-links
                }, 'category.children']) // Category ke sath uski sub-categories bhi le aao
                ->get();
        });
    }

    // Admin ke liye
    public function getAllLinks()
    {
        return NavigationLink::orderBy('sort_order', 'asc')->get();
    }

    public function clearCache()
    {
        Cache::forget('navigation.active');
    }
}