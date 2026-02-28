<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Programas de Formación</title>
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
                            <a href="{{ route('programasformacion.index') }}" class="nav-link active">
                                <i class="fas fa-book"></i>
                                <p>Programas Formación</p>
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
                    <h1>Programas de Formación</h1>
                </div>
            </section>

            <section class="content">
                <div class="container-fluid">

                    <a href="{{ route('programasformacion.create') }}" class="btn btn-success mb-3">
                        <i class="fas fa-plus"></i> Agregar Programa
                    </a>

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

                    <div class="card">
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>NIS</th>
                                        <th>Código</th>
                                        <th>Denominación</th>
                                        <th>Duración</th>
                                        <th>Observaciones</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($programas as $programa)
                                    <tr>
                                        <td>{{ $programa->NIS }}</td>
                                        <td>{{ $programa->Codigo }}</td>
                                        <td>{{ $programa->Denominacion }}</td>
                                        <td>{{ $programa->Duracion }} semestres</td>
                                        <td>{{ $programa->Observaciones }}</td>
                                        <td>
                                            <a href="{{ route('programasformacion.edit',$programa->NIS) }}" class="btn btn-primary btn-sm">
                                                <i class="fas fa-edit"></i> Editar
                                            </a>
                                            <form action="{{ route('programasformacion.destroy',$programa->NIS) }}" method="POST" class="deleteForm" style="display:inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger btn-sm btnDelete">
                                                    <i class="fas fa-trash"></i> Eliminar
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            <strong>Total de programas: {{ $programas->count() }}</strong>
                        </div>
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

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const deleteButtons = document.querySelectorAll('.btnDelete');

            deleteButtons.forEach(btn => {
                btn.addEventListener('click', function() {
                    const form = this.closest('form');
                    Swal.fire({
                        title: '¿Estás seguro?',
                        text: "Esta acción eliminará el programa de formación definitivamente.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Sí, eliminar',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit(); // envío normal
                        }
                    });
                });
            });
        });
    </script>
</body>

</html>