<?php

namespace App\Features\Category\Controllers;

use App\Http\Controllers\Controller;
use App\Features\Category\Models\Category;
use App\Features\Category\Services\CategoryService;
use App\Features\Category\Requests\StoreCategoryRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class AdminCategoryController extends Controller
{
    public function __construct(private CategoryService $service) {}

    public function index()
    {
        $categories = $this->service->getAllCategories();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        $parentCategories = Category::whereNull('parent_id')->orderBy('name')->get();
        return view('admin.categories.create', compact('parentCategories'));
    }

    public function store(StoreCategoryRequest $request)
    {
        $data = $request->validated();

        // Category images use a URL-safe directory that does not shadow /categories.
        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadImage($request->file('image'));
        }

        $this->service->createCategory($data);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category add ho gayi ✅');
    }

    public function edit(Category $category)
    {
        $parentCategories = Category::whereNull('parent_id')->orderBy('name')->get();
        return view('admin.categories.edit', compact('category', 'parentCategories'));
    }

    public function update(StoreCategoryRequest $request, Category $category)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            // Delete the previous category image.
            $this->deleteImage($category->image);
            
            // Nayi image upload
            $data['image'] = $this->uploadImage($request->file('image'));
        }

        $this->service->updateCategory($category, $data);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category update ho gayi ✅');
    }

    public function destroy(Category $category)
    {
        // Image delete karo
        $this->deleteImage($category->image);

        $this->service->deleteCategory($category);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category delete ho gayi ✅');
    }

    /**
     * Upload an image to public/category-images.
     * Returns: filename (e.g., "shirts_65a1b2c3.jpg")
     */
    private function uploadImage($file): string
    {
        $destinationPath = public_path('category-images');
        if (!File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0755, true);
        }

        // Unique filename banao: slug + timestamp + extension
        $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME))
                    . '.' . $file->getClientOriginalExtension();

        // Move the file into the public category-images directory.
        $file->move($destinationPath, $filename);

        return $filename;
    }

    /**
     * Delete an image from public/category-images.
     */
    private function deleteImage(?string $filename): void
    {
        if (!$filename) return;

        $path = public_path('category-images/' . $filename);
        if (File::exists($path)) {
            File::delete($path);
        }
    }
}