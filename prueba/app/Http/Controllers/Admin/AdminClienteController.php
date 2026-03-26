<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminClienteController extends Controller
{
    public function index()
    {
        $clientes = [
            ["nombre" => "Juan Pérez", "telefono" => "123456"],
            ["nombre" => "Cliente mostrador", "telefono" => "N/A"],
        ];

        return view('admin.clientes.index', compact('clientes'));
    }

    public function create()
    {
        return view('admin.clientes.create');
    }

    public function store(Request $request)
    {
        return redirect('/admin/clientes');
    }
}
