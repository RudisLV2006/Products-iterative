<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return redirect()->route('product.index');
});



Route::get('/product', [ProductController::class, "index"])->name("product.index");
Route::get('/product/create', [ProductController::class, "create"])->name("product.create");
Route::get('/product/{product}', [ProductController::class, "show"])->name("product.show");
Route::post('/product', [ProductController::class, "store"])->name("product.store");
Route::post('/product/action/{id}', [ProductController::class, 'updateQuantity'])->name('product.updateQuantity');
Route::get('/product/edit/{product}', [ProductController::class, "edit"])->name("product.edit");
Route::put('/product/edit/{product}', [ProductController::class, "update"])->name("product.update");
Route::delete('/product/{product}', [ProductController::class, "destroy"])->name("product.destroy");
