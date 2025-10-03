<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // return view('login');
    return view('auth.login');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/admin', function () {
        return view('admin.index');
    })->name('admin.index');

    Route::get('/superadmin', function () {
        return view('superadmin.index');
    })->name('superadmin.index');

    Route::get('/customer', function () {
        return view('customer.browse');
    })->name('customer.browse');
});

Route::get('/category_page',[CategoryController::class,'category_page']);
Route::post('/add_category',[CategoryController::class,'add_category']);
Route::get('/display_category',[CategoryController::class,'display_category']);
Route::get('/category_delete/{id}',[CategoryController::class,'category_delete']);
Route::get('/edit_category/{id}',[CategoryController::class,'edit_category']);
Route::post('/update_category/{id}',[CategoryController::class,'update_category']);

Route::get('/add_product',[ProductController::class,'add_product']);
Route::post('/product_add',[ProductController::class,'product_add']);
Route::get('/display_product',[ProductController::class,'display_product']);
Route::get('/product_delete/{id}',[ProductController::class,'product_delete']);
Route::get('/edit_product/{id}',[ProductController::class,'edit_product']);
Route::post('/update_product/{id}',[ProductController::class,'update_product']);


Route::get('/customer', [ProductController::class, 'search_filter_product'])->name('customer.browse');
Route::get('/customer/product/{id}', [ProductController::class, 'product_detail'])->name('customer.layouts.product_detail');


Route::post('/cart/add/{id}', [ProductController::class, 'addToCart'])->name('cart.add');
Route::get('customer/cart', [ProductController::class, 'viewCart'])->name('cart.view');
Route::post('/cart/remove/{id}', [ProductController::class, 'removeFromCart'])->name('cart.remove');
Route::post('/cart/checkout', [ProductController::class, 'checkout'])->name('cart.checkout');
Route::post('/cart/update/{id}', [ProductController::class, 'update'])->name('cart.update');

require __DIR__.'/auth.php';
