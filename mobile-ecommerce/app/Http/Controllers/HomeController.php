<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Features\Category\Services\CategoryService;
use App\Features\Banner\Services\BannerService;
use App\Features\Homepage\Services\HomepageService;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(
        CategoryService $categoryService, 
        BannerService $bannerService,
        HomepageService $homepageService
    ) {
        $categories = $categoryService->getActiveCategories();
        $banners = $bannerService->getActiveBanners();
        
        // Dynamic Sections Fetch
        $homeSections = $homepageService->getActiveSections();

        return view('home', compact('categories', 'banners', 'homeSections'));
    }
}
