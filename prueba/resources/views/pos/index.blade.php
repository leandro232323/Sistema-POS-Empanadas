<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POS · Empanadas & Papas</title>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:wght@400;600;700;900&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --brand:       #C8420A;
            --brand-deep:  #9B3108;
            --brand-light: #F26522;
            --gold:        #E8A61A;
            --cream:       #FDF6ED;
            --cream-dark:  #F4E9D8;
            --ink:         #1C120A;
            --ink-mid:     #4A3526;
            --ink-soft:    #8C6F59;
            --surface:     #FFFFFF;
            --border:      #E2D2C0;
            --success:     #3A7D44;
            --error:       #C0392B;
            --radius-sm:   6px;
            --radius-md:   12px;
            --radius-lg:   20px;
            --shadow-sm:   0 1px 4px rgba(28,18,10,.08);
            --shadow-md:   0 4px 16px rgba(28,18,10,.12);
            --shadow-lg:   0 12px 40px rgba(28,18,10,.18);
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--cream);
            color: var(--ink);
            min-height: 100vh;
        }

        /* ── TOPBAR ── */
        .topbar {
            background: var(--ink);
            padding: 0 32px;
            height: 56px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 100;
        }
        .topbar-brand {
            font-family: 'Fraunces', serif;
            font-weight: 900;
            font-size: 1.2rem;
            color: var(--gold);
            letter-spacing: .5px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .topbar-brand span { color: var(--cream); font-weight: 400; font-size: .95rem; }
        .topbar-nav { display: flex; gap: 6px; }
        .topbar-nav a {
            color: rgba(255,255,255,.6);
            text-decoration: none;
            font-size: .82rem;
            font-weight: 500;
            padding: 6px 14px;
            border-radius: 40px;
            transition: all .2s;
            letter-spacing: .3px;
        }
        .topbar-nav a:hover { color: #fff; background: rgba(255,255,255,.1); }
        .topbar-nav a.active { color: var(--gold); background: rgba(232,166,26,.12); }

        /* ── ALERTS ── */
        .alert {
            max-width: 1280px;
            margin: 20px auto 0;
            padding: 0 24px;
        }
        .alert-box {
            padding: 12px 18px;
            border-radius: var(--radius-md);
            font-size: .875rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .alert-success { background: #EDF7EF; color: var(--success); border: 1px solid #B7DFC0; }
        .alert-error   { background: #FDECEA; color: var(--error);   border: 1px solid #F5C6C2; }

        @keyframes alertFadeOut {
            0%   { opacity: 1; transform: translateY(0);    max-height: 80px; margin-bottom: 0; }
            70%  { opacity: 0; transform: translateY(-6px); max-height: 80px; margin-bottom: 0; }
            100% { opacity: 0; transform: translateY(-6px); max-height: 0;    margin-bottom: 0; padding: 0; }
        }
        .alert-box.dismissing {
            overflow: hidden;
            animation: alertFadeOut .4s ease forwards;
        }

        /* ── LAYOUT ── */
        .pos-wrap {
            max-width: 1280px;
            margin: 0 auto;
            padding: 28px 24px 60px;
            display: grid;
            grid-template-columns: 1fr 360px;
            gap: 24px;
            align-items: start;
        }

        /* ── CARD BASE ── */
        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-sm);
            overflow: hidden;
        }
        .card-header {
            padding: 20px 24px 16px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .card-header h2 {
            font-family: 'Fraunces', serif;
            font-weight: 700;
            font-size: 1.1rem;
            color: var(--ink);
        }
        .card-header .icon {
            width: 34px;
            height: 34px;
            border-radius: 8px;
            background: var(--cream-dark);
            display: grid;
            place-items: center;
            font-size: 1rem;
        }
        .card-body { padding: 20px 24px; }

        /* ── SECTION TITLE ── */
        .section-label {
            font-size: .7rem;
            font-weight: 600;
            letter-spacing: 1.2px;
            text-transform: uppercase;
            color: var(--ink-soft);
            margin-bottom: 10px;
        }

        /* ── CLIENT SELECT ── */
        .client-row {
            display: flex;
            gap: 10px;
            align-items: center;
        }
        .select-wrap { flex: 1; position: relative; }
        .select-wrap select {
            width: 100%;
            padding: 10px 36px 10px 14px;
            background: var(--cream);
            border: 1.5px solid var(--border);
            border-radius: var(--radius-md);
            font-family: 'DM Sans', sans-serif;
            font-size: .9rem;
            color: var(--ink);
            appearance: none;
            cursor: pointer;
            transition: border-color .2s;
        }
        .select-wrap select:focus { outline: none; border-color: var(--brand); }
        .select-wrap::after {
            content: '▾';
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--ink-soft);
            pointer-events: none;
            font-size: .8rem;
        }
        .btn-add-client {
            padding: 10px 16px;
            background: var(--cream-dark);
            border: 1.5px solid var(--border);
            border-radius: var(--radius-md);
            font-family: 'DM Sans', sans-serif;
            font-size: .82rem;
            font-weight: 600;
            color: var(--ink-mid);
            cursor: pointer;
            white-space: nowrap;
            transition: all .2s;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .btn-add-client:hover { background: var(--cream-dark); border-color: var(--brand); color: var(--brand); }

        /* ── PRODUCTS GRID ── */
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 12px;
            margin-top: 4px;
        }
        .product-card {
            border: 2px solid var(--border);
            border-radius: var(--radius-md);
            padding: 16px;
            background: var(--cream);
            transition: border-color .2s, box-shadow .2s, background .2s;
            position: relative;
        }
        .product-card.active {
            border-color: var(--brand);
            background: #FFF7F3;
            box-shadow: 0 0 0 3px rgba(200,66,10,.08);
        }
        .product-name {
            font-family: 'Fraunces', serif;
            font-weight: 600;
            font-size: 1rem;
            color: var(--ink);
            margin-bottom: 2px;
        }
        .product-price {
            font-size: .82rem;
            color: var(--ink-soft);
            margin-bottom: 14px;
        }
        .product-price strong { color: var(--brand); font-size: .95rem; }
        .qty-row {
            display: flex;
            align-items: center;
            gap: 0;
            background: var(--surface);
            border: 1.5px solid var(--border);
            border-radius: 8px;
            overflow: hidden;
        }
        .qty-btn {
            width: 32px;
            height: 32px;
            border: none;
            background: transparent;
            cursor: pointer;
            font-size: 1.1rem;
            color: var(--ink-mid);
            transition: background .15s, color .15s;
            display: grid;
            place-items: center;
            line-height: 1;
        }
        .qty-btn:hover { background: var(--cream-dark); color: var(--brand); }
        .qty-input {
            flex: 1;
            border: none;
            text-align: center;
            font-family: 'DM Sans', sans-serif;
            font-size: .95rem;
            font-weight: 600;
            color: var(--ink);
            background: transparent;
            width: 0;
            min-width: 0;
            padding: 0;
        }
        .qty-input:focus { outline: none; }
        /* hide spinners */
        .qty-input::-webkit-outer-spin-button,
        .qty-input::-webkit-inner-spin-button { -webkit-appearance: none; }
        .qty-input[type=number] { -moz-appearance: textfield; }
        .subtotal-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            background: var(--brand);
            color: #fff;
            font-size: .72rem;
            font-weight: 600;
            padding: 2px 8px;
            border-radius: 20px;
            opacity: 0;
            transition: opacity .2s;
        }
        .product-card.active .subtotal-badge { opacity: 1; }

        /* ── RIGHT PANEL ── */
        .panel-sticky { position: sticky; top: 76px; }

        /* order summary */
        .order-list { list-style: none; }
        .order-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 0;
            border-bottom: 1px dashed var(--border);
            font-size: .875rem;
        }
        .order-item:last-child { border-bottom: none; }
        .order-item-name { color: var(--ink-mid); }
        .order-item-val  { font-weight: 600; color: var(--ink); }
        .order-empty {
            text-align: center;
            padding: 24px 0;
            color: var(--ink-soft);
            font-size: .875rem;
        }
        .order-empty span { font-size: 1.8rem; display: block; margin-bottom: 8px; }

        /* total */
        .total-row {
            display: flex;
            justify-content: space-between;
            align-items: baseline;
            padding: 18px 24px;
            border-top: 2px solid var(--border);
            background: var(--cream);
        }
        .total-label {
            font-family: 'Fraunces', serif;
            font-size: 1rem;
            font-weight: 700;
            color: var(--ink-soft);
        }
        .total-amount {
            font-family: 'Fraunces', serif;
            font-size: 1.6rem;
            font-weight: 900;
            color: var(--brand);
        }

        /* sell button */
        .btn-sell {
            display: block;
            width: calc(100% - 48px);
            margin: 16px 24px 20px;
            padding: 14px;
            background: var(--brand);
            color: #fff;
            border: none;
            border-radius: var(--radius-md);
            font-family: 'Fraunces', serif;
            font-size: 1.05rem;
            font-weight: 700;
            cursor: pointer;
            letter-spacing: .4px;
            transition: background .2s, transform .12s, box-shadow .2s;
            box-shadow: 0 4px 14px rgba(200,66,10,.35);
        }
        .btn-sell:hover { background: var(--brand-deep); box-shadow: 0 6px 20px rgba(200,66,10,.45); transform: translateY(-1px); }
        .btn-sell:active { transform: translateY(0); }

        /* ── MODAL OVERLAY ── */
        .modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(28,18,10,.55);
            backdrop-filter: blur(3px);
            z-index: 200;
            align-items: center;
            justify-content: center;
        }
        .modal-overlay.open { display: flex; }
        .modal {
            background: var(--surface);
            border-radius: var(--radius-lg);
            width: 100%;
            max-width: 480px;
            margin: 20px;
            box-shadow: var(--shadow-lg);
            overflow: hidden;
        }
        .modal-head {
            background: var(--ink);
            padding: 20px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .modal-head h3 {
            font-family: 'Fraunces', serif;
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--gold);
        }
        .modal-close {
            background: rgba(255,255,255,.12);
            border: none;
            color: #fff;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            cursor: pointer;
            font-size: 1rem;
            display: grid;
            place-items: center;
            transition: background .2s;
        }
        .modal-close:hover { background: rgba(255,255,255,.22); }
        .modal-body { padding: 24px; }

        /* ── FORM FIELDS ── */
        .form-group { margin-bottom: 16px; }
        .form-label {
            display: block;
            font-size: .75rem;
            font-weight: 600;
            letter-spacing: .8px;
            text-transform: uppercase;
            color: var(--ink-soft);
            margin-bottom: 6px;
        }
        .form-input {
            width: 100%;
            padding: 10px 14px;
            border: 1.5px solid var(--border);
            border-radius: var(--radius-sm);
            font-family: 'DM Sans', sans-serif;
            font-size: .9rem;
            color: var(--ink);
            background: var(--cream);
            transition: border-color .2s;
        }
        .form-input:focus { outline: none; border-color: var(--brand); background: #fff; }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
        .form-actions { display: flex; gap: 10px; justify-content: flex-end; margin-top: 20px; }
        .btn-outline {
            padding: 10px 20px;
            border: 1.5px solid var(--border);
            background: transparent;
            border-radius: var(--radius-sm);
            font-family: 'DM Sans', sans-serif;
            font-size: .88rem;
            font-weight: 600;
            color: var(--ink-mid);
            cursor: pointer;
            transition: all .2s;
        }
        .btn-outline:hover { border-color: var(--ink-mid); }
        .btn-primary {
            padding: 10px 24px;
            background: var(--brand);
            border: none;
            border-radius: var(--radius-sm);
            font-family: 'DM Sans', sans-serif;
            font-size: .88rem;
            font-weight: 600;
            color: #fff;
            cursor: pointer;
            transition: background .2s;
        }
        .btn-primary:hover { background: var(--brand-deep); }

        /* error list inside modal */
        .form-errors {
            background: #FDECEA;
            border: 1px solid #F5C6C2;
            border-radius: var(--radius-sm);
            padding: 10px 14px;
            margin-bottom: 16px;
        }
        .form-errors li {
            font-size: .83rem;
            color: var(--error);
            list-style: none;
            padding: 2px 0;
        }

        /* ── PAGE HEADER ── */
        .page-header {
            max-width: 1280px;
            margin: 24px auto 0;
            padding: 0 24px;
            display: flex;
            align-items: baseline;
            gap: 14px;
        }
        .page-header h1 {
            font-family: 'Fraunces', serif;
            font-weight: 900;
            font-size: 1.75rem;
            color: var(--ink);
        }
        .page-header .date-chip {
            font-size: .78rem;
            font-weight: 500;
            color: var(--ink-soft);
            background: var(--cream-dark);
            padding: 4px 10px;
            border-radius: 20px;
            border: 1px solid var(--border);
        }

        /* ── CONFIRM MODAL ── */
        .confirm-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(28,18,10,.6);
            backdrop-filter: blur(4px);
            z-index: 300;
            align-items: center;
            justify-content: center;
        }
        .confirm-overlay.open { display: flex; }
        .confirm-box {
            background: var(--surface);
            border-radius: var(--radius-lg);
            width: 100%;
            max-width: 380px;
            margin: 20px;
            box-shadow: var(--shadow-lg);
            overflow: hidden;
            animation: confirmPop .22s cubic-bezier(.34,1.56,.64,1) forwards;
        }
        @keyframes confirmPop {
            from { opacity: 0; transform: scale(.92) translateY(10px); }
            to   { opacity: 1; transform: scale(1)   translateY(0); }
        }
        .confirm-icon {
            background: var(--cream-dark);
            padding: 28px 24px 16px;
            text-align: center;
            font-size: 2.8rem;
            line-height: 1;
        }
        .confirm-content { padding: 8px 28px 24px; text-align: center; }
        .confirm-content h4 {
            font-family: 'Fraunces', serif;
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--ink);
            margin-bottom: 6px;
        }
        .confirm-content p {
            font-size: .875rem;
            color: var(--ink-soft);
            line-height: 1.5;
        }
        .confirm-total {
            margin: 14px 0 0;
            font-family: 'Fraunces', serif;
            font-size: 1.5rem;
            font-weight: 900;
            color: var(--brand);
        }
        .confirm-actions {
            display: grid;
            grid-template-columns: 1fr 1fr;
            border-top: 1px solid var(--border);
        }
        .confirm-cancel {
            padding: 16px;
            border: none;
            border-right: 1px solid var(--border);
            background: transparent;
            font-family: 'DM Sans', sans-serif;
            font-size: .9rem;
            font-weight: 600;
            color: var(--ink-soft);
            cursor: pointer;
            transition: background .15s;
        }
        .confirm-cancel:hover { background: var(--cream); }
        .confirm-ok {
            padding: 16px;
            border: none;
            background: var(--brand);
            font-family: 'DM Sans', sans-serif;
            font-size: .9rem;
            font-weight: 700;
            color: #fff;
            cursor: pointer;
            transition: background .15s;
        }
        .confirm-ok:hover { background: var(--brand-deep); }

        /* scrollbar */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: var(--border); border-radius: 3px; }
    </style>
