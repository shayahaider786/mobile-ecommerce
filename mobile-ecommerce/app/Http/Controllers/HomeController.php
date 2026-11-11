<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Features\Category\Services\CategoryService;

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
    public function index(CategoryService $categoryService)
    {
       // Frontend ke liye active categories fetch karo
        $categories = $categoryService->getActiveCategories();

        return view('home', compact('categories'));
    }
}
