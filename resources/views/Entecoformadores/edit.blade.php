<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Ente Coformador</title>
    @vite(['resources/css/app.css','node_modules/admin-lte/dist/css/adminlte.min.css'])
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link" data-widget="pushmenu" href="#">&#9776;</a></li>
            <li class="nav-item d-none d-sm-inline-block"><a href="/" class="nav-link">Inicio</a></li>
        </ul>
    </nav>

    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="/" class="brand-link"><span class="brand-text font-weight-light">AdminLTE Laravel</span></a>
        <div class="sidebar">
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column">
                    <li class="nav-item">
                        <a href="{{ route('entecoformadores.index') }}" class="nav-link active">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Entes Coformadores</p>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>

    <div class="content-wrapper p-4">
        <section class="content-header">
            <h1>Editar Ente Coformador</h1>
        </section>

        <section class="content">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-edit"></i> Editar Ente</h3>
                </div>
                <form action="{{ route('entecoformadores.update', $dato->NIS) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="tdoc">Tipo Documento</label>
                            <select class="form-control" id="tdoc" name="Tdoc" required>
                                @foreach($tiposDocumento as $tipo)
                                    <option value="{{ $tipo->NIS }}" {{ $dato->Tdoc == $tipo->NIS ? 'selected' : '' }}>
                                        {{ $tipo->Denominacion }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="numdoc">Número Documento</label>
                            <input type="number" class="form-control" id="numdoc" name="Numdoc" value="{{ $dato->Numdoc }}" required>
                        </div>
                        <div class="form-group">
                            <label for="nombres">Nombres</label>
                            <input type="text" class="form-control" id="nombres" name="Nombres" value="{{ $dato->Nombres }}" maxlength="100">
                        </div>
                        <div class="form-group">
                            <label for="razonSocial">Razón Social</label>
                            <input type="text" class="form-control" id="razonSocial" name="RazonSocial" value="{{ $dato->RazonSocial }}" maxlength="100">
                        </div>
                        <div class="form-group">
                            <label for="direccion">Dirección</label>
                            <input type="text" class="form-control" id="direccion" name="Direccion" value="{{ $dato->Direccion }}" maxlength="200">
                        </div>
                        <div class="form-group">
                            <label for="telefono">Teléfono</label>
                            <input type="text" class="form-control" id="telefono" name="Telefono" value="{{ $dato->Telefono }}" maxlength="50">
                        </div>
                        <div class="form-group">
                            <label for="correoInstitucional">Correo Institucional</label>
                            <input type="email" class="form-control" id="correoInstitucional" name="CorreoInstitucional" value="{{ $dato->CorreoInstitucional }}" maxlength="50">
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <a href="{{ route('entecoformadores.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Volver
                        </a>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save"></i> Actualizar
                        </button>
                    </div>
                </form>
            </div>
        </section>
    </div>
</div>

@vite(['resources/js/app.js','node_modules/admin-lte/dist/js/adminlte.min.js'])
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

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

</body>
</html>
