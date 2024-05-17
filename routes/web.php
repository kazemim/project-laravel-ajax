 <?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/category', [App\Http\Controllers\CategoryController::class, 'showCategories'])->name('show');
Route::get('/getCategories', [App\Http\Controllers\CategoryController::class, 'getCategories'])->name('getCategories');
Route::post('/createCategory', [App\Http\Controllers\CategoryController::class, 'store'])->name('createCategory');
Route::put('/updateCategory/{id}', [App\Http\Controllers\CategoryController::class, 'update'])->name('updateCategory');
Route::delete('/deleteCategory/{id}', [App\Http\Controllers\CategoryController::class, 'delete'])->name('deleteCategory');

Route::get('/sub-category', [App\Http\Controllers\SubCategoryController::class, 'showSubCategories'])->name('showSub');
Route::get('/getSubCategory', [App\Http\Controllers\SubCategoryController::class, 'getSubCategories'])->name('getSub');


Route::get('/', [App\Http\Controllers\PostController::class, 'showPosts'])->name('posts.index');
Route::get('/getPosts', [App\Http\Controllers\PostController::class, 'getPosts'])->name('getPosts');
Route::post('/createPost', [App\Http\Controllers\PostController::class, 'store'])->name('createPost');
Route::put('/updatePost/{id}', [App\Http\Controllers\PostController::class, 'update'])->name('updatePost');
Route::delete('/deletePost/{id}', [App\Http\Controllers\PostController::class, 'delete'])->name('deletePost');





