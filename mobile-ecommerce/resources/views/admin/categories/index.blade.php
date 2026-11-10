@extends('admin.layouts.app')

@section('title', 'Categories')

@section('content')
<section class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-slate-200">

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Categories</h1>
        <a href="{{ route('admin.categories.create') }}"
           class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">
            + Add Category
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-4 py-3 text-left text-sm">Image</th>
                    <th class="px-4 py-3 text-left text-sm">Name</th>
                    <th class="px-4 py-3 text-left text-sm">Slug</th>
                    <th class="px-4 py-3 text-left text-sm">Status</th>
                    <th class="px-4 py-3 text-left text-sm">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $category)
                    <tr class="border-t border-slate-200">
                        <td class="px-4 py-3">
                            @if($category->image)
                                <img src="{{ asset('category-images/'.$category->image) }}"
                                     class="w-12 h-12 object-cover rounded"
                                     alt="{{ $category->name }}">
                            @else
                                <span class="text-gray-400 text-sm">No image</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 font-medium">{{ $category->name }}</td>
                        <td class="px-4 py-3 text-gray-600 text-sm">{{ $category->slug }}</td>
                        <td class="px-4 py-3">
                            @if($category->is_active)
                                <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs">Active</span>
                            @else
                                <span class="bg-red-100 text-red-800 px-2 py-1 rounded text-xs">Inactive</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 flex gap-2">
                            <a href="{{ route('admin.categories.edit', $category) }}"
                               class="bg-amber-500 text-white px-3 py-1 rounded text-sm hover:bg-amber-600">
                                Edit
                            </a>
                            <form action="{{ route('admin.categories.destroy', $category) }}"
                                  method="POST"
                                  onsubmit="return confirm('Pakka delete karna hai?')">
                                @csrf
                                @method('DELETE')
                                <button class="bg-red-600 text-white px-3 py-1 rounded text-sm hover:bg-red-700">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-8 text-center text-gray-500">
                            Koi category nahi hai. Pehli category add karo!
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</section>
@endsection