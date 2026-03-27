<!DOCTYPE html>
<!-- terminado-->

<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Panel Admin</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-blue: #1e3a8a;
            --secondary-blue: #3b82f6;
            --light-blue: #dbeafe;
            --hover-blue: #1e40af;
        }
        
        body {
            background-color: #f1f5f9;
        }
        
        .navbar-admin {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .navbar-brand {
            font-weight: 700;
            color: white !important;
        }
        
        .nav-link {
            color: rgba(255,255,255,0.9) !important;
            font-weight: 500;
            transition: all 0.3s;
        }
        
        .nav-link:hover {
            color: white !important;
            transform: translateY(-2px);
        }
        
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            margin-bottom: 24px;
        }
        
        .card-header {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
            color: white;
            font-weight: 600;
            border-radius: 12px 12px 0 0 !important;
            padding: 16px 24px;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
            border: none;
            font-weight: 600;
            padding: 10px 24px;
            border-radius: 8px;
        }
        
        .btn-primary:hover {
            background: linear-gradient(135deg, var(--hover-blue) 0%, var(--primary-blue) 100%);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(30, 58, 138, 0.3);
        }
        
        .table {
            background: white;
        }
        
        .table thead {
            background-color: var(--light-blue);
        }
        
        .badge-success {
            background-color: #10b981;
        }
        
        .badge-danger {
            background-color: #ef4444;
        }
        
        .alert-success {
            background-color: #d1fae5;
            border-color: #6ee7b7;
            color: #065f46;
        }
    </style>
</head>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-admin mb-4">
        <div class="container-fluid">
            <a class="navbar-brand" href="/admin">
                <i class="bi bi-speedometer2 me-2"></i>Panel de Administración
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/productos">
                            <i class="bi bi-box-seam me-1"></i>Productos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/clientes">
                            <i class="bi bi-people me-1"></i>Clientes
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/ventas">
                            <i class="bi bi-cart me-1"></i>Ventas
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/reportes">
                            <i class="bi bi-graph-up me-1"></i>Reportes
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/pos">
                            <i class="bi bi-shop me-1"></i>Ir al POS
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenido principal -->
    <div class="container-fluid px-4">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        
        @yield('content')
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>