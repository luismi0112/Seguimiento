@extends('adminlte::page')

@section('title', 'Eliminar Instructor')

@section('content_header')
    <h1>Eliminar Instructor</h1>
@stop

@section('content')

<div class="card card-danger">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-trash"></i> Confirmar eliminación
        </h3>
    </div>

    <div class="card-body">
        <p><strong>Número Documento:</strong> {{ $instructor->Numdoc }}</p>
        <p><strong>Nombres:</strong> {{ $instructor->Nombres }}</p>
        <p><strong>Apellidos:</strong> {{ $instructor->Apellidos }}</p>
        <p><strong>Correo Institucional:</strong> {{ $instructor->CorreoInstitucional }}</p>
        <p><strong>Correo Personal:</strong> {{ $instructor->CorreoPersonal ?? '---' }}</p>
        <p><strong>Sexo:</strong> {{ $instructor->Sexo == 1 ? 'Masculino' : 'Femenino' }}</p>
        <p><strong>Fecha de Nacimiento:</strong>
            {{ \Carbon\Carbon::parse($instructor->FechaNacimiento)->format('d/m/Y') }}
        </p>
        <p><strong>EPS:</strong> {{ $instructor->eps->Denominacion ?? '---' }}</p>
        <p><strong>Rol Administrativo:</strong> 
            @switch($instructor->tblrolesadministrativos_NIS)
                @case(1) Coordinador Académico @break
                @case(2) Director de Centro @break
                @case(3) Subdirector Administrativo @break
                @case(4) Jefe de Programa @break
                @case(5) Asistente de Formación @break
                @default ---
            @endswitch
        </p>

        <hr>

        <p class="text-danger font-weight-bold">
            ¿Estás seguro de que deseas eliminar este instructor?
            Esta acción no se puede deshacer.
        </p>
    </div>

    <div class="card-footer d-flex justify-content-between">
        <a href="{{ route('instructores.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Cancelar
        </a>

        <form id="deleteForm"
              action="{{ route('instructores.destroy', $instructor->NIS) }}"
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
        text: "Esta acción eliminará el instructor definitivamente.",
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
                        text: 'El instructor se eliminó correctamente.',
                        showConfirmButton: false,
                        timer: 2000
                    }).then(() => {
                        window.location.href = "{{ route('instructores.index') }}";
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: data.message || 'No se pudo eliminar el instructor.',
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
