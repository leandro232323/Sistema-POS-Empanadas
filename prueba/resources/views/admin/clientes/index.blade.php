<h2>Clientes</h2>

<a href="/admin/clientes/create">Crear cliente</a>

<ul>
@foreach($clientes as $c)
    <li>{{ $c['nombre'] }} - {{ $c['telefono'] }}</li>
@endforeach
</ul>