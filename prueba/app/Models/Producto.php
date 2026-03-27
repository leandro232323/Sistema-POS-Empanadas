<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';

    protected $fillable = [
        'nombre',
        'tipo',
        'precio',
        'estado'
    ];

    public $timestamps = false; // tu BD no usa updated_at correctamente
}