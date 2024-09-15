<?php

use App\Http\Controllers\CategoryController;

Route::get('/categories', [CategoryController::class, 'index'])->name('admin.categories.index');
Route::get('/categories/create', [CategoryController::class, 'create'])->name('admin.categories.create');
Route::get('/categories/export-csv', [CategoryController::class, 'exportToCSV'])->name('admin.categories.export');
Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('admin.categories.show');
Route::get('/categories/edit/{category}', [CategoryController::class, 'edit'])->name('admin.categories.edit');
Route::post('/categories', [CategoryController::class, 'store'])->name('admin.categories.store');
Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('admin.categories.update');
Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');
