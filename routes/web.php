<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserWebController;
use App\Http\Controllers\AuthWebController;
use App\Http\Controllers\DashboardController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/usuarios', [UserWebController::class, 'index'])->middleware('auth');

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/loginweb', [AuthWebController::class, 'showLoginForm'])->name('login');
Route::get('/users/{id}', function ($id) {return User::findOrFail($id);});

Route::post('/loginweb', [AuthWebController::class, 'login']);
Route::post('/logoutweb', [AuthWebController::class, 'logout'])->name('logout');

Route::get('/registerweb', [AuthWebController::class, 'showRegistrationForm'])->name('register');
Route::post('/registerweb', [AuthWebController::class, 'register']);
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');