<?php

use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
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

// Permissions
Route::get('/permission', [PermissionController::class, 'index'])->name('permission.index');
Route::get('/permission/create', [PermissionController::class, 'create'])->name('permission.create');
Route::post('/permission', [PermissionController::class, 'store'])->name('permission.store');
Route::get('/permission/{id}/edit', [PermissionController::class, 'edit'])->name('permission.edit');
Route::put('/permission/{id}', [PermissionController::class, 'update'])->name('permission.update');
Route::delete('/permission/{id}', [PermissionController::class, 'destroy'])->name('permission.destroy');

//Roles
Route::get('/role', [RoleController::class, 'index'])->name('role.index');
Route::get('role/create', [RoleController::class, 'create'])->name('role.create');
Route::post('/role', [RoleController::class, 'store'])->name('role.store');
Route::get('role/{id}/edit', [RoleController::class, 'edit'])->name('role.edit');
Route::put('/role/{id}', [RoleController::class, 'update'])->name('role.update');
Route::delete('role/{id}', [RoleController::class, 'destroy'])->name('role.destroy');

//Users
Route::get('/user', [UserController::class, 'index'])->name('user.index');
Route::get('user/create', [UserController::class, 'create'])->name('user.create');
Route::post('/user', [UserController::class, 'store'])->name('user.store');
Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');
Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');

//Products
Route::get('/product', [ProductController::class, 'index'])->name('product.index');
Route::get('product/create', [ProductController::class, 'create'])->name('product.create');
Route::post('/product', [ProductController::class, 'store'])->name('product.store');
Route::get('/product/{id}/edit', [ProductController::class, 'edit'])->name('product.edit');
Route::put('/product/{id}', [ProductController::class, 'update'])->name('product.update');
Route::delete('/product/{id}', [ProductController::class, 'destroy'])->name('product.destroy');


require __DIR__ . '/auth.php';
