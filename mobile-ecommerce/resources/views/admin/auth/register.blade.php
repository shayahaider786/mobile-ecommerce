@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="w-full max-w-md bg-white p-8 rounded-lg shadow">
        <h1 class="text-2xl font-bold mb-6 text-center">Admin Register</h1>

        @if($errors->any())
            <div class="mb-4 text-red-600 text-sm">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('admin.register') }}">
            @csrf
            <div class="mb-4">
                <label class="block text-sm mb-1">Name</label>
                <input type="text" name="name" value="{{ old('name') }}"
                       class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500">
            </div>
            <div class="mb-4">
                <label class="block text-sm mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email') }}"
                       class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500">
            </div>
            <div class="mb-4">
                <label class="block text-sm mb-1">Password</label>
                <input type="password" name="password"
                       class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500">
            </div>
            <div class="mb-6">
                <label class="block text-sm mb-1">Confirm Password</label>
                <input type="password" name="password_confirmation"
                       class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500">
            </div>
            <button type="submit"
                    class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700">
                Register Admin
            </button>
        </form>
    </div>
</div>
@endsection