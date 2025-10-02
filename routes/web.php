<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
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


require __DIR__.'/auth.php';
