<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cliente;

class ClienteController extends Controller
{
    // 🔹 LISTAR CLIENTES
    public function index()
    {
        $clientes = Cliente::all();
        return view('admin.clientes.index', compact('clientes'));
    }

    // 🔹 FORM CREAR
    public function create()
    {
        return view('admin.clientes.create');
    }

    // 🔹 GUARDAR CLIENTE
    public function store(Request $request){
        $request->validate([
            'tipo_documento' => 'required',
            'numero_documento' => 'required|unique:clientes',
            'nombre' => 'required',
            'direccion' => 'nullable',
            'ciudad' => 'nullable',
            'telefono' => 'required'
        ]);

        Cliente::create($request->all());

        return redirect()->route('clientes.index')
            ->with('success', 'Cliente creado');
    }

    // 🔹 FORM EDITAR
    public function edit($id)
    {
        $cliente = Cliente::findOrFail($id);
        return view('admin.clientes.edit', compact('cliente'));
    }

    // 🔹 ACTUALIZAR CLIENTE
    public function update(Request $request, $id){
        $request->validate([
            'tipo_documento' => 'required',
            'numero_documento' => 'required',
            'nombre' => 'required',
            'telefono' => 'required',
        ]);

        $cliente = Cliente::findOrFail($id);

        $cliente->update([
            'tipo_documento' => $request->tipo_documento,
            'numero_documento' => $request->numero_documento,
            'nombre' => $request->nombre,
            'direccion' => $request->direccion,
            'ciudad' => $request->ciudad,
            'telefono' => $request->telefono,
        ]);

        return redirect()->route('clientes.index')
            ->with('success', 'Cliente actualizado correctamente');
    }


    // 🔹 ELIMINAR CLIENTE
    public function destroy($id){
        try {
            $cliente = Cliente::findOrFail($id);
            $cliente->delete();

            return redirect()->route('clientes.index')
                ->with('success', 'Cliente eliminado');

        } catch (\Exception $e) {
            return redirect()->route('clientes.index')
                ->with('error', $e->getMessage());
        }
    }

}