<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomUserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\DashboardController;


Route::get('/users/{id}/edit', [CustomUserController::class, 'edit'])->name('users.edit');
Route::put('/users/{id}', [CustomUserController::class, 'update'])->name('users.update');

Route::resource('posts', PostController::class)->middleware('auth');

Route::get('/', function () {
    return view('home');
});

Route::get('/register', [CustomUserController::class, 'create'])->name('register');
Route::post('/register', [CustomUserController::class, 'store']);
Route::get('/users/{id}/edit', [CustomUserController::class, 'edit'])->name('users.edit')->middleware('auth');
Route::put('/users/{id}', [CustomUserController::class, 'update'])->name('users.update')->middleware('auth');
Route::get('/users/{id}', [CustomUserController::class, 'show'])->name('users.show')->middleware('auth');

Route::get('admin/dashboard',[HomeController::class, 'index'])->name('admin.dashboard')->middleware(['auth','admin']);
Route::delete('admin/users/{user}', [CustomUserController::class, 'destroy'])->name('admin.users.destroy');

Route::get('posts/category/{category}', [PostController::class, 'postsByCategory'])->name('posts.category');
Route::get('posts/{id}/edit', [PostController::class, 'edit'])->name('posts.edit');
Route::get('posts/{id}', [PostController::class, 'show'])->name('posts.show');
Route::put('posts/{id}', [PostController::class, 'update'])->name('posts.update');
Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');


Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';
