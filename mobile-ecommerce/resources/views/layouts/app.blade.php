<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name', 'Laravel'))</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-50 text-slate-900 antialiased">
    <div class="flex min-h-screen flex-col">
        <header class="border-b border-slate-200 bg-white">
            <nav class="mx-auto flex max-w-7xl items-center justify-between px-4 py-4 sm:px-6 lg:px-8" aria-label="Main navigation">
                <a class="text-xl font-bold tracking-tight text-slate-900" href="{{ url('/') }}">
                    {{ config('app.name', 'Shop') }}
                </a>
                <div class="flex items-center gap-4 text-sm font-medium text-slate-600 sm:gap-6">
                    <a class="hover:text-slate-900" href="{{ url('/') }}">Home</a>
                    <a class="hover:text-slate-900" href="{{ url('/products') }}">Products</a>
                    <a class="hover:text-slate-900" href="{{ url('/cart') }}">Cart</a>
                    <a class="hover:text-slate-900" href="{{ url('/categories') }}">categories</a>
                    <a class="rounded-lg bg-slate-900 px-4 py-2 text-white hover:bg-slate-700" href="{{ url('/login') }}">Login</a>
                </div>
            </nav>
        </header>
        <main class="mx-auto w-full max-w-7xl flex-1 px-4 py-8 sm:px-6 lg:px-8">
            @yield('content')
        </main>
        <footer class="border-t border-slate-200 bg-white">
            <div class="mx-auto max-w-7xl px-4 py-6 text-sm text-slate-500 sm:px-6 lg:px-8">
                &copy; {{ date('Y') }} {{ config('app.name', 'Shop') }}. All rights reserved.
            </div>
        </footer>
    </div>
</body>
</html>
