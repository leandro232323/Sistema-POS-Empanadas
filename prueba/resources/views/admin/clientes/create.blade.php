<h2>Crear Cliente</h2>

<form method="POST" action="/admin/clientes">
    @csrf
    <input type="text" name="nombre" placeholder="Nombre"><br>
    <input type="text" name="telefono" placeholder="Teléfono"><br>

    <button type="submit">Guardar</button>
</form>