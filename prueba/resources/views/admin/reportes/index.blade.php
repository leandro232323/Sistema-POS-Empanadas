@extends('admin.layout')

@section('title', 'Reportes')

@section('content')

<!-- terminado-->

{{-- ===== ESTILOS DE ESTRUCTURA ===== --}}
<style>
    .rpt-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 28px;
        padding-bottom: 16px;
        border-bottom: 2px solid #f0f0f0;
    }
    .rpt-header h2 {
        margin: 0;
        font-size: 1.6rem;
        font-weight: 700;
        color: #1e293b;
    }
    .rpt-header .rpt-subtitle {
        font-size: 0.85rem;
        color: #94a3b8;
        margin-top: 2px;
    }

    /* Filtros */
    .rpt-filter-card {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 20px 24px;
        margin-bottom: 28px;
    }
    .rpt-filter-card label {
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #64748b;
        margin-bottom: 6px;
        display: block;
    }

    /* KPI Cards */
    .rpt-kpi-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 16px;
        margin-bottom: 28px;
    }
    .rpt-kpi {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        padding: 22px 24px;
        display: flex;
        align-items: center;
        gap: 16px;
        box-shadow: 0 1px 4px rgba(0,0,0,0.05);
        transition: box-shadow 0.2s;
    }
    .rpt-kpi:hover { box-shadow: 0 4px 16px rgba(0,0,0,0.09); }
    .rpt-kpi-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
        flex-shrink: 0;
    }
    .rpt-kpi-icon.orange { background: #fff7ed; color: #f97316; }
    .rpt-kpi-icon.blue   { background: #eff6ff; color: #3b82f6; }
    .rpt-kpi-label {
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #94a3b8;
        margin-bottom: 4px;
    }
    .rpt-kpi-value {
        font-size: 1.55rem;
        font-weight: 800;
        color: #1e293b;
        line-height: 1;
    }

    /* Grid de gráficas */
    .rpt-charts-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
        margin-bottom: 28px;
    }
    @media (max-width: 768px) {
        .rpt-charts-grid { grid-template-columns: 1fr; }
    }

    /* Chart cards */
    .rpt-chart-card {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        overflow: hidden;
        box-shadow: 0 1px 4px rgba(0,0,0,0.05);
        transition: box-shadow 0.2s;
    }
    .rpt-chart-card:hover { box-shadow: 0 4px 16px rgba(0,0,0,0.09); }
    .rpt-chart-header {
        padding: 14px 20px;
        border-bottom: 1px solid #f1f5f9;
        display: flex;
        align-items: center;
        gap: 8px;
        background: #fafafa;
    }
    .rpt-chart-header .rpt-chart-title {
        font-size: 0.9rem;
        font-weight: 700;
        color: #334155;
        margin: 0;
    }
    .rpt-chart-header i { color: #f97316; font-size: 1rem; }
    .rpt-chart-body {
        padding: 16px 20px 20px;
    }

    /* Lista de datos debajo de cada gráfica */
    .rpt-data-list {
        display: flex;
        flex-wrap: wrap;
        gap: 6px 14px;
        margin-bottom: 14px;
    }
    .rpt-data-list p {
        margin: 0;
        font-size: 0.82rem;
        color: #475569;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 20px;
        padding: 3px 10px;
    }
</style>

{{-- ===== ENCABEZADO ===== --}}
<div class="rpt-header">
    <div>
        <h2><i class="bi bi-graph-up me-2" style="color:#f97316;"></i>Reportes de Ventas</h2>
        <div class="rpt-subtitle">Estadísticas y análisis del negocio</div>
    </div>
</div>

{{-- ===== FILTROS ===== --}}
<div class="rpt-filter-card">
    <form method="GET" class="row g-3 align-items-end">
        <div class="col-md-4">
            <label><i class="bi bi-calendar3 me-1"></i>Fecha inicio</label>
            <input type="date" name="inicio" class="form-control">
        </div>
        <div class="col-md-4">
            <label><i class="bi bi-calendar3 me-1"></i>Fecha fin</label>
            <input type="date" name="fin" class="form-control">
        </div>
        <div class="col-md-4">
            <button class="btn btn-primary w-100">
                <i class="bi bi-search me-2"></i>Filtrar
            </button>
        </div>
    </form>
</div>

{{-- ===== KPIs ===== --}}
<div class="rpt-kpi-row">
    <div class="rpt-kpi">
        <div class="rpt-kpi-icon orange"><i class="bi bi-cash-stack"></i></div>
        <div>
            <div class="rpt-kpi-label">Ventas Totales</div>
            <div class="rpt-kpi-value">${{ number_format($ventasTotales, 0) }}</div>
        </div>
    </div>
    <div class="rpt-kpi">
        <div class="rpt-kpi-icon blue"><i class="bi bi-bag-check"></i></div>
        <div>
            <div class="rpt-kpi-label">Productos Vendidos</div>
            <div class="rpt-kpi-value">{{ $cantidadProductos }}</div>
        </div>
    </div>
</div>

{{-- ===== GRID DE GRÁFICAS (2x2) ===== --}}
<div class="rpt-charts-grid">

    {{-- ===================== VENTAS POR TIPO ===================== --}}
    <div class="rpt-chart-card">
        <div class="rpt-chart-header">
            <i class="bi bi-pie-chart-fill"></i>
            <span class="rpt-chart-title">Ventas por Tipo</span>
        </div>
        <div class="rpt-chart-body">
            {{-- Datos originales (sin tocar) --}}
            <div class="rpt-data-list">
                @foreach($ventasPorTipo as $v)
                    <p>{{ $v->tipo }}: ${{ number_format($v->total, 0) }}</p>
                @endforeach
            </div>
            {{-- Gráfica de dona --}}
            <div class="d-flex justify-content-center mt-3">
                <canvas id="chartTipo" style="max-width:300px; max-height:300px;"></canvas>
            </div>
        </div>
    </div>

    {{-- ===================== CLIENTES MOSTRADOR VS REGISTRADOS ===================== --}}
    <div class="rpt-chart-card">
        <div class="rpt-chart-header">
            <i class="bi bi-people-fill"></i>
            <span class="rpt-chart-title">Ventas por Cliente (%)</span>
        </div>
        <div class="rpt-chart-body">
            {{-- Datos originales (sin tocar) --}}
            <div class="rpt-data-list">
                @foreach($porcentajesClientes as $v)
                    <p>
                        {{ $v->es_mostrador ? 'Mostrador' : 'Registrados' }}:
                        {{ $v->porcentaje }}%
                    </p>
                @endforeach
            </div>
            {{-- Gráfica de pie --}}
            <div class="d-flex justify-content-center mt-3">
                <canvas id="chartClientes" style="max-width:300px; max-height:300px;"></canvas>
            </div>
        </div>
    </div>

    {{-- ===================== VENTAS POR CIUDAD ===================== --}}
    <div class="rpt-chart-card">
        <div class="rpt-chart-header">
            <i class="bi bi-geo-alt-fill"></i>
            <span class="rpt-chart-title">Ventas por Ciudad</span>
        </div>
        <div class="rpt-chart-body">
            {{-- Datos originales (sin tocar) --}}
            <div class="rpt-data-list">
                @foreach($ventasCiudad as $v)
                    <p>{{ $v->ciudad }}: ${{ number_format($v->total, 0) }}</p>
                @endforeach
            </div>
            {{-- Gráfica de barras horizontales --}}
            <div class="mt-3">
                <canvas id="chartCiudad" style="max-height:300px;"></canvas>
            </div>
        </div>
    </div>

    {{-- ===================== TOP PRODUCTOS ===================== --}}
    <div class="rpt-chart-card">
        <div class="rpt-chart-header">
            <i class="bi bi-trophy-fill"></i>
            <span class="rpt-chart-title">Top Productos</span>
        </div>
        <div class="rpt-chart-body">
            {{-- Datos originales (sin tocar) --}}
            <div class="rpt-data-list">
                @foreach($topProductos as $p)
                    <p>{{ $p->nombre }} ({{ $p->total }})</p>
                @endforeach
            </div>
            {{-- Gráfica de barras verticales --}}
            <div class="mt-3">
                <canvas id="chartTopProductos" style="max-height:300px;"></canvas>
            </div>
        </div>
    </div>

</div>{{-- fin rpt-charts-grid --}}

{{-- ===================== CHART.JS ===================== --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

<script>
    // Paleta de colores
    const colores = [
        '#f97316', '#0ea5e9', '#22c55e', '#a855f7',
        '#ef4444', '#eab308', '#14b8a6', '#ec4899'
    ];

    // ---- 1. Ventas por Tipo (dona) ----
    const dataTipo = {
        labels: [
            @foreach($ventasPorTipo as $v)
                "{{ $v->tipo }}",
            @endforeach
        ],
        datasets: [{
            data: [
                @foreach($ventasPorTipo as $v)
                    {{ $v->total }},
                @endforeach
            ],
            backgroundColor: colores,
        }]
    };
    new Chart(document.getElementById('chartTipo'), {
        type: 'doughnut',
        data: dataTipo,
        options: {
            plugins: { legend: { position: 'bottom' } },
            responsive: true,
        }
    });

    // ---- 2. Clientes Mostrador vs Registrados (pie) ----
    const dataClientes = {
        labels: [
            @foreach($porcentajesClientes as $v)
                "{{ $v->es_mostrador ? 'Mostrador' : 'Registrados' }}",
            @endforeach
        ],
        datasets: [{
            data: [
                @foreach($porcentajesClientes as $v)
                    {{ $v->porcentaje }},
                @endforeach
            ],
            backgroundColor: ['#f97316', '#0ea5e9'],
        }]
    };
    new Chart(document.getElementById('chartClientes'), {
        type: 'pie',
        data: dataClientes,
        options: {
            plugins: { legend: { position: 'bottom' } },
            responsive: true,
        }
    });

    // ---- 3. Ventas por Ciudad (barras horizontales) ----
    const dataCiudad = {
        labels: [
            @foreach($ventasCiudad as $v)
                "{{ $v->ciudad }}",
            @endforeach
        ],
        datasets: [{
            label: 'Total ($)',
            data: [
                @foreach($ventasCiudad as $v)
                    {{ $v->total }},
                @endforeach
            ],
            backgroundColor: '#0ea5e9',
        }]
    };
    new Chart(document.getElementById('chartCiudad'), {
        type: 'bar',
        data: dataCiudad,
        options: {
            indexAxis: 'y',
            plugins: { legend: { display: false } },
            responsive: true,
        }
    });

    // ---- 4. Top Productos (barras verticales) ----
    const dataTop = {
        labels: [
            @foreach($topProductos as $p)
                "{{ $p->nombre }}",
            @endforeach
        ],
        datasets: [{
            label: 'Unidades vendidas',
            data: [
                @foreach($topProductos as $p)
                    {{ $p->total }},
                @endforeach
            ],
            backgroundColor: colores,
        }]
    };
    new Chart(document.getElementById('chartTopProductos'), {
        type: 'bar',
        data: dataTop,
        options: {
            plugins: { legend: { display: false } },
            responsive: true,
        }
    });
</script>

@endsection