<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Instructor</title>

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
                    <h1>Eliminar Instructor</h1>
                </div>
            </section>

            <section class="content">
                <div class="container-fluid">
                    <div class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-exclamation-triangle"></i> Confirmar Eliminación
                            </h3>
                        </div>
                        <div class="card-body text-center">
                            <p class="lead">¿Estás seguro de que deseas eliminar al instructor?</p>
                            <h4 class="text-bold">
                                {{ $instructor->Nombres }} {{ $instructor->Apellidos }}
                            </h4>
                            <p class="text-muted">Esta acción es irreversible y eliminará todos los datos asociados.</p>
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            <a href="{{ route('instructores.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Cancelar y Volver
                            </a>

                            <form id="deleteForm" action="{{ route('instructores.destroy', $instructor->NIS) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button type="button" onclick="confirmarBorrado()" class="btn btn-danger">
                                    <i class="fas fa-trash"></i> Eliminar Definitivamente
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>

    </div>

    @vite(['node_modules/admin-lte/dist/js/adminlte.min.js'])

    <script>
        /**
         * Función para disparar la alerta de confirmación
         */
        function confirmarBorrado() {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "No podrás revertir esta acción una vez confirmada.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33', // Rojo peligro
                cancelButtonColor: '#6c757d', // Gris neutro
                confirmButtonText: '<i class="fas fa-trash"></i> Sí, eliminar instructor',
                cancelButtonText: 'No, cancelar',
                reverseButtons: true,
                focusCancel: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Si el usuario confirma, enviamos el formulario manualmente
                    document.getElementById('deleteForm').submit();
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    // Opcional: Mostrar un mensaje de que se canceló la acción
                    Swal.fire({
                        title: 'Cancelado',
                        text: 'El registro está a salvo.',
                        icon: 'info',
                        timer: 1500,
                        showConfirmButton: false
                    });
                }
            });
        }
    </script>

    {{-- Script para mostrar mensaje de éxito si existe en la sesión --}}
    @if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: '¡Operación Exitosa!',
            text: "{{ session('success') }}",
            timer: 3000,
            showConfirmButton: false
        });
    </script>
    @endif

</body>

</html>