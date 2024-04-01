<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/category', [App\Http\Controllers\CategoryController::class, 'showCategories'])->name('show');
Route::get('/category2', [App\Http\Controllers\CategoryController::class, 'showCategories2'])->name('show2');
Route::get('/category3', [App\Http\Controllers\CategoryController::class, 'showCategories3'])->name('show3');
Route::post('/createCategory', [App\Http\Controllers\CategoryController::class, 'store'])->name('createCategory');
Route::put('/updateCategory/{id}', [App\Http\Controllers\CategoryController::class, 'update'])->name('updateCategory');
Route::delete('/deleteCategory/{id}', [App\Http\Controllers\CategoryController::class, 'delete'])->name('deleteCategory');

Route::get('/', [App\Http\Controllers\PostController::class, 'showPosts'])->name('posts.index');
Route::post('/createPost', [App\Http\Controllers\PostController::class, 'store'])->name('createPost');
Route::put('/updatePost/{id}', [App\Http\Controllers\PostController::class, 'update'])->name('updatePost');
Route::delete('/deletePost/{id}', [App\Http\Controllers\PostController::class, 'delete'])->name('deletePost');



