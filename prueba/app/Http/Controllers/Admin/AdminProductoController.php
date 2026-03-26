<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminProductoController extends Controller
{
    public function index()
    {
        $productos = [
            ["nombre" => "Empanada carne", "tipo" => "empanada", "precio" => 3000],
            ["nombre" => "Papa rellena", "tipo" => "papa", "precio" => 3500],
        ];

        return view('admin.productos.index', compact('productos'));
    }

    public function create()
    {
        return view('admin.productos.create');
    }

    public function store(Request $request)
    {
        return redirect('/admin/productos');
    }
}