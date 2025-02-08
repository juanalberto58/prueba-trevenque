<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductImageController;

Route::apiResource('categories', CategoryController::class);
Route::apiResource('products', ProductController::class);
Route::post('products/{id}/images', [ProductImageController::class, 'store']);
Route::delete('products/{id}/images/{image_id}', [ProductImageController::class, 'destroy']);
