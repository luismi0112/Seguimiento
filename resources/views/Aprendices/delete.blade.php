@extends('adminlte::page')

@section('title', 'Eliminar Aprendiz')

@section('content_header')
<h1>Eliminar Aprendiz</h1>
@stop

@section('content')

<div class="card card-danger">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-trash"></i> Confirmar eliminación
        </h3>
    </div>

    <div class="card-body">
        <p><strong>Número Documento:</strong> {{ $aprendiz->Numdoc }}</p>
        <p><strong>Nombres:</strong> {{ $aprendiz->Nombres }}</p>
        <p><strong>Apellidos:</strong> {{ $aprendiz->Apellidos }}</p>
        <p><strong>Correo Institucional:</strong> {{ $aprendiz->CorreoInstitucional }}</p>
        <p><strong>Correo Personal:</strong> {{ $aprendiz->CorreoPersonal ?? '---' }}</p>
        <p><strong>Sexo:</strong> {{ $aprendiz->Sexo == 1 ? 'Masculino' : 'Femenino' }}</p>
        <p><strong>Fecha de Nacimiento:</strong>
            {{ \Carbon\Carbon::parse($aprendiz->FechaNacimiento)->format('d/m/Y') }}
        </p>
        <p><strong>Ficha:</strong> {{ $aprendiz->ficha->Codigo ?? '---' }}</p>

        <hr>

        <p class="text-danger font-weight-bold">
            ¿Estás seguro de que deseas eliminar este aprendiz?
            Esta acción no se puede deshacer.
        </p>
    </div>

    <div class="card-footer d-flex justify-content-between">
        <a href="{{ route('aprendices.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Cancelar
        </a>

        <form id="deleteForm"
            action="{{ route('aprendices.destroy', $aprendiz->NIS) }}"
            method="POST">
            @csrf
            @method('DELETE')

            <button type="submit" class="btn btn-danger">
                <i class="fas fa-trash"></i> Eliminar
            </button>
        </form>
    </div>
</div>

@stop


@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.getElementById('deleteForm').addEventListener('submit', function(e) {

        e.preventDefault();

        Swal.fire({
            title: '¿Estás seguro?',
            text: "Esta acción eliminará el aprendiz definitivamente.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {

            if (result.isConfirmed) {

                fetch(this.action, {
                        method: this.method,
                        body: new FormData(this),
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {

                        if (data.success) {

                            Swal.fire({
                                icon: 'success',
                                title: '¡Eliminado!',
                                text: 'El aprendiz se eliminó correctamente.',
                                showConfirmButton: false,
                                timer: 2000
                            }).then(() => {
                                window.location.href = "{{ route('aprendices.index') }}";
                            });

                        } else {

                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: data.message || 'No se pudo eliminar el aprendiz.',
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

            }

        });

    });
</script>
@stop