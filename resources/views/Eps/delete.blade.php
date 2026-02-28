@extends('adminlte::page')

@section('title', 'Eliminar EPS')

@section('content_header')
<h1>Eliminar EPS</h1>
@stop

@section('content')

{{-- Hidden fields to pass CSRF and flash message safely to JS --}}
<input type="hidden" id="csrfToken" value="{{ csrf_token() }}">
<input type="hidden" id="successMessage" value="{{ session('success') ?? '' }}">

<div class="card card-danger">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-trash"></i> Confirmar eliminación</h3>
    </div>

    <div class="card-body">
        <p><strong>Número Documento:</strong> {{ $dato->Numdoc }}</p>
        <p><strong>Denominación:</strong> {{ $dato->Denominacion }}</p>
        <p><strong>Observaciones:</strong> {{ $dato->Observaciones }}</p>
        <hr>
        <p class="text-danger">¿Estás seguro de que deseas eliminar esta EPS? Esta acción no se puede deshacer.</p>
    </div>

    <div class="card-footer d-flex justify-content-between">
        <a href="{{ route('eps.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Cancelar
        </a>

        <form id="deleteForm" action="{{ route('eps.destroy', $dato->NIS) }}" method="POST" class="m-0">
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
        // Read flash message and CSRF token from hidden inputs to avoid Blade inside JS
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

        const btnDelete = document.getElementById('btnDelete');
        const form = document.getElementById('deleteForm');

        btnDelete.addEventListener('click', function() {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "Esta acción eliminará la EPS definitivamente.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
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
                                    title: '¡Eliminada!',
                                    text: data.message || 'La EPS se eliminó correctamente.',
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then(() => {
                                    window.location.href = "{{ route('eps.index') }}";
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: data && data.message ? data.message : 'No se pudo eliminar la EPS.',
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