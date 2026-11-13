@extends('admin.layouts.app')

@section('title', 'Add Homepage Section')

@section('content')
<section class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-slate-200 max-w-2xl">
    <h1 class="text-2xl font-bold mb-6">Add New Section</h1>

    <form action="{{ route('admin.home-sections.store') }}" method="POST" class="space-y-4">
        @csrf
        
        <div>
            <label class="block text-sm font-medium mb-1">Section Key (System Name) *</label>
            <input type="text" name="section_key" value="{{ old('section_key') }}" placeholder="e.g. new_arrivals_products" class="w-full border border-slate-300 rounded-lg p-2 text-sm" required>
            <p class="text-xs text-slate-500 mt-1">Must be unique. Use lowercase and underscores.</p>
            @error('section_key') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Display Title *</label>
            <input type="text" name="title" value="{{ old('title') }}" placeholder="e.g. New Arrivals" class="w-full border border-slate-300 rounded-lg p-2 text-sm" required>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium mb-1">Layout Style</label>
                <select name="layout" class="w-full border border-slate-300 rounded-lg p-2 text-sm">
                    <option value="grid">Grid Layout</option>
                    <option value="slider">Slider Layout</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Product Limit</label>
                <input type="number" name="limit" value="{{ old('limit', 8) }}" class="w-full border border-slate-300 rounded-lg p-2 text-sm">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4 items-center">
            <div>
                <label class="block text-sm font-medium mb-1">Sort Order</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" class="w-full border border-slate-300 rounded-lg p-2 text-sm">
            </div>
            <div class="pt-5">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" checked class="w-5 h-5 text-indigo-600 rounded">
                    <span class="text-sm font-bold text-slate-700">Is Active</span>
                </label>
            </div>
        </div>

        <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-lg text-sm font-medium hover:bg-indigo-700 mt-4">Create Section</button>
    </form>
</section>
@endsection