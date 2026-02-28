@extends('adminlte::page')

@section('title', 'Agregar Ente Coformador')

@section('content_header')
<h1>Agregar Ente Coformador</h1>
@stop

@section('content')

{{-- Hidden fields to pass CSRF and flash message safely --}}
<input type="hidden" id="csrfToken" value="{{ csrf_token() }}">
<input type="hidden" id="successMessage" value="{{ session('success') ?? '' }}">

<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-plus"></i> Nuevo Ente</h3>
    </div>

    <form id="formEnteCreate" action="{{ route('entecoformadores.store') }}" method="POST" novalidate>
        @csrf

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
                <label for="tdoc">Tipo Documento</label>
                <select class="form-control" id="tdoc" name="Tdoc" required>
                    <option value="">Seleccione...</option>
                    @foreach($tiposDocumento as $tipo)
                    @php
                    $tipoId = $tipo->id ?? $tipo->NIS;
                    $tipoLabel = $tipo->Denominacion ?? $tipo->nombre ?? $tipoId;
                    @endphp
                    <option value="{{ $tipoId }}" {{ old('Tdoc') == $tipoId ? 'selected' : '' }}>
                        {{ $tipoLabel }}
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

            <div>
                <button type="reset" class="btn btn-outline-secondary me-2">
                    <i class="fas fa-undo"></i> Limpiar
                </button>

                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i> Guardar
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
        // Show flash message if present (read from hidden input to avoid Blade inside JS)
        const successInput = document.getElementById('successMessage');
        const successMessage = successInput ? successInput.value.trim() : '';

        if (successMessage) {
            Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: successMessage,
                showConfirmButton: false,
                timer: 2000
            });
        }

        const form = document.getElementById('formEnteCreate');

        form.addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            const csrfToken = document.getElementById('csrfToken').value;

            fetch(this.action, {
                    method: 'POST',
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
                            title: '¡Creado!',
                            text: data.message || 'El ente coformador se creó correctamente.',
                            showConfirmButton: false,
                            timer: 1600
                        }).then(() => {
                            window.location.href = "{{ route('entecoformadores.index') }}";
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
                            text: data && data.message ? data.message : 'No se pudo crear el ente.'
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