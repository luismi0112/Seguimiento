<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Agregar Nuevo Instructor</title>
    @vite([
    'resources/css/app.css',
    'resources/js/app.js',
    'node_modules/admin-lte/dist/css/adminlte.min.css',
    'node_modules/admin-lte/plugins/fontawesome-free/css/all.min.css'
    ])
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" data-widget="pushmenu" href="#">☰</a></li>
                <li class="nav-item d-none d-sm-inline-block"><a href="/" class="nav-link">Inicio</a></li>
            </ul>
        </nav>

        <!-- Sidebar -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="/" class="brand-link text-center">
                <span class="brand-text font-weight-light">Sistema Seguimiento</span>
            </a>
            <div class="sidebar">
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column">
                        <li class="nav-item">
                            <a href="{{ route('instructores.index') }}" class="nav-link active">
                                <i class="fas fa-chalkboard-teacher"></i>
                                <p>Instructores</p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <!-- Content -->
        <div class="content-wrapper p-4">
            <section class="content-header">
                <div class="container-fluid">
                    <h1>Agregar Nuevo Instructor</h1>
                </div>
            </section>

            <section class="content">
                <div class="container-fluid">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-plus"></i> Nuevo Instructor</h3>
                        </div>
                        <form action="{{ route('instructores.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="numdoc">Número Documento</label>
                                    <input type="number" class="form-control" id="numdoc" name="Numdoc" required>
                                </div>
                                <div class="form-group">
                                    <label for="nombres">Nombres</label>
                                    <input type="text" class="form-control" id="nombres" name="Nombres" maxlength="100" required>
                                </div>
                                <div class="form-group">
                                    <label for="apellidos">Apellidos</label>
                                    <input type="text" class="form-control" id="apellidos" name="Apellidos" maxlength="100" required>
                                </div>
                                <div class="form-group">
                                    <label for="direccion">Dirección</label>
                                    <input type="text" class="form-control" id="direccion" name="Direccion" maxlength="200">
                                </div>
                                <div class="form-group">
                                    <label for="telefono">Teléfono</label>
                                    <input type="text" class="form-control" id="telefono" name="Telefono" maxlength="50">
                                </div>
                                <div class="form-group">
                                    <label for="correoInstitucional">Correo Institucional</label>
                                    <input type="email" class="form-control" id="correoInstitucional" name="CorreoInstitucional" maxlength="50">
                                </div>
                                <div class="form-group">
                                    <label for="correoPersonal">Correo Personal</label>
                                    <input type="email" class="form-control" id="correoPersonal" name="CorreoPersonal" maxlength="50">
                                </div>
                                <div class="form-group">
                                    <label for="sexo">Sexo</label>
                                    <select class="form-control" id="sexo" name="Sexo" required>
                                        <option value="1">Masculino</option>
                                        <option value="2">Femenino</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="fechaNacimiento">Fecha de Nacimiento</label>
                                    <input type="date" class="form-control" id="fechaNacimiento" name="FechaNacimiento">
                                </div>
                                <div class="form-group">
                                    <label for="eps">EPS</label>
                                    <select class="form-control" id="eps" name="tbleps_NIS" required>
                                        @foreach($eps as $item)
                                        <option value="{{ $item->NIS }}">{{ $item->Denominacion }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="rolAdmin">Rol Administrativo</label>
                                    <select class="form-control" id="rolAdmin" name="tblrolesadministrativos_NIS" required>
                                        <option value="1">Coordinador Académico</option>
                                        <option value="2">Director de Centro</option>
                                        <option value="3">Subdirector Administrativo</option>
                                        <option value="4">Jefe de Programa</option>
                                        <option value="5">Asistente de Formación</option>
                                    </select>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-between">
                                <a href="{{ route('instructores.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Volver
                                </a>
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-save"></i> Guardar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>

        <!-- Footer -->
        <footer class="main-footer text-center">
            <strong>&copy; {{ date('Y') }} Sistema de Seguimiento</strong>
        </footer>
    </div>

    @vite(['resources/js/app.js','node_modules/admin-lte/dist/js/adminlte.min.js'])

    <!-- Animación de éxito -->
    @if(session('success'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 2000
            });
        });
    </script>
    @endif

</body>

</html>