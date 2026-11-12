@extends('admin.layouts.app')

@section('title', 'Add Navigation Link')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">
    <div class="flex items-center justify-between">
        <h1 class="text-xl sm:text-2xl font-bold text-slate-900 tracking-tight">Add Menu Link</h1>
        <a href="{{ route('admin.navigation.index') }}" class="text-sm font-medium text-slate-500 hover:text-slate-800 transition flex items-center gap-1">
            &larr; Back to Navigation
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-xs ring-1 ring-slate-200/80 p-6 sm:p-8">
        <form action="{{ route('admin.navigation.store') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Link Title *</label>
                <input type="text" name="title" value="{{ old('title') }}" placeholder="e.g. Products"
                    class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition" required>
            </div>

            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Link Type *</label>
                <select name="type" id="link-type" class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition bg-white" required>
                    <option value="custom" {{ old('type') == 'custom' ? 'selected' : '' }}>Custom URL</option>
                    <option value="category" {{ old('type') == 'category' ? 'selected' : '' }}>Category Link</option>
                </select>
            </div>

            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Parent Link (Optional)</label>
                <select name="parent_id" class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition bg-white">
                    <option value="">-- None (Main Menu Link) --</option>
                    @foreach ($parentLinks as $parent)
                        <option value="{{ $parent->id }}"
                            {{ old('parent_id') == $parent->id ? 'selected' : '' }}>
                            {{ $parent->title }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Custom URL Input -->
            <div id="custom-url-div" class="{{ old('type') == 'category' ? 'hidden' : '' }}">
                <label class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Custom URL</label>
                <input type="text" name="url" value="{{ old('url') }}" placeholder="e.g. /about-us"
                    class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition">
            </div>

            <!-- Category Dropdown -->
            <div id="category-div" class="{{ old('type') == 'category' ? '' : 'hidden' }}">
                <label class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Select Category</label>
                <select name="category_id" class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition bg-white">
                    <option value="">-- Choose Category --</option>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 items-center pt-2">
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Sort Order</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}"
                        class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition">
                </div>
                <div class="sm:pt-6">
                    <label class="flex items-center gap-3 cursor-pointer p-3 rounded-xl border border-slate-200 bg-slate-50/50 hover:bg-slate-50 transition">
                        <input type="checkbox" name="is_active" value="1" checked class="w-4 h-4 text-indigo-600 rounded border-slate-300 focus:ring-indigo-500">
                        <span class="text-sm font-medium text-slate-700">Is Active</span>
                    </label>
                </div>
            </div>

            <div class="pt-4 border-t border-slate-100 flex items-center gap-3">
                <button type="submit" class="bg-indigo-600 text-white px-6 py-2.5 rounded-xl hover:bg-indigo-500 font-medium text-sm transition shadow-sm shadow-indigo-200">
                    Save Link
                </button>
                <a href="{{ route('admin.navigation.index') }}" class="bg-slate-100 text-slate-600 px-6 py-2.5 rounded-xl hover:bg-slate-200 font-medium text-sm transition">
                    Cancel
                </a>
            </div>
        </form>
    </div>

    <!-- Form toggle script -->
    <script>
        document.getElementById('link-type').addEventListener('change', function() {
            const customDiv = document.getElementById('custom-url-div');
            const categoryDiv = document.getElementById('category-div');

            if (this.value === 'custom') {
                customDiv.classList.remove('hidden');
                categoryDiv.classList.add('hidden');
            } else {
                customDiv.classList.add('hidden');
                categoryDiv.classList.remove('hidden');
            }
        });
    </script>
</div>
@endsection