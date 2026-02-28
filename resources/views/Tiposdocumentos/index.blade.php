<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Tipos de Documentos</title>
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
                            <a href="{{ route('tiposdocumentos.index') }}" class="nav-link active">
                                <i class="fas fa-id-badge"></i>
                                <p>Tipos Documento</p>
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
                    <h1>Tipos de Documentos</h1>
                </div>
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

                    <a href="{{ route('tiposdocumentos.create') }}" class="btn btn-success mb-3">
                        <i class="fas fa-plus"></i> Agregar Tipo
                    </a>

                    <div class="card">
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>NIS</th>
                                        <th>Denominación</th>
                                        <th>Observaciones</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($tiposdocumentos as $tipo)
                                    <tr>
                                        <td>{{ $tipo->NIS }}</td>
                                        <td>{{ $tipo->Denominacion }}</td>
                                        <td>{{ $tipo->Observaciones }}</td>
                                        <td>
                                            <a href="{{ route('tiposdocumentos.edit',$tipo->NIS) }}" class="btn btn-primary btn-sm">
                                                <i class="fas fa-edit"></i> Editar
                                            </a>
                                            <form action="{{ route('tiposdocumentos.destroy',$tipo->NIS) }}" method="POST" class="d-inline deleteForm">
                                                @csrf @method('DELETE')
                                                <button type="button" class="btn btn-danger btn-sm btnDelete">
                                                    <i class="fas fa-trash"></i> Eliminar
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="text-center">No hay registros</td>
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
                        text: "Esta acción eliminará el tipo de documento definitivamente.",
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