<h2>Crear Producto</h2>

<form method="POST" action="/admin/productos">
    @csrf
    <input type="text" name="nombre" placeholder="Nombre"><br>
    
    <select name="tipo">
        <option value="empanada">Empanada</option>
        <option value="papa">Papa rellena</option>
    </select><br>

    <input type="number" name="precio" placeholder="Precio"><br>

    <button type="submit">Guardar</button>
</form>