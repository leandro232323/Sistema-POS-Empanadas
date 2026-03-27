<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Producto;

class ProductoController extends Controller
{
    // LISTAR
    public function index()
    {
        $productos = Producto::all();
        return view('admin.productos.index', compact('productos'));
    }

    // FORM CREAR
    public function create()
    {
        return view('admin.productos.create');
    }

    // GUARDAR
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'tipo' => 'required|in:empanada,papa_rellena',
            'precio' => 'required|numeric|min:1',
            'estado' => 'required|boolean'
        ]);

        Producto::create($request->all());

        return redirect('/admin/productos')->with('success', 'Producto creado');
    }

    // FORM EDITAR
    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        return view('admin.productos.edit', compact('producto'));
    }

    // ACTUALIZAR
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required',
            'tipo' => 'required|in:empanada,papa_rellena',
            'precio' => 'required|numeric|min:1',
            'estado' => 'required|boolean'
        ]);

        $producto = Producto::findOrFail($id);
        $producto->update($request->all());

        return redirect('/admin/productos')->with('success', 'Producto actualizado');
    }

    // ELIMINAR
    public function destroy($id)
    {
        try {
            $producto = Producto::findOrFail($id);
            $producto->delete();

            return redirect('/admin/productos')->with('success', 'Producto eliminado');
        } catch (\Exception $e) {
            return redirect('/admin/productos')->with('error', $e->getMessage());
        }
    }
}