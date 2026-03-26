<?php

use App\Http\Controllers\Pos\PosController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminProductoController;
use App\Http\Controllers\Admin\AdminClienteController;

Route::get('/pos', [PosController::class, 'index']);
Route::get('/admin', [AdminController::class, 'index']);

// Esto no se toca
Route::post('/pos/guardar', [PosController::class, 'guardarVenta']);
Route::post('/pos/cliente', [PosController::class, 'guardarCliente']);


// 🔥 ADMIN (AGREGADO)

// PRODUCTOS
Route::get('/admin/productos', [AdminProductoController::class, 'index']);
Route::get('/admin/productos/create', [AdminProductoController::class, 'create']);
Route::post('/admin/productos', [AdminProductoController::class, 'store']);

// CLIENTES
Route::get('/admin/clientes', [AdminClienteController::class, 'index']);
Route::get('/admin/clientes/create', [AdminClienteController::class, 'create']);
Route::post('/admin/clientes', [AdminClienteController::class, 'store']);

// REPORTES
Route::get('/admin/reportes', function () {
    return view('admin.reportes.index');
});
