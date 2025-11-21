<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\Donator\DashboardDonatorController;
use App\Http\Controllers\Penerima\DashboardPenerimaController;
use App\Http\Controllers\Donator\ItemController as DonatorItemController;
use App\Http\Controllers\Admin\ItemAdminController;
use App\Http\Controllers\Penerima\RequestController as PenerimaRequestController;
use App\Http\Controllers\Admin\RequestAdminController;
use App\Http\Controllers\AgreementController;
use App\Http\Controllers\Admin\CategoryController;

Route::get('/', function () {
    return redirect('/login');
});

// ================ AUTH ==================
Route::get('/login', [AuthController::class, 'showLogin'])
    ->middleware('guest')
    ->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])
    ->middleware('guest')
    ->name('register');

Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// ========== REDIRECT DASHBOARD SESUAI ROLE ==========
Route::get('/dashboard', function () {
    $role = auth()->user()->role;

    return match ($role) {
        'admin' => redirect('/admin/dashboard'),
        'donator' => redirect('/donator/dashboard'),
        'penerima' => redirect('/penerima/dashboard'),
        default => abort(403)
    };
})->middleware('auth');

// ================ ADMIN ==================
Route::middleware(['auth','role:admin'])->prefix('admin')->group(function(){
    Route::resource('items', ItemAdminController::class)->only(['index','edit','update','destroy'])->names('admin.items');
    Route::resource('requests', RequestAdminController::class)->only(['index','update','destroy'])->names('admin.requests');
    Route::resource('categories', CategoryController::class)->names('admin.categories');
    Route::get('dashboard', [DashboardAdminController::class,'index'])->name('admin.dashboard');
});

// ================ DONATOR ==================
Route::middleware(['auth','role:donator'])->prefix('donator')->group(function(){
    Route::resource('items', DonatorItemController::class)->only(['index','create','store','destroy'])->names('donator.items');
    Route::get('dashboard', [DashboardDonatorController::class,'index'])->name('donator.dashboard');
});

// ================ PENERIMA ==================
Route::middleware(['auth','role:penerima'])->prefix('penerima')->group(function(){
    Route::resource('requests', PenerimaRequestController::class)
        ->only(['index','create','store','destroy'])
        ->names('penerima.requests');

    Route::get('dashboard', [DashboardPenerimaController::class,'index'])->name('penerima.dashboard');
});

// ============== AGREEMENTS =================
Route::middleware(['auth'])->group(function(){
    Route::get('agreements', [AgreementController::class,'index'])->name('agreements.index');
    Route::get('agreements/create/{requestId}', [AgreementController::class,'create'])->name('agreements.create');
    Route::post('agreements/store/{requestId}', [AgreementController::class,'store'])->name('agreements.store');
    Route::delete('agreements/{id}', [AgreementController::class,'destroy'])->name('agreements.destroy');
});
