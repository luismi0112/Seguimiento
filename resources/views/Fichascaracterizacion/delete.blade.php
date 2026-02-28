<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Eliminar Ficha de Caracterización</title>
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
            <h1>Eliminar Ficha de Caracterización</h1>
        </section>

        <section class="content">
            <div class="card card-danger">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-trash"></i> Confirmar Eliminación</h3>
                </div>
                <div class="card-body">
                    <p>¿Estás seguro de que deseas eliminar la ficha <strong>{{ $dato->Denominacion }}</strong> con código <strong>{{ $dato->Codigo }}</strong>?</p>
                </div>
                <div class="card-footer d-flex justify-content-between">
                    <a href="{{ route('fichas.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Cancelar
                    </a>
                    <form action="{{ route('fichas.destroy', $dato->NIS) }}" method="POST" id="deleteForm">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger" id="btnDelete">
                            <i class="fas fa-trash"></i> Eliminar
                        </button>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const btnDelete = document.getElementById('btnDelete');
        const form = document.getElementById('deleteForm');

        btnDelete.addEventListener('click', function() {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "Esta acción eliminará la ficha definitivamente.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>

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

</script>

</body>
</html>
