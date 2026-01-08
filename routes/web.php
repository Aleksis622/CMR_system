<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InspectionController;
use App\Http\Controllers\Admin\UserController;

Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {

        Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
        Route::get('/users/{user}/edit', [AdminUserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{user}', [AdminUserController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])->name('users.destroy');

    });

   Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::resource('users', UserController::class);
    });

    Route::middleware(['role:admin,inspector'])->group(function () {
        Route::get('/inspections', [InspectionController::class, 'index'])->name('inspections.index');
        Route::get('/inspections/{id}', [InspectionController::class, 'show'])->name('inspections.show');
    });
});
Route::get('/fetch-all', [ImportController::class, 'fetchAll']);

Route::prefix('inspections')->group(function () {
    Route::get('/', [InspectionController::class, 'index'])->name('inspections.index');
    Route::get('/{id}', [InspectionController::class, 'show'])->name('inspections.show');
    Route::post('/{id}/decide', [InspectionController::class, 'decide'])->name('inspections.decide');
});