<h2>Productos</h2>

<a href="/admin/productos/create">Crear producto</a>

<ul>
@foreach($productos as $p)
    <li>{{ $p['nombre'] }} - {{ $p['tipo'] }} - ${{ $p['precio'] }}</li>
@endforeach
</ul>