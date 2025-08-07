<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Admin\PostController as AdminPostController;

Route::get('/', [PostController::class, 'index'])->name('posts.index');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('posts', AdminPostController::class);
});
