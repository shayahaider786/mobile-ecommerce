<?php

namespace App\Features\Banner\Services;

use App\Features\Banner\Models\Banner;
use Illuminate\Support\Facades\Cache;

class BannerService
{
    // Frontend ke liye (Cached)
    public function getActiveBanners()
    {
        return Cache::remember('banners.active', 3600, function () {
            return Banner::where('is_active', true)
                ->orderBy('sort_order', 'asc')
                ->get();
        });
    }

    // Admin ke liye (No Cache)
    public function getAllBanners()
    {
        return Banner::orderBy('sort_order', 'asc')->get();
    }

    public function clearCache()
    {
        Cache::forget('banners.active');
    }
}