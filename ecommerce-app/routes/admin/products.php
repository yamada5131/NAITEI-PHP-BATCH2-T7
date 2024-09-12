<?php

use App\Http\Controllers\ProductController;

Route::get('/products', [ProductController::class, 'index'])->name('admin.products.index');
Route::get('/products/create', [ProductController::class, 'create'])->name('admin.products.create');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('admin.products.show');
Route::get('/products/edit/{product}', [ProductController::class, 'edit'])->name('admin.products.edit');
Route::post('/products', [ProductController::class, 'store'])->name('admin.products.store');
Route::put('/products/{product}', [ProductController::class, 'update'])->name('admin.products.update');
Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('admin.products.destroy');
