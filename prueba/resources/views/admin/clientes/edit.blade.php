asi ??  

@extends('admin.layout')

@section('title', 'Editar Cliente')

@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <h2>
            <i class="bi bi-pencil-square me-2"></i>Editar Cliente
        </h2>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                Información del Cliente
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

                <form method="POST" action="{{ route('clientes.update', $cliente->id) }}">
                        @csrf
                        @method('PUT')

                        {{-- TIPO DOCUMENTO --}}
                        <div class="mb-3">
                            <label class="form-label">Tipo de documento</label>
                            <select name="tipo_documento" class="form-control @error('tipo_documento') is-invalid @enderror" required>
                                <option value="">Seleccione</option>
                                <option value="CC" {{ old('tipo_documento', $cliente->tipo_documento) == 'CC' ? 'selected' : '' }}>CC</option>
                                <option value="TI" {{ old('tipo_documento', $cliente->tipo_documento) == 'TI' ? 'selected' : '' }}>TI</option>
                                <option value="CE" {{ old('tipo_documento', $cliente->tipo_documento) == 'CE' ? 'selected' : '' }}>CE</option>
                            </select>
                            @error('tipo_documento')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- NUMERO DOCUMENTO --}}
                        <div class="mb-3">
                            <label class="form-label">Número de documento</label>
                            <input type="text" name="numero_documento"
                                class="form-control @error('numero_documento') is-invalid @enderror"
                                value="{{ old('numero_documento', $cliente->numero_documento) }}" required>

                            @error('numero_documento')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- NOMBRE --}}
                        <div class="mb-3">
                            <label class="form-label">Nombre</label>
                            <input type="text" name="nombre"
                                class="form-control @error('nombre') is-invalid @enderror"
                                value="{{ old('nombre', $cliente->nombre) }}" required>

                            @error('nombre')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- DIRECCION --}}
                        <div class="mb-3">
                            <label class="form-label">Dirección</label>
                            <input type="text" name="direccion"
                                class="form-control"
                                value="{{ old('direccion', $cliente->direccion) }}">
                        </div>

                        {{-- CIUDAD --}}
                        <div class="mb-3">
                            <label class="form-label">Ciudad</label>
                            <input type="text" name="ciudad"
                                class="form-control"
                                value="{{ old('ciudad', $cliente->ciudad) }}">
                        </div>

                        {{-- TELEFONO --}}
                        <div class="mb-3">
                            <label class="form-label">Teléfono</label>
                            <input type="text" name="telefono"
                                class="form-control @error('telefono') is-invalid @enderror"
                                value="{{ old('telefono', $cliente->telefono) }}" required>

                            @error('telefono')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- BOTONES --}}
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                Actualizar
                            </button>

                            <a href="/admin/clientes" class="btn btn-secondary">
                                Cancelar
                            </a>
                        </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection