<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReporteController extends Controller
{
    public function index(Request $request)
    {
        $inicio = $request->inicio;
        $fin = $request->fin;

        // 🔹 Ventas totales
        $ventasTotales = DB::table('ventas')
            ->when($inicio, fn($q) => $q->whereDate('fecha', '>=', $inicio))
            ->when($fin, fn($q) => $q->whereDate('fecha', '<=', $fin))
            ->sum('total');

        // 🔹 Ventas por tipo de producto
        $ventasPorTipo = DB::table('detalle_ventas as dv')
            ->join('productos as p', 'dv.producto_id', '=', 'p.id')
            ->join('ventas as v', 'dv.venta_id', '=', 'v.id')
            ->when($inicio, fn($q) => $q->whereDate('v.fecha', '>=', $inicio))
            ->when($fin, fn($q) => $q->whereDate('v.fecha', '<=', $fin))
            ->select('p.tipo', DB::raw('SUM(dv.subtotal) as total'))
            ->groupBy('p.tipo')
            ->get();

        // 🔹 Cantidad de productos vendidos
        $cantidadProductos = DB::table('detalle_ventas as dv')
            ->join('ventas as v', 'dv.venta_id', '=', 'v.id')
            ->when($inicio, fn($q) => $q->whereDate('v.fecha', '>=', $inicio))
            ->when($fin, fn($q) => $q->whereDate('v.fecha', '<=', $fin))
            ->sum('dv.cantidad');

        // 🔹 Ventas por cliente (conteo)
        $ventasClientes = DB::table('ventas as v')
            ->join('clientes as c', 'v.cliente_id', '=', 'c.id')
            ->when($inicio, fn($q) => $q->whereDate('v.fecha', '>=', $inicio))
            ->when($fin, fn($q) => $q->whereDate('v.fecha', '<=', $fin))
            ->select('c.es_mostrador', DB::raw('COUNT(*) as total'))
            ->groupBy('c.es_mostrador')
            ->get();

        // 🔥 🔥 🔥 PORCENTAJES (LO QUE TE FALTABA)
        $totalVentasClientes = $ventasClientes->sum('total');

        $porcentajesClientes = $ventasClientes->map(function ($v) use ($totalVentasClientes) {
            $v->porcentaje = $totalVentasClientes > 0 
                ? round(($v->total / $totalVentasClientes) * 100, 2)
                : 0;
            return $v;
        });

        // 🔹 Ventas por ciudad
        $ventasCiudad = DB::table('ventas as v')
            ->join('clientes as c', 'v.cliente_id', '=', 'c.id')
            ->when($inicio, fn($q) => $q->whereDate('v.fecha', '>=', $inicio))
            ->when($fin, fn($q) => $q->whereDate('v.fecha', '<=', $fin))
            ->select('c.ciudad', DB::raw('SUM(v.total) as total'))
            ->groupBy('c.ciudad')
            ->get();

        // 🔹 Top productos más vendidos
        $topProductos = DB::table('detalle_ventas as dv')
            ->join('productos as p', 'dv.producto_id', '=', 'p.id')
            ->join('ventas as v', 'dv.venta_id', '=', 'v.id')
            ->when($inicio, fn($q) => $q->whereDate('v.fecha', '>=', $inicio))
            ->when($fin, fn($q) => $q->whereDate('v.fecha', '<=', $fin))
            ->select('p.nombre', DB::raw('SUM(dv.cantidad) as total'))
            ->groupBy('p.nombre')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        return view('admin.reportes.index', compact(
            'ventasTotales',
            'ventasPorTipo',
            'cantidadProductos',
            'ventasClientes',
            'ventasCiudad',
            'topProductos',
            'porcentajesClientes' // 🔥 IMPORTANTE
        ));
    }
}