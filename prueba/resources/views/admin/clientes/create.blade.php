@extends('admin.layout')

@section('title', 'Crear Cliente')
<!-- terminado-->

@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <h2>
            <i class="bi bi-plus-circle me-2"></i>Crear Nuevo Cliente
        </h2>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                Información Cliente
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

                <form method="POST" action="{{ route('clientes.store') }}">
                    @csrf

                    {{-- TIPO DOCUMENTO --}}
                    <div class="mb-3">
                        <label class="form-label">Tipo de Documento</label>
                        <select name="tipo_documento" class="form-select" required>
                            <option value="">Seleccione</option>
                            <option value="CC">CC</option>
                            <option value="TI">TI</option>
                            <option value="CE">CE</option>
                        </select>
                    </div>

                    {{-- NUMERO DOCUMENTO --}}
                    <div class="mb-3">
                        <label class="form-label">Número de Documento</label>
                        <input type="text" name="numero_documento"
                               class="form-control"
                               value="{{ old('numero_documento') }}" required>
                    </div>

                    {{-- NOMBRE --}}
                    <div class="mb-3">
                        <label class="form-label">Nombre Completo</label>
                        <input type="text" name="nombre"
                               class="form-control"
                               value="{{ old('nombre') }}" required>
                    </div>

                    {{-- DIRECCION --}}
                    <div class="mb-3">
                        <label class="form-label">Dirección</label>
                        <input type="text" name="direccion"
                               class="form-control"
                               value="{{ old('direccion') }}">
                    </div>

                    {{-- CIUDAD --}}
                    <div class="mb-3">
                        <label class="form-label">Ciudad</label>
                        <input type="text" name="ciudad"
                               class="form-control"
                               value="{{ old('ciudad') }}">
                    </div>

                    {{-- TELEFONO --}}
                    <div class="mb-3">
                        <label class="form-label">Teléfono</label>
                        <input type="text" name="telefono"
                               class="form-control"
                               value="{{ old('telefono') }}" required>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            Guardar Cliente
                        </button>

                        <a href="{{ route('clientes.index') }}" class="btn btn-secondary">
                            Cancelar
                        </a>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>
@endsection