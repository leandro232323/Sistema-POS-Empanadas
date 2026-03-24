<h1>Punto de Venta</h1>

<h2>Productos</h2>
@foreach($productos as $producto)
    <div>
        {{ $producto->nombre }} - ${{ $producto->precio }}
    </div>
@endforeach

<h2>Clientes</h2>
<select>
    @foreach($clientes as $cliente)
        <option value="{{ $cliente->id }}">
            {{ $cliente->nombre }}
        </option>
    @endforeach
</select>