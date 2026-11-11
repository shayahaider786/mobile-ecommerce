@extends('admin.layouts.app')

@section('title', 'Add Banner')

@section('content')
<section class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-slate-200 max-w-3xl">
    <h1 class="text-2xl font-bold mb-6">Add Hero Banner</h1>

    <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium mb-1">Desktop Image (Wide) *</label>
                <input type="file" name="desktop_image" accept="image/*" class="w-full border rounded p-2" required>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Mobile Image (Square)</label>
                <input type="file" name="mobile_image" accept="image/*" class="w-full border rounded p-2">
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Title</label>
            <input type="text" name="title" class="w-full border rounded p-2">
        </div>
        
        <div>
            <label class="block text-sm font-medium mb-1">Subtitle / Description</label>
            <input type="text" name="subtitle" class="w-full border rounded p-2">
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium mb-1">Button Name</label>
                <input type="text" name="button_name" placeholder="e.g. Shop Now" class="w-full border rounded p-2">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Button Link</label>
                <input type="text" name="link" placeholder="e.g. /categories" class="w-full border rounded p-2">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4 items-center">
            <div>
                <label class="block text-sm font-medium mb-1">Sort Order (0 = First)</label>
                <input type="number" name="sort_order" value="0" class="w-full border rounded p-2">
            </div>
            <div class="pt-6">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" checked class="w-5 h-5">
                    <span class="text-sm font-medium">Is Active</span>
                </label>
            </div>
        </div>

        <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded hover:bg-indigo-700 mt-4">Save Banner</button>
    </form>
</section>
@endsection