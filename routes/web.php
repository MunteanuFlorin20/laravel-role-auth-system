<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckAdminAccess;
use App\Http\Controllers\AuthController;

// Admin Panel
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminDashboardController;

Route::get('/', function () {
    return view('auth.login');
});


Route::get('/login', [AuthController::class, 'getLogin'])->name('login');
Route::post('login', [AuthController::class, 'postLogin'])->name('login.post');

Route::get('/register', [AuthController::class, 'getRegister'])->name('register');
Route::post('/register', [AuthController::class, 'postRegister'])->name('register.post');

// Admin Panel
Route::middleware(['auth', CheckAdminAccess::class])->prefix('admin')->group(function () {

    // Dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    // Users
    Route::prefix('users')->name('admin.users.')->group(function () {
        Route::get('/', [AdminUserController::class, 'index'])->name('index');
        Route::get('/create', [AdminUserController::class, 'create'])->name('create');
        Route::post('/', [AdminUserController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [AdminUserController::class, 'edit'])->name('edit');
        Route::put('/{id}/update', [AdminUserController::class, 'update'])->name('update');
        Route::get('/{id}/delete', [AdminUserController::class, 'delete'])->name('delete');
        Route::delete('/{id}', [AdminUserController::class, 'destroy'])->name('destroy');
        Route::post('/{id}/visibility', [AdminUserController::class, 'visibility'])->name('visibility');
    });
});