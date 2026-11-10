@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<section class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
    <h1 class="text-2xl font-bold tracking-tight">Dashboard</h1>
    <p class="mt-2 text-slate-600">Welcome to the administration panel.</p>

    {{-- Quick stats --}}
    <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="rounded-lg bg-indigo-50 p-4">
            <p class="text-sm text-indigo-600">Total Categories</p>
            <p class="text-2xl font-bold text-indigo-900">
                {{ \App\Features\Category\Models\Category::count() }}
            </p>
        </div>
        <div class="rounded-lg bg-green-50 p-4">
            <p class="text-sm text-green-600">Total Products</p>
            <p class="text-2xl font-bold text-green-900">0</p>
        </div>
        <div class="rounded-lg bg-amber-50 p-4">
            <p class="text-sm text-amber-600">Total Orders</p>
            <p class="text-2xl font-bold text-amber-900">0</p>
        </div>
    </div>
</section>
@endsection