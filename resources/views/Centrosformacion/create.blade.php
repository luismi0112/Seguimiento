@extends('adminlte::page')

@section('title', 'Agregar Centro de Formación')

@section('content_header')
    <h1>Agregar Centro de Formación</h1>
@stop

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-plus"></i> Nuevo Centro</h3>
    </div>

    <form id="formCentro" action="{{ route('centrosformacion.store') }}" method="POST" novalidate>
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

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="codigo">Código</label>
                        <input type="text" class="form-control" id="codigo" name="Codigo" value="{{ old('Codigo') }}" required>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="form-group">
                        <label for="denominacion">Denominación</label>
                        <input type="text" class="form-control" id="denominacion" name="Denominacion" value="{{ old('Denominacion') }}" required>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="observaciones">Observaciones</label>
                <input type="text" class="form-control" id="observaciones" name="Observaciones" value="{{ old('Observaciones') }}">
            </div>

            <div class="form-group">
                <label for="regional">Regional</label>
                <select class="form-control" id="regional" name="tblregionales_NIS" required>
                    <option value="">Seleccione una regional</option>
                    @foreach($regionales as $regional)
                        <option value="{{ $regional->NIS }}" {{ old('tblregionales_NIS') == $regional->NIS ? 'selected' : '' }}>
                            {{ $regional->Denominacion }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="card-footer d-flex justify-content-between">
            <a href="{{ route('centrosformacion.index') }}" class="btn btn-secondary">
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
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('formCentro');

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        const formData = new FormData(this);

        fetch(this.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
        })
        .then(async response => {
            const contentType = response.headers.get('content-type') || '';
            if (contentType.includes('application/json')) {
                return response.json();
            }
            // If not JSON, treat 200-299 as success
            return { success: response.ok };
        })
        .then(data => {
            if (data && data.success) {
                Swal.fire({
                    icon: 'success',
                    title: '¡Centro registrado!',
                    text: data.message || 'El centro de formación se guardó correctamente.',
                    showConfirmButton: false,
                    timer: 1600
                }).then(() => {
                    window.location.href = "{{ route('centrosformacion.index') }}";
                });
            } else if (data && data.errors) {
                // Mostrar errores de validación devueltos en JSON
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
                    text: data.message || 'No se pudo registrar el centro.'
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
