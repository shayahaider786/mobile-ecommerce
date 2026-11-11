<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Features\Category\Services\CategoryService;
use App\Features\Banner\Services\BannerService;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(CategoryService $categoryService, BannerService $bannerService)
    {
        $categories = $categoryService->getActiveCategories();
        $banners = $bannerService->getActiveBanners();
        return view('home', compact('categories', 'banners'));
    }
}
