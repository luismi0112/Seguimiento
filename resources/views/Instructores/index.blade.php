@extends('adminlte::page')

@section('title', 'Instructores')

@section('content_header')
<h1>Instructores</h1>
@stop

@section('content')

{{-- Hidden inputs to pass flash message and CSRF token safely to JS --}}
<input type="hidden" id="successMessage" value="{{ session('success') ?? '' }}">
<input type="hidden" id="csrfToken" value="{{ csrf_token() }}">

<div class="card">
    <div class="card-header d-flex align-items-center">
        <div class="me-auto"></div>

        <div>
            <a href="{{ route('instructores.create') }}" class="btn btn-success">
                <i class="fas fa-plus"></i> Agregar Instructor
            </a>
        </div>
    </div>

    <div class="card-body table-responsive p-0">
        <table class="table table-bordered table-hover table-sm mb-0">
            <thead class="bg-primary text-white">
                <tr>
                    <th>NIS</th>
                    <th>Documento</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Dirección</th>
                    <th>Teléfono</th>
                    <th>Correo Institucional</th>
                    <th>Correo Personal</th>
                    <th>Sexo</th>
                    <th>Nacimiento</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($instructores as $inst)
                <tr>
                    <td>{{ $inst->NIS }}</td>
                    <td>{{ $inst->Numdoc }}</td>
                    <td>{{ $inst->Nombres }}</td>
                    <td>{{ $inst->Apellidos }}</td>
                    <td>{{ $inst->Direccion }}</td>
                    <td>{{ $inst->Telefono }}</td>
                    <td>{{ $inst->CorreoInstitucional }}</td>
                    <td>{{ $inst->CorreoPersonal }}</td>
                    <td>{{ $inst->Sexo == 1 ? 'Masculino' : 'Femenino' }}</td>
                    <td>{{ $inst->FechaNacimiento }}</td>
                    <td class="text-center">
                        <a href="{{ route('instructores.edit', $inst->NIS) }}"
                            class="btn btn-primary btn-sm me-1"
                            title="Editar instructor {{ $inst->NIS }}">
                            <i class="fas fa-edit"></i> Editar
                        </a>

                        <form action="{{ route('instructores.destroy', $inst->NIS) }}" method="POST" class="d-inline delete-form m-0">
                            @csrf
                            @method('DELETE')
                            <button type="button"
                                class="btn btn-danger btn-sm btn-delete"
                                title="Eliminar instructor {{ $inst->NIS }}">
                                <i class="fas fa-trash"></i> Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="11" class="text-center py-4">No hay registros</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if(method_exists($instructores, 'links'))
    <div class="card-footer clearfix">
        {{ $instructores->links() }}
    </div>
    @endif
</div>

@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const successMessage = (document.getElementById('successMessage') || {}).value || '';
        const csrfToken = (document.getElementById('csrfToken') || {}).value || '';

        if (successMessage.trim()) {
            Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: successMessage,
                showConfirmButton: false,
                timer: 2000
            });
        }

        document.querySelectorAll('.btn-delete').forEach(button => {
            button.addEventListener('click', function() {
                const form = this.closest('form');

                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "Esta acción eliminará al instructor definitivamente.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (!result.isConfirmed) return;

                    const action = form.action;
                    const methodInput = form.querySelector('input[name="_method"]');
                    const method = methodInput ? methodInput.value.toUpperCase() : form.method.toUpperCase();
                    const formData = new FormData(form);

                    fetch(action, {
                            method: method,
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
                                    title: '¡Eliminado!',
                                    text: data.message || 'El instructor se eliminó correctamente.',
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then(() => {
                                    window.location.href = "{{ route('instructores.index') }}";
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: data && data.message ? data.message : 'No se pudo eliminar el instructor.',
                                });
                            }
                        })
                        .catch(error => {
                            console.error(error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Ocurrió un problema al procesar la solicitud.',
                            });
                        });
                });
            });
        });
    });
</script>
@stop