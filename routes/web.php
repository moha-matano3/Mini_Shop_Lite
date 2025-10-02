<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

route::get('/category_page',[CategoryController::class,'category_page']);

route::post('/add_category',[CategoryController::class,'add_category']);

route::get('/display_category',[CategoryController::class,'display_category']);

route::get('/category_delete/{id}',[CategoryController::class,'category_delete']);

route::get('/edit_category/{id}',[CategoryController::class,'edit_category']);

route::post('/update_category/{id}',[CategoryController::class,'update_category']);

route::get('/add_product',[ProductController::class,'add_product']);

route::post('/product_add',[ProductController::class,'product_add']);

route::get('/display_product',[ProductController::class,'display_product']);

route::get('/product_delete/{id}',[ProductController::class,'product_delete']);

route::get('/edit_product/{id}',[ProductController::class,'edit_product']);

route::post('/update_product/{id}',[ProductController::class,'update_product']);



require __DIR__.'/auth.php';
