@extends('adminlte::page')

@section('title', 'EPS')

@section('content_header')
<h1>EPS</h1>
@stop

@section('content')

{{-- Hidden inputs to pass flash message and CSRF token safely to JS --}}
<input type="hidden" id="successMessage" value="{{ session('success') ?? '' }}">
<input type="hidden" id="csrfToken" value="{{ csrf_token() }}">

<div class="card">
    <div class="card-header">
        <div class="d-flex w-100 align-items-center">
            {{-- Left side intentionally empty to remove the "Lista de EPS" text --}}
            <div class="me-auto"></div>

            {{-- Button aligned to the right --}}
            <div>
                <a href="{{ route('eps.create') }}" class="btn btn-success">
                    <i class="fas fa-plus"></i> Nueva EPS
                </a>
            </div>
        </div>
    </div>

    <div class="card-body table-responsive p-0">
        <table class="table table-bordered table-striped mb-0">
            <thead class="bg-primary text-white">
                <tr>
                    <th>NIS</th>
                    <th>Documento</th>
                    <th>Denominación</th>
                    <th>Observaciones</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($datos as $e)
                <tr>
                    <td>{{ $e->NIS }}</td>
                    <td>{{ $e->Numdoc }}</td>
                    <td>{{ $e->Denominacion }}</td>
                    <td>{{ $e->Observaciones }}</td>
                    <td class="text-center">
                        <a href="{{ route('eps.edit', $e->NIS) }}" class="btn btn-primary btn-sm" title="Editar">
                            <i class="fas fa-edit"></i> Editar
                        </a>

                        <form action="{{ route('eps.destroy', $e->NIS) }}" method="POST" class="d-inline delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" title="Eliminar">
                                <i class="fas fa-trash"></i> Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-4">Sin registros</td>
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
        // Read flash message and CSRF token from hidden inputs (avoids Blade inside JS)
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

        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

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
                        const action = this.action;
                        const methodInput = this.querySelector('input[name="_method"]');
                        const method = methodInput ? methodInput.value.toUpperCase() : this.method.toUpperCase();
                        const formData = new FormData(this);

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
    });
</script>
@stop