<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Regional</title>
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
                        <a href="{{ route('regionales.index') }}" class="nav-link active">
                            <i class="fas fa-map"></i>
                            <p>Regionales</p>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>

    <div class="content-wrapper p-4">
        <section class="content-header">
            <div class="container-fluid">
                <h1>Editar Regional</h1>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-edit"></i> Actualizar Regional</h3>
                    </div>
                    <form id="formRegionalEdit" action="{{ route('regionales.update', $regional->NIS) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="codigo">Código</label>
                                <input type="text" class="form-control" id="codigo" name="Codigo" value="{{ $regional->Codigo }}" required>
                            </div>
                            <div class="form-group">
                                <label for="denominacion">Denominación</label>
                                <input type="text" class="form-control" id="denominacion" name="Denominacion" value="{{ $regional->Denominacion }}" required>
                            </div>
                            <div class="form-group">
                                <label for="observaciones">Observaciones</label>
                                <input type="text" class="form-control" id="observaciones" name="Observaciones" value="{{ $regional->Observaciones }}">
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            <a href="{{ route('regionales.index') }}" class="btn btn-secondary">
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

    <footer class="main-footer text-center">
        <strong>&copy; {{ date('Y') }} Sistema de Seguimiento</strong>
    </footer>
</div>

@vite(['resources/js/app.js','node_modules/admin-lte/dist/js/adminlte.min.js'])

<script>
    document.getElementById('formRegionalEdit').addEventListener('submit', function(e) {
        e.preventDefault();
        let form = this;
        fetch(form.action, {
            method: form.method,
            body: new FormData(form),
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
        })
        .then(response => {
            if (response.ok) {
                Swal.fire({
                    icon: 'success',
                    title: '¡Regional actualizada!',
                    text: 'La regional se modificó correctamente.',
                    showConfirmButton: false,
                    timer: 2000
                }).then(() => {
                    window.location.href = "{{ route('regionales.index') }}";
                });
            }
        });
    });
</script>
</body>
</html>
