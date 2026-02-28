<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Lista de Instructores</title>
    @vite(['resources/css/app.css','node_modules/admin-lte/dist/css/adminlte.min.css'])
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" data-widget="pushmenu" href="#">&#9776;</a></li>
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
                            <a href="{{ route('instructores.index') }}" class="nav-link active">
                                <i class="nav-icon fas fa-chalkboard-teacher"></i>
                                <p>Instructores</p>
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
                    <h1>Lista de Instructores</h1>
                </div>
            </section>

            <section class="content">
                <div class="container-fluid">

                    <a href="{{ route('instructores.create') }}" class="btn btn-success mb-3">
                        <i class="fas fa-plus"></i> Agregar Instructor
                    </a>

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
                        <div class="card-body table-responsive">
                            <table class="table table-bordered table-hover table-sm">
                                <thead class="bg-light">
                                    <tr>
                                        <th>NIS</th>
                                        <th>Documento</th>
                                        <th>Nombres</th>
                                        <th>Apellidos</th>
                                        <th>Dirección</th>
                                        <th>Teléfono</th>
                                        <th>Correo Institucional</th>
                                        <th>Correo Personal</th>
                                        <th>Sexo</th>
                                        <th>Nacimiento</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($instructores as $inst)
                                    <tr>
                                        <td>{{ $inst->NIS }}</td>
                                        <td>{{ $inst->Numdoc }}</td>
                                        <td>{{ $inst->Nombres }}</td>
                                        <td>{{ $inst->Apellidos }}</td>
                                        <td>{{ $inst->Direccion }}</td>
                                        <td>{{ $inst->Telefono }}</td>
                                        <td>{{ $inst->CorreoInstitucional }}</td>
                                        <td>{{ $inst->CorreoPersonal }}</td>
                                        <td>{{ $inst->Sexo == 1 ? 'Masculino' : 'Femenino' }}</td>
                                        <td>{{ $inst->FechaNacimiento }}</td>
                                        <td>
                                            <a href="{{ route('instructores.edit',$inst->NIS) }}" class="btn btn-primary btn-sm">
                                                <i class="fas fa-edit"></i> Editar
                                            </a>
                                            <form action="{{ route('instructores.destroy',$inst->NIS) }}" method="POST" class="deleteForm" style="display:inline;">
                                                @csrf @method('DELETE')
                                                <button type="button" class="btn btn-danger btn-sm btnDelete">
                                                    <i class="fas fa-trash"></i> Eliminar
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="11" class="text-center">No hay registros</td>
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

    @vite(['resources/js/app.js','node_modules/admin-lte/dist/js/adminlte.min.js'])
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const deleteButtons = document.querySelectorAll('.btnDelete');

            deleteButtons.forEach(btn => {
                btn.addEventListener('click', function() {
                    const form = this.closest('form');
                    Swal.fire({
                        title: '¿Estás seguro?',
                        text: "Esta acción eliminará al instructor definitivamente.",
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