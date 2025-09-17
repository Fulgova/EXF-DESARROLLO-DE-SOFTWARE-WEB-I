<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserWebController;
use App\Http\Controllers\AuthWebController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClientsController;
use App\Models\User;

Route::get('/', function () {
    return view('welcome');
});

// Listado de usuarios (protegido con JWT)
Route::get('/usuarios', [UserWebController::class, 'index'])
    ->middleware('jwt.web');
Route::get('/users/{id}', [UserWebController::class, 'show']);
Route::post('/users', [UserWebController::class, 'store']);
Route::delete('/users/{id}', [UserWebController::class, 'destroy']);
Route::put('/users/{id}', [UserWebController::class, 'update']);

// Dashboard protegido con JWT
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

// Buscar usuario por ID (protegido con JWT)
Route::get('/users/{id}', function ($id) {
    $user = User::find($id);

    if (!$user) {
        return response()->json(['error' => 'Usuario no encontrado'], 404);
    }

    return response()->json($user);
})->middleware('jwt.web');

use App\Http\Controllers\ProductWebController;

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