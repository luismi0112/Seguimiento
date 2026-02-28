<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        .welcome-banner {
            background: linear-gradient(90deg, #007bff, #00c851);
            color: white;
            padding: 25px;
            border-radius: 8px;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .welcome-banner h2 {
            margin: 0;
            font-weight: 700;
            font-size: 1.8rem;
        }

        .welcome-banner i {
            font-size: 2rem;
        }

        /* Tarjetas: centrado vertical y horizontal del contenido */
        .card-dashboard {
            background: #fff;
            border-radius: 10px;
            transition: all 0.3s ease;
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            height: 220px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0;
        }

        .card-dashboard .card-body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 20px 15px;
            gap: 12px;
            width: 100%;
        }

        .card-dashboard i {
            font-size: 3.8rem;
            color: #007bff;
            line-height: 1;
        }

        .card-dashboard h5 {
            font-size: 1.25rem;
            font-weight: 700;
            margin: 0;
            color: #333;
        }

        .card-dashboard .subtitle {
            font-size: 0.95rem;
            color: #666;
            margin-top: 4px;
        }

        @media (max-width: 576px) {
            .card-dashboard {
                height: 200px;
            }

            .card-dashboard i {
                font-size: 3.2rem;
            }

            .card-dashboard h5 {
                font-size: 1.05rem;
            }
        }
    </style>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Sidebar -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="{{ url('/') }}" class="brand-link text-center">
                <span class="brand-text font-weight-light">Sistema Seguimiento</span>
            </a>

            <div class="sidebar">
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column">
                        <li class="nav-item">
                            <a href="{{ route('regionales.index') }}" class="nav-link">
                                <i class="fas fa-map"></i>
                                <p>Regionales</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('centrosformacion.index') }}" class="nav-link">
                                <i class="fas fa-school"></i>
                                <p>Centros Formación</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('programasformacion.index') }}" class="nav-link">
                                <i class="fas fa-book"></i>
                                <p>Programas</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('fichas.index') }}" class="nav-link">
                                <i class="fas fa-id-card"></i>
                                <p>Fichas</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('aprendices.index') }}" class="nav-link">
                                <i class="fas fa-users"></i>
                                <p>Aprendices</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('instructores.index') }}" class="nav-link">
                                <i class="fas fa-chalkboard-teacher"></i>
                                <p>Instructores</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('eps.index') }}" class="nav-link">
                                <i class="fas fa-hospital"></i>
                                <p>EPS</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('rolesadministrativos.index') }}" class="nav-link">
                                <i class="fas fa-user-shield"></i>
                                <p>Roles</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('tiposdocumentos.index') }}" class="nav-link">
                                <i class="fas fa-id-badge"></i>
                                <p>Tipos Documento</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('entecoformadores.index') }}" class="nav-link">
                                <i class="fas fa-handshake"></i>
                                <p>Entes Coformadores</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('archivos.index') }}" class="nav-link">
                                <i class="fas fa-upload"></i>
                                <p>Archivos</p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <!-- Content -->
        <div class="content-wrapper p-4">
            <div class="welcome-banner">
                <h2><i class="fas fa-home"></i> Bienvenido al Sistema de Seguimiento</h2>
                <span>Gestiona todas tus entidades de manera fácil y rápida</span>
            </div>

            <!-- Dashboard con tarjetas -->
            <div class="row">
                <div class="col-md-3 mb-4">
                    <div class="card card-dashboard">
                        <div class="card-body">
                            <i class="fas fa-map"></i>
                            <h5>Regionales</h5>
                        </div>
                        <a href="{{ route('regionales.index') }}" class="stretched-link"></a>
                    </div>
                </div>

                <div class="col-md-3 mb-4">
                    <div class="card card-dashboard">
                        <div class="card-body">
                            <i class="fas fa-school"></i>
                            <h5>Centros Formación</h5>
                        </div>
                        <a href="{{ route('centrosformacion.index') }}" class="stretched-link"></a>
                    </div>
                </div>

                <div class="col-md-3 mb-4">
                    <div class="card card-dashboard">
                        <div class="card-body">
                            <i class="fas fa-book"></i>
                            <h5>Programas</h5>
                        </div>
                        <a href="{{ route('programasformacion.index') }}" class="stretched-link"></a>
                    </div>
                </div>

                <div class="col-md-3 mb-4">
                    <div class="card card-dashboard">
                        <div class="card-body">
                            <i class="fas fa-id-card"></i>
                            <h5>Fichas</h5>
                        </div>
                        <a href="{{ route('fichas.index') }}" class="stretched-link"></a>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 mb-4">
                    <div class="card card-dashboard">
                        <div class="card-body">
                            <i class="fas fa-users"></i>
                            <h5>Aprendices</h5>
                        </div>
                        <a href="{{ route('aprendices.index') }}" class="stretched-link"></a>
                    </div>
                </div>

                <div class="col-md-3 mb-4">
                    <div class="card card-dashboard">
                        <div class="card-body">
                            <i class="fas fa-chalkboard-teacher"></i>
                            <h5>Instructores</h5>
                        </div>
                        <a href="{{ route('instructores.index') }}" class="stretched-link"></a>
                    </div>
                </div>

                <div class="col-md-3 mb-4">
                    <div class="card card-dashboard">
                        <div class="card-body">
                            <i class="fas fa-hospital"></i>
                            <h5>EPS</h5>
                        </div>
                        <a href="{{ route('eps.index') }}" class="stretched-link"></a>
                    </div>
                </div>

                <div class="col-md-3 mb-4">
                    <div class="card card-dashboard">
                        <div class="card-body">
                            <i class="fas fa-user-shield"></i>
                            <h5>Roles</h5>
                        </div>
                        <a href="{{ route('rolesadministrativos.index') }}" class="stretched-link"></a>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 mb-4">
                    <div class="card card-dashboard">
                        <div class="card-body">
                            <i class="fas fa-id-badge"></i>
                            <h5>Tipos Documento</h5>
                        </div>
                        <a href="{{ route('tiposdocumentos.index') }}" class="stretched-link"></a>
                    </div>
                </div>

                <div class="col-md-3 mb-4">
                    <div class="card card-dashboard">
                        <div class="card-body">
                            <i class="fas fa-handshake"></i>
                            <h5>Entes Coformadores</h5>
                        </div>
                        <a href="{{ route('entecoformadores.index') }}" class="stretched-link"></a>
                    </div>
                </div>

                <div class="col-md-3 mb-4">
                    <div class="card card-dashboard">
                        <div class="card-body">
                            <i class="fas fa-upload"></i>
                            <h5>Archivos</h5>
                        </div>
                        <a href="{{ route('archivos.index') }}" class="stretched-link"></a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="main-footer text-center p-3">
            <strong>&copy; {{ date('Y') }} Sistema Seguimiento.</strong> Todos los derechos reservados.
        </footer>
    </div>
</body>

</html>S