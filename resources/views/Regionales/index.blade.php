<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Regiones</title>
    @vite(['resources/css/app.css', 'node_modules/admin-lte/dist/css/adminlte.min.css'])
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button">&#9776;</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="/" class="nav-link">Inicio</a>
            </li>
        </ul>
    </nav>

    <!-- Sidebar -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="/" class="brand-link">
            <span class="brand-text font-weight-light">Sistema Seguimiento</span>
        </a>
        <div class="sidebar">
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column">
                    <li class="nav-item">
                        <a href="{{ route('regionales.index') }}" class="nav-link active">
                            <i class="nav-icon fas fa-map"></i>
                            <p>Regionales</p>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>

    <!-- Content -->
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <h1 class="mb-2">Lista de Regiones</h1>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">

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

                <a href="{{ route('regionales.create') }}" class="btn btn-success mb-3">
                    <i class="fas fa-plus"></i> Agregar Nueva Regional
                </a>

                <div class="card">
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th>NIS</th>
                                    <th>Código</th>
                                    <th>Denominación</th>
                                    <th>Observaciones</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($regionales) && $regionales->count() > 0)
                                    @foreach($regionales as $regional)
                                        <tr>
                                            <td>{{ $regional->NIS }}</td>
                                            <td>{{ $regional->Codigo }}</td>
                                            <td>{{ $regional->Denominacion }}</td>
                                            <td>{{ $regional->Observaciones }}</td>
                                            <td>
                                                <a href="{{ route('regionales.edit', $regional->NIS) }}" class="btn btn-primary btn-sm">
                                                    <i class="fas fa-edit"></i> Editar
                                                </a>
                                                <form action="{{ route('regionales.destroy', $regional->NIS) }}" method="POST" class="deleteForm" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger btn-sm btnDelete">
                                                        <i class="fas fa-trash"></i> Eliminar
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5" class="text-center">No hay registros</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <strong>Total de regionales: {{ $regionales->count() }}</strong>
                    </div>
                </div>

            </div>
        </section>
    </div>

</div>

@vite(['resources/js/app.js', 'node_modules/admin-lte/dist/js/adminlte.min.js'])
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const deleteButtons = document.querySelectorAll('.btnDelete');

        deleteButtons.forEach(btn => {
            btn.addEventListener('click', function() {
                const form = this.closest('form');
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "Esta acción eliminará la regional definitivamente.",
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
