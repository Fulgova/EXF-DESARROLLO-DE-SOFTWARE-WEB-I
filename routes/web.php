<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserWebController;
use App\Http\Controllers\AuthWebController;
use App\Http\Controllers\DashboardController;
use App\Models\User; 

Route::get('/', function () {
    return view('welcome');
});

// Listado de usuarios (ejemplo, protegido por sesión normal si quieres)
Route::get('/usuarios', [UserWebController::class, 'index'])->middleware('auth');

// Dashboard protegido por JWT
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('jwt.web')
    ->name('dashboard');


// Login Web
Route::get('/loginweb', [AuthWebController::class, 'showLoginForm'])->name('loginweb');
Route::post('/loginweb', [AuthWebController::class, 'login']);

// Logout Web
Route::post('/logoutweb', [AuthWebController::class, 'logout'])->name('logoutweb');

// Registro Web
Route::get('/registerweb', [AuthWebController::class, 'showRegistrationForm'])->name('registerweb');
Route::post('/registerweb', [AuthWebController::class, 'register']);

// Buscar usuario por ID (API de prueba)
Route::get('/users/{id}', function ($id) {
    return User::findOrFail($id);
});
