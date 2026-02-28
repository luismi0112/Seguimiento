<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Agregar Ente Coformador</title>
    @vite(['resources/css/app.css','node_modules/admin-lte/dist/css/adminlte.min.css'])
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <div class="content-wrapper p-4">
            <section class="content-header">
                <h1>Agregar Ente Coformador</h1>
            </section>

            <section class="content">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-plus"></i> Nuevo Ente</h3>
                    </div>

                    @if ($errors->any())
                    <div class="m-3">
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    @endif

                    <form action="{{ route('entecoformadores.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="tdoc">Tipo Documento</label>
                                <select class="form-control" id="tdoc" name="Tdoc" required>
                                    <option value="">Seleccione...</option>
                                    @foreach($tiposDocumento as $tipo)
                                    <option value="{{ $tipo->id ?? $tipo->NIS }}" {{ old('Tdoc') == ($tipo->id ?? $tipo->NIS) ? 'selected' : '' }}>
                                        {{ $tipo->Denominacion ?? $tipo->nombre ?? ($tipo->id ?? $tipo->NIS) }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="numdoc">Número Documento</label>
                                <input type="number" class="form-control" id="numdoc" name="Numdoc" value="{{ old('Numdoc') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="nombres">Nombres</label>
                                <input type="text" class="form-control" id="nombres" name="Nombres" value="{{ old('Nombres') }}" maxlength="100">
                            </div>

                            <div class="form-group">
                                <label for="razonSocial">Razón Social</label>
                                <input type="text" class="form-control" id="razonSocial" name="RazonSocial" value="{{ old('RazonSocial') }}" maxlength="100">
                            </div>

                            <div class="form-group">
                                <label for="direccion">Dirección</label>
                                <input type="text" class="form-control" id="direccion" name="Direccion" value="{{ old('Direccion') }}" maxlength="200">
                            </div>

                            <div class="form-group">
                                <label for="telefono">Teléfono</label>
                                <input type="text" class="form-control" id="telefono" name="Telefono" value="{{ old('Telefono') }}" maxlength="50">
                            </div>

                            <div class="form-group">
                                <label for="correoInstitucional">Correo Institucional</label>
                                <input type="email" class="form-control" id="correoInstitucional" name="CorreoInstitucional" value="{{ old('CorreoInstitucional') }}" maxlength="50">
                            </div>
                        </div>

                        <div class="card-footer d-flex justify-content-between">
                            <a href="{{ route('entecoformadores.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Volver
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save"></i> Guardar
                            </button>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>
</body>

</html>