<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Models\Category;

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


