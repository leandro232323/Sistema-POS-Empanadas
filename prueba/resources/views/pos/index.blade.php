<h1>Punto de Venta</h1>

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

@if(session('error'))
    <p style="color: red;">{{ session('error') }}</p>
@endif

{{-- 🔹 FORMULARIO VENTA --}}
<form method="POST" action="/pos/guardar">
    @csrf

    <h3>Cliente</h3>
    <select name="cliente_id" required>
        @foreach($clientes as $cliente)
            <option value="{{ $cliente->id }}">
                {{ $cliente->nombre }}
            </option>
        @endforeach
    </select>

    <h3>Productos</h3>

    <div id="productos">
        @foreach($productos as $producto)
            <div style="margin-bottom:10px;">
                <strong>{{ $producto->nombre }}</strong> - ${{ $producto->precio }}

                <br>

                Cantidad:
                <input type="number" min="0" value="0"
                    class="cantidad"
                    data-precio="{{ $producto->precio }}">

                <span>Subtotal: $<span class="subtotal">0</span></span>

                <input type="hidden"
                    name="productos[{{ $loop->index }}][id]"
                    value="{{ $producto->id }}">

                <input type="hidden"
                    name="productos[{{ $loop->index }}][precio]"
                    value="{{ $producto->precio }}">

                <input type="hidden"
                    name="productos[{{ $loop->index }}][cantidad]"
                    class="cantidad-hidden" value="0">
            </div>
        @endforeach
    </div>

    <h3>Total: $<span id="total">0</span></h3>

    <button type="submit" onclick="return confirm('¿Confirmar venta?')">
        Vender
    </button>
</form>

<hr>


@if ($errors->any())
    <div style="color:red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>Existe un usuario con el mismo documento, intente con otro</li>
            @endforeach
        </ul>
    </div>
@endif

{{-- 🔹 FORMULARIO NUEVO CLIENTE (SEPARADO) --}}
<h3>Nuevo Cliente</h3>

<form method="POST" action="/pos/cliente">
    @csrf

    <input type="text" name="tipo_documento" placeholder="Tipo doc" required>
    <input type="text" name="numero_documento" placeholder="Número doc" required>
    <input type="text" name="nombre" placeholder="Nombre completo" required>
    <input type="text" name="direccion" placeholder="Dirección">
    <input type="text" name="ciudad" placeholder="Ciudad">
    <input type="text" name="telefono" placeholder="Teléfono">

    <button type="submit">Guardar Cliente</button>
</form>

<script>
    const cantidades = document.querySelectorAll('.cantidad');

    cantidades.forEach((input, index) => {
        input.addEventListener('input', () => {

            let total = 0;

            cantidades.forEach((el, i) => {
                let precio = parseFloat(el.dataset.precio);
                let cantidad = parseInt(el.value) || 0;

                let subtotal = precio * cantidad;

                document.querySelectorAll('.subtotal')[i].innerText = subtotal;

                document.querySelectorAll('.cantidad-hidden')[i].value = cantidad;

                total += subtotal;
            });

            document.getElementById('total').innerText = total;
        });
    });
</script>