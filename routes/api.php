<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiCategoryController;
use App\Http\Controllers\Api\ApiProductController;
use App\Http\Controllers\Api\ApiProductImageController;

Route::apiResource('categories', ApiCategoryController::class);
Route::apiResource('products', ApiProductController::class);
Route::post('products/{id}/images', [ApiProductImageController::class, 'store']);
Route::delete('products/{id}/images/{image_id}', [ApiProductImageController::class, 'destroy']);
