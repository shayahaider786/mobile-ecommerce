@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-6">
    
    {{-- Welcome Banner Card --}}
    <div class="rounded-2xl bg-gradient-to-r from-indigo-600 to-violet-600 p-6 sm:p-8 text-white shadow-md relative overflow-hidden">
        <div class="absolute -right-6 -bottom-6 w-48 h-48 bg-white/10 rounded-full blur-2xl pointer-events-none"></div>
        <div class="relative z-10 max-w-xl">
            <span class="inline-block px-3 py-1 bg-white/20 backdrop-blur-md rounded-full text-xs font-semibold uppercase tracking-wider mb-3">Admin Portal</span>
            <h1 class="text-2xl sm:text-3xl font-bold tracking-tight">Welcome back, {{ Auth::guard('admin')->user()->name ?? 'Admin' }}! 👋</h1>
            <p class="mt-2 text-indigo-100 text-sm sm:text-base leading-relaxed">Here is what's happening in your e-commerce store today. Manage your store inventory, check updates, and view categories easily.</p>
        </div>
    </div>

    {{-- Quick Stats Grid --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
        
        {{-- Total Categories --}}
        <div class="rounded-2xl bg-white p-6 shadow-xs ring-1 ring-slate-200/80 flex items-center justify-between transition hover:shadow-md">
            <div>
                <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Total Categories</p>
                <p class="text-3xl font-bold text-slate-900 mt-2">
                    {{ \App\Features\Category\Models\Category::count() }}
                </p>
                <div class="mt-2 flex items-center gap-1.5 text-xs text-emerald-600 font-medium">
                    <span class="inline-block w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Active store sections
                </div>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center text-xl shadow-inner">
                📦
            </div>
        </div>

        {{-- Total Products --}}
        <div class="rounded-2xl bg-white p-6 shadow-xs ring-1 ring-slate-200/80 flex items-center justify-between transition hover:shadow-md">
            <div>
                <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Total Products</p>
                <p class="text-3xl font-bold text-slate-900 mt-2">0</p>
                <div class="mt-2 flex items-center gap-1.5 text-xs text-slate-400 font-medium">
                    Ready to stock items
                </div>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-xl shadow-inner">
                🛍️
            </div>
        </div>

        {{-- Total Orders --}}
        <div class="rounded-2xl bg-white p-6 shadow-xs ring-1 ring-slate-200/80 flex items-center justify-between transition hover:shadow-md sm:col-span-2 lg:col-span-1">
            <div>
                <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Total Orders</p>
                <p class="text-3xl font-bold text-slate-900 mt-2">0</p>
                <div class="mt-2 flex items-center gap-1.5 text-xs text-amber-600 font-medium">
                    Pending fulfillment
                </div>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center text-xl shadow-inner">
                🧾
            </div>
        </div>

    </div>

</div>
@endsection