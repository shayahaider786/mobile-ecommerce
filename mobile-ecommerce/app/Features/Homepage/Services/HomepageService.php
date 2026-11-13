<?php

namespace App\Features\Homepage\Services;

use App\Features\Homepage\Models\HomeSection;
use Illuminate\Support\Facades\Cache;

class HomepageService
{
    public function getActiveSections()
    {
        return Cache::remember('homepage.sections', 3600, function () {
            return HomeSection::where('is_active', true)
                ->orderBy('sort_order', 'asc')
                ->get();
        });
    }

    public function getAllSections()
    {
        return HomeSection::orderBy('sort_order', 'asc')->get();
    }

    // Naya Section Create Karne Ke Liye
    public function createSection(array $data)
    {
        $section = HomeSection::create($data);
        $this->clearCache();
        return $section;
    }

    // Section Update Karne Ke Liye
    public function updateSection(HomeSection $section, array $data)
    {
        $section->update($data);
        $this->clearCache();
        return $section;
    }

    // Section Delete Karne Ke Liye
    public function deleteSection(HomeSection $section)
    {
        $section->delete();
        $this->clearCache();
    }

    public function clearCache()
    {
        Cache::forget('homepage.sections');
    }
}