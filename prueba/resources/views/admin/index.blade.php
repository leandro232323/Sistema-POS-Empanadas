@extends('admin.layout')

@section('title', 'Inicio')

@section('content')

<div class="card">
    <div class="card-header">
        Menú principal
    </div>

    <div class="card-body">
        <div class="row">

            <div class="col-md-4">
                <a href="/admin/productos" class="btn btn-primary w-100 mb-3">
                    📦 Gestión de productos
                </a>
            </div>

            <div class="col-md-4">
                <a href="/admin/clientes" class="btn btn-primary w-100 mb-3">
                    👥 Gestión de clientes
                </a>
            </div>

            <div class="col-md-4">
                <a href="/admin/reportes" class="btn btn-primary w-100 mb-3">
                    📊 Informes de ventas
                </a>
            </div>

        </div>
    </div>
</div>

@endsection