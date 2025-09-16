<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthWebController extends Controller
{
    // Mostrar login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Procesar login
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return back()->withErrors(['email' => 'Credenciales inválidas']);
            }

            session(['jwt_token' => $token]);

            return redirect()->route('dashboard');
        } catch (JWTException $e) {
            return back()->withErrors(['email' => 'Error interno, intenta de nuevo.']);
        }
    }

    // Mostrar registro
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Procesar registro
    public function register(Request $request)
{
    $validatedData = $request->validate([
        'rut' => ['required', 'string', 'max:12', 'unique:users'],
        'nombre' => ['required', 'string', 'max:255'],
        'apellido' => ['required', 'string', 'max:255'],
        'email' => ['required', 'email', 'unique:users,email'],
        'password' => ['required', 'confirmed', 'min:8'],
    ]);

    $user = User::create([
        'rut' => $validatedData['rut'],
        'nombre' => $validatedData['nombre'],
        'apellido' => $validatedData['apellido'],
        'email' => $validatedData['email'],
        'password' => Hash::make($validatedData['password']),
    ]);

    // 🔹 En lugar de loguear directamente, mandamos un flash a la vista
return redirect()->route('loginweb')->with('success', 'Usuario registrado correctamente.');

}

    // Logout
    public function logout()
    {
        $token = session('jwt_token');

        if ($token) {
            try {
                JWTAuth::setToken($token)->invalidate();
            } catch (\Exception $e) {
                // ignoramos si ya expiró
            }
        }

        session()->forget('jwt_token');
        Auth::logout();

        return redirect('/loginweb');
    }
}
