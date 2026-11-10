@extends('layouts.app')

@section('title', 'Create Account')

@section('content')
<div class="mx-auto max-w-md rounded-xl bg-white p-8 shadow-sm ring-1 ring-slate-200">
    <h1 class="text-2xl font-bold tracking-tight">Create your account</h1>
    <p class="mt-2 text-sm text-slate-600">Register to shop and manage your orders.</p>

    <form class="mt-6 space-y-5" method="POST" action="{{ route('register') }}">
        @csrf
        <div>
            <label class="mb-1 block text-sm font-medium" for="name">Name</label>
            <input class="w-full rounded-lg border border-slate-300 px-4 py-2 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500" id="name" name="name" type="text" value="{{ old('name') }}" autocomplete="name" required autofocus>
            @error('name')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label class="mb-1 block text-sm font-medium" for="email">Email address</label>
            <input class="w-full rounded-lg border border-slate-300 px-4 py-2 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500" id="email" name="email" type="email" value="{{ old('email') }}" autocomplete="email" required>
            @error('email')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label class="mb-1 block text-sm font-medium" for="password">Password</label>
            <input class="w-full rounded-lg border border-slate-300 px-4 py-2 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500" id="password" name="password" type="password" autocomplete="new-password" required>
            @error('password')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label class="mb-1 block text-sm font-medium" for="password_confirmation">Confirm password</label>
            <input class="w-full rounded-lg border border-slate-300 px-4 py-2 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500" id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required>
            @error('password_confirmation')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        <button class="w-full rounded-lg bg-indigo-600 px-4 py-2 font-semibold text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2" type="submit">Create account</button>
    </form>
</div>
@endsection
