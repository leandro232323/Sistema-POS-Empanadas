<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class VentaController extends Controller{
    public function index(){
        $ventas = DB::table('ventas as v')
            ->join('clientes as c', 'v.cliente_id', '=', 'c.id')
            ->select(
                'v.id',
                'c.nombre as cliente',
                'c.ciudad',
                'v.total',
                'v.fecha'
            )
            ->orderBy('v.fecha', 'desc')
            ->get();

        return view('admin.ventas.index', compact('ventas'));
    }
}