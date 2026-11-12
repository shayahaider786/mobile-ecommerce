@extends('admin.layouts.app')

@section('title', 'Add Category')

@section('content')
    <div class="max-w-2xl mx-auto space-y-6">
        <div class="flex items-center justify-between">
            <h1 class="text-xl sm:text-2xl font-bold text-slate-900 tracking-tight">Add Category</h1>
            <a href="{{ route('admin.categories.index') }}"
                class="text-sm font-medium text-slate-500 hover:text-slate-800 transition flex items-center gap-1">
                &larr; Back to Categories
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-xs ring-1 ring-slate-200/80 p-6 sm:p-8">
            <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf

                {{-- Name --}}
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Category Name
                        *</label>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="e.g. Mobile Accessories"
                        class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition">
                    @error('name')
                        <p class="text-rose-600 text-xs mt-1.5">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Description --}}
                <div>
                    <label
                        class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Description</label>
                    <textarea name="description" rows="3" placeholder="Short description about the category..."
                        class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-rose-600 text-xs mt-1.5">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Parent Category
                        (Optional)</label>
                    <select name="parent_id"
                        class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition bg-white">
                        <option value="">-- None (Main Category) --</option>
                        @foreach ($parentCategories as $parent)
                            <option value="{{ $parent->id }}" {{ old('parent_id') == $parent->id ? 'selected' : '' }}>
                                {{ $parent->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Image --}}
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Category Image /
                        Icon</label>
                    <input type="file" name="image" accept="image/*"
                        class="w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 border border-slate-200 rounded-xl p-1 bg-slate-50/50">
                    @error('image')
                        <p class="text-rose-600 text-xs mt-1.5">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Sort Order --}}
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Sort
                        Order</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}"
                        class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition">
                </div>

                {{-- Is Active --}}
                <div>
                    <label
                        class="flex items-center gap-3 cursor-pointer p-3 rounded-xl border border-slate-200 bg-slate-50/50 hover:bg-slate-50 transition">
                        <input type="checkbox" name="is_active" value="1" id="is_active"
                            {{ old('is_active', true) ? 'checked' : '' }}
                            class="w-4 h-4 text-indigo-600 rounded border-slate-300 focus:ring-indigo-500">
                        <span class="text-sm font-medium text-slate-700">Active (Visible to store visitors)</span>
                    </label>
                </div>

                {{-- Buttons --}}
                <div class="pt-4 border-t border-slate-100 flex items-center gap-3">
                    <button type="submit"
                        class="bg-indigo-600 text-white px-6 py-2.5 rounded-xl hover:bg-indigo-500 font-medium text-sm transition shadow-sm shadow-indigo-200">
                        Save Category
                    </button>
                    <a href="{{ route('admin.categories.index') }}"
                        class="bg-slate-100 text-slate-600 px-6 py-2.5 rounded-xl hover:bg-slate-200 font-medium text-sm transition">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
