<?php

namespace App\Features\Category\Services;

use App\Features\Category\Models\Category;
use Illuminate\Support\Facades\Cache;

class CategoryService
{
    /**
     * Frontend ke liye — saari active categories (CACHED = fast)
     */
    public function getActiveCategories()
    {
        return Cache::remember('categories.active', 3600, function () {
            return Category::active()
                ->orderBy('sort_order')
                ->orderBy('name')
                ->get();
        });
    }

    /**
     * Admin ke liye — saari categories (cached nahi, kyunki admin ko latest chahiye)
     */
    public function getAllCategories()
    {
        return Category::orderBy('sort_order')->orderBy('name')->get();
    }

    /**
     * Slug se ek category
     */
    public function getBySlug(string $slug)
    {
        return Cache::remember("category.{$slug}", 3600, function () use ($slug) {
            return Category::active()->where('slug', $slug)->firstOrFail();
        });
    }

    /**
     * Naya category banão
     */
    public function createCategory(array $data): Category
    {
        $category = Category::create($data);
        $this->clearCache();
        return $category;
    }

    /**
     * Category update karo
     */
    public function updateCategory(Category $category, array $data): Category
    {
        $category->update($data);
        $this->clearCache();
        return $category;
    }

    /**
     * Category delete karo
     */
    public function deleteCategory(Category $category): void
    {
        $category->delete();
        $this->clearCache();
    }

    /**
     * Cache clear — jab bhi data badle, cache clear karo!
     */
    private function clearCache(?string $slug = null): void
    {
        Cache::forget('categories.active');
        
        if ($slug) {
            Cache::forget("category.{$slug}");
        }
    }
}