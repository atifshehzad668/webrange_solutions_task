<?php

use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/products', [ProductController::class, 'index']);
Route::post('/products', [ProductController::class, 'store']);
Route::delete('/products/{id}', [ProductController::class, 'destroy']);

Route::get('/posts', [PostController::class, 'index']);

Route::get('/quotes', [\App\Http\Controllers\QuoteController::class, 'index']);

Route::get('/http-request', [\App\Http\Controllers\HttpRequestController::class, 'index']);
