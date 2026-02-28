@extends('adminlte::page')

@section('title', 'Editar Ficha de Caracterización')

@section('content_header')
<h1>Editar Ficha de Caracterización</h1>
@stop

@section('content')

{{-- Hidden inputs to pass CSRF, flash message and redirect URL safely to JS --}}
<input type="hidden" id="csrfToken" value="{{ csrf_token() }}">
<input type="hidden" id="successMessage" value="{{ session('success') ?? '' }}">
<input type="hidden" id="indexUrl" value="{{ route('fichas.index') }}">

<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-edit"></i> Modificar Ficha</h3>
    </div>

    <form id="formFichaEdit" action="{{ route('fichas.update', $dato->NIS) }}" method="POST" novalidate>
        @csrf
        @method('PUT')

        <div class="card-body">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="form-group">
                <label for="codigo">Código</label>
                <input type="number" class="form-control" id="codigo" name="Codigo"
                    value="{{ old('Codigo', $dato->Codigo) }}" required aria-required="true">
            </div>

            <div class="form-group">
                <label for="denominacion">Denominación</label>
                <input type="text" class="form-control" id="denominacion" name="Denominacion"
                    value="{{ old('Denominacion', $dato->Denominacion) }}" maxlength="100" required aria-required="true">
            </div>

            <div class="form-group">
                <label for="cupo">Cupo</label>
                <input type="number" class="form-control" id="cupo" name="Cupo"
                    value="{{ old('Cupo', $dato->Cupo) }}" required aria-required="true">
            </div>

            <div class="form-group">
                <label for="fechainicio">Fecha Inicio</label>
                <input type="date" class="form-control" id="fechainicio" name="Fechainicio"
                    value="{{ old('Fechainicio', $dato->Fechainicio) }}" required aria-required="true">
            </div>

            <div class="form-group">
                <label for="fechafin">Fecha Fin</label>
                <input type="date" class="form-control" id="fechafin" name="Fechafin"
                    value="{{ old('Fechafin', $dato->Fechafin) }}" required aria-required="true">
            </div>

            <div class="form-group">
                <label for="observaciones">Observaciones</label>
                <textarea class="form-control" id="observaciones" name="Observaciones" rows="3" maxlength="200">{{ old('Observaciones', $dato->Observaciones) }}</textarea>
            </div>

            <div class="form-group">
                <label for="programa">Programa de Formación</label>
                <select class="form-control" id="programa" name="tblprogramasdeformacion_NIS" required aria-required="true">
                    <option value="">Seleccione un programa</option>
                    @foreach($programas as $programa)
                    <option value="{{ $programa->NIS }}" {{ (old('tblprogramasdeformacion_NIS', $dato->tblprogramasdeformacion_NIS) == $programa->NIS) ? 'selected' : '' }}>
                        {{ $programa->Denominacion }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="centro">Centro de Formación</label>
                <select class="form-control" id="centro" name="tblcentrosdeformacion_NIS" required aria-required="true">
                    <option value="">Seleccione un centro</option>
                    @foreach($centros as $centro)
                    <option value="{{ $centro->NIS }}" {{ (old('tblcentrosdeformacion_NIS', $dato->tblcentrosdeformacion_NIS) == $centro->NIS) ? 'selected' : '' }}>
                        {{ $centro->Denominacion }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="card-footer d-flex justify-content-between">
            <a href="{{ route('fichas.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Volver
            </a>

            <div>
                <button type="reset" class="btn btn-outline-secondary me-2">
                    <i class="fas fa-undo"></i> Limpiar
                </button>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Actualizar
                </button>
            </div>
        </div>
    </form>
</div>

@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const successMessage = (document.getElementById('successMessage') || {}).value || '';
        const csrfToken = (document.getElementById('csrfToken') || {}).value || '';
        const indexUrl = (document.getElementById('indexUrl') || {}).value || '/';
        const form = document.getElementById('formFichaEdit');

        if (successMessage.trim()) {
            Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: successMessage,
                showConfirmButton: false,
                timer: 2000
            });
        }

        form.addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);

            fetch(this.action, {
                    method: 'POST', // Laravel expects POST with _method=PUT
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                })
                .then(async response => {
                    const contentType = response.headers.get('content-type') || '';
                    if (contentType.includes('application/json')) {
                        return response.json();
                    }
                    return {
                        success: response.ok
                    };
                })
                .then(data => {
                    if (data && data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: '¡Actualizado!',
                            text: data.message || 'La ficha se actualizó correctamente.',
                            showConfirmButton: false,
                            timer: 1600
                        }).then(() => {
                            window.location.href = indexUrl;
                        });
                    } else if (data && data.errors) {
                        const messages = Object.values(data.errors).flat().join('<br>');
                        Swal.fire({
                            icon: 'error',
                            title: 'Errores de validación',
                            html: messages
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: data && data.message ? data.message : 'No se pudo actualizar la ficha.'
                        });
                    }
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
    });
</script>
@stop