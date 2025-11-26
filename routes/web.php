<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;

// ADMIN
use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\Admin\ItemAdminController;
use App\Http\Controllers\Admin\RequestAdminController;
use App\Http\Controllers\Admin\CategoryController;

// USER (disesuaikan dengan nama file kamu)
use App\Http\Controllers\User\DashboardUserController;
use App\Http\Controllers\User\ItemController;
use App\Http\Controllers\User\RequestController;

use App\Http\Controllers\AgreementController;

// ========== Default Redirect ==========
Route::get('/', fn() => redirect('/login'));

// ========== AUTH ==========
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// ========== REDIRECT DASHBOARD ==========
Route::get('/dashboard', function () {
    return auth()->user()->role === 'admin'
        ? redirect('/admin/dashboard')
        : redirect('/user/dashboard');
})->middleware('auth');

// ================== ADMIN ==================
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [DashboardAdminController::class, 'index'])
            ->name('dashboard');

        Route::resource('items', ItemAdminController::class)
            ->only(['index', 'edit', 'update', 'destroy']);

        Route::resource('requests', RequestAdminController::class)
            ->only(['index', 'update', 'destroy']);

        Route::resource('categories', CategoryController::class);
    });

// ================== USER ==================
Route::middleware(['auth', 'role:user'])
    ->prefix('user')
    ->name('user.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [DashboardUserController::class, 'index'])
            ->name('dashboard');

        // Donasi barang
        Route::resource('items', ItemController::class)
            ->only(['index', 'create', 'store', 'destroy']);

        // Request barang
        Route::resource('requests', RequestController::class)
            ->only(['index', 'create', 'store', 'destroy']);
    });

// ================== AGREEMENTS ==================
Route::middleware(['auth'])
    ->group(function () {

        Route::get('agreements', [AgreementController::class, 'index'])
            ->name('agreements.index');

        Route::get('agreements/create/{requestId}', [AgreementController::class, 'create'])
            ->name('agreements.create');

        Route::post('agreements/store/{requestId}', [AgreementController::class, 'store'])
            ->name('agreements.store');

        Route::delete('agreements/{id}', [AgreementController::class, 'destroy'])
            ->name('agreements.destroy');
    });
