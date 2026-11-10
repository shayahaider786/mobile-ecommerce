@extends('layouts.app')

@section('title', 'Customer Login')

@section('content')
<div class="mx-auto max-w-md rounded-xl bg-white p-8 shadow-sm ring-1 ring-slate-200">
    <h1 class="text-2xl font-bold tracking-tight">Customer login</h1>
    <p class="mt-2 text-sm text-slate-600">Sign in to continue to your account.</p>

    <form class="mt-6 space-y-5" method="POST" action="{{ route('login') }}">
        @csrf
        <div>
            <label class="mb-1 block text-sm font-medium" for="email">Email address</label>
            <input class="w-full rounded-lg border border-slate-300 px-4 py-2 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500" id="email" name="email" type="email" value="{{ old('email') }}" autocomplete="email" required autofocus>
            @error('email')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label class="mb-1 block text-sm font-medium" for="password">Password</label>
            <input class="w-full rounded-lg border border-slate-300 px-4 py-2 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500" id="password" name="password" type="password" autocomplete="current-password" required>
            @error('password')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        <label class="flex items-center gap-2 text-sm text-slate-600">
            <input class="rounded border-slate-300" type="checkbox" name="remember" value="1">
            Remember me
        </label>
        <button class="w-full rounded-lg bg-indigo-600 px-4 py-2 font-semibold text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2" type="submit">Sign in</button>
    </form>

    <p class="mt-6 text-center text-sm text-slate-600">
        New here? <a class="font-medium text-indigo-600 hover:text-indigo-500" href="{{ route('register') }}">Create an account</a>
    </p>
</div>
@endsection
