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
// REDIRECT KE DASHBOARD SESUAI ROLE
// ============================
Route::get('/dashboard', function () {
    if (!auth()->check()) {
        return redirect('/login');
    }

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

        // Dashboard
        Route::get('/dashboard', [DashboardAdminController::class, 'index'])
            ->name('dashboard');

        // Manajemen Barang (ACC / REJECT)
        Route::get('/items', [ItemAdminController::class, 'index'])->name('items.index');
        Route::post('/items/acc/{id}', [ItemAdminController::class, 'acc'])->name('items.acc');
        Route::post('/items/reject/{id}', [ItemAdminController::class, 'reject'])->name('items.reject');

        // Riwayat Barang
        Route::get('/history', [HistoryController::class, 'index'])->name('history.index');

        // Kategori
        Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
        Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
        Route::post('/categories/store', [CategoryController::class, 'store'])->name('categories.store');
        Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
        Route::post('/categories/{id}/update', [CategoryController::class, 'update'])->name('categories.update');
        Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');
        
    });


// ============================
// USER ROUTES
// ============================
Route::middleware(['auth', 'role:user'])
    ->prefix('user')
    ->name('user.')
    ->group(function () {

        // Dashboard user
        Route::get('/dashboard', [DashboardUserController::class, 'index'])->name('dashboard');

        // Donasi / Item User
        Route::get('/items', [ItemController::class, 'index'])->name('items.index');
        Route::get('/items/create', [ItemController::class, 'create'])->name('items.create');
        Route::post('/items', [ItemController::class, 'store'])->name('items.store');
        Route::get('/items/{id}/edit', [ItemController::class, 'edit'])->name('items.edit');
        Route::post('/items/{id}/update', [ItemController::class, 'update'])->name('items.update');
        Route::delete('/items/{id}', [ItemController::class, 'destroy'])->name('items.destroy');
        Route::get('/items/{id}', [ItemController::class, 'show'])->name('items.show');

        // Request barang user
        Route::resource('requests', RequestController::class)
            ->only(['index', 'create', 'store', 'destroy']);

        // INBOX USER
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
