@extends('admin.layout')

@section('title', 'Clientes')

@section('content')

<style>
:root {
    --pri:       #0d6efd;
    --pri-dk:    #0a58ca;
    --pri-lt:    #e8f0fe;
    --warn:      #ffc107;
    --warn-dk:   #cc9900;
    --warn-lt:   #fff8e1;
    --danger:    #dc3545;
    --danger-dk: #b02a37;
    --danger-lt: #fff0f1;
    --success:   #198754;
    --success-lt:#d1e7dd;
    --muted:     #6c757d;
    --border:    #e2e6ea;
    --bg:        #f4f6fb;
    --white:     #ffffff;
    --text:      #1a1d23;
    --radius:    12px;
    --radius-sm: 8px;
    --trans:     all .2s cubic-bezier(.4,0,.2,1);
}

.pg { background: var(--bg); min-height: 100vh; padding: 0 0 3rem; }

/* ── HERO ── */
.hero {
    position: relative;
    overflow: hidden;
    border-radius: var(--radius);
    padding: 2rem;
    margin-bottom: 1.75rem;
    background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 60%, #053998 100%);
    display: flex;
    align-items: center;
    gap: 1.5rem;
    min-height: 160px;
}

.hero::before {
    content: '';
    position: absolute; right: -60px; top: -60px;
    width: 300px; height: 300px; border-radius: 50%;
    background: rgba(255,255,255,.06); pointer-events: none;
}

.hero::after {
    content: '';
    position: absolute; right: 140px; bottom: -90px;
    width: 200px; height: 200px; border-radius: 50%;
    background: rgba(255,255,255,.04); pointer-events: none;
}

.hero-content { flex: 1; }

.hero h1 {
    font-size: 1.75rem; font-weight: 800;
    color: #fff; margin: 0 0 .25rem;
    letter-spacing: -.02em;
}

.hero-sub { color: rgba(255,255,255,.78); font-size: .88rem; font-weight: 500; margin: 0; }

.hero-chips { display: flex; gap: .5rem; margin-top: .75rem; flex-wrap: wrap; }

.hero-chip {
    display: inline-flex; align-items: center; gap: .35rem;
    background: rgba(255,255,255,.15);
    border: 1px solid rgba(255,255,255,.28);
    border-radius: 50px; padding: .22rem .72rem;
    font-size: .75rem; font-weight: 600; color: #fff;
}

.hero-chip .dot { width: 7px; height: 7px; border-radius: 50%; }

/* Ilustración clientes en el hero */
.hero-illustration { flex-shrink: 0; opacity: .92; }
.hero-illustration svg { width: 110px; height: 110px; filter: drop-shadow(0 4px 14px rgba(0,0,0,.22)); }

.btn-hero-new {
    display: inline-flex; align-items: center; gap: .5rem;
    background: #fff; color: var(--pri);
    font-weight: 700; font-size: .88rem;
    padding: .65rem 1.4rem; border-radius: 50px;
    border: none; text-decoration: none;
    box-shadow: 0 4px 18px rgba(0,0,0,.2);
    transition: var(--trans); white-space: nowrap; flex-shrink: 0;
}

.btn-hero-new:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 26px rgba(0,0,0,.24);
    color: var(--pri-dk);
}

/* ── STATS ── */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1rem; margin-bottom: 1.75rem;
}

.stat-card {
    background: var(--white); border: 1px solid var(--border);
    border-radius: var(--radius); padding: 1.1rem 1.25rem;
    display: flex; align-items: center; gap: 1rem;
    transition: var(--trans);
}

.stat-card:hover { box-shadow: 0 4px 18px rgba(13,110,253,.1); transform: translateY(-2px); }

.stat-icon {
    width: 44px; height: 44px; border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.25rem; flex-shrink: 0;
}

