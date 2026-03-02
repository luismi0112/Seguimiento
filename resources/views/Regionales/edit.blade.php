@extends('adminlte::page')

@section('title', 'Editar Regional')

@section('content_header')
<h1>Editar Regional</h1>
@stop

@section('content')
<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-edit"></i> Actualizar Regional</h3>
    </div>
    <form id="formRegionalEdit" action="{{ route('regionales.update', $regional->NIS) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="form-group">
                <label for="codigo">Código</label>
                <input type="text" class="form-control" id="codigo" name="Codigo" value="{{ $regional->Codigo }}" required>
            </div>
            <div class="form-group">
                <label for="denominacion">Denominación</label>
                <input type="text" class="form-control" id="denominacion" name="Denominacion" value="{{ $regional->Denominacion }}" required>
            </div>
            <div class="form-group">
                <label for="observaciones">Observaciones</label>
                <input type="text" class="form-control" id="observaciones" name="Observaciones" value="{{ $regional->Observaciones }}">
            </div>
        </div>
        <div class="card-footer d-flex justify-content-between">
            <a href="{{ route('regionales.index') }}" class="btn btn-secondary">
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
    document.getElementById('formRegionalEdit').addEventListener('submit', function(e) {
        e.preventDefault();
        let form = this;
        fetch(form.action, {
                method: form.method,
                body: new FormData(form),
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => {
                if (response.ok) {
                    Swal.fire({
                        icon: 'success',
                        title: '¡Regional actualizada!',
                        text: 'La regional se modificó correctamente.',
                        showConfirmButton: false,
                        timer: 2000
                    }).then(() => {
                        window.location.href = "{{ route('regionales.index') }}";
                    });
                }
            });
    });
</script>
@stop