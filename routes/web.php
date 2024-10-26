<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\GenreController;

Route::get('/', [HomeController::class, 'index']) -> name('home');
Route::get('/products', [ProductController::class, 'index']) -> name('products');
Route::post('/products', [ProductController::class, 'insert']) -> name('products.insert');
Route::get('/products/search', [ProductController::class, 'search']) -> name('products.search');
Route::put('/products/{id}', [ProductController::class, 'update']) -> name('products.update');
Route::delete('/products/{id}', [ProductController::class, 'delete']) -> name('products.destroy');
Route::get('/orders', [OrdersController::class, 'index']) -> name('orders');
Route::get('/orders/search', [OrdersController::class, 'search']) -> name('orders.search');
Route::delete('/orders/delete/{orderId}', [OrdersController::class, 'delete']) -> name('orders.delete');
Route::post('/orders/add/insert', [OrdersController::class, 'insert']) -> name('orders.insert');
Route::get('/orders/add/{order?}', [OrdersController::class, 'addOrder']) -> name('orders.add');
Route::put('/orders/update/{orderId}', [OrdersController::class, 'updateItem']) -> name('orders.item.update');
Route::delete('/orders/delete/{orderId}/{bookId}', [OrdersController::class, 'deleteItem']) -> name('orders.item.delete');
Route::get('/publishers', [PublisherController::class, 'index']) -> name('publishers');
Route::get('/publishers/search', [PublisherController::class, 'search']) -> name('publishers.search');
Route::get('/publishers/{publisherId}', [PublisherController::class, 'list']) -> name('publishers.list');
Route::get('/genres', [GenreController::class, 'index']) -> name('genres');
Route::get('/genres/search', [GenreController::class, 'search']) -> name('genres.search');
Route::get('/genres/{genreId}', [GenreController::class, 'list']) -> name('genres.list');