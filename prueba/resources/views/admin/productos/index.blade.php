@extends('admin.layout')

@section('title', 'Productos')

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
    position: absolute;
    right: -60px; top: -60px;
    width: 300px; height: 300px;
    border-radius: 50%;
    background: rgba(255,255,255,.06);
    pointer-events: none;
}

.hero::after {
    content: '';
    position: absolute;
    right: 140px; bottom: -90px;
    width: 200px; height: 200px;
    border-radius: 50%;
    background: rgba(255,255,255,.04);
    pointer-events: none;
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

/* Ilustraciones hero */
.hero-illustrations {
    display: flex; gap: .75rem;
    align-items: center;
    flex-shrink: 0;
    opacity: .92;
}

.hero-illustrations svg {
    width: 72px; height: 72px;
    filter: drop-shadow(0 4px 12px rgba(0,0,0,.25));
}

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

.stat-icon.blue  { background: var(--pri-lt);    color: var(--pri); }
.stat-icon.green { background: var(--success-lt); color: var(--success); }
.stat-icon.red   { background: var(--danger-lt);  color: var(--danger); }

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
    background: var(--white); width: 260px;
}

/* ── Tabla ── */
.t-wrap { overflow-x: auto; }

table.productos { width: 100%; border-collapse: collapse; font-size: .88rem; }

table.productos thead th {
    padding: .75rem 1.2rem;
    font-size: .72rem; font-weight: 700;
    text-transform: uppercase; letter-spacing: .07em;
    color: var(--muted); background: var(--bg);
    border-bottom: 1px solid var(--border); white-space: nowrap;
}

table.productos thead th:first-child { padding-left: 1.4rem; }
table.productos thead th:last-child  { padding-right: 1.4rem; }

