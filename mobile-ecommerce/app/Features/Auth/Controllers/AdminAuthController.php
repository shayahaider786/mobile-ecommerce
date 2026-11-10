<?php

namespace App\Features\Auth\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AdminAuthController extends Controller
{
    public function showLogin(): View
    {
        return view('admin.auth.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (! Auth::guard('admin')->attempt($credentials, $request->boolean('remember'))) {
            return back()
                ->withErrors(['email' => 'The provided credentials do not match our records.'])
                ->onlyInput('email');
        }

        $request->session()->regenerate();

        return redirect()->intended(route('admin.dashboard'));
    }

    public function showRegister()
{
    // Extra safety: agar already 1 admin exist karta hai to register band
    if (\App\Features\Auth\Models\Admin::count() > 0) {
        abort(403, 'Admin registration is closed.');
    }
    return view('admin.auth.register');
}

public function register(Request $request)
{
    // Same safety check
    if (\App\Features\Auth\Models\Admin::count() > 0) {
        abort(403, 'Admin registration is closed.');
    }

    $data = $request->validate([
        'name'     => 'required|string|max:255',
        'email'    => 'required|email|unique:admins,email',
        'password' => 'required|min:8|confirmed',
    ]);

    $admin = \App\Features\Auth\Models\Admin::create([
        'name'     => $data['name'],
        'email'    => $data['email'],
        'password' => \Illuminate\Support\Facades\Hash::make($data['password']),
    ]);

    \Illuminate\Support\Facades\Auth::guard('admin')->login($admin);

    return redirect()->route('admin.dashboard');
}
    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
