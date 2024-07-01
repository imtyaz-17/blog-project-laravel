<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\Admin;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', [HomeController::class, 'homepage']);
Route::get('/post-details/{post}', [HomeController::class, 'post_details'])->name('post_details');

// Authenticated User Routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/my_post', [HomeController::class, 'myPost'])->name('user.my_post');
    Route::get('/create', [HomeController::class, 'create'])->name('user.create');
    Route::post('/store', [HomeController::class, 'store'])->name('user.store');
    Route::get('/my_post/{post}/edit', [HomeController::class, 'edit'])->name('user.edit');
    Route::put('/my_post/{post}', [HomeController::class, 'update'])->name('user.update');
    Route::delete('/my_post/{post}', [HomeController::class, 'destroy'])->name('user.destroy');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin-specific Routes
Route::prefix('admin')->name('admin.')->middleware(Admin::class)->group(function () {
    Route::get('/create', [AdminController::class, 'create'])->name('create');
    Route::post('/store', [AdminController::class, 'store'])->name('store');
    Route::get('/posts', [AdminController::class, 'showAll'])->name('posts');
    Route::get('/posts/{post}/edit', [AdminController::class, 'edit'])->name('edit');
    Route::put('/posts/{post}', [AdminController::class, 'update'])->name('update');
    Route::delete('/posts/{post}', [AdminController::class, 'destroy'])->name('destroy');
    Route::get('/approve/{post}', [AdminController::class, 'accept_post'])->name('accept');
    Route::get('/reject/{post}', [AdminController::class, 'reject_post'])->name('reject');
});
require __DIR__ . '/auth.php';
