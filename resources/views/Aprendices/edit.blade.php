@extends('adminlte::page')

@section('title', 'Editar Aprendiz')

@section('content_header')
<h1>Editar Aprendiz</h1>
@stop

@section('content')

<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-user-edit"></i> Modificar Datos
        </h3>
    </div>

    <form id="formAprendizEdit" action="{{ route('aprendices.update', $aprendiz->NIS) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="card-body">

            <div class="form-group">
                <label>Tipo de Documento</label>
                <select class="form-control" name="tbltiposdocumentos_NIS" required>
                    @foreach($tiposdocumentos as $tipo)
                    <option value="{{ $tipo->NIS }}"
                        {{ $aprendiz->tbltiposdocumentos_NIS == $tipo->NIS ? 'selected' : '' }}>
                        {{ $tipo->Denominacion }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Número de Documento</label>
                <input type="text" class="form-control" name="Numdoc"
                    value="{{ $aprendiz->Numdoc }}" required>
            </div>

            <div class="form-group">
                <label>Nombres</label>
                <input type="text" class="form-control" name="Nombres"
                    value="{{ $aprendiz->Nombres }}" required>
            </div>

            <div class="form-group">
                <label>Apellidos</label>
                <input type="text" class="form-control" name="Apellidos"
                    value="{{ $aprendiz->Apellidos }}" required>
            </div>

            <div class="form-group">
                <label>Dirección</label>
                <input type="text" class="form-control" name="Direccion"
                    value="{{ $aprendiz->Direccion }}">
            </div>

            <div class="form-group">
                <label>Teléfono</label>
                <input type="text" class="form-control" name="Telefono"
                    value="{{ $aprendiz->Telefono }}">
            </div>

            <div class="form-group">
                <label>Correo Institucional</label>
                <input type="email" class="form-control" name="CorreoInstitucional"
                    value="{{ $aprendiz->CorreoInstitucional }}" required>
            </div>

            <div class="form-group">
                <label>Correo Personal</label>
                <input type="email" class="form-control" name="CorreoPersonal"
                    value="{{ $aprendiz->CorreoPersonal }}">
            </div>

            <div class="form-group">
                <label>Sexo</label>
                <select class="form-control" name="Sexo" required>
                    <option value="1" {{ $aprendiz->Sexo == 1 ? 'selected' : '' }}>Masculino</option>
                    <option value="2" {{ $aprendiz->Sexo == 2 ? 'selected' : '' }}>Femenino</option>
                </select>
            </div>

            <div class="form-group">
                <label>Fecha de Nacimiento</label>
                <input type="date" class="form-control" name="FechaNacimiento"
                    value="{{ $aprendiz->FechaNacimiento }}" required>
            </div>

            <div class="form-group">
                <label>Ficha</label>
                <select class="form-control" name="tblfichasdecaracterizacion_NIS" required>
                    @foreach($fichas as $ficha)
                    <option value="{{ $ficha->NIS }}"
                        {{ $aprendiz->tblfichasdecaracterizacion_NIS == $ficha->NIS ? 'selected' : '' }}>
                        {{ $ficha->Codigo }}
                    </option>
                    @endforeach
                </select>
            </div>

        </div>

        <div class="card-footer d-flex justify-content-between">
            <a href="{{ route('aprendices.index') }}" class="btn btn-secondary">
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
    document.getElementById('formAprendizEdit').addEventListener('submit', function(e) {
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
                        title: '¡Aprendiz actualizado!',
                        text: 'Los datos se guardaron correctamente.',
                        showConfirmButton: false,
                        timer: 2000
                    }).then(() => {
                        window.location.href = "{{ route('aprendices.index') }}";
                    });

                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: data.message || 'No se pudo actualizar el aprendiz.',
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