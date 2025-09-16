<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controller;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    // Listar todos los usuarios
    public function index()
    {
        return response()->json(User::all(), 200);
    }

    // Obtener un usuario por ID
    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        return response()->json($user, 200);
    }

    // Crear un nuevo usuario
    public function store(Request $request)
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

        return response()->json($user, 201);
    }

    // Actualizar un usuario
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        $validator = Validator::make($request->all(), [
            'rut' => 'required|string|max:12|unique:users,rut,'.$user->id,
            'nombre' => 'required|string|max:50',
            'apellido' => 'required|string|max:50',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'password' => 'nullable|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user->update([
            'rut' => $request->rut,
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);

        return response()->json($user, 200);
    }

    // Eliminar un usuario
    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        $user->delete();

        return response()->json(['message' => 'Usuario eliminado correctamente'], 200);
    }
}