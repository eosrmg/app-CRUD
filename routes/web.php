<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ProductController;

Route::get('/', function () {return Inertia::render('App');})->name('app');

Route::get('/dashboard', [ProductController::class, 'read'])->name('dashboard');

Route::get('/createproduct', [ProductController::class, 'create'])->name('createproduct');
Route::post('/createproduct', [ProductController::class, 'store'])->name('createproduct.store');

Route::get('/createproduct/{product}', [ProductController::class, 'edit'])->name('createproduct.edit');
Route::put('/createproduct/{product}', [ProductController::class, 'update'])->name('createproduct.update');

Route::delete('/createproduct{product}', [ProductController::class, 'destroy'])->name('createproduct.destroy');




