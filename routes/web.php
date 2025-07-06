<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Models\Category;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    return view('welcome');
});

// products routes
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/create', function () {
    $categories = Category::all();
    return view('products.create', compact('categories'));
});
Route::get('/products/{id}', [ProductController::class, 'show']);

Route::post('/products', [ProductController::class, 'store']);

Route::get('/products/{id}/edit', [ProductController::class, 'edit']);
Route::post('/products/{id}/update', [ProductController::class, 'update']);
Route::delete('/product-images/{id}', [ProductController::class, 'deleteImage']);
Route::delete('/products/{id}', [ProductController::class, 'destroy']);

// CATEGORY ROUTES 

Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/create', [CategoryController::class, 'create']);
Route::post('/categories', [CategoryController::class, 'store']);
Route::get('/categories/{id}/edit', [CategoryController::class, 'edit']);
Route::put('/categories/{id}', [CategoryController::class, 'update']);
Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);



