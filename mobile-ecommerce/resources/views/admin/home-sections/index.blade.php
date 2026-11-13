@extends('admin.layouts.app')

@section('title', 'Homepage Sections')

@section('content')
    <section class="rounded-2xl bg-white p-6 shadow-xs ring-1 ring-slate-200">
        {{-- Header Section --}}
        <div
            class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6 pb-6 border-b border-slate-100">
            <div>
                <h1 class="text-xl sm:text-2xl font-bold text-slate-900 tracking-tight">Homepage Setup</h1>
                <p class="text-sm text-slate-500 mt-1">Arrange, rename, and toggle homepage sections easily.</p>
            </div>
            <a href="{{ route('admin.home-sections.create') }}"
                class="inline-flex items-center gap-2 bg-indigo-600 text-white px-4 py-2.5 rounded-xl hover:bg-indigo-500 font-medium text-sm transition shadow-sm shadow-indigo-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Add New Section
            </a>
        </div>

        {{-- Sections Accordion List --}}
        <div class="space-y-4">
            @forelse ($sections as $index => $section)
                <div class="border border-slate-200 rounded-2xl overflow-hidden bg-white shadow-xs transition">

                    {{-- Accordion Header (Native JS Trigger) --}}
                    <div class="section-accordion-btn bg-slate-50/70 px-5 py-4 flex items-center justify-between cursor-pointer select-none hover:bg-slate-100/60 transition"
                        data-target="section-dropdown-{{ $index }}">
                        <div class="flex items-center gap-3">
                            <div
                                class="accordion-arrow w-8 h-8 rounded-lg bg-slate-200/60 flex items-center justify-center text-slate-600 transition-transform duration-200">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <span
                                    class="font-bold text-slate-800 text-base">{{ $section->title ?? $section->section_key }}</span>
                                <span class="block text-xs text-slate-400 uppercase tracking-wider font-medium">Key:
                                    {{ $section->section_key }}</span>
                            </div>

                            @if ($section->is_active)
                                <span
                                    class="ml-2 inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Active
                                </span>
                            @else
                                <span
                                    class="ml-2 inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-rose-50 text-rose-700">
                                    <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span> Hidden
                                </span>
                            @endif
                        </div>

                        <div class="flex items-center gap-3">
                            <span
                                class="text-xs font-semibold text-slate-500 bg-white px-3 py-1 rounded-lg border border-slate-200 shadow-2xs">
                                Sort Order: {{ $section->sort_order }}
                            </span>
                        </div>
                    </div>

                    {{-- Accordion Body (Update Form - Hidden by default) --}}
                    <div id="section-dropdown-{{ $index }}" class="section-dropdown-content hidden">
                        <form action="{{ route('admin.home-sections.update', $section) }}" method="POST"
                            class="p-6 border-t border-slate-200 bg-white space-y-4">
                            @csrf
                            @method('PUT')

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label
                                        class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Section
                                        Title</label>
                                    <input type="text" name="title" value="{{ $section->title }}"
                                        class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition bg-white">
                                </div>
                                <div>
                                    <label
                                        class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Product/Item
                                        Limit</label>
                                    <input type="number" name="limit" value="{{ $section->limit }}"
                                        class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition {{ in_array($section->section_key, ['testimonials', 'banners_grid']) ? 'bg-slate-100 text-slate-400 cursor-not-allowed' : 'bg-white' }}"
                                        {{ in_array($section->section_key, ['testimonials', 'banners_grid']) ? 'readonly' : '' }}>
                                    @if (in_array($section->section_key, ['testimonials', 'banners_grid']))
                                        <p class="text-xs text-slate-400 mt-1">Limit is fixed for this section type.</p>
                                    @endif
                                </div>
                            </div>

                            {{-- Category Selection --}}
                            @if (str_contains($section->section_key, 'product') ||
                                    in_array($section->section_key, ['featured_products', 'trending_products']))
                                <div>
                                    <label
                                        class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Select
                                        Category</label>
                                    <select name="category_id"
                                        class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition bg-white">
                                        <option value="">-- Choose Category --</option>
                                        @foreach ($categories as $cat)
                                            <option value="{{ $cat->id }}"
                                                {{ $section->category_id == $cat->id ? 'selected' : '' }}>
                                                {{ $cat->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
                                <div>
                                    <label
                                        class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Layout
                                        Style</label>
                                    <select name="layout"
                                        class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition bg-white">
                                        <option value="grid" {{ $section->layout == 'grid' ? 'selected' : '' }}>Grid
                                            Layout</option>
                                        <option value="slider" {{ $section->layout == 'slider' ? 'selected' : '' }}>Slider
                                            Layout</option>
                                    </select>
                                </div>
                                <div>
                                    <label
                                        class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Sort
                                        Order</label>
                                    <input type="number" name="sort_order" value="{{ $section->sort_order }}"
                                        class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition bg-white">
                                </div>
                                <div class="pt-6">
                                    <label class="flex items-center gap-3 cursor-pointer">
                                        <input type="checkbox" name="is_active" value="1"
                                            {{ $section->is_active ? 'checked' : '' }}
                                            class="w-5 h-5 text-indigo-600 rounded-md border-slate-300 focus:ring-indigo-500">
                                        <span class="text-sm font-semibold text-slate-700">Show on Homepage</span>
                                    </label>
                                </div>
                            </div>

                            {{-- Footer Actions --}}
                            <div class="flex justify-between items-center pt-4 border-t border-slate-100">
                                <button type="button"
                                    @click="$dispatch('open-delete-modal', { url: '{{ route('admin.home-sections.destroy', $section) }}', title: '{{ $section->title ?? $section->section_key }}' })"
                                    class="inline-flex items-center gap-1.5 text-rose-600 hover:text-rose-700 text-sm font-semibold transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                        </path>
                                    </svg>
                                    Delete Section
                                </button>

                                <a href="{{ route('admin.home-sections.edit', $section) }}"
                                    class="text-indigo-600 hover:text-indigo-800 text-sm font-semibold transition">
                                    Edit Page
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            @empty
                <div class="text-center py-12 text-slate-400">
                    <p class="font-medium">No homepage sections found.</p>
                </div>
            @endforelse
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const accordionBtns = document.querySelectorAll('.section-accordion-btn');

            accordionBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    const targetId = btn.getAttribute('data-target');
                    const dropdown = document.getElementById(targetId);
                    const arrow = btn.querySelector('.accordion-arrow');

                    if (dropdown) {
                        dropdown.classList.toggle('hidden');
                        if (arrow) {
                            arrow.classList.toggle('rotate-90');
                        }
                    }
                });
            });
        });
    </script>
@endsection
