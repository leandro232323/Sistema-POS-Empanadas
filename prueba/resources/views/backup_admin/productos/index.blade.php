<h1>Productos</h1>

<a href="/admin/productos/create">Crear producto</a>

@if(session('success'))
    <p>{{ session('success') }}</p>
@endif

@if(session('error'))
    <p>{{ session('error') }}</p>
@endif

<table border="1">
    <tr>
        <th>Nombre</th>
        <th>Tipo</th>
        <th>Precio</th>
        <th>Estado</th>
        <th>Acciones</th>
    </tr>

    @foreach($productos as $p)
    <tr>
        <td>{{ $p->nombre }}</td>
        <td>{{ $p->tipo }}</td>
        <td>{{ $p->precio }}</td>
        <td>{{ $p->estado ? 'Activo' : 'Inactivo' }}</td>
        <td>
            <a href="/admin/productos/{{ $p->id }}/edit">Editar</a>

            <form action="/admin/productos/{{ $p->id }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">Eliminar</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>