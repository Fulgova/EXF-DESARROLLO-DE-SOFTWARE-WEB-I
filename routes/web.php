<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserWebController;
use App\Http\Controllers\AuthWebController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\ProductWebController;
use App\Models\User;

Route::get('/', function () {
    return view('welcome');
});

// Login y Registro (sin protección, porque necesitas entrar primero)
Route::get('/loginweb', [AuthWebController::class, 'showLoginForm'])->name('loginweb');
Route::post('/loginweb', [AuthWebController::class, 'login']);
Route::get('/registerweb', [AuthWebController::class, 'showRegistrationForm'])->name('registerweb');
Route::post('/registerweb', [AuthWebController::class, 'register']);

// Rutas protegidas con JWT
Route::middleware(['jwt.web'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Usuarios
    Route::get('/usuarios', [UserWebController::class, 'index']);
    Route::get('/users/{id}', [UserWebController::class, 'show']);
    Route::post('/users', [UserWebController::class, 'store']);
    Route::put('/users/{id}', [UserWebController::class, 'update']);
    Route::delete('/users/{id}', [UserWebController::class, 'destroy']);

    // Productos
    Route::get('/products', [ProductWebController::class, 'index']);
    Route::get('/products/{id}', [ProductWebController::class, 'show']);
    Route::post('/products', [ProductWebController::class, 'store']);
    Route::put('/products/{id}', [ProductWebController::class, 'update']);
    Route::delete('/products/{id}', [ProductWebController::class, 'destroy']);

    // Clientes
    Route::get('/clients', [ClientsController::class, 'index']);
    Route::get('/clients/{id}', [ClientsController::class, 'show']);
    Route::post('/clients', [ClientsController::class, 'store']);
    Route::put('/clients/{id}', [ClientsController::class, 'update']);
    Route::delete('/clients/{id}', [ClientsController::class, 'destroy']);

    // Logout
    Route::post('/logoutweb', [AuthWebController::class, 'logout'])->name('logoutweb');
});
