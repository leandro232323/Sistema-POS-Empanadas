@extends('admin.layout')

@section('title', 'Clientes')

@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="mb-0">
                <i class="bi bi-people me-2"></i>Gestión de Clientes
            </h2>
            <a href="/admin/clientes/crear" class="btn btn-primary">
                <i class="bi bi-plus-circle me-2"></i>Nuevo Cliente
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-list-ul me-2"></i>Lista de Clientes
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Teléfono</th>
                                <th>Email</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($clientes as $cliente)
                            <tr>
                                <td>{{ $cliente->id }}</td>
                                <td><strong>{{ $cliente->nombre }}</strong></td>
                                <td>{{ $cliente->telefono }}</td>
                                <td>
                                    @if($cliente->email)
                                        <a href="mailto:{{ $cliente->email }}">
                                            <i class="bi bi-envelope me-1"></i>{{ $cliente->email }}
                                        </a>
                                    @else
                                        <span class="text-muted">Sin email</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="/admin/clientes/{{ $cliente->id }}/editar" class="btn btn-sm btn-warning me-2">
                                        <i class="bi bi-pencil-square"></i> Editar
                                    </a>
                                    <form method="POST" action="/admin/clientes/{{ $cliente->id }}" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar este cliente?')">
                                            <i class="bi bi-trash"></i> Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection