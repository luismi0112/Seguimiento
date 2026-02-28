@extends('adminlte::page')

@section('title', 'Editar Instructor')

@section('content_header')
<h1>Editar Instructor</h1>
@stop

@section('content')

<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-user-edit"></i> Modificar Datos
        </h3>
    </div>

    <form id="formInstructorEdit" action="{{ route('instructores.update', $instructor->NIS) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="card-body">

            <div class="form-group">
                <label>Número Documento</label>
                <input type="number" class="form-control" name="Numdoc"
                    value="{{ $instructor->Numdoc }}" required>
            </div>

            <div class="form-group">
                <label>Nombres</label>
                <input type="text" class="form-control" name="Nombres"
                    value="{{ $instructor->Nombres }}" maxlength="100" required>
            </div>

            <div class="form-group">
                <label>Apellidos</label>
                <input type="text" class="form-control" name="Apellidos"
                    value="{{ $instructor->Apellidos }}" maxlength="100" required>
            </div>

            <div class="form-group">
                <label>Dirección</label>
                <input type="text" class="form-control" name="Direccion"
                    value="{{ $instructor->Direccion }}" maxlength="200">
            </div>

            <div class="form-group">
                <label>Teléfono</label>
                <input type="text" class="form-control" name="Telefono"
                    value="{{ $instructor->Telefono }}" maxlength="50">
            </div>

            <div class="form-group">
                <label>Fecha de Nacimiento</label>
                <input type="date" class="form-control" name="FechaNacimiento"
                    value="{{ $instructor->FechaNacimiento }}">
            </div>

            <div class="form-group">
                <label>Correo Institucional</label>
                <input type="email" class="form-control" name="CorreoInstitucional"
                    value="{{ $instructor->CorreoInstitucional }}" maxlength="50">
            </div>

            <div class="form-group">
                <label>Correo Personal</label>
                <input type="email" class="form-control" name="CorreoPersonal"
                    value="{{ $instructor->CorreoPersonal }}" maxlength="50">
            </div>

            <div class="form-group">
                <label>Sexo</label>
                <select class="form-control" name="Sexo" required>
                    <option value="1" {{ $instructor->Sexo == 1 ? 'selected' : '' }}>Masculino</option>
                    <option value="2" {{ $instructor->Sexo == 2 ? 'selected' : '' }}>Femenino</option>
                </select>
            </div>

            <div class="form-group">
                <label>EPS</label>
                <select class="form-control" name="tbleps_NIS" required>
                    @foreach($eps as $item)
                    <option value="{{ $item->NIS }}" {{ $instructor->tbleps_NIS == $item->NIS ? 'selected' : '' }}>
                        {{ $item->Denominacion }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Rol Administrativo</label>
                <select class="form-control" name="tblrolesadministrativos_NIS" required>
                    <option value="1" {{ $instructor->tblrolesadministrativos_NIS == 1 ? 'selected' : '' }}>Coordinador Académico</option>
                    <option value="2" {{ $instructor->tblrolesadministrativos_NIS == 2 ? 'selected' : '' }}>Director de Centro</option>
                    <option value="3" {{ $instructor->tblrolesadministrativos_NIS == 3 ? 'selected' : '' }}>Subdirector Administrativo</option>
                    <option value="4" {{ $instructor->tblrolesadministrativos_NIS == 4 ? 'selected' : '' }}>Jefe de Programa</option>
                    <option value="5" {{ $instructor->tblrolesadministrativos_NIS == 5 ? 'selected' : '' }}>Asistente de Formación</option>
                </select>
            </div>

        </div>

        <div class="card-footer d-flex justify-content-between">
            <a href="{{ route('instructores.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Volver
            </a>

            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Actualizar
            </button>
        </div>

    </form>
</div>

@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.getElementById('formInstructorEdit').addEventListener('submit', function(e) {
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
                        title: '¡Instructor actualizado!',
                        text: 'Los datos se guardaron correctamente.',
                        showConfirmButton: false,
                        timer: 2000
                    }).then(() => {
                        window.location.href = "{{ route('instructores.index') }}";
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: data.message || 'No se pudo actualizar el instructor.',
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
@stop