@extends('layouts.app')

@section('title', 'ShopEase - Home')

@section('content')

    <!-- ================= 1. HERO BANNER CUSTOM SLIDER ================= -->
    <section class="relative w-full bg-slate-900 overflow-hidden">
        @if ($banners->count() > 0)
            <div class="relative w-full h-[450px] md:h-[450px] sm:h-[400px]">
                <!-- Slider Track -->
                <div id="hero-slider" class="flex w-full h-full transition-transform duration-500 ease-in-out">
                    @foreach ($banners as $banner)
                        <div class="hero-slide min-w-full h-full relative flex-shrink-0">
                            <!-- Desktop Image -->
                            <img src="{{ asset('banners/' . $banner->desktop_image) }}"
                                class="hidden md:block w-full h-full object-cover" alt="{{ $banner->title }}">

                            <!-- Mobile Image -->
                            <img src="{{ asset('banners/' . ($banner->mobile_image ?? $banner->desktop_image)) }}"
                                class="block md:hidden w-full h-full object-cover" alt="{{ $banner->title }}">

                            <!-- Text Overlay -->
                            <div class="absolute inset-0  flex items-center">
                                <div class="max-w-7xl mx-auto px-6 sm:px-12 w-full">
                                    <div class="max-w-lg text-white">
                                        @if ($banner->subtitle)
                                            <span
                                                class="inline-block py-1 px-3 rounded bg-teal-500 text-xs font-bold tracking-wider mb-4 uppercase">Featured</span>
                                        @endif

                                        @if ($banner->title)
                                            <h1
                                                class="text-3xl md:text-5xl lg:text-6xl font-bold leading-tight mb-4 drop-shadow-lg">
                                                {{ $banner->title }}
                                            </h1>
                                        @endif

                                        @if ($banner->subtitle)
                                            <p class="text-sm md:text-lg mb-8 drop-shadow-md text-gray-100">
                                                {{ $banner->subtitle }}
                                            </p>
                                        @endif

                                        @if ($banner->button_name && $banner->link)
                                            <a href="{{ $banner->link }}"
                                                class="inline-block bg-white text-slate-900 font-bold px-8 py-3 rounded hover:bg-teal-500 hover:text-white transition shadow-lg">
                                                {{ $banner->button_name }}
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Custom Dots Pagination (Bottom) -->
                <div id="hero-dots" class="absolute bottom-4 left-0 right-0 z-10 flex justify-center gap-2">
                    @foreach ($banners as $index => $banner)
                        <button data-index="{{ $index }}"
                            class="hero-dot w-3 h-3 rounded-full bg-white/50 transition-all duration-300"></button>
                    @endforeach
                </div>
            </div>
        @else
            <div class="w-full h-[300px] md:h-[500px] bg-slate-800 flex items-center justify-center text-white">
                <p>No Banner Active. Please upload from Admin Panel.</p>
            </div>
        @endif
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

    <!-- ================= DYNAMIC HOMEPAGE SECTIONS ================= -->
    @foreach ($homeSections as $section)

        {{-- 🟢 1. PRODUCTS SECTION (Featured, Trending, New Arrivals etc.) --}}
        @if (str_contains($section->section_key, 'product') ||
                $section->section_key == 'featured_products' ||
                $section->section_key == 'trending_products')
            <section class="py-12 bg-white">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between items-end mb-6">
                        <div>
                            <h2 class="text-2xl font-bold text-slate-900">{{ $section->title }}</h2>
                            <p class="text-slate-500 mt-1">Check out our latest collection.</p>
                        </div>
                        <a href="#"
                            class="hidden md:inline-block text-teal-600 font-semibold hover:text-teal-800">View All
                            &rarr;</a>
                    </div>

                    <!-- Agar Layout Grid hai -->
                    @if ($section->layout == 'grid')
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
                            @for ($i = 0; $i < $section->limit; $i++)
                                @include('layouts.partials.product-card')
                            @endfor
                        </div>

                        <!-- Agar Layout Slider hai -->
                    @else
                        <div class="swiper product-swiper pb-8">
                            <div class="swiper-wrapper">
                                @for ($i = 0; $i < $section->limit; $i++)
                                    <div class="swiper-slide">
                                        @include('layouts.partials.product-card')
                                    </div>
                                @endfor
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                    @endif
                </div>
            </section>

            {{-- 🟢 2. BEST SELLING COLLECTIONS (3 Image Grid) --}}
        @elseif($section->section_key == 'banners_grid')
            <section class="py-12 bg-gray-50">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center mb-10">
                        <h2 class="text-3xl font-bold text-slate-900">{{ $section->title }}</h2>
                    </div>

                    <!-- 3 Image Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @for ($i = 1; $i <= 3; $i++)
                            <div class="relative rounded-2xl overflow-hidden h-96 group">
                                <img src="https://images.unsplash.com/photo-1490481651871-ab68de25d43d?q=80&w=800&auto=format&fit=crop"
                                    alt="Collection {{ $i }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                <div class="absolute inset-0 bg-black/30 group-hover:bg-black/40 transition"></div>
                                <div class="absolute inset-0 flex flex-col justify-end p-8">
                                    <h3 class="text-2xl font-bold text-white mb-2">Collection {{ $i }}</h3>
                                    <a href="#"
                                        class="text-white font-semibold underline decoration-2 underline-offset-4 hover:text-teal-300">Shop
                                        Collection</a>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
            </section>

            {{-- 🟢 3. TESTIMONIALS SECTION --}}
        @elseif($section->section_key == 'testimonials')
            <section class="py-16 bg-slate-900">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center mb-10">
                        <h2 class="text-3xl font-bold text-white">{{ $section->title }}</h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        @for ($i = 0; $i < $section->limit; $i++)
                            <div class="bg-slate-800 p-6 rounded-xl border border-slate-700">
                                <div class="flex text-yellow-400 mb-4">★★★★★</div>
                                <p class="text-slate-300 italic mb-6">"Amazing products and super fast delivery. Highly
                                    recommended for everyone!"</p>
                                <div class="flex items-center">
                                    <img src="https://i.pravatar.cc/150?img={{ $i + 1 }}"
                                        class="w-10 h-10 rounded-full mr-3" alt="User">
                                    <div>
                                        <h4 class="text-white font-bold text-sm">Customer {{ $i + 1 }}</h4>
                                        <p class="text-slate-500 text-xs">Verified Buyer</p>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
            </section>

            {{-- 🟢 4. CUSTOM SECTIONS (Agar user koi naya section banaye jo upar nahi hai) --}}
        @else
            <section class="py-12 bg-white">
                <div
                    class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center border-2 border-dashed border-gray-300 rounded-xl p-10">
                    <h2 class="text-2xl font-bold text-slate-800">{{ $section->title }}</h2>
                    <p class="text-slate-500 mt-2">This is a custom section. Add your specific content here.</p>
                </div>
            </section>
        @endif

    @endforeach

@endsection
