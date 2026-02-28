@extends('adminlte::page')

@section('title', 'Eliminar Centro de Formación')

@section('content_header')
<h1>Eliminar Centro de Formación</h1>
@stop

@section('content')
<div class="card card-danger">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-trash"></i> Confirmar eliminación</h3>
    </div>

    <div class="card-body">
        <p><strong>Código:</strong> {{ $dato->Codigo }}</p>
        <p><strong>Denominación:</strong> {{ $dato->Denominacion }}</p>
        <p><strong>Observaciones:</strong> {{ $dato->Observaciones }}</p>
        <p><strong>Regional:</strong> {{ $dato->regional->Denominacion ?? 'Sin regional' }}</p>

        <hr>

        <p class="text-danger">
            ¿Estás seguro de que deseas eliminar este centro de formación? Esta acción no se puede deshacer.
        </p>
    </div>

    <div class="card-footer d-flex justify-content-between">
        <a href="{{ route('centrosformacion.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Cancelar
        </a>

        <form id="deleteForm" action="{{ route('centrosformacion.destroy', $dato->NIS) }}" method="POST" class="m-0">
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
    document.addEventListener('DOMContentLoaded', function() {
        const deleteForm = document.getElementById('deleteForm');

        deleteForm.addEventListener('submit', function(e) {
            e.preventDefault();

            Swal.fire({
                title: '¿Estás seguro?',
                text: "Esta acción eliminará el centro de formación definitivamente.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    const action = this.action;
                    const methodInput = this.querySelector('input[name="_method"]');
                    const method = methodInput ? methodInput.value : this.method;
                    const formData = new FormData(this);

                    fetch(action, {
                            method: method.toUpperCase(),
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
                            return {
                                success: response.ok
                            };
                        })
                        .then(data => {
                            if (data && data.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: '¡Eliminado!',
                                    text: data.message || 'El centro de formación se eliminó correctamente.',
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then(() => {
                                    window.location.href = "{{ route('centrosformacion.index') }}";
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: data && data.message ? data.message : 'No se pudo eliminar el centro.',
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