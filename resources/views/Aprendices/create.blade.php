@extends('adminlte::page')

@section('title', 'Agregar Aprendiz')

@section('content_header')
<h1>Agregar Nuevo Aprendiz</h1>
@stop

@section('content')

<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-user-plus"></i> Nuevo Aprendiz
        </h3>
    </div>

    <form id="formAprendiz" action="{{ route('aprendices.store') }}" method="POST">
        @csrf

        <div class="card-body">

            <div class="form-group">
                <label>Tipo Documento</label>
                <select class="form-control" name="tbltiposdocumentos_NIS" required>
                    <option value="">Seleccione un tipo</option>
                    @foreach($tiposdocumentos as $doc)
                    <option value="{{ $doc->NIS }}">{{ $doc->Denominacion }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Número Documento</label>
                <input type="text" class="form-control" name="Numdoc" required>
            </div>

            <div class="form-group">
                <label>Nombres</label>
                <input type="text" class="form-control" name="Nombres" required>
            </div>

            <div class="form-group">
                <label>Apellidos</label>
                <input type="text" class="form-control" name="Apellidos" required>
            </div>

            <div class="form-group">
                <label>Dirección</label>
                <input type="text" class="form-control" name="Direccion">
            </div>

            <div class="form-group">
                <label>Teléfono</label>
                <input type="text" class="form-control" name="Telefono">
            </div>

            <div class="form-group">
                <label>Correo Institucional</label>
                <input type="email" class="form-control" name="CorreoInstitucional" required>
            </div>

            <div class="form-group">
                <label>Correo Personal</label>
                <input type="email" class="form-control" name="CorreoPersonal">
            </div>

            <div class="form-group">
                <label>Sexo</label>
                <select class="form-control" name="Sexo" required>
                    <option value="1">Masculino</option>
                    <option value="2">Femenino</option>
                </select>
            </div>

            <div class="form-group">
                <label>Fecha de Nacimiento</label>
                <input type="date" class="form-control" name="FechaNacimiento" required>
            </div>

            <div class="form-group">
                <label>Ficha</label>
                <select class="form-control" name="tblfichasdecaracterizacion_NIS" required>
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

@stop


@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
@stop   