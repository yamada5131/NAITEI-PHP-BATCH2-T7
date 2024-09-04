<?php

use Illuminate\Support\Facades\Route;

use App\Http\Middleware\CheckOwner;

use App\Models\User;
use App\Http\Controllers\OrderDetailController;
use App\Models\Product;
use App\Models\ProductCategory;

use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;

use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserReviewController;

// Rest of the code...

// Simulated feedback data

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

// Profile management routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/order-details', [OrderDetailController::class, 'index'])->name('order-details.index');
    Route::get('/order-details/{orderDetail}', [OrderDetailController::class, 'show'])->name('order-details.show');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::get('/users/edit/{user}', [UserController::class, 'edit'])->name('users.edit');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    Route::get('/admin', function () {
        // Dummy data for the admin view
        $users = User::all();

        $categories = ProductCategory::all();

        $products = Product::all();

        return view('admin', ['users' => $users, 'categories' => $categories, 'products' => $products]);
    })->name('admin.dashboard');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    Route::get('/products/create', [CategoryController::class, 'create'])->name('products.create');
    Route::post('/products', [CategoryController::class, 'store'])->name('products.store');
    Route::get('/products/{product}/edit', [CategoryController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [CategoryController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [CategoryController::class, 'destroy'])->name('products.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/review/create', [UserReviewController::class, 'create'])->name('review.create');
    Route::post('/review', [UserReviewController::class, 'store'])->name('review.store');
    Route::middleware([CheckOwner::class])->group(function () {
        Route::get('review/edit/{id}', [UserReviewController::class, 'edit'])->name('review.edit');
        Route::put('/review/{id}', [UserReviewController::class, 'update'])->name('review.update');
        Route::delete('/review/{id}', [UserReviewController::class, 'destroy'])->name('review.destroy');
    });
});

Route::get('/cart', [CartController::class, 'show'])->name('cart.show');
Route::get('/products', [CategoryController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

require __DIR__.'/auth.php';





