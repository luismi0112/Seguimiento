<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Sistema Seguimiento</title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js',
        'node_modules/admin-lte/dist/css/adminlte.min.css',
        'node_modules/admin-lte/dist/js/adminlte.min.js',
        'node_modules/admin-lte/plugins/fontawesome-free/css/all.min.css'
    ])

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        .btn-gradient {
            background: linear-gradient(90deg, #007bff, #00c851);
            color: #fff;
            border: none;
            border-radius: 6px;
            font-weight: bold;
            padding: 10px 20px;
            transition: all 0.3s ease;
        }
        .btn-gradient:hover {
            background: linear-gradient(90deg, #00c851, #007bff);
            transform: scale(1.05);
            box-shadow: 0 6px 15px rgba(0,0,0,0.2);
        }
        .welcome-banner {
            background:linear-gradient(90deg,#007bff,#00c851);
            color:white; padding:20px; border-radius:8px;
            margin-bottom:20px; display:flex; align-items:center; justify-content:space-between;
        }
        .welcome-banner h2 {margin:0; font-weight:bold;}
        .welcome-banner i {font-size:2rem;}
    </style>
</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="/" class="brand-link text-center"><span class="brand-text font-weight-light">Sistema Seguimiento</span></a>
        <div class="sidebar">
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column">
                    <li class="nav-item"><a href="{{ route('regionales.index') }}" class="nav-link"><i class="fas fa-map"></i><p>Regionales</p></a></li>
                    <li class="nav-item"><a href="{{ route('centrosformacion.index') }}" class="nav-link"><i class="fas fa-school"></i><p>Centros Formación</p></a></li>
                    <li class="nav-item"><a href="{{ route('programasformacion.index') }}" class="nav-link"><i class="fas fa-book"></i><p>Programas</p></a></li>
                    <li class="nav-item"><a href="{{ route('fichas.index') }}" class="nav-link"><i class="fas fa-id-card"></i><p>Fichas</p></a></li>
                    <li class="nav-item"><a href="{{ route('aprendices.index') }}" class="nav-link"><i class="fas fa-users"></i><p>Aprendices</p></a></li>
                    <li class="nav-item"><a href="{{ route('instructores.index') }}" class="nav-link"><i class="fas fa-chalkboard-teacher"></i><p>Instructores</p></a></li>
                    <li class="nav-item"><a href="{{ route('eps.index') }}" class="nav-link"><i class="fas fa-hospital"></i><p>EPS</p></a></li>
                    <li class="nav-item"><a href="{{ route('rolesadministrativos.index') }}" class="nav-link"><i class="fas fa-user-shield"></i><p>Roles</p></a></li>
                    <li class="nav-item"><a href="{{ route('tiposdocumentos.index') }}" class="nav-link"><i class="fas fa-id-badge"></i><p>Tipos Documento</p></a></li>
                    <li class="nav-item"><a href="{{ route('entecoformadores.index') }}" class="nav-link"><i class="fas fa-handshake"></i><p>Entes Coformadores</p></a></li>
                    <li class="nav-item"><a href="{{ route('archivos.index') }}" class="nav-link"><i class="fas fa-upload"></i><p>Archivos</p></a></li>
                </ul>
            </nav>
        </div>
    </aside>

    <div class="content-wrapper p-4">
        <div class="welcome-banner">
            <h2><i class="fas fa-home"></i> Bienvenido al Sistema de Seguimiento</h2>
            <span>Gestiona tus entidades de manera fácil y rápida</span>
        </div>

        <!-- Subir archivo -->
        <div class="card card-primary mb-4">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-upload"></i> Subir Archivo</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('archivos.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="nombre">Nombre del archivo</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="archivo">Seleccionar archivo</label>
                        <input type="file" name="archivo" id="archivo" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-gradient">
                        <i class="fas fa-cloud-upload-alt"></i> Subir Archivo
                    </button>
                </form>
            </div>
        </div>

        <!-- Tabla de archivos -->
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-list"></i> Archivos Registrados</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Archivo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($archivos as $archivo)
                            <tr>
                                <td>{{ $archivo->id }}</td>
                                <td>{{ $archivo->nombre }}</td>
                                <td>{{ $archivo->fecha }}</td>
                                <td>{{ $archivo->hora }}</td>
                                <td>
                                    <a href="{{ asset('storage/archivos/'.$archivo->ruta) }}" target="_blank" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i> Ver
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No hay registros</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</body>
</html>
