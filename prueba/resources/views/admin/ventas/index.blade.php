@extends('admin.layout')

@section('title', 'Ventas')

@section('content')

<div class="row mb-4">
    <div class="col-md-12">
        <h2 class="mb-0">
            <i class="bi bi-cart me-2"></i>Historial de Ventas
        </h2>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">

            <div class="card-header d-flex justify-content-between align-items-center">
                <span>
                    <i class="bi bi-list-ul me-2"></i>Listado de Ventas
                </span>

                {{-- 🔍 BUSCADOR --}}
                <div style="position: relative; width: 250px;">
                    <i class="bi bi-search" 
                       style="position:absolute; left:10px; top:8px; color:#6c757d;"></i>
                    <input 
                        type="text" 
                        id="buscarVentas" 
                        class="form-control ps-4"
                        placeholder=" Buscar cliente, ciudad..."
                        autocomplete="off"
                    >
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">

                    <table class="table table-hover align-middle" id="tablaVentas">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Cliente</th>
                                <th>Ciudad</th>
                                <th>Total</th>
                                <th>Fecha</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($ventas as $venta)

                                @php
                                    $searchVal = strtolower(
                                        ($venta->cliente ?? '') . ' ' .
                                        ($venta->ciudad ?? '') . ' ' .
                                        number_format($venta->total, 0, ',', '.') . ' ' .
                                        \Carbon\Carbon::parse($venta->fecha)->format('d/m/Y H:i')
                                    );
                                @endphp

                                <tr data-search="{{ $searchVal }}">
                                    <td>{{ $venta->id }}</td>

                                    <td>
                                        <strong>{{ $venta->cliente }}</strong>
                                    </td>

                                    <td>
                                        {{ $venta->ciudad ?? 'N/A' }}
                                    </td>

                                    <td>
                                        <span class="badge bg-success">
                                            $ {{ number_format($venta->total, 0, ',', '.') }}
                                        </span>
                                    </td>

                                    <td>
                                        {{ \Carbon\Carbon::parse($venta->fecha)->format('d/m/Y H:i') }}
                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted">
                                        No hay ventas registradas
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>

                </div>
            </div>
        </div>
    </div>
</div>

{{-- 🔍 SCRIPT BUSCADOR --}}
<script>
document.getElementById('buscarVentas')?.addEventListener('input', function () {
    const q = this.value.toLowerCase().trim();

    document.querySelectorAll('#tablaVentas tbody tr').forEach(tr => {
        const text = tr.dataset.search || '';
        const match = text.includes(q);

        tr.style.display = match ? '' : 'none';
    });
});
</script>

@endsection