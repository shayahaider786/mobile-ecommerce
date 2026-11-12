<?php

namespace App\Features\Navigation\Controllers;

use App\Http\Controllers\Controller;
use App\Features\Navigation\Models\NavigationLink;
use App\Features\Navigation\Services\NavigationService;
use App\Features\Category\Models\Category;
use Illuminate\Http\Request;

class AdminNavigationController extends Controller
{
    public function __construct(private NavigationService $service) {}

    public function index()
    {
        $links = $this->service->getAllLinks();
        return view('admin.navigation.index', compact('links'));
    }

    public function create()
    {
        $categories = Category::where('is_active', true)->orderBy('name')->get();
        $parentLinks = NavigationLink::whereNull('parent_id')->orderBy('title')->get();
        return view('admin.navigation.create', compact('categories', 'parentLinks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:custom,category',
            'url' => 'required_if:type,custom|nullable|string',
            'category_id' => 'required_if:type,category|nullable|exists:categories,id',
            'sort_order' => 'integer',
        ]);

        NavigationLink::create([
            'title' => $request->title,
            'url' => $request->type === 'custom' ? $request->url : null,
            'category_id' => $request->type === 'category' ? $request->category_id : null,
            'sort_order' => $request->sort_order ?? 0,
            'is_active' => $request->has('is_active'),
        ]);

        $this->service->clearCache();
        return redirect()->route('admin.navigation.index')->with('success', 'Navigation link created!');
    }

    public function edit(NavigationLink $navigation)
    {
        $categories = Category::where('is_active', true)->orderBy('name')->get();
        $parentLinks = NavigationLink::whereNull('parent_id')->orderBy('title')->get();

        return view('admin.navigation.edit', compact('navigation', 'categories', 'parentLinks'));
    }

    public function update(Request $request, NavigationLink $navigation)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:custom,category',
            'url' => 'required_if:type,custom|nullable|string',
            'category_id' => 'required_if:type,category|nullable|exists:categories,id',
            'parent_id' => 'nullable|exists:navigation_links,id',
        ]);

        $navigation->update([
            'title' => $request->title,
            'url' => $request->type === 'custom' ? $request->url : null,
            'category_id' => $request->type === 'category' ? $request->category_id : null,
            'parent_id' => $request->parent_id,
            'sort_order' => $request->sort_order ?? 0,
            'is_active' => $request->has('is_active'),
        ]);

        $this->service->clearCache();
        return redirect()->route('admin.navigation.index')->with('success', 'Navigation link updated!');
    }

    public function destroy(NavigationLink $navigation)
    {
        $navigation->delete();
        $this->service->clearCache();
        return redirect()->route('admin.navigation.index')->with('success', 'Link deleted!');
    }
}