<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Aprendices</title>
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
                            <a href="{{ route('aprendices.index') }}" class="nav-link active">
                                <i class="fas fa-users"></i>
                                <p>Aprendices</p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <div class="content-wrapper p-4">
            <section class="content-header">
                <div class="container-fluid">
                    <h1>Aprendices</h1>
                </div>
            </section>

            <section class="content">
                <div class="container-fluid">

                    <a href="{{ route('aprendices.create') }}" class="btn btn-success mb-3">
                        <i class="fas fa-plus"></i> Agregar Aprendiz
                    </a>

                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-list"></i> Lista de Aprendices</h3>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th>NIS</th>
                                        <th>Documento</th>
                                        <th>Nombres</th>
                                        <th>Apellidos</th>
                                        <th>Correo Institucional</th>
                                        <th>Correo Personal</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($aprendices as $aprendiz)
                                    <tr>
                                        <td>{{ $aprendiz->NIS }}</td>
                                        <td>{{ $aprendiz->Numdoc }}</td>
                                        <td>{{ $aprendiz->Nombres }}</td>
                                        <td>{{ $aprendiz->Apellidos }}</td>
                                        <td>{{ $aprendiz->CorreoInstitucional }}</td>
                                        <td>{{ $aprendiz->CorreoPersonal }}</td>
                                        <td>
                                            <a href="{{ route('aprendices.edit',$aprendiz->NIS) }}" class="btn btn-primary btn-sm">
                                                <i class="fas fa-edit"></i> Editar
                                            </a>
                                            <form class="deleteForm" action="{{ route('aprendices.destroy', $aprendiz->NIS) }}" method="POST" style="display:inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash"></i> Eliminar
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </section>
        </div>

        <footer class="main-footer text-center">
            <strong>&copy; {{ date('Y') }} Sistema de Seguimiento</strong>
        </footer>
    </div>

    @vite(['resources/js/app.js','node_modules/admin-lte/dist/js/adminlte.min.js'])

    <script>
        document.querySelectorAll('.deleteForm').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "Esta acción eliminará el aprendiz definitivamente.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(this.action, {
                                method: this.method,
                                body: new FormData(this),
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                }
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: '¡Eliminado!',
                                        text: 'El aprendiz se eliminó correctamente.',
                                        showConfirmButton: false,
                                        timer: 2000
                                    }).then(() => {
                                        window.location.reload();
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: data.message || 'No se pudo eliminar el aprendiz.',
                                    });
                                }
                            })
                            .catch(error => {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'Ocurrió un problema al procesar la solicitud.',
                                });
                                console.error(error);
                            });
                    }
                });
            });
        });
    </script>
</body>

</html>