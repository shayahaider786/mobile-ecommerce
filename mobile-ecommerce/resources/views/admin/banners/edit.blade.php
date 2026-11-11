@extends('admin.layouts.app')

@section('title', 'Edit Banner')

@section('content')
<section class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-slate-200 max-w-3xl">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Edit Hero Banner</h1>
        <a href="{{ route('admin.banners.index') }}" class="text-slate-500 hover:text-slate-800 text-sm font-medium">
            &larr; Back to Banners
        </a>
    </div>

    <!-- Validation Errors -->
    @if ($errors->any())
        <div class="mb-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded">
            <ul class="list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Important: enctype="multipart/form-data" zaroori hai image upload ke liye -->
    <form action="{{ route('admin.banners.update', $banner->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT') <!-- Update ke liye PUT method zaroori hai -->
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Desktop Image -->
            <div class="border p-4 rounded-lg bg-slate-50">
                <label class="block text-sm font-medium mb-2">Desktop Image (Wide)</label>
                
                <!-- Purani Image ka Preview -->
                <img src="{{ asset('banners/'.$banner->desktop_image) }}" class="w-full h-32 object-cover rounded mb-3 border border-slate-200" alt="Desktop Banner">
                
                <input type="file" name="desktop_image" accept="image/*" class="w-full border rounded p-2 bg-white text-sm">
                <p class="text-xs text-slate-500 mt-1">Leave empty to keep the current image.</p>
            </div>

            <!-- Mobile Image -->
            <div class="border p-4 rounded-lg bg-slate-50">
                <label class="block text-sm font-medium mb-2">Mobile Image (Square)</label>
                
                <!-- Purani Mobile Image ka Preview (Agar hai) -->
                @if($banner->mobile_image)
                    <img src="{{ asset('banners/'.$banner->mobile_image) }}" class="w-full h-32 object-cover rounded mb-3 border border-slate-200" alt="Mobile Banner">
                @else
                    <div class="w-full h-32 bg-slate-200 rounded mb-3 flex items-center justify-center border border-slate-300">
                        <span class="text-slate-500 text-sm">No Mobile Image</span>
                    </div>
                @endif
                
                <input type="file" name="mobile_image" accept="image/*" class="w-full border rounded p-2 bg-white text-sm">
                <p class="text-xs text-slate-500 mt-1">Leave empty to keep the current image.</p>
            </div>
        </div>

        <!-- Title -->
        <div>
            <label class="block text-sm font-medium mb-1">Title</label>
            <input type="text" name="title" value="{{ old('title', $banner->title) }}" class="w-full border rounded p-2 focus:ring-2 focus:ring-indigo-500">
        </div>
        
        <!-- Subtitle -->
        <div>
            <label class="block text-sm font-medium mb-1">Subtitle / Description</label>
            <input type="text" name="subtitle" value="{{ old('subtitle', $banner->subtitle) }}" class="w-full border rounded p-2 focus:ring-2 focus:ring-indigo-500">
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Button Name -->
            <div>
                <label class="block text-sm font-medium mb-1">Button Name</label>
                <input type="text" name="button_name" value="{{ old('button_name', $banner->button_name) }}" class="w-full border rounded p-2 focus:ring-2 focus:ring-indigo-500">
            </div>
            
            <!-- Button Link -->
            <div>
                <label class="block text-sm font-medium mb-1">Button Link</label>
                <input type="text" name="link" value="{{ old('link', $banner->link) }}" class="w-full border rounded p-2 focus:ring-2 focus:ring-indigo-500">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-center">
            <!-- Sort Order -->
            <div>
                <label class="block text-sm font-medium mb-1">Sort Order</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', $banner->sort_order) }}" class="w-full border rounded p-2 focus:ring-2 focus:ring-indigo-500">
            </div>
            
            <!-- Is Active -->
            <div class="pt-6">
                <label class="flex items-center gap-2 cursor-pointer">
                    <!-- Checkbox logic: Agar active hai ya old value hai toh checked rahe -->
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $banner->is_active) ? 'checked' : '' }} class="w-5 h-5">
                    <span class="text-sm font-medium">Is Active (Show on website)</span>
                </label>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="pt-4 border-t border-slate-100 flex gap-3">
            <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded hover:bg-indigo-700 font-medium">
                Update Banner
            </button>
            <a href="{{ route('admin.banners.index') }}" class="bg-slate-200 text-slate-700 px-6 py-2 rounded hover:bg-slate-300 font-medium">
                Cancel
            </a>
        </div>
    </form>
</section>
@endsection