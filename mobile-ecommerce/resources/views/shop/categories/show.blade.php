@extends('layouts.app')

@section('title', $category->name)

@section('content')
<div class="max-w-6xl mx-auto p-6">
    <nav class="text-sm text-gray-500 mb-4">
        <a href="{{ url('/') }}" class="hover:text-blue-600">Home</a> /
        <a href="{{ route('categories.index') }}" class="hover:text-blue-600">Categories</a> /
        <span class="text-gray-800">{{ $category->name }}</span>
    </nav>

    <h1 class="text-3xl font-bold mb-6">{{ $category->name }}</h1>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
        @forelse($products as $product)
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="p-4">
                    <h3 class="font-semibold">{{ $product->name }}</h3>
                    <p class="text-green-600 font-bold mt-1">Rs. {{ number_format($product->price) }}</p>
                </div>
            </div>
        @empty
            <p class="col-span-4 text-center text-gray-500 py-8">
                Is category mein abhi koi product nahi hai.
            </p>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $products->links() }}
    </div>
</div>
@endsection