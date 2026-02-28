<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Ficha de Caracterización</title>
    @vite([
        'resources/css/app.css',
        'resources/js/app.js',
        'node_modules/admin-lte/dist/css/adminlte.min.css',
        'node_modules/admin-lte/dist/js/adminlte.min.js',
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
                        <a href="{{ route('fichas.index') }}" class="nav-link active">
                            <i class="nav-icon fas fa-id-card"></i>
                            <p>Fichas</p>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>

    <!-- Content -->
    <div class="content-wrapper p-4">
        <section class="content-header">
            <h1>Editar Ficha de Caracterización</h1>
        </section>

        <section class="content">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-edit"></i> Modificar Ficha</h3>
                </div>
                <form action="{{ route('fichas.update', $dato->NIS) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="codigo">Código</label>
                            <input type="number" class="form-control" id="codigo" name="Codigo" value="{{ $dato->Codigo }}" required>
                        </div>
                        <div class="form-group">
                            <label for="denominacion">Denominación</label>
                            <input type="text" class="form-control" id="denominacion" name="Denominacion" value="{{ $dato->Denominacion }}" maxlength="100" required>
                        </div>
                        <div class="form-group">
                            <label for="cupo">Cupo</label>
                            <input type="number" class="form-control" id="cupo" name="Cupo" value="{{ $dato->Cupo }}" required>
                        </div>
                        <div class="form-group">
                            <label for="fechainicio">Fecha Inicio</label>
                            <input type="date" class="form-control" id="fechainicio" name="Fechainicio" value="{{ $dato->Fechainicio }}" required>
                        </div>
                        <div class="form-group">
                            <label for="fechafin">Fecha Fin</label>
                            <input type="date" class="form-control" id="fechafin" name="Fechafin" value="{{ $dato->Fechafin }}" required>
                        </div>
                        <div class="form-group">
                            <label for="observaciones">Observaciones</label>
                            <textarea class="form-control" id="observaciones" name="Observaciones" rows="3" maxlength="200">{{ $dato->Observaciones }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="programa">Programa de Formación</label>
                            <select class="form-control" id="programa" name="tblprogramasdeformacion_NIS" required>
                                <option value="">Seleccione un programa</option>
                                @foreach($programas as $programa)
                                    <option value="{{ $programa->NIS }}" {{ $dato->tblprogramasdeformacion_NIS == $programa->NIS ? 'selected' : '' }}>
                                        {{ $programa->Denominacion }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="centro">Centro de Formación</label>
                            <select class="form-control" id="centro" name="tblcentrosdeformacion_NIS" required>
                                <option value="">Seleccione un centro</option>
                                @foreach($centros as $centro)
                                    <option value="{{ $centro->NIS }}" {{ $dato->tblcentrosdeformacion_NIS == $centro->NIS ? 'selected' : '' }}>
                                        {{ $centro->Denominacion }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <a href="{{ route('fichas.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Volver
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Actualizar
                        </button>
                    </div>
                </form>
            </div>
        </section>
    </div>
</div>

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