table.productos tbody tr { border-bottom: 1px solid #f0f2f5; transition: background .15s; }
table.productos tbody tr:last-child { border-bottom: none; }
table.productos tbody tr:hover { background: #f8faff; }
table.productos tbody tr.hidden-row { display: none; }

table.productos tbody td { padding: .85rem 1.2rem; vertical-align: middle; color: var(--text); }
table.productos tbody td:first-child { padding-left: 1.4rem; }
table.productos tbody td:last-child  { padding-right: 1.4rem; }

/* ID */
.td-id {
    font-size: .8rem; font-weight: 700; color: var(--muted);
    font-variant-numeric: tabular-nums;
    background: var(--bg); border-radius: 6px;
    padding: .2rem .55rem; display: inline-block;
}

/* Producto con SVG */
.prod-cell { display: flex; align-items: center; gap: .85rem; }

.prod-thumb {
    width: 52px; height: 52px;
    border-radius: var(--radius-sm);
    border: 2px solid var(--border);
    flex-shrink: 0; overflow: hidden;
    display: flex; align-items: center; justify-content: center;
}

.prod-thumb svg { width: 52px; height: 52px; }

.prod-name { font-weight: 700; font-size: .9rem; color: var(--text); }

/* Tipo */
.chip-tipo {
    display: inline-flex; align-items: center; gap: .3rem;
    padding: .3rem .8rem; border-radius: 50px;
    font-size: .76rem; font-weight: 700;
    background: var(--pri-lt); color: var(--pri-dk);
    border: 1px solid rgba(13,110,253,.15); white-space: nowrap;
}

/* Precio */
.precio-val { font-size: .95rem; font-weight: 800; color: var(--text); font-variant-numeric: tabular-nums; }

/* Badges */
.badge-on, .badge-off {
    display: inline-flex; align-items: center; gap: .4rem;
    padding: .28rem .8rem; border-radius: 50px;
    font-size: .76rem; font-weight: 700;
}
.badge-on  { background: var(--success-lt); color: var(--success); border: 1px solid rgba(25,135,84,.2); }
.badge-off { background: var(--danger-lt);  color: var(--danger-dk); border: 1px solid rgba(220,53,69,.18); }
.badge-dot { width: 7px; height: 7px; border-radius: 50%; flex-shrink: 0; }
.badge-on  .badge-dot { background: var(--success); animation: blink 2s ease-in-out infinite; }
.badge-off .badge-dot { background: var(--danger); }

@keyframes blink { 0%,100%{opacity:1} 50%{opacity:.35} }

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
    .hero-illustrations { display: none; }
    .search-box, .search-box input { width: 100%; }
    .toolbar { flex-direction: column; align-items: flex-start; }
    .btn-edit span, .btn-del span { display: none; }
    .btn-edit, .btn-del { padding: .42rem .65rem; }
}
</style>

{{-- ════ SVGs reutilizables ════ --}}
{{-- Empanada frita colombiana: media luna dorada con textura y vaporcito --}}
@php
$svg_empanada = '<svg viewBox="0 0 52 52" xmlns="http://www.w3.org/2000/svg">
  <!-- Fondo cálido tipo plato -->
  <rect width="52" height="52" fill="#FFF8F0"/>
  <!-- Sombra suave -->
  <ellipse cx="26" cy="40" rx="17" ry="4" fill="#E8A06020"/>
  <!-- Cuerpo de la empanada (media luna dorada) -->
  <path d="M8 30 Q8 14 26 14 Q44 14 44 30 Q44 38 26 38 Q8 38 8 30Z" fill="#F5C842"/>
  <!-- Tono oscuro del borde inferior -->
  <path d="M8 30 Q8 38 26 38 Q44 38 44 30" fill="#E8A020" opacity=".55"/>
  <!-- Borde tostado superior (costra) -->
  <path d="M9 28 Q9 15 26 15 Q43 15 43 28" fill="none" stroke="#C8780A" stroke-width="2" stroke-linecap="round"/>
  <!-- Textura de repulgue (puntos del borde) -->
  <path d="M9.5 27 Q11 18 18 14.5" fill="none" stroke="#C8780A" stroke-width="1.2" stroke-linecap="round" stroke-dasharray="2 2.5"/>
  <path d="M42.5 27 Q41 18 34 14.5" fill="none" stroke="#C8780A" stroke-width="1.2" stroke-linecap="round" stroke-dasharray="2 2.5"/>
  <!-- Brillo superior -->
  <ellipse cx="19" cy="20" rx="5" ry="2.5" fill="#FFF0A0" opacity=".6" transform="rotate(-20,19,20)"/>
  <!-- Vapor (líneas onduladas) -->
  <path d="M20 11 Q21 8 20 5" fill="none" stroke="#CCCCCC" stroke-width="1.2" stroke-linecap="round" opacity=".7"/>
  <path d="M26 10 Q27.5 7 26 4" fill="none" stroke="#CCCCCC" stroke-width="1.2" stroke-linecap="round" opacity=".7"/>
  <path d="M32 11 Q33 8 32 5" fill="none" stroke="#CCCCCC" stroke-width="1.2" stroke-linecap="round" opacity=".7"/>
</svg>';

$svg_papa = '<svg viewBox="0 0 52 52" xmlns="http://www.w3.org/2000/svg">
  <!-- Fondo cálido -->
  <rect width="52" height="52" fill="#FFF8F0"/>
  <!-- Sombra -->
  <ellipse cx="26" cy="41" rx="14" ry="3.5" fill="#B06A2020"/>
  <!-- Cuerpo redondo de la papa rellena -->
  <circle cx="26" cy="27" r="15" fill="#D4A240"/>
  <!-- Tono oscuro parte baja (frita) -->
  <path d="M12 31 Q12 42 26 42 Q40 42 40 31" fill="#A86820" opacity=".5"/>
  <!-- Costra crujiente (textura exterior) -->
  <circle cx="26" cy="27" r="15" fill="none" stroke="#8B5010" stroke-width="1.5" opacity=".4"/>
  <!-- Manchas de fritura dorada -->
  <ellipse cx="20" cy="22" rx="3.5" ry="2" fill="#E8B840" opacity=".5" transform="rotate(-15,20,22)"/>
  <ellipse cx="31" cy="25" rx="2.5" ry="1.5" fill="#E8B840" opacity=".4" transform="rotate(10,31,25)"/>
  <ellipse cx="23" cy="31" rx="2" ry="1.2" fill="#C07820" opacity=".35"/>
  <!-- Abertura / relleno visible (hendidura dorada) -->
  <path d="M19 26 Q26 22 33 26" fill="none" stroke="#7A3D08" stroke-width="1.8" stroke-linecap="round"/>
  <path d="M20 27.5 Q26 24 32 27.5" fill="#E85C20" opacity=".6"/>
  <!-- Brillo superior -->
  <ellipse cx="20" cy="20" rx="4" ry="2" fill="#F8E080" opacity=".55" transform="rotate(-25,20,20)"/>
  <!-- Vapor -->
  <path d="M21 10 Q22 7 21 4" fill="none" stroke="#CCCCCC" stroke-width="1.2" stroke-linecap="round" opacity=".7"/>
  <path d="M26 9 Q27.5 6 26 3" fill="none" stroke="#CCCCCC" stroke-width="1.2" stroke-linecap="round" opacity=".7"/>
  <path d="M31 10 Q32 7 31 4" fill="none" stroke="#CCCCCC" stroke-width="1.2" stroke-linecap="round" opacity=".7"/>
</svg>';

$svg_default = '<svg viewBox="0 0 52 52" xmlns="http://www.w3.org/2000/svg">
  <rect width="52" height="52" fill="#F0F4FF"/>
  <text x="26" y="32" text-anchor="middle" font-size="24">🍽️</text>
</svg>';
@endphp

{{-- ════════════════════ HERO ════════════════════ --}}
<div class="hero mb-4">
    <div class="hero-content">
        <h1><i class="bi bi-box-seam me-2" style="font-size:1.4rem;"></i>Gestión de Productos</h1>
        <p class="hero-sub">Administra tu catálogo de empanadas y papas rellenas</p>
        <div class="hero-chips">
            <span class="hero-chip"><span class="dot" style="background:#fff;"></span>{{ $productos->count() }} en total</span>
            <span class="hero-chip"><span class="dot" style="background:#6ee7b7;"></span>{{ $productos->where('estado', true)->count() }} activos</span>
            <span class="hero-chip"><span class="dot" style="background:#fca5a5;"></span>{{ $productos->where('estado', false)->count() }} inactivos</span>
        </div>
    </div>

    {{-- Ilustraciones en el hero --}}
    <div class="hero-illustrations">
        {!! $svg_empanada !!}
        {!! $svg_papa !!}
    </div>

    <a href="/admin/productos/create" class="btn-hero-new">
        <i class="bi bi-plus-circle-fill"></i>
        Nuevo Producto
    </a>
</div>

{{-- ════════════════════ STATS ════════════════════ --}}
<div class="stats-grid mb-4">
    <div class="stat-card">
        <div class="stat-icon blue"><i class="bi bi-box-seam"></i></div>
        <div>
            <div class="stat-val">{{ $productos->count() }}</div>
            <div class="stat-label">Total productos</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon green"><i class="bi bi-check-circle"></i></div>
        <div>
            <div class="stat-val">{{ $productos->where('estado', true)->count() }}</div>
            <div class="stat-label">Activos</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon red"><i class="bi bi-x-circle"></i></div>
        <div>
            <div class="stat-val">{{ $productos->where('estado', false)->count() }}</div>
            <div class="stat-label">Inactivos</div>
        </div>
    </div>
</div>

{{-- ════════════════════ TABLA ════════════════════ --}}
<div class="table-card">
    <div class="toolbar">
        <div class="toolbar-title">
            <i class="bi bi-list-ul"></i>
            Lista de Productos
        </div>
        <div class="search-box">
            <i class="bi bi-search"></i>
            <input type="text" id="buscar" placeholder="Buscar por nombre o tipo…" autocomplete="off">
        </div>
    </div>

    <div class="t-wrap">
        @if($productos->isEmpty())
            <div class="empty">
                <div class="empty-icon">🍽️</div>
                <h5>Sin productos aún</h5>
                <p>Agrega tu primer producto para comenzar a vender.</p>
                <a href="/admin/productos/create" class="btn-hero-new d-inline-flex mt-2" style="background:var(--pri);color:#fff;">
                    <i class="bi bi-plus-circle-fill"></i> Agregar producto
                </a>
            </div>
        @else
            <table class="productos" id="tbl">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Producto</th>
                        <th>Tipo</th>
                        <th>Precio</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($productos as $p)
                    @php
                        $n = strtolower($p->nombre ?? '');
                        $t = strtolower($p->tipo   ?? '');
                        $esEmpanada = str_contains($n,'empanada') || str_contains($t,'empanada');
                        $esPapa     = str_contains($n,'papa')     || str_contains($t,'papa');

                        if ($esEmpanada)     $thumb = $svg_empanada;
                        elseif ($esPapa)     $thumb = $svg_papa;
                        else                 $thumb = $svg_default;
                    @endphp
                    <tr data-search="{{ strtolower($p->nombre . ' ' . $p->tipo) }}">

                        <td><span class="td-id">{{ $p->id }}</span></td>

                        <td>
                            <div class="prod-cell">
                                <div class="prod-thumb">{!! $thumb !!}</div>
                                <span class="prod-name">{{ $p->nombre }}</span>
                            </div>
                        </td>

                        <td>
                            <span class="chip-tipo">
                                <i class="bi bi-tag-fill" style="font-size:.7rem;"></i>
                                {{ $p->tipo }}
                            </span>
                        </td>

                        <td><span class="precio-val">${{ number_format($p->precio, 0, ',', '.') }}</span></td>

                        <td>
                            @if($p->estado)
                                <span class="badge-on"><span class="badge-dot"></span> Activo</span>
                            @else
                                <span class="badge-off"><span class="badge-dot"></span> Inactivo</span>
                            @endif
                        </td>

                        <td>
                            <div class="actions">
                                <a href="/admin/productos/{{ $p->id }}/edit" class="btn-edit">
                                    <i class="bi bi-pencil-fill"></i>
                                    <span>Editar</span>
                                </a>
                                <form method="POST" action="/admin/productos/{{ $p->id }}" style="display:inline;"
                                      onsubmit="return confirm('¿Eliminar «{{ $p->nombre }}»?\nEsta acción no se puede deshacer.')">
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