@extends('adminlte::page')

@section('title', 'Eliminar Ente Coformador')

@section('content_header')
<h1>Eliminar Ente Coformador</h1>
@stop

@section('content')

{{-- Hidden fields to pass CSRF and flash message safely --}}
<input type="hidden" id="csrfToken" value="{{ csrf_token() }}">
<input type="hidden" id="successMessage" value="{{ session('success') ?? '' }}">

<div class="card card-danger">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-trash"></i> Confirmar Eliminación</h3>
    </div>

    <div class="card-body">
        <p>
            ¿Estás seguro de que deseas eliminar el ente coformador
            <strong>{{ $dato->Nombres ?? $dato->RazonSocial }}</strong>?
        </p>
        <p class="text-danger">Esta acción no se puede deshacer.</p>
    </div>

    <div class="card-footer d-flex justify-content-between">
        <a href="{{ route('entecoformadores.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Cancelar
        </a>

        <form id="deleteForm" action="{{ route('entecoformadores.destroy', $dato->NIS) }}" method="POST" class="m-0">
            @csrf
            @method('DELETE')
            <button type="button" id="btnDelete" class="btn btn-danger">
                <i class="fas fa-trash"></i> Eliminar
            </button>
        </form>
    </div>
</div>

@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Mostrar mensaje flash si existe (leer desde input oculto)
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

        const btnDelete = document.getElementById('btnDelete');
        const form = document.getElementById('deleteForm');
        const csrfToken = document.getElementById('csrfToken').value;

        btnDelete.addEventListener('click', function() {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "Esta acción eliminará el ente coformador definitivamente.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Obtener método real (DELETE) desde el input _method si existe
                    const methodInput = form.querySelector('input[name="_method"]');
                    const method = methodInput ? methodInput.value.toUpperCase() : form.method.toUpperCase();
                    const action = form.action;
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
                                    text: data.message || 'El ente coformador se eliminó correctamente.',
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then(() => {
                                    window.location.href = "{{ route('entecoformadores.index') }}";
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: data && data.message ? data.message : 'No se pudo eliminar el ente.',
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
</script>
@stop