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
    $categories = Category::where('is_active', true)->orderBy('name')->get(); // <-- Categories fetch
    return view('admin.home-sections.index', compact('sections', 'categories'));
}

    public function create()
    {
        return view('admin.home-sections.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'section_key' => 'required|string|unique:home_sections,section_key',
            'title' => 'required|string|max:255',
            'sort_order' => 'integer',
            'limit' => 'nullable|integer|min:1',
            'layout' => 'required|in:grid,slider',
        ]);

        // Agar limit khali ho toh default 8 rakho (Error Fix)
        $validated['limit'] = $validated['limit'] ?? 8;
        $validated['is_active'] = $request->has('is_active');

        $this->service->createSection($validated);

        return redirect()->route('admin.home-sections.index')->with('success', 'Section created successfully!');
    }

    public function edit(HomeSection $homeSection)
    {
        return view('admin.home-sections.edit', compact('homeSection'));
    }

    public function update(Request $request, HomeSection $homeSection)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id', // <-- Validation
            'sort_order' => 'integer',
            'limit' => 'nullable|integer|min:1',
            'layout' => 'required|in:grid,slider',
        ]);

        $validated['limit'] = $validated['limit'] ?? $homeSection->limit ?? 8;
        $validated['is_active'] = $request->has('is_active');

        $this->service->updateSection($homeSection, $validated);

        return redirect()->route('admin.home-sections.index')->with('success', 'Section updated successfully!');
    }

    public function destroy(HomeSection $homeSection)
    {
        $this->service->deleteSection($homeSection);
        return redirect()->route('admin.home-sections.index')->with('success', 'Section deleted successfully!');
    }
}