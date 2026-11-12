<!-- ================= TOP NAVBAR ================= -->
<header class="bg-[#0f172a] border-b border-slate-800 sticky top-0 z-40 text-white w-full">
    <div class="max-w-[90rem] mx-auto px-4 sm:px-6 lg:px-8 w-full">
        <div class="flex justify-between items-center h-20 w-full gap-4">

            <!-- LEFT SIDE: Mobile Menu Toggle & Desktop Logo -->
            <div class="flex items-center gap-4 flex-shrink-0">
                <!-- Mobile Sidebar Toggle Button (Left) -->
                <button id="mobile-menu-btn" class="lg:hidden text-white hover:text-teal-400 focus:outline-none p-1 z-50">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>

                <!-- Desktop Logo -->
                <a href="{{ route('home') }}" class="hidden lg:flex items-center gap-3">
                    <svg class="w-10 h-10 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                    <div class="flex flex-col">
                        <span class="text-2xl font-black tracking-wider text-white leading-none">SOVO</span>
                        <span class="text-[11px] text-gray-400 italic tracking-wider">The Brand Of Pakistan</span>
                    </div>
                </a>
            </div>

            <!-- MOBILE LOGO (Centered on Mobile) -->
            <a href="{{ route('home') }}" class="lg:hidden absolute left-1/2 transform -translate-x-1/2 flex flex-col items-center">
                <span class="text-xl font-black tracking-widest text-white leading-none">SOVO</span>
                <span class="text-[9px] text-gray-400 italic tracking-wider">The Brand Of Pakistan</span>
            </a>

            <!-- CENTER DESKTOP NAV -->
            <nav class="hidden lg:flex items-center space-x-6 flex-grow justify-center">
                @isset($navLinks)
                    @foreach ($navLinks as $link)
                        @if ($link->category_id && $link->category)
                            <!-- 1. DIRECT CATEGORY LINK (Mega Menu with Main Category + Subcategories & Images) -->
                            <div class="static group">
                                <button class="nav-link flex items-center gap-1 focus:outline-none py-2">
                                    {{ $link->title }}
                                    <svg class="w-4 h-4 transition-transform duration-300 group-hover:rotate-180"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>

                                <!-- MEGA MENU DROPDOWN -->
                                <div class="mega-menu-dropdown">
                                    <div class="max-w-7xl mx-auto p-8 w-full">
                                        <div class="grid grid-cols-5 gap-8 items-start">

                                            <!-- Main Category Highlight Box (Col 1) -->
                                            <a href="{{ $link->final_url }}" class="col-span-1 flex flex-col items-center text-center p-4 rounded-xl bg-slate-800/40 border border-slate-700/60 hover:border-teal-400 transition">
                                                <div class="w-20 h-20 rounded-full overflow-hidden bg-slate-700 mb-3 flex items-center justify-center border-2 border-slate-600 shadow-md">
                                                    @if ($link->category->image)
                                                        <img src="{{ asset('category-images/' . $link->category->image) }}" alt="{{ $link->title }}" class="w-full h-full object-cover">
                                                    @else
                                                        <span class="text-xs text-slate-400">No Img</span>
                                                    @endif
                                                </div>
                                                <span class="text-sm font-bold text-teal-400">Shop All {{ $link->title }}</span>
                                            </a>

                                            <!-- Sub Categories Grid with Images (Cols 2-5) -->
                                            <div class="col-span-4">
                                                <h4 class="text-slate-400 font-bold mb-4 text-xs uppercase tracking-widest border-b border-slate-800 pb-2">
                                                    Sub Categories
                                                </h4>
                                                <div class="grid grid-cols-3 gap-4">
                                                    @forelse($link->category->children->where('is_active', true) as $subCat)
                                                        <a href="{{ route('categories.show', $subCat->slug) }}"
                                                            class="flex items-center gap-3 p-2.5 rounded-xl hover:bg-slate-800/80 transition group/sub border border-transparent hover:border-slate-700">
                                                            
                                                            <!-- Subcategory Image -->
                                                            <div class="w-12 h-12 rounded-full overflow-hidden bg-slate-800 flex-shrink-0 flex items-center justify-center border border-slate-700 group-hover/sub:border-teal-400 transition">
                                                                @if($subCat->image)
                                                                    <img src="{{ asset('category-images/' . $subCat->image) }}" alt="{{ $subCat->name }}" class="w-full h-full object-cover">
                                                                @else
                                                                    <span class="text-[9px] text-slate-500">Img</span>
                                                                @endif
                                                            </div>

                                                            <span class="text-sm text-gray-200 group-hover/sub:text-teal-400 font-medium transition leading-snug">
                                                                {{ $subCat->name }}
                                                            </span>
                                                        </a>
                                                    @empty
                                                        <p class="text-sm text-gray-500 col-span-3 py-2">No subcategories found.</p>
                                                    @endforelse
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        @elseif($link->children->count() > 0)
                            <!-- 2. SIMPLE NAVLINK WITH CHILD LINKS (Mega Menu with Images) -->
                            <div class="static group">
                                <button class="nav-link flex items-center gap-1 focus:outline-none py-2">
                                    {{ $link->title }}
                                    <svg class="w-4 h-4 transition-transform duration-300 group-hover:rotate-180"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>

                                <!-- MEGA MENU DROPDOWN -->
                                <div class="mega-menu-dropdown">
                                    <div class="max-w-7xl mx-auto p-8 w-full">
                                        <div class="flex items-center justify-between border-b border-slate-800 pb-3 mb-6">
                                            <h4 class="text-slate-400 font-bold text-xs uppercase tracking-widest">
                                                {{ $link->title }}
                                            </h4>
                                            @if($link->url && $link->url !== '#')
                                                <a href="{{ $link->final_url }}" class="text-xs font-semibold text-teal-400 hover:underline">
                                                    View All {{ $link->title }} &rarr;
                                                </a>
                                            @endif
                                        </div>

                                        <!-- Grid of Child Links (With Category Images if linked) -->
                                        <div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-6 gap-6">
                                            @foreach ($link->children as $child)
                                                <a href="{{ $child->final_url }}" class="mega-item group/item">
                                                    <div class="mega-img-box">
                                                        @if ($child->category && $child->category->image)
                                                            <img src="{{ asset('category-images/' . $child->category->image) }}" alt="{{ $child->title }}">
                                                        @else
                                                            <svg class="w-7 h-7 text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                                                            </svg>
                                                        @endif
                                                    </div>
                                                    <span class="mega-text group-hover/item:text-teal-400 transition">
                                                        {{ $child->title }}
                                                    </span>
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                        @else
                            <!-- 3. SIMPLE CUSTOM LINK (No Dropdown) -->
                            <a href="{{ $link->final_url }}" class="nav-link py-2">{{ $link->title }}</a>
                        @endif
                    @endforeach
                @endisset

                <!-- Hardcoded Sale Link -->
                <a href="#" class="text-red-500 font-bold hover:text-red-400 transition whitespace-nowrap py-2">11.11 SALE</a>
            </nav>

            <!-- RIGHT SIDE ICONS (Desktop & Mobile Search/Cart) -->
            <div class="flex items-center space-x-4 sm:space-x-6 flex-shrink-0">
                <a href="#" class="nav-link hidden lg:inline-block whitespace-nowrap">Corporate Order</a>
                
                <!-- Search Icon -->
                <button class="text-white hover:text-teal-400 transition p-1">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </button>

                <!-- Profile / Auth Icon -->
                @if (Auth::guard('web')->check())
                    <a href="{{ route('home') }}" class="text-white hover:text-teal-400 transition hidden sm:inline-block">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="text-white hover:text-teal-400 transition hidden sm:inline-block">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </a>
                @endif

                <!-- Cart Icon -->
                <a href="#" class="text-white hover:text-teal-400 transition relative p-1">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                </a>
            </div>

        </div>
    </div>
