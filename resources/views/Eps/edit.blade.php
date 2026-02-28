@extends('adminlte::page')

@section('title', 'Editar EPS')

@section('content_header')
<h1>Editar EPS</h1>
@stop

@section('content')

{{-- Hidden inputs to pass CSRF and flash message safely to JS --}}
<input type="hidden" id="csrfToken" value="{{ csrf_token() }}">
<input type="hidden" id="successMessage" value="{{ session('success') ?? '' }}">

<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-edit"></i> Modificar EPS</h3>
    </div>

    <form id="formEPSEdit" action="{{ route('eps.update', $dato->NIS) }}" method="POST" novalidate>
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
                <label for="numdoc">Número Documento</label>
                <input type="text" class="form-control" id="numdoc" name="Numdoc"
                    value="{{ old('Numdoc', $dato->Numdoc) }}" required>
            </div>

            <div class="form-group">
                <label for="denominacion">Denominación</label>
                <input type="text" class="form-control" id="denominacion" name="Denominacion"
                    value="{{ old('Denominacion', $dato->Denominacion) }}" required>
            </div>

            <div class="form-group">
                <label for="observaciones">Observaciones</label>
                <input type="text" class="form-control" id="observaciones" name="Observaciones"
                    value="{{ old('Observaciones', $dato->Observaciones) }}">
            </div>
        </div>

        <div class="card-footer d-flex justify-content-between">
            <a href="{{ route('eps.index') }}" class="btn btn-secondary">
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
        const form = document.getElementById('formEPSEdit');

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
                            text: data.message || 'Los datos se guardaron correctamente.',
                            showConfirmButton: false,
                            timer: 1600
                        }).then(() => {
                            window.location.href = "{{ route('eps.index') }}";
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
                            text: data && data.message ? data.message : 'No se pudo actualizar la EPS.'
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