.stat-icon.blue   { background: var(--pri-lt);    color: var(--pri); }
.stat-icon.green  { background: var(--success-lt); color: var(--success); }
.stat-icon.purple { background: #ede9fe;           color: #6d28d9; }

.stat-val   { font-size: 1.6rem; font-weight: 800; color: var(--text); line-height: 1; margin-bottom: .2rem; }
.stat-label { font-size: .78rem; font-weight: 600; color: var(--muted); text-transform: uppercase; letter-spacing: .05em; }

/* ── TABLA CARD ── */
.table-card { background: var(--white); border: 1px solid var(--border); border-radius: var(--radius); overflow: hidden; }

.toolbar {
    display: flex; align-items: center; justify-content: space-between;
    flex-wrap: wrap; gap: .75rem;
    padding: 1rem 1.4rem; border-bottom: 1px solid var(--border);
}

.toolbar-title { font-size: .95rem; font-weight: 700; color: var(--text); display: flex; align-items: center; gap: .5rem; }
.toolbar-title i { color: var(--pri); }

.search-box { position: relative; display: flex; align-items: center; }
.search-box i { position: absolute; left: .85rem; font-size: .88rem; color: var(--muted); pointer-events: none; }
.search-box input {
    border: 1px solid var(--border); border-radius: 50px;
    padding: .42rem 1rem .42rem 2.25rem; font-size: .85rem;
    width: 230px; color: var(--text); background: var(--bg);
    outline: none; transition: var(--trans);
}
.search-box input:focus {
    border-color: var(--pri);
    box-shadow: 0 0 0 3px rgba(13,110,253,.12);
    background: var(--white); width: 270px;
}

/* ── Tabla ── */
.t-wrap { overflow-x: auto; }

table.clientes { width: 100%; border-collapse: collapse; font-size: .88rem; }

table.clientes thead th {
    padding: .75rem 1rem;
    font-size: .72rem; font-weight: 700;
    text-transform: uppercase; letter-spacing: .07em;
    color: var(--muted); background: var(--bg);
    border-bottom: 1px solid var(--border); white-space: nowrap;
}

table.clientes thead th:first-child { padding-left: 1.4rem; }
table.clientes thead th:last-child  { padding-right: 1.4rem; }

table.clientes tbody tr { border-bottom: 1px solid #f0f2f5; transition: background .15s; }
table.clientes tbody tr:last-child { border-bottom: none; }
table.clientes tbody tr:hover { background: #f8faff; }
table.clientes tbody tr.hidden-row { display: none; }

table.clientes tbody td { padding: .85rem 1rem; vertical-align: middle; color: var(--text); }
table.clientes tbody td:first-child { padding-left: 1.4rem; }
table.clientes tbody td:last-child  { padding-right: 1.4rem; }

/* ID */
.td-id {
    font-size: .8rem; font-weight: 700; color: var(--muted);
    font-variant-numeric: tabular-nums;
    background: var(--bg); border-radius: 6px;
    padding: .2rem .55rem; display: inline-block;
}

/* Avatar + nombre */
.cliente-cell { display: flex; align-items: center; gap: .75rem; }

.avatar {
    width: 38px; height: 38px; border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: .85rem; font-weight: 800; color: #fff;
    flex-shrink: 0; letter-spacing: -.01em;
}

.cliente-name  { font-weight: 700; font-size: .9rem; color: var(--text); }
.cliente-doc   { font-size: .75rem; color: var(--muted); margin-top: 1px; }

/* Chip tipo documento */
.chip-doc {
    display: inline-flex; align-items: center;
    padding: .25rem .65rem; border-radius: 50px;
    font-size: .73rem; font-weight: 700;
    background: var(--pri-lt); color: var(--pri-dk);
    border: 1px solid rgba(13,110,253,.15); white-space: nowrap;
}

/* Teléfono / ciudad / dirección */
.td-ciudad {
    display: inline-flex; align-items: center; gap: .3rem;
    font-size: .85rem; color: var(--text2);
}

.td-tel {
    display: inline-flex; align-items: center; gap: .3rem;
    font-size: .85rem; font-variant-numeric: tabular-nums;
    color: var(--text);
}

.td-dir { font-size: .82rem; color: var(--muted); max-width: 160px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }

/* Botones */
.actions { display: flex; align-items: center; gap: .45rem; }

.btn-edit, .btn-del {
    display: inline-flex; align-items: center; justify-content: center;
    gap: .35rem; padding: .42rem .9rem;
    border-radius: 50px; border: 1.5px solid;
    font-size: .78rem; font-weight: 700;
    cursor: pointer; text-decoration: none; transition: var(--trans); white-space: nowrap;
}

.btn-edit { background: var(--warn-lt); color: var(--warn-dk); border-color: var(--warn); }
.btn-edit:hover { background: var(--warn); color: #fff; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(255,193,7,.35); }

.btn-del { background: var(--danger-lt); color: var(--danger); border-color: rgba(220,53,69,.4); }
.btn-del:hover { background: var(--danger); color: #fff; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(220,53,69,.3); }

/* Empty */
.empty { padding: 4rem 2rem; text-align: center; }
.empty-icon { width: 72px; height: 72px; background: var(--pri-lt); border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; font-size: 2rem; margin-bottom: 1.25rem; }
.empty h5 { font-weight: 800; color: var(--text); margin-bottom: .4rem; }
.empty p  { color: var(--muted); font-size: .88rem; }

@media (max-width: 600px) {
    .stats-grid { grid-template-columns: 1fr; }
    .hero { flex-direction: column; align-items: flex-start; }
    .hero-illustration { display: none; }
    .search-box, .search-box input { width: 100%; }
    .toolbar { flex-direction: column; align-items: flex-start; }
    .btn-edit span, .btn-del span { display: none; }
    .btn-edit, .btn-del { padding: .42rem .65rem; }
    .td-dir { max-width: 100px; }
}
</style>

@php
/* ─── Ilustración SVG de grupo de clientes para el hero ─── */
$svg_clientes = '<svg viewBox="0 0 110 110" xmlns="http://www.w3.org/2000/svg">
  <!-- Cliente central -->
  <circle cx="55" cy="32" r="16" fill="#BFDBFE"/>
  <circle cx="55" cy="32" r="16" fill="none" stroke="#fff" stroke-width="2" opacity=".6"/>
  <!-- cara central -->
  <circle cx="50" cy="29" r="2" fill="#1e40af"/>
  <circle cx="60" cy="29" r="2" fill="#1e40af"/>
  <path d="M49 36 Q55 41 61 36" fill="none" stroke="#1e40af" stroke-width="1.8" stroke-linecap="round"/>
  <!-- cuerpo central -->
  <path d="M37 72 Q37 55 55 55 Q73 55 73 72" fill="#93C5FD"/>
  <path d="M37 72 Q37 55 55 55 Q73 55 73 72" fill="none" stroke="#fff" stroke-width="1.5" opacity=".5"/>

  <!-- Cliente izquierda -->
  <circle cx="22" cy="42" r="12" fill="#BFDBFE" opacity=".85"/>
  <circle cx="18" cy="39.5" r="1.5" fill="#1e40af"/>
  <circle cx="26" cy="39.5" r="1.5" fill="#1e40af"/>
  <path d="M17 45 Q22 49 27 45" fill="none" stroke="#1e40af" stroke-width="1.5" stroke-linecap="round"/>
  <path d="M8 75 Q8 62 22 62 Q36 62 36 75" fill="#93C5FD" opacity=".7"/>

  <!-- Cliente derecha -->
  <circle cx="88" cy="42" r="12" fill="#BFDBFE" opacity=".85"/>
  <circle cx="84" cy="39.5" r="1.5" fill="#1e40af"/>
  <circle cx="92" cy="39.5" r="1.5" fill="#1e40af"/>
  <path d="M83 45 Q88 49 93 45" fill="none" stroke="#1e40af" stroke-width="1.5" stroke-linecap="round"/>
  <path d="M74 75 Q74 62 88 62 Q102 62 102 75" fill="#93C5FD" opacity=".7"/>

  <!-- Estrella / check de fidelidad -->
  <circle cx="55" cy="88" r="10" fill="#FCD34D"/>
  <text x="55" y="92.5" text-anchor="middle" font-size="12" fill="#92400e">★</text>
</svg>';

/* ─── Paleta de colores para avatares ─── */
$colores = ['#4f46e5','#0891b2','#059669','#d97706','#dc2626','#7c3aed','#db2777','#0d6efd'];

/* ─── Ciudades únicas ─── */
$ciudades = $clientes->pluck('ciudad')->filter()->unique()->count();
@endphp

{{-- ════════════════════ HERO ════════════════════ --}}
<div class="hero mb-4">
    <div class="hero-content">
        <h1><i class="bi bi-people me-2" style="font-size:1.4rem;"></i>Gestión de Clientes</h1>
        <p class="hero-sub">Base de clientes registrados en el sistema</p>
        <div class="hero-chips">
            <span class="hero-chip">
                <span class="dot" style="background:#fff;"></span>
                {{ $clientes->count() }} clientes
            </span>
            @if($ciudades > 0)
            <span class="hero-chip">
                <span class="dot" style="background:#6ee7b7;"></span>
                {{ $ciudades }} {{ $ciudades == 1 ? 'ciudad' : 'ciudades' }}
            </span>
            @endif
        </div>
    </div>

    <div class="hero-illustration">
        {!! $svg_clientes !!}
    </div>

    <a href="{{ route('clientes.create') }}" class="btn-hero-new">
        <i class="bi bi-person-plus-fill"></i>
        Nuevo Cliente
    </a>
</div>

{{-- ════════════════════ STATS ════════════════════ --}}
<div class="stats-grid mb-4">
    <div class="stat-card">
        <div class="stat-icon blue"><i class="bi bi-people"></i></div>
        <div>
            <div class="stat-val">{{ $clientes->count() }}</div>
            <div class="stat-label">Total clientes</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon green"><i class="bi bi-geo-alt"></i></div>
        <div>
            <div class="stat-val">{{ $ciudades ?: '—' }}</div>
            <div class="stat-label">Ciudades</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon purple"><i class="bi bi-person-vcard"></i></div>
        <div>
            <div class="stat-val">{{ $clientes->pluck('tipo_documento')->filter()->unique()->count() ?: '—' }}</div>
            <div class="stat-label">Tipos de doc.</div>
        </div>
    </div>
</div>

{{-- ════════════════════ TABLA ════════════════════ --}}
<div class="table-card">
    <div class="toolbar">
        <div class="toolbar-title">
            <i class="bi bi-list-ul"></i>
            Lista de Clientes
        </div>
        <div class="search-box">
            <i class="bi bi-search"></i>
            <input type="text" id="buscar" placeholder="Buscar nombre, documento, ciudad…" autocomplete="off">
        </div>
    </div>

    <div class="t-wrap">
        @if($clientes->isEmpty())
            <div class="empty">
                <div class="empty-icon"><i class="bi bi-people"></i></div>
                <h5>Sin clientes registrados</h5>
                <p>Agrega tu primer cliente para comenzar.</p>
                <a href="{{ route('clientes.create') }}" class="btn-hero-new d-inline-flex mt-2" style="background:var(--pri);color:#fff;">
                    <i class="bi bi-person-plus-fill"></i> Agregar cliente
                </a>
            </div>
        @else
            <table class="clientes" id="tbl">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Cliente</th>
                        <th>Documento</th>
                        <th>Ciudad</th>
                        <th>Dirección</th>
                        <th>Teléfono</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($clientes as $i => $cliente)
                    @php
                        /* Iniciales del nombre */
                        $partes   = explode(' ', trim($cliente->nombre ?? ''));
                        $iniciales = strtoupper(substr($partes[0] ?? '?', 0, 1) . substr($partes[1] ?? '', 0, 1));
                        $color    = $colores[$i % count($colores)];

                        $searchVal = strtolower(
                            ($cliente->nombre           ?? '') . ' ' .
                            ($cliente->numero_documento ?? '') . ' ' .
                            ($cliente->ciudad           ?? '') . ' ' .
                            ($cliente->tipo_documento   ?? '')
                        );
                    @endphp
                    <tr data-search="{{ $searchVal }}">

                        {{-- ID --}}
                        <td><span class="td-id">{{ $cliente->id }}</span></td>

                        {{-- Cliente (avatar + nombre + doc) --}}
                        <td>
                            <div class="cliente-cell">
                                <div class="avatar" style="background:{{ $color }};">{{ $iniciales }}</div>
                                <div>
                                    <div class="cliente-name">{{ $cliente->nombre }}</div>
                                    <div class="cliente-doc">{{ $cliente->numero_documento }}</div>
                                </div>
                            </div>
                        </td>

                        {{-- Tipo documento --}}
                        <td>
                            <span class="chip-doc">{{ $cliente->tipo_documento }}</span>
                        </td>

                        {{-- Ciudad --}}
                        <td>
                            <span class="td-ciudad">
                                <i class="bi bi-geo-alt" style="color:var(--pri);font-size:.8rem;"></i>
                                {{ $cliente->ciudad ?? '—' }}
                            </span>
                        </td>

                        {{-- Dirección --}}
                        <td>
                            <span class="td-dir" title="{{ $cliente->direccion }}">
                                {{ $cliente->direccion ?? '—' }}
                            </span>
                        </td>

                        {{-- Teléfono --}}
                        <td>
                            <span class="td-tel">
                                <i class="bi bi-telephone" style="color:var(--muted);font-size:.8rem;"></i>
                                {{ $cliente->telefono ?? '—' }}
                            </span>
                        </td>

                        {{-- Acciones --}}
                        <td>
                            <div class="actions">
                                <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn-edit">
                                    <i class="bi bi-pencil-fill"></i>
                                    <span>Editar</span>
                                </a>
                                <form method="POST"
                                      action="{{ route('clientes.destroy', $cliente->id) }}"
                                      style="display:inline;"
                                      onsubmit="return confirm('¿Eliminar a {{ addslashes($cliente->nombre) }}?\nEsta acción no se puede deshacer.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-del">
                                        <i class="bi bi-trash-fill"></i>
                                        <span>Eliminar</span>
                                    </button>
                                </form>
                            </div>
                        </td>

                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>

<script>
document.getElementById('buscar')?.addEventListener('input', function () {
    const q = this.value.toLowerCase().trim();
    document.querySelectorAll('#tbl tbody tr').forEach(tr => {
        const ok = !q || (tr.dataset.search ?? '').includes(q);
        tr.classList.toggle('hidden-row', !ok);
    });
});
</script>

@endsection