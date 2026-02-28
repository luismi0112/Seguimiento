<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Entes Coformadores</title>
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
                            <a href="{{ route('entecoformadores.index') }}" class="nav-link active">
                                <i class="fas fa-handshake"></i>
                                <p>Entes Coformadores</p>
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
                    <h1>Lista de Entes Coformadores</h1>
                </div>
            </section>

            <section class="content">
                <div class="container-fluid">
                    <a href="{{ route('entecoformadores.create') }}" class="btn btn-success mb-3">
                        <i class="fas fa-plus"></i> Nuevo Ente
                    </a>

                    <div class="card">
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>NIS</th>
                                        <th>Tipo Doc</th>
                                        <th>Número Doc</th>
                                        <th>Nombres</th>
                                        <th>Razón Social</th>
                                        <th>Dirección</th>
                                        <th>Teléfono</th>
                                        <th>Correo Institucional</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($datos as $ente)
                                    <tr>
                                        <td>{{ $ente->NIS }}</td>
                                        <td>{{ $ente->Tdoc }}</td>
                                        <td>{{ $ente->Numdoc }}</td>
                                        <td>{{ $ente->Nombres }}</td>
                                        <td>{{ $ente->RazonSocial }}</td>
                                        <td>{{ $ente->Direccion }}</td>
                                        <td>{{ $ente->Telefono }}</td>
                                        <td>{{ $ente->CorreoInstitucional }}</td>
                                        <td>
                                            <a href="{{ route('entecoformadores.edit', $ente->NIS) }}" class="btn btn-primary btn-sm">
                                                <i class="fas fa-edit"></i> Editar
                                            </a>
                                            <form action="{{ route('entecoformadores.destroy', $ente->NIS) }}" method="POST" style="display:inline;" class="delete-form">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash"></i> Eliminar
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="9" class="text-center">Sin registros</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
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
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var successMessage = "{{ session('success') }}";

            if (successMessage) {
                Swal.fire({
                    icon: 'success',
                    title: '¡Éxito!',
                    text: successMessage,
                    showConfirmButton: false,
                    timer: 2000
                });
            }

            document.querySelectorAll('.delete-form').forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: '¿Estás seguro?',
                        text: "Esta acción eliminará el ente coformador definitivamente.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Sí, eliminar',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            this.submit();
                        }
                    });
                });
            });
        });
    </script>
</body>

</html>