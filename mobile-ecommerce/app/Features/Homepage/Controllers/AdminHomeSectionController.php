<?php

namespace App\Features\Homepage\Controllers;

use App\Http\Controllers\Controller;
use App\Features\Homepage\Models\HomeSection;
use App\Features\Homepage\Services\HomepageService;
use App\Features\Category\Models\Category;
use Illuminate\Http\Request;

class AdminHomeSectionController extends Controller
{
    public function __construct(private HomepageService $service) {}

    public function index()
    {
        $sections = $this->service->getAllSections();
        $categories = Category::where('is_active', true)->orderBy('name')->get(); 
        return view('admin.home-sections.index', compact('sections', 'categories'));
    }

    public function create()
    {
        // 🟢 FIX 1: Categories fetch karke create view ko pass kiin
        $categories = Category::where('is_active', true)->orderBy('name')->get();
        return view('admin.home-sections.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'section_key' => 'required|string|unique:home_sections,section_key',
            'title' => 'required|string|max:255',
            'category_ids' => 'nullable|array', // Multi categories array
            'category_ids.*' => 'exists:categories,id',
            'sort_order' => 'integer',
            'limit' => 'nullable|integer|min:1',
            'layout' => 'required|in:grid,slider',
        ]);

        $validated['limit'] = $validated['limit'] ?? 8;
        $validated['is_active'] = $request->has('is_active');

        // Section Create karein
        $section = $this->service->createSection($validated);

        // Categories attach karein
        if ($request->has('category_ids')) {
            $section->categories()->sync($request->category_ids);
        }

        return redirect()->route('admin.home-sections.index')->with('success', 'Section created successfully!');
    }

    public function edit(HomeSection $homeSection)
    {
        // 🟢 FIX 3: Categories fetch karke edit view ko pass kiin
        $categories = Category::where('is_active', true)->orderBy('name')->get();
        return view('admin.home-sections.edit', compact('homeSection', 'categories'));
    }

    public function update(Request $request, HomeSection $homeSection)
    {
            $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_ids' => 'nullable|array',
            'category_ids.*' => 'exists:categories,id',
            'sort_order' => 'integer',
            'limit' => 'nullable|integer|min:1',
            'layout' => 'required|in:grid,slider',
        ]);

        $validated['limit'] = $validated['limit'] ?? $homeSection->limit ?? 8;
        $validated['is_active'] = $request->has('is_active');

        // Section Update karein
        $this->service->updateSection($homeSection, $validated);

        // Categories sync karein (Purani hata kar nayi attach kar dega)
        $homeSection->categories()->sync($request->category_ids ?? []);

        return redirect()->route('admin.home-sections.index')->with('success', 'Section updated successfully!');
    }

    public function destroy(HomeSection $homeSection)
    {
        $this->service->deleteSection($homeSection);
        return redirect()->route('admin.home-sections.index')->with('success', 'Section deleted successfully!');
    }
}