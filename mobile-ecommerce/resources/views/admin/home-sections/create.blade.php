@extends('admin.layouts.app')

@section('title', 'Add Homepage Section')

@section('content')
<section class="rounded-2xl bg-white p-6 shadow-xs ring-1 ring-slate-200 max-w-3xl mx-auto">
    {{-- Header --}}
    <div class="flex justify-between items-center mb-6 pb-6 border-b border-slate-100">
        <div>
            <h1 class="text-xl sm:text-2xl font-bold text-slate-900 tracking-tight">Add New Section</h1>
            <p class="text-sm text-slate-500 mt-1">Configure a new dynamic block for your homepage.</p>
        </div>
        <a href="{{ route('admin.home-sections.index') }}"
            class="text-sm font-semibold text-slate-600 hover:text-indigo-600 transition">
            &larr; Back to Sections
        </a>
    </div>

    <form action="{{ route('admin.home-sections.store') }}" method="POST" class="space-y-5">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Section Key (System Name) *</label>
                <input type="text" name="section_key" value="{{ old('section_key') }}" placeholder="e.g. new_arrivals_products" class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition bg-white" required>
                <p class="text-xs text-slate-400 mt-1">Must be unique. Use lowercase and underscores.</p>
                @error('section_key') <span class="text-rose-500 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Display Title *</label>
                <input type="text" name="title" value="{{ old('title') }}" placeholder="e.g. New Arrivals" class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition bg-white" required>
                @error('title') <span class="text-rose-500 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
            </div>
        </div>

        {{-- Optional Category Selection for Products --}}
        <div>
            <label class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Select Category (Optional)</label>
            <select name="category_id" class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition bg-white">
                <option value="">-- Choose Category (If product section) --</option>
                @isset($categories)
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                @endisset
            </select>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Layout Style</label>
                <select name="layout" class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition bg-white">
                    <option value="grid" {{ old('layout') == 'grid' ? 'selected' : '' }}>Grid Layout</option>
                    <option value="slider" {{ old('layout') == 'slider' ? 'selected' : '' }}>Slider Layout</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Product/Item Limit</label>
                <input type="number" name="limit" value="{{ old('limit', 8) }}" class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition bg-white">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 items-center pt-2">
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Sort Order</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition bg-white">
            </div>
            <div class="pt-6">
                <label class="flex items-center gap-3 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} class="w-5 h-5 text-indigo-600 rounded-md border-slate-300 focus:ring-indigo-500">
                    <span class="text-sm font-semibold text-slate-700">Show on Homepage (Active)</span>
                </label>
            </div>
        </div>

        <div class="flex items-center justify-end gap-3 pt-6 border-t border-slate-100">
            <a href="{{ route('admin.home-sections.index') }}" class="bg-slate-100 text-slate-700 px-5 py-2.5 rounded-xl hover:bg-slate-200 font-medium text-sm transition">
                Cancel
            </a>
            <button type="submit" class="bg-indigo-600 text-white px-6 py-2.5 rounded-xl text-sm font-medium hover:bg-indigo-500 transition shadow-sm shadow-indigo-200">
                Create Section
            </button>
        </div>
    </form>
</section>
@endsection