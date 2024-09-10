<?php

use App\Http\Controllers\UserController;

Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
Route::get('/users/create', [UserController::class, 'create'])->name('admin.users.create');
Route::get('/users/export-csv', [UserController::class, 'exportCSV'])->name('admin.users.export');
Route::get('/users/{user}', [UserController::class, 'show'])->name('admin.users.show');
Route::get('/users/edit/{user}', [UserController::class, 'edit'])->name('admin.users.edit');
Route::post('/users', [UserController::class, 'store'])->name('admin.users.store');
Route::put('/users/{user}', [UserController::class, 'update'])->name('admin.users.update');
Route::put('/users/{user}/toggleStatus', [UserController::class, 'toggleStatus'])->name('admin.users.toggleStatus');
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');

