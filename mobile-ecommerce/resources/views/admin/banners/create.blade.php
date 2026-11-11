@extends('admin.layouts.app')

@section('title', 'Add Banner')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    <div class="flex items-center justify-between">
        <h1 class="text-xl sm:text-2xl font-bold text-slate-900 tracking-tight">Add Hero Banner</h1>
        <a href="{{ route('admin.banners.index') }}" class="text-sm font-medium text-slate-500 hover:text-slate-800 transition flex items-center gap-1">
            &larr; Back to Banners
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-xs ring-1 ring-slate-200/80 p-6 sm:p-8">
        <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Desktop Image (Wide) *</label>
                    <input type="file" name="desktop_image" accept="image/*" class="w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 border border-slate-200 rounded-xl p-1 bg-slate-50/50" required>
                </div>
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Mobile Image (Square)</label>
                    <input type="file" name="mobile_image" accept="image/*" class="w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-slate-100 file:text-slate-700 hover:file:bg-slate-200 border border-slate-200 rounded-xl p-1 bg-slate-50/50">
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Title</label>
                <input type="text" name="title" placeholder="e.g. Mega Summer Sale" class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition">
            </div>
            
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Subtitle / Description</label>
                <input type="text" name="subtitle" placeholder="e.g. Discover the latest electronics & mobile accessories" class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Button Name</label>
                    <input type="text" name="button_name" placeholder="e.g. Shop Now" class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition">
                </div>
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Button Link</label>
                    <input type="text" name="link" placeholder="e.g. /categories" class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 items-center pt-2">
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Sort Order (0 = First)</label>
                    <input type="number" name="sort_order" value="0" class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition">
                </div>
                <div class="sm:pt-6">
                    <label class="flex items-center gap-3 cursor-pointer p-3 rounded-xl border border-slate-200 bg-slate-50/50 hover:bg-slate-50 transition">
                        <input type="checkbox" name="is_active" value="1" checked class="w-4 h-4 text-indigo-600 rounded border-slate-300 focus:ring-indigo-500">
                        <span class="text-sm font-medium text-slate-700">Is Active (Show on website)</span>
                    </label>
                </div>
            </div>

            <div class="pt-6 border-t border-slate-100 flex items-center gap-3">
                <button type="submit" class="bg-indigo-600 text-white px-6 py-2.5 rounded-xl hover:bg-indigo-500 font-medium text-sm transition shadow-sm shadow-indigo-200">
                    Save Banner
                </button>
                <a href="{{ route('admin.banners.index') }}" class="bg-slate-100 text-slate-600 px-6 py-2.5 rounded-xl hover:bg-slate-200 font-medium text-sm transition">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection