<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Features\Navigation\Services\NavigationService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Sirf Navbar ke links share karo (Har page par zaroori hain)
        View::composer('layouts.partials.navbar', function ($view) {
            $navService = app(NavigationService::class);
            $view->with('navLinks', $navService->getActiveLinks());
        });
    }
}