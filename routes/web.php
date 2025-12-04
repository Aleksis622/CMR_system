<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\WebhookController;
use App\Http\Controllers\DashboardController;

Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::get('/fetch-and-generate-users', [ImportController::class, 'fetchAndGenerateUsers']);
Route::get('/fetch-all', [ImportController::class, 'fetchAll']);


Route::post('/cases', [CaseController::class, 'store']);
Route::post('/webhook', [WebhookController::class, 'receive']);

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');
     
     
