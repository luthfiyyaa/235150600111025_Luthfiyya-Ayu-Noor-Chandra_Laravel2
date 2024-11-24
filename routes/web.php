<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;


Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// In routes/web.php
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


// Blog routes (protected by auth)
Route::middleware('auth')->group(function () {
    Route::get('/blogs', [BlogController::class, 'showBlogs'])->name('blogs.list');
    Route::get('/tambah', [BlogController::class, 'tambahBlog'])->name('blogs.create');
    Route::post('/tambah', [BlogController::class, 'createBlog'])->name('blogs.store');
    Route::get('/blogs/{id}/edit', [BlogController::class, 'editBlog'])->name('blogs.edit');
    Route::put('/blogs/{id}', [BlogController::class, 'updateBlog'])->name('blogs.update');
    Route::delete('/blogs/{id}', [BlogController::class, 'deleteBlog'])->name('blogs.delete');
});
