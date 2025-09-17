<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Client;

class DashboardController extends Controller
{
    public function index()
    {
        // Contadores
        $usersCount = User::count();
        $productsCount = Product::count();
        $clientsCount = Client::count();

        // Listas (para los modales)
        $users = User::all();
        $products = Product::all();

        return view('dashboard', compact(
            'usersCount',
            'productsCount',
            'clientsCount',
            'users',
            'products'
        ));
    }
}
