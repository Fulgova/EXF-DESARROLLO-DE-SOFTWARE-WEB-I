<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controller;



class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    private function rules($id = null)
    {
        return [
            'rut_empresa' => 'required|string|max:20|unique:clients,rut_empresa,' . $id,
            'rubro' => 'required|string|max:100',
            'razon_social' => 'required|string|max:255',
            'telefono' => 'nullable|string|max:20',
            'direccion' => 'nullable|string|max:255',
            'nombre_contacto' => 'required|string|max:100',
            'email_contacto' => 'required|email|unique:clients,email_contacto,' . $id,
        ];
    }

    //  Listar clientes
    public function index()
    {
        return response()->json(Client::all(), 200);
    }

    //  Mostrar cliente
    public function show($id)
    {
        $client = Client::find($id);
        if (!$client) {
            return response()->json(['message' => 'Cliente no encontrado'], 404);
        }
        return response()->json($client, 200);
    }

    //  Crear cliente
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules());

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $client = Client::create($request->all());

        return response()->json([
            'message' => ' Cliente registrado correctamente',
            'client' => $client
        ], 201);
    }

    //  Actualizar cliente
    public function update(Request $request, $id)
    {
        $client = Client::find($id);
        if (!$client) {
            return response()->json(['message' => 'Cliente no encontrado'], 404);
        }

        $validator = Validator::make($request->all(), $this->rules($client->id));
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $client->update($request->all());

        return response()->json([
            'message' => ' Cliente actualizado correctamente',
            'client' => $client
        ], 200);
    }

    //  Eliminar cliente
    public function destroy($id)
    {
        $client = Client::find($id);
        if (!$client) {
            return response()->json(['message' => 'Cliente no encontrado'], 404);
        }

        $client->delete();
        return response()->json(['message' => ' Cliente eliminado correctamente'], 200);
    }
}
