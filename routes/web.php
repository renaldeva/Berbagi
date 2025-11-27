<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// ADMIN
use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\Admin\ItemAdminController;
use App\Http\Controllers\Admin\HistoryController;
use App\Http\Controllers\Admin\CategoryController;

// USER
use App\Http\Controllers\User\DashboardUserController;
use App\Http\Controllers\User\ItemController;
use App\Http\Controllers\User\RequestController;
use App\Http\Controllers\User\InboxController;

// AGREEMENTS
use App\Http\Controllers\AgreementController;

// ============================
// DEFAULT REDIRECT
// ============================
Route::get('/', function () {
    return redirect()->route('login');
});

// ============================
// AUTH (GUEST ONLY)
// ============================
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// ============================
// LOGOUT
// ============================
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// ============================
// REDIRECT DASHBOARD BY ROLE
// ============================
Route::get('/dashboard', function () {
    if (!auth()->check()) return redirect('/login');

    return auth()->user()->role === 'admin'
        ? redirect()->route('admin.dashboard')
        : redirect()->route('user.dashboard');
})->middleware('auth');


// ============================
// ADMIN ROUTES
// ============================
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [DashboardAdminController::class, 'index'])->name('dashboard');

        // Manajemen Barang
        Route::get('/items', [ItemAdminController::class, 'index'])->name('items.index');
        Route::post('/items/acc/{id}', [ItemAdminController::class, 'acc'])->name('items.acc');
        Route::post('/items/reject/{id}', [ItemAdminController::class, 'reject'])->name('items.reject');

        // History
        Route::get('/history', [HistoryController::class, 'index'])->name('history.index');

        // Categories
        Route::resource('categories', CategoryController::class);
    });


// ============================
// USER ROUTES
// ============================
Route::middleware(['auth', 'role:user'])
    ->prefix('user')
    ->name('user.')
    ->group(function () {

        // Dashboard (FILTER DALAM HALAMAN INI)
        Route::get('/dashboard', [DashboardUserController::class, 'index'])->name('dashboard');

        // CRUD ITEM USER
        Route::resource('items', ItemController::class);

        // Request barang user
        Route::resource('requests', RequestController::class)
            ->only(['index', 'create', 'store', 'destroy']);

        // Inbox
        Route::get('/inbox', [InboxController::class, 'index'])->name('inbox.index');
        Route::get('/inbox/{id}', [InboxController::class, 'show'])->name('inbox.show');
    });


// ============================
// AGREEMENTS (ADMIN + USER)
// ============================
Route::middleware('auth')->group(function () {
    Route::get('agreements', [AgreementController::class, 'index'])->name('agreements.index');
    Route::get('agreements/create/{requestId}', [AgreementController::class, 'create'])->name('agreements.create');
    Route::post('agreements/store/{requestId}', [AgreementController::class, 'store'])->name('agreements.store');
    Route::delete('agreements/{id}', [AgreementController::class, 'destroy'])->name('agreements.destroy');
});
