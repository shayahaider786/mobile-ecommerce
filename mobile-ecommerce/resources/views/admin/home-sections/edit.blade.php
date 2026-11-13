@extends('admin.layouts.app')

@section('title', 'Edit Homepage Section')

@section('content')
<section class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-slate-200 max-w-2xl">
    <h1 class="text-2xl font-bold mb-6">Edit Section: {{ $homeSection->title }}</h1>

    <form action="{{ route('admin.home-sections.update', $homeSection) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')
        
        <div>
            <label class="block text-sm font-medium mb-1">Section Key</label>
            <input type="text" value="{{ $homeSection->section_key }}" class="w-full border border-slate-300 rounded-lg p-2 text-sm bg-slate-100" disabled>
            <p class="text-xs text-slate-500 mt-1">Section key cannot be changed.</p>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Display Title *</label>
            <input type="text" name="title" value="{{ old('title', $homeSection->title) }}" class="w-full border border-slate-300 rounded-lg p-2 text-sm" required>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium mb-1">Layout Style</label>
                <select name="layout" class="w-full border border-slate-300 rounded-lg p-2 text-sm">
                    <option value="grid" {{ $homeSection->layout == 'grid' ? 'selected' : '' }}>Grid Layout</option>
                    <option value="slider" {{ $homeSection->layout == 'slider' ? 'selected' : '' }}>Slider Layout</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Product Limit</label>
                <input type="number" name="limit" value="{{ old('limit', $homeSection->limit) }}" class="w-full border border-slate-300 rounded-lg p-2 text-sm">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4 items-center">
            <div>
                <label class="block text-sm font-medium mb-1">Sort Order</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', $homeSection->sort_order) }}" class="w-full border border-slate-300 rounded-lg p-2 text-sm">
            </div>
            <div class="pt-5">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" {{ $homeSection->is_active ? 'checked' : '' }} class="w-5 h-5 text-indigo-600 rounded">
                    <span class="text-sm font-bold text-slate-700">Is Active</span>
                </label>
            </div>
        </div>

        <div class="flex gap-3 pt-4 border-t border-slate-100 mt-4">
            <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-lg text-sm font-medium hover:bg-indigo-700">Update Section</button>
            <a href="{{ route('admin.home-sections.index') }}" class="bg-slate-200 text-slate-700 px-6 py-2 rounded-lg text-sm font-medium hover:bg-slate-300">Cancel</a>
        </div>
    </form>
</section>
@endsection