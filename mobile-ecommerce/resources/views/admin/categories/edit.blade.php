@extends('admin.layouts.app')

@section('title', 'Edit Category')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">
    <div class="flex items-center justify-between">
        <h1 class="text-xl sm:text-2xl font-bold text-slate-900 tracking-tight">Edit Category: {{ $category->name }}</h1>
        <a href="{{ route('admin.categories.index') }}" class="text-sm font-medium text-slate-500 hover:text-slate-800 transition flex items-center gap-1">
            &larr; Back to Categories
        </a>
    </div>

    <!-- Validation Errors -->
    @if ($errors->any())
        <div class="rounded-xl bg-rose-50 border border-rose-200 px-4 py-3.5 text-rose-800 text-sm shadow-xs">
            <ul class="list-disc list-inside space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow-xs ring-1 ring-slate-200/80 p-6 sm:p-8">
        <form action="{{ route('admin.categories.update', $category) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Category Name *</label>
                <input type="text" name="name" value="{{ old('name', $category->name) }}"
                    class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition">
                @error('name')
                    <p class="text-rose-600 text-xs mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Description</label>
                <textarea name="description" rows="3"
                    class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition">{{ old('description', $category->description) }}</textarea>
            </div>

            <div class="border border-slate-200 p-4 rounded-xl bg-slate-50/50">
                <label class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Category Image</label>
                @if ($category->image)
                    <div class="w-20 h-20 rounded-xl overflow-hidden border border-slate-200 mb-3 bg-white shadow-xs">
                        <img src="{{ asset('category-images/' . $category->image) }}" class="w-full h-full object-cover" alt="{{ $category->name }}">
                    </div>
                @else
                    <div class="w-20 h-20 rounded-xl bg-slate-100 mb-3 flex items-center justify-center border border-slate-200 text-slate-400 text-xs">
                        No Image
                    </div>
                @endif
                <input type="file" name="image" accept="image/*" class="w-full text-xs text-slate-500 file:mr-2 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 border border-slate-200 rounded-lg p-1 bg-white">
                <p class="text-[11px] text-slate-400 mt-1.5">Leave empty to keep current image.</p>
            </div>

            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Sort Order</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', $category->sort_order) }}"
                    class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition">
            </div>

            <div>
                <label class="flex items-center gap-3 cursor-pointer p-3 rounded-xl border border-slate-200 bg-slate-50/50 hover:bg-slate-50 transition">
                    <input type="checkbox" name="is_active" value="1"
                        {{ old('is_active', $category->is_active) ? 'checked' : '' }} class="w-4 h-4 text-indigo-600 rounded border-slate-300 focus:ring-indigo-500">
                    <span class="text-sm font-medium text-slate-700">Active (Visible to store visitors)</span>
                </label>
            </div>

            <div class="pt-4 border-t border-slate-100 flex items-center gap-3">
                <button type="submit" class="bg-indigo-600 text-white px-6 py-2.5 rounded-xl hover:bg-indigo-500 font-medium text-sm transition shadow-sm shadow-indigo-200">
                    Update Category
                </button>
                <a href="{{ route('admin.categories.index') }}" class="bg-slate-100 text-slate-600 px-6 py-2.5 rounded-xl hover:bg-slate-200 font-medium text-sm transition">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection