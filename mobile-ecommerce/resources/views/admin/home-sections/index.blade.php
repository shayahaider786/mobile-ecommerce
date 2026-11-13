@extends('admin.layouts.app')

@section('title', 'Homepage Sections')

@section('content')
    <section class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
        <div class="mb-6">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h1 class="text-2xl font-bold">Homepage Setup</h1>
                    <p class="text-sm text-slate-500">Arrange, rename, and toggle homepage sections.</p>
                </div>
                <a href="{{ route('admin.home-sections.create') }}"
                    class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-indigo-700">
                    + Add New Section
                </a>
            </div>
        </div>

        <div class="space-y-4">
            @foreach ($sections as $section)
                <div class="border border-slate-200 rounded-lg overflow-hidden" x-data="{ open: false }">

                    <!-- Accordion Header -->
                    <div class="bg-slate-50 px-4 py-3 flex items-center justify-between cursor-pointer"
                        @click="open = !open">
                        <div class="flex items-center gap-3">
                            <svg :class="{ 'rotate-90': open }" class="w-5 h-5 text-slate-400 transition-transform"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                </path>
                            </svg>
                            <span class="font-bold text-slate-800">{{ $section->title ?? $section->section_key }}</span>

                            @if ($section->is_active)
                                <span
                                    class="bg-green-100 text-green-700 text-xs px-2 py-0.5 rounded-full font-semibold">Active</span>
                            @else
                                <span
                                    class="bg-red-100 text-red-700 text-xs px-2 py-0.5 rounded-full font-semibold">Hidden</span>
                            @endif
                        </div>
                        <span class="text-xs text-slate-500 uppercase tracking-wider font-semibold">Sort:
                            {{ $section->sort_order }}</span>
                    </div>

                    <!-- Accordion Body (Form) -->
                    <div x-show="open" x-collapse>
                        <form action="{{ route('admin.home-sections.update', $section) }}" method="POST"
                            class="p-4 border-t border-slate-200 bg-white">
                            @csrf @method('PUT')

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label class="block text-sm font-medium mb-1">Section Title</label>
                                    <input type="text" name="title" value="{{ $section->title }}"
                                        class="w-full border border-slate-300 rounded-lg p-2 text-sm focus:ring-indigo-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium mb-1">Product/Item Limit</label>

                                    <!-- Yahan disabled ki jagah readonly lagaya gaya hai aur styling add ki gayi hai -->
                                    <input type="number" name="limit" value="{{ $section->limit }}"
                                        class="w-full border border-slate-300 rounded-lg p-2 text-sm focus:ring-indigo-500 {{ in_array($section->section_key, ['testimonials', 'banners_grid']) ? 'bg-slate-100 text-slate-500 cursor-not-allowed' : '' }}"
                                        {{ in_array($section->section_key, ['testimonials', 'banners_grid']) ? 'readonly' : '' }}>

                                    @if (in_array($section->section_key, ['testimonials', 'banners_grid']))
                                        <p class="text-xs text-slate-500 mt-1">Limit is fixed for this section type.</p>
                                    @endif
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center mb-4">
                                <div>
                                    <label class="block text-sm font-medium mb-1">Layout Style</label>
                                    <select name="layout" class="w-full border border-slate-300 rounded-lg p-2 text-sm">
                                        <option value="grid" {{ $section->layout == 'grid' ? 'selected' : '' }}>Grid
                                            Layout</option>
                                        <option value="slider" {{ $section->layout == 'slider' ? 'selected' : '' }}>Slider
                                            Layout</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium mb-1">Sort Order (1 = First)</label>
                                    <input type="number" name="sort_order" value="{{ $section->sort_order }}"
                                        class="w-full border border-slate-300 rounded-lg p-2 text-sm">
                                </div>
                                <div class="pt-5">
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input type="checkbox" name="is_active" value="1"
                                            {{ $section->is_active ? 'checked' : '' }}
                                            class="w-5 h-5 text-indigo-600 rounded">
                                        <span class="text-sm font-bold text-slate-700">Show on Homepage</span>
                                    </label>
                                </div>
                            </div>

                            <div class="flex justify-between items-center mt-4 pt-4 border-t border-slate-100">
                                <!-- Left side: Delete Button (Sirf tab dikhe jab system ka fixed section na ho) -->
                                {{-- @if (!in_array($section->section_key, ['featured_products', 'trending_products', 'testimonials', 'banners_grid']))
                                    <form action="{{ route('admin.home-sections.destroy', $section) }}" method="POST"
                                        onsubmit="return confirm('Kya aap waqai yeh section delete karna chahte hain?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-red-600 hover:text-red-800 text-sm font-semibold">Delete
                                            Section</button>
                                    </form>
                                @else
                                    <div></div> <!-- Khali div taake layout theek rahe -->
                                @endif --}}
                                <form action="{{ route('admin.home-sections.destroy', $section) }}" method="POST"
                                    onsubmit="return confirm('Kya aap waqai yeh section delete karna chahte hain?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="text-red-600 hover:text-red-800 text-sm font-semibold">Delete
                                        Section</button>
                                </form>
                                <!-- Right side: Save Button -->
                                <button type="submit"
                                    class="bg-indigo-600 text-white px-5 py-2 rounded-lg text-sm font-medium hover:bg-indigo-700 transition">Save
                                    Changes</button>
                            </div>

                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection
