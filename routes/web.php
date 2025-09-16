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

Route::get('/loginweb', [AuthWebController::class, 'showLoginForm'])->name('login');
Route::post('/loginweb', [AuthWebController::class, 'login']);
Route::post('/logoutweb', [AuthWebController::class, 'logout'])->name('logout');

Route::get('/registerweb', [AuthWebController::class, 'showRegistrationForm'])->name('register');
Route::post('/registerweb', [AuthWebController::class, 'register']);