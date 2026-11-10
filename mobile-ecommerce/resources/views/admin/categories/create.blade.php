@extends('admin.layouts.app')

@section('title', 'Add Category')

@section('content')
    <section class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-slate-200 max-w-2xl">
        <h1 class="text-2xl font-bold mb-6">Add Category</h1>

        <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf

            {{-- Name --}}
            <div>
                <label class="block text-sm font-medium mb-1">Category Name *</label>
                <input type="text" name="name" value="{{ old('name') }}"
                    class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500">
                @error('name')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Description --}}
            <div>
                <label class="block text-sm font-medium mb-1">Description</label>
                <textarea name="description" rows="3" class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Image --}}
            <div>
                <label class="block text-sm font-medium mb-1">Image</label>
                <input type="file" name="image" accept="image/*" class="w-full border rounded-lg px-4 py-2">
                @error('image')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Sort Order --}}
            <div>
                <label class="block text-sm font-medium mb-1">Sort Order</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}"
                    class="w-full border rounded-lg px-4 py-2">
            </div>

            {{-- Is Active --}}
            <div class="flex items-center gap-2">
                <input type="checkbox" name="is_active" value="1" id="is_active"
                    {{ old('is_active', true) ? 'checked' : '' }} class="w-4 h-4">
                <label for="is_active" class="text-sm">Active (customer ko dikhegi)</label>
            </div>

            {{-- Buttons --}}
            <div class="flex gap-3 pt-4">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">
                    Save Category
                </button>
                <a href="{{ route('admin.categories.index') }}"
                    class="bg-gray-300 text-gray-800 px-6 py-2 rounded-lg hover:bg-gray-400">
                    Cancel
                </a>
            </div>
        </form>
    </section>
@endsection
