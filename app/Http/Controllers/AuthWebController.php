<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthWebController extends Controller
{
    // Mostrar el formulario de inicio de sesión
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Procesar el inicio de sesión
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'email' => 'Las credenciales no son válidas.',
        ]);
    }

    // Procesar el registro de un nuevo usuario
    public function register(Request $request)
    {
        // Validación de los datos del formulario
        $validatedData = $request->validate([
            'rut' => ['required', 'string', 'max:12', 'unique:users'],  // Validación para RUT
            'nombre' => ['required', 'string', 'max:255'],  // Validación para nombre
            'apellido' => ['required', 'string', 'max:255'],  // Validación para apellido
            'email' => ['required', 'email', 'unique:users,email'],  // Validación para email
            'password' => ['required', 'confirmed', 'min:8'],  // Validación para password
        ]);

        // Crear el usuario
        $user = User::create([
            'rut' => $validatedData['rut'],        // Guardamos el RUT
            'nombre' => $validatedData['nombre'],  // Guardamos el nombre
            'apellido' => $validatedData['apellido'], // Guardamos el apellido
            'email' => $validatedData['email'],    // Guardamos el email
            'password' => Hash::make($validatedData['password']), // Guardamos el password encriptado
        ]);

        // Autenticar al nuevo usuario
        Auth::login($user);

        // Redirigir al dashboard u otra página después del registro
        return redirect('/dashboard');
    }

    // Mostrar el formulario de registro
    public function showRegistrationForm()
    {
        return view('auth.register'); // Asegúrate de tener la vista 'auth.register'
    }

    // Cerrar sesión
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}