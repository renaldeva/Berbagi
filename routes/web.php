<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\Donator\DashboardDonatorController;
use App\Http\Controllers\Penerima\DashboardPenerimaController;

// ================
// DEFAULT REDIRECT
// ================
Route::get('/', function () {
    return redirect('/login');
});

// ================
// AUTH
// ================
Route::get('/login', [AuthController::class, 'showLogin'])
    ->middleware('guest')
    ->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])
    ->middleware('guest')
    ->name('register');

Route::post('/register', [AuthController::class, 'register']);

// Route::get('/logout', [AuthController::class, 'logout'])
//     ->middleware('auth')
//     ->name('logout');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');


// =====================================
// REDIRECT KE DASHBOARD SESUAI ROLE
// =====================================
Route::get('/dashboard', function () {

    $role = auth()->user()->role;

    if ($role === 'admin') {
        return redirect('/admin/dashboard');
    }
    if ($role === 'donator') {
        return redirect('/donator/dashboard');
    }
    if ($role === 'penerima') {
        return redirect('/penerima/dashboard');
    }

    return abort(403);

})->middleware('auth');

// ================
// ADMIN
// ================
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardAdminController::class, 'index'])
        ->name('admin.dashboard');
});

// ================
// DONATOR
// ================
Route::middleware(['auth', 'role:donator'])->group(function () {
    Route::get('/donator/dashboard', [DashboardDonatorController::class, 'index'])
        ->name('donator.dashboard');
});

// ================
// PENERIMA
// ================
Route::middleware(['auth', 'role:penerima'])->group(function () {
    Route::get('/penerima/dashboard', [DashboardPenerimaController::class, 'index'])
        ->name('penerima.dashboard');
});
