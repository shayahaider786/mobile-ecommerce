<?php

use App\Features\Auth\Controllers\AdminAuthController;
use App\Features\Auth\Controllers\AdminDashboardController;
use App\Features\Auth\Controllers\UserAuthController;
use App\Features\Category\Controllers\AdminCategoryController;
use App\Features\Category\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

// ============================================
// 🟢 FRONTEND ROUTES (Customer)
// ============================================
Route::get('/categories',[CategoryController::class, 'index'])->name('categories.index');
Route::get('/category/{slug}',[CategoryController::class, 'show'])->name('categories.show');

Route::get('/login', [UserAuthController::class, 'showLogin'])->name('login');
Route::post('/login', [UserAuthController::class, 'login'])->middleware('throttle:5,1');
Route::get('/register', [UserAuthController::class, 'showRegister'])->name('register');
Route::post('/register', [UserAuthController::class, 'register']);
Route::post('/logout', [UserAuthController::class, 'logout'])->name('logout');

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])
        ->middleware('throttle:5,1')
        ->name('login.submit');

    // ⚠️ SIRF DEV KE LIYE — production mein comment kar dena
    Route::get('/register', [AdminAuthController::class, 'showRegister'])->name('register');
    Route::post('/register',[AdminAuthController::class, 'register'])->middleware('throttle:3,1');
    Route::middleware('admin')->group(function () {
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    });

    // 📦 Category CRUD
    Route::resource('categories', AdminCategoryController::class);
    // ↑ Yeh 7 routes automatic bana deta hai:
    //   GET    /admin/categories              → index
    //   GET    /admin/categories/create       → create
    //   POST   /admin/categories              → store
    //   GET    /admin/categories/{id}/edit    → edit
    //   PUT    /admin/categories/{id}         → update
    //   DELETE /admin/categories/{id}         → destroy
    //   GET    /admin/categories/{id}         → show

});
