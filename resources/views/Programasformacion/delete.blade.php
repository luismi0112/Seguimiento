<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Eliminar Programa de Formación</title>
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

        <div class="content-wrapper p-4">
            <section class="content-header">
                <div class="container-fluid">
                    <h1>Eliminar Programa de Formación</h1>
                </div>
            </section>

            <section class="content">
                <div class="container-fluid">
                    <div class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-trash"></i> Confirmar Eliminación</h3>
                        </div>
                        <div class="card-body">
                            <p>¿Estás seguro de que deseas eliminar el siguiente programa?</p>
                            <ul>
                                <li><strong>Código:</strong> {{ $programa->Codigo }}</li>
                                <li><strong>Denominación:</strong> {{ $programa->Denominacion }}</li>
                                <li><strong>Observaciones:</strong> {{ $programa->Observaciones }}</li>
                            </ul>
                            <p class="text-danger">Esta acción no se puede deshacer.</p>
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            <a href="{{ route('programasformacion.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Cancelar
                            </a>
                            <form id="deleteForm" action="{{ route('programasformacion.destroy', $programa->NIS) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <!-- Botón corregido -->
                                <button type="button" id="btnDelete" class="btn btn-danger">
                                    <i class="fas fa-trash"></i> Eliminar
                                </button>
                            </form>
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
        document.addEventListener("DOMContentLoaded", function() {
            const btnDelete = document.getElementById('btnDelete');
            const form = document.getElementById('deleteForm');

            btnDelete.addEventListener('click', function() {
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
                        form.submit(); // envío normal del formulario
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
                title: '¡Eliminado!',
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 2000
            });
        });
    </script>
    @endif

</body>

</html>