<h1>Crear Producto</h1>

<form method="POST" action="/admin/productos">
    @csrf

    <input type="text" name="nombre" placeholder="Nombre">

    <select name="tipo">
        <option value="empanada">Empanada</option>
        <option value="papa_rellena">Papa rellena</option>
    </select>

    <input type="number" name="precio" placeholder="Precio">

    <select name="estado">
        <option value="1">Activo</option>
        <option value="0">Inactivo</option>
    </select>

    <button type="submit">Guardar</button>
</form>