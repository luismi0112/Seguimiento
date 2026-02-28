<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Fichas de Caracterización</title>
    @vite(['resources/css/app.css','node_modules/admin-lte/dist/css/adminlte.min.css'])
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
            <a href="/" class="brand-link"><span class="brand-text font-weight-light">Sistema Seguimiento</span></a>
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
                <h1>Lista de Fichas de Caracterización</h1>
            </section>

            <section class="content">
                <div class="container-fluid">

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

                    <a href="{{ route('fichas.create') }}" class="btn btn-success mb-3">
                        <i class="fas fa-plus"></i> Agregar Nueva Ficha
                    </a>

                    <div class="card">
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>NIS</th>
                                        <th>Código</th>
                                        <th>Denominación</th>
                                        <th>Cupo</th>
                                        <th>Fecha Inicio</th>
                                        <th>Fecha Fin</th>
                                        <th>Observaciones</th>
                                        <th>Programa</th>
                                        <th>Centro</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($datos as $ficha)
                                    <tr>
                                        <td>{{ $ficha->NIS }}</td>
                                        <td>{{ $ficha->Codigo }}</td>
                                        <td>{{ $ficha->Denominacion }}</td>
                                        <td>{{ $ficha->Cupo }}</td>
                                        <td>{{ $ficha->Fechainicio }}</td>
                                        <td>{{ $ficha->Fechafin }}</td>
                                        <td>{{ $ficha->Observaciones }}</td>
                                        <td>{{ $ficha->programa ? $ficha->programa->Denominacion : 'Sin programa' }}</td>
                                        <td>{{ $ficha->centro ? $ficha->centro->Denominacion : 'Sin centro' }}</td>
                                        <td>
                                            <a href="{{ route('fichas.edit', $ficha->NIS) }}" class="btn btn-primary btn-sm">
                                                <i class="fas fa-edit"></i> Editar
                                            </a>
                                            <form action="{{ route('fichas.destroy', $ficha->NIS) }}" method="POST" class="d-inline deleteForm">
                                                @csrf @method('DELETE')
                                                <button type="button" class="btn btn-danger btn-sm btnDelete">
                                                    <i class="fas fa-trash"></i> Eliminar
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="10" class="text-center">No hay registros</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const deleteButtons = document.querySelectorAll('.btnDelete');
            deleteButtons.forEach(btn => {
                btn.addEventListener('click', function() {
                    const form = this.closest('form');
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
        });
    </script>

</body>

</html>