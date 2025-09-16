<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Client;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'usersCount' => User::count(),
            'productsCount' => Product::count(),
            'clientsCount' => Client::count(),
            'users' => User::all(),
        ]);
    }
}
