<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Editar Instructor</title>
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

        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" data-widget="pushmenu" href="#">☰</a></li>
                <li class="nav-item d-none d-sm-inline-block"><a href="/" class="nav-link">Inicio</a></li>
            </ul>
        </nav>

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

        <div class="content-wrapper p-4">
            <section class="content-header">
                <div class="container-fluid">
                    <h1>Editar Instructor</h1>
                </div>
            </section>

            <section class="content">
                <div class="container-fluid">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-edit"></i> Modificar Datos</h3>
                        </div>
                        <form action="{{ route('instructores.update',$instructor->NIS) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="numdoc">Número Documento</label>
                                    <input type="number" class="form-control" id="numdoc" name="Numdoc" value="{{ $instructor->Numdoc }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="nombres">Nombres</label>
                                    <input type="text" class="form-control" id="nombres" name="Nombres" value="{{ $instructor->Nombres }}" maxlength="100" required>
                                </div>
                                <div class="form-group">
                                    <label for="apellidos">Apellidos</label>
                                    <input type="text" class="form-control" id="apellidos" name="Apellidos" value="{{ $instructor->Apellidos }}" maxlength="100" required>
                                </div>
                                <div class="form-group">
                                    <label for="direccion">Dirección</label>
                                    <input type="text" class="form-control" id="direccion" name="Direccion" value="{{ $instructor->Direccion }}" maxlength="200">
                                </div>
                                <div class="form-group">
                                    <label for="telefono">Teléfono</label>
                                    <input type="text" class="form-control" id="telefono" name="Telefono" value="{{ $instructor->Telefono }}" maxlength="50">
                                </div>
                                <div class="form-group">
                                    <label for="correoInstitucional">Correo Institucional</label>
                                    <input type="email" class="form-control" id="correoInstitucional" name="CorreoInstitucional" value="{{ $instructor->CorreoInstitucional }}" maxlength="50">
                                </div>
                                <div class="form-group">
                                    <label for="correoPersonal">Correo Personal</label>
                                    <input type="email" class="form-control" id="correoPersonal" name="CorreoPersonal" value="{{ $instructor->CorreoPersonal }}" maxlength="50">
                                </div>
                                <div class="form-group">
                                    <label for="sexo">Sexo</label>
                                    <select class="form-control" id="sexo" name="Sexo" required>
                                        <option value="1" {{ $instructor->Sexo == 1 ? 'selected' : '' }}>Masculino</option>
                                        <option value="2" {{ $instructor->Sexo == 2 ? 'selected' : '' }}>Femenino</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="fechaNacimiento">Fecha de Nacimiento</label>
                                    <input type="date" class="form-control" id="fechaNacimiento" name="FechaNacimiento" value="{{ $instructor->FechaNacimiento }}">
                                </div>
                                <div class="form-group">
                                    <label for="eps">EPS</label>
                                    <select class="form-control" id="eps" name="tbleps_NIS" required>
                                        @foreach($eps as $item)
                                        <option value="{{ $item->NIS }}" {{ $instructor->tbleps_NIS == $item->NIS ? 'selected' : '' }}>
                                            {{ $item->Denominacion }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="rolAdmin">Rol Administrativo</label>
                                    <select class="form-control" id="rolAdmin" name="tblrolesadministrativos_NIS" required>
                                        <option value="1" {{ $instructor->tblrolesadministrativos_NIS == 1 ? 'selected' : '' }}>Coordinador Académico</option>
                                        <option value="2" {{ $instructor->tblrolesadministrativos_NIS == 2 ? 'selected' : '' }}>Director de Centro</option>
                                        <option value="3" {{ $instructor->tblrolesadministrativos_NIS == 3 ? 'selected' : '' }}>Subdirector Administrativo</option>
                                        <option value="4" {{ $instructor->tblrolesadministrativos_NIS == 4 ? 'selected' : '' }}>Jefe de Programa</option>
                                        <option value="5" {{ $instructor->tblrolesadministrativos_NIS == 5 ? 'selected' : '' }}>Asistente de Formación</option>
                                    </select>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-between">
                                <a href="{{ route('instructores.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Volver
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Actualizar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>

        <footer class="main-footer text-center">
            <strong>&copy; {{ date('Y') }} Sistema de Seguimiento</strong>
        </footer>
    </div>

    @vite(['resources/js/app.js','node_modules/admin-lte/dist/js/adminlte.min.js'])

    @if(session('success'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                icon: 'success',
                title: '¡Actualizado!',
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 2000
            });
        });
    </script>
    @endif

</body>

</html>