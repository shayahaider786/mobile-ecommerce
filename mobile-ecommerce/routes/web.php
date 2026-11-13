<?php

use App\Features\Auth\Controllers\AdminAuthController;
use App\Features\Auth\Controllers\AdminDashboardController;
use App\Features\Auth\Controllers\UserAuthController;
use App\Features\Category\Controllers\AdminCategoryController;
use App\Features\Category\Controllers\CategoryController;
use App\Features\Banner\Controllers\AdminBannerController;
use App\Features\Navigation\Controllers\AdminNavigationController;
use App\Features\Homepage\Controllers\AdminHomeSectionController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// ============================================
// 🟢 FRONTEND ROUTES (Customer) - PUBLIC
// ============================================
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/category/{slug}', [CategoryController::class, 'show'])->name('categories.show');

// Customer Auth
Route::get('/login', [UserAuthController::class, 'showLogin'])->name('login');
Route::post('/login', [UserAuthController::class, 'login'])->middleware('throttle:5,1');
Route::get('/register', [UserAuthController::class, 'showRegister'])->name('register');
Route::post('/register', [UserAuthController::class, 'register']);
Route::post('/logout', [UserAuthController::class, 'logout'])->name('logout');


// ============================================
// 🔴 BACKEND ROUTES (Admin) - PROTECTED
// ============================================
Route::prefix('admin')->name('admin.')->group(function () {
    
    // Admin Login Routes (Bina auth ke, warna login kaise karega?)
    Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])
        ->middleware('throttle:5,1')
        ->name('login.submit');
        
    Route::get('/register', [AdminAuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AdminAuthController::class, 'register'])->middleware('throttle:3,1');

    // 🔒 YAHAN SE SIRF ADMIN HE ACCESS KAR SAKTA HAI
    Route::middleware('admin')->group(function () {
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        
        // Category & Banner CRUD (Yeh ANDAR aayenge)
        Route::resource('categories', AdminCategoryController::class);
        Route::resource('banners', AdminBannerController::class);
        Route::resource('navigation', AdminNavigationController::class);


        // Homepage Builder Routes
        Route::resource('home-sections', AdminHomeSectionController::class);

    });

});