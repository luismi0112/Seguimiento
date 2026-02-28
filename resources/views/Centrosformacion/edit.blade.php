<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Editar Centro de Formación</title>
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
                            <a href="{{ route('centrosformacion.index') }}" class="nav-link active">
                                <i class="fas fa-school"></i>
                                <p>Centros Formación</p>
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
                    <h1>Editar Centro de Formación</h1>
                </div>
            </section>

            <section class="content">
                <div class="container-fluid">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-edit"></i> Modificar Centro</h3>
                        </div>
                        <form id="formCentro" action="{{ route('centrosformacion.update', $dato->NIS) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="codigo">Código</label>
                                    <input type="text" class="form-control" id="codigo" name="Codigo"
                                        value="{{ $dato->Codigo }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="denominacion">Denominación</label>
                                    <input type="text" class="form-control" id="denominacion" name="Denominacion"
                                        value="{{ $dato->Denominacion }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="observaciones">Observaciones</label>
                                    <input type="text" class="form-control" id="observaciones" name="Observaciones"
                                        value="{{ $dato->Observaciones }}">
                                </div>
                                <div class="form-group">
                                    <label for="regional">Regional</label>
                                    <select class="form-control" id="regional" name="tblregionales_NIS" required>
                                        <option value="">Seleccione una regional</option>
                                        @foreach($regionales as $regional)
                                        <option value="{{ $regional->NIS }}"
                                            {{ $dato->tblregionales_NIS == $regional->NIS ? 'selected' : '' }}>
                                            {{ $regional->Denominacion }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-between">
                                <a href="{{ route('centrosformacion.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Volver
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Actualizar
                                </button>
                            </div>
                        </form>
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
        document.getElementById('formCentro').addEventListener('submit', function(e) {
            e.preventDefault();
            let form = this;
            fetch(form.action, {
                    method: form.method,
                    body: new FormData(form),
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: '¡Centro actualizado!',
                            text: 'Los datos se guardaron correctamente.',
                            showConfirmButton: false,
                            timer: 2000
                        }).then(() => {
                            window.location.href = "{{ route('centrosformacion.index') }}";
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: data.message || 'No se pudo actualizar el centro.',
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
        });
    </script>
</body>

</html>