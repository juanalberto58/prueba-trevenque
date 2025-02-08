<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductViewController;

Route::get('/products', [ProductViewController::class, 'index'])->name('products.index');
Route::put('products/{id}/toggle', [ProductViewController::class, 'toggleStatus'])->name('products.toggle');
Route::delete('products/{id}', [ProductViewController::class, 'destroy'])->name('products.destroy');
Route::post('/products', [ProductViewController::class, 'store'])->name('products.store');
