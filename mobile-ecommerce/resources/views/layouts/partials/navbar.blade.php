<!-- ================= TOP NAVBAR ================= -->
<header class="bg-[#0f172a] border-b border-slate-800 sticky top-0 z-40 text-white w-full">
    <div class="max-w-[90rem] mx-auto px-4 sm:px-6 lg:px-8 w-full">
        <div class="flex justify-between items-center h-20 w-full gap-4">

            <!-- LEFT SIDE: Mobile Menu & Logo -->
            <div class="flex items-center gap-4 flex-shrink-0">
                <button id="mobile-menu-btn" class="lg:hidden text-white hover:text-teal-400 focus:outline-none p-1 z-50">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>

                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center gap-3">
                    <svg class="w-10 h-10 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                    <div class="flex flex-col">
                        <span class="text-2xl font-black tracking-wider text-white leading-none">SOVO</span>
                        <span class="text-[11px] text-gray-400 italic tracking-wider">The Brand Of Pakistan</span>
                    </div>
                </a>
            </div>

            <!-- CENTER DESKTOP NAV -->
            <nav class="hidden lg:flex items-center space-x-6 flex-grow justify-center">
                <a href="{{ route('home') }}" class="nav-link">Home</a>

                <!-- PRODUCTS MEGA MENU -->
                <div id="products-menu-container" class="static">
                    <button id="products-btn" class="nav-link flex items-center gap-1 focus:outline-none">
                        Products
                        <svg class="w-4 h-4 transition-transform duration-300" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>

                    <!-- MEGA MENU DROPDOWN -->
                    <div id="mega-menu" class="mega-menu-dropdown">
                        <div class="max-w-7xl mx-auto grid grid-cols-6 gap-4 p-6 w-full">
                            @isset($categories)
                                @forelse($categories as $cat)
                                    <a href="{{ route('categories.show', $cat->slug) }}" class="mega-item">
                                        <div class="mega-img-box">
                                            @if ($cat->image)
                                                <img src="{{ asset('category-images/' . $cat->image) }}"
                                                    alt="{{ $cat->name }}">
                                            @else
                                                <img src="https://via.placeholder.com/100" alt="{{ $cat->name }}">
                                            @endif
                                        </div>
                                        <span class="mega-text">{{ $cat->name }}</span>
                                    </a>
                                @empty
                                    <p class="col-span-6 text-center text-slate-400 py-4">No categories found.</p>
                                @endforelse
                            @endisset
                        </div>
                    </div>
                </div>

                <a href="#" class="nav-link">Blogs</a>
                <a href="#" class="nav-link">Support</a>
                <a href="#" class="text-red-500 font-bold hover:text-red-400 transition whitespace-nowrap">11.11
                    SALE</a>
            </nav>

            <!-- RIGHT SIDE ICONS -->
            <div class="hidden lg:flex items-center space-x-6 flex-shrink-0">
                <a href="#" class="nav-link whitespace-nowrap">Corporate Order</a>
                <button class="text-white hover:text-teal-400 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </button>
                @if (Auth::guard('web')->check())
                    <a href="{{ route('home') }}" class="text-white hover:text-teal-400 transition"><svg class="w-5 h-5"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                            </path>
                        </svg></a>
                @else
                    <a href="{{ route('login') }}" class="text-white hover:text-teal-400 transition"><svg
                            class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg></a>
                @endif
                <a href="#" class="text-white hover:text-teal-400 transition relative">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                </a>
            </div>

            <!-- MOBILE LOGO (Only shows on small screens) -->
            <a href="{{ route('home') }}"
                class="lg:hidden absolute left-1/2 transform -translate-x-1/2 flex flex-col items-center">
                <span class="text-xl font-black tracking-widest text-white leading-none">SOVO</span>
            </a>

        </div>
    </div>
</header>

<!-- ================= MOBILE SIDEBAR MENU ================= -->

<!-- Overlay (Background Dark) -->
<div id="mobile-menu-overlay" class="fixed inset-0 bg-black/60 z-40 md:hidden"></div>

<!-- Sidebar -->
<!-- Yahan dhyan dein: 'hidden' class nahi honi chahiye -->
<!-- Sidebar -->
<div id="mobile-menu" class="fixed top-0 left-0 h-full w-72 bg-white z-50 md:hidden shadow-2xl flex flex-col hidden">

    <div class="p-4 border-b border-gray-100 flex items-center bg-gray-50">
        <button id="mobile-menu-close" class="text-slate-500 hover:text-red-500 bg-white shadow-sm p-2 rounded-full">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                </path>
            </svg>
        </button>
    </div>

    <div class="flex-1 overflow-y-auto p-4 space-y-2">
        <a href="{{ route('home') }}"
            class="flex justify-between items-center py-3 px-2 text-slate-800 font-bold border-b border-gray-50 hover:text-teal-600">Home</a>
        <a href="#"
            class="flex justify-between items-center py-3 px-2 text-slate-800 font-bold border-b border-gray-50 hover:text-teal-600">Products
            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg></a>
        <a href="#"
            class="flex justify-between items-center py-3 px-2 text-slate-800 font-bold border-b border-gray-50 hover:text-teal-600">Blogs
            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg></a>
        <a href="#"
            class="flex justify-between items-center py-3 px-2 text-slate-800 font-bold border-b border-gray-50 hover:text-teal-600">Support
            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg></a>
        <a href="#"
            class="flex justify-between items-center py-3 px-2 text-red-600 font-bold border-b border-gray-50 hover:text-red-700 mt-2">11.11
            SALE LIVE</a>
        <a href="#"
            class="flex justify-between items-center py-3 px-2 text-slate-800 font-bold border-b border-gray-50 hover:text-teal-600">Corporate
            Order</a>
    </div>

    <div class="p-4 border-t border-gray-100 flex space-x-4 items-center">
        <a href="#" class="text-gray-600 hover:text-black"><svg class="w-5 h-5" fill="currentColor"
                viewBox="0 0 24 24">
                <path
                    d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
            </svg></a>
        <a href="#" class="text-gray-600 hover:text-black"><svg class="w-5 h-5" fill="currentColor"
                viewBox="0 0 24 24">
                <path
                    d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z" />
            </svg></a>
    </div>
</div>
