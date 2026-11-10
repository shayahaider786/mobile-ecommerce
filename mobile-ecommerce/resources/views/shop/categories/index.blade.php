@extends('layouts.app')

@section('title', 'Shop by Category')

@section('content')
<div class="max-w-6xl mx-auto p-6">
    <h1 class="text-3xl font-bold mb-8">Shop by Category</h1>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
        @forelse($categories as $category)
            <a href="{{ route('categories.show', $category->slug) }}"
               class="group bg-white rounded-lg shadow hover:shadow-lg transition overflow-hidden">
                @if($category->image)
                    <img src="{{ asset('category-images/'.$category->image) }}"
                         alt="{{ $category->name }}"
                         class="w-full h-40 object-cover">
                @else
                    <div class="w-full h-40 bg-gray-200 flex items-center justify-center">
                        <span class="text-gray-400">No image</span>
                    </div>
                @endif
                <div class="p-4">
                    <h2 class="font-semibold text-lg">{{ $category->name }}</h2>
                </div>
            </a>
        @empty
            <p class="col-span-4 text-center text-gray-500">Koi category nahi hai.</p>
        @endforelse
    </div>
</div>
@endsection