<?php

use App\Http\Controllers\Pos\PosController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProductoController;
use App\Http\Controllers\Admin\ClienteController;
use App\Http\Controllers\Admin\ReporteController;
use App\Http\Controllers\Admin\VentaController;

// POS
Route::get('/pos', [PosController::class, 'index']);
Route::post('/pos/guardar', [PosController::class, 'guardarVenta']);
Route::post('/pos/cliente', [PosController::class, 'guardarCliente']);

// ADMIN
Route::prefix('admin')->group(function () {

    Route::get('/', [AdminController::class, 'index']);

    Route::resource('productos', ProductoController::class);
    Route::resource('clientes', ClienteController::class);

    Route::get('reportes', [ReporteController::class, 'index']);

    Route::get('ventas', [VentaController::class, 'index']);
});

// HOME
Route::get('/', [AdminController::class, 'index']);