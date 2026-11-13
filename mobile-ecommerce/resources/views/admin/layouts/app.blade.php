<!DOCTYPE html>
<html lang="en" class="h-full bg-slate-50">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') — E-Commerce Admin Panel</title>

    <meta name="robots" content="noindex, nofollow">

    {{-- Fonts & Tailwind --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="h-full font-sans text-slate-900 antialiased flex flex-col">

    {{-- Top Sticky Header --}}
    <header class="bg-white border-b border-slate-200 sticky top-0 z-30 shadow-xs">
        <div class="px-4 sm:px-6 lg:px-8 h-16 flex justify-between items-center">

            {{-- Left: Brand & Mobile Menu Toggle --}}
            <div class="flex items-center gap-3">
                <button id="admin-sidebar-toggle"
                    class="md:hidden text-slate-500 hover:text-indigo-600 focus:outline-none p-1">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>

                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2">
                    <div
                        class="w-9 h-9 rounded-lg bg-indigo-600 flex items-center justify-center text-white font-bold text-lg shadow-sm">
                        🛒
                    </div>
                    <span class="text-lg font-bold tracking-tight text-slate-800">MyShop <span
                            class="text-indigo-600 font-medium text-sm">Admin</span></span>
                </a>
            </div>

            {{-- Right: User info & Site link --}}
            <div class="flex items-center gap-4 sm:gap-6 text-sm">
                <a href="{{ url('/') }}" target="_blank"
                    class="hidden sm:inline-flex items-center gap-1.5 text-slate-600 hover:text-indigo-600 font-medium transition">
                    <span>View Site</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                    </svg>
                </a>

                <div class="h-5 w-px bg-slate-200 hidden sm:block"></div>

                <div class="flex items-center gap-3">
                    <div
                        class="w-8 h-8 rounded-full bg-indigo-100 text-indigo-700 font-semibold flex items-center justify-center text-xs">
                        {{ strtoupper(substr(Auth::guard('admin')->user()->name ?? 'A', 0, 1)) }}
                    </div>
                    <span class="font-medium text-slate-700 hidden md:inline-block">
                        {{ Auth::guard('admin')->user()->name ?? 'Admin' }}
                    </span>
                </div>
            </div>
        </div>
    </header>

    {{-- Layout Container --}}
    <div class="flex-1 flex max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-6 gap-6 relative">

        {{-- Mobile Sidebar Overlay --}}
        <div id="sidebar-overlay" class="fixed inset-0 bg-slate-900/40 backdrop-blur-xs z-40 hidden md:hidden"></div>

        {{-- ============ SIDEBAR ============ --}}
        <aside id="admin-sidebar"
            class="fixed inset-y-0 left-0 z-50 w-64 bg-white p-5 shadow-xl md:shadow-xs md:ring-1 md:ring-slate-200 md:static md:rounded-2xl h-fit transform -translate-x-full md:translate-x-0 transition-transform duration-300 flex flex-col justify-between">

            <div>
                <div class="flex items-center justify-between md:hidden mb-4 pb-3 border-b border-slate-100">
                    <span class="font-bold text-slate-800">Navigation</span>
                    <button id="sidebar-close-btn" class="text-slate-400 hover:text-slate-600 p-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider px-3 mb-2 hidden md:block">Menu
                </p>

                <nav class="space-y-1.5" aria-label="Admin navigation">
                    {{-- Dashboard --}}
                    <a class="flex items-center gap-3 rounded-xl px-3.5 py-2.5 text-sm font-medium transition
                            {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-600 text-white shadow-sm shadow-indigo-200' : 'text-slate-600 hover:bg-slate-100/80 hover:text-slate-900' }}"
                        href="{{ route('admin.dashboard') }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                            </path>
                        </svg>
                        Dashboard
                    </a>

                    <a class="flex items-center gap-3 rounded-xl px-3.5 py-2.5 text-sm font-medium transition {{ request()->routeIs('admin.home-sections.*') ? 'bg-indigo-600 text-white' : 'text-slate-600 hover:bg-slate-100' }}"
                        href="{{ route('admin.home-sections.index') }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                            </path>
                        </svg>
                        Homepage Setup
                    </a>
                    {{-- Navigation --}}
                    <a class="flex items-center gap-3 rounded-xl px-3.5 py-2.5 text-sm font-medium transition
                        {{ request()->routeIs('admin.navigation.*') ? 'bg-indigo-600 text-white shadow-sm shadow-indigo-200' : 'text-slate-600 hover:bg-slate-100/80 hover:text-slate-900' }}"
                        href="{{ route('admin.navigation.index') }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                        Navigation Menu
                    </a>
                    {{-- Banners --}}
                    <a class="flex items-center gap-3 rounded-xl px-3.5 py-2.5 text-sm font-medium transition
                            {{ request()->routeIs('admin.banners.*') ? 'bg-indigo-600 text-white shadow-sm shadow-indigo-200' : 'text-slate-600 hover:bg-slate-100/80 hover:text-slate-900' }}"
                        href="{{ route('admin.banners.index') }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z">
                            </path>
                        </svg>
                        Banners
                    </a>
                    {{-- Categories --}}
                    <a class="flex items-center gap-3 rounded-xl px-3.5 py-2.5 text-sm font-medium transition
                            {{ request()->routeIs('admin.categories.*') ? 'bg-indigo-600 text-white shadow-sm shadow-indigo-200' : 'text-slate-600 hover:bg-slate-100/80 hover:text-slate-900' }}"
                        href="{{ route('admin.categories.index') }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                            </path>
                        </svg>
                        Categories
                    </a>
                </nav>
            </div>

            <div class="pt-6 border-t border-slate-100 mt-6">
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button
                        class="w-full flex items-center justify-center gap-2 rounded-xl border border-slate-200 px-4 py-2.5 text-sm font-medium text-slate-700 hover:bg-red-50 hover:text-red-600 hover:border-red-200 focus:outline-none transition"
                        type="submit">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                            </path>
                        </svg>
                        Sign out
                    </button>
                </form>
            </div>
        </aside>

        {{-- ============ MAIN CONTENT AREA ============ --}}
        <main class="flex-1 min-w-0">
            @if (session('success'))
                <div
                    class="mb-6 rounded-xl bg-emerald-50 border border-emerald-200 px-4 py-3.5 text-emerald-800 text-sm flex items-center gap-3 shadow-xs">
                    <svg class="w-5 h-5 text-emerald-600 shrink-0" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif
            @if (session('error'))
                <div
                    class="mb-6 rounded-xl bg-rose-50 border border-rose-200 px-4 py-3.5 text-rose-800 text-sm flex items-center gap-3 shadow-xs">
                    <svg class="w-5 h-5 text-rose-600 shrink-0" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                        </path>
                    </svg>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    {{-- Mobile Sidebar Script --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const toggleBtn = document.getElementById('admin-sidebar-toggle');
            const closeBtn = document.getElementById('sidebar-close-btn');
            const sidebar = document.getElementById('admin-sidebar');
            const overlay = document.getElementById('sidebar-overlay');

            function toggleSidebar() {
                sidebar.classList.toggle('-translate-x-full');
                overlay.classList.toggle('hidden');
            }

            if (toggleBtn) toggleBtn.addEventListener('click', toggleSidebar);
            if (closeBtn) closeBtn.addEventListener('click', toggleSidebar);
            if (overlay) overlay.addEventListener('click', toggleSidebar);
        });
    </script>

    {{-- Include Global Delete Confirmation Modal Partial --}}
    @include('admin.layouts.partials.delete-modal')

</body>

</html>
