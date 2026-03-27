@extends('admin.layout')

@section('title', 'Editar Producto')
<!-- terminado-->


@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <h2>
            <i class="bi bi-pencil-square me-2"></i>Editar Producto
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

                {{-- 🔴 NO TOCO TU LOGICA --}}
                <form method="POST" action="/admin/productos/{{ $producto->id }}">
                    @csrf
                    @method('PUT')

                    {{-- NOMBRE --}}
                    <div class="mb-3">
                        <label class="form-label">Nombre del Producto</label>
                        <input type="text"
                               name="nombre"
                               class="form-control"
                               value="{{ old('nombre', $producto->nombre) }}"
                               required>
                    </div>

                    {{-- TIPO --}}
                    <div class="mb-3">
                        <label class="form-label">Tipo</label>
                        <select name="tipo" class="form-select" required>
                            <option value="empanada"
                                {{ $producto->tipo == 'empanada' ? 'selected' : '' }}>
                                Empanada
                            </option>

                            <option value="papa_rellena"
                                {{ $producto->tipo == 'papa_rellena' ? 'selected' : '' }}>
                                Papa rellena
                            </option>
                        </select>
                    </div>

                    {{-- PRECIO --}}
                    <div class="mb-3">
                        <label class="form-label">Precio</label>
                        <input type="number"
                               name="precio"
                               class="form-control"
                               value="{{ old('precio', $producto->precio) }}"
                               required>
                    </div>

                    {{-- ESTADO --}}
                    <div class="mb-3">
                        <label class="form-label">Estado</label>
                        <select name="estado" class="form-select" required>
                            <option value="1" {{ $producto->estado ? 'selected' : '' }}>
                                Activo
                            </option>

                            <option value="0" {{ !$producto->estado ? 'selected' : '' }}>
                                Inactivo
                            </option>
                        </select>
                    </div>

                    {{-- BOTONES --}}
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle me-2"></i>Actualizar Producto
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