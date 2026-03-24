<?php

use App\Http\Controllers\Pos\PosController;
use App\Http\Controllers\Admin\AdminController;

Route::get('/pos', [PosController::class, 'index']);
Route::get('/admin', [AdminController::class, 'index']);

// Esto no se toca
Route::post('/pos/guardar', [PosController::class, 'guardarVenta']);
Route::post('/pos/cliente', [PosController::class, 'guardarCliente']);