@extends('admin.layouts.app')

@section('title', 'Banners')

@section('content')
<section class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Hero Banners</h1>
        <a href="{{ route('admin.banners.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">+ Add Banner</a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-slate-50 border-b">
                <tr>
                    <th class="px-4 py-3">Preview (Desktop)</th>
                    <th class="px-4 py-3">Title</th>
                    <th class="px-4 py-3">Sort</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($banners as $banner)
                    <tr class="border-b">
                        <td class="px-4 py-3">
                            <img src="{{ asset('banners/'.$banner->desktop_image) }}" class="w-32 h-16 object-cover rounded" alt="Banner">
                        </td>
                        <td class="px-4 py-3 font-medium">{{ $banner->title ?? 'N/A' }}</td>
                        <td class="px-4 py-3">{{ $banner->sort_order }}</td>
                        <td class="px-4 py-3">
                            <span class="{{ $banner->is_active ? 'text-green-600' : 'text-red-600' }}">
                                {{ $banner->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="px-4 py-3 flex gap-2">
                            <a href="{{ route('admin.banners.edit', $banner) }}" class="text-amber-600 hover:underline">Edit</a>
                            <form action="{{ route('admin.banners.destroy', $banner) }}" method="POST" onsubmit="return confirm('Delete?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center py-6 text-slate-500">No banners found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</section>
@endsection