</head>
<body>

<!-- ── TOP BAR ── -->
<nav class="topbar">
    <div class="topbar-brand">
        🥟 Empanadas & Papas <span>/ Sistema de Ventas</span>
    </div>
    <div class="topbar-nav">
        <a href="/pos" class="active">Punto de Venta</a>
        <a href="/admin">Administración</a>
    </div>
</nav>

<!-- ── ALERTS ── -->
<div class="alert">
    @if(session('success'))
        <div class="alert-box alert-success">✔ {{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert-box alert-error">✖ {{ session('error') }}</div>
    @endif
</div>

<!-- ── PAGE HEADER ── -->
<div class="page-header">
    <h1>Punto de Venta</h1>
    <span class="date-chip" id="live-date"></span>
</div>

<!-- ── MAIN POS LAYOUT ── -->
<form method="POST" action="/pos/guardar" id="pos-form">
@csrf

<div class="pos-wrap">

    {{-- ─── LEFT COLUMN ─── --}}
    <div>

        {{-- Cliente --}}
        <div class="card" style="margin-bottom:18px;">
            <div class="card-header">
                <div class="icon">👤</div>
                <h2>Cliente</h2>
            </div>
            <div class="card-body">
                <p class="section-label">Seleccionar cliente</p>
                <div class="client-row">
                    <div class="select-wrap">
                        <select name="cliente_id" required>
                            @foreach($clientes as $cliente)
                                <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="button" class="btn-add-client" onclick="openModal()">
                        ＋ Nuevo cliente
                    </button>
                </div>
            </div>
        </div>

        {{-- Productos --}}
        <div class="card">
            <div class="card-header">
                <div class="icon">🥟</div>
                <h2>Productos</h2>
            </div>
            <div class="card-body">
                <p class="section-label">Selecciona cantidades</p>
                <div class="products-grid" id="productos">
                    @foreach($productos as $producto)
                    <div class="product-card" id="pcard-{{ $loop->index }}">
                        <span class="subtotal-badge" id="badge-{{ $loop->index }}">$0</span>
                        <div class="product-name">{{ $producto->nombre }}</div>
                        <div class="product-price">Precio: <strong>${{ number_format($producto->precio, 0, ',', '.') }}</strong></div>
                        <div class="qty-row">
                            <button type="button" class="qty-btn" onclick="changeQty({{ $loop->index }}, -1)">−</button>
                            <input
                                type="number"
                                class="qty-input cantidad"
                                id="qty-{{ $loop->index }}"
                                min="0"
                                value="0"
                                data-precio="{{ $producto->precio }}"
                                data-index="{{ $loop->index }}"
                                oninput="syncQty({{ $loop->index }})"
                            >
                            <button type="button" class="qty-btn" onclick="changeQty({{ $loop->index }}, 1)">＋</button>
                        </div>
                        <input type="hidden" name="productos[{{ $loop->index }}][id]"     value="{{ $producto->id }}">
                        <input type="hidden" name="productos[{{ $loop->index }}][precio]" value="{{ $producto->precio }}">
                        <input type="hidden" name="productos[{{ $loop->index }}][cantidad]" class="cantidad-hidden" id="hidden-{{ $loop->index }}" value="0">
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{-- ─── RIGHT PANEL ─── --}}
    <div class="panel-sticky">
        <div class="card">
            <div class="card-header">
                <div class="icon">🧾</div>
                <h2>Resumen del pedido</h2>
            </div>
            <div class="card-body" style="padding-bottom:0;">
                <ul class="order-list" id="order-list">
                    <li class="order-empty"><span>🥟</span>Agrega productos para ver el resumen</li>
                </ul>
            </div>
            <div class="total-row">
                <span class="total-label">TOTAL</span>
                <span class="total-amount">$<span id="total">0</span></span>
            </div>
            <button type="button" class="btn-sell" onclick="openConfirm()">
                Registrar Venta →
            </button>
        </div>
    </div>

</div>
</form>

{{-- ─── MODAL: CONFIRMAR VENTA ─── --}}
<div class="confirm-overlay" id="confirm-overlay">
    <div class="confirm-box">
        <div class="confirm-icon">🥟</div>
        <div class="confirm-content">
            <h4>¿Confirmar venta?</h4>
            <p>Revisa el resumen antes de registrar.<br>Esta acción no se puede deshacer.</p>
            <div class="confirm-total">$<span id="confirm-total-val">0</span></div>
        </div>
        <div class="confirm-actions">
            <button type="button" class="confirm-cancel" onclick="closeConfirm()">Cancelar</button>
            <button type="button" class="confirm-ok" onclick="submitSale()">Confirmar ✓</button>
        </div>
    </div>
</div>


{{-- ─── MODAL: NUEVO CLIENTE ─── --}}
<div class="modal-overlay" id="modal-overlay">
    <div class="modal">
        <div class="modal-head">
            <h3>Registrar nuevo cliente</h3>
            <button type="button" class="modal-close" onclick="closeModal()">✕</button>
        </div>
        <div class="modal-body">

            @if ($errors->any())
            <ul class="form-errors">
                @foreach ($errors->all() as $error)
                    <li>✖ Existe un usuario con el mismo documento, intente con otro</li>
                @endforeach
            </ul>
            @endif

            <form method="POST" action="/pos/cliente">
                @csrf
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Tipo de documento</label>
                        <input type="text" name="tipo_documento" class="form-input" placeholder="CC, TI, CE…" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Número de documento</label>
                        <input type="text" name="numero_documento" class="form-input" placeholder="12345678" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Nombre completo</label>
                    <input type="text" name="nombre" class="form-input" placeholder="Nombre y apellidos" required>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Ciudad</label>
                        <input type="text" name="ciudad" class="form-input" placeholder="Ciudad">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Teléfono</label>
                        <input type="text" name="telefono" class="form-input" placeholder="300 000 0000">
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Dirección</label>
                    <input type="text" name="direccion" class="form-input" placeholder="Calle / Carrera / Barrio">
                </div>
                <div class="form-actions">
                    <button type="button" class="btn-outline" onclick="closeModal()">Cancelar</button>
                    <button type="submit" class="btn-primary">Guardar cliente</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    // ── live date ──
    const d = new Date();
    document.getElementById('live-date').textContent =
        d.toLocaleDateString('es-CO', { weekday:'long', year:'numeric', month:'long', day:'numeric' });

    // ── product names for summary ──
    const productNames = {
        @foreach($productos as $producto)
        {{ $loop->index }}: "{{ $producto->nombre }}",
        @endforeach
    };

    // ── modal ──
    function openModal()  { document.getElementById('modal-overlay').classList.add('open'); }
    function closeModal() { document.getElementById('modal-overlay').classList.remove('open'); }

    // ── confirm sale modal ──
    function openConfirm() {
        document.getElementById("confirm-total-val").textContent = document.getElementById("total").textContent;
        document.getElementById("confirm-overlay").classList.add("open");
    }
    function closeConfirm() {
        document.getElementById("confirm-overlay").classList.remove("open");
    }
    function submitSale() {
        closeConfirm();
        document.getElementById("pos-form").submit();
    }
    document.getElementById("confirm-overlay").addEventListener("click", function(e) {
        if (e.target === this) closeConfirm();
    });
    document.getElementById('modal-overlay').addEventListener('click', function(e){
        if(e.target === this) closeModal();
    });

    @if ($errors->any())
        openModal();
    @endif

    // ── qty helpers ──
    function changeQty(index, delta) {
        const input = document.getElementById('qty-' + index);
        let val = parseInt(input.value) || 0;
        val = Math.max(0, val + delta);
        input.value = val;
        syncQty(index);
    }

    function syncQty(index) {
        const input   = document.getElementById('qty-' + index);
        const hidden  = document.getElementById('hidden-' + index);
        const badge   = document.getElementById('badge-' + index);
        const card    = document.getElementById('pcard-' + index);
        const precio  = parseFloat(input.dataset.precio);
        const qty     = parseInt(input.value) || 0;
        const sub     = precio * qty;

        hidden.value = qty;
        badge.textContent = '$' + sub.toLocaleString('es-CO');
        card.classList.toggle('active', qty > 0);

        updateSummary();
    }

    // ── auto-dismiss alerts after 3 s ──
    document.querySelectorAll('.alert-box').forEach(el => {
        setTimeout(() => {
            el.classList.add('dismissing');
            el.addEventListener('animationend', () => el.remove(), { once: true });
        }, 3000);
    });

    function updateSummary() {
        const inputs = document.querySelectorAll('.cantidad');
        let total = 0;
        const items = [];

        inputs.forEach((el, i) => {
            const qty   = parseInt(el.value) || 0;
            const price = parseFloat(el.dataset.precio);
            const sub   = price * qty;
            if (qty > 0) {
                items.push({ name: productNames[i], qty, sub });
                total += sub;
            }
        });

        const list = document.getElementById('order-list');
        if (items.length === 0) {
            list.innerHTML = '<li class="order-empty"><span>🥟</span>Agrega productos para ver el resumen</li>';
        } else {
            list.innerHTML = items.map(it =>
                `<li class="order-item">
                    <span class="order-item-name">${it.name} <small style="color:var(--ink-soft)">×${it.qty}</small></span>
                    <span class="order-item-val">$${it.sub.toLocaleString('es-CO')}</span>
                </li>`
            ).join('');
        }

        document.getElementById('total').textContent = total.toLocaleString('es-CO');
    }
</script>

</body>
</html>