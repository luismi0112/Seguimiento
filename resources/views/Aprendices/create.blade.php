<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Agregar Aprendiz</title>
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
                    <h1>Agregar Nuevo Aprendiz</h1>
                </div>
            </section>

            <section class="content">
                <div class="container-fluid">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-plus"></i> Nuevo Aprendiz</h3>
                        </div>
                        <form id="formAprendiz" action="{{ route('aprendices.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="tipoDocumento">Tipo Documento</label>
                                    <select class="form-control" id="tipoDocumento" name="tbltiposdocumentos_NIS" required>
                                        <option value="">Seleccione un tipo</option>
                                        @foreach($tiposdocumentos as $doc)
                                        <option value="{{ $doc->NIS }}">{{ $doc->Denominacion }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="Numdoc">Número Documento</label>
                                    <input type="text" class="form-control" id="Numdoc" name="Numdoc" required>
                                </div>
                                <div class="form-group">
                                    <label for="Nombres">Nombres</label>
                                    <input type="text" class="form-control" id="Nombres" name="Nombres" required>
                                </div>
                                <div class="form-group">
                                    <label for="Apellidos">Apellidos</label>
                                    <input type="text" class="form-control" id="Apellidos" name="Apellidos" required>
                                </div>
                                <div class="form-group">
                                    <label for="Direccion">Dirección</label>
                                    <input type="text" class="form-control" id="Direccion" name="Direccion">
                                </div>
                                <div class="form-group">
                                    <label for="Telefono">Teléfono</label>
                                    <input type="text" class="form-control" id="Telefono" name="Telefono">
                                </div>
                                <div class="form-group">
                                    <label for="CorreoInstitucional">Correo Institucional</label>
                                    <input type="email" class="form-control" id="CorreoInstitucional" name="CorreoInstitucional" required>
                                </div>
                                <div class="form-group">
                                    <label for="CorreoPersonal">Correo Personal</label>
                                    <input type="email" class="form-control" id="CorreoPersonal" name="CorreoPersonal">
                                </div>
                                <div class="form-group">
                                    <label for="Sexo">Sexo</label>
                                    <select class="form-control" id="Sexo" name="Sexo" required>
                                        <option value="1">Masculino</option>
                                        <option value="2">Femenino</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="FechaNacimiento">Fecha de Nacimiento</label>
                                    <input type="date" class="form-control" id="FechaNacimiento" name="FechaNacimiento" required>
                                </div>
                                <div class="form-group">
                                    <label for="Ficha">Ficha</label>
                                    <select class="form-control" id="Ficha" name="tblfichasdecaracterizacion_NIS" required>
                                        <option value="">Seleccione una ficha</option>
                                        @foreach($fichas as $ficha)
                                        <option value="{{ $ficha->NIS }}">{{ $ficha->Codigo }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-between">
                                <a href="{{ route('aprendices.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Volver
                                </a>
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-save"></i> Guardar
                                </button>
                            </div>
                        </form>
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
        document.getElementById('formAprendiz').addEventListener('submit', function(e) {
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
                            title: '¡Aprendiz registrado!',
                            text: 'El aprendiz se guardó correctamente.',
                            showConfirmButton: false,
                            timer: 2000
                        }).then(() => {
                            window.location.href = "{{ route('aprendices.index') }}";
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: data.message || 'No se pudo registrar el aprendiz.',
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