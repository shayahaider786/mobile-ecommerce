<?php

namespace App\Features\Category\Controllers;

use App\Http\Controllers\Controller;
use App\Features\Category\Services\CategoryService;

class CategoryController extends Controller
{
    public function __construct(private CategoryService $service) {}

    public function index()
    {
        $categories = $this->service->getActiveCategories();
        return view('shop.categories.index', compact('categories'));
    }

    public function show(string $slug)
    {
        $category = $this->service->getBySlug($slug);
        $products = $category->products()->where('is_active', true)->paginate(12);
        
        return view('shop.categories.show', compact('category', 'products'));
    }
}