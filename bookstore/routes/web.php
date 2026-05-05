<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StorefrontController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');
Route::get('/books', [StorefrontController::class, 'index'])->name('books.index');
Route::get('/books/{book}', [StorefrontController::class, 'show'])->name('books.show');

Route::prefix('admin')->name('admin.')->group(function (): void {
    Route::middleware('guest')->group(function (): void {
        Route::get('/login', [AuthController::class, 'create'])->name('login');
        Route::post('/login', [AuthController::class, 'store'])->name('login.store');
    });

    Route::middleware(['auth', 'admin'])->group(function (): void {
        Route::get('/dashboard', DashboardController::class)->name('dashboard');
        Route::post('/logout', [AuthController::class, 'destroy'])->name('logout');
        Route::resource('books', BookController::class)->except('show');
    });
});
