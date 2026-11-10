<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') — Admin Panel</title>
    
    {{-- Robots: admin ko Google index na kare --}}
    <meta name="robots" content="noindex, nofollow">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-100">

    {{-- Top Bar --}}
    <header class="bg-white shadow-sm border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-6 py-3 flex justify-between items-center">
            <a href="{{ route('admin.dashboard') }}" class="text-xl font-bold text-indigo-600">
                🛒 MyShop Admin
            </a>
            <div class="flex items-center gap-4 text-sm">
                <span class="text-slate-600">
                    Hi, {{ Auth::guard('admin')->user()->name ?? 'Admin' }}
                </span>
                <a href="{{ url('/') }}" 
                   target="_blank"
                   class="text-indigo-600 hover:underline">
                    View Site ↗
                </a>
            </div>
        </div>
    </header>

    {{-- Main Grid: Sidebar + Content --}}
    <div class="max-w-7xl mx-auto px-6 py-6">
        <div class="grid gap-6 md:grid-cols-[16rem_1fr]">

            {{-- ============ SIDEBAR ============ --}}
            <aside class="rounded-xl bg-white p-5 shadow-sm ring-1 ring-slate-200 h-fit">
                <h2 class="text-lg font-semibold">Admin panel</h2>
                
                <nav class="mt-4 space-y-2" aria-label="Admin navigation">

                    {{-- Dashboard --}}
                    <a class="block rounded-lg px-3 py-2 text-sm font-medium transition
                              {{ request()->routeIs('admin.dashboard') 
                                    ? 'bg-indigo-50 text-indigo-700' 
                                    : 'text-slate-700 hover:bg-slate-50' }}"
                       href="{{ route('admin.dashboard') }}">
                        🏠 Dashboard
                    </a>

                    {{-- Categories --}}
                    <a class="block rounded-lg px-3 py-2 text-sm font-medium transition
                              {{ request()->routeIs('admin.categories.*') 
                                    ? 'bg-indigo-50 text-indigo-700' 
                                    : 'text-slate-700 hover:bg-slate-50' }}"
                       href="{{ route('admin.categories.index') }}">
                        📦 Categories
                    </a>

                    {{-- Products (future) --}}
                    <a class="block rounded-lg px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50"
                       href="#">
                        🛍️ Products
                    </a>

                    {{-- Orders (future) --}}
                    <a class="block rounded-lg px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50"
                       href="#">
                        🧾 Orders
                    </a>

                </nav>

                <form class="mt-6" method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button class="w-full rounded-lg border border-slate-300 px-4 py-2 text-left text-sm font-medium hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-indigo-500" 
                            type="submit">
                        🚪 Sign out
                    </button>
                </form>
            </aside>

            {{-- ============ MAIN CONTENT ============ --}}
            <section>
                {{-- Flash messages (global) --}}
                @if(session('success'))
                    <div class="mb-4 rounded-lg bg-green-100 px-4 py-3 text-green-800">
                        {{ session('success') }}
                    </div>
                @endif
                @if(session('error'))
                    <div class="mb-4 rounded-lg bg-red-100 px-4 py-3 text-red-800">
                        {{ session('error') }}
                    </div>
                @endif

                @yield('content')
            </section>

        </div>
    </div>

</body>
</html>