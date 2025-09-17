<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controller;
use App\Models\Product;


class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    private function rules($id = null)
    {
        return [
            'sku' => 'required|string|max:50|unique:products,sku,' . $id,
            'nombre' => 'required|string|max:100',
            'descripcion_corta' => 'nullable|string|max:255',
            'descripcion_larga' => 'nullable|string',
            'imagen' => 'nullable|string|max:255',
            'precio_neto' => 'required|numeric|min:0',
            'precio_venta' => 'required|numeric|min:0',
            'stock_actual' => 'required|integer|min:0',
            'stock_minimo' => 'required|integer|min:0',
            'stock_bajo' => 'required|integer|min:0',
            'stock_alto' => 'required|integer|min:0',
        ];
    }

    //  Listar productos
    public function index()
    {
        return response()->json(Product::all(), 200);
    }

    //  Mostrar un producto
    public function show($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }
        return response()->json($product, 200);
    }

    //  Crear producto
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules());

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $product = Product::create($request->all());

        return response()->json([
            'message' => 'Producto creado correctamente',
            'product' => $product
        ], 201);
    }

    //  Actualizar producto
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }

        $validator = Validator::make($request->all(), $this->rules($product->id));
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $product->update($request->all());

        return response()->json([
            'message' => 'Producto actualizado correctamente',
            'product' => $product
        ], 200);
    }

    // Eliminar producto
    public function destroy($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }

        $product->delete();
        return response()->json(['message' => ' Producto eliminado correctamente'], 200);
    }
}
