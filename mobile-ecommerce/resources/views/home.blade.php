@extends('layouts.app')

@section('title', 'ShopEase - Home')

@section('content')

    <!-- ================= 1. HERO BANNER SECTION ================= -->
    <section class="relative bg-indigo-900 overflow-hidden">
        <div class="absolute inset-0">
            <!-- Background Image Overlay -->
            <img src="https://images.unsplash.com/photo-1607082348824-0a96f2a4b9da?q=80&w=2070&auto=format&fit=crop"
                alt="Banner Background" class="w-full h-full object-cover opacity-30">
            <div class="absolute inset-0 bg-gradient-to-r from-indigo-900/90 to-indigo-900/40"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 md:py-32 flex items-center">
            <div class="md:w-1/2">
                <span
                    class="inline-block py-1 px-3 rounded-full bg-indigo-500/20 text-indigo-300 text-sm font-semibold tracking-wider mb-4 border border-indigo-400/30">NEW
                    ARRIVALS</span>
                <h1 class="text-4xl md:text-6xl font-extrabold text-white leading-tight mb-6">
                    Discover Your <br> Perfect Style.
                </h1>
                <p class="text-lg text-indigo-100 mb-8 max-w-lg">
                    Shop the latest trends in fashion, electronics, and lifestyle. Premium quality at unbeatable prices.
                </p>
                <div class="flex space-x-4">
                    <a href="#"
                        class="bg-white text-indigo-900 px-8 py-3 rounded-lg font-bold hover:bg-indigo-50 transition shadow-lg">Shop
                        Now</a>
                    <a href="#"
                        class="border border-white text-white px-8 py-3 rounded-lg font-bold hover:bg-white/10 transition">View
                        Collections</a>
                </div>
            </div>
        </div>
    </section>

    <!-- ================= 2. CATEGORIES SECTION (Circular Slider) ================= -->
    <section class="py-16 bg-white overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-end mb-10">
                <div>
                    <h2 class="text-3xl font-bold text-slate-900">Shop by Category</h2>
                    <p class="text-slate-500 mt-2">Find exactly what you're looking for.</p>
                </div>

                <!-- Slider Arrows -->
                <div class="flex items-center gap-4">
                    <div class="flex items-center gap-2">
                        <button id="category-prev"
                            class="p-2 rounded-full border border-slate-200 hover:bg-slate-100 text-slate-700 transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                                </path>
                            </svg>
                        </button>
                        <button id="category-next"
                            class="p-2 rounded-full border border-slate-200 hover:bg-slate-100 text-slate-700 transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                </path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Slider Container -->
            <div class="relative">
                <div id="category-slider" class="category-slider-track flex gap-8 overflow-x-auto pb-6 pt-2 scroll-smooth">
                    @forelse($categories as $index => $category)
                        <a href="{{ route('categories.show', $category->slug) }}"
                            class="category-item group flex flex-col items-center flex-shrink-0 text-center">
                            <!-- Round Colored Background Box -->
                            <div class="category-circle-box circle-bg-{{ $index % 5 }}">
                                @if ($category->image)
                                    <img src="{{ asset('category-images/' . $category->image) }}"
                                        alt="{{ $category->name }}"
                                        class="w-4/5 h-4/5 object-contain group-hover:scale-110 transition-transform duration-300">
                                @else
                                    <span class="text-slate-500 text-xs font-semibold">No Image</span>
                                @endif
                            </div>
                            <!-- Category Name Below -->
                            <h3 class="mt-3 text-slate-800 font-bold text-base group-hover:text-teal-600 transition-colors">
                                {{ $category->name }}
                            </h3>
                        </a>
                    @empty
                        <!-- Dummy Categories with Dynamic Background Colors -->
                        @php
                            $dummies = [
                                ['name' => 'DataCable', 'bg' => 'bg-emerald-200'],
                                ['name' => 'Headphone', 'bg' => 'bg-pink-200'],
                                ['name' => 'Power Banks', 'bg' => 'bg-sky-200'],
                                ['name' => 'Charger', 'bg' => 'bg-amber-200'],
                                ['name' => 'Car & Clip', 'bg' => 'bg-rose-300'],
                                ['name' => 'Hand\'sFree', 'bg' => 'bg-lime-200'],
                                ['name' => 'Wireless Earbuds', 'bg' => 'bg-purple-300'],
                                ['name' => 'NeckBands', 'bg' => 'bg-teal-300'],
                                ['name' => 'OTG Card-Readers', 'bg' => 'bg-yellow-300'],
                            ];
                        @endphp

                        @foreach ($dummies as $dummy)
                            <a href="#"
                                class="category-item group flex flex-col items-center flex-shrink-0 text-center">
                                <div
                                    class="category-circle-box {{ $dummy['bg'] }} flex items-center justify-center shadow-sm">
                                    <span class="text-slate-700 font-bold text-sm px-2">{{ $dummy['name'] }}</span>
                                </div>
                                <h3
                                    class="mt-3 text-slate-800 font-bold text-base group-hover:text-teal-600 transition-colors">
                                    {{ $dummy['name'] }}
                                </h3>
                            </a>
                        @endforeach
                    @endforelse
                </div>
            </div>
        </div>
    </section>

    <!-- ================= 3. TRENDING PRODUCTS ================= -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10">
                <h2 class="text-3xl font-bold text-slate-900">Trending Now</h2>
                <p class="text-slate-500 mt-2">Most popular picks this week.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Dummy Product Cards -->
                @for ($i = 0; $i < 4; $i++)
                    <div class="bg-white rounded-xl shadow-sm hover:shadow-lg transition group relative overflow-hidden">
                        <div class="relative h-64 bg-slate-200 overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1523381210434-271e8be1f52b?q=80&w=800&auto=format&fit=crop"
                                alt="Product"
                                class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            <button
                                class="absolute top-3 right-3 bg-white p-2 rounded-full shadow-md text-slate-400 hover:text-red-500 transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                                    </path>
                                </svg>
                            </button>
                        </div>
                        <div class="p-5">
                            <p class="text-sm text-indigo-600 font-semibold mb-1">Category</p>
                            <h3 class="text-lg font-bold text-slate-900 mb-2 truncate">Trending Product Name</h3>
                            <div class="flex items-center justify-between">
                                <p class="text-xl font-bold text-slate-900">$99.00</p>
                                <button class="bg-slate-900 text-white p-2 rounded-lg hover:bg-indigo-600 transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                                        </path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </section>

    <!-- ================= 4. BEST SELLING PRODUCTS (3 Image Grid) ================= -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10">
                <h2 class="text-3xl font-bold text-slate-900">Best Selling</h2>
                <p class="text-slate-500 mt-2">Our customers' favorites.</p>
            </div>

            <!-- 3 Image Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <!-- Image 1 -->
                <div class="relative rounded-2xl overflow-hidden h-96 group">
                    <img src="https://images.unsplash.com/photo-1490481651871-ab68de25d43d?q=80&w=800&auto=format&fit=crop"
                        alt="Collection 1"
                        class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    <div class="absolute inset-0 bg-black/30 group-hover:bg-black/40 transition"></div>
                    <div class="absolute inset-0 flex flex-col justify-end p-8">
                        <h3 class="text-2xl font-bold text-white mb-2">Women's Fashion</h3>
                        <a href="#"
                            class="text-white font-semibold underline decoration-2 underline-offset-4 hover:text-indigo-300">Shop
                            Collection</a>
                    </div>
                </div>

                <!-- Image 2 -->
                <div class="relative rounded-2xl overflow-hidden h-96 group">
                    <img src="https://images.unsplash.com/photo-1523275335684-37898b6baf30?q=80&w=800&auto=format&fit=crop"
                        alt="Collection 2"
                        class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    <div class="absolute inset-0 bg-black/30 group-hover:bg-black/40 transition"></div>
                    <div class="absolute inset-0 flex flex-col justify-end p-8">
                        <h3 class="text-2xl font-bold text-white mb-2">Premium Watches</h3>
                        <a href="#"
                            class="text-white font-semibold underline decoration-2 underline-offset-4 hover:text-indigo-300">Shop
                            Collection</a>
                    </div>
                </div>

                <!-- Image 3 -->
                <div class="relative rounded-2xl overflow-hidden h-96 group">
                    <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?q=80&w=800&auto=format&fit=crop"
                        alt="Collection 3"
                        class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    <div class="absolute inset-0 bg-black/30 group-hover:bg-black/40 transition"></div>
                    <div class="absolute inset-0 flex flex-col justify-end p-8">
                        <h3 class="text-2xl font-bold text-white mb-2">Sports Shoes</h3>
                        <a href="#"
                            class="text-white font-semibold underline decoration-2 underline-offset-4 hover:text-indigo-300">Shop
                            Collection</a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ================= 5. FEATURED PRODUCTS ================= -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-end mb-10">
                <div>
                    <h2 class="text-3xl font-bold text-slate-900">Featured Products</h2>
                    <p class="text-slate-500 mt-2">Handpicked just for you.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @for ($i = 0; $i < 4; $i++)
                    <div class="bg-white rounded-xl shadow-sm hover:shadow-lg transition group relative overflow-hidden">
                        <div class="relative h-64 bg-slate-200 overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?q=80&w=800&auto=format&fit=crop"
                                alt="Product"
                                class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            <div
                                class="absolute top-3 left-3 bg-indigo-600 text-white text-xs font-bold px-2 py-1 rounded">
                                FEATURED</div>
                        </div>
                        <div class="p-5">
                            <p class="text-sm text-slate-500 mb-1">Electronics</p>
                            <h3 class="text-lg font-bold text-slate-900 mb-2 truncate">Wireless Headphones</h3>
                            <div class="flex items-center justify-between mt-4">
                                <p class="text-xl font-bold text-slate-900">$199.00</p>
                                <a href="#"
                                    class="text-indigo-600 font-semibold text-sm hover:text-indigo-800">Details</a>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </section>

    <!-- ================= 6. TESTIMONIALS ================= -->
    <section class="py-20 bg-indigo-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-white">What Our Customers Say</h2>
                <p class="text-indigo-200 mt-2">Trusted by thousands of happy shoppers.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                <!-- Testimonial 1 -->
                <div class="bg-white/10 backdrop-blur-lg rounded-2xl p-8 border border-white/20">
                    <div class="flex text-yellow-400 mb-4">
                        ★★★★★
                    </div>
                    <p class="text-indigo-50 mb-6 italic">"Absolutely love the quality of products here. The delivery was
                        super fast and the packaging was premium. Highly recommended!"</p>
                    <div class="flex items-center">
                        <img src="https://i.pravatar.cc/150?img=1" alt="User"
                            class="w-12 h-12 rounded-full mr-4 border-2 border-indigo-400">
                        <div>
                            <h4 class="text-white font-bold">Sarah Khan</h4>
                            <p class="text-indigo-300 text-sm">Verified Buyer</p>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 2 -->
                <div class="bg-white/10 backdrop-blur-lg rounded-2xl p-8 border border-white/20">
                    <div class="flex text-yellow-400 mb-4">
                        ★★★★★
                    </div>
                    <p class="text-indigo-50 mb-6 italic">"ShopEase is my go-to store for everything now. The website is so
                        easy to use and they always have amazing discounts."</p>
                    <div class="flex items-center">
                        <img src="https://i.pravatar.cc/150?img=2" alt="User"
                            class="w-12 h-12 rounded-full mr-4 border-2 border-indigo-400">
                        <div>
                            <h4 class="text-white font-bold">Ali Raza</h4>
                            <p class="text-indigo-300 text-sm">Verified Buyer</p>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 3 -->
                <div class="bg-white/10 backdrop-blur-lg rounded-2xl p-8 border border-white/20">
                    <div class="flex text-yellow-400 mb-4">
                        ★★★★★
                    </div>
                    <p class="text-indigo-50 mb-6 italic">"Best customer service I've experienced in a long time. Had a
                        small issue with sizing and they resolved it immediately."</p>
                    <div class="flex items-center">
                        <img src="https://i.pravatar.cc/150?img=5" alt="User"
                            class="w-12 h-12 rounded-full mr-4 border-2 border-indigo-400">
                        <div>
                            <h4 class="text-white font-bold">Ayesha Malik</h4>
                            <p class="text-indigo-300 text-sm">Verified Buyer</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection
