<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Agregar Rol Administrativo</title>
    @vite(['resources/css/app.css','node_modules/admin-lte/dist/css/adminlte.min.css'])
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" data-widget="pushmenu" href="#">&#9776;</a></li>
                <li class="nav-item d-none d-sm-inline-block"><a href="/" class="nav-link">Inicio</a></li>
            </ul>
        </nav>

        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="/" class="brand-link"><span class="brand-text font-weight-light">AdminLTE Laravel</span></a>
            <div class="sidebar">
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column">
                        <li class="nav-item">
                            <a href="{{ route('rolesadministrativos.index') }}" class="nav-link active">
                                <i class="nav-icon fas fa-user-shield"></i>
                                <p>Roles Administrativos</p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <div class="content-wrapper p-4">
            <section class="content-header">
                <h1>Agregar Rol Administrativo</h1>
            </section>

            <section class="content">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-plus"></i> Nuevo Rol</h3>
                    </div>
                    <form action="{{ route('rolesadministrativos.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="descripcion">Descripción</label>
                                <input type="text" class="form-control" id="descripcion" name="Descripcion" maxlength="200" required>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            <a href="{{ route('rolesadministrativos.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Volver
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save"></i> Guardar
                            </button>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>

    @vite(['resources/js/app.js','node_modules/admin-lte/dist/js/adminlte.min.js'])
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

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