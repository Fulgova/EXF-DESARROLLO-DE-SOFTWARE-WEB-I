<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    public function index()
    {
        return Client::all();
    }

    public function show($id)
    {
        return Client::findOrFail($id);
    }

public function store(Request $request)
{
    \Log::info('Datos recibidos en store:', $request->all());

    $validated = $request->validate([
        'rut_empresa' => 'required|string|max:20',
        'rubro' => 'required|string|max:255',
        'razon_social' => 'required|string|max:255',
        'telefono' => 'nullable|string|max:20',
        'direccion' => 'nullable|string|max:255',
        'nombre_contacto' => 'required|string|max:255',
        'email_contacto' => 'required|email|max:255',
    ]);

    $client = Client::create($validated);

    return response()->json($client, 201);
}



    public function update(Request $request, $id)
    {
        $client = Client::findOrFail($id);

        $validated = $request->validate([
            'rut_empresa' => 'sometimes|string|max:20',
            'rubro' => 'sometimes|string|max:255',
            'razon_social' => 'sometimes|string|max:255',
            'telefono' => 'nullable|string|max:20',
            'direccion' => 'nullable|string|max:255',
            'nombre_contacto' => 'sometimes|string|max:255',
            'email_contacto' => 'sometimes|email|max:255',
        ]);

        $client->update($validated);

        return response()->json($client);
    }

    public function destroy($id)
    {
        $client = Client::findOrFail($id);
        $client->delete();

        return response()->json(null, 204);
    }
}
