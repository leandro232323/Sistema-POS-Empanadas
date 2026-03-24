<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use App\Models\Cliente;
use App\Models\Venta;
use App\Models\DetalleVenta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PosController extends Controller
{
    // 🔹 Mostrar POS
    public function index()
    {
        $productos = Producto::where('estado', true)->get();
        $clientes = Cliente::all();

        return view('pos.index', compact('productos', 'clientes'));
    }

    // 🔹 Guardar venta
    public function guardarVenta(Request $request)
    {
        DB::beginTransaction();

        try {

            // ✅ Validar que exista productos en la solicitud
            if (!$request->has('productos')) {
                return back()->with('error', 'No hay productos en la solicitud');
            }

            // ✅ Validar que al menos uno tenga cantidad > 0
            $hayProductos = false;

            foreach ($request->productos as $p) {
                if ($p['cantidad'] > 0) {
                    $hayProductos = true;
                    break;
                }
            }

            if (!$hayProductos) {
                return back()->with('error', 'Debe agregar al menos un producto');
            }

            // ✅ Crear venta
            $venta = Venta::create([
                'cliente_id' => $request->cliente_id,
                'total' => 0
            ]);

            // ✅ Guardar detalle de venta
            foreach ($request->productos as $p) {

                if ($p['cantidad'] > 0) {

                    $subtotal = $p['cantidad'] * $p['precio'];

                    DetalleVenta::create([
                        'venta_id' => $venta->id,
                        'producto_id' => $p['id'],
                        'cantidad' => $p['cantidad'],
                        'precio_unitario' => $p['precio'],
                        'subtotal' => $subtotal
                    ]);
                }
            }

            DB::commit();

            return redirect('/pos')->with('success', 'Venta realizada correctamente');

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with('error', 'Error al guardar la venta');
        }
    }
}