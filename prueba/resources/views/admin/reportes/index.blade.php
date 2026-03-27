@extends('admin.layout')

@section('title', 'Reportes')

@section('content')

<!-- terminado-->


<div class="row mb-4">
    <div class="col-md-12">
        <h2>
            <i class="bi bi-graph-up me-2"></i>Reportes de Ventas
        </h2>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header">
        <i class="bi bi-funnel me-2"></i>Filtros
    </div>

    <div class="card-body">
        <form method="GET" class="row g-3">
            <div class="col-md-4">
                <label>Fecha inicio</label>
                <input type="date" name="inicio" class="form-control">
            </div>

            <div class="col-md-4">
                <label>Fecha fin</label>
                <input type="date" name="fin" class="form-control">
            </div>

            <div class="col-md-4 d-flex align-items-end">
                <button class="btn btn-primary w-100">
                    <i class="bi bi-search me-2"></i>Filtrar
                </button>
            </div>
        </form>
    </div>
</div>

<div class="row">

    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-header">Ventas Totales</div>
            <div class="card-body">
                <h3>${{ number_format($ventasTotales, 0) }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-header">Productos Vendidos</div>
            <div class="card-body">
                <h3>{{ $cantidadProductos }}</h3>
            </div>
        </div>
    </div>

</div>

<br>

<div class="card">
    <div class="card-header">Ventas por Tipo</div>
    <div class="card-body">
        @foreach($ventasPorTipo as $v)
            <p>{{ $v->tipo }}: ${{ number_format($v->total, 0) }}</p>
        @endforeach
    </div>
</div>

<br>

<div class="card">
    <div class="card-header">Ventas por Cliente (%)</div>
    <div class="card-body">
        @foreach($porcentajesClientes as $v)
            <p>
                {{ $v->es_mostrador ? 'Mostrador' : 'Registrados' }}:
                {{ $v->porcentaje }}%
            </p>
        @endforeach
    </div>
</div>

<br>

<div class="card">
    <div class="card-header">Ventas por Ciudad</div>
    <div class="card-body">
        @foreach($ventasCiudad as $v)
            <p>{{ $v->ciudad }}: ${{ number_format($v->total, 0) }}</p>
        @endforeach
    </div>
</div>

<br>

<div class="card">
    <div class="card-header">Top Productos</div>
    <div class="card-body">
        @foreach($topProductos as $p)
            <p>{{ $p->nombre }} ({{ $p->total }})</p>
        @endforeach
    </div>
</div>

@endsection