</header>

<!-- ================= MOBILE SIDEBAR MENU ================= -->
<!-- Overlay (Background Dark) -->
<div id="mobile-menu-overlay" class="fixed inset-0 bg-black/60 z-40 lg:hidden"></div>

<!-- Sidebar -->
<div id="mobile-menu" class="fixed top-0 left-0 h-full w-72 bg-white z-50 lg:hidden shadow-2xl flex flex-col hidden">

    <div class="p-4 border-b border-gray-100 flex items-center justify-between bg-gray-50">
        <span class="font-bold text-lg text-slate-800">Menu</span>
        <button id="mobile-menu-close" class="text-slate-500 hover:text-red-500 bg-white shadow-sm p-2 rounded-full">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>

    <!-- DYNAMIC MOBILE LINKS -->
    <div class="flex-1 overflow-y-auto p-4 space-y-2">
        
        <a href="{{ route('home') }}" class="flex justify-between items-center py-3 px-2 text-slate-800 font-bold border-b border-gray-50 hover:text-teal-600">
            Home
        </a>

        @isset($navLinks)
            @foreach ($navLinks as $link)
                <div x-data="{ open: false }" class="border-b border-gray-50">
                    @if(($link->category_id && $link->category) || $link->children->count() > 0)
                        <!-- Accordion Toggle -->
                        <button @click="open = !open" class="w-full flex justify-between items-center py-3 px-2 text-slate-800 font-bold hover:text-teal-600">
                            {{ $link->title }}
                            <svg :class="{'rotate-180': open}" class="w-4 h-4 text-gray-400 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        
                        <!-- Dropdown Content -->
                        <div x-show="open" x-collapse class="pl-3 pb-3 space-y-2 bg-gray-50 rounded-b-lg">
                            @if($link->category_id && $link->category)
                                <!-- Direct Category: Show Main + Subcategories with Image Icons -->
                                <a href="{{ $link->final_url }}" class="flex items-center gap-2 py-2 text-sm text-slate-900 font-bold hover:text-teal-600 border-b border-gray-200 mb-1">
                                    Shop All {{ $link->title }}
                                </a>
                                @foreach($link->category->children->where('is_active', true) as $subCat)
                                    <a href="{{ route('categories.show', $subCat->slug) }}" class="flex items-center gap-2.5 py-1.5 text-sm text-gray-600 hover:text-teal-600">
                                        <div class="w-7 h-7 rounded-full bg-slate-200 overflow-hidden flex-shrink-0 flex items-center justify-center">
                                            @if($subCat->image)
                                                <img src="{{ asset('category-images/' . $subCat->image) }}" alt="{{ $subCat->name }}" class="w-full h-full object-cover">
                                            @else
                                                <span class="text-[8px] text-slate-500">Img</span>
                                            @endif
                                        </div>
                                        <span>{{ $subCat->name }}</span>
                                    </a>
                                @endforeach
                            @else
                                <!-- Custom Link: Show Child Links with Category Image if linked -->
                                @foreach($link->children as $child)
                                    <a href="{{ $child->final_url }}" class="flex items-center gap-2.5 py-1.5 text-sm text-gray-600 hover:text-teal-600">
                                        @if($child->category && $child->category->image)
                                            <div class="w-7 h-7 rounded-full bg-slate-200 overflow-hidden flex-shrink-0">
                                                <img src="{{ asset('category-images/' . $child->category->image) }}" alt="{{ $child->title }}" class="w-full h-full object-cover">
                                            </div>
                                        @endif
                                        <span>{{ $child->title }}</span>
                                    </a>
                                @endforeach
                            @endif
                        </div>
                    @else
                        <!-- Simple Link -->
                        <a href="{{ $link->final_url }}" class="flex justify-between items-center py-3 px-2 text-slate-800 font-bold hover:text-teal-600">
                            {{ $link->title }}
                        </a>
                    @endif
                </div>
            @endforeach
        @endisset

        <!-- Hardcoded Sale Link (Mobile) -->
        <a href="#" class="flex justify-between items-center py-3 px-2 text-red-600 font-bold hover:text-red-700 mt-2">
            11.11 SALE LIVE
        </a>

        <!-- Hardcoded Corporate Order (Mobile) -->
        <a href="#" class="flex justify-between items-center py-3 px-2 text-slate-800 font-bold hover:text-teal-600">
            Corporate Order
        </a>
    </div>

    <!-- Social Icons Footer -->
    <div class="p-4 border-t border-gray-100 flex space-x-4 items-center">
        <a href="#" class="text-gray-600 hover:text-black">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" /></svg>
        </a>
        <a href="#" class="text-gray-600 hover:text-black">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z" /></svg>
        </a>
    </div>
</div>