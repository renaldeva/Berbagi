<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\AgreementController;

// ADMIN
use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\Admin\ItemAdminController;
use App\Http\Controllers\Admin\HistoryController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TipAdminController;

// USER
use App\Http\Controllers\User\DashboardUserController;
use App\Http\Controllers\User\ItemController;
use App\Http\Controllers\User\RequestController;
use App\Http\Controllers\User\InboxController;
use App\Http\Controllers\User\TipUserController;
use App\Http\Controllers\User\ProfileController;

/*
|--------------------------------------------------------------------------
| DEFAULT REDIRECT
|--------------------------------------------------------------------------
*/
Route::get('/', fn() => redirect()->route('login'));

/*
|--------------------------------------------------------------------------
| AUTH (GUEST)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::post('/send-otp', [AuthController::class, 'sendOtp'])->name('send.otp');

    Route::get('/forgot-password', [ForgotPasswordController::class, 'showForm'])->name('forgot-password.show');
    Route::post('/forgot-password/send-otp', [ForgotPasswordController::class, 'sendOtp'])->name('forgot.send.otp');
    Route::post('/forgot-password/reset', [ForgotPasswordController::class, 'resetPassword'])->name('forgot.reset.password');
    Route::post('/forgot-password/verify-otp', [ForgotPasswordController::class, 'verifyOtp'])->name('forgot.verify.otp');
});

/*
|--------------------------------------------------------------------------
| LOGOUT
|--------------------------------------------------------------------------
*/
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

/*
|--------------------------------------------------------------------------
| DASHBOARD REDIRECT
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    if (!auth()->check()) return redirect('/login');

    return auth()->user()->role === 'admin'
        ? redirect()->route('admin.dashboard')
        : redirect()->route('user.dashboard');
})->middleware('auth');

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [DashboardAdminController::class, 'index'])->name('dashboard');

        // ITEMS
        Route::get('/items', [ItemAdminController::class, 'index'])->name('items.index');
        Route::post('/items/{id}/acc', [ItemAdminController::class, 'acc'])->name('items.acc');
        Route::post('/items/{id}/reject', [ItemAdminController::class, 'reject'])->name('items.reject');

        // HISTORY
        Route::get('/history', [HistoryController::class, 'index'])->name('history.index');

        // CATEGORY
        Route::resource('categories', CategoryController::class);

        // TIP
        Route::get('/tip', [TipAdminController::class, 'index'])->name('tip.index');
    });

/*
|--------------------------------------------------------------------------
| USER
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:user'])
    ->prefix('user')
    ->name('user.')
    ->group(function () {

        Route::get('/dashboard', [DashboardUserController::class, 'index'])->name('dashboard');

        Route::resource('items', ItemController::class);
        Route::resource('requests', RequestController::class)->only(['index', 'create', 'store', 'destroy']);

        Route::get('/inbox', [InboxController::class, 'index'])->name('inbox.index');
        Route::get('/inbox/{id}', [InboxController::class, 'show'])->name('inbox.show');

        Route::get('/tip', [TipUserController::class, 'index'])->name('tip.index');
        Route::get('/tip/create', [TipUserController::class, 'create'])->name('tip.create');
        Route::post('/tip', [TipUserController::class, 'store'])->name('tip.store');

        // PROFILE
        Route::get('/profil', [ProfileController::class, 'index'])->name('profil.index');
        Route::get('/profil/edit', [ProfileController::class, 'edit'])->name('profil.edit');
        Route::post('/profil/update', [ProfileController::class, 'update'])->name('profil.update');

        Route::get('/profil/password', [ProfileController::class, 'password'])->name('profil.password');
        Route::post('/profil/password/update', [ProfileController::class, 'updatePassword'])->name('profil.password.update');
    });

/*
|--------------------------------------------------------------------------
| AGREEMENTS
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('agreements', [AgreementController::class, 'index'])->name('agreements.index');
    Route::get('agreements/create/{requestId}', [AgreementController::class, 'create'])->name('agreements.create');
    Route::post('agreements/store/{requestId}', [AgreementController::class, 'store'])->name('agreements.store');
    Route::delete('agreements/{id}', [AgreementController::class, 'destroy'])->name('agreements.destroy');
});
