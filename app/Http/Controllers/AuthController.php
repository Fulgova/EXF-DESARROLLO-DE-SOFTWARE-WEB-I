<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    // Registro de usuario
public function register(Request $request)
{
    $validator = Validator::make($request->all(), [
        'rut' => 'required|string|max:12|unique:users',
        'nombre' => 'required|string|max:50',
        'apellido' => 'required|string|max:50',
        'email' => 'required|email|unique:users',
        'password' => 'required|string|min:8',
    ]);

    if ($validator->fails()) {
        return response()->json($validator->errors(), 422);
    }

    $user = User::create([
        'rut' => $request->rut,
        'nombre' => $request->nombre,
        'apellido' => $request->apellido,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    $token = JWTAuth::fromUser($user);

    return response()->json([
        'message' => ' Usuario registrado con exito',
        'token_message' => 'Este es tu token de seguridad',
        'token' => $token,
    ], 201);
}


    // Login de usuario
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!$token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => ' Credenciales invalidas'], 401);
        }

        return response()->json([
            'message' => ' Ingreso al sistema correctamente',
            'user' => auth('api')->user()->only(['id', 'rut', 'nombre', 'apellido', 'email']),
            'token' => $token
        ], 200);
    }

    // Logout
    public function logout()
    {
        auth('api')->logout();
        return response()->json(['message' => ' Sesion cerrada correctamente']);
    }
}
