<h1>Editar Producto</h1>

<form method="POST" action="/admin/productos/{{ $producto->id }}">
    @csrf
    @method('PUT')

    <input type="text" name="nombre" value="{{ $producto->nombre }}">

    <select name="tipo">
        <option value="empanada" {{ $producto->tipo == 'empanada' ? 'selected' : '' }}>Empanada</option>
        <option value="papa_rellena" {{ $producto->tipo == 'papa_rellena' ? 'selected' : '' }}>Papa rellena</option>
    </select>

    <input type="number" name="precio" value="{{ $producto->precio }}">

    <select name="estado">
        <option value="1" {{ $producto->estado ? 'selected' : '' }}>Activo</option>
        <option value="0" {{ !$producto->estado ? 'selected' : '' }}>Inactivo</option>
    </select>

    <button type="submit">Actualizar</button>
</form>