@extends('admin.layout')

@section('title', 'Crear Producto')
<!-- terminado-->

@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <h2>
            <i class="bi bi-plus-circle me-2"></i>Crear Nuevo Producto
        </h2>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                Información del Producto
            </div>

            <div class="card-body">

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- 🔴 NO TOCO TU ACTION NI LOGICA --}}
                <form method="POST" action="/admin/productos">
                    @csrf

                    {{-- NOMBRE --}}
                    <div class="mb-3">
                        <label class="form-label">Nombre del Producto</label>
                        <input type="text"
                               name="nombre"
                               class="form-control"
                               placeholder="Ej: Empanada de carne"
                               value="{{ old('nombre') }}"
                               required>
                    </div>

                    {{-- TIPO --}}
                    <div class="mb-3">
                        <label class="form-label">Tipo</label>
                        <select name="tipo" class="form-select" required>
                            <option value="">Seleccione</option>
                            <option value="empanada">Empanada</option>
                            <option value="papa_rellena">Papa rellena</option>
                        </select>
                    </div>

                    {{-- PRECIO --}}
                    <div class="mb-3">
                        <label class="form-label">Precio</label>
                        <input type="number"
                               name="precio"
                               class="form-control"
                               placeholder="Ej: 2500"
                               value="{{ old('precio') }}"
                               required>
                    </div>

                    {{-- ESTADO --}}
                    <div class="mb-3">
                        <label class="form-label">Estado</label>
                        <select name="estado" class="form-select" required>
                            <option value="1">Activo</option>
                            <option value="0">Inactivo</option>
                        </select>
                    </div>

                    {{-- BOTONES --}}
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle me-2"></i>Guardar Producto
                        </button>

                        <a href="/admin/productos" class="btn btn-secondary">
                            <i class="bi bi-x-circle me-2"></i>Cancelar
                        </a>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>
@endsection