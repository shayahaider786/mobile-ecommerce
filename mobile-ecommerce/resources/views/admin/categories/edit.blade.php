@extends('admin.layouts.app')

@section('title', 'Edit Category')

@section('content')
    <section class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-slate-200 max-w-2xl">
        <h1 class="text-2xl font-bold mb-6">Edit: {{ $category->name }}</h1>

        <form action="{{ route('admin.categories.update', $category) }}" method="POST" enctype="multipart/form-data"
            class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium mb-1">Category Name *</label>
                <input type="text" name="name" value="{{ old('name', $category->name) }}"
                    class="w-full border rounded-lg px-4 py-2">
                @error('name')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Description</label>
                <textarea name="description" rows="3" class="w-full border rounded-lg px-4 py-2">{{ old('description', $category->description) }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Current Image</label>
                @if ($category->image)
                    <img src="{{ asset('category-images/' . $category->image) }}" class="w-24 h-24 object-cover rounded mb-2" alt="{{ $category->name }}">
                @endif
                <input type="file" name="image" accept="image/*" class="w-full border rounded-lg px-4 py-2">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Sort Order</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', $category->sort_order) }}"
                    class="w-full border rounded-lg px-4 py-2">
            </div>

            <div class="flex items-center gap-2">
                <input type="checkbox" name="is_active" value="1"
                    {{ old('is_active', $category->is_active) ? 'checked' : '' }} class="w-4 h-4">
                <label class="text-sm">Active</label>
            </div>

            <div class="flex gap-3 pt-4">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">
                    Update Category
                </button>
                <a href="{{ route('admin.categories.index') }}" class="bg-gray-300 text-gray-800 px-6 py-2 rounded-lg">
                    Cancel
                </a>
            </div>
        </form>
    </section>
@endsection
