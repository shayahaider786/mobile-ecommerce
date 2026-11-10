<?php

namespace App\Http\Middleware;

use App\Features\Auth\Models\Admin;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $admin = Auth::guard('admin')->user();

        if (! Auth::guard('admin')->check()) {
            if (Auth::guard('web')->check()) {
                abort(403);
            }

            return redirect()->route('admin.login');
        }

        if (! ($admin instanceof Admin)) {
            abort(403);
        }

        return $next($request);
    }
}
