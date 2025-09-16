<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserWebController;
use App\Http\Controllers\AuthWebController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/usuarios', [UserWebController::class, 'index'])->middleware('auth');

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/login', [AuthWebController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthWebController::class, 'login']);
Route::post('/logout', [AuthWebController::class, 'logout'])->name('logout');

Route::get('/register', [AuthWebController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthWebController::class, 'register']);