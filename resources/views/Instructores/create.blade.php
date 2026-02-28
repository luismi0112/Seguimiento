@extends('adminlte::page')

@section('title', 'Agregar Instructor')

@section('content_header')
<h1>Agregar Instructor</h1>
@stop

@section('content')

<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-plus"></i> Nuevo Instructor</h3>
    </div>

    <form id="formInstructorCreate" action="{{ route('instructores.store') }}" method="POST">
        @csrf

        <div class="card-body">

            <div class="form-group">
                <label for="numdoc">Número Documento</label>
                <input id="numdoc" type="number" class="form-control" name="Numdoc" value="{{ old('Numdoc') }}" required>
            </div>

            <div class="form-group">
                <label for="nombres">Nombres</label>
                <input id="nombres" type="text" class="form-control" name="Nombres" value="{{ old('Nombres') }}" maxlength="100" required>
            </div>

            <div class="form-group">
                <label for="apellidos">Apellidos</label>
                <input id="apellidos" type="text" class="form-control" name="Apellidos" value="{{ old('Apellidos') }}" maxlength="100" required>
            </div>

            <div class="form-group">
                <label for="direccion">Dirección</label>
                <input id="direccion" type="text" class="form-control" name="Direccion" value="{{ old('Direccion') }}" maxlength="200">
            </div>

            <div class="form-group">
                <label for="telefono">Teléfono</label>
                <input id="telefono" type="text" class="form-control" name="Telefono" value="{{ old('Telefono') }}" maxlength="50">
            </div>

            <div class="form-group">
                <label for="correoInstitucional">Correo Institucional</label>
                <input id="correoInstitucional" type="email" class="form-control" name="CorreoInstitucional" value="{{ old('CorreoInstitucional') }}" maxlength="50">
            </div>

            <div class="form-group">
                <label for="correoPersonal">Correo Personal</label>
                <input id="correoPersonal" type="email" class="form-control" name="CorreoPersonal" value="{{ old('CorreoPersonal') }}" maxlength="50">
            </div>

            <div class="form-group">
                <label for="sexo">Sexo</label>
                <select id="sexo" class="form-control" name="Sexo" required>
                    <option value="">Seleccione</option>
                    <option value="1" {{ old('Sexo') == '1' ? 'selected' : '' }}>Masculino</option>
                    <option value="2" {{ old('Sexo') == '2' ? 'selected' : '' }}>Femenino</option>
                </select>
            </div>

            <div class="form-group">
                <label for="fechaNacimiento">Fecha de Nacimiento</label>
                <input id="fechaNacimiento" type="date" class="form-control" name="FechaNacimiento" value="{{ old('FechaNacimiento') }}">
            </div>

            <div class="form-group">
                <label for="eps">EPS</label>
                <select id="eps" class="form-control" name="tbleps_NIS" required>
                    <option value="">Seleccione una EPS</option>
                    @foreach($eps as $item)
                    <option value="{{ $item->NIS }}" {{ old('tbleps_NIS') == $item->NIS ? 'selected' : '' }}>
                        {{ $item->Denominacion }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="rolAdmin">Rol Administrativo</label>
                <select id="rolAdmin" class="form-control" name="tblrolesadministrativos_NIS" required>
                    <option value="">Seleccione un rol</option>
                    <option value="1" {{ old('tblrolesadministrativos_NIS') == '1' ? 'selected' : '' }}>Coordinador Académico</option>
                    <option value="2" {{ old('tblrolesadministrativos_NIS') == '2' ? 'selected' : '' }}>Director de Centro</option>
                    <option value="3" {{ old('tblrolesadministrativos_NIS') == '3' ? 'selected' : '' }}>Subdirector Administrativo</option>
                    <option value="4" {{ old('tblrolesadministrativos_NIS') == '4' ? 'selected' : '' }}>Jefe de Programa</option>
                    <option value="5" {{ old('tblrolesadministrativos_NIS') == '5' ? 'selected' : '' }}>Asistente de Formación</option>
                </select>
            </div>

        </div>

        <div class="card-footer d-flex justify-content-between">
            <a href="{{ route('instructores.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Volver
            </a>

            <button type="submit" class="btn btn-success">
                <i class="fas fa-save"></i> Guardar
            </button>
        </div>
    </form>
</div>

@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.getElementById('formInstructorCreate').addEventListener('submit', function(e) {
        e.preventDefault();

        const form = this;
        const url = form.action;
        const token = '{{ csrf_token() }}';

        fetch(url, {
                method: form.method.toUpperCase(),
                body: new FormData(form),
                headers: {
                    'X-CSRF-TOKEN': token,
                    'Accept': 'application/json'
                }
            })
            .then(async response => {
                const contentType = response.headers.get('content-type') || '';
                if (contentType.includes('application/json')) {
                    return response.json();
                }
                // If not JSON, treat non-error HTTP as success
                return {
                    success: response.ok
                };
            })
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: '¡Instructor registrado!',
                        text: data.message || 'El instructor se guardó correctamente.',
                        showConfirmButton: false,
                        timer: 1800
                    }).then(() => {
                        window.location.href = "{{ route('instructores.index') }}";
                    });
                    return;
                }

                // Validation errors (Laravel returns errors object)
                if (data.errors) {
                    const messages = Object.values(data.errors).flat().join('<br>');
                    Swal.fire({
                        icon: 'error',
                        title: 'Errores de validación',
                        html: messages
                    });
                    return;
                }

                // Generic error
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: data.message || 'No se pudo registrar el instructor.'
                });
            })
            .catch(error => {
                console.error(error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Ocurrió un problema al procesar la solicitud.'
                });
            });
    });
</script>
@stop