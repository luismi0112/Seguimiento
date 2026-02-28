@extends('adminlte::page')

@section('title', 'Fichas de Caracterización')

@section('content_header')
<h1>Fichas</h1>
@stop

@section('content')

{{-- Hidden inputs to pass flash message and CSRF token safely to JS --}}
<input type="hidden" id="successMessage" value="{{ session('success') ?? '' }}">
<input type="hidden" id="csrfToken" value="{{ csrf_token() }}">

<div class="card">
    <div class="card-header d-flex align-items-center">
        <div class="ms-auto">
            <a href="{{ route('fichas.create') }}" class="btn btn-success">
                <i class="fas fa-plus"></i> Agregar Nueva Ficha
            </a>
        </div>
    </div>

    <div class="card-body table-responsive p-0">
        <table class="table table-bordered table-striped mb-0">
            <thead class="bg-primary text-white">
                <tr>
                    <th>NIS</th>
                    <th>Código</th>
                    <th>Denominación</th>
                    <th>Cupo</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Fin</th>
                    <th>Observaciones</th>
                    <th>Programa</th>
                    <th>Centro</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($datos as $ficha)
                <tr>
                    <td>{{ $ficha->NIS }}</td>
                    <td>{{ $ficha->Codigo }}</td>
                    <td>{{ $ficha->Denominacion }}</td>
                    <td>{{ $ficha->Cupo }}</td>
                    <td>{{ $ficha->Fechainicio }}</td>
                    <td>{{ $ficha->Fechafin }}</td>
                    <td>{{ $ficha->Observaciones }}</td>
                    <td>{{ $ficha->programa ? $ficha->programa->Denominacion : 'Sin programa' }}</td>
                    <td>{{ $ficha->centro ? $ficha->centro->Denominacion : 'Sin centro' }}</td>
                    <td class="text-center">
                        <a href="{{ route('fichas.edit', $ficha->NIS) }}"
                            class="btn btn-primary btn-sm me-1"
                            title="Editar"
                            aria-label="Editar ficha {{ $ficha->NIS }}">
                            <i class="fas fa-edit"></i> Editar
                        </a>

                        <form action="{{ route('fichas.destroy', $ficha->NIS) }}" method="POST" class="d-inline delete-form m-0">
                            @csrf
                            @method('DELETE')
                            <button type="button"
                                class="btn btn-danger btn-sm btn-delete"
                                title="Eliminar"
                                aria-label="Eliminar ficha {{ $ficha->NIS }}">
                                <i class="fas fa-trash"></i> Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="10" class="text-center py-4">No hay registros</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if(method_exists($datos, 'links'))
    <div class="card-footer clearfix">
        {{ $datos->links() }}
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
                    text: "Esta acción eliminará la ficha definitivamente.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        const action = form.action;
                        const methodInput = form.querySelector('input[name=\"_method\"]');
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
                                        title: '¡Eliminada!',
                                        text: data.message || 'La ficha se eliminó correctamente.',
                                        showConfirmButton: false,
                                        timer: 1500
                                    }).then(() => {
                                        window.location.href = "{{ route('fichas.index') }}";
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: data && data.message ? data.message : 'No se pudo eliminar la ficha.',
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
                    }
                });
            });
        });
    });
</script>
